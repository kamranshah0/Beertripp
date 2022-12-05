<?php

namespace OXI_IMAGE_HOVER_PLUGINS\Modules\Caption\Admin;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Description of Effects16
 *
 * @author biplo
 */
use OXI_IMAGE_HOVER_PLUGINS\Modules\Caption\Modules as Modules;
use OXI_IMAGE_HOVER_PLUGINS\Classes\Controls as Controls;

class Effects16 extends Modules {

    public function register_effects() {
        return $this->add_control(
                        'image_hover_effects', $this->style, [
                    'label' => esc_html__('Effects Direction', 'image-hover-effects-ultimate'),
                    'type' => Controls::SELECT,
                    'default' => '',
                    'options' => [
                        'oxi-image-modal-slide-up' => esc_html__('Modal Slide Up', 'image-hover-effects-ultimate'),
                        'oxi-image-modal-slide-down' => esc_html__('Modal Slide Down', 'image-hover-effects-ultimate'),
                        'oxi-image-modal-slide-left' => esc_html__('Modal Slide Left', 'image-hover-effects-ultimate'),
                        'oxi-image-modal-slide-right' => esc_html__('Modal Slide Right', 'image-hover-effects-ultimate'),
                        'oxi-image-modal-hinge-up' => esc_html__('Modal Hinge Up', 'image-hover-effects-ultimate'),
                        'oxi-image-modal-hinge-down' => esc_html__('Modal Hinge Down', 'image-hover-effects-ultimate'),
                        'oxi-image-modal-hinge-left' => esc_html__('Modal Hinge Left', 'image-hover-effects-ultimate'),
                        'oxi-image-modal-hinge-right' => esc_html__('Modal Hinge Right', 'image-hover-effects-ultimate'),
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
