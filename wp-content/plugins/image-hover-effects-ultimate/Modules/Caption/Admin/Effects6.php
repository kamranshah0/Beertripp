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

class Effects6 extends Modules {

    public function register_effects() {
        return $this->add_control(
                        'image_hover_effects', $this->style, [
                    'label' => esc_html__('Effects Direction', 'image-hover-effects-ultimate'),
                    'type' => Controls::SELECT,
                    'default' => '',
                    'options' => [
                        'oxi-image-circle-up' => esc_html__('Circle Up', 'image-hover-effects-ultimate'),
                        'oxi-image-circle-down' => esc_html__('Circle Down', 'image-hover-effects-ultimate'),
                        'oxi-image-circle-left' => esc_html__('Circle Left', 'image-hover-effects-ultimate'),
                        'oxi-image-circle-right' => esc_html__('Circle Right', 'image-hover-effects-ultimate'),
                        'oxi-image-circle-top-left' => esc_html__('Circle Top Left', 'image-hover-effects-ultimate'),
                        'oxi-image-circle-top-right' => esc_html__('Circle Top Right', 'image-hover-effects-ultimate'),
                        'oxi-image-circle-bottom-left' => esc_html__('Circle Bottom Left', 'image-hover-effects-ultimate'),
                        'oxi-image-circle-bottom-right' => esc_html__('Circle Bottom Right', 'image-hover-effects-ultimate'),
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
