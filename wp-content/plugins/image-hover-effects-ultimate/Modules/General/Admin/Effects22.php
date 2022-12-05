<?php

namespace OXI_IMAGE_HOVER_PLUGINS\Modules\General\Admin;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Description of Effects1
 *
 * @author biplo
 */
use OXI_IMAGE_HOVER_PLUGINS\Modules\General\Modules as Modules;
use OXI_IMAGE_HOVER_PLUGINS\Classes\Controls as Controls;

class Effects22 extends Modules {

    public function register_effects() {
        return $this->add_control(
                        'image_hover_effects', $this->style, [
                    'label' => esc_html__('Effects Direction', 'image-hover-effects-ultimate'),
                    'type' => Controls::SELECT,
                    'default' => 'left_to_right',
                    'options' => [
                        'top_to_bottom' => esc_html__('Top To Bottom', 'image-hover-effects-ultimate'),
                        'bottom_to_top' => esc_html__('Bottom To Top', 'image-hover-effects-ultimate'),
                        'left_to_right' => esc_html__('Left To Right', 'image-hover-effects-ultimate'),
                        'right_to_left' => esc_html__('Right To Left', 'image-hover-effects-ultimate'),
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
