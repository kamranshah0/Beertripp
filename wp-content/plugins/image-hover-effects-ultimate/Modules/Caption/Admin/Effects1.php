<?php

namespace OXI_IMAGE_HOVER_PLUGINS\Modules\Caption\Admin;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Description of Effects1
 *
 * @author biplo
 */
use OXI_IMAGE_HOVER_PLUGINS\Modules\Caption\Modules as Modules;
use OXI_IMAGE_HOVER_PLUGINS\Classes\Controls as Controls;

class Effects1 extends Modules {

    public function register_effects() {
        return $this->add_control(
                        'image_hover_effects', $this->style, [
                    'label' => esc_html__('Effects Direction', 'image-hover-effects-ultimate'),
                    'type' => Controls::SELECT,
                    'default' => '',
                    'options' => [
                        'oxi-image-blinds-horizontal' => esc_html__('Blinds Horizontal', 'image-hover-effects-ultimate'),
                        'oxi-image-blinds-vertical' => esc_html__('Blinds Vertical', 'image-hover-effects-ultimate'),
                        'oxi-image-blinds-up' => esc_html__('Blinds Up', 'image-hover-effects-ultimate'),
                        'oxi-image-blinds-down' => esc_html__('Blinds Down', 'image-hover-effects-ultimate'),
                        'oxi-image-blinds-left' => esc_html__('Blinds Left', 'image-hover-effects-ultimate'),
                        'oxi-image-blinds-right' => esc_html__('Blinds Right', 'image-hover-effects-ultimate'),
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
