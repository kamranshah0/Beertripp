<?php

namespace OXI_IMAGE_HOVER_PLUGINS\Modules\Square\Admin;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Description of Effects18
 *
 * @author biplo
 */
use OXI_IMAGE_HOVER_PLUGINS\Modules\Square\Modules as Modules;
use OXI_IMAGE_HOVER_PLUGINS\Classes\Controls as Controls;

class Effects18 extends Modules {

    public function register_effects() {
        return $this->add_control(
                        'image_hover_effects', $this->style, [
                    'label' => esc_html__('Effects Direction', 'image-hover-effects-ultimate'),
                    'type' => Controls::SELECT,
                    'default' => 'left_to_right',
                    'options' => [
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

    public function register_content_settings() {
        $this->start_controls_section(
                'oxi-image-hover', [
            'label' => esc_html__('Content Settings', 'image-hover-effects-ultimate'),
            'showing' => TRUE,
                ]
        );
        $this->add_control(
                'oxi-image-hover-background-color', $this->style, [
            'label' => esc_html__('Background', 'image-hover-effects-ultimate'),
            'type' => Controls::GRADIENT,
            'default' => 'rgba(255, 116, 3, 1)',
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover-caption-tab' => 'background:{{VALUE}};',
            ],
            'simpledescription' => 'Customize Hover Background with transparent options.',
            'description' => 'Customize Hover Background with Color or Gradient or Image properties.',
                ]
        );
        $this->start_controls_tabs(
                'image-hover-content-start-tabs',
                [
                    'options' => [
                        'normal' => esc_html__('Normal ', 'image-hover-effects-ultimate'),
                        'hover' => esc_html__('Hover ', 'image-hover-effects-ultimate'),
                    ]
                ]
        );
        $this->start_controls_tab();
        $this->add_group_control(
                'oxi-image-hover-boxshadow', $this->style, [
            'type' => Controls::BOXSHADOW,
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover-figure, {{WRAPPER}} .oxi-image-hover-figure:before' => '',
            ],
            'description' => 'Box Shadow property attaches one or more shadows into Image shape.',
                ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab();

        $this->add_group_control(
                'oxi-image-hover-hover-boxshadow', $this->style, [
            'type' => Controls::BOXSHADOW,
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover:hover .oxi-image-hover-figure,'
                . '{{WRAPPER}} .oxi-image-hover.oxi-touch .oxi-image-hover-figure,'
                . '{{WRAPPER}} .oxi-image-hover:hover .oxi-image-hover-figure:before,'
                . '{{WRAPPER}} .oxi-image-hover.oxi-touch .oxi-image-hover-figure:before' => '',
            ],
            'description' => 'Allows you at hover to attaches one or more shadows into Image shape.',
                ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_responsive_control(
                'oxi-image-hover-padding', $this->style, [
            'label' => esc_html__('Padding', 'image-hover-effects-ultimate'),
            'type' => Controls::DIMENSIONS,
            'separator' => TRUE,
            'simpledimensions' => 'double',
            'default' => [
                'unit' => 'px',
                'size' => '',
            ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 500,
                    'step' => 1,
                ],
                '%' => [
                    'min' => 0,
                    'max' => 100,
                    'step' => 1,
                ],
                'em' => [
                    'min' => 0,
                    'max' => 100,
                    'step' => .1,
                ],
            ],
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover-figure .oxi-image-hover-caption-tab' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'simpledescription' => 'Padding used to generate space around an Image Hover content.',
            'description' => 'Padding used to generate space around an Image Hover content.',
                ]
        );
        $this->end_controls_section();
    }

    public function register_heading_settings() {
        $this->start_controls_section(
                'oxi-image-hover', [
            'label' => esc_html__('Heading Settings', 'image-hover-effects-ultimate'),
            'showing' => TRUE,
                ]
        );
        $this->add_group_control(
                'oxi-image-hover-heading-typho', $this->style, [
            'type' => Controls::TYPOGRAPHY,
            'include' => Controls::ALIGNNORMAL,
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover-figure-caption .oxi-image-hover-heading' => '',
            ]
                ]
        );
        $this->add_control(
                'oxi-image-hover-heading-color', $this->style, [
            'label' => esc_html__('Color', 'image-hover-effects-ultimate'),
            'type' => Controls::COLOR,
            'default' => '#ffffff',
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover-figure-caption .oxi-image-hover-heading' => 'color: {{VALUE}};',
            ],
            'simpledescription' => 'Color property is used to set the color of the Heading.',
            'description' => 'Color property is used to set the color of the Heading.',
                ]
        );
        $this->add_group_control(
                'oxi-image-hover-heading-tx-shadow', $this->style, [
            'type' => Controls::TEXTSHADOW,
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover-figure-caption .oxi-image-hover-heading' => '',
            ],
            'simpledescription' => 'Text Shadow property adds shadow to Heading.',
            'description' => 'Text Shadow property adds shadow to Heading.',
                ]
        );

        $this->add_responsive_control(
                'oxi-image-hover-heading-margin', $this->style, [
            'label' => esc_html__('Margin', 'image-hover-effects-ultimate'),
            'type' => Controls::DIMENSIONS,
            'simpledimensions' => 'heading',
            'default' => [
                'unit' => 'px',
                'size' => '',
            ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 500,
                    'step' => 1,
                ],
                '%' => [
                    'min' => 0,
                    'max' => 100,
                    'step' => 1,
                ],
                'em' => [
                    'min' => 0,
                    'max' => 100,
                    'step' => .1,
                ],
            ],
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover-figure-caption .oxi-image-hover-figure-heading' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'simpledescription' => 'Margin properties are used to create space around Heading.',
            'description' => 'Margin properties are used to create space around Heading.',
                ]
        );
        $this->add_control(
                'oxi-image-hover-heading-animation', $this->style, [
            'label' => esc_html__('Animation', 'image-hover-effects-ultimate'),
            'type' => Controls::SELECT,
            'default' => '',
            'options' => [
                '' => esc_html__('None', 'image-hover-effects-ultimate'),
                'iheu-fade-up' => esc_html__('Fade Up', 'image-hover-effects-ultimate'),
                'iheu-fade-down' => esc_html__('Fade Down', 'image-hover-effects-ultimate'),
                'iheu-fade-left' => esc_html__('Fade Left', 'image-hover-effects-ultimate'),
                'iheu-fade-right' => esc_html__('Fade Right', 'image-hover-effects-ultimate'),
                'iheu-fade-up-big' => esc_html__('Fade up Big', 'image-hover-effects-ultimate'),
                'iheu-fade-down-big' => esc_html__('Fade down Big', 'image-hover-effects-ultimate'),
                'iheu-fade-left-big' => esc_html__('Fade left Big', 'image-hover-effects-ultimate'),
                'iheu-fade-right-big' => esc_html__('Fade Right Big', 'image-hover-effects-ultimate'),
                'iheu-zoom-in' => esc_html__('Zoom In', 'image-hover-effects-ultimate'),
                'iheu-zoom-out' => esc_html__('Zoom Out', 'image-hover-effects-ultimate'),
                'iheu-flip-x' => esc_html__('Flip X', 'image-hover-effects-ultimate'),
                'iheu-flip-y' => esc_html__('Flip Y', 'image-hover-effects-ultimate'),
            ],
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover-figure-caption .oxi-image-hover-figure-heading' => '',
            ],
            'simpledescription' => 'Allows you to animated Heading while viewing.',
            'description' => 'Allows you to animated Heading while viewing.',
                ]
        );
        $this->add_control(
                'oxi-image-hover-heading-animation-delay', $this->style, [
            'label' => esc_html__('Animation Delay', 'image-hover-effects-ultimate'),
            'type' => Controls::SELECT,
            'default' => '',
            'options' => [
                '' => esc_html__('None', 'image-hover-effects-ultimate'),
                'oxi-image-hover-delay-xs' => esc_html__('Delay XS', 'image-hover-effects-ultimate'),
                'oxi-image-hover-delay-sm' => esc_html__('Delay SM', 'image-hover-effects-ultimate'),
                'oxi-image-hover-delay-md' => esc_html__('Delay MD', 'image-hover-effects-ultimate'),
                'oxi-image-hover-delay-lg' => esc_html__('Delay LG', 'image-hover-effects-ultimate'),
                'oxi-image-hover-delay-xl' => esc_html__('Delay XL', 'image-hover-effects-ultimate'),
                'oxi-image-hover-delay-xxl' => esc_html__('Delay XXL', 'image-hover-effects-ultimate'),
            ],
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover-figure-caption .oxi-image-hover-figure-heading' => '',
            ],
            'simpledescription' => 'Allows you to animation delay at Heading while viewing.',
            'description' => 'Allows you to animation delay at Heading while viewing.',
                ]
        );

        $this->end_controls_section();
    }

    public function register_heading_underline() {

    }

}
