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

class Effects9 extends Modules {

    public function register_effects() {
        return $this->add_control(
                        'image_hover_effects', $this->style, [
                    'label' => esc_html__('Effects Direction', 'image-hover-effects-ultimate'),
                    'type' => Controls::SELECT,
                    'default' => '',
                    'options' => [
                        'oxi-image-fade-in-up' => esc_html__('Fade In Up', 'image-hover-effects-ultimate'),
                        'oxi-image-fade-in-down' => esc_html__('Fade In Down', 'image-hover-effects-ultimate'),
                        'oxi-image-fade-in-left' => esc_html__('Fade In Left', 'image-hover-effects-ultimate'),
                        'oxi-image-fade-in-right' => esc_html__('Fade In Right', 'image-hover-effects-ultimate'),
                    ],
                    'selector' => [
                        '{{WRAPPER}} .oxi-image-caption-hover' => '',
                    ]
                        ]
        );
    }

}
