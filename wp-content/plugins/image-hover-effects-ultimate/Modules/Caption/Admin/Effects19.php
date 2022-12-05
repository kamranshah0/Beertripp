<?php

namespace OXI_IMAGE_HOVER_PLUGINS\Modules\Caption\Admin;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Description of Effects19
 *
 * @author biplo
 */
use OXI_IMAGE_HOVER_PLUGINS\Modules\Caption\Modules as Modules;
use OXI_IMAGE_HOVER_PLUGINS\Classes\Controls as Controls;

class Effects19 extends Modules {

    public function register_effects() {
        return $this->add_control(
                        'image_hover_effects', $this->style, [
                    'label' => esc_html__('Effects Direction', 'image-hover-effects-ultimate'),
                    'type' => Controls::SELECT,
                    'default' => '',
                    'options' => [
                        'oxi-image-pixel-up' => esc_html__('Pixel Up', 'image-hover-effects-ultimate'),
                        'oxi-image-pixel-down' => esc_html__('Pixel Down', 'image-hover-effects-ultimate'),
                        'oxi-image-pixel-left' => esc_html__('Pixel Left', 'image-hover-effects-ultimate'),
                        'oxi-image-pixel-right' => esc_html__('Pixel Right', 'image-hover-effects-ultimate'),
                        'oxi-image-pixel-top-left' => esc_html__('Pixel Top Left', 'image-hover-effects-ultimate'),
                        'oxi-image-pixel-top-right' => esc_html__('Pixel Top Right', 'image-hover-effects-ultimate'),
                        'oxi-image-pixel-bottom-left' => esc_html__('Pixel Bottom Left', 'image-hover-effects-ultimate'),
                        'oxi-image-pixel-bottom-right' => esc_html__('Pixel Bottom Right', 'image-hover-effects-ultimate'),
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
