<?php

namespace OXI_IMAGE_HOVER_PLUGINS\Modules\Caption\Admin;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Description of Effects28
 *
 * @author biplo
 */
use OXI_IMAGE_HOVER_PLUGINS\Modules\Caption\Modules as Modules;
use OXI_IMAGE_HOVER_PLUGINS\Classes\Controls as Controls;

class Effects28 extends Modules {

    public function register_effects() {
        return $this->add_control(
                        'image_hover_effects', $this->style, [
                    'label' => esc_html__('Effects Direction', 'image-hover-effects-ultimate'),
                    'type' => Controls::SELECT,
                    'default' => '',
                    'options' => [
                        'oxi-image-strip-shutter-up' => esc_html__('Strip Shutter Up', 'image-hover-effects-ultimate'),
                        'oxi-image-strip-shutter-down' => esc_html__('Strip Shutter Down', 'image-hover-effects-ultimate'),
                        'oxi-image-strip-shutter-left' => esc_html__('Strip Shutter Left', 'image-hover-effects-ultimate'),
                        'oxi-image-strip-shutter-right' => esc_html__('Strip Shutter Right', 'image-hover-effects-ultimate'),
                        'oxi-image-strip-horizontal-up' => esc_html__('Strip Horizontal Up', 'image-hover-effects-ultimate'),
                        'oxi-image-strip-horizontal-down' => esc_html__('Strip Horizontal Down', 'image-hover-effects-ultimate'),
                        'oxi-image-strip-horizontal-top-left' => esc_html__('Strip Horizontal Top Left', 'image-hover-effects-ultimate'),
                        'oxi-image-strip-horizontal-top-right' => esc_html__('Strip Horizontal Top Right', 'image-hover-effects-ultimate'),
                        'oxi-image-strip-horizontal-left' => esc_html__('Strip Horizontal Left', 'image-hover-effects-ultimate'),
                        'oxi-image-strip-horizontal-right' => esc_html__('Strip Horizontal Right', 'image-hover-effects-ultimate'),
                        'oxi-image-strip-vertical-left' => esc_html__('Strip Vertical Left', 'image-hover-effects-ultimate'),
                        'oxi-image-strip-vertical-right' => esc_html__('Strip Vertical Right', 'image-hover-effects-ultimate'),
                        'oxi-image-strip-vertical-top-left' => esc_html__('Strip Vertical Top Left', 'image-hover-effects-ultimate'),
                        'oxi-image-strip-vertical-top-right' => esc_html__('Strip Vertical Top Right', 'image-hover-effects-ultimate'),
                        'oxi-image-strip-vertical-bottom-left' => esc_html__('Strip Vertical Bottom Left', 'image-hover-effects-ultimate'),
                        'oxi-image-strip-vertical-bottom-right' => esc_html__('Strip Vertical Bottom Right', 'image-hover-effects-ultimate'),
                    ],
                    'selector' => [
                        '{{WRAPPER}} .oxi-image-caption-hover' => '',
                    ],
                    'simpledescription' => 'Allows you to Set Effects Direction.',
                    'description' => 'Allows you to Set Effects Direction.',
                        ]
        );
    }

}
