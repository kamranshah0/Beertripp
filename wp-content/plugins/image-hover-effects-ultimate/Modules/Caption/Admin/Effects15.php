<?php

namespace OXI_IMAGE_HOVER_PLUGINS\Modules\Caption\Admin;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Description of Effects14
 *
 * @author biplo
 */
use OXI_IMAGE_HOVER_PLUGINS\Modules\Caption\Modules as Modules;
use OXI_IMAGE_HOVER_PLUGINS\Classes\Controls as Controls;

class Effects15 extends Modules {

    public function register_effects() {
        return $this->add_control(
                        'image_hover_effects', $this->style, [
                    'label' => esc_html__('Effects Direction', 'image-hover-effects-ultimate'),
                    'type' => Controls::SELECT,
                    'default' => '',
                    'options' => [
                        'oxi-image-lightspeed-in-left' => esc_html__('Lightspeed In Left', 'image-hover-effects-ultimate'),
                        'oxi-image-lightspeed-in-right' => esc_html__('Lightspeed In Right', 'image-hover-effects-ultimate'),
                        'oxi-image-lightspeed-out-left' => esc_html__('Lightspeed Out Left', 'image-hover-effects-ultimate'),
                        'oxi-image-lightspeed-out-right' => esc_html__('Lightspeed Out Right', 'image-hover-effects-ultimate'),
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
