<?php

namespace OXI_IMAGE_HOVER_PLUGINS\Modules\Square\Render;

if (!defined('ABSPATH')) {
    exit;
}

use OXI_IMAGE_HOVER_PLUGINS\Page\Public_Render;

class Effects22 extends Public_Render {

    public function public_css() {
        wp_enqueue_style('oxi-image-hover-square', OXI_IMAGE_HOVER_URL . '/Modules/Square/Files/square.css', false, OXI_IMAGE_HOVER_PLUGIN_VERSION);
        wp_enqueue_style('oxi-image-hover-square-style-22', OXI_IMAGE_HOVER_URL . '/Modules/Square/Files/style-22.css', false, OXI_IMAGE_HOVER_PLUGIN_VERSION);
    }

    public function default_render($style, $child, $admin) {

        foreach ($child as $key => $val) {
            $value = json_decode(stripslashes($val['rawdata']), true);
            $text = $content = $button = $hr = $ht = '';
            ?>
            <div class="oxi-image-hover-style oxi-image-hover-style-22-square <?php $this->column_render('oxi-image-hover-col', $style); ?> <?php
            if ($admin == "admin"):
                echo 'oxi-addons-admin-edit-list';
            endif;
            ?>" <?php $this->animation_render('oxi-image-hover-animation', $style); ?>>
                <div class="oxi-image-hover-style-square">
                    <div class="oxi-image-hover oxi-image-square-hover oxi-image-square-hover-style-22 oxi-image-square-hover-<?php echo esc_attr($this->oxiid); ?>-<?php echo esc_attr($val['id']); ?>">
                        <?php
                        if ($this->checkurl_render('image_hover_button_link', $value) === true):
                            $ht = true;
                            ?>
                            <a <?php $this->url_render('image_hover_button_link', $value); ?>>
                                <?php
                            endif;
                            ?>
                            <div class="oxi-image-hover-figure <?php echo esc_attr($this->style['image_hover_effects']); ?>">
                                <div class="oxi-image-hover-image">
                                    <img <?php $this->media_render('image_hover_image', $value); ?>>
                                </div>
                                <div class="oxi-image-hover-figure-caption">
                                    <div class="oxi-image-hover-caption-tab">
                                        <?php
                                        if ($value['image_hover_heading'] != '') :
                                            ?>
                                            <div class="oxi-image-hover-figure-heading <?php echo esc_attr($this->style['oxi-image-hover-heading-animation']); ?> <?php echo esc_attr($this->style['oxi-image-hover-heading-animation-delay']); ?>"><h3 class="oxi-image-hover-heading"><?php $this->text_render($value['image_hover_heading']); ?></h3></div>
                                                <?php
                                            endif;
                                            ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                            if ($ht === true):
                                ?>
                            </a>
                            <?php
                        endif;
                        ?>
                    </div>
                </div>
                <?php
                if ($admin == 'admin') :
                    $this->oxi_addons_admin_edit_delete_clone($val['id']);
                endif;
                ?> </div><?php
        }
    }

}
