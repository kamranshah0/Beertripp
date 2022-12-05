<?php

namespace OXI_IMAGE_HOVER_PLUGINS\Modules\Caption\Admin;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Description of Effects24
 *
 * @author biplo
 */
use OXI_IMAGE_HOVER_PLUGINS\Modules\Caption\Modules as Modules;
use OXI_IMAGE_HOVER_PLUGINS\Classes\Controls as Controls;

class Effects24 extends Modules {

    public function register_effects() {
        return $this->add_control(
                        'image_hover_effects', $this->style, [
                    'label' => esc_html__('Effects Direction', 'image-hover-effects-ultimate'),
                    'type' => Controls::SELECT,
                    'default' => '',
                    'options' => [
                        'oxi-image-shutter-out-horizontal' => esc_html__('Shutter Out Horizontal', 'image-hover-effects-ultimate'),
                        'oxi-image-shutter-out-vertical' => esc_html__('Shutter Out Vertical', 'image-hover-effects-ultimate'),
                        'oxi-image-shutter-out-diagonal-1' => esc_html__('Shutter Out Diagonal One', 'image-hover-effects-ultimate'),
                        'oxi-image-shutter-out-diagonal-2' => esc_html__('Shutter Out Diagonal Two', 'image-hover-effects-ultimate'),
                        'oxi-image-shutter-in-horizontal' => esc_html__('Shutter In Horizontal', 'image-hover-effects-ultimate'),
                        'oxi-image-shutter-in-vertical' => esc_html__('Shutter In Vertical', 'image-hover-effects-ultimate'),
                        'oxi-image-shutter-in-out-horizontal' => esc_html__('Shutter In Out Horizontal', 'image-hover-effects-ultimate'),
                        'oxi-image-shutter-in-out-vertical' => esc_html__('Shutter In Out Vertical', 'image-hover-effects-ultimate'),
                        'oxi-image-shutter-in-out-diagonal-1' => esc_html__('Shutter In Out Diagonal One', 'image-hover-effects-ultimate'),
                        'oxi-image-shutter-in-out-diagonal-2' => esc_html__('Shutter In Out Diagonal Two', 'image-hover-effects-ultimate'),
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
