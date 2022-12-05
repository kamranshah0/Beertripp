<?php

namespace OXI_IMAGE_HOVER_PLUGINS\Modules\Comparison\Render;

if (!defined('ABSPATH')) {
    exit;
}

use OXI_IMAGE_HOVER_PLUGINS\Page\Public_Render;

class Effects1 extends Public_Render {

    public function public_css() {
        wp_enqueue_style('oxi-image-hover-comparison-box', OXI_IMAGE_HOVER_URL . '/Modules/Comparison/Files/Comparison.css', false, OXI_IMAGE_HOVER_PLUGIN_VERSION);
        wp_enqueue_style('oxi-image-hover-comparison-style-1', OXI_IMAGE_HOVER_URL . '/Modules/Comparison/Files/style-1.css', false, OXI_IMAGE_HOVER_PLUGIN_VERSION);
        wp_enqueue_style('oxi-addons-main-wrapper-image-comparison-style-1', OXI_IMAGE_HOVER_URL . '/Modules/Comparison/Files/twentytwenty.css', false, OXI_IMAGE_HOVER_PLUGIN_VERSION);
    }

    public function public_jquery() {
        $this->JSHANDLE = 'jquery-twentytwenty';
        wp_enqueue_script('jquery-event-move', OXI_IMAGE_HOVER_URL . '/Modules/Comparison/Files/jquery-event-move.js', true, OXI_IMAGE_HOVER_PLUGIN_VERSION);
        wp_enqueue_script('jquery-twentytwenty', OXI_IMAGE_HOVER_URL . '/Modules/Comparison/Files/jquery-twentytwenty.js', true, OXI_IMAGE_HOVER_PLUGIN_VERSION);
    }

    public function default_render($style, $child, $admin) {
        foreach ($child as $key => $val) {
            $data = json_decode(stripslashes($val['rawdata']), true);
            ?>
            <div class="oxi-addons-main-wrapper-image-comparison-style-1 oxi-addons-main-wrapper-image-comparison <?php $this->column_render('oxi-image-hover-col', $style) ?> <?php
            if ($admin == "admin"):
                echo 'oxi-addons-admin-edit-list';
            endif;
            ?>">
                <div class="oxi-addons-main <?php echo esc_attr($style['oxi_image_magnifier_image_switcher']); ?>">
                    <div class="oxi-addons-comparison-<?php echo esc_attr($this->oxiid); ?>_<?php echo esc_attr($key); ?>">
                      
                        <?php
                        if ($this->check_media_render('oxi_image_comparison_image_one', $data) == true) {
                            ?>
                            <img  <?php $this->media_render('oxi_image_comparison_image_one', $data); ?> class="oxi-img"/>
                            <?php
                        }
                        if ($this->check_media_render('oxi_image_comparison_image_two', $data) == true) {
                            ?>
                            <img  <?php $this->media_render('oxi_image_comparison_image_two', $data); ?> class="oxi-img" />
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <?php
                if ($admin == 'admin'):
                    $this->oxi_addons_admin_edit_delete_clone($val['id']);
                endif;
                ?>
            </div>
            <?php
        }
    }

    public function inline_public_jquery() {
        $styledata = $this->style;
        $child = $this->child;
        $jquery = '';
        foreach ($child as $key => $val) {
            $data = json_decode(stripslashes($val['rawdata']), true);
            $jquery .= ' 
            $(".oxi-addons-comparison-' . $this->oxiid . '_' . $key . '").twentytwenty({
               default_offset_pct: ' . ($data['oxi_image_comparison_body_offset-size'] ? $data['oxi_image_comparison_body_offset-size'] : 0.5) . ', 
                before_label: "' . $this->return_text($styledata['oxi_image_comparison_before_text']) . '",
                after_label: "' . $this->return_text($styledata['oxi_image_comparison_after_text']) . '",
               ';
            if ($styledata['oxi_image_compersion_overlay_controler'] == 'true') {
                $jquery .= 'no_overlay: false,';
            } else {
                $jquery .= 'no_overlay: true,';
            }
            if ($data['oxi_image_comparison_click'] == 'true') {
                $jquery .= 'click_to_move: true,';
            } else {
                $jquery .= 'click_to_move: false,';
            }
            if ($data['oxi_image_comparison_position'] == 'true') {
                $jquery .= 'orientation: "horizontal",';
            } else {
                $jquery .= 'orientation: "vertical",';
            }
            if ($data['oxi_image_comparison_hover'] == 'true') {
                $jquery .= 'move_slider_on_hover: true,';
            } else {
                $jquery .= 'move_slider_on_hover: false,';
            }

            $jquery .= ' });';
        }
        return $jquery;
    }

}
