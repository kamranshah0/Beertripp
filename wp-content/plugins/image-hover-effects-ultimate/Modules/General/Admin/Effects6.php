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

class Effects6 extends Modules {

    public function register_effects() {
        return $this->add_control(
                        'image_hover_effects', $this->style, [
                    'label' => esc_html__('Effects Direction', 'image-hover-effects-ultimate'),
                    'type' => Controls::SELECT,
                    'default' => 'left_to_right',
                    'options' => [
                        'scale_up' => esc_html__('Scale Up', 'image-hover-effects-ultimate'),
                        'scale_down' => esc_html__('Scale Down', 'image-hover-effects-ultimate'),
                        'scale_down_up' => esc_html__('Scale up Down', 'image-hover-effects-ultimate'),
                    ],
                    'selector' => [
                        '{{WRAPPER}} .oxi-image-hover-figure' => '',
                    ],
                    'simpledescription' => 'Allows you to Set Effects Direction.',
                    'description' => 'Allows you to Set Effects Direction.',
                        ]
        );
    }

    public function register_effects_time() {
        $this->add_control(
                'oxi-image-hover-effects-time', $this->style, [
            'label' => esc_html__('Effects Time (S)', 'image-hover-effects-ultimate'),
            'type' => Controls::SLIDER,
            'simpleenable' => false,
            'default' => [
                'unit' => 'ms',
                'size' => '',
            ],
            'range' => [
                'ms' => [
                    'min' => 0.0,
                    'max' => 5000,
                    'step' => 1,
                ],
                's' => [
                    'min' => 0.0,
                    'max' => 5,
                    'step' => 0.01,
                ],
            ],
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover-style *,{{WRAPPER}} .oxi-image-hover-style *:before,{{WRAPPER}} .oxi-image-hover-style *:after' => '-webkit-transition: all {{SIZE}}{{UNIT}} ease-in-out; -moz-transition: all {{SIZE}}{{UNIT}} ease-in-out; transition: all {{SIZE}}{{UNIT}} ease-in-out;',
                '{{WRAPPER}} .oxi-image-general-hover-style-6 .oxi-image-hover-figure.scale_down_up .oxi-image-hover-figure-caption' => '-webkit-transition: all {{SIZE}}{{UNIT}} ease-in-out {{SIZE}}{{UNIT}} ; -moz-transition: all {{SIZE}}{{UNIT}} ease-in-out {{SIZE}}{{UNIT}} ; transition: all {{SIZE}}{{UNIT}} ease-in-out {{SIZE}}{{UNIT}} ;',
            ],
            'description' => 'Set Effects Durations as How long you want to run Effects. Options available with Second or Milisecond.',
                ]
        );
    }

}
