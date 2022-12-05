<?php

namespace OXI_IMAGE_HOVER_PLUGINS\Modules\Caption\Admin;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Description of Effects18
 *
 * @author biplo
 */
use OXI_IMAGE_HOVER_PLUGINS\Modules\Caption\Modules as Modules;
use OXI_IMAGE_HOVER_PLUGINS\Classes\Controls as Controls;

class Effects18 extends Modules {

    public function register_effects() {
        return $this->add_control(
                        'image_hover_effects', $this->style, [
                    'label' => esc_html__('Effects Direction', 'image-hover-effects-ultimate'),
                    'type' => Controls::SELECT,
                    'default' => '',
                    'options' => [
                        'oxi-image-pivot-in-top-left' => esc_html__('Pivot In Top Left', 'image-hover-effects-ultimate'),
                        'oxi-image-pivot-in-top-right' => esc_html__('Pivot In Top Right', 'image-hover-effects-ultimate'),
                        'oxi-image-pivot-in-bottom-left' => esc_html__('Pivot In Bottom Left', 'image-hover-effects-ultimate'),
                        'oxi-image-pivot-in-bottom-right' => esc_html__('Pivot In Bottom Right', 'image-hover-effects-ultimate'),
                        'oxi-image-pivot-out-top-left' => esc_html__('Pivot Out Top Left', 'image-hover-effects-ultimate'),
                        'oxi-image-pivot-out-top-right' => esc_html__('Pivot Out Top Right', 'image-hover-effects-ultimate'),
                        'oxi-image-pivot-out-bottom-left' => esc_html__('Pivot Out Bottom Left', 'image-hover-effects-ultimate'),
                        'oxi-image-pivot-out-bottom-right' => esc_html__('Pivot Out Bottom Right', 'image-hover-effects-ultimate'),
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
