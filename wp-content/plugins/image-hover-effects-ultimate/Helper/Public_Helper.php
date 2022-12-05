<?php

namespace OXI_IMAGE_HOVER_PLUGINS\Helper;

if (!defined('ABSPATH')) {
    exit;
}

/**
 *
 * @author $biplob018
 */
trait Public_Helper {

    public function validate_post($files = '') {

        $rawdata = [];
        if (!empty($files)) :
            $data = json_decode(stripslashes($files), true);
        endif;
        if (is_array($data)) :
            $rawdata = array_map(array($this, 'allowed_html'), $data);
        else :
            $rawdata = $this->allowed_html($files);
        endif;

        return $rawdata;
    }

    /**
     * Plugin Name Convert to View
     *
     * @since 9.3.0
     */
    public function name_converter($data) {
        $data = str_replace('_', ' ', $data);
        $data = str_replace('-', ' ', $data);
        $data = str_replace('+', ' ', $data);
        return esc_html(ucwords($data));
    }

    public function effects_converter($data) {
        $data = explode('-', $data);
        return esc_html($data[0]);
    }

    public function html_special_charecter($data) {
        $data = html_entity_decode($data);
        $data = str_replace("\'", "'", $data);
        $data = str_replace('\"', '"', $data);
        $data = do_shortcode($data, $ignore_html = false);
        return $data;
    }

    public function admin_special_charecter($data) {
        $data = html_entity_decode($data);
        $data = str_replace("\'", "'", $data);
        $data = str_replace('\"', '"', $data);
        return $data;
    }

    public function icon_font_selector($data) {
        $icon = explode(' ', $data);
        $fadata = get_option('oxi_addons_font_awesome');
        $faversion = get_option('oxi_addons_font_awesome_version');
        $faversion = explode('||', $faversion);
        if ($fadata != 'no') {
            wp_enqueue_style('font-awesome-' . $faversion[0], $faversion[1]);
        }
        $files = '<i class="' . esc_attr($data) . ' oxi-icons"></i>';
        return $files;
    }

    public function font_familly_charecter($data) {
        wp_enqueue_style('' . $data . '', 'https://fonts.googleapis.com/css?family=' . $data . '');
        $data = str_replace('+', ' ', $data);
        $data = explode(':', $data);
        $data = $data[0];
        $data = '"' . $data . '"';
        return $data;
    }

    public function shortcode_render($styleid, $user) {
        if (!empty($styleid) && !empty($user) && (int) $styleid) :
            $style = $this->wpdb->get_row($this->wpdb->prepare('SELECT * FROM ' . $this->parent_table . ' WHERE id = %d ', $styleid), ARRAY_A);

            if (!is_array($style)) :
                echo '<p> Shortcode Deleted, kindly add currect Shortcode</p>';
                return;
            endif;
            if (!array_key_exists('rawdata', $style)) :
                $Installation = new \OXI_IMAGE_HOVER_PLUGINS\Classes\Installation();
                $Installation->plugin_upgrade_hook();
            endif;
            $rawdata = json_decode(stripslashes($style['rawdata']), true);

            if (((is_array($rawdata) && array_key_exists('image_hover_dynamic_content', $rawdata) && $rawdata['image_hover_dynamic_content'] == 'yes') ||
                    (is_array($rawdata) && array_key_exists('image_hover_dynamic_load', $rawdata) && $rawdata['image_hover_dynamic_load'] == 'yes') ||
                    (is_array($rawdata) && array_key_exists('image_hover_dynamic_carousel', $rawdata) && $rawdata['image_hover_dynamic_carousel'] == 'yes')) && apply_filters('oxi-image-hover-plugin-version', false)) :
                $C = '\OXI_IMAGE_HOVER_PLUGINS\Modules\Compailer';
                if (class_exists($C)) :
                    new $C($style, [], $user);
                endif;
            else :
                $child = $this->wpdb->get_results($this->wpdb->prepare("SELECT * FROM $this->child_table WHERE styleid = %d ORDER by id ASC", $styleid), ARRAY_A);
                $name = explode('-', ucfirst($style['style_name']));
                $C = '\OXI_IMAGE_HOVER_PLUGINS\Modules\\' . ucfirst($name[0]) . '\Render\Effects' . $name[1];
                if (class_exists($C)) :
                    new $C($style, $child, $user);
                endif;
            endif;

        endif;
    }

    public function allowed_html($rawdata) {
        $allowed_tags = array(
            'a' => array(
                'class' => array(),
                'href' => array(),
                'rel' => array(),
                'title' => array(),
            ),
            'abbr' => array(
                'title' => array(),
            ),
            'b' => array(),
            'br' => array(),
            'blockquote' => array(
                'cite' => array(),
            ),
            'cite' => array(
                'title' => array(),
            ),
            'code' => array(),
            'del' => array(
                'datetime' => array(),
                'title' => array(),
            ),
            'dd' => array(),
            'div' => array(
                'class' => array(),
                'title' => array(),
                'style' => array(),
                'id' => array(),
            ),
            'table' => array(
                'class' => array(),
                'id' => array(),
                'style' => array(),
            ),
            'button' => array(
                'class' => array(),
                'type' => array(),
                'value' => array(),
            ),
            'thead' => array(),
            'tbody' => array(),
            'tr' => array(),
            'td' => array(),
            'dt' => array(),
            'em' => array(),
            'h1' => array(),
            'h2' => array(),
            'h3' => array(),
            'h4' => array(),
            'h5' => array(),
            'h6' => array(),
            'i' => array(
                'class' => array(),
            ),
            'img' => array(
                'alt' => array(),
                'class' => array(),
                'height' => array(),
                'src' => array(),
                'width' => array(),
            ),
            'li' => array(
                'class' => array(),
            ),
            'ol' => array(
                'class' => array(),
            ),
            'p' => array(
                'class' => array(),
            ),
            'q' => array(
                'cite' => array(),
                'title' => array(),
            ),
            'span' => array(
                'class' => array(),
                'title' => array(),
                'style' => array(),
            ),
            'strike' => array(),
            'strong' => array(),
            'ul' => array(
                'class' => array(),
            ),
        );
        if (is_array($rawdata)) :
            return $rawdata = array_map(array($this, 'allowed_html'), $rawdata);
        else :
            return wp_kses($rawdata, $allowed_tags);
        endif;
    }

}
