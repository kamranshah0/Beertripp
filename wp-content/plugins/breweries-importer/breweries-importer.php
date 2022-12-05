<?php

/*

Plugin Name: Breweries Importer

Description: upload breweries from csv file.

Version: 1.0.0

Author: Hailogics

Author URI: http://hailogics.com

Text Domain: breweries-importer

*/



function my_admin_menu() {

add_menu_page(

__( 'Import Breweries', 'my-textdomain' ),

__( 'Import Breweries', 'my-textdomain' ),

'manage_options',

'import-breweries',

'my_admin_page_contents',

'dashicons-schedule',

3

);

}



add_action( 'admin_menu', 'my_admin_menu' );



function my_admin_page_contents() {

?>

<h1>
    <?php esc_html_e( 'Welcome to breweries importer.', 'my-plugin-textdomain' ); ?>
</h1>
<form method="post" enctype="multipart/form-data">
    Select csv to upload:
    <input type="file" name="file" id="file">
    <input type="submit" value="Upload Data" name="submit">
</form>

<?php

    if (isset($_POST['submit'])) {
        // echo "<pre>";
        // print_r($_FILES);
        // echo "</pre>";
        set_time_limit(0);

        if (($open = fopen($_FILES['file']['tmp_name'], "r")) !== FALSE) 
        {
            $i = 0;
            while (($data = fgetcsv($open, 1000, ",")) !== FALSE) 
            {        
                $array[] = $data;
            
                if ($i != 0) {

                    $cityId = '';
                    $stateId = '';
                    if (!empty(wp_strip_all_tags($data[2])) ) {
                        # code...
                        $city_category = term_exists( wp_strip_all_tags($data[2]), 'city_category' ); // array is returned if taxonomy is given
                        
                        if (!$city_category) {
                            $city_category = wp_insert_term(
                                wp_strip_all_tags($data[2]),   // the term 
                                'city_category', // the taxonomy
                            );
                        }
                        $cityId = isset( $city_category['term_id']) && !empty( $city_category['term_id']) ? $city_category['term_id'] : null;
                    }

                    if (!empty (wp_strip_all_tags( $data[3] ))) {
                        
                        $statesArg = array(
                                    's'    => wp_strip_all_tags( $data[3] ),
                                    'post_content'  => '',
                                    'post_type' => 'state',
                                    'post_status'   => 'publish',
                                    'posts_per_page' => -1
                                    // 'post_category' => array( 8,39 )
                                );
            
                        $state_data = new Wp_Query($statesArg);
                        if (count($state_data->posts)) {
                            # yahan pe sirf sttach kerna hai
                            $stateId = $state_data->posts[0]->ID;
                        } else {
                            $statePostArg = array(
                                'post_title'    => wp_strip_all_tags( $data[3] ),
                                'post_content'  => '',
                                'post_type' => 'state',
                                'post_status'   => 'publish',
                                'post_author' => 1,
                                // 'post_category' => array( 8,39 )
                            );
                            # yahan pe state create hoga aur attach bhi hoga
                            $stateId = wp_insert_post( $statePostArg );
    
                        }
                    }

                    $breweryArg = array(
                        's'    => wp_strip_all_tags( $data[0] ),
                        'post_content'  => '',
                        'post_type' => 'brewery',
                        'post_status'   => 'publish',
                        'posts_per_page' => -1,
                        // 'post_category' => array( 8,39 )
                    );

                    $breweryData = new Wp_Query($breweryArg);
                    if (!count($breweryData->posts)) {
                        
                        $breweryPostArg = array(
                            'post_title'    => wp_strip_all_tags( $data[0] ),
                            'post_content'  => '',
                            'post_type' => 'brewery',
                            'post_status'   => 'publish',
                            'post_author' => 1,
                            // 'post_category' => array( 8,39 )
                        );
                        // Insert the post into the database
                      $postId = wp_insert_post( $breweryPostArg );
                    } else {
                        $postId = $breweryData->posts[0]->ID;
                    }

                    
        
                    
                      update_post_meta($postId, 'name',  wp_strip_all_tags( $data[0] ));
                      update_post_meta($postId, 'address',  wp_strip_all_tags( $data[1] ));
                      update_post_meta($postId, 'state',  $stateId);
                      update_post_meta($postId, 'zip',  wp_strip_all_tags( $data[4] ));
                      update_post_meta($postId, 'website',  wp_strip_all_tags( $data[5] ));
                      update_post_meta($postId, 'phone',  wp_strip_all_tags( $data[6] ));
                      update_post_meta($postId, 'type',  wp_strip_all_tags( $data[7] ));
                      update_post_meta($postId, 'revised',  wp_strip_all_tags( $data[8] ));
                    //   update_post_meta($postId, 'update',  wp_strip_all_tags( $data[9] ));
                      update_post_meta($postId, 'city',  $cityId);
                } 
                $i++;
            }
        
            fclose($open);
        }
        
        echo '('.count($array).') Breweries uploaded successfully.';
        //wp_die();
    }

}