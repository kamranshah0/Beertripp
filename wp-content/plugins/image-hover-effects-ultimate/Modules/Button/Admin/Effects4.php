<?php

namespace OXI_IMAGE_HOVER_PLUGINS\Modules\Button\Admin;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Description of Effects4
 *
 * @author biplo
 */
use OXI_IMAGE_HOVER_PLUGINS\Modules\Button\Modules as Modules;
use OXI_IMAGE_HOVER_PLUGINS\Classes\Controls as Controls;

class Effects4 extends Modules {

    public function register_effects() {
        return $this->add_control(
                        'image_hover_effects', $this->style, [
                    'label' => esc_html__('Effects Direction', 'image-hover-effects-ultimate'),
                    'type' => Controls::SELECT,
                    'default' => 'left_to_right',
                    'options' => [
                        'left_to_right' => esc_html__('Scale In', 'image-hover-effects-ultimate'),
                        'right_to_left' => esc_html__('Scale Out', 'image-hover-effects-ultimate'),
                    ],
                    'selector' => [
                        '{{WRAPPER}} .oxi-image-hover-figure' => '',
                    ],
                    'simpledescription' => 'Allows you to Set Effects Direction.',
                    'description' => 'Allows you to Set Effects Direction.',
                        ]
        );
    }

}
