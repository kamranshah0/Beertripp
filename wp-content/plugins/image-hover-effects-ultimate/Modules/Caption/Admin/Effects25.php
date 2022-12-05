<?php

namespace OXI_IMAGE_HOVER_PLUGINS\Modules\Caption\Admin;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Description of Effects25
 *
 * @author biplo
 */
use OXI_IMAGE_HOVER_PLUGINS\Modules\Caption\Modules as Modules;
use OXI_IMAGE_HOVER_PLUGINS\Classes\Controls as Controls;

class Effects25 extends Modules {

    public function register_effects() {
        return $this->add_control(
                        'image_hover_effects', $this->style, [
                    'label' => esc_html__('Effects Direction', 'image-hover-effects-ultimate'),
                    'type' => Controls::SELECT,
                    'default' => '',
                    'options' => [
                        'oxi-image-slide-up' => esc_html__('Slide Up', 'image-hover-effects-ultimate'),
                        'oxi-image-slide-down' => esc_html__('Slide Down', 'image-hover-effects-ultimate'),
                        'oxi-image-slide-left' => esc_html__('Slide Left', 'image-hover-effects-ultimate'),
                        'oxi-image-slide-right' => esc_html__('Slide Right', 'image-hover-effects-ultimate'),
                        'oxi-image-slide-top-left' => esc_html__('Slide Top Left', 'image-hover-effects-ultimate'),
                        'oxi-image-slide-top-right' => esc_html__('Slide Top Right', 'image-hover-effects-ultimate'),
                        'oxi-image-slide-bottom-left' => esc_html__('Slide Bottom Left', 'image-hover-effects-ultimate'),
                        'oxi-image-slide-bottom-right' => esc_html__('Slide Bottom Right', 'image-hover-effects-ultimate'),
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
