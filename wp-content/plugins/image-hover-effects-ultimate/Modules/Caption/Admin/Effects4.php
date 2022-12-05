<?php

namespace OXI_IMAGE_HOVER_PLUGINS\Modules\Caption\Admin;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Description of Effects3
 *
 * @author biplo
 */
use OXI_IMAGE_HOVER_PLUGINS\Modules\Caption\Modules as Modules;
use OXI_IMAGE_HOVER_PLUGINS\Classes\Controls as Controls;

class Effects4 extends Modules {

    public function register_effects() {
        return $this->add_control(
                        'image_hover_effects', $this->style, [
                    'label' => esc_html__('Effects Direction', 'image-hover-effects-ultimate'),
                    'type' => Controls::SELECT,
                    'default' => '',
                    'options' => [
                        'oxi-image-border-reveal' => esc_html__('Border Reveal', 'image-hover-effects-ultimate'),
                        'oxi-image-border-reveal-vertical' => esc_html__('Border Reveal Vertical', 'image-hover-effects-ultimate'),
                        'oxi-image-border-reveal-horizontal' => esc_html__('Border Reveal Horizontal', 'image-hover-effects-ultimate'),
                        'oxi-image-border-reveal-corners-1' => esc_html__('Border Reveal Corners One', 'image-hover-effects-ultimate'),
                        'oxi-image-border-reveal-corners-2' => esc_html__('Border Reveal Corners Two', 'image-hover-effects-ultimate'),
                        'oxi-image-border-reveal-top-left' => esc_html__('Border Reveal Top Left', 'image-hover-effects-ultimate'),
                        'oxi-image-border-reveal-top-right' => esc_html__('Border Reveal Top Right', 'image-hover-effects-ultimate'),
                        'oxi-image-border-reveal-bottom-left' => esc_html__('Border Reveal Bottom Left', 'image-hover-effects-ultimate'),
                        'oxi-image-border-reveal-bottom-right' => esc_html__('Border Reveal Bottom Right', 'image-hover-effects-ultimate'),
                        'oxi-image-border-reveal-cc-1' => esc_html__('Border Reveal CC One', 'image-hover-effects-ultimate'),
                        'oxi-image-border-reveal-ccc-1' => esc_html__('Border Reveal CCC One', 'image-hover-effects-ultimate'),
                        'oxi-image-border-reveal-cc-2' => esc_html__('Border Reveal CC Two', 'image-hover-effects-ultimate'),
                        'oxi-image-border-reveal-ccc-2' => esc_html__('Border Reveal CCC Two', 'image-hover-effects-ultimate'),
                        'oxi-image-border-reveal-cc-3' => esc_html__('Border Reveal CC Three', 'image-hover-effects-ultimate'),
                        'oxi-image-border-reveal-ccc-3' => esc_html__('Border Reveal CCC Three', 'image-hover-effects-ultimate'),
                    ],
                    'selector' => [
                        '{{WRAPPER}} .oxi-image-caption-hover' => '',
                    ],
                    'simpledescription' => 'Allows you to Set Effects Direction.',
                    'description' => 'Allows you to Set Effects Direction.',
                        ]
        );
    }

    public function register_content_settings() {
        $this->start_controls_section(
                'oxi-image-hover', [
            'label' => esc_html__('General Settings', 'image-hover-effects-ultimate'),
            'showing' => TRUE,
                ]
        );
        $this->add_control(
                'oxi-image-hover-background', $this->style, [
            'label' => esc_html__('Color', 'image-hover-effects-ultimate'),
            'type' => Controls::COLOR,
            'oparetor' => true,
            'default' => 'rgba(9, 124, 219, 1)',
            'selector' => [
                '{{WRAPPER}} .oxi-image-caption-hover,
                {{WRAPPER}} .oxi-image-caption-hover:before,
                {{WRAPPER}} .oxi-image-caption-hover:after,
                {{WRAPPER}} .oxi-image-caption-hover .oxi-image-hover-figure,
                {{WRAPPER}} .oxi-image-caption-hover .oxi-image-hover-figure:before,
                {{WRAPPER}} .oxi-image-caption-hover .oxi-image-hover-figure:after,
                {{WRAPPER}} .oxi-image-caption-hover .oxi-image-hover-figure-caption,
                {{WRAPPER}} .oxi-image-caption-hover .oxi-image-hover-figure-caption:before,
                {{WRAPPER}} .oxi-image-caption-hover .oxi-image-hover-figure-caption:after' => 'background-color: {{VALUE}};',
            ],
            'simpledescription' => 'Customize Hover Background with transparent options.',
            'description' => 'Customize Hover Background with transparent options.',
                ]
        );
        $this->add_control(
                'oxi-image-hover-content-alignment', $this->style, [
            'label' => esc_html__('Content Alignment', 'image-hover-effects-ultimate'),
            'type' => Controls::SELECT,
            'default' => 'image-hover-align-center-center',
            'options' => [
                'image-hover-align-top-left' => esc_html__('Top Left', 'image-hover-effects-ultimate'),
                'image-hover-align-top-center' => esc_html__('Top Center', 'image-hover-effects-ultimate'),
                'image-hover-align-top-right' => esc_html__('Top Right', 'image-hover-effects-ultimate'),
                'image-hover-align-center-left' => esc_html__('Center Left', 'image-hover-effects-ultimate'),
                'image-hover-align-center-center' => esc_html__('Center Center', 'image-hover-effects-ultimate'),
                'image-hover-align-center-right' => esc_html__('Center Right', 'image-hover-effects-ultimate'),
                'image-hover-align-bottom-left' => esc_html__('Bottom Left', 'image-hover-effects-ultimate'),
                'image-hover-align-bottom-center' => esc_html__('Bottom Center', 'image-hover-effects-ultimate'),
                'image-hover-align-bottom-right' => esc_html__('Bottom Right', 'image-hover-effects-ultimate'),
            ],
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover-caption-tab' => '',
            ],
            'simpledescription' => 'Customize Content Aginment as Top, Bottom, Left or Center.',
            'description' => 'Customize Content Aginment as Top, Bottom, Left or Center.',
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
                '{{WRAPPER}} .oxi-image-caption-hover' => '',
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
                '{{WRAPPER}} .oxi-image-caption-hover:hover,'
                . '{{WRAPPER}} .oxi-image-caption-hover.oxi-touch' => '',
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
            'simpledimensions' => 'double',
            'separator' => TRUE,
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
                '{{WRAPPER}} .oxi-image-hover-caption-tab' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'simpledescription' => 'Padding used to generate space around an Image Hover content.',
            'description' => 'Padding used to generate space around an Image Hover content.',
                ]
        );
        $this->end_controls_section();
    }

}
