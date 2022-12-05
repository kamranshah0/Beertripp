<?php

namespace OXI_IMAGE_HOVER_PLUGINS\Modules\Caption\Admin;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Description of Effects21
 *
 * @author biplo
 */
use OXI_IMAGE_HOVER_PLUGINS\Modules\Caption\Modules as Modules;
use OXI_IMAGE_HOVER_PLUGINS\Classes\Controls as Controls;

class Effects21 extends Modules {

    public function register_effects() {
        return $this->add_control(
                        'image_hover_effects', $this->style, [
                    'label' => esc_html__('Effects Direction', 'image-hover-effects-ultimate'),
                    'type' => Controls::SELECT,
                    'default' => '',
                    'options' => [
                        'oxi-image-reveal-up' => esc_html__('Reveal Up', 'image-hover-effects-ultimate'),
                        'oxi-image-reveal-down' => esc_html__('Reveal Down', 'image-hover-effects-ultimate'),
                        'oxi-image-reveal-left' => esc_html__('Reveal Left', 'image-hover-effects-ultimate'),
                        'oxi-image-reveal-right' => esc_html__('Reveal Right', 'image-hover-effects-ultimate'),
                        'oxi-image-reveal-top-left' => esc_html__('Reveal Top Left', 'image-hover-effects-ultimate'),
                        'oxi-image-reveal-top-right' => esc_html__('Reveal Top Right', 'image-hover-effects-ultimate'),
                        'oxi-image-reveal-bottom-left' => esc_html__('Reveal Bottom Left', 'image-hover-effects-ultimate'),
                        'oxi-image-reveal-bottom-right' => esc_html__('Reveal Bottom Right', 'image-hover-effects-ultimate'),
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
