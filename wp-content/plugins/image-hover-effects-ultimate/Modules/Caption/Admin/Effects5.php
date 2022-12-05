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

class Effects5 extends Modules {

    public function register_effects() {
        return $this->add_control(
                        'image_hover_effects', $this->style, [
                    'label' => esc_html__('Effects Direction', 'image-hover-effects-ultimate'),
                    'type' => Controls::SELECT,
                    'default' => '',
                    'options' => [
                        'oxi-image-bounce-in' => esc_html__('Bounce In', 'image-hover-effects-ultimate'),
                        'oxi-image-bounce-in-up' => esc_html__('Bounce In Up', 'image-hover-effects-ultimate'),
                        'oxi-image-bounce-in-down' => esc_html__('Bounce In Down', 'image-hover-effects-ultimate'),
                        'oxi-image-bounce-in-left' => esc_html__('Bounce In Left', 'image-hover-effects-ultimate'),
                        'oxi-image-bounce-in-right' => esc_html__('Bounce In Right', 'image-hover-effects-ultimate'),
                        'oxi-image-bounce-out' => esc_html__('Bounce Out', 'image-hover-effects-ultimate'),
                        'oxi-image-bounce-out-up' => esc_html__('Bounce Out Up', 'image-hover-effects-ultimate'),
                        'oxi-image-bounce-out-down' => esc_html__('Bounce Out Down', 'image-hover-effects-ultimate'),
                        'oxi-image-bounce-out-left' => esc_html__('Bounce Out Left', 'image-hover-effects-ultimate'),
                        'oxi-image-bounce-out-right' => esc_html__('Bounce Out Right', 'image-hover-effects-ultimate'),
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
