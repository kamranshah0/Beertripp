<?php

namespace OXI_IMAGE_HOVER_PLUGINS\Helper;

if (!defined('ABSPATH')) {
    exit;
}

trait Admin_helper {

    /**
     * Plugin check Current Tabs
     *
     * @since 9.3.0
     */
    public function check_current_version($agr) {
        $vs = get_option($this->fixed_data('696d6167655f686f7665725f756c74696d6174655f6c6963656e73655f737461747573'));
        if ($vs == $this->fixed_data('76616c6964')) {
            return true;
        } else {
            return false;
        }
    }

    public function Public_loader() {
        global $wpdb;
        $this->wpdb = $wpdb;
        $this->parent_table = $this->wpdb->prefix . 'image_hover_ultimate_style';
        $this->child_table = $this->wpdb->prefix . 'image_hover_ultimate_list';
        $this->import_table = $this->wpdb->prefix . 'oxi_div_import';
    }

    /**
     * Plugin fixed
     *
     * @since 9.3.0
     */
    public function fixed_data($agr) {
        return hex2bin($agr);
    }

    /**
     * Plugin fixed debugging data
     *
     * @since 9.3.0
     */
    public function fixed_debug_data($str) {
        return bin2hex($str);
    }

    public function Admin_Icon() {
        ?>
        <style type='text/css' media='screen'>
            #adminmenu #toplevel_page_oxi-image-hover-ultimate div.wp-menu-image:before {
                content: "\f169";
            }
        </style>
        <?php
    }

    public function admin_url_convert($agr) {
        return admin_url(strpos($agr, 'edit') !== false ? $agr : 'admin.php?page=' . $agr);
    }

    public function SupportAndComments($agr) {
        if (get_option('oxi_image_support_massage') == 'no') {
            return;
        }
        ?>

        <div class="oxi-addons-admin-notifications">
            <h3>
                <span class="dashicons dashicons-flag"></span>
                Trouble or Need Support?
            </h3>
            <p></p>
            <div class="oxi-addons-admin-notifications-holder">
                <div class="oxi-addons-admin-notifications-alert">
                    <p>Unable to create your desire design or need any help? You can <a href="https://wordpress.org/support/plugin/image-hover-effects-ultimate#new-post">Ask any question</a> and get reply from our expert members. We will be glad to answer any question you may have about our plugin. </p>
        <?php
        if (apply_filters('oxi-image-hover-plugin-version', false) != true) :
            ?>
                        <p>By the way, did you know we also have a <a href="https://www.oxilabdemos.com/image-hover/pricing/">Premium Version</a>? It offers lots of options with automatic update. It also comes with 16/5 personal support.</p>
                        <p>Thanks Again!</p>
            <?php
        endif;
        ?>

                    <p></p>
                </div>
            </div>
            <p></p>
        </div>

                    <?php
                }

                /**
                 * Image Hover Admin menu
                 *
                 * @since 9.3.0
                 */
                public function oxilab_admin_menu($agr) {
                    $response = [
                        'Image Hover' => [
                            'name' => 'Image Hover',
                            'homepage' => 'oxi-image-hover-ultimate'
                        ],
                        'Shortcode' => [
                            'name' => 'Shortcode',
                            'homepage' => 'oxi-image-hover-shortcode'
                        ],
                        'Addons' => [
                            'name' => 'Addons',
                            'homepage' => 'oxi-image-hover-ultimate-addons'
                        ]
                    ];

                    $bgimage = OXI_IMAGE_HOVER_URL . 'image/sm-logo.png';
                    ?>


        <div class="oxi-addons-wrapper">
            <div class="oxilab-new-admin-menu">
                <div class="oxi-site-logo">
                    <a href="<?php echo esc_url($this->admin_url_convert('oxi-image-hover-ultimate')); ?>" class="header-logo" style=" background-image: url(<?php echo esc_url($bgimage); ?>);">
                    </a>
                </div>
                <nav class="oxilab-sa-admin-nav">
                    <ul class="oxilab-sa-admin-menu">
        <?php
        $GETPage = sanitize_text_field($_GET['page']);
        $effects = (!empty($_GET['effects']) ? sanitize_text_field($_GET['effects']) : '');
        if ($effects != '' && $GETPage == 'oxi-image-hover-ultimate') :
            $url = $this->admin_url_convert('oxi-image-hover-ultimate') . '&effects=' . $effects;
            ?>

                            <li class="active">
                                <a href="<?php echo esc_url($url); ?>">
                            <?php
                            if ($effects == 'display') :
                                echo 'Display Post';
                            else :
                                echo esc_html($this->name_converter($effects)) . ' Effects';
                            endif;
                            ?>
                                </a>
                            </li>
                                    <?php
                                endif;
                                foreach ($response as $key => $value) {
                                    $active = (($GETPage == $value['homepage'] && $effects == '') ? 'active ' : '');
                                    ?>
                            <li class="<?php echo esc_attr($active); ?>"><a href="<?php echo esc_url($this->admin_url_convert($value['homepage'])); ?>"><?php echo esc_html($this->name_converter($value['name'])); ?></a></li>
                                    <?php
                                }
                                ?>
                    </ul>
                    <ul class="oxilab-sa-admin-menu2">

                        <?php
                        if (apply_filters('oxi-image-hover-plugin-version', false) == FALSE) :
                            ?>
                            <li class="fazil-class"><a target="_blank" href="https://www.oxilabdemos.com/image-hover/pricing/">Upgrade</a></li>
                            <?php
                        endif;
                        ?>
                        <li class="saadmin-doc"><a target="_black" href="https://www.oxilabdemos.com/image-hover/docs/">Docs</a></li>
                        <li class="saadmin-doc"><a target="_black" href="https://wordpress.org/support/plugin/image-hover-effects-ultimate/">Support</a></li>
                        <li class="saadmin-set"><a href="<?php echo esc_url(admin_url('admin.php?page=oxi-image-hover-ultimate-settings')); ?>"><span class="dashicons dashicons-admin-generic"></span></a></li>
                    </ul>
                </nav>
            </div>
        </div>
                        <?php
                    }

                    public function Admin_Menu() {
                        $user_role = get_option('oxi_addons_user_permission');
                        $role_object = get_role($user_role);
                        $first_key = '';
                        if (isset($role_object->capabilities) && is_array($role_object->capabilities)) {
                            reset($role_object->capabilities);
                            $first_key = key($role_object->capabilities);
                        } else {
                            $first_key = 'manage_options';
                        }
                        add_menu_page('Image Hover', 'Image Hover', $first_key, 'oxi-image-hover-ultimate', [$this, 'Image_Parent']);
                        add_submenu_page('oxi-image-hover-ultimate', 'Image Hover', 'Image Hover', $first_key, 'oxi-image-hover-ultimate', [$this, 'Image_Parent']);
                        add_submenu_page('oxi-image-hover-ultimate', 'Shortcode', 'Shortcode', $first_key, 'oxi-image-hover-shortcode', [$this, 'Image_Shortcode']);
                        add_submenu_page('oxi-image-hover-ultimate', 'Settings', 'Settings', $first_key, 'oxi-image-hover-ultimate-settings', [$this, 'Image_Settings']);
                        add_submenu_page('oxi-image-hover-ultimate', 'Support', 'Support', $first_key, 'image-hover-ultimate-support', [$this, 'oxi_image_hover_support']);
                        add_submenu_page('oxi-image-hover-ultimate', 'Oxilab Addons', 'Oxilab Addons', $first_key, 'oxi-image-hover-ultimate-addons', [$this, 'Image_Addons']);
                    }

                    public function custom_redirect() {
                        
                    }

                    public function Image_Parent() {
                        $effects = (!empty($_GET['effects']) ? ucfirst(sanitize_text_field($_GET['effects'])) : '');
                        $styleid = (!empty($_GET['styleid']) ? (int) $_GET['styleid'] : '');
                        if (!empty($effects) && !empty($styleid)) :
                            $style = $this->wpdb->get_row($this->wpdb->prepare('SELECT style_name FROM ' . $this->parent_table . ' WHERE id = %d ', $styleid), ARRAY_A);
                            $name = explode('-', $style['style_name']);
                            if ($effects != ucfirst($name[0])) :
                                wp_die(esc_html('Invalid URL.'));
                            endif;
                            $cls = '\OXI_IMAGE_HOVER_PLUGINS\Modules\\' . $effects . '\Admin\\Effects' . $name[1];
                            if (class_exists($cls)) :
                                new $cls();
                            else :
                                wp_die(esc_html('Invalid URL.'));
                            endif;
                        elseif (!empty($effects)) :
                            $cls = '\OXI_IMAGE_HOVER_PLUGINS\Modules\\' . $effects . '\\' . $effects . '';
                            if (class_exists($cls)) :
                                new $cls();
                            else :
                                wp_die(esc_html('Invalid URL.'));
                            endif;
                        else :
                            new \OXI_IMAGE_HOVER_PLUGINS\Page\Admin();
                        endif;
                    }

                    public function Image_Shortcode() {
                        new \OXI_IMAGE_HOVER_PLUGINS\Page\Shortcode();
                    }

                    public function Image_Addons() {
                        new \OXI_IMAGE_HOVER_PLUGINS\Page\Addons();
                    }

                    public function Image_Settings() {
                        new \OXI_IMAGE_HOVER_PLUGINS\Page\Settings();
                    }

                    public function oxi_image_hover_support() {
                        new \OXI_IMAGE_HOVER_PLUGINS\Page\Welcome();
                    }

                    /**
                     * Admin Notice Check
                     *
                     * @since 9.3.0
                     */
                    public function admin_notice_status() {
                        $data = get_option('oxi_image_hover_nobug');
                        return $data;
                    }

                    public function User_Reviews() {

                        $user_role = get_option('oxi_addons_user_permission');
                        $role_object = get_role($user_role);
                        $first_key = '';
                        if (isset($role_object->capabilities) && is_array($role_object->capabilities)) {
                            reset($role_object->capabilities);
                            $first_key = key($role_object->capabilities);
                        } else {
                            $first_key = 'manage_options';
                        }
                        if (!current_user_can($first_key)) :
                            return;
                        endif;
                        $this->admin_recommended();
                        $this->admin_notice();
                    }

                    /**
                     * Admin Notice Check
                     *
                     * @since 9.3.0
                     */
                    public function admin_recommended_status() {

                        $data = get_option('oxi_image_hover_recommended');
                        return $data;
                    }

                    public function admin_recommended() {

                        if (!empty($this->admin_recommended_status())) :
                            return;
                        endif;

                        if (strtotime('-1 days') < $this->installation_date()) :
                            return;
                        endif;

                        new \OXI_IMAGE_HOVER_PLUGINS\Classes\Support_Recommended();
                    }

                    public function admin_notice() {
                        if (!empty($this->admin_notice_status())) :
                            return;
                        endif;
                        if (strtotime('-7 days') < $this->installation_date()) :
                            return;
                        endif;
                        new \OXI_IMAGE_HOVER_PLUGINS\Classes\Support_Reviews();
                    }

                    /**
                     * Admin Install date Check
                     *
                     * @since 9.3.0
                     */
                    public function installation_date() {
                        $data = get_option('oxi_image_hover_activation_date');
                        if (empty($data)) :
                            $data = strtotime("now");
                            update_option('oxi_image_hover_activation_date', $data);
                        endif;
                        return $data;
                    }

                    public function redirect_on_activation() {
                        if (get_transient('oxi_image_hover_activation_redirect')) :
                            delete_transient('oxi_image_hover_activation_redirect');
                            if (is_network_admin() || isset($_GET['activate-multi'])) :
                                return;
                            endif;
                            wp_safe_redirect(admin_url("admin.php?page=image-hover-ultimate-support"));
                        endif;
                    }

                }
                