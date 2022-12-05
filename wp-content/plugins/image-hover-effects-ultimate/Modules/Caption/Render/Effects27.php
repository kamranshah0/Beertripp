<?php

namespace OXI_IMAGE_HOVER_PLUGINS\Modules\Caption\Render;

if (!defined('ABSPATH')) {
    exit;
}

use OXI_IMAGE_HOVER_PLUGINS\Page\Public_Render;

class Effects27 extends Public_Render {

    public function public_css() {
        wp_enqueue_style('oxi-image-hover-caption', OXI_IMAGE_HOVER_URL . '/Modules/Caption/Files/caption.css', false, OXI_IMAGE_HOVER_PLUGIN_VERSION);
        wp_enqueue_style('oxi-image-hover-caption-stack-effects', OXI_IMAGE_HOVER_URL . '/Modules/Caption/Files/stack-effects.css', false, OXI_IMAGE_HOVER_PLUGIN_VERSION);
    }

    public function default_render($style, $child, $admin) {

        foreach ($child as $key => $val) {
            $value = json_decode(stripslashes($val['rawdata']), true);
            $ht = '';
            ?>
            <div class="oxi-image-hover-style <?php $this->column_render('oxi-image-hover-col', $style); ?> <?php
            if ($admin == "admin"):
                echo 'oxi-addons-admin-edit-list';
            endif;
            ?>" <?php $this->animation_render('oxi-image-hover-animation', $style); ?>>
                 <div class="oxi-image-hover-style-caption">
                    <div class="oxi-image-hover oxi-image-caption-hover oxi-image-caption-hover-style-27 <?php echo esc_attr($this->style['image_hover_effects']); ?>">
                        <?php
                        if ($this->checkurl_render('image_hover_button_link', $value) === true && empty($value['image_hover_button_text'])):
                            $ht = true;
                            ?>
                            <a <?php $this->url_render('image_hover_button_link', $value); ?>>
                                <?php
                            endif;
                            ?>
                            <div class="oxi-image-hover-figure">
                                <div class="oxi-image-hover-image">
                                    <img <?php $this->media_render('image_hover_image', $value); ?>>
                                </div>
                                <div class="oxi-image-hover-figure-caption">
                                    <div class="oxi-image-hover-caption-tab <?php echo esc_attr($this->style['oxi-image-hover-content-alignment']); ?>">
                                        <?php
                                        if ($value['image_hover_heading'] != ''):
                                            ?>
                                            <h3 class="oxi-image-hover-heading <?php echo esc_attr($this->style['oxi-image-hover-heading-animation']); ?> <?php echo esc_attr($this->style['oxi-image-hover-heading-animation-delay']); ?>"><?php $this->text_render($value['image_hover_heading']); ?></h3>
                                            <?php
                                        endif;
                                        if ($value['image_hover_description'] != ''):
                                            ?>
                                            <div class="oxi-image-hover-content <?php echo esc_attr($this->style['oxi-image-hover-desc-animation']); ?> <?php echo esc_attr($this->style['oxi-image-hover-desc-animation-delay'] ); ?>"><?php $this->text_render($value['image_hover_description']); ?></div>
                                            <?php
                                        endif;
                                        if ($value['image_hover_button_text'] != '' && $this->checkurl_render('image_hover_button_link', $value) === true):
                                            ?>
                                            <div class="oxi-image-hover-button <?php echo esc_attr($this->style['oxi-image-hover-button-animation'] ); ?> <?php echo esc_attr($this->style['oxi-image-hover-button-animation-delay'] ); ?>">
                                                <a <?php $this->url_render('image_hover_button_link', $value); ?> class="oxi-image-btn"><?php $this->text_render($value['image_hover_button_text']); ?></a>
                                            </div>
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
                ?>
            </div>
            <?php
        }
    }

}
