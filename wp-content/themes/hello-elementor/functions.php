<?php

/**
 * Theme functions and definitions
 *
 * @package HelloElementor
 */


if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

define('HELLO_ELEMENTOR_VERSION', '2.6.1');

if (!isset($content_width)) {
    $content_width = 800; // Pixels.
}

if (!function_exists('hello_elementor_setup')) {
    /**
     * Set up theme support.
     *
     * @return void
     */
    function hello_elementor_setup()
    {
        if (is_admin()) {
            hello_maybe_update_theme_version_in_db();
        }

        $hook_result = apply_filters_deprecated('elementor_hello_theme_load_textdomain', [true], '2.0', 'hello_elementor_load_textdomain');
        if (apply_filters('hello_elementor_load_textdomain', $hook_result)) {
            load_theme_textdomain('hello-elementor', get_template_directory() . '/languages');
        }

        $hook_result = apply_filters_deprecated('elementor_hello_theme_register_menus', [true], '2.0', 'hello_elementor_register_menus');
        if (apply_filters('hello_elementor_register_menus', $hook_result)) {
            register_nav_menus(['menu-1' => __('Header', 'hello-elementor')]);
            register_nav_menus(['menu-2' => __('Footer', 'hello-elementor')]);
        }

        $hook_result = apply_filters_deprecated('elementor_hello_theme_add_theme_support', [true], '2.0', 'hello_elementor_add_theme_support');
        if (apply_filters('hello_elementor_add_theme_support', $hook_result)) {
            add_theme_support('post-thumbnails');
            add_theme_support('automatic-feed-links');
            add_theme_support('title-tag');
            add_theme_support(
                'html5',
                [
                    'search-form',
                    'comment-form',
                    'comment-list',
                    'gallery',
                    'caption',
                    'script',
                    'style',
                ]
            );
            add_theme_support(
                'custom-logo',
                [
                    'height'      => 100,
                    'width'       => 350,
                    'flex-height' => true,
                    'flex-width'  => true,
                ]
            );

            /*
        * Editor Style.
        */
            add_editor_style('classic-editor.css');

            /*
        * Gutenberg wide images.
        */
            add_theme_support('align-wide');

            /*
        * WooCommerce.
        */
            $hook_result = apply_filters_deprecated('elementor_hello_theme_add_woocommerce_support', [true], '2.0', 'hello_elementor_add_woocommerce_support');
            if (apply_filters('hello_elementor_add_woocommerce_support', $hook_result)) {
                // WooCommerce in general.
                add_theme_support('woocommerce');
                // Enabling WooCommerce product gallery features (are off by default since WC 3.0.0).
                // zoom.
                add_theme_support('wc-product-gallery-zoom');
                // lightbox.
                add_theme_support('wc-product-gallery-lightbox');
                // swipe.
                add_theme_support('wc-product-gallery-slider');
            }
        }
    }
}
add_action('after_setup_theme', 'hello_elementor_setup');

function hello_maybe_update_theme_version_in_db()
{
    $theme_version_option_name = 'hello_theme_version';
    // The theme version saved in the database.
    $hello_theme_db_version = get_option($theme_version_option_name);

    // If the 'hello_theme_version' option does not exist in the DB, or the version needs to be updated, do the update.
    if (!$hello_theme_db_version || version_compare($hello_theme_db_version, HELLO_ELEMENTOR_VERSION, '<')) {
        update_option($theme_version_option_name, HELLO_ELEMENTOR_VERSION);
    }
}

if (!function_exists('hello_elementor_scripts_styles')) {
    /**
     * Theme Scripts & Styles.
     *
     * @return void
     */
    function hello_elementor_scripts_styles()
    {
        $enqueue_basic_style = apply_filters_deprecated('elementor_hello_theme_enqueue_style', [true], '2.0', 'hello_elementor_enqueue_style');
        $min_suffix          = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';

        if (apply_filters('hello_elementor_enqueue_style', $enqueue_basic_style)) {
            wp_enqueue_style(
                'hello-elementor',
                get_template_directory_uri() . '/style' . $min_suffix . '.css',
                [],
                HELLO_ELEMENTOR_VERSION
            );
        }

        if (apply_filters('hello_elementor_enqueue_theme_style', true)) {
            wp_enqueue_style(
                'hello-elementor-theme-style',
                get_template_directory_uri() . '/theme' . $min_suffix . '.css',
                [],
                HELLO_ELEMENTOR_VERSION
            );
        }
    }
}
add_action('wp_enqueue_scripts', 'hello_elementor_scripts_styles');

if (!function_exists('hello_elementor_register_elementor_locations')) {
    /**
     * Register Elementor Locations.
     *
     * @param ElementorPro\Modules\ThemeBuilder\Classes\Locations_Manager $elementor_theme_manager theme manager.
     *
     * @return void
     */
    function hello_elementor_register_elementor_locations($elementor_theme_manager)
    {
        $hook_result = apply_filters_deprecated('elementor_hello_theme_register_elementor_locations', [true], '2.0', 'hello_elementor_register_elementor_locations');
        if (apply_filters('hello_elementor_register_elementor_locations', $hook_result)) {
            $elementor_theme_manager->register_all_core_location();
        }
    }
}
add_action('elementor/theme/register_locations', 'hello_elementor_register_elementor_locations');

if (!function_exists('hello_elementor_content_width')) {
    /**
     * Set default content width.
     *
     * @return void
     */
    function hello_elementor_content_width()
    {
        $GLOBALS['content_width'] = apply_filters('hello_elementor_content_width', 800);
    }
}
add_action('after_setup_theme', 'hello_elementor_content_width', 0);

if (is_admin()) {
    require get_template_directory() . '/includes/admin-functions.php';
}

/**
 * If Elementor is installed and active, we can load the Elementor-specific Settings & Features
 */

// Allow active/inactive via the Experiments
require get_template_directory() . '/includes/elementor-functions.php';

/**
 * Include customizer registration functions
 */
function hello_register_customizer_functions()
{
    if (is_customize_preview()) {
        require get_template_directory() . '/includes/customizer-functions.php';
    }
}
add_action('init', 'hello_register_customizer_functions');

if (!function_exists('hello_elementor_check_hide_title')) {
    /**
     * Check hide title.
     *
     * @param bool $val default value.
     *
     * @return bool
     */
    function hello_elementor_check_hide_title($val)
    {
        if (defined('ELEMENTOR_VERSION')) {
            $current_doc = Elementor\Plugin::instance()->documents->get(get_the_ID());
            if ($current_doc && 'yes' === $current_doc->get_settings('hide_title')) {
                $val = false;
            }
        }
        return $val;
    }
}
add_filter('hello_elementor_page_title', 'hello_elementor_check_hide_title');

/**
 * Wrapper function to deal with backwards compatibility.
 */
if (!function_exists('hello_elementor_body_open')) {
    function hello_elementor_body_open()
    {
        if (function_exists('wp_body_open')) {
            wp_body_open();
        } else {
            do_action('wp_body_open');
        }
    }
}


add_shortcode('custom_search', 'search_by_filter');
function search_by_filter($atts)
{
    $html = '<form method="post" action="/profile/">
    <div class="custom-main" >
    <div class="row align-items-center">
    <div class="col-lg-2 col-md-2 col-sm-6 custom-col--set  ">        
        <select name="state_select" id="state_select" class="form-select" aria-label="Default select example" >
             <option value="">Select State</option>
    ';
    $state = array(
        'post_type' => 'state',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'ASC',
    );
    $state_data = new Wp_Query($state);

    while ($state_data->have_posts()) {
        $state_data->the_post();
        $state_name = get_the_title();
        // $brewery_name = get_field('name');
        $id = get_the_ID();

        $selected_state = (isset($_POST["brewery_select"]) && $_POST["brewery_select"] == $id) ? "selected" : "";

        $html .= ' <option value="' . $id . '" ' . $selected_state . '>' . $state_name . '</option>';
    }

    $html .= '      
            
        </select>
    </div>
        <div class="col-lg-3 col-md-2 col-sm-6 custom-col--set">
        
            <select class="form-select city" aria-label="Default select example" id="city" name="city">
                <option>Select City</option>
            ';
    $terms = array(
        'taxonomy' => 'city_category',
        'orderby' => 'name',
        'order'   => 'ASC',
        'hide_empty' => false
    );
    $cats = get_categories($terms);
    foreach ($cats as $cat) {
        // $f = get_category_link($cat->term_id);
        $select_city = (isset($_POST["city"]) && $_POST["city"] == $cat->term_id) ? "selected" : "";

        $html .= '<option value="' . $cat->term_id . '" ' . $select_city . '>' . $cat->name . '</option>';
    }
    $selected_male = (isset($_POST["gender"]) && $_POST["gender"] == "Male") ? "selected" : "";
    $selected_female = (isset($_POST["gender"]) && $_POST["gender"] == "Female") ? "selected" : "";

    $html .= '  
            
            </select>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-6 custom-col--set hide ">
            
            <input type="text" class="zip_code form-control" placeholder="Zip Code" name="zip_code"  >
        </div>
        <div class="col-lg-3 col-md-2 col-sm-6 custom-col--set  ">
        
            <select name="brewery_select" id="brewery_select" class="form-select" aria-label="Default select example" >
                <option value="">Select Brewery</option>
        ';
    $brewery = array(
        'post_type' => 'brewery',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'ASC',
    );
    $brewery_data = new Wp_Query($brewery);

    while ($brewery_data->have_posts()) {
        $brewery_data->the_post();
        $prewery_name = get_the_title();
        // $brewery_name = get_field('name');
        $id = get_the_ID();

        $selected_breweries = (isset($_POST["brewery_select"]) && $_POST["brewery_select"] == $id) ? "selected" : "";

        $html .= ' <option value="' . $id . '" ' . $selected_breweries . '>' . $prewery_name . '</option>';
    }

    $html .= '      
                
            </select>
        </div>
        
        <div class="col-lg-4 col-md-4 col-sm-6 custom-col--set">
        <div class="custom-d-flex-set">
            <div class="form-group">
            
                    <div class="datepicker date input-group">
                        <input name="date" type="text" placeholder="Date" class="form-control" id="fecha1" style="border-left: 0px !important;">
                        <div class="input-group-append" >
                        <span class="input-group-text" style="padding:12px 24px !important; border-radius:0px !important;
                    border:none !important;
                    background-color:transparent !important;"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
            </div>
            <a href="/profile/"><button type="submit" class="btn btn-primary" name="profile_search"> <i class="fas fa-search"></i></button></a>
            </div>
        </div>
    </div>
    </div>
    </form>';
    return $html;
}
add_shortcode('sidebar-filter', 'side_by_filter');
function side_by_filter($atts)
{
    $html = '<form  method="post" class="filter_users">
    <div class="main-filter">
        <div class="info-filter">
            <h4 data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" style="cursor: pointer;
        ">
                Filters <i class="fas fa-angle-down"></i>
            </h4>
            <h5  class="reset_all">
                RESET All
            </h5>
        </div>
        
    <div class="collapse show" id="collapseExample">';


    //     <hr>
    //     <div class="card card-body ">
    //                 <h6>
    //                 Knowledge Level
    //                 </h6>
    //             <div class="collapse show" id="collapseExample5">
    //                 <div class="card card-body cus-body pt-3">';
    //     $know_level = get_field_object('field_633c324c667af');
    //     $know_level_option = $know_level['choices'];
    //     foreach ($know_level_option as $key => $value) {
    //         $html .= ' <label class="tainer">' . $value . '
    //                     <input type="checkbox" class="Professional"  name="knowl_level[]" value="' . $key . '">

    //                     <span class="checkmark"></span>
    //                     </label>';
    //     }

    //     $html .= '   
    //                 </div>
    //             </div>
    //     </div>
    $terms = array(
        'taxonomy' => 'city_category',
        'orderby' => 'name',
        'order'   => 'ASC',
        'hide_empty' => false
    );
    $cats = get_categories($terms);
    $html .= '<hr>
    <div class="card card-body ">
<h6 data-bs-toggle="collapse" data-bs-target="#collapseExample5" aria-expanded="false" aria-controls="collapseExample5" style="cursor: pointer;">
    Cities
    <i class="fas fa-angle-down"></i>
</h6>
<div class="p-1 bg-light cus-input-group-prepend shadow-sm mb-4">
            <div class="input-group">
              <div class="input-group-prepend">
                <i class="fa fa-search"></i>
              </div>
              <input type="search" placeholder="search city" aria-describedby="button-addon2" class="form-control border-0 bg-light search_city_filter">
            </div>
          </div>
<div class="collapse show city_filter" id="collapseExample5">

';
	
    foreach ($cats as $cat) {
        if (isset($cat->name) && !empty($cat->name)) {
            $html .= '
    <div class="card card-body custom-check-label cus-body pt-3">
        <div class="row">     
            <div class="col-12">
                        <label class="tainer " >' . $cat->name . '
                    <input class="cities"  type="checkbox" name="cities[]" value="' . $cat->term_id . '">
                        <span class="checkmark"></span>
                        </label>    
            </div>
        </div>
    </div>';
        }
    }
    $html .= '  
</div>
</div>
    <hr>
             <div class="card card-body ">
    <h6 data-bs-toggle="collapse" data-bs-target="#collapseExample6" aria-expanded="false" aria-controls="collapseExample6" style="cursor: pointer;">
        Brewery
        <i class="fas fa-angle-down"></i>
    </h6>
    <div class="collapse show" id="collapseExample6">
    
        
        <div class="card card-body custom-check-label cus-body pt-3">
              <div class="row">     
                <div class="col-12">
                       <select name="breweriess" id="brewery_s" class="form-select" aria-label="Default select example" >
                       <option></option>
                   ';
    $brewery = array(
        'post_type' => 'brewery',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'ASC',
    );
    $brewery_dataa = new Wp_Query($brewery);

    while ($brewery_dataa->have_posts()) {
        $brewery_dataa->the_post();
        $prewerys_name = get_the_title();
        // $brewery_name = get_field('name');
        $id = get_the_ID();

        $selected_breweries = (isset($_POST["breweriess"]) && $_POST["breweriess"] == $id) ? "selected" : "";

        $html .= ' <option value="' . $id . '" ' . $selected_breweries . '>' . $prewerys_name . '</option>';
    }

    $html .= '              
                       </select>
                               
                </div>
             </div>
        </div>
    
            
    </div>
    </div>
    <hr>
    <div class="card card-body ">
                <h6 data-bs-toggle="collapse" data-bs-target="#collapseExample7" aria-expanded="false" aria-controls="collapseExample7" style="cursor: pointer;">
                Additional Expertise
                <i class="fas fa-angle-down"></i>
                </h6>
            <div class="collapse show" id="collapseExample7">
                <div class="card card-body custom-check-label cus-body pt-3">
                  <div class="row">';

    $certification =  get_field_object('field_63317ea55ab0e');

    $certificationOptioins = $certification['choices'];

    foreach ($certificationOptioins as  $key => $value) {
        $html .= '<div class="col-12">
                                        <label class="tainer" >' . $value . '';
        $html .= '   <input class="certifaction"  type="checkbox" name="certifications[]" value="' . $value . '">
                                        <span class="checkmark"></span>
                                        </label> </div>';
    }
    $html .= '
                  </div>
                </div>
            </div>
    </div>';

    //     <hr>
    //     <div class="card card-body">
    //             <div class="collapse show">
    //                 <div class="card card-body">
    //         <div class="range-slider">
    //         <h6>Rate:<p class="rangeValues"></p></h6>
    //         <input value="1000" min="1000" name ="rate[]"  max="50000"  step="500" type="range">
    //         <input value="50000" min="1000" name ="rate[]" max="50000"  step="500" type="range">
    //       </div>
    //                 </div>
    //             </div>
    //     </div>
    $html .= '  
        <hr>
    <div class="card card-body">
                <h6 data-bs-toggle="collapse" data-bs-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample2" style="cursor: pointer;">
                Only 4 Stars or Higher (Y/N)
            <i class="fas fa-angle-down"></i>
                </h6>
            <div class="collapse show" id="collapseExample2">
                <div class="card card-body cus-body pt-3">
                    <label class="tainer">Yes
                        <input type="checkbox" name="rating[]" value="Yes">
                        <span class="checkmark"></span>
                        </label>
                        <label class="tainer">No
                        <input type="checkbox" name="rating[]" value="No">
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
    </div>
    <hr>
    <div class="card card-body ">
                <h6 data-bs-toggle="collapse" data-bs-target="#collapseExample8" aria-expanded="false" aria-controls="collapseExample8" style="cursor: pointer;">
                Accepts Large Groups
                <i class="fas fa-angle-down"></i>
                </h6>
            <div class="collapse show" id="collapseExample8">
                <div class="card card-body cus-body pt-3">
                ';
    $aceept_large_group = get_field_object('field_633c51ac6ca45');
    $aceept_large_group_opt = $aceept_large_group['choices'];
    foreach ($aceept_large_group_opt as $key => $value) {
        $html .= ' <label class="tainer">' . $value . '
                  <input type="checkbox" name="aceept_large_group[]" value="' . $value . '">
                  <span class="checkmark"></span>
                  </label>';
    }
    $html .= '
                </div>
            </div>
    </div>';
    //     <hr>
    //     <div class="card card-body" style="
    //     display: flex;
    //     flex-direction: row;
    //     justify-content: space-between;
    // ">
    //         <h6 style="cursor: pointer; margin-bottom: 0px;">
    //                 Days of the week available.
    //             <!-- <i class="fas fa-angle-down"></i> -->
    //         </h6>
    //         <div class="datepicker date input-group custom-date-two" >
    //             <input  type="text" placeholder="" class="form-control d-none" id="fecha1" style="border: 1px solid #d3d3d3; border-radius:0px !important;
    //                 border:2px solid #ced4da !important;
    //                 background-color:#e7e6e630 !important;">
    //                 <div class="input-group-append" style="margin-right:60px;">
    //                 <span class="input-group-text" style="padding:12px !important; border-radius:0px !important;
    //                   border:none !important;
    //                   background-color:transparent !important;"><i class="fas fa-angle-down"></i></span>
    //             </div>
    //         </div>    
    //     </div>

    $html .= '
    
    <hr>
    <div class="card card-body ">
<h6 data-bs-toggle="collapse" data-bs-target="#collapseExample9" aria-expanded="false" aria-controls="collapseExample9" style="cursor: pointer;">
Days of the week available
<i class="fas fa-angle-down"></i>
</h6>
<div class="collapse show" id="collapseExample9">
<div class="card card-body custom-check-label cus-body pt-3">
        <div class="row">     
            <div class="col-12">
                        <label class="tainer" >Monday
                    <input class="certifaction"  type="checkbox" name="days[]" value="Monday">
                        <span class="checkmark"></span>
                        </label>    
            </div>
        </div>
    </div>
    <div class="card card-body custom-check-label cus-body pt-3">
        <div class="row">     
            <div class="col-12">
                        <label class="tainer" >Tuesday
                    <input class="certifaction"  type="checkbox" name="days[]" value="Tuesday">
                        <span class="checkmark"></span>
                        </label>    
            </div>
        </div>
    </div>
    <div class="card card-body custom-check-label cus-body pt-3">
        <div class="row">     
            <div class="col-12">
                        <label class="tainer" >Wednesday
                    <input class="certifaction"  type="checkbox" name="days[]" value="Wednesday">
                        <span class="checkmark"></span>
                        </label>    
            </div>
        </div>
    </div>
    <div class="card card-body custom-check-label cus-body pt-3">
        <div class="row">     
            <div class="col-12">
                        <label class="tainer" >Thursday
                    <input class="certifaction"  type="checkbox" name="days[]" value="Thursday">
                        <span class="checkmark"></span>
                        </label>    
            </div>
        </div>
    </div>
    <div class="card card-body custom-check-label cus-body pt-3">
        <div class="row">     
            <div class="col-12">
                        <label class="tainer" >Friday
                    <input class="certifaction"  type="checkbox" name="days[]" value="Friday">
                        <span class="checkmark"></span>
                        </label>    
            </div>
        </div>
    </div>
    <div class="card card-body custom-check-label cus-body pt-3">
        <div class="row">     
            <div class="col-12">
                        <label class="tainer" >Saturday
                    <input class="certifaction"  type="checkbox" name="days[]" value="Saturday">
                        <span class="checkmark"></span>
                        </label>    
            </div>
        </div>
    </div>
    <div class="card card-body custom-check-label cus-body pt-3">
        <div class="row">     
            <div class="col-12">
                        <label class="tainer" >Sunday
                    <input class="certifaction"  type="checkbox" name="days[]" value="Sunday">
                        <span class="checkmark"></span>
                        </label>    
            </div>
        </div>
    </div>
        
</div>
</div>';
    $html .= '
    <hr>
          <div class="card card-body ">
                <h6 data-bs-toggle="collapse" data-bs-target="#collapseExample3" aria-expanded="false" aria-controls="collapseExample3" style="cursor: pointer;">
                M/F/N (GENDER)
                <i class="fas fa-angle-down"></i>
                </h6>
            <div class="collapse show" id="collapseExample3">
                <div class="card card-body cus-body pt-3">';
    $gender = get_field_object('field_633c31fdb016b');
    $genderOptioins = $gender['choices'];
    foreach ($genderOptioins as $key => $value) {
        $html .= '
                <label class="tainer">' . $value . '
                <input type="checkbox" class="gendar" id="male"  name="gender[]" value="' . $value . '">
                <span class="checkmark"></span>
                </label>
                ';
    }
    $html .= '
           
                </div>
            </div>
    </div>
    
    
    <hr>
    <div class="card card-body ">
        <button type="submit" class="btn btn-primary cus-search-filter"> <i class="fas fa-search"></i></button>
    </div>
    </div> 
    </div>
    </form>';
    return $html;
}
//Login Menu Button

add_shortcode('login-menu-button', 'login_menu_button');
function login_menu_button($atts)
{
    $currentUser = wp_get_current_user();
    //$logoutUrl = wp_nonce_url( 'http://beertrippr.hailogics.com/my-account/user-logout/' );
    $logoutUrl = wp_logout_url('/my-account');
    $displpaName = (isset($currentUser) && !empty($currentUser->ID)) ? ucfirst($currentUser->display_name) : "LOGIN";
    $displpSignUp = (isset($currentUser) && !empty($currentUser->ID)) ? '<a href="' . $logoutUrl . '">              
    <span class="elementor-icon-list-text"> | Logout</span></a>' : '<a href="/registration">              
    <span class="elementor-icon-list-text"> | SIGN UP</span>
  </a>';
    $html = '<div class="elementor-element elementor-element-68bf963 elementor-align-right elementor-icon-list--layout-traditional elementor-list-item-link-full_width elementor-widget elementor-widget-icon-list" data-id="68bf963" data-element_type="widget" data-widget_type="icon-list.default">
        <div class="elementor-widget-container">
      <link rel="stylesheet" href="http://beertrippr.hailogics.com/wp-content/plugins/elementor/assets/css/widget-icon-list.min.css">   <ul class="elementor-icon-list-items custom-ul-set">
              <li class="elementor-icon-list-item">
                      <span class="elementor-icon-list-icon">
              <i aria-hidden="true" class="fas fa-user-alt"></i>            </span>
                    <a href="/my-account">                
                    <span class="elementor-icon-list-text">' . $displpaName . '</span>
                  </a></li><li class="elementor-icon-list-item">' . $displpSignUp . '</li>
            </ul>
        </div>
        </div>';
    return $html;
}

// Detail page
add_shortcode('custom-detail-page', 'cus_detail_page');
function cus_detail_page($atts)
{
    $user = get_queried_object();

    // $user=get_user_by('slug', 'jack');

    // $img = get_avatar_url($user->ID);
    $gravatar_image      = get_avatar_url($user->ID, $args = null);
    $profile_picture_url = get_user_meta($user->ID, 'profile_image', true);

    if (is_numeric($profile_picture_url)) {
        $profile_picture_url  = wp_get_attachment_url($profile_picture_url);
    }
    $img  = (!empty($profile_picture_url)) ? $profile_picture_url : $gravatar_image;


    $last_name = $user->last_name;

    $last_name_first_letter = substr($last_name, 0, 1);


    $html = '
    <div class="main-detail">
    
        <div class="row">
        <div class="col-lg-5 col-md-12 col-sm-12">
        <div class="detail-img-main">
        <img src="' . esc_url($img) . '" alt="">
        </div>
        </div>
        <div class="col-lg-7 col-md-12 col-sm-12">
        <div class="detail-info">
        <h5>' . get_user_meta($user->ID, 'first_name', true) . ' .' . $last_name_first_letter . '</h5>
        <hr>
          <p style="margin:10px 0px;">"Hey Let go for a Beer"</p>
        <hr>
        <br>
        <h5>$' . $user->rate . ' per hour</h5>
        <div class="heading-img">
        <h5 class="m-0">4.9 Reviews</h5>
        <div class="rating-stars">
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star"></span>
            <span class="fa fa-star"></span>
         </div>
        </div>
      <h5>Length of session</h5>
      <p>3 hours</p>
      <h5>Knowledge Level</h5>
      <div class="custon-level">';
    //   $know_level_u = get_user_meta($user->ID,'knowledge_level',true);

    //$knowledge_level = get_field_object('knowledge_level');
    //$knowledge_levelSelectedValues = $knowledge_level['value'];
   // $knowledge_levelOptioins = $knowledge_level['choices'];
    
    $knowledge_level = get_user_meta($user->ID,'knowledge_level',true);

    //foreach ($knowledge_levelOptioins as $key => $value) {
       // $checked = $key == $knowledge_levelSelectedValues ? 'checked' : '';
        $html .= '
                  <label class="tainer">' . $knowledge_level . '
                  <input type="checkbox" checked disabled>
                  <span class="checkmark"></span>
                  </label>
                  ';
    //}

    $html .= '
            </div>
        <h5 style="margin-bottom:15px;">Additional expertise</h5>
        <ul>
        ';


    $certification = get_user_meta($user->ID,'certification',true);


    //$certificationSelectedValues = $certification['value'];

   // $certificationOptioins = $certification['choices'];

    foreach ($certification as $key => $value) {
      //  $checked = (in_array($value, array_column($certificationSelectedValues, 'value'))) ? 'checked' : '';
        $html .= '<li>';
        $html .=
            '<label class="tainer">' . $value. '
        <input type="checkbox" checked disabled>
        <span class="checkmark"></span>
        </label>
            </li>';
    }

    $html .= ' 
        </ul>
        </div>
        </div>
        </div>
        <div class="super-tourist">
         <ul>
          <li><a href="#about-sec-cus">About</a></li>
          <li><a href="#schedule-sec-cus">Schedule</a></li>
          <li><a href="#reviews-sec-cus">Reviews (24)</a></li>
          <li><a href="#breweries-sec-cus">Breweries</a></li>
          <li><a href="#beer-sec-cus">Beer History</a></li>
         </ul>
        </div>
        <div class="super-tourist-about" id="about-sec-cus">
        <h3>About the Professional</h3>
        <p>' . $user->description . '</p>
        <a href="#">Read More</a>
        </div>
    </div>';
    return $html;
}

add_shortcode('payment', 'payment');
function payment($atts)
{
    $user = get_queried_object(); // Tripper
    $customer = wp_get_current_user(); // User

    $returnUrl = 'http://' . $_SERVER['SERVER_NAME'] . '/thank-you';

    $html = '';
    $html .= '<form id="payment-form" action="https://www.escrow-sandbox.com/checkout" method="post">
    <input type="hidden" name="type" value="general_merchandise">

    <input type="hidden" name="customer_name" id="customer_name" value="' . $customer->display_name . '">
    <input type="hidden" name="customer_email" id="customer_email" value="' . $customer->user_email . '">
    <input type="hidden" name="customer_id" id="customer_id" value="' . $customer->ID . '">
    <input type="hidden" name="taster_id" id="taster_id" value="' . $user->ID . '">
    <input type="hidden" name="non_initiator_email" value="kamranshah0@gmail.com">
    <input type="hidden" name="non_initiator_id" value="2863340">
    <input type="hidden" name="non_initiator_role" value="seller">
    <input type="hidden" name="transaction_id" id="transaction_id" value="">
    <input type="hidden" name="title" value="' . $user->display_name . '">
    <input type="hidden" name="currency" value="USD">
    <input type="hidden" name="domain" value="BeerTrippr">
    <input type="hidden" name="price" id="price" value="' . $user->rate . '">
    <input type="hidden" name="concierge" value="false">
    <input type="hidden" name="with_content" value="true">
    <input type="hidden" name="inspection_period" value="1">
    <input type="hidden" name="fee_payer" value="seller">
    <input type="hidden" name="return_url" value="' . $returnUrl . '">
    <input type="hidden" name="button_types" value="buy_now">
    <input type="hidden" name="auto_accept" value="">
    <input type="hidden" name="auto_reject" value="">
    <input type="hidden" name="selected-date-slot" id="selected-date-slot" value="">';
    // $html .='<style>@import url(https://fonts.googleapis.com/css?family=Open+Sans:600);.EscrowButtonSecondary.EscrowButtonSecondary{background-image:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAG8AAAALCAMAAABGfiMeAAAAjVBMVEUAAAA8ul08ul48ul08ul08ul9CwGE/vGFHv2lT2Hs8ul08ul49ul09u188ul09ul09ul08ul09ul49ul49u149ul48ul4+u18+u2A9uV09ul49ul5Av2FCvWE8uV09ul49ul49u149u18+vGA/wGM8ul48ul48ul48ul49ul49u18/vWE8uV09ul88uV1RkItgAAAALnRSTlMA+/fz1m4RKwwF4cWUV+vbzLGBU0qlnj01rI16HRq6uGdNYDAV5tC/tYdEI5p0k6hGXAAAAi1JREFUOMuFktuSojAURXcCIheROypIt8hV2t7//3lzwjjVXc7Ysx5SVA45K8kO3ld2QFP6eog74BIp7Zdo34T7FoBbj1ZUnpEzBjBQfv6g5UHoksiPCwDhexSkLnAYSghuFOHfUO2FCQjkS7HDhbQ0bWxo0CKcSansG1cpB1tKDVfOgGgt+r6lgVRm94w9tFQ9TF298tlYaWi7QO9h5AI4W/HNbfbGQgxDBzfhDTFbsx32KPkJGM3VLAUs/wyvYIiQayUgvZ99Dsf1D0/tYRDfDuIakYkTOHBGxQoFY2bweYSQ0IHhzBLAkSmuZGSWkc4Lnx8KLjDSrs/Ga3/5xPWO7NHsbQ1w0CF350d8gcbDd4ex3HChxQMqGZsXvpUPyWIkRdF/+fxk1rx+8zlKHTnJjq6yjdVnPfs2rFh4ez/hx6vz5YILoast5t/OZ0jxzYeYicyMMta/ferZVzOM9YZ1we3P+T0cNbT15ztZbNO35QnAwgSoSB6wW0fD6ZFS/4g4Rcr2QqWaO4//8WWd5xa8IODV6bfLmt9WqyMa6hbnialRU3vIaOJbdg1q8xjdDhiso3nCGSoursUEOx5e5aeFAI5FRe576WawVx8ujFxUNCXfARxyMqcxd2szRbOn0lRASA6ak7d62s0WN+Zo6s/8L+tppYK7mfyoNCHnUxQFN+SnK4D0lEm3WSYcCFURAtiZ8RJ0wPkexHNl4i2DZOMBaWxaSDUW03LIn2/1F/O5RSAdFTG2AAAAAElFTkSuQmCC);-moz-osx-font-smoothing:grayscale!important;-webkit-font-smoothing:antialiased!important;background-color:#f0f2f5!important;background-repeat:no-repeat!important;background-position:right 13px!important;border-radius:4px!important;border:1px solid rgba(0,0,0,.05)!important;-webkit-box-shadow:0 2px 4px 0 hsla(0,12%,54%,.1)!important;box-shadow:0 2px 4px 0 hsla(0,12%,54%,.1)!important;-webkit-box-sizing:border-box!important;box-sizing:border-box!important;color:#555!important;cursor:pointer!important;display:inline-block!important;font-family:Open Sans,sans-serif!important;font-size:14px!important;font-weight:600!important;letter-spacing:.4px!important;line-height:1.2!important;min-height:40px!important;padding:8px 118px 8px 21px!important;text-align:left!important;text-decoration:none!important;text-shadow:none!important;text-transform:none!important;-webkit-transition:all .1s linear!important;transition:all .1s linear!important;vertical-align:middle!important}.EscrowButtonSecondary.EscrowButtonSecondary:focus,.EscrowButtonSecondary.EscrowButtonSecondary:hover{color:#555!important;font-size:14px!important;font-weight:600!important;outline:0!important;text-decoration:none!important;-webkit-transform:none!important;transform:none!important}.EscrowButtonSecondary.EscrowButtonSecondary:hover{background-color:#f4f5f8!important;border-color:rgba(0,0,0,.05)!important}.EscrowButtonSecondary.EscrowButtonSecondary:focus{background-color:#e8e9ec!important}</style><button  type="submit">Buy It Now</button>';
    $html .= '<img src="https://t.escrow-sandbox.com/1px.gif?name=bin&price=' . $user->rate . '&title=BeerTrippr&user_id=2863340" style="display: none;">
        </form>';

    return $html;
}

add_shortcode('time_slot', 'time_slot');
function time_slot($atts)
{
    $user = get_queried_object();

    $html = '
        <style>
       
        .days {
            width: 1000px;
          }
          
          .day {
            width: 220px;
            height: 300px;
            background-color: #efeff6;
            padding:10px;
            float:left;
            margin-right:7px;
            margin-bottom:5px;
          }
          
          .datelabel {
            margin-bottom: 15px;
          }
          
          .timeslot {
            background-color: #00c09d;
            width: auto;
            height: 30px;
            color: white;
            padding:7px;
            margin-top: 5px;
            font-size: 14px;
            border-radius: 3px;
            vertical-align: center;
            text-align:center;
          }
          
          .timeslot:hover { 
            background-color: #2CA893;
            cursor: pointer;
          }
        </style>
        
        <div style="height:280px; width: 700px;overflow:scroll;border: 1px solid #ddd;">
        <div class="days">';
    while (have_rows('time_slot')) {
        the_row();
        $day = get_sub_field('day');
        $html .= '
        <div class="day">';
        $html .= '
          <div class="datelabel"><strong>' . $day . '</strong><br/></div>';
        while (have_rows('from_to_time')) {
            the_row();
            $to = get_sub_field('to');
            $from = get_sub_field('from');
            $html .= '
          <div class="timeslot">' . $from . ' - ' . $to . ' </div>';
        }
        $html .= '
        </div>';
        // date loop
    } // }// to_time loop


    $html .= '
       
        </div>
      </div>';
    return $html;
}

add_shortcode('custom-detail-section', 'cus_detail_section');
function cus_detail_section($atts)
{
    $user = get_queried_object(); // Tripper
    $customer = wp_get_current_user(); // User
    $html = ' <div class="custom-section-detail" id="schedule-sec-cus">
        <div class="row custom-mar">
            <div class="col-lg-7 col-md-7 col-sm-12"> 
        <div class="schedule-heading">
            <h4 class="m-0">Schedule</h4>
        </div>

<!-- bookingConfirmation Modal -->
<div class="modal fade" id="bookingConfirmation" tabindex="-1" aria-labelledby="bookingConfirmationLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header cus-modal-header-set">
        <img src="/wp-content/uploads/2022/08/logo.png">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure ?
      </div>
      <div class="modal-footer calen-cus-btn">
        <button type="button" class="btn btn-primary ok-btn" id="confirmTrasactionRequest">Confirm</button>
        <button type="button" class="btn btn-secondary cancel-btn" data-bs-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
<!-- bookingConfirmation Modal End -->
<!-- login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header cus-modal-header-set">
        <img src="/wp-content/uploads/2022/08/logo.png">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        '.do_shortcode("[user_registration_my_account]").'
      </div>
    </div>
  </div>
</div>
<!-- login Modal End -->
<!-- error Modal -->
<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header cus-modal-header-set">
        <img src="/wp-content/uploads/2022/08/logo.png">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure ?
      </div>
      <div class="modal-footer calen-cus-btn">
        <button type="button" class="btn btn-primary ok-btn" data-bs-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>
<!-- error Modal End -->
        <div id="picker">';
    // echo do_shortcode('[time_slot]');
    $html .= '
        </div>
            </div>
        <div class="col-lg-5 col-md-5 col-sm-12"> 
        <img src="http://beertrippr.hailogics.com/wp-content/uploads/2022/08/2101.i105.004_isometric_brewery_illustration.png" alt="">
            </div>
        </div>

        

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <img class="custom-modal-logo" src="/wp-content/uploads/2022/10/svg-esp-1.png">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background-color: transparent !important;"></button>
                  </div>
                  <div class="modal-body custom-modal-input">
                    <input type="hidden" name="customer_id" id="customer_id" value="' . $customer->ID . '">
                    <input type="hidden" name="taster_id" id="taster_id" value="' . $user->ID . '">
                    <input type="hidden" name="selectedSlot" id="selectedSlot" value="">
                    <input type="hidden" name="currency" id="currency" value="US">
                    <input type="hidden" name="price" id="price" value="' . $user->rate . '">
                    <input type="text" id="first_name" placeholder="First Name" value="' . $customer->first_name . '">
                    <input type="text" id="middle_name" placeholder="Middle Name" >
                    <input type="text" id="last_name" placeholder="Last Name" value="' . $customer->last_name . '">
                    <input type="text" id="phone" placeholder="Phone number">
                    <input type="text" id="email" placeholder="Email" value="' . $customer->user_email . '">
                    <label id="email_err"></label>
                    <input type="text" id="country" placeholder="Country">
                    <input type="text" id="city" placeholder="City">
                    <label id="city_err"></label>
                    <input type="text" id="address" placeholder="Address">
                    <label id="address_err"></label>
                    <input type="text" id="address2" placeholder="Second Address">
                    <label id="address2_err"></label>
                    <input type="text" id="state" placeholder="State e.g: CA">
                    <label id="state_err"></label>
                    <input type="text" id="postal_code" placeholder="Postal Code e.g: 12345">
                    <label id="postal_code_err"></label>
                  </div>
                  <div class="modal-footer">
                    <button type="button" id="create-new-account" class="btn btn-primary custom-modal-btn">Create Account</button>
                  </div>
                </div>
              </div>
            </div>
        <div class="row" id="breweries-sec-cus">';
    $user = get_queried_object();
    $breweries = get_field('breweries', 'user_' . $user->ID);

    if ($breweries) {
        foreach ($breweries as $val) {
            $html .= ' <div class="col-lg-3 col-md-3 col-sm-4">
            <div class="breweries-box">
            <h3>' . $val->post_title . '</h3>
            </div> 
    
        </div>';
        }
    }

    $html .= '
        
        </div>
        <div class="comment-section-people" id="reviews-sec-cus">
        <h4>What people say</h4>
        <div class="row">
        <div class="col-lg-8 col-md-12 col-sm-12">
        <hr>
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-3 col-sm-12">
            <div class="num-review">
            <h1>4.9</h1>
            <img src="https://beertrippr.hailogics.com/wp-content/uploads/2022/08/Layer-22-copy.png" alt="">
            <p>29 reviews</p> 
            </div>
            </div>
            <div class="col-1">
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12">
            <div class="flex-progress">
            <p class="mb-0">5 Star</p>
            <div class="progress">
            <div class="progress-bar" role="progressbar" style="width: 85%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <p class="mb-0">(1)</p>
            </div>
            <div class="flex-progress">
            <p class="mb-0">4 Star</p>
            <div class="progress">
            <div class="progress-bar" role="progressbar" style="width: 35%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <p class="mb-0">(1)</p>
            </div>
            <div class="flex-progress">
            <p class="mb-0">3 Star</p>
            <div class="progress">
            <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <p class="mb-0">(0)</p>
            </div>
            <div class="flex-progress">
            <p class="mb-0">2 Star</p>
            <div class="progress">
            <div class="progress-bar" role="progressbar" style="width: 15%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <p class="mb-0">(1)</p>
            </div>
            <div class="flex-progress">
            <p class="mb-0">1 Star</p>
            <div class="progress">
            <div class="progress-bar" role="progressbar" style="width: 10%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <p class="mb-0">(1)</p>
            </div>
            </div>
        </div>
        <hr> 
        </div> 
        </div>
        </div>
        <div class="comment-sec-custom">
        <div class="main-comment">
            <div class="row">
            <div class="col-lg-1 col-md-1 col-sm-2">
            <img src="https://beertrippr.hailogics.com/wp-content/uploads/2022/08/vbv-1.png" alt="">
            </div>
            <div class="col-lg-8 col-md-8 col-sm-10">
            <h5 class="m-0">MyPro103</h5>
            <p class="tagling-cus">july 12, 2022</p>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five but also the electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum It is a long established fact that a reader will be distracted readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters,</p>
            </div>
            </div>
        </div>
        <div class="reply-comment">
            <div class="row">
            <div class="col-lg-1 col-md-1 col-sm-2">
            <img src="https://beertrippr.hailogics.com/wp-content/uploads/2022/08/Group-17.png" alt="">
            </div>
            <div class="col-lg-8 col-md-8 col-sm-10">
            <h5 class="m-0">Reply from irene</h5>
            <p class="tagling-cus">july 12, 2022</p>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five but also the electronic typesetting, remaining essentially unchanged.</p>
            </div>
            </div>
        </div>
        </div>
        <div class="work-experience">
        <div class="row">
            <div class="col-3">
                <h4>Resume</h4>
            </div>
            <div class="col-9">
                <h4 class="w-e-border">Work Experience</h4>
            </div>
        </div>
            <hr>
        ';
    $user = get_queried_object();
    while (have_rows('resume_work_experience')) {
        the_row();
        $from = get_sub_field('from');
        $to = get_sub_field('to');
        $work_experience = get_sub_field('work_experience');
        $html .= '
            <div class="row">
            <div class="col-3">
                <h5>' . $from . ' — ' . $to . '</h5>
            </div>
            <div class="col-9">
                <h5>' . $work_experience . '</h5>
            </div>
            </div>
            <hr>';
    }
    $html .= '
        </div>
        </div>';
    return $html;
}



add_shortcode('custom-sidebar', 'cus_sidebar');
function cus_sidebar($atts)
{
    $user = get_queried_object();
    // $user=get_user_by('slug', 'jack');
    $link = get_field('link', 'user_' . $user->ID);


    $html = '<div class="custom-sidebar">
        ' . $link . '
        <div class="custom-setting">
        <div class="flex-twoheading">
        <div class="sidebar-cus-review">
            <h4><img src="https://beertrippr.hailogics.com/wp-content/uploads/2022/08/gg.png">4.7</h4>
            <p>29<span>reviews</span></p>
        </div>
        <div class="sidebar-cus-rate">
            <h4><span>$</span>' . $user->rate . '</h4>
            <p>per hour</p>
        </div>
        </div>
        <button type="button" class="btn btn-info custom-side-btn d-none" >';
    $html .= do_shortcode('[payment]');
    $html .= '</button>
        
        <button type="button" class="btn btn-info custom-side-btn" >Save to my list</button>
        <a href="#schedule-sec-cus"><button type="button" class="btn btn-info custom-side-btn" >Book me</button></a>
        <h6>Usually responds in 13 hrs</h6>
        </div>
    </div>';

    return $html;
}



add_shortcode('profiles_page', 'profiles_page');
function profiles_page($atts)
{

    $meta_query = [];
    $startDate = trim($_POST['date']);
    $startDateArray = explode('/', $startDate);
    $mysqlStartDate = $startDateArray[2] . "-" . $startDateArray[1] . "-" . $startDateArray[0];
    $startDate = $mysqlStartDate;
    $day =   date('l', strtotime($startDate));

    if (isset($_POST) && !empty($_POST)) {
        foreach ($_POST as $key => $value) {
            if ($key == 'date' && !empty($value)) {
                array_push($meta_query, ['meta_key' => 'time_slot_%_day', 'value' => $day, 'compare' => 'LIKE']);
            } else if ($key == 'brewery_select' && !empty($value)) {
                array_push($meta_query, ['key' => 'breweries', 'value' => $value, 'compare' => 'LIKE']);
            } else if ($key == 'state_select' && !empty($value)) {
                array_push($meta_query, ['key' => 'states', 'value' => $value, 'compare' => 'LIKE']);
            }
        }
    }

    $no = 10;
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    if ($paged == 1) {
        $offset = 0;
    } else {
        $offset = ($paged - 1) * $no;
    }

    $args = array(
        'role'    => 'Tripper',
        'orderby' => 'user_nicename',
        'order'   => 'ASC',
        'number' => $no, 'offset' => $offset,
        'meta_query' => $meta_query
    );
    $html = '<div id="filter_display_ajax"> ';

    //     $users = get_users($args);
    $user_query = new WP_User_Query($args);
    $counter = 0;

    foreach ($user_query->results as $user) {

        // Breweries Search
        // $cities_category = get_field('cities');
        // echo $cities_category;
        //  $category_city = get_field('cities','user_'.$user->ID);
        //   $term_id=  $category_city->term_id;

        $gander = get_user_meta($user->ID, 'gender', true);
        $knowledge_level = get_user_meta($user->ID, 'knowledge_level', true);
        //$img = get_avatar_url( $user->ID );
        $gravatar_image      = get_avatar_url($user->ID, $args = null);
        $profile_picture_url = get_user_meta($user->ID, 'profile_image', true);

        if (is_numeric($profile_picture_url)) {
            $profile_picture_url  = wp_get_attachment_url($profile_picture_url);
        }
        $image = (!empty($profile_picture_url)) ? $profile_picture_url : $gravatar_image;


        if ($counter % 2 == 0) {
            $html .= '<section class="elementor-section kamran elementor-inner-section elementor-element elementor-element-2fde435 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="2fde435" data-element_type="section">
                    <div class="elementor-container elementor-column-gap-default">';
        }

        $html .= '<div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-4dc462a" data-id="4dc462a" data-element_type="column">
                        <div class="elementor-widget-wrap elementor-element-populated">
                                            <section class="elementor-section elementor-inner-section elementor-element elementor-element-e27b870 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="e27b870" data-element_type="section">
                                    <div class="elementor-container elementor-column-gap-default">
                                <div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-08dca54" data-id="08dca54" data-element_type="column">
                        <div class="elementor-widget-wrap elementor-element-populated">
                                            <div class="elementor-element elementor-element-b4b744b elementor-widget elementor-widget-image" data-id="b4b744b" data-element_type="widget" data-widget_type="image.default">
                            <div class="elementor-widget-container">
                            <a href ="/profile/' . $user->user_nicename . '" >
                                <img width="192" height="210" src="' . esc_url($image) . '" class="attachment-large custom-img-set size-large" alt="" loading="lazy">
                                </a>                              
                            </div>
                            </div>
                                </div>
                    </div>
                            <div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-1388e95" data-id="1388e95" data-element_type="column" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                        <div class="elementor-widget-wrap elementor-element-populated">
                                            <div class="elementor-element elementor-element-9afa787 elementor-widget__width-auto elementor-widget elementor-widget-heading" data-id="9afa787" data-element_type="widget" data-widget_type="heading.default">
                            <div class="elementor-widget-container">
                        <h2 class="elementor-heading-title elementor-size-default">' . esc_html($user->first_name) . '</h2>   </div>
                            </div>
                            <div class="elementor-element elementor-element-fb6be4e elementor-widget__width-auto elementor-widget elementor-widget-heading" data-id="fb6be4e" data-element_type="widget" data-widget_type="heading.default">
                            <div class="elementor-widget-container">
                        <h2 class="elementor-heading-title elementor-size-default">$' . $user->rate . '/h</h2>   </div>
                            </div>
                            <div class="elementor-element elementor-element-83d1bdc elementor-widget elementor-widget-text-editor" data-id="83d1bdc" data-element_type="widget" data-widget_type="text-editor.default">
                            <div class="elementor-widget-container">
                                        <p style="margin-bottom: 0px;">' . $user->address . '</p>           </div>
                            </div>
                            <div class="elementor-element elementor-element-dd97254 elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-id="dd97254" data-element_type="widget" data-widget_type="divider.default">
                            <div class="elementor-widget-container">
                                <div class="elementor-divider">
                        <span class="elementor-divider-separator">
                                    </span>
                    </div>
                            </div>
                            </div>
                            <div class="elementor-element elementor-element-4608643 elementor-widget elementor-widget-text-editor" data-id="4608643" data-element_type="widget" data-widget_type="text-editor.default">
                            <div class="elementor-widget-container " title="' . $user->phrase . '">
                            <h6 class="custom-ellipes">' . $user->phrase . ' </h6>
                                                   </div>
                            </div>
                            <div class="elementor-element elementor-element-cc317aa elementor-widget__width-initial elementor-widget elementor-widget-text-editor" data-id="cc317aa" data-element_type="widget" data-widget_type="text-editor.default">
                            <div class="elementor-widget-container">
                                        Reviews           </div>
                            </div>
              <div class="elementor-element elementor-element-89365ec elementor-widget__width-initial elementor-widget elementor-widget-heading" data-id="89365ec" data-element_type="widget" data-widget_type="heading.default">
                            <div class="elementor-widget-container">
                        <h2 class="elementor-heading-title elementor-size-default">(2)</h2>   </div>
                            </div>
                            <div class="elementor-element elementor-element-24163d5 elementor-widget__width-initial elementor-widget elementor-widget-text-editor" data-id="24163d5" data-element_type="widget" data-widget_type="text-editor.default">
                            <div class="elementor-widget-container">
                                        Rating            </div>
                            </div>
                            
                            <div class="elementor-element elementor-element-b1b43e3 elementor-star-rating--align-center elementor-widget__width-initial elementor--star-style-star_fontawesome elementor-widget elementor-widget-star-rating" data-id="b1b43e3" data-element_type="widget" data-widget_type="star-rating.default">
                            <div class="elementor-widget-container">
                        
                    <div class="elementor-star-rating__wrapper">
                                    <div class="elementor-star-rating" title="5/5" itemtype="http://schema.org/Rating" itemscope="" itemprop="reviewRating"><i class="elementor-star-full"></i><i class="elementor-star-full"></i><i class="elementor-star-full"></i><i class="elementor-star-full"></i><i class="elementor-star-full"></i> <span itemprop="ratingValue" class="elementor-screen-only">5/5</span></div>    </div>
                            </div>
                            </div>
                            <div class="elementor-element elementor-element-c1ccdc2 elementor-align-left elementor-widget elementor-widget-button" data-id="c1ccdc2" data-element_type="widget" data-widget_type="button.default">
                            <div class="elementor-widget-container">
                                <div class="elementor-button-wrapper">
                        <a href="/profile/' . $user->user_nicename . '" class="elementor-button-link elementor-button elementor-size-sm" role="button">
                                    <span class="elementor-button-content-wrapper">
                                    <span class="elementor-button-text">Book Now</span>
                                    
                    </span>
                                </a>
                    </div>
                            </div>
                            </div>
                            </div>
                    </div>
                                        </div>
                    </section>
                                </div>
                    </div>';
        $counter++;
        if ($counter % 2 == 0) {
            $html .= '</div>
                        </section>';
        }
        //             }
        //         } // end if
    }
    $total_user = $user_query->total_users;
    $total_pages = ceil($total_user / $no);


    $html .= '</div>';
    $html .= paginate_links(array(
        'base' => get_pagenum_link(1) . '%_%',
        'format' => '?paged=%#%',
        'current' => $paged,
        'total' => $total_pages,
        'prev_text' => 'Previous',
        'next_text' => 'Next'
    ));
    return $html;
}


function task_enqueue_scripts()
{
    /* JavaScript Localizetion For call the url in js “admin_ajax.php”; */
    wp_enqueue_script('Your_jsFilename', get_stylesheet_directory_uri() . '/assets/js/ajax.js', array('jquery'), null, true);
    wp_localize_script('Your_jsFilename', 'ajax_object', array('ajaxurl' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'task_enqueue_scripts');
// handel req of wpadmin request here and send a respons
add_action('wp_ajax_my_action_filter', 'tripper_filter');
add_action('wp_ajax_nopriv_my_action_filter', 'tripper_filter');


function tripper_filter()
{

    parse_str($_POST['form'], $data);


    $knowladge_level = [];
    $gender = [];
    $certifactions = [];
    $meta_query = [];
    $rate = [];
    $aceept_large_group = [];
    $or_meta = ['relation' => 'OR'];
    $or_day_meta = ['relation' => 'OR'];
    $days = [];
    $cities = [];
    foreach ($data as $key => $value) {

        if ($key == 'knowl_level' && count($value) > 0) {
            foreach ($value as $knowlkey => $knowlvalue) {
                array_push($knowladge_level, $knowlvalue);
            }
            array_push($meta_query, ['key' => 'knowledge_level', 'value' => implode(',', $knowladge_level), 'compare' => 'IN']);
        }
        if ($key == 'gender' && count($value) > 0) {
            foreach ($value as $genderkey => $gendervalue) {
                array_push($gender, $gendervalue);
            }
            array_push($meta_query, ['key' => 'gender', 'value' => implode(',', $gender), 'compare' => 'IN']);
        }
        if ($key == 'cities' && count($value) > 0) {
            foreach ($value as $citieskey => $citiesvalue) {
                array_push($cities, $citiesvalue);
            }
            array_push($meta_query, ['key' => 'cities', 'value' => implode(',', $cities), 'compare' => 'IN']);
        }
        if ($key == 'breweriess' && count($value) > 0) {
            array_push($meta_query, ['key' => 'breweries', 'value' => $value, 'compare' => 'LIKE']);
        }
        if ($key == 'rate' && count($value) > 0) {
            foreach ($value as $ratekey => $ratevalue) {
                array_push($rate, $ratevalue);
            }
            array_push($meta_query, ['key' => 'rate', 'value' => implode(',', $rate), 'compare' => 'BETWEEN']);
        }
        // if ($key == 'certifactions' && count($value) > 0 ) {
        //     foreach ($value as $certifactionekey => $certifactionvalue) {
        //         array_push($certifactions, $certifactionvalue);
        //     }
        //     array_push($meta_query, ['key' => 'certification', 'value' => implode(',', $certifactions), 'compare' => 'IN']);
        // }

        if ($key == 'aceept_large_group' && count($value) > 0) {
            foreach ($value as $aceept_large_groupkey => $aceept_large_groupvalue) {
                array_push($aceept_large_group, $aceept_large_groupvalue);
            }
            array_push($meta_query, ['key' => 'accept_large_group', 'value' => implode(',', $aceept_large_group), 'compare' => 'IN']);
        }
        if ($key == 'days' && !empty($value)) {
            foreach ($value as $dk => $daysvalue) {
                array_push($days, $daysvalue);
            }
            foreach ($days as   $values) {
                array_push($or_day_meta, ['meta_key' => 'time_slot_%_day', 'value' => $values, 'compare' => 'LIKE']);
            }
            array_push($meta_query, $or_day_meta);
        }
        if ($key == 'certifications' && !empty($value)) {

            foreach ($value as $k => $certificationsvalue) {
                array_push($certifactions, $certificationsvalue);
                // array_push($meta_query, ['key' => 'certifications', 'value' => implode(',', $certifications), 'compare' => 'LIKE']);
                // 

            }



            foreach ($certifactions as   $values) {
                array_push($or_meta, ['key' => 'certification', 'value' => $values, 'compare' => 'LIKE']);
            }
            array_push($meta_query, $or_meta);
        }
    }

    $args = array(
        'role'    => 'Tripper',
        'orderby' => 'user_nicename',
        'order'   => 'ASC',
        'meta_query' => $meta_query,
    );
    $users = get_users($args);

    $html = '';
    $counter = 0;
    foreach ($users as $user) {
        $gander = get_user_meta($user->ID, 'gender', true);
        $knowledge_level = get_user_meta($user->ID, 'knowledge_level', true);
        $gravatar_image      = get_avatar_url($user->ID, $args = null);
        $profile_picture_url = get_user_meta($user->ID, 'profile_image', true);

        if (is_numeric($profile_picture_url)) {
            $profile_picture_url  = wp_get_attachment_url($profile_picture_url);
        }
        $image = (!empty($profile_picture_url)) ? $profile_picture_url : $gravatar_image;



        if ($counter % 2 == 0) {
            $html .= '<section class="elementor-section kamran elementor-inner-section elementor-element elementor-element-2fde435 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="2fde435" data-element_type="section">
        <div class="elementor-container elementor-column-gap-default">';
        }

        $html .= '<div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-4dc462a" data-id="4dc462a" data-element_type="column">
        <div class="elementor-widget-wrap elementor-element-populated">
                            <section class="elementor-section elementor-inner-section elementor-element elementor-element-e27b870 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="e27b870" data-element_type="section">
                    <div class="elementor-container elementor-column-gap-default">
                <div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-08dca54" data-id="08dca54" data-element_type="column">
        <div class="elementor-widget-wrap elementor-element-populated">
                            <div class="elementor-element elementor-element-b4b744b elementor-widget elementor-widget-image" data-id="b4b744b" data-element_type="widget" data-widget_type="image.default">
            <div class="elementor-widget-container">
            <a href ="/profile/' . $user->user_nicename . '" >
                <img width="192" height="210" src="' . esc_url($image) . '" class="attachment-large custom-img-set size-large" alt="" loading="lazy">
                </a>                              
            </div>
            </div>
                </div>
    </div>
            <div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-1388e95" data-id="1388e95" data-element_type="column" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
        <div class="elementor-widget-wrap elementor-element-populated">
                            <div class="elementor-element elementor-element-9afa787 elementor-widget__width-auto elementor-widget elementor-widget-heading" data-id="9afa787" data-element_type="widget" data-widget_type="heading.default">
            <div class="elementor-widget-container">
        <h2 class="elementor-heading-title elementor-size-default">' . esc_html($user->first_name) . '</h2>   </div>
            </div>
            <div class="elementor-element elementor-element-fb6be4e elementor-widget__width-auto elementor-widget elementor-widget-heading" data-id="fb6be4e" data-element_type="widget" data-widget_type="heading.default">
            <div class="elementor-widget-container">
        <h2 class="elementor-heading-title elementor-size-default">$' . $user->rate . '/h</h2>   </div>
            </div>
            <div class="elementor-element elementor-element-83d1bdc elementor-widget elementor-widget-text-editor" data-id="83d1bdc" data-element_type="widget" data-widget_type="text-editor.default">
            <div class="elementor-widget-container">
                        <p style="margin-bottom:0px;">' . $user->address . '</p>           </div>
            </div>
            <div class="elementor-element elementor-element-dd97254 elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-id="dd97254" data-element_type="widget" data-widget_type="divider.default">
            <div class="elementor-widget-container">
                <div class="elementor-divider">
        <span class="elementor-divider-separator">
                    </span>
    </div>
            </div>
            </div>
            <div class="elementor-element elementor-element-4608643 elementor-widget elementor-widget-text-editor" data-id="4608643" data-element_type="widget" data-widget_type="text-editor.default">
            <div class="elementor-widget-container custom-ellipes">
                        ' . $user->phrase . '            </div>
            </div>
            <div class="elementor-element elementor-element-cc317aa elementor-widget__width-initial elementor-widget elementor-widget-text-editor" data-id="cc317aa" data-element_type="widget" data-widget_type="text-editor.default">
            <div class="elementor-widget-container">
                        Reviews           </div>
            </div>
            <div class="elementor-element elementor-element-89365ec elementor-widget__width-initial elementor-widget elementor-widget-heading" data-id="89365ec" data-element_type="widget" data-widget_type="heading.default">
            <div class="elementor-widget-container">
        <h2 class="elementor-heading-title elementor-size-default">(2)</h2>   </div>
            </div>
            <div class="elementor-element elementor-element-24163d5 elementor-widget__width-initial elementor-widget elementor-widget-text-editor" data-id="24163d5" data-element_type="widget" data-widget_type="text-editor.default">
            <div class="elementor-widget-container">
                        Rating            </div>
            </div>
            <div class="elementor-element elementor-element-b1b43e3 elementor-star-rating--align-center elementor-widget__width-initial elementor--star-style-star_fontawesome elementor-widget elementor-widget-star-rating" data-id="b1b43e3" data-element_type="widget" data-widget_type="star-rating.default">
            <div class="elementor-widget-container">
        
    <div class="elementor-star-rating__wrapper">
                    <div class="elementor-star-rating" title="5/5" itemtype="http://schema.org/Rating" itemscope="" itemprop="reviewRating"><i class="elementor-star-full"></i><i class="elementor-star-full"></i><i class="elementor-star-full"></i><i class="elementor-star-full"></i><i class="elementor-star-full"></i> <span itemprop="ratingValue" class="elementor-screen-only">5/5</span></div>    </div>
            </div>
            </div>
            <div class="elementor-element elementor-element-c1ccdc2 elementor-align-left elementor-widget elementor-widget-button" data-id="c1ccdc2" data-element_type="widget" data-widget_type="button.default">
                <div class="elementor-widget-container">
                    <div class="elementor-button-wrapper">
            <a href="/profile/' . $user->user_nicename . '" class="elementor-button-link elementor-button elementor-size-sm" role="button">
                        <span class="elementor-button-content-wrapper">
                        <span class="elementor-button-text">Book Now</span>
                        
        </span>
                    </a>
        </div>
                </div>
                </div>
                </div>
    </div>
                        </div>
    </section>
                </div>
    </div>';
        $counter++;
        if ($counter % 2 == 0) {
            $html .= '</div>
        </section>';
        }
    } // end users loop



    // Previous page


    wp_send_json_success($html);
} // end function


// =========================== Zip Code Ajax Start ===============================
function task_enqueue_scripts2()
{
    /* JavaScript Localizetion For call the url in js “admin_ajax.php”; */
    wp_enqueue_script('Your_jsFilename', get_stylesheet_directory_uri() . '/assets/js/ajax.js', array('jquery'), null, true);
    wp_localize_script('Your_jsFilename', 'ajax_object', array('ajaxurl' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'task_enqueue_scripts2');
// handel req of wpadmin request here and send a respons
add_action('wp_ajax_my_action', 'zip_code');
add_action('wp_ajax_nopriv_my_action', 'zip_code');



function zip_code()
{


    $breweries_zip = array(
        'post_type' => 'brewery',
        'meta_query' => array(
            array(
                'key' => 'zip',
                'value' => $_POST['zip'],
                'compare' => '=',
            )
        )
    );


    $brewery_data_zip   = new Wp_Query($breweries_zip);


    $html = '<option value="">Select Brewery</option>';
    while ($brewery_data_zip->have_posts()) {

        $brewery_data_zip->the_post();

        $brewery_name = get_field('name');
        $id = get_the_ID();
        $html .= '<option value="' . $id . '">' . $brewery_name . '</option>';
    }
    wp_send_json_success($html);
}







// =========================== City Ajax Start ===============================

function task_enqueue_scripts3()
{
    /* JavaScript Localizetion For call the url in js “admin_ajax.php”; */
    wp_enqueue_script('Your_jsFilename', get_stylesheet_directory_uri() . '/assets/js/ajax.js', array('jquery'), null, true);
    wp_localize_script('Your_jsFilename', 'ajax_object', array('ajaxurl' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'task_enqueue_scripts3');
// handel req of wpadmin request here and send a respons
add_action('wp_ajax_get_cities_by_state_id', 'get_cities_by_state_id');
add_action('wp_ajax_nopriv_get_cities_by_state_id', 'get_cities_by_state_id');

function get_cities_by_state_id()
{
    $cites = get_the_terms($_POST['state'], 'city_category' );
    $html = '<option value="">Select City</option>';
    if ($cites) {
        foreach ($cites as $key => $city) {
            $html .= '<option value="' . $city->term_id . '">' . $city->name . '</option>';
        }
    }
    wp_send_json_success($html);
}


function task_enqueue_scripts5()
{
    /* JavaScript Localizetion For call the url in js “admin_ajax.php”; */
    wp_enqueue_script('Your_jsFilename', get_stylesheet_directory_uri() . '/assets/js/ajax.js', array('jquery'), null, true);
    wp_localize_script('Your_jsFilename', 'ajax_object', array('ajaxurl' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'task_enqueue_scripts5');
// handel req of wpadmin request here and send a respons

add_action('wp_ajax_empty_session', 'empty_session');
add_action('wp_ajax_nopriv_empty_session', 'empty_session');
function empty_session(){
    unset($_SESSION['accept_terms']);
}

add_action('wp_ajax_my_action_payment', 'payment_transaction');
add_action('wp_ajax_nopriv_my_action_payment', 'payment_transaction');


function createTransactionDb($transaction_id, $slot)
{
    global $wpdb;
    $insert = $wpdb->insert($wpdb->prefix . 'transaction', array(
        'user_id' => $_POST['customer_id'],
        'taster_id' => $_POST['taster_id'],
        'name' => $_POST['customer_name'],
        'email' => $_POST['customer_email'],
        'transaction_id' => $transaction_id,
        'amount' => $_POST['price'],
        'book_slot' => $slot,
        'status' => 'awaiting_terms',
    ));
    
    if ($insert) {
        wp_send_json_success(['transaction_id' => $wpdb->insert_id]);
    } else {
        wp_send_json_error($wpdb->last_error);
    }
}

add_action('wp_ajax_update_trip', 'tripUpdate');
add_action('wp_ajax_nopriv_update_trip', 'tripUpdate');

    function tripUpdate(){
        global $wpdb;
        $transaction_id= $_POST['transaction_id'];
        $status= $_POST['status'];
        $where = " Where transaction_id = $transaction_id ";

        $wpdb->query(
            $wpdb->prepare("UPDATE " . $wpdb->prefix . "transaction SET `status`='" . $status."'" .$where )
        );
        echo $wpdb->last_query;
        return wp_send_json_success(['query' => $wpdb->last_query]);

    }

    add_action('wp_ajax_rate_us', 'rateUs');
    add_action('wp_ajax_nopriv_rate_us', 'rateUs');
    
    function rateUs(){
        global $wpdb;
        $insert = $wpdb->insert($wpdb->prefix . 'rating', array(
            'user_id' => $_POST['customer_id'],
            'tester_id' => $_POST['tester_id'],
            'rating' =>  $_POST['rating'],
            'transaction_id' => $_POST['transaction_id'],
        ));
        
        if ($insert) {
            createTransaction();
            wp_send_json_success(['rating_id' => $wpdb->insert_id]);
        } else {
            wp_send_json_error($wpdb->last_error);
        }
        
    }

add_action('wp_ajax_create_escrow_user', 'createEscrowUser');
add_action('wp_ajax_nopriv_create_escrow_user', 'createEscrowUser');
function createEscrowUser()
{
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.escrow-sandbox.com/2017-09-01/customer',
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_USERPWD => 'herry.chris2@yopmail.com:2875_3I7GLKPcJPnXy5864uv5gYnS5rJxT0G94tu1ClFtoMCVRXRsrR8VD2j7sfDCFKzu',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
        CURLOPT_POSTFIELDS => json_encode(
            array(
                'phone_number' => $_POST['phone'],
                'first_name' => $_POST['customer_first_name'],
                'last_name' => $_POST['customer_last_name'],
                'middle_name' => $_POST['customer_middle_name'],
                'address' => array(
                    'city' => $_POST['city'],
                    'post_code' => $_POST['postal_code'],
                    'country' => $_POST['currency'],
                    'line1' => $_POST['address_line1'],
                    'line2' => $_POST['address_line2'],
                    'state' => $_POST['state'],
                ),
                'email' => $_POST['customer_email'],
            )
        )
    ));
    $output = curl_exec($curl);
    $result = json_decode($output, true);

    if (isset($result['errors'])) {
        // wp_send_json_success($output);
        wp_send_json_error($result['errors']);
    } else if (isset($result['error'])) {
        $user_id = $_POST['customer_id'];
        //user insert in db
        if (!matchUser($user_id)) {
            insertEscrowUser($escrow_id = null);
        }
        //create transaction       
        createTransaction();
    } else {
        $escrow_id = $result['id'];
        insertEscrowUser($escrow_id);
        wp_send_json_success($output);
    }

    curl_close($curl);
    // insertEscrowUser()
}
function insertEscrowUser($escrow_id)
{
    global $wpdb;
    $insert = $wpdb->insert($wpdb->prefix . 'escrow_user', array(
        'user_id' => $_POST['customer_id'],
        'escrow_id' => $escrow_id,
        'email_address' => $_POST['customer_email'],
        'phone' => $_POST['phone'],
        'first_name' => $_POST['customer_first_name'],
        'last_name' => $_POST['customer_last_name'],
        'middle_name' => $_POST['customer_middle_name'],
        'country' => $_POST['country'],
        'price' => $_POST['price'],
        'address_line1' => $_POST['address_line1'],
        'address_line2' =>  $_POST['address_line2'],
        'state' => $_POST['state'],
    ));
    
    if ($insert) {
        createTransaction();
        wp_send_json_success(['transaction_id' => $wpdb->insert_id]);
    } else {
        wp_send_json_error($wpdb->last_error);
    }
}
function matchUser($user_id)
{
    global $wpdb;
    $currentSql = "SELECT * FROM " . $wpdb->prefix . "escrow_user where user_id = $user_id";
    $currentResult = $wpdb->get_results($currentSql);
    if ($currentResult) {
        return $currentResult[0];
    } else {
        return false;
    }
}

function createTransaction()
{
    $broker_fee = $_POST['price']*0.2;
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.escrow-sandbox.com/2017-09-01/transaction',
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_USERPWD => 'herry.chris2@yopmail.com:2875_3I7GLKPcJPnXy5864uv5gYnS5rJxT0G94tu1ClFtoMCVRXRsrR8VD2j7sfDCFKzu',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
        CURLOPT_POSTFIELDS => json_encode(
            array(
                'currency' => 'usd',
                'items' => array(
                    array(
                        'description' => 'Booking Request : ' . $_POST['slot'],
                        'schedule' => array(
                            array(
                                'payer_customer' => 'me',
                                // 'payer_customer' => $_POST['customer_email'],
                                'amount' => $_POST['price'],
                                'beneficiary_customer' => 'herry.chris2@yopmail.com',
                            ),
                        ),
                        'title' => 'Booking Request : ' . $_POST['slot'],
                        'inspection_period' => '259200',
                        'type' => 'general_merchandise',
                        'quantity' => '1',
                    array(
                        'type' => 'broker_fee',
                        'schedule' => array(
                            array(
                                'payer_customer' => $_POST['customer_email'],
                                'amount' => $broker_fee ,
                                'beneficiary_customer' => 'me',
                            ),
                        ),
                    ),
                        'extra_attributes' => array(
                            'image_url' => esc_url(site_url('/wp-content/uploads/2022/10/anthony.png')),
                            'merchant_url' => 'http://beertrippr.hailogics.com/'
                        ),
                    ),
                ),
                'description' => 'Booking Request : ' . $_POST['slot'],
                'parties' => array(
                    array(
                        'customer' => 'me',
                        'role' => 'broker',
                ),
                array(
                    'customer' => $_POST['taster_email'],
                        'role' => 'seller',
                    ),
                    array(
                        'customer' => $_POST['customer_email'],
                        'role' => 'buyer',
                    ),
                ),
            )
        )
    ));

    $user = wp_get_current_user();
        if(in_array('subscriber', $user->roles)){
            if (!session_id()) {
                session_start();
            }
            
            $_SESSION['accept_terms']="Please accept the terms below to confirm the payment for the trip";
        }

    $output = curl_exec($curl);
    $result = json_decode($output, true);

    if (isset($result['null'])) {
        // wp_send_json_success($output);
        wp_send_json_error($output);
    } else {
        $transaction_id = $result['id'];
        createTransactionDb($transaction_id, $_POST['slot']);
        setcookie('transaction_msg', 'Your booking has been created successfully.', strtotime('+1 day'));
        wp_send_json_success($output);
    }
    // wp_send_json_success($output);
    curl_close($curl);
}

function payment_transaction()
{
    global $wpdb;
    $user_id = $_POST['customer_id'];
    $slot = date('Y-m-d h:i:s', strtotime($_POST['slot']));
    $taster_id = $_POST['taster_id'];
    $where = " Where `taster_id`=$taster_id AND `book_slot`=$slot";

    $transactionSql = "SELECT * FROM " . $wpdb->prefix . "transaction " . $where . " AND `status` in('Pending', 'awaiting_terms' ,'awaiting_payment') ";
    $transactionResult = $wpdb->get_results($transactionSql);

    if (empty($transactionResult)) {

        //check user 
        $user_details = matchUser($user_id);
        if (!$user_details) {
            // //createuser
            // $user = get_queried_object();
            // $customer = wp_get_current_user();
            wp_send_json_error('User does not exist.');
        } else {
            //create transaction
            //getting $user_details from form
            $response = createTransaction($user_details);
            wp_send_json_success($response);
        }
    } else {
        wp_send_json_error('Slot already exist.');
    }
}

add_action(
    'rest_api_init',
    function () {
        register_rest_route('beertrippr/v1', '/posts/', array(
            'methods' => 'POST',
            'callback' => 'webhooksEscrowTransaction',
            'permission_callback' => '__return_true'
        ));
    }
);

add_action('wp_head', 'custom_javascript');

function custom_javascript()
{
?>
<script>
// $('.sc-bdVaJa').click(function(){
//     alert("teert");
// });
function getVals() {
    // Get slider values
    let parent = this.parentNode;
    let slides = parent.getElementsByTagName("input");
    let slide1 = parseFloat(slides[0].value);
    let slide2 = parseFloat(slides[1].value);
    // Neither slider will clip the other, so make sure we determine which is larger
    if (slide1 > slide2) {
        let tmp = slide2;
        slide2 = slide1;
        slide1 = tmp;
    }

    let displayElement = parent.getElementsByClassName("rangeValues")[0];
    displayElement.innerHTML = "$" + slide1 + " - $" + slide2;
}

window.onload = function() {
    // Initialize Sliders
    let sliderSections = document.getElementsByClassName("range-slider");
    for (let x = 0; x < sliderSections.length; x++) {
        let sliders = sliderSections[x].getElementsByTagName("input");
        for (let y = 0; y < sliders.length; y++) {
            if (sliders[y].type === "range") {
                sliders[y].oninput = getVals;
                // Manually trigger event first time to display values
                sliders[y].oninput();
            }
        }
    }
}

/* Bootstrap 5 JS included */
/* vanillajs-datepicker 1.1.4 JS included */

const getDatePickerTitle = elem => {
    // From the label or the aria-label
    const label = elem.nextElementSibling;
    let titleText = '';
    if (label && label.tagName === 'LABEL') {
        titleText = label.textContent;
    } else {
        titleText = elem.getAttribute('aria-label') || '';
    }
    return titleText;
}
</script>
<script src="https://code.jquery.com/jquery-3.6.1.min.js"
    integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>

<script src="https://www.jqueryscript.net/demo/pick-hours-availability-calendar/js/mark-your-calendar.js"></script>

<!-- Datepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

<script>
$(function() {
    var link = $('.link').val();
    var cancelLink = $('.cancelLink').val();

    $('.action_btn').click(function(event) {
        link = $(this).closest('.accordion-body').find('.link').val();
        $(location).attr('href', link);
    });
    $('.cancel_trip_btn').click(function(event) {
        cancelLink = $(this).closest('.accordion-body').find('.cancelLink').val();
        $(location).attr('href', cancelLink);
    });

    $('.start_trip_btn').click(function(event) {
        // console.log("here");
        var transaction_id = $(this).closest('.accordion-body').find('.transacionid').val();
        var payload = {
            'action': 'update_trip',
            transaction_id: transaction_id,
            status: 'started'
        };

        $.ajax({
            url: ajax_object.ajaxurl,
            type: "POST",
            data: payload,
            cache: false,
            success: function(response) {
                if (response.success) {
                    alert('transaction successfully updated');
                    $(location).attr('href',
                        "http://<?= $_SERVER['SERVER_NAME'] ?>/my-account/all-bookings/"
                        );
                }

            }
        });
    });

    $('#end_trip_btn').click(function(event) {
        // console.log("here");
        var transaction_id = $(this).closest('.accordion-body').find('#transacionid').val();
        var payload = {
            'action': 'update_trip',
            transaction_id: transaction_id,
            status: 'completed'
        };
        
        $.ajax({
            url: ajax_object.ajaxurl,
            type: "POST",
            data: payload,
            cache: false,
            success: function(response) {
                if (response.success) {
                    $(location).attr('href',
                        "http://<?= $_SERVER['SERVER_NAME'] ?>/my-account/all-bookings/"
                        );
                }

            }
        });
    });

    $('#rate_btn').click(
        function(event) {
            $('#ratingModal').modal('show');
        });

    var rating = $("#rating").val();
    var tester_id = $("#tester_id").val();
    var customer_id = $("#customer_id").val();
    var transaction_id = $("#transaction_id").val();

    $("#rate").click(
        function(event) {
            var payload = {
                'action': 'rate_us',
                transaction_id: transaction_id,
                rating: rating,
                tester_id: tester_id,
                customer_id: customer_id
            };
            console.log(payload);
            $.ajax({
                url: ajax_object.ajaxurl,
                type: "POST",
                data: payload,
                cache: false,
                success: function(response) {
                    if (response.success) {
                        // $(location).attr('href', "http://<?= $_SERVER['SERVER_NAME'] ?>/my-account/all-bookings/");
                    }

                }
            });
        });

        
        $(".search_city_filter").keyup(function(){
            $(this).css("background-color", "pink");
            const value = $(this).val().toLowerCase();
            $("#collapseExample5 .card.card-body.custom-check-label.cus-body.pt-3").filter(function() {
                console.log(value);
                $(this).toggle($(this).find('.tainer').text().toLowerCase().indexOf(value) > -1)
            });
        });
});


$(function() {
    $('.datepicker').datepicker({
        language: "es",
        autoclose: true,
        format: "dd/mm/yyyy"
    });

    var all_bookings_url = 'http://<?= $_SERVER['SERVER_NAME'] ?>/my-account/all-bookings/';
    $('#create-new-account').click(function(event) {
        event.preventDefault();
        const payload = {
            'action': 'create_escrow_user',
            customer_id: $('#customer_id').val(),
            taster_id: $('#taster_id').val(),
            slot: $('#selectedSlot').val(),
            customer_first_name: $('#first_name').val(),
            customer_last_name: $('#last_name').val(),
            customer_middle_name: $('#middle_name').val(),
            customer_email: $('#email').val(),
            address_line1: $('#address').val(),
            address_line2: $('#address2').val(),
            country: $('#country').val(),
            city: $('#city').val(),
            state: $('#state').val(),
            currency: $('#currency').val(),
            price: $("#price").val(),
            phone: $("#phone").val(),
            postal_code: $('#postal_code').val()
        };
        console.log(' payload escrow ', payload);
        $.ajax({
            url: ajax_object.ajaxurl,
            type: "POST",
            data: payload,
            cache: false,
            success: function(response) {
                if (response.success) {
                    $('#exampleModal').modal('hide');
                    alert("Transaction Successful");
                    //$(location).attr('href', all_bookings_url);
                } else {
                    if (response['data']['address']['post_code']) {
                        var post_code = document.getElementById("postal_code_err");
                        post_code.innerHTML = response['data']['address']['post_code'];
                        $("#postal_code").css("border-color", "red");
                    }
                    if (response['data']['address']['state']) {
                        var state = document.getElementById("state_err");
                        state.innerHTML = response['data']['address']['state'];
                        $("#state").css("border-color", "red");
                    }
                    if (response['data']['address']['line1']) {
                        var state = document.getElementById("address_err");
                        state.innerHTML = response['data']['address']['line1'];
                        $("#address").css("border-color", "red");
                    }
                    if (response['data']['address']['line2']) {
                        var state = document.getElementById("address2_err");
                        state.innerHTML = response['data']['address']['line2'];
                        $("#address2").css("border-color", "red");
                    }
                    if (response['data']['address']['city']) {
                        var state = document.getElementById("city_err");
                        state.innerHTML = response['data']['address']['city'];
                        $("#city").css("border-color", "red");
                    }
                    if (response['data']['email']) {
                        var state = document.getElementById("email_err");
                        state.innerHTML = response['data']['email'];
                        $("#email").css("border-color", "red");
                    }
                }
            }
        });

    });
});

$(function() {
    let availabilitySlots = [];
    let slots = [];
    const mondayDate =
        '<?php echo (date('D') != "Mon") ? date("Y-m-d", strtotime("last monday")) : date('Y-m-d'); ?>';
    const is_user_logged_in = '<?php echo (is_user_logged_in()) ? 1 : 0; ?>';

    <?php
            while (have_rows('time_slot')) {
                the_row();
                $day = get_sub_field('day');
                $day_of_week = date('N', strtotime($day)) - 1;
            ?>
    availabilitySlots[<?php echo $day_of_week; ?>] = [];
    <?php
                while (have_rows('from_to_time')) {
                    the_row();
                    $to = get_sub_field('to');
                    $from = get_sub_field('from');
                ?>
    availabilitySlots[<?php echo $day_of_week; ?>].push('<?php echo date("h:i", strtotime($from)); ?>');
    <?php
                }
            }
            ?>
    var todaydate = new Date();
    $('#picker').markyourcalendar({
        availability: availabilitySlots,
        isMultiple: false,
        startDate: new Date(mondayDate),
        onClick: function(ev, slot) {
            if ((new Date(slot)).valueOf() < todaydate.valueOf()) {
                $('#errorModal').find('.modal-body').text("This slot has been expired");
                $('#errorModal').modal('show');
            } else {
                ev.preventDefault();
                console.log(slot);
                $('#selectedSlot').val(slot[0]);
                $('#selected-date-slot').val(slot);
                if (is_user_logged_in == '1') {
                    if (Date.parse(slot)) {
                        $('#bookingConfirmation').find('.modal-body').text("Are you sure to book trip for " + slot[0] + "?");
                        $('#bookingConfirmation').modal('show');
                        // if (confirm("Are You Sure To Book " + slot[0] + "?")) {
                        //     //$('#payment-form').submit();    
                        // } else {
                        //     return false;
                        // }
                    } else {
                        return false;
                    }
                } else {
                    // alert('Please login for the booking.');
                    $('#loginModal').modal('show');
                }
                // $('#payment-form').submit();
            }
        },
        onClickNavigator: function(ev, instance) {
            //   var arr = [
            //     [
            //       ['4:00', '5:00', '6:00', '7:00', '8:00'],
            //       ['1:00', '5:00'],
            //       ['2:00', '5:00'],
            //       ['3:30'],
            //       ['2:00', '5:00'],
            //       ['2:00', '5:00'],
            //       ['2:00', '5:00']
            //     ],
            //     [
            //       ['2:00', '5:00'],
            //       ['4:00', '5:00', '6:00', '7:00', '8:00'],
            //       ['4:00', '5:00'],
            //       ['2:00', '5:00'],
            //       ['2:00', '5:00'],
            //       ['2:00', '5:00'],
            //       ['2:00', '5:00']
            //     ],
            //     [
            //       ['4:00', '5:00'],
            //       ['4:00', '5:00'],
            //       ['4:00', '5:00', '6:00', '7:00', '8:00'],
            //       ['3:00', '6:00'],
            //       ['3:00', '6:00'],
            //       ['3:00', '6:00'],
            //       ['3:00', '6:00']
            //     ],
            //     [
            //       ['4:00', '5:00'],
            //       ['4:00', '5:00'],
            //       ['4:00', '5:00'],
            //       ['4:00', '5:00', '6:00', '7:00', '8:00'],
            //       ['4:00', '5:00'],
            //       ['4:00', '5:00'],
            //       ['4:00', '5:00']
            //     ],
            //     [
            //       ['4:00', '6:00'],
            //       ['4:00', '6:00'],
            //       ['4:00', '6:00'],
            //       ['4:00', '6:00'],
            //       ['4:00', '5:00', '6:00', '7:00', '8:00'],
            //       ['4:00', '6:00'],
            //       ['4:00', '6:00']
            //     ],
            //     [
            //       ['3:00', '6:00'],
            //       ['3:00', '6:00'],
            //       ['3:00', '6:00'],
            //       ['3:00', '6:00'],
            //       ['3:00', '6:00'],
            //       ['4:00', '5:00', '6:00', '7:00', '8:00'],
            //       ['3:00', '6:00']
            //     ],
            //     [
            //       ['3:00', '4:00'],
            //       ['3:00', '4:00'],
            //       ['3:00', '4:00'],
            //       ['3:00', '4:00'],
            //       ['3:00', '4:00'],
            //       ['3:00', '4:00'],
            //       ['4:00', '5:00', '6:00', '7:00', '8:00']
            //     ]
            //   ]
            //   var rn = Math.floor(Math.random() * 10) % 7;
            //   instance.setAvailability(arr[rn]);
            instance.setAvailability(availabilitySlots);
        }
    });

    // ======================== create trip request ============
    $('#confirmTrasactionRequest').click(function(event){
        event.preventDefault();
        const customerName = $('#customer_name').val();
        const customerEmail = $('#customer_email').val();
        const customerId = $('#customer_id').val();
        const tasterId = $('#taster_id').val();
        const price = $('#price').val();
        const slot = $('#selectedSlot').val();
        var payload = {
            'action': 'my_action_payment',
            customer_id: customerId,
            taster_id: tasterId,
            customer_name: customerName,
            customer_email: customerEmail,
            price: price,
            slot: slot
        };
        $.ajax({
            url: ajax_object.ajaxurl,
            type: "POST",
            data: payload,
            cache: false,
            success: function(response) {
                if (response.success) {
                    window.location =
                        "http://<?= $_SERVER['SERVER_NAME'] ?>/my-account/all-bookings/";
                } else {
                    if (response['data'] == 'Slot already exist.') {
                        $('#errorModal').find('.modal-body').text("Slot already booked please choose another slot.");
                        $('#errorModal').modal('show');
                    } else {
                        $('#exampleModal').modal('show');
                    }
                }

            }
        });

    });
});
</script>
<?php
    //add new item in tester dashboard

    // add_filter('user_registration_account_menu_items', 'ur_custom_menu_items', 10, 1);
    // function ur_custom_menu_items($items)
    // {
    //     $items['all-bookings'] = __('All Bookings', 'user-registration');
    //     //$items['cancelled-bookings'] = __( 'Cancelled Bookings', 'user-registration' );
    //     return $items;
    // }
    //Adding a new endpoint:

    // add_action('init', 'user_registration_add_new_my_account_endpoint');
    // function user_registration_add_new_my_account_endpoint()
    // {
    //     add_rewrite_endpoint('all-bookings', EP_PERMALINK | EP_PAGES);
    //     //add_rewrite_endpoint( 'cancelled-bookings', EP_PAGES );
    // }
    //Adding content to a new end point:

    // function user_registration_all_bookings_endpoint_content()
    // {
    //     echo 'Your new content';
    // }
    // add_action('user_registration_account_all-bookings_endpoint', 'user_registration_all_bookings_endpoint_content');

    // function user_registration_cancelled_bookings_endpoint_content()
    // {
    //     echo 'Your new content';
    // }
    // add_action('user_registration_account_cancelled-bookings_endpoint', 'user_registration_cancelled_bookings_endpoint_content');
    add_shortcode('all_bookings', 'all_bookings_content');
    function all_bookings_content($atts)
    {

        global $wpdb;
        global $post;
        if (!session_id()) {
            session_start();
        }
        ?>
<script>
$(function() {
    const termText = '<?php echo isset($_SESSION['accept_terms']) ? $_SESSION['accept_terms'] : null ?>';
    if (termText) {
        $('#sucessfullTransaction').find('.modal-body').text(termText);
        $('#sucessfullTransaction').modal('show');

    }

    $('#sucessfullTransaction .ok-btn').click(function(event) {
        event.preventDefault();
        <?php unset($_SESSION['accept_terms']); ?>
    });

    $('.accept_term_check').click(function(event) {
        // event.preventDefault();
        const element = $(this).closest('.accordion-body').find('.btn.btn-info.accpet-color');
        console.log(element);
        if($(this).is(":checked")){
            element.removeClass('disabled');
        } else {
            element.addClass('disabled');
        }
    });

});
</script>
<?php
        $post_id =  $post->ID;
        do_action('litespeed_purge_post', $post_id);
        do_action( 'litespeed_purge_all' );
        $user = wp_get_current_user();
        $where = 'WHERE 1=1';
        $join = "";
        $username = '';
        if (in_array('subscriber', $user->roles)) {
            $tripper = false;
            $where = 'WHERE transactions.user_id=' . $user->ID;
            $join = 'INNER JOIN ' . $wpdb->prefix . 'users AS users ON  transactions.taster_id = users.id';
            $username = ', users.user_nicename, users.user_email';
        } elseif (in_array('tripper', $user->roles)) {
            $tripper = true;
            $where = 'WHERE transactions.taster_id=' . $user->ID;
            $join = 'INNER JOIN ' . $wpdb->prefix . 'users AS users ON transactions.user_id = users.id';
            $username = ', users.user_nicename, users.user_email';
        } elseif (in_array('administrator', $user->roles)) {
            // $where = 'WHERE transactions.taster_id=' . $user->ID;
            $join = 'INNER JOIN ' . $wpdb->prefix . 'users AS customer ON transactions.user_id = customer.id INNER JOIN ' . $wpdb->prefix . 'users AS taster ON transactions.taster_id = taster.id';
            $username = ', customer.user_nicename AS customer_name, customer.user_email AS customer_email, taster.user_nicename AS taster_name, taster.user_email AS taster_email';
        }
        $items_per_page = 10;
        $page = isset($_GET['cpage']) ? abs((int) $_GET['cpage']) : 1;
        $offset = ($page * $items_per_page) - $items_per_page;
        $orderBy = ' ORDER BY id DESC LIMIT ' . $offset . ', ' . $items_per_page;

        $currentSql = "SELECT transactions.*" . $username . " FROM " . $wpdb->prefix . "transaction AS transactions " . $join . " " . $where . " AND `status` in('Pending', 'awaiting_terms' ,'awaiting_payment', 'awaiting_start', 'started')" . $orderBy;
        $currentResult = $wpdb->get_results($currentSql);

        $totalQueryCurrent = "SELECT COUNT(*) FROM " . $wpdb->prefix . "transaction " . $join . " " . $where . " AND `status` in('Pending', 'awaiting_terms' ,'awaiting_payment') ";
        $currentResultCount = $wpdb->get_var($totalQueryCurrent);

        $previousSql = "SELECT transactions.*" . $username . "  FROM " . $wpdb->prefix . "transaction AS transactions " . $join . " " . $where . " AND `status`= 'Completed' " . $orderBy;
        $previousResult = $wpdb->get_results($previousSql);
        $totalQueryPrevious = "SELECT COUNT(*) FROM " . $wpdb->prefix . "transaction "  . $join . " " . $where . " AND `status`= 'Completed'";
        $previousResultCount = $wpdb->get_var($totalQueryPrevious);

        $cancelledSql = "SELECT transactions.*" . $username . "  FROM " . $wpdb->prefix . "transaction AS transactions " . $join . " " . $where . " AND `status`= 'Canceled' " . $orderBy;
        $cancelledResult = $wpdb->get_results($cancelledSql);
        $totalQueryCanceled = "SELECT COUNT(*) FROM " . $wpdb->prefix . "transaction "  . $join . " " . $where . " AND `status`= 'Canceled'";
        $canceledResultCount = $wpdb->get_var($totalQueryCanceled);

        $currentHtml = '';
        $currentCounter = 1;
        if ($currentResult) {
            foreach ($currentResult as $key => $value) {
                $user_id = (in_array('subscriber', $user->roles)) ? $value->taster_id : $value->user_id;
                $customer_name = (in_array('administrator', $user->roles)) ? $value->customer_name : $value->user_nicename;
                $customer_email = (in_array('administrator', $user->roles)) ? $value->customer_email : $value->user_email;
                $taster_name = (in_array('administrator', $user->roles)) ? $value->taster_name : $value->user_nicename;
                $taster_email = (in_array('administrator', $user->roles)) ? $value->taster_name_email : $value->user_email;
                $button = '<i class="fa fa-times"></i>Cancel Trip';
                $actionBtnClass = 'cancel-color';
                $link = "https://my.escrow-sandbox.com/myescrow/CustCancelTransaction.asp?tran=" . $value->transaction_id;
                $button2 = '';
                $badgeClass = 'badge-info';
                $gravatar_image      = get_avatar_url($user_id, $args = null);
                $profile_picture_url = get_user_meta($user_id, 'profile_image', true);

                if (is_numeric($profile_picture_url)) {
                    $profile_picture_url  = wp_get_attachment_url($profile_picture_url);
                }
                $imgUrl = (!empty($profile_picture_url)) ? $profile_picture_url : $gravatar_image;

                
                if ($value->status == 'awaiting_start' && in_array('tripper', $user->roles)) {
                    $button2 = '<button class="start_trip_btn btn btn-light accpet-color" >
                        <i  title="Start the trip" class="fa fa-play-circle-o"></i>Start Trip
                        </button>';
                    $badgeClass = 'badge-success';

                } 
                if($value->status == 'started' && in_array('tripper', $user->roles)){
                    $button2 = '<button  class="end_trip_btn btn btn-light cancel-color">
                    <i  title="End the trip" class="fa fa-stop-circle"></i>End Trip
                    </button>';
                }
                $cancelBtn="";$cancelLink="";$tag="";
                if($value->status=='awaiting_terms' && in_array('subscriber', $user->roles) ){
                    $link='https://my.escrow-sandbox.com/myescrow/TransactionConcur.asp?tran='. $value->transaction_id ;
                    $button='<i class="fa fa-check"></i>Accept Term';
                    $actionBtnClass = 'accpet-color disabled';
                    $cancelBtn='<a class="cancel_trip_btn btn btn-info cancel-color" target="_blank"><i class="fa fa-times"></i>Cancel Trip</a>';
                    $cancelLink='https://my.escrow-sandbox.com/myescrow/CustCancelTransaction.asp?tran='. $value->transaction_id;
                    $badgeClass = 'badge-info';
                }
                if($value->status=='awaiting_payment' && in_array('subscriber', $user->roles) ){
                    $link='https://www.escrow-sandbox.com/transactions/'. $value->transaction_id.'/payment';
                    $button='<i class="fa fa-check"></i>Pay Now';
                    $actionBtnClass = 'accpet-color';
                    $badgeClass = 'badge-warning';

                }
                if($value->status=='awaiting_payment' && in_array('tripper', $user->roles) ){
                    $tag="Waiting to pay.";
                    $badgeClass = 'badge-warning';
                }
                if($value->status=='awaiting_terms' && in_array('tripper', $user->roles) ){
                    $tag="Waiting to agree terms.";
                    $badgeClass = 'badge-info';
                }

                if(strtolower($value->status)=='canceled' ){
                    $badgeClass = 'badge-danger';
                }
                $checkedTerm = 'checked disabled';
                if($value->status=='awaiting_terms' ){
                    $checkedTerm = '';
                }
 
                $paymentBadge = (strtolower($value->payment_status) == 'unpaid') ? 'badge-danger' : 'badge-success';
                $currentHtml .= '<tr>
                <th scope="row">' . $currentCounter . '</th>
                <td>' . $customer_name . '</td>
                <td>' . $customer_email . '</td>
                <td><span class="badge badge-pill '.$badgeClass.'">' . ucwords(str_replace("_"," ", $value->status)) . '</span></td>
                <td> $' . number_format("$value->amount", 2) . '</td>
                <td><button class="accordion-button collapsed cus-details-td-btn" data-bs-toggle="collapse" data-bs-target="#collapse' . $currentCounter . '" aria-expanded="false" aria-controls="collapse' . $currentCounter . '" style="cursor: pointer;">More info</button>
                </td>
               <tr> 
			   <td class="td-pading-off"></td>
               <td colspan="10" class="cus-td-set">
               <div class="collapse" id="collapse' . $currentCounter . '">
                  <div class="accordion-body">
                  <div class="custom-set-td-btn">
                    <div class="custom-toggle-info">
					  <div class="row">
					   <div class="col-7 ">
					    <div class="flex-setting">
					     <div class="more-info-drop-img">
					       <img src="'.$imgUrl.'" alt="'.$customer_name.'">
					     </div>
					     <div class="more-info-drop-details">
					       <p>Name:<span>' . $customer_name . '</span></p>
					       <p>Email:<span>' . $customer_email . '</span></p>
					       <p>Transaction ID:<span>' . $value->transaction_id . '</span></p>
					     </div>
						 </div>
						 <label class="tainer">I Have read & accepted the <a href="#" data-bs-toggle="modal" data-bs-target="#termsConditionModal">Terms & Conditions</a>
					    <input class="certifaction accept_term_check" type="checkbox" name="" value="" '.$checkedTerm.'>
					    <span class="checkmark"></span>
					  </label>
					   </div>
					   <div class="col-4">
					     <div class="more-info-drop-box">
					       <h5>Booking Slot</h5>
					       <p>'.date('D - M - Y / h:ia', strtotime($value->book_slot)).'</p>
					     </div>
					     <div class="more-info-drop-box">
					       <h5>Payment Status</h5>
					       <p><span class="badge badge-pill '.$paymentBadge.'">' . ucwords(str_replace("_"," ", $value->payment_status)) . '</span></p>
					     </div>
					   </div>
					  </div>
					  
					  <div class="modal fade" id="termsConditionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					    <div class="modal-dialog modal-dialog-centered">
					      <div class="modal-content">
					        <div class="modal-header cus-modal-header-set">
							<img src="/wp-content/uploads/2022/08/logo.png">
					          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					        </div>
					        <div class="modal-body">
					        <h3>Terms & Conditions</h3>
					        <p>
					          Lorem ipsum dolor, sit amet consectetur adipisicing elit. Blanditiis atque voluptate eum voluptatum sit hic dignissimos fuga, unde dolores molestiae doloribus quibusdam repellat aliquam saepe omnis in commodi? Quibusdam, voluptatum.</p>
					        </div>
					      </div>
					    </div>
					  </div>
					</div>
                        <a class="action_btn btn btn-info '.$actionBtnClass.'" target="_blank">'.$button.'</a>
                        <input type="hidden" name="link" class="link" value="' . $link . '">
                        '.$cancelBtn.'
                        <input type="hidden" name="cancelLink" class="cancelLink" value="' . $cancelLink . '">
                        <input type="hidden" name="transacionid" class="transacionid" value="' . $value->transaction_id . '">
                        '.$button2.'
                    </div>
                  </div>
                </div>
                </td>
                </tr>
                </tr>
            ';
                $currentCounter++;
            }
        } else {
            $currentHtml = '<tr>
            <td colspan="8">No booking found.</td>
            </tr>';
        }

        $previousHtml = '';
        $review='';$reviewCol='';
        if(in_array('subscriber', $user->roles)){
            $review='<td>
            <a id="rate_btn" class="btn btn-light accpet-color">
                <i title="Rate trip" class="fa fa-star"></i>
            </a>
            </td>';
            $reviewCol='<th scope="col">Review</th>';
         }
         if(in_array('tripper', $user->roles)){
            $review='<td>
            <a id="rate_btn" class="btn btn-light accpet-color">
                <i title="Rate trip" class="fa fa-star"></i>
            </a>
            </td>';
            $reviewCol='<th scope="col">Review</th>';
         }
        $previousCounter = 1;
        if ($previousResult) {
            foreach ($previousResult as $key => $value) {
                ($tripper == true) ? $name = $value->user_nicename : $name = $value->name;
                $previousHtml .= '<tr>
                <th scope="row">' . $previousCounter . '</th>
                <td>' . $name . '</td>
                <td>' . $value->email . '</td>
                <td>' . $value->transaction_id . '</td>
                <td>' . number_format("$value->amount", 2) . '</td>              
                <td>' . date("d M, Y h:m a", strtotime($value->book_slot)) . '</td>'.$review.'
                <td><span class="badge badge-pill '.$badgeClass.'">' . ucwords(str_replace("_"," ", $value->status)) . '</span></td>
                <td><button class="accordion-button collapsed cus-details-td-btn" data-bs-toggle="collapse" data-bs-target="#collapse' . $previousCounter . '" aria-expanded="false" aria-controls="collapse' . $currentCounter . '" style="cursor: pointer;">More info</button>
                </td>
               <tr>
               <td class="td-pading-off"></td> 
               <td colspan="10" class="cus-td-set">
               <div class="collapse" id="collapse' . $previousCounter . '">
                  <div class="accordion-body">
                   <div class="row">
                    <div class="col-6">' . $customer_email . '</div>
                    <div class="col-6">'. $tag .'</div>
                   </div>
                  </div>
                </div>
                </td>
                </tr>
              </tr>';
                $previousCounter++;
            }
        } else {
            $previousHtml = '<tr>
            <td colspan="7">No booking found.</td>
            </tr>';
        }

        $cancelledHtml = '';
        $cancelledCounter = 1;
        if ($cancelledResult) {
            foreach ($cancelledResult as $key => $value) {
                ($tripper == true) ? $name = $value->user_nicename : $name = $value->name;
                $cancelledHtml .= '<tr>
                <th scope="row">' . $cancelledCounter . '</th>
                <td>' . $name . '</td>               
                <td>' . $value->email . '</td>
                <td>' . $value->transaction_id . '</td>
                <td>' . number_format("$value->amount", 2) . '</td>
                <td>' . date("d M, Y h:m a", strtotime($value->book_slot)) . '</td>
                <td><span class="badge badge-pill badge-danger">' . ucwords(str_replace("_"," ", $value->status)) . '</span></td>
                <td><button class="accordion-button collapsed cus-details-td-btn" data-bs-toggle="collapse" data-bs-target="#collapse' . $cancelledCounter . '" aria-expanded="false" aria-controls="collapse' . $currentCounter . '" style="cursor: pointer;">More info</button>
                </td>
               <tr> 
               <td class="td-pading-off"></td>
               <td colspan="10" class="cus-td-set">
               <div class="collapse" id="collapse' . $cancelledCounter . '">
                  <div class="accordion-body">
                   <div class="row">
                    <div class="col-6">' . $customer_email . '</div>
                    <div class="col-6">'. $tag .'</div>
                   </div>
                  </div>
                </div>
                </td>
                </tr>
              </tr>';
                $cancelledCounter++;
            }
        } else {
            $cancelledHtml = '<tr>
            <td colspan="7">No booking found.</td>
            </tr>';
        }

        $user = get_queried_object(); // Tripper
        $customer = wp_get_current_user(); // User
        $html = '

        <div class="modal fade" id="ratingModal" tabindex="-1" aria-labelledby="ratingModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <img class="custom-modal-logo" src="/wp-content/uploads/2022/10/svg-esp-1.png">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background-color: transparent !important;"></button>
                  </div>
                  <div class="modal-body custom-modal-input" id="ratingModalBody">
                    <input type="text" id="rating" placeholder="Please enter rating e.g: 1-5">
                    <input type="hidden" name="customer_id" id="customer_id" value="' . $customer->ID . '">
                    <input type="hidden" name="taster_id" id="taster_id" value="' . $user->ID . '">
                  </div>
                  <div class="modal-footer">
                    <button type="button" id="rate" class="btn btn-primary custom-modal-btn">OK</button>
                  </div>
                </div>
              </div>
            </div>

<div class="modal fade" id="sucessfullTransaction" tabindex="-1" aria-labelledby="sucessfullTransactionLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header cus-modal-header-set">
        <img src="/wp-content/uploads/2022/08/logo.png">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure ?
      </div>
      <div class="modal-footer calen-cus-btn">
        <button type="button" class="btn btn-primary ok-btn" data-bs-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>
		<ul class="nav nav-tabs custom-tabs-set" id="myTab" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Current</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Previous</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Canceled</button>
      </li>
    </ul>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Professionals</th>
            <th scope="col">Brewery</th>
            <th scope="col">Status</th>
            <th scope="col">Total Cost</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          ' . $currentHtml . '
        </tbody>
      </table>
      <div class="pagination" >
      '
            .
            paginate_links(array(
                'base' => add_query_arg('cpage', '%#%'),
                'format' => '',
                'prev_text' => __('&laquo;'),
                'next_text' => __('&raquo;'),
                'total' => ceil($currentResultCount / $items_per_page),
                'current' => $page
            ))
            .
            '
      </div>
      </div>
      <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Transaction ID</th>
            <th scope="col">Amount</th>
            <th scope="col">Booked Slot</th>'.
            $reviewCol . '
            <th scope="col">Status</th>
            <th scope="col">Details</th>
          </tr>
        </thead>
        <tbody>
          ' . $previousHtml . '
        </tbody>
      </table>
      <div class="pagination" >
      '
            .
            paginate_links(array(
                'base' => add_query_arg('cpage', '%#%'),
                'format' => '',
                'prev_text' => __('&laquo;'),
                'next_text' => __('&raquo;'),
                'total' => ceil($previousResultCount / $items_per_page),
                'current' => $page
            ))
            .
            '
      </div>
      </div>
      <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
        <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Transaction ID</th>
            <th scope="col">Amount</th>
            <th scope="col">Booked Slot</th>
            <th scope="col">Status</th>
            <th scope="col">Details</th>
          </tr>
        </thead>
        <tbody>
        ' . $cancelledHtml . '
        </tbody>
      </table>
      <div class="pagination" >
      '
            .
            paginate_links(array(
                'base' => add_query_arg('cpage', '%#%'),
                'format' => '',
                'prev_text' => __('&laquo;'),
                'next_text' => __('&raquo;'),
                'total' => ceil($canceledResultCount / $items_per_page),
                'current' => $page
            ))
            .
            '
      </div>
      </div>
    </div>';
        return $html;
    }

    add_shortcode('payment_thank_you', 'payment_thank_you_content');
    function payment_thank_you_content($atts)
    {
        echo '<h2 style="color:green; text-align:center;">Thank you for your payment</h2> <br> <h5 style="text-align:center;">You can check details in <a style="color:#e3bd1f;" href="/my-account">My Account</a> section.</h5>';
        echo "<pre>";
        print_r(file_get_contents("php://input"));
        echo "</pre>";
    }
}

function wpshout_add_cron_interval($schedules)
{
    $schedules['every5minute'] = array(
        'interval'  => 300, // time in seconds
        'display'   => 'Every 5 Minute'
    );
    return $schedules;
}
add_filter('cron_schedules', 'wpshout_add_cron_interval');

function fetchEscrowTransaction($transaction_id)
{
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.escrow-sandbox.com/2017-09-01/transaction/' . $transaction_id,
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_USERPWD => 'herry.chris2@yopmail.com:2875_3I7GLKPcJPnXy5864uv5gYnS5rJxT0G94tu1ClFtoMCVRXRsrR8VD2j7sfDCFKzu',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
    ));
    $output = curl_exec($curl);
    $result = json_decode($output, true);
    curl_close($curl);
    $return_arr['status']=$result['items'][0]['status'];
    $return_arr['customer_agreement']=$result['parties'][0]['agreed'];
    $return_arr['disbursed_to_beneficiary']=$result['items'][0]['schedule'][0]['status']['disbursed_to_beneficiary'];
    $return_arr['res']=$result;

    return $return_arr;
}
add_action("wp_update_transaction", "fetchTransactions");

function fetchTransactions()
{
    global $wpdb;
    
    $where = 'WHERE transaction_id != null OR transaction_id != "" ';
    $currentSql = "SELECT * FROM " . $wpdb->prefix . "transaction " . $where;
    $currentResult = $wpdb->get_results($currentSql);
    $count = count($currentResult);
    $payment_status="unpaid";
    if ($currentResult) {
        foreach ($currentResult as $key => $value) {
            if ($value->payment_status == 'paid') {
                continue;
            } else {
                $transactionid = $value->transaction_id;
                $slot = $value->book_slot;
                $result = fetchEscrowTransaction($transactionid);
                $status = '';
                $today = date("Y-m-d h:i:s");

                if ($result['status']['accepted']) {
                    $status = 'Accepted';
                } elseif ($result['status']['canceled']) {
                    $status = 'Canceled';
                } elseif ($result['status']['received']) {
                    $status = 'Received';
                } elseif ($result['status']['in_dispute']) {
                    $status = 'In dispute';
                } elseif ($result['status']['accepted_returned']) {
                    $status = 'Accepted_returned';
                } elseif ($result['status']['received_returned']) {
                    $status = 'Received_returned';
                } elseif ($result['status']['rejected']) {
                    $status = 'Rejected';
                } elseif ($result['status']['rejected_returned']) {
                    $status = 'Rejected_returned';
                } elseif ($result['status']['shipped']) {
                    $status = 'Shipped';
                } elseif ($result['status']['shipped_returned']) {
                    $status = 'Shipped_returned';
                } else {
                    if ($result['customer_agreement']) {
                        if ($slot <= $today) {
                            cancelEscrowTransaction($transactionid);
                            $status = 'Canceled';
                        } else {
                            $status = 'awaiting_payment';
                        }
                    } else {
                        if ($slot <= $today) {
                            cancelEscrowTransaction($transactionid);
                            $status = 'Canceled';
                        } else {
                            $status = 'awaiting_terms';
                        }
                    }
                    // $status = 'Pending';
                }

                if ($result["disbursed_to_beneficiary"]) {
                    $payment_status = "paid";
                }

                // if( $status="awaiting_terms"){
                //     if($slot<=$today){
                //         cancelEscrowTransaction($transactionid);
                //         $status = 'Canceled';
                //     }
                // }
                // $myfile = fopen("error.txt", "a") or die("Unable to open file!");
                // fwrite($myfile, print_r($transactionid.' =>>> '.$result." \n\r",true));
                // fclose($myfile);
                // updateTransactionTable($transactionid, $status, $payment_status);
            }
        }
    }
}

function cancelEscrowTransaction($transaction_id){
    $curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.escrow-sandbox.com/2017-09-01/transaction/'.$transaction_id,
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_USERPWD => 'herry.chris2@yopmail.com:2875_3I7GLKPcJPnXy5864uv5gYnS5rJxT0G94tu1ClFtoMCVRXRsrR8VD2j7sfDCFKzu',
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json'
    ),
    CURLOPT_CUSTOMREQUEST => 'PATCH',
    CURLOPT_POSTFIELDS => json_encode(
      array(
        'action' => 'cancel',
        'cancel_information' => array(
          'cancellation_reason' => 'Time slot expired'
      )
    )
  )
));

$output = curl_exec($curl);
echo $output;
curl_close($curl);
}
function updateTransactionTable($transaction_id, $status,$payment_status)
{
    global $wpdb;
    $wpdb->query(
        $wpdb->prepare("UPDATE " . $wpdb->prefix . "transaction SET `status`='" . $status . "', `payment_status`='".$payment_status."' WHERE `transaction_id`=" . $transaction_id)
    );
    // $myfile = fopen("error.txt", "a") or die("Unable to open file!");
    // fwrite($myfile, print_r($wpdb->last_query." \n\r",true));
    //         fclose($myfile);
    return $wpdb->last_query;
}
wp_schedule_event($timestamp = time(), $recurrence = 'every5minute', $hook = "wp_update_transaction");

?>