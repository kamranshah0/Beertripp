<?php

namespace OXI_IMAGE_HOVER_PLUGINS\Modules\Caption\Admin;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Description of Effects27
 *
 * @author biplo
 */
use OXI_IMAGE_HOVER_PLUGINS\Modules\Caption\Modules as Modules;
use OXI_IMAGE_HOVER_PLUGINS\Classes\Controls as Controls;

class Effects27 extends Modules {

    public function register_effects() {
        return $this->add_control(
                        'image_hover_effects', $this->style, [
                    'label' => esc_html__('Effects Direction', 'image-hover-effects-ultimate'),
                    'type' => Controls::SELECT,
                    'default' => '',
                    'options' => [
                        'oxi-image-stack-up' => esc_html__('Stack Up', 'image-hover-effects-ultimate'),
                        'oxi-image-stack-down' => esc_html__('Stack Down', 'image-hover-effects-ultimate'),
                        'oxi-image-stack-left' => esc_html__('Stack Left', 'image-hover-effects-ultimate'),
                        'oxi-image-stack-right' => esc_html__('Stack Right', 'image-hover-effects-ultimate'),
                        'oxi-image-stack-top-left' => esc_html__('Stack Top Left', 'image-hover-effects-ultimate'),
                        'oxi-image-stack-top-right' => esc_html__('Stack Top Right', 'image-hover-effects-ultimate'),
                        'oxi-image-stack-bottom-left' => esc_html__('Stack Bottom Left', 'image-hover-effects-ultimate'),
                        'oxi-image-stack-bottom-right' => esc_html__('Stack Bottom Right', 'image-hover-effects-ultimate'),
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
