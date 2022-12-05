<?php

namespace OXI_IMAGE_HOVER_PLUGINS\Modules\Caption\Admin;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Description of Effects2
 *
 * @author biplo
 */
use OXI_IMAGE_HOVER_PLUGINS\Modules\Caption\Modules as Modules;
use OXI_IMAGE_HOVER_PLUGINS\Classes\Controls as Controls;

class Effects2 extends Modules {

    public function register_effects() {
        return $this->add_control(
                        'image_hover_effects', $this->style, [
                    'label' => esc_html__('Effects Direction', 'image-hover-effects-ultimate'),
                    'type' => Controls::SELECT,
                    'default' => '',
                    'options' => [
                        'oxi-image-blocks-rotate-left' => esc_html__('Block Rotate Left', 'image-hover-effects-ultimate'),
                        'oxi-image-blocks-rotate-right' => esc_html__('Block Rotate Right', 'image-hover-effects-ultimate'),
                        'oxi-image-blocks-rotate-in-left' => esc_html__('Block Rotate In Left', 'image-hover-effects-ultimate'),
                        'oxi-image-blocks-rotate-in-right' => esc_html__('Block Rotate In Right', 'image-hover-effects-ultimate'),
                        'oxi-image-blocks-in' => esc_html__('Block In', 'image-hover-effects-ultimate'),
                        'oxi-image-blocks-out' => esc_html__('Block Out', 'image-hover-effects-ultimate'),
                        'oxi-image-blocks-float-up' => esc_html__('Block Float Up', 'image-hover-effects-ultimate'),
                        'oxi-image-blocks-float-down' => esc_html__('Block Float Down', 'image-hover-effects-ultimate'),
                        'oxi-image-blocks-float-left' => esc_html__('Block Float Left', 'image-hover-effects-ultimate'),
                        'oxi-image-blocks-float-right' => esc_html__('Block Float Right', 'image-hover-effects-ultimate'),
                        'oxi-image-blocks-zoom-top-left' => esc_html__('Block Zoom Top Left', 'image-hover-effects-ultimate'),
                        'oxi-image-blocks-zoom-top-right' => esc_html__('Block Zoom Top Right', 'image-hover-effects-ultimate'),
                        'oxi-image-blocks-zoom-bottom-left' => esc_html__('Block Zoom Bottom Left', 'image-hover-effects-ultimate'),
                        'oxi-image-blocks-zoom-bottom-right' => esc_html__('Block Zoom Bottom Right', 'image-hover-effects-ultimate'),
                    ],
                    'selector' => [
                        '{{WRAPPER}} .oxi-image-caption-hover' => '',
                    ]
                        ]
        );
    }

}
