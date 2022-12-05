<?php

namespace OXI_IMAGE_HOVER_PLUGINS\Modules\Display\Render;

if (!defined('ABSPATH')) {
    exit;
}

use OXI_IMAGE_HOVER_PLUGINS\Page\Public_Render;
use OXI_IMAGE_HOVER_PLUGINS\Modules\Display\Files\Style_1_Post_Query as Post_Query;

class Effects1 extends Public_Render {

    public function public_jquery() {
        wp_enqueue_script('oxi_image_style_1_loader', OXI_IMAGE_HOVER_URL . '/Modules/Display/Files/style-1-loader.js', false, OXI_IMAGE_HOVER_PLUGIN_VERSION);
        $this->JSHANDLE = 'oxi_image_style-1-loader';
        wp_localize_script('oxi_image_style_1_loader', 'oxi_image_style_1_loader', array('ajaxurl' => admin_url('admin-ajax.php'), 'nonce' => wp_create_nonce('image_hover_ultimate')));
    }

    public function public_css() {
        wp_enqueue_style('oxi-image-hover-display-style-1', OXI_IMAGE_HOVER_URL . '/Modules/Display/Files/style-1.css', false, OXI_IMAGE_HOVER_PLUGIN_VERSION);
    }

    public function render() {
        ?>


        <div class="oxi-addons-container <?php echo esc_attr($this->WRAPPER); ?> oxi-image-hover-wrapper-<?php
        if (array_key_exists('display_post_style', $this->style)):
            echo esc_attr($this->style['display_post_style']);
        endif;
        ?>" id="<?php echo esc_attr($this->WRAPPER); ?>">
            <div class="oxi-addons-row">
                <?php
                $this->default_render($this->style, $this->child, $this->admin);
                ?>  
            </div>
        </div>
        <?php
    }

    public function default_render($style, $child, $admin) {
        if (!array_key_exists('display_post_style', $style)):
            ?><p>Kindly Select Image Effects First to Extend Post.</p><?php
            return;
        endif;
        $args = [
            'post_status' => 'publish',
            'ignore_sticky_posts' => 1,
            'post_type' => $style['display_post_post_type'],
            'orderby' => $style['display_post_orderby'],
            'order' => $style['display_post_ordertype'],
            'posts_per_page' => $style['display_post_per_page'],
            'offset' => $style['display_post_offset'],
            'tax_query' => [],
        ];
        if (!empty($style['display_post_author'])):
            $args['author__in'] = $style['display_post_author'];
        endif;

        $type = $style['display_post_post_type'];

        if (!empty($style[$type . '_exclude'])) {
            $args['post__not_in'] = $style[$type . '_exclude'];
        }
        if (!empty($style[$type . '_include'])) {
            $args['post__in'] = $style[$type . '_include'];
        }
        if ($type != 'page') :
            if (!empty($style[$type . '_category'])) :
                $args['tax_query'][] = [
                    'taxonomy' => $type == 'post' ? 'category' : $type . '_category',
                    'field' => 'term_id',
                    'terms' => $style[$type . '_category'],
                ];
            endif;
            if (!empty($style[$type . '_tag'])) :
                $args['tax_query'][] = [
                    'taxonomy' => $type . '_tag',
                    'field' => 'term_id',
                    'terms' => $style[$type . '_tag'],
                ];
            endif;
            if (!empty($args['tax_query'])) :
                $args['tax_query']['relation'] = 'OR';
            endif;
        endif;
        $settings = [
            'display_post_style' => $style['display_post_style'],
            'display_post_thumb_sizes' => $style['display_post_thumb_sizes'],
            'display_post_excerpt' => $style['display_post_excerpt'],
        ];

        new Post_Query('post_query', 'nai', $args, $settings);

        if ('yes' == $style['display_post_load_more']) {
            if ($style['display_post_load_more_type'] == 'button'):
                ?>
                <div class="oxi-image-hover-load-more-button-wrap oxi-bt-col-sm-12">
                    <button class="oxi-image-load-more-button" id="oxi-image-load-more-button<?php echo (int) $this->oxiid; ?>" data-class="OXI_IMAGE_HOVER_PLUGINS\Modules\Display\Files\Style_1_Post_Query" data-function="__rest_api_post" data-args='<?php echo esc_attr(json_encode($args)); ?>' data-settings='<?php echo esc_attr(json_encode($settings)); ?>' data-page="1">
                        <div class="oxi-image-hover-loader button__loader"></div>
                        <span><?php echo esc_html($style['display_post_load_button_text']); ?></span>
                    </button>
                </div><?php
            else:
                ?>
                <div class="oxi-image-hover-load-more-infinite" id="oxi-image-hover-load-more-infinite<?php echo (int) $this->oxiid; ?>" data-class="OXI_IMAGE_HOVER_PLUGINS\Modules\Display\Files\Style_1_Post_Query" data-function="__rest_api_post" data-args='<?php echo esc_attr(json_encode($args)); ?>' data-settings='<?php echo esc_attr(json_encode($settings)); ?>' data-page="1">
                </div>
            <?php
            endif;
        }
    }

}
