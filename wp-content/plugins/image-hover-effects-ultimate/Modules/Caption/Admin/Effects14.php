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

class Effects14 extends Modules {

    public function register_effects() {
        return $this->add_control(
                        'image_hover_effects', $this->style, [
                    'label' => esc_html__('Effects Direction', 'image-hover-effects-ultimate'),
                    'type' => Controls::SELECT,
                    'default' => '',
                    'options' => [
                        'oxi-image-hinge-up' => esc_html__('Hinge Up', 'image-hover-effects-ultimate'),
                        'oxi-image-hinge-down' => esc_html__('Hinge Down', 'image-hover-effects-ultimate'),
                        'oxi-image-hinge-left' => esc_html__('Hinge Left', 'image-hover-effects-ultimate'),
                        'oxi-image-hinge-right' => esc_html__('Hinge Right', 'image-hover-effects-ultimate'),
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
