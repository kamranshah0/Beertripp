<?php

namespace OXI_IMAGE_HOVER_PLUGINS\Modules\Caption\Admin;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Description of Effects29
 *
 * @author biplo
 */
use OXI_IMAGE_HOVER_PLUGINS\Modules\Caption\Modules as Modules;
use OXI_IMAGE_HOVER_PLUGINS\Classes\Controls as Controls;

class Effects29 extends Modules {

    public function register_effects() {
        return $this->add_control(
                        'image_hover_effects', $this->style, [
                    'label' => esc_html__('Effects Direction', 'image-hover-effects-ultimate'),
                    'type' => Controls::SELECT,
                    'default' => '',
                    'options' => [
                        'oxi-image-switch-up' => esc_html__('Switch Up', 'image-hover-effects-ultimate'),
                        'oxi-image-switch-down' => esc_html__('Switch Down', 'image-hover-effects-ultimate'),
                        'oxi-image-switch-left' => esc_html__('Switch Left', 'image-hover-effects-ultimate'),
                        'oxi-image-switch-right' => esc_html__('Switch Right', 'image-hover-effects-ultimate'),
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
