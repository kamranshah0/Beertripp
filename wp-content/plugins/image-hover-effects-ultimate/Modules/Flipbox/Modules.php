<?php

namespace OXI_IMAGE_HOVER_PLUGINS\Modules\Flipbox;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Description of Modules
 *
 * @author biplo
 */
use OXI_IMAGE_HOVER_PLUGINS\Page\Admin_Render as Admin_Render;
use OXI_IMAGE_HOVER_PLUGINS\Classes\Controls as Controls;

class Modules extends Admin_Render {

    use \OXI_IMAGE_HOVER_PLUGINS\Modules\Dynamic;

    public function register_controls() {


        if (apply_filters('oxi-image-hover-plugin-version', false) == FALSE):
            $this->start_section_header(
                    'oxi-image-hover-start-tabs', [
                'options' => [
                    'general-settings' => esc_html__('General Settings', 'image-hover-effects-ultimate'),
                    'frontend' => esc_html__('Frontend', 'image-hover-effects-ultimate'),
                    'backend' => esc_html__('Backend', 'image-hover-effects-ultimate'),
                    'custom' => esc_html__('Custom CSS', 'image-hover-effects-ultimate'),
                ]
                    ]
            );
        else:
            $this->start_section_header(
                    'oxi-image-hover-start-tabs', [
                'options' => [
                    'general-settings' => esc_html__('General Settings', 'image-hover-effects-ultimate'),
                    'frontend' => esc_html__('Frontend', 'image-hover-effects-ultimate'),
                    'backend' => esc_html__('Backend', 'image-hover-effects-ultimate'),
                    'dynamic' => esc_html__('Dynamic Content', 'image-hover-effects-ultimate'),
                    'custom' => esc_html__('Custom CSS', 'image-hover-effects-ultimate'),
                ]
                    ]
            );
        endif;

        $this->register_general_tabs();
        $this->register_frontend_tabs();
        $this->register_backend_tabs();
        $this->register_dynamic_data();
        $this->register_custom_tabs();
    }

    public function register_dynamic_data() {
        $this->start_section_tabs(
                'oxi-image-hover-start-tabs', [
            'condition' => [
                'oxi-image-hover-start-tabs' => 'dynamic'
            ],
                ]
        );
        $this->start_section_devider();

        $this->register_dynamic_control();

        $this->end_section_devider();

        $this->start_section_devider();

        $this->register_carousel_query_settings();
        $this->register_carousel_arrows_settings();

        $this->register_dynamic_load_more_button();

        $this->end_section_devider();

        $this->end_section_tabs();
    }

    public function register_dynamic_control() {
        $this->start_controls_section(
                'oxi-image-hover', [
            'label' => esc_html__('Dynamic Settings', 'image-hover-effects-ultimate'),
            'showing' => true,
                ]
        );

        if (apply_filters('oxi-image-hover-plugin-version', false) == FALSE):

            $this->add_control(
                    'image_hover_premium_note',
                    $this->style,
                    [
                        'label' => esc_html__('Note', 'image-hover-effects-ultimate'),
                        'type' => Controls::HEADING,
                        'description' => 'Dynamic Property only for Premium Version.'
                    ]
            );
        else:
            $this->add_control(
                    'image_hover_dynamic_note',
                    $this->style,
                    [
                        'label' => esc_html__('Note', 'image-hover-effects-ultimate'),
                        'type' => Controls::HEADING,
                        'description' => 'Dynamic Property will works only at live Sites. Kindly use shortcode at page or post then check it.'
                    ]
            );
        endif;

        $this->add_control(
                'image_hover_dynamic_load_per_page',
                $this->style,
                [
                    'label' => esc_html__('Load Once', 'image-hover-effects-ultimate'),
                    'type' => Controls::NUMBER,
                    'default' => '10',
                    'min' => 1,
                    'description' => 'How many Image or Content You want to Viewing per load.',
                ]
        );

        $this->add_control(
                'image_hover_dynamic_carousel', $this->style,
                [
                    'label' => esc_html__('Carousel', 'image-hover-effects-ultimate'),
                    'type' => Controls::SWITCHER,
                    'default' => 'no',
                    'yes' => esc_html__('Yes', 'image-hover-effects-ultimate'),
                    'no' => esc_html__('No', 'image-hover-effects-ultimate'),
                    'return_value' => 'yes',
                    'description' => 'Wanna Add Carousel into Hover Effects?.',
                    'notcondition' => TRUE,
                    'condition' => [
                        'image_hover_dynamic_load' => 'yes',
                    ],
                ]
        );

        $this->add_control(
                'image_hover_dynamic_load', $this->style,
                [
                    'label' => esc_html__('Load More', 'image-hover-effects-ultimate'),
                    'type' => Controls::SWITCHER,
                    'default' => 'no',
                    'yes' => esc_html__('Yes', 'image-hover-effects-ultimate'),
                    'no' => esc_html__('No', 'image-hover-effects-ultimate'),
                    'return_value' => 'yes',
                    'description' => 'Wanna load More Options?.',
                    'notcondition' => TRUE,
                    'condition' => [
                        'image_hover_dynamic_carousel' => 'yes',
                    ],
                ]
        );

        $this->add_control(
                'image_hover_dynamic_load_type', $this->style,
                [
                    'label' => esc_html__('Load More Type', 'image-hover-effects-ultimate'),
                    'type' => Controls::CHOOSE,
                    'operator' => Controls::OPERATOR_TEXT,
                    'default' => 'button',
                    'options' => [
                        'button' => [
                            'title' => esc_html__('Button', 'image-hover-effects-ultimate'),
                        ],
                        'infinite' => [
                            'title' => esc_html__('Infinite', 'image-hover-effects-ultimate'),
                        ],
                    ],
                    'condition' => [
                        'image_hover_dynamic_load' => 'yes'
                    ],
                    'description' => 'Select Load More Type, As we offer Infinite loop or Button.',
                ]
        );

        $this->end_controls_section();
    }

    public function register_general_tabs() {
        $this->start_section_tabs(
                'oxi-image-hover-start-tabs', [
            'condition' => [
                'oxi-image-hover-start-tabs' => 'general-settings'
            ]
                ]
        );
        $this->start_section_devider();
        // register_column_effects
        $this->register_column_effects();

        $this->end_section_devider();

        $this->start_section_devider();
        //register_general_style
        $this->register_general_style();

        $this->end_section_devider();
        $this->end_section_tabs();
    }

    public function register_frontend_tabs() {
        $this->start_section_tabs(
                'oxi-image-hover-start-tabs', [
            'condition' => [
                'oxi-image-hover-start-tabs' => 'frontend'
            ]
                ]
        );
        $this->start_section_devider();
        $this->register_front_content_settings();
        $this->register_front_description_settings();
        $this->end_section_devider();
        $this->start_section_devider();
        $this->register_front_heading_settings();
        $this->register_front_icon_settings();
        $this->end_section_devider();
        $this->end_section_tabs();
    }

    public function register_backend_tabs() {
        $this->start_section_tabs(
                'oxi-image-hover-start-tabs', [
            'condition' => [
                'oxi-image-hover-start-tabs' => 'backend'
            ]
                ]
        );
        $this->start_section_devider();
        $this->register_back_content_settings();
        $this->register_back_description_settings();
        $this->end_section_devider();

        $this->start_section_devider();
        $this->register_back_heading_settings();
        $this->register_back_icon_settings();
        $this->register_back_button_settings();
        $this->end_section_devider();

        $this->end_section_tabs();
    }

    public function register_custom_tabs() {
        $this->start_section_tabs(
                'oxi-image-hover-start-tabs', [
            'condition' => [
                'oxi-image-hover-start-tabs' => 'custom'
            ],
            'padding' => '10px'
                ]
        );

        $this->start_controls_section(
                'oxi-image-hover', [
            'label' => esc_html__('Custom CSS', 'image-hover-effects-ultimate'),
            'showing' => TRUE,
                ]
        );
        $this->add_control(
                'image-hover-custom-css', $this->style, [
            'label' => esc_html__('', 'image-hover-effects-ultimate'),
            'type' => Controls::TEXTAREA,
            'default' => '',
            'description' => 'Custom CSS Section. You can add custom css into textarea.'
                ]
        );
        $this->end_controls_section();
        $this->end_section_tabs();
    }

    public function register_column_effects() {
        $this->start_controls_section(
                'oxi-image-hover', [
            'label' => esc_html__('Column & Effects', 'image-hover-effects-ultimate'),
            'showing' => TRUE,
                ]
        );
        $this->add_group_control(
                'oxi-image-hover-col', $this->style, [
            'type' => Controls::COLUMN,
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover-style' => '',
            ],
                ]
        );
        $this->add_control(
                'image_hover_effects', $this->style, [
            'label' => esc_html__('Effects Direction', 'image-hover-effects-ultimate'),
            'type' => Controls::SELECT,
            'default' => '',
            'options' => [
                'oxi-image-flip-top-to-bottom' => esc_html__('Top To Bottom', 'image-hover-effects-ultimate'),
                'oxi-image-flip-bottom-to-top' => esc_html__('Bottom To Top', 'image-hover-effects-ultimate'),
                'oxi-image-flip-left-to-right' => esc_html__('Left To Right', 'image-hover-effects-ultimate'),
                'oxi-image-flip-right-to-left' => esc_html__('Right To Left', 'image-hover-effects-ultimate'),
            ],
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover-figure' => '',
            ],
            'description' => 'Set Effects Direction as How you want to run Effects.',
                ]
        );
        $this->add_control(
                'image_hover_timing_type', $this->style, [
            'label' => esc_html__('Timing Type', 'image-hover-effects-ultimate'),
            'type' => Controls::SELECT,
            'default' => '',
            'options' => [
                '' => esc_html__('Normal Animation', 'image-hover-effects-ultimate'),
                'easing_easeInOutExpo' => esc_html__('EaseOutBack', 'image-hover-effects-ultimate'),
                'easing_easeInOutCirc' => esc_html__('EaseInOutExpo', 'image-hover-effects-ultimate'),
                'easing_easeOutBack' => esc_html__('EaseInOutCirc', 'image-hover-effects-ultimate'),
            ],
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover-figure' => '',
            ],
            'description' => 'Set effects type as how your effects animated.',
                ]
        );
        $this->add_control(
                'oxi-image-hover-effects-time', $this->style, [
            'label' => esc_html__('Effects Duration (S)', 'image-hover-effects-ultimate'),
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
                '{{WRAPPER}} .oxi-image-hover-style *,{{WRAPPER}} .oxi-image-hover-style *:before,{{WRAPPER}} .oxi-image-hover-style *:after' => '-webkit-transition: all {{SIZE}}{{UNIT}}; -moz-transition: all {{SIZE}}{{UNIT}}; transition: all {{SIZE}}{{UNIT}};',
            ],
            'description' => 'Set Effects Durations as How long you want to run Effects. Options available with Second or Milisecond.',
                ]
        );
        $this->add_group_control(
                'oxi-image-hover-animation', $this->style, [
            'type' => Controls::ANIMATION,
            'separator' => TRUE,
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover-style' => '',
            ]
                ]
        );

        $this->end_controls_section();
    }

    public function register_general_style() {
        $this->start_controls_section(
                'oxi-image-hover', [
            'label' => esc_html__('Width & Height', 'image-hover-effects-ultimate'),
            'showing' => true,
                ]
        );
        $this->add_responsive_control(
                'oxi-image-hover-width', $this->style, [
            'label' => esc_html__('Width', 'image-hover-effects-ultimate'),
            'type' => Controls::SLIDER,
            'default' => [
                'unit' => 'px',
                'size' => '',
            ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 1900,
                    'step' => 1,
                ],
                '%' => [
                    'min' => 1,
                    'max' => 100,
                    'step' => 1,
                ],
                'em' => [
                    'min' => 1,
                    'max' => 200,
                    'step' => 0.1,
                ],
            ],
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover-style-flipbox' => 'max-width:{{SIZE}}{{UNIT}};',
            ],
            'description' => 'Customize Flipbox Width with several options as Pixel, Percent or EM.',
                ]
        );
        $this->add_responsive_control(
                'oxi-image-hover-height', $this->style, [
            'label' => esc_html__('Height', 'image-hover-effects-ultimate'),
            'type' => Controls::SLIDER,
            'default' => [
                'unit' => '%',
                'size' => '',
            ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 1000,
                    'step' => 1,
                ],
                '%' => [
                    'min' => 1,
                    'max' => 200,
                    'step' => 1,
                ],
            ],
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover-style-flipbox:after ' => 'padding-bottom:{{SIZE}}{{UNIT}};',
            ],
            'description' => 'Customize FLipbox Height with several options as Pixel, Percent or EM.',
                ]
        );
        $this->add_responsive_control(
                'oxi-image-hover-margin', $this->style, [
            'label' => esc_html__('Margin', 'image-hover-effects-ultimate'),
            'type' => Controls::DIMENSIONS,
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
                    'max' => 200,
                    'step' => .1,
                ],
            ],
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover-style' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'description' => 'Margin properties are used to create space around Flipbox with several options as Pixel, or Percent or EM.',
                ]
        );
        $this->end_controls_section();
    }

    public function register_front_content_settings() {
        $this->start_controls_section(
                'oxi-image-hover', [
            'label' => esc_html__('Content Settings', 'image-hover-effects-ultimate'),
            'showing' => TRUE,
                ]
        );
        $this->add_control(
                'oxi-image-flip-front-alignment', $this->style, [
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
                '{{WRAPPER}} .oxi-image-hover-figure-front-section' => '',
            ],
            'description' => 'Customize Content Aginment as Top, Bottom, Left or Center.',
                ]
        );
        $this->add_group_control(
                'oxi-image-flip-front-background', $this->style, [
            'type' => Controls::BACKGROUND,
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover-figure-front-section' => '',
            ],
            'description' => 'Customize Hover Background with Color or Gradient or Image properties.',
                ]
        );

        $this->add_group_control(
                'oxi-image-flip-front-border', $this->style, [
            'type' => Controls::BORDER,
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover-figure-front-section' => '',
            ],
            'description' => 'Border property is used to set the Hover Border of the Flipbox.',
                ]
        );

        $this->add_responsive_control(
                'oxi-image-flip-front-border-radius', $this->style, [
            'label' => esc_html__('Border Radius', 'image-hover-effects-ultimate'),
            'type' => Controls::DIMENSIONS,
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
                    'max' => 50,
                    'step' => 1,
                ],
                'em' => [
                    'min' => 0,
                    'max' => 100,
                    'step' => .1,
                ],
            ],
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover-figure-frontend, '
                . '{{WRAPPER}} .oxi-image-hover-figure-frontend:before, '
                . '{{WRAPPER}} .oxi-image-hover-figure-frontend:after, '
                . '{{WRAPPER}} .oxi-image-hover-figure-front-section, '
                . '{{WRAPPER}} .oxi-image-hover-figure-backend, '
                . '{{WRAPPER}} .oxi-image-hover-figure-backend:before, '
                . '{{WRAPPER}} .oxi-image-hover-figure-backend:after, '
                . '{{WRAPPER}} .oxi-image-hover-figure-back-section ' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'description' => 'Allows you to add rounded corners to Flipbox with options.',
                ]
        );
        $this->add_group_control(
                'oxi-image-flip-front-boxshadow', $this->style, [
            'type' => Controls::BOXSHADOW,
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover-figure-frontend:before' => '',
                '{{WRAPPER}} .oxi-image-hover-figure-backend:before' => '',
            ],
            'description' => 'Allows you at hover to attaches one or more shadows into Button.',
                ]
        );
        $this->add_responsive_control(
                'oxi-image-flip-front-padding', $this->style, [
            'label' => esc_html__('Padding', 'image-hover-effects-ultimate'),
            'type' => Controls::DIMENSIONS,
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
                '{{WRAPPER}} .oxi-image-hover-figure-front-section' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'description' => 'Generate space around a Flipbox, inside of any defined borders or Background.',
                ]
        );
        $this->end_controls_section();
    }

    public function register_front_heading_settings() {
        $this->start_controls_section(
                'oxi-image-hover', [
            'label' => esc_html__('Heading Settings', 'image-hover-effects-ultimate'),
            'showing' => TRUE,
                ]
        );
        $this->add_control(
                'oxi-image-flip-front-heading-underline', $this->style,
                [
                    'label' => esc_html__('Haading Underline', 'image-hover-effects-ultimate'),
                    'type' => Controls::CHOOSE,
                    'operator' => Controls::OPERATOR_TEXT,
                    'default' => '',
                    'options' => [
                        'oxi-image-hover-heading-underline' => [
                            'title' => esc_html__('Show', 'image-hover-effects-ultimate'),
                        ],
                        '' => [
                            'title' => esc_html__('Hide', 'image-hover-effects-ultimate'),
                        ],
                    ],
                    'selector' => [
                        '{{WRAPPER}} .oxi-image-hover-figure-front-section .oxi-image-hover-heading' => '',
                    ],
                    'description' => 'Wanna set Heading Underline? Customization Panel will viewing while values "Show".',
                ]
        );

        $this->add_group_control(
                'oxi-image-flip-front-heading-typho', $this->style, [
            'type' => Controls::TYPOGRAPHY,
            'include' => Controls::ALIGNNORMAL,
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover-figure-front-section .oxi-image-hover-heading' => '',
            ]
                ]
        );
        $this->add_control(
                'oxi-image-flip-front-heading-color', $this->style, [
            'label' => esc_html__('Color', 'image-hover-effects-ultimate'),
            'type' => Controls::COLOR,
            'default' => '#ffffff',
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover-figure-front-section .oxi-image-hover-heading' => 'color: {{VALUE}};',
            ],
            'description' => 'Color property is used to set the color of the Heading.',
                ]
        );
        $this->add_group_control(
                'oxi-image-flip-front-heading-tx-shadow', $this->style, [
            'type' => Controls::TEXTSHADOW,
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover-figure-front-section .oxi-image-hover-heading' => '',
            ],
            'description' => 'Text Shadow property adds shadow to Heading.',
                ]
        );

        $this->add_responsive_control(
                'oxi-image-flip-front-heading-margin', $this->style, [
            'label' => esc_html__('Margin', 'image-hover-effects-ultimate'),
            'type' => Controls::DIMENSIONS,
            'default' => [
                'unit' => 'px',
                'size' => '',
            ],
            'range' => [
                'px' => [
                    'min' => 1,
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
                '{{WRAPPER}} .oxi-image-hover-figure-front-section .oxi-image-hover-heading' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'description' => 'Margin properties are used to create space around Heading.',
                ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
                'oxi-image-hover-head-underline', [
            'label' => esc_html__('Heading Underline', 'image-hover-effects-ultimate'),
            'showing' => false,
            'condition' => [
                'oxi-image-flip-front-heading-underline' => 'oxi-image-hover-heading-underline'
            ]
                ]
        );
        $this->add_control(
                'oxi-image-flip-front-underline-position',
                $this->style,
                [
                    'label' => esc_html__('Position', 'image-hover-effects-ultimate'),
                    'type' => Controls::CHOOSE,
                    'toggle' => true,
                    'operator' => Controls::OPERATOR_ICON,
                    'default' => 'left: 50%; transform: translateX(-50%);',
                    'options' => [
                        'left: 0; transform: translateX(0%);' => [
                            'title' => esc_html__('Left', 'image-hover-effects-ultimate'),
                            'icon' => 'fa fa-align-left',
                        ],
                        'left: 50%; transform: translateX(-50%);' => [
                            'title' => esc_html__('Center', 'image-hover-effects-ultimate'),
                            'icon' => 'fa fa-align-center',
                        ],
                        'left: 100%; transform: translateX(-100%);' => [
                            'title' => esc_html__('Right', 'image-hover-effects-ultimate'),
                            'icon' => 'fa fa-align-right',
                        ],
                    ],
                    'selector' => [
                        '{{WRAPPER}} .oxi-image-hover-figure-front-section .oxi-image-hover-heading.oxi-image-hover-heading-underline:before' => '{{VALUE}}',
                    ],
                    'description' => 'Allows you to set Heading Underline Position.',
                ]
        );

        $this->add_control(
                'oxi-image-flip-front-underline-color', $this->style, [
            'label' => esc_html__('Color', 'image-hover-effects-ultimate'),
            'type' => Controls::COLOR,
            'default' => '#ffffff',
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover-figure-front-section .oxi-image-hover-heading.oxi-image-hover-heading-underline:before' => 'border-bottom-color: {{VALUE}};',
            ],
            'description' => 'Allows you to set Heading Underline Color.',
                ]
        );
        $this->add_control(
                'oxi-image-flip-front-underline-type', $this->style, [
            'label' => esc_html__('Underline Type', 'image-hover-effects-ultimate'),
            'type' => Controls::SELECT,
            'simpleenable' => false,
            'default' => 'solid',
            'options' => [
                '' => esc_html__('None', 'image-hover-effects-ultimate'),
                'solid' => esc_html__('Solid', 'image-hover-effects-ultimate'),
                'dotted' => esc_html__('Dotted', 'image-hover-effects-ultimate'),
                'dashed' => esc_html__('Dashed', 'image-hover-effects-ultimate'),
                'double' => esc_html__('Double', 'image-hover-effects-ultimate'),
                'groove' => esc_html__('Groove', 'image-hover-effects-ultimate'),
                'ridge' => esc_html__('Ridge', 'image-hover-effects-ultimate'),
                'inset' => esc_html__('Inset', 'image-hover-effects-ultimate'),
                'outset' => esc_html__('Outset', 'image-hover-effects-ultimate'),
                'hidden' => esc_html__('Hidden', 'image-hover-effects-ultimate'),
            ],
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover-figure-front-section .oxi-image-hover-heading.oxi-image-hover-heading-underline:before' => 'border-bottom-style: {{VALUE}};',
            ],
            'description' => 'Allows you to set Heading Underline Type.',
                ]
        );
        $this->add_responsive_control(
                'oxi-image-flip-front-underline-width', $this->style, [
            'label' => esc_html__('Width', 'image-hover-effects-ultimate'),
            'type' => Controls::SLIDER,
            'simpleenable' => false,
            'default' => [
                'unit' => 'px',
                'size' => 100,
            ],
            'range' => [
                'px' => [
                    'min' => 1,
                    'max' => 1900,
                    'step' => 1,
                ],
                '%' => [
                    'min' => 1,
                    'max' => 100,
                    'step' => 1,
                ],
                'em' => [
                    'min' => 1,
                    'max' => 200,
                    'step' => 0.1,
                ],
            ],
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover-figure-front-section .oxi-image-hover-heading.oxi-image-hover-heading-underline:before' => 'width:{{SIZE}}{{UNIT}};',
            ],
            'description' => 'Allows you to set Heading Underline Width.',
                ]
        );
        $this->add_responsive_control(
                'oxi-image-flip-front-underline-height', $this->style, [
            'label' => esc_html__('Size', 'image-hover-effects-ultimate'),
            'type' => Controls::SLIDER,
            'simpleenable' => false,
            'default' => [
                'unit' => 'px',
                'size' => 1,
            ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 50,
                    'step' => 1,
                ],
                '%' => [
                    'min' => 1,
                    'max' => 100,
                    'step' => 1,
                ],
            ],
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover-figure-front-section .oxi-image-hover-heading.oxi-image-hover-heading-underline:before' => 'border-bottom-width: {{SIZE}}{{UNIT}};',
            ],
            'description' => 'Allows you to set Heading Underline Height.',
                ]
        );

        $this->add_responsive_control(
                'oxi-image-flip-front-underline-distance', $this->style, [
            'label' => esc_html__('Distance', 'image-hover-effects-ultimate'),
            'type' => Controls::SLIDER,
            'default' => [
                'unit' => 'px',
                'size' => 0,
            ],
            'range' => [
                'px' => [
                    'min' => 1,
                    'max' => 300,
                    'step' => 1,
                ],
                '%' => [
                    'min' => 1,
                    'max' => 100,
                    'step' => 1,
                ],
            ],
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover-figure-front-section .oxi-image-hover-heading.oxi-image-hover-heading-underline' => 'margin-bottom:{{SIZE}}{{UNIT}};',
            ],
            'description' => 'Allows you to set Heading Underline Distance.',
                ]
        );
        $this->end_controls_section();
    }

    public function register_front_description_settings() {
        $this->start_controls_section(
                'oxi-image-hover', [
            'label' => esc_html__('Description Settings', 'image-hover-effects-ultimate'),
            'showing' => FALSE,
                ]
        );
        $this->add_group_control(
                'oxi-image-flip-front-desc-typho', $this->style, [
            'type' => Controls::TYPOGRAPHY,
            'include' => Controls::ALIGNNORMAL,
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover-figure-front-section .oxi-image-hover-content' => '',
            ]
                ]
        );
        $this->add_control(
                'oxi-image-flip-front-desc-color', $this->style, [
            'label' => esc_html__('Color', 'image-hover-effects-ultimate'),
            'type' => Controls::COLOR,
            'default' => '#ffffff',
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover-figure-front-section .oxi-image-hover-content' => 'color: {{VALUE}};',
            ],
            'description' => 'Color property is used to set the color of the Description.',
                ]
        );
        $this->add_group_control(
                'oxi-image-flip-front-desc-tx-shadow', $this->style, [
            'type' => Controls::TEXTSHADOW,
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover-figure-front-section .oxi-image-hover-content' => '',
            ],
            'description' => 'Text Shadow property adds shadow to Description.',
                ]
        );

        $this->add_responsive_control(
                'oxi-image-flip-front-desc-margin', $this->style, [
            'label' => esc_html__('Margin', 'image-hover-effects-ultimate'),
            'type' => Controls::DIMENSIONS,
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
                '{{WRAPPER}} .oxi-image-hover-figure-front-section .oxi-image-hover-content' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'description' => 'Margin properties are used to create space around Description.',
                ]
        );
        $this->end_controls_section();
    }

    public function register_front_icon_settings() {
        $this->start_controls_section(
                'imahe-hover', [
            'label' => esc_html__('Icon Settings', 'image-hover-effects-ultimate'),
            'showing' => FALSE,
                ]
        );
        $this->add_control(
                'oxi-image-flip-front-icon-position',
                $this->style,
                [
                    'label' => esc_html__('Position', 'image-hover-effects-ultimate'),
                    'type' => Controls::CHOOSE,
                    'operator' => Controls::OPERATOR_ICON,
                    'toggle' => true,
                    'default' => 'center',
                    'options' => [
                        'left' => [
                            'title' => esc_html__('Left', 'image-hover-effects-ultimate'),
                            'icon' => 'fa fa-align-left',
                        ],
                        'center' => [
                            'title' => esc_html__('Center', 'image-hover-effects-ultimate'),
                            'icon' => 'fa fa-align-center',
                        ],
                        'right' => [
                            'title' => esc_html__('Right', 'image-hover-effects-ultimate'),
                            'icon' => 'fa fa-align-right',
                        ],
                    ],
                    'selector' => [
                        '{{WRAPPER}} .oxi-image-hover-figure-front-section .oxi-image-hover-icon' => 'text-align:{{VALUE}};',
                    ],
                    'description' => 'Allows you to set Icon Position.',
                ]
        );
        $this->add_responsive_control(
                'oxi-image-flip-front-icon-width', $this->style, [
            'label' => esc_html__('Width Height', 'image-hover-effects-ultimate'),
            'type' => Controls::SLIDER,
            'default' => [
                'unit' => 'px',
                'size' => 60,
            ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 2000,
                    'step' => 1,
                ],
                'em' => [
                    'min' => 0,
                    'max' => 200,
                    'step' => .1,
                ],
                'rem' => [
                    'min' => 0,
                    'max' => 200,
                    'step' => 0.1,
                ],
            ],
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover-figure-front-section .oxi-image-hover-icon .oxi-icons' => 'width:{{SIZE}}{{UNIT}}; height:{{SIZE}}{{UNIT}};',
            ],
            'description' => 'Allows you to Set Icon Width Height.',
                ]
        );
        $this->add_responsive_control(
                'oxi-image-flip-front-icon-size', $this->style, [
            'label' => esc_html__('Icon Size', 'image-hover-effects-ultimate'),
            'type' => Controls::SLIDER,
            'default' => [
                'unit' => 'px',
                'size' => 20,
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
                '{{WRAPPER}} .oxi-image-hover-figure-front-section .oxi-image-hover-icon .oxi-icons' => 'font-size:{{SIZE}}{{UNIT}};',
            ],
            'description' => 'Allows you to Set Icon Size.',
                ]
        );
        $this->add_control(
                'oxi-image-flip-front-icon-color', $this->style, [
            'label' => esc_html__('Color', 'image-hover-effects-ultimate'),
            'type' => Controls::COLOR,
            'default' => '#b414c9',
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover-figure-front-section .oxi-image-hover-icon .oxi-icons' => 'color: {{VALUE}};',
            ],
            'description' => 'Color property is used to set the color of the Icon.',
                ]
        );
        $this->add_group_control(
                'oxi-image-flip-front-icon-background', $this->style, [
            'type' => Controls::BACKGROUND,
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover-figure-front-section .oxi-image-hover-icon .oxi-icons' => '',
            ],
            'description' => 'Customize Icon Background with Color or Gradient or Image properties.',
                ]
        );

        $this->add_group_control(
                'oxi-image-flip-front-icon-border', $this->style, [
            'type' => Controls::BORDER,
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover-figure-front-section .oxi-image-hover-icon .oxi-icons' => '',
            ],
            'description' => 'Border property is used to set the Border of the Icon.',
                ]
        );

        $this->add_responsive_control(
                'oxi-image-flip-front-icon-border-radius', $this->style, [
            'label' => esc_html__('Border Radius', 'image-hover-effects-ultimate'),
            'type' => Controls::DIMENSIONS,
            'default' => [
                'unit' => 'px',
                'size' => '',
            ],
            'range' => [
                '%' => [
                    'min' => 0,
                    'max' => 50,
                    'step' => .1,
                ],
                'px' => [
                    'min' => -200,
                    'max' => 200,
                    'step' => 1,
                ],
                'em' => [
                    'min' => 0,
                    'max' => 10,
                    'step' => .1,
                ],
            ],
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover-figure-front-section .oxi-image-hover-icon .oxi-icons' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'description' => 'Allows you to add rounded corners to Icon with 4 values.',
                ]
        );
        $this->add_responsive_control(
                'oxi-image-flip-front-icon-margin', $this->style, [
            'label' => esc_html__('Margin', 'image-hover-effects-ultimate'),
            'type' => Controls::DIMENSIONS,
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
                '{{WRAPPER}} .oxi-image-hover-figure-front-section .oxi-image-hover-icon ' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'description' => 'Margin properties are used to create space around Icon.',
                ]
        );
        $this->end_controls_section();
    }

    public function register_back_content_settings() {
        $this->start_controls_section(
                'oxi-image-hover', [
            'label' => esc_html__('Content Settings', 'image-hover-effects-ultimate'),
            'showing' => TRUE,
                ]
        );
        $this->add_control(
                'oxi-image-flip-back-content-alignment', $this->style, [
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
                '{{WRAPPER}} .oxi-image-hover-figure-back-section' => '',
            ],
            'description' => 'Customize Content Aginment as Top, Bottom, Left or Center.',
                ]
        );
        $this->add_group_control(
                'oxi-image-flip-back-background', $this->style, [
            'type' => Controls::BACKGROUND,
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover-figure-back-section' => '',
            ],
            'description' => 'Customize Hover Background with Color or Gradient or Image properties.',
                ]
        );

        $this->add_group_control(
                'oxi-image-flip-back-border', $this->style, [
            'type' => Controls::BORDER,
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover-figure-back-section' => '',
            ],
            'description' => 'Border property is used to set the Hover Border of the Flipbox.',
                ]
        );

        $this->add_responsive_control(
                'oxi-image-flip-back-border-radius', $this->style, [
            'label' => esc_html__('Border Radius', 'image-hover-effects-ultimate'),
            'type' => Controls::DIMENSIONS,
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
                    'max' => 50,
                    'step' => 1,
                ],
                'em' => [
                    'min' => 0,
                    'max' => 100,
                    'step' => .1,
                ],
            ],
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover:hover .oxi-image-hover-figure .oxi-image-hover-figure-frontend, '
                . '{{WRAPPER}} .oxi-image-hover.oxi-touch .oxi-image-hover-figure .oxi-image-hover-figure-frontend, '
                . '{{WRAPPER}} .oxi-image-hover:hover .oxi-image-hover-figure .oxi-image-hover-figure-frontend:before, '
                . '{{WRAPPER}} .oxi-image-hover.oxi-touch .oxi-image-hover-figure .oxi-image-hover-figure-frontend:before, '
                . '{{WRAPPER}} .oxi-image-hover:hover .oxi-image-hover-figure .oxi-image-hover-figure-frontend:after, '
                . '{{WRAPPER}} .oxi-image-hover.oxi-touch .oxi-image-hover-figure .oxi-image-hover-figure-frontend:after, '
                . '{{WRAPPER}} .oxi-image-hover:hover .oxi-image-hover-figure .oxi-image-hover-figure-front-section, '
                . '{{WRAPPER}} .oxi-image-hover.oxi-touch .oxi-image-hover-figure .oxi-image-hover-figure-front-section, '
                . '{{WRAPPER}} .oxi-image-hover:hover .oxi-image-hover-figure .oxi-image-hover-figure-front-section, '
                . '{{WRAPPER}} .oxi-image-hover.oxi-touch .oxi-image-hover-figure .oxi-image-hover-figure-front-section, '
                . '{{WRAPPER}} .oxi-image-hover:hover .oxi-image-hover-figure .oxi-image-hover-figure-front-section img, '
                . '{{WRAPPER}} .oxi-image-hover.oxi-touch .oxi-image-hover-figure .oxi-image-hover-figure-front-section img, '
                . '{{WRAPPER}} .oxi-image-hover:hover .oxi-image-hover-figure .oxi-image-hover-figure-backend, '
                . '{{WRAPPER}} .oxi-image-hover.oxi-touch .oxi-image-hover-figure .oxi-image-hover-figure-backend, '
                . '{{WRAPPER}} .oxi-image-hover:hover .oxi-image-hover-figure .oxi-image-hover-figure-backend:before, '
                . '{{WRAPPER}} .oxi-image-hover.oxi-touch .oxi-image-hover-figure .oxi-image-hover-figure-backend:before, '
                . '{{WRAPPER}} .oxi-image-hover:hover .oxi-image-hover-figure .oxi-image-hover-figure-backend:after, '
                . '{{WRAPPER}} .oxi-image-hover.oxi-touch .oxi-image-hover-figure .oxi-image-hover-figure-backend:after, '
                . '{{WRAPPER}} .oxi-image-hover:hover .oxi-image-hover-figure .oxi-image-hover-figure-back-section, '
                . '{{WRAPPER}} .oxi-image-hover.oxi-touch .oxi-image-hover-figure .oxi-image-hover-figure-back-section ' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'description' => 'Allows you to add rounded corners to Flipbox with options.',
                ]
        );
        $this->add_group_control(
                'oxi-image-flip-back-boxshadow', $this->style, [
            'type' => Controls::BOXSHADOW,
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover-figure-backend:before' => '',
            ],
            'description' => 'Allows you at hover to attaches one or more shadows into Button.',
                ]
        );
        $this->add_responsive_control(
                'oxi-image-flip-back-padding', $this->style, [
            'label' => esc_html__('Padding', 'image-hover-effects-ultimate'),
            'type' => Controls::DIMENSIONS,
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
                '{{WRAPPER}} .oxi-image-hover-figure-back-section' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'description' => 'Generate space around a Flipbox, inside of any defined borders or Background.',
                ]
        );
        $this->end_controls_section();
    }

    public function register_back_heading_settings() {
        $this->start_controls_section(
                'oxi-image-hover', [
            'label' => esc_html__('Heading Settings', 'image-hover-effects-ultimate'),
            'showing' => TRUE,
                ]
        );
        $this->add_control(
                'oxi-image-flip-back-heading-underline', $this->style,
                [
                    'label' => esc_html__('Haading Underline', 'image-hover-effects-ultimate'),
                    'type' => Controls::CHOOSE,
                    'operator' => Controls::OPERATOR_TEXT,
                    'default' => '',
                    'options' => [
                        'oxi-image-hover-heading-underline' => [
                            'title' => esc_html__('Show', 'image-hover-effects-ultimate'),
                        ],
                        '' => [
                            'title' => esc_html__('Hide', 'image-hover-effects-ultimate'),
                        ],
                    ],
                    'selector' => [
                        '{{WRAPPER}} .oxi-image-hover-figure-backend .oxi-image-hover-heading' => '',
                    ],
                    'description' => 'Wanna set Heading Underline? Customization Panel will viewing while values "Show".',
                ]
        );

        $this->add_group_control(
                'oxi-image-flip-back-heading-typho', $this->style, [
            'type' => Controls::TYPOGRAPHY,
            'include' => Controls::ALIGNNORMAL,
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover-figure-backend .oxi-image-hover-heading' => '',
            ]
                ]
        );
        $this->add_control(
                'oxi-image-flip-back-heading-color', $this->style, [
            'label' => esc_html__('Color', 'image-hover-effects-ultimate'),
            'type' => Controls::COLOR,
            'default' => '#ffffff',
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover-figure-backend .oxi-image-hover-heading' => 'color: {{VALUE}};',
            ],
            'description' => 'Color property is used to set the color of the Heading.',
                ]
        );
        $this->add_group_control(
                'oxi-image-flip-back-heading-tx-shadow', $this->style, [
            'type' => Controls::TEXTSHADOW,
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover-figure-backend .oxi-image-hover-heading' => '',
            ],
            'description' => 'Text Shadow property adds shadow to Heading.',
                ]
        );

        $this->add_responsive_control(
                'oxi-image-flip-back-heading-margin', $this->style, [
            'label' => esc_html__('Margin', 'image-hover-effects-ultimate'),
            'type' => Controls::DIMENSIONS,
            'default' => [
                'unit' => 'px',
                'size' => '',
            ],
            'range' => [
                'px' => [
                    'min' => 1,
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
                '{{WRAPPER}} .oxi-image-hover-figure-backend .oxi-image-hover-heading' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'description' => 'Margin properties are used to create space around Heading.',
                ]
        );
        $this->add_control(
                'oxi-image-flip-back-heading-animation', $this->style, [
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
                '{{WRAPPER}} .oxi-image-hover-figure-backend .oxi-image-hover-heading' => '',
            ],
            'description' => 'Allows you to animated Heading while viewing.',
                ]
        );
        $this->add_control(
                'oxi-image-flip-back-animation-delay', $this->style, [
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
                '{{WRAPPER}} .oxi-image-hover-figure-backend .oxi-image-hover-heading' => '',
            ],
            'description' => 'Allows you to animation delay at Heading while viewing.',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'oxi-image-flip-back-head-underline', [
            'label' => esc_html__('Heading Underline', 'image-hover-effects-ultimate'),
            'showing' => false,
            'condition' => [
                'oxi-image-flip-back-heading-underline' => 'oxi-image-hover-heading-underline'
            ]
                ]
        );
        $this->add_control(
                'oxi-image-flip-back-heading-underline-position',
                $this->style,
                [
                    'label' => esc_html__('Position', 'image-hover-effects-ultimate'),
                    'type' => Controls::CHOOSE,
                    'operator' => Controls::OPERATOR_ICON,
                    'default' => 'left: 50%; transform: translateX(-50%);',
                    'options' => [
                        'left: 0; transform: translateX(0%);' => [
                            'title' => esc_html__('Left', 'image-hover-effects-ultimate'),
                            'icon' => 'fa fa-align-left',
                        ],
                        'left: 50%; transform: translateX(-50%);' => [
                            'title' => esc_html__('Center', 'image-hover-effects-ultimate'),
                            'icon' => 'fa fa-align-center',
                        ],
                        'left: 100%; transform: translateX(-100%);' => [
                            'title' => esc_html__('Right', 'image-hover-effects-ultimate'),
                            'icon' => 'fa fa-align-right',
                        ],
                    ],
                    'selector' => [
                        '{{WRAPPER}} .oxi-image-hover-figure-backend .oxi-image-hover-heading.oxi-image-hover-heading-underline:before' => '{{VALUE}}',
                    ],
                    'description' => 'Allows you to set Heading Underline Position.',
                ]
        );

        $this->add_control(
                'oxi-image-flip-back-underline-color', $this->style, [
            'label' => esc_html__('Color', 'image-hover-effects-ultimate'),
            'type' => Controls::COLOR,
            'default' => '#ffffff',
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover-figure-backend .oxi-image-hover-heading.oxi-image-hover-heading-underline:before' => 'border-bottom-color: {{VALUE}};',
            ],
            'description' => 'Allows you to set Heading Underline Color.',
                ]
        );
        $this->add_control(
                'oxi-image-flip-back-underline-type', $this->style, [
            'label' => esc_html__('Underline Type', 'image-hover-effects-ultimate'),
            'type' => Controls::SELECT,
            'simpleenable' => false,
            'default' => 'solid',
            'options' => [
                '' => esc_html__('None', 'image-hover-effects-ultimate'),
                'solid' => esc_html__('Solid', 'image-hover-effects-ultimate'),
                'dotted' => esc_html__('Dotted', 'image-hover-effects-ultimate'),
                'dashed' => esc_html__('Dashed', 'image-hover-effects-ultimate'),
                'double' => esc_html__('Double', 'image-hover-effects-ultimate'),
                'groove' => esc_html__('Groove', 'image-hover-effects-ultimate'),
                'ridge' => esc_html__('Ridge', 'image-hover-effects-ultimate'),
                'inset' => esc_html__('Inset', 'image-hover-effects-ultimate'),
                'outset' => esc_html__('Outset', 'image-hover-effects-ultimate'),
                'hidden' => esc_html__('Hidden', 'image-hover-effects-ultimate'),
            ],
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover-figure-backend .oxi-image-hover-heading.oxi-image-hover-heading-underline:before' => 'border-bottom-style: {{VALUE}};',
            ],
            'description' => 'Allows you to set Heading Underline Type.',
                ]
        );
        $this->add_responsive_control(
                'oxi-image-flip-back-underline-width', $this->style, [
            'label' => esc_html__('Width', 'image-hover-effects-ultimate'),
            'type' => Controls::SLIDER,
            'simpleenable' => false,
            'default' => [
                'unit' => 'px',
                'size' => 100,
            ],
            'range' => [
                'px' => [
                    'min' => 1,
                    'max' => 1900,
                    'step' => 1,
                ],
                '%' => [
                    'min' => 1,
                    'max' => 100,
                    'step' => 1,
                ],
                'em' => [
                    'min' => 1,
                    'max' => 200,
                    'step' => 0.1,
                ],
            ],
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover-figure-backend .oxi-image-hover-heading.oxi-image-hover-heading-underline:before' => 'width:{{SIZE}}{{UNIT}};',
            ],
            'description' => 'Allows you to set Heading Underline Width.',
                ]
        );
        $this->add_responsive_control(
                'oxi-image-flip-back-underline-height', $this->style, [
            'label' => esc_html__('Size', 'image-hover-effects-ultimate'),
            'type' => Controls::SLIDER,
            'default' => [
                'unit' => 'px',
                'size' => 1,
            ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 50,
                    'step' => 1,
                ],
                '%' => [
                    'min' => 1,
                    'max' => 100,
                    'step' => 1,
                ],
            ],
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover-figure-backend .oxi-image-hover-heading.oxi-image-hover-heading-underline:before' => 'border-bottom-width: {{SIZE}}{{UNIT}};',
            ],
            'description' => 'Allows you to set Icon Underline Height.',
                ]
        );

        $this->add_responsive_control(
                'oxi-image-flip-back-underline-distance', $this->style, [
            'label' => esc_html__('Distance', 'image-hover-effects-ultimate'),
            'type' => Controls::SLIDER,
            'default' => [
                'unit' => 'px',
                'size' => 0,
            ],
            'range' => [
                'px' => [
                    'min' => 1,
                    'max' => 300,
                    'step' => 1,
                ],
                '%' => [
                    'min' => 1,
                    'max' => 100,
                    'step' => 1,
                ],
            ],
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover-figure-backend .oxi-image-hover-heading.oxi-image-hover-heading-underline' => 'margin-bottom:{{SIZE}}{{UNIT}};',
            ],
            'description' => 'Allows you to set Heading Underline Distance.',
                ]
        );
        $this->end_controls_section();
    }

    public function register_back_description_settings() {
        $this->start_controls_section(
                'oxi-image-hover', [
            'label' => esc_html__('Description Settings', 'image-hover-effects-ultimate'),
            'showing' => FALSE,
                ]
        );
        $this->add_group_control(
                'oxi-image-flip-back-desc-typho', $this->style, [
            'type' => Controls::TYPOGRAPHY,
            'include' => Controls::ALIGNNORMAL,
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover-figure-backend .oxi-image-hover-content' => '',
            ]
                ]
        );
        $this->add_control(
                'oxi-image-flip-back-desc-color', $this->style, [
            'label' => esc_html__('Color', 'image-hover-effects-ultimate'),
            'type' => Controls::COLOR,
            'default' => '#ffffff',
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover-figure-backend .oxi-image-hover-content' => 'color: {{VALUE}};',
            ],
            'description' => 'Color property is used to set the color of the Description.',
                ]
        );
        $this->add_group_control(
                'oxi-image-flip-back-desc-tx-shadow', $this->style, [
            'type' => Controls::TEXTSHADOW,
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover-figure-backend .oxi-image-hover-content' => '',
            ],
            'description' => 'Text Shadow property adds shadow to Description.',
                ]
        );

        $this->add_responsive_control(
                'oxi-image-flip-back-desc-margin', $this->style, [
            'label' => esc_html__('Margin', 'image-hover-effects-ultimate'),
            'type' => Controls::DIMENSIONS,
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
                '{{WRAPPER}} .oxi-image-hover-figure-backend .oxi-image-hover-content' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'description' => 'Margin properties are used to create space around Description.',
                ]
        );
        $this->add_control(
                'oxi-image-flip-back-desc-animation', $this->style, [
            'label' => esc_html__('Animation', 'image-hover-effects-ultimate'),
            'type' => Controls::SELECT,
            'default' => 'solid',
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
                '{{WRAPPER}} .oxi-image-hover-figure-backend .oxi-image-hover-content' => '',
            ],
            'description' => 'Allows you to animated Description while viewing.',
                ]
        );
        $this->add_control(
                'oxi-image-flip-back-desc-animation-delay', $this->style, [
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
                '{{WRAPPER}} .oxi-image-hover-figure-backend .oxi-image-hover-content' => '',
            ],
            'description' => 'Allows you to animation delay at Description while viewing.',
                ]
        );

        $this->end_controls_section();
    }

    public function register_back_icon_settings() {
        $this->start_controls_section(
                'oxi-image-hover', [
            'label' => esc_html__('Icon Settings', 'image-hover-effects-ultimate'),
            'showing' => FALSE,
                ]
        );
        $this->add_control(
                'oxi-image-flip-back-icon-position',
                $this->style,
                [
                    'label' => esc_html__('Position', 'image-hover-effects-ultimate'),
                    'type' => Controls::CHOOSE,
                    'operator' => Controls::OPERATOR_ICON,
                    'default' => 'center',
                    'toggle' => true,
                    'options' => [
                        'left' => [
                            'title' => esc_html__('Left', 'image-hover-effects-ultimate'),
                            'icon' => 'fa fa-align-left',
                        ],
                        'center' => [
                            'title' => esc_html__('Center', 'image-hover-effects-ultimate'),
                            'icon' => 'fa fa-align-center',
                        ],
                        'right' => [
                            'title' => esc_html__('Right', 'image-hover-effects-ultimate'),
                            'icon' => 'fa fa-align-right',
                        ],
                    ],
                    'selector' => [
                        '{{WRAPPER}} .oxi-image-hover-figure-back-section .oxi-image-hover-icon' => 'text-align:{{VALUE}}',
                    ],
                    'description' => 'Allows you to set Icon Position.',
                ]
        );
        $this->add_responsive_control(
                'oxi-image-flip-back-icon-width', $this->style, [
            'label' => esc_html__('Width', 'image-hover-effects-ultimate'),
            'type' => Controls::SLIDER,
            'default' => [
                'unit' => 'px',
                'size' => 60,
            ],
            'range' => [
                'px' => [
                    'min' => 1,
                    'max' => 2000,
                    'step' => 1,
                ],
                'em' => [
                    'min' => 1,
                    'max' => 200,
                    'step' => .1,
                ],
                'rem' => [
                    'min' => 1,
                    'max' => 200,
                    'step' => 0.1,
                ],
            ],
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover-figure-backend .oxi-image-hover-icon .oxi-icons' => 'width:{{SIZE}}{{UNIT}}; height:{{SIZE}}{{UNIT}};',
            ],
            'description' => 'Allows you to Set Icon Width Height.',
                ]
        );
        $this->add_responsive_control(
                'oxi-image-flip-back-icon-size', $this->style, [
            'label' => esc_html__('Icon Size', 'image-hover-effects-ultimate'),
            'type' => Controls::SLIDER,
            'default' => [
                'unit' => 'px',
                'size' => 20,
            ],
            'range' => [
                'px' => [
                    'min' => 1,
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
                '{{WRAPPER}} .oxi-image-hover-figure-backend .oxi-image-hover-icon .oxi-icons' => 'font-size:{{SIZE}}{{UNIT}};',
            ],
            'description' => 'Allows you to Set Icon Size.',
                ]
        );
        $this->add_control(
                'oxi-image-flip-back-icon-color', $this->style, [
            'label' => esc_html__('Color', 'image-hover-effects-ultimate'),
            'type' => Controls::COLOR,
            'default' => '#b414c9',
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover-figure-backend .oxi-image-hover-icon .oxi-icons' => 'color: {{VALUE}};',
            ],
            'description' => 'Color property is used to set the color of the Icon.',
                ]
        );
        $this->add_group_control(
                'oxi-image-flip-back-icon-background', $this->style, [
            'type' => Controls::BACKGROUND,
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover-figure-backend .oxi-image-hover-icon .oxi-icons' => '',
            ],
            'description' => 'Customize Icon Background with Color or Gradient or Image properties.',
                ]
        );

        $this->add_group_control(
                'oxi-image-flip-back-icon-border', $this->style, [
            'type' => Controls::BORDER,
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover-figure-backend .oxi-image-hover-icon .oxi-icons' => '',
            ],
            'description' => 'Border property is used to set the Border of the Icon.',
                ]
        );

        $this->add_responsive_control(
                'oxi-image-flip-back-icon-border-radius', $this->style, [
            'label' => esc_html__('Border Radius', 'image-hover-effects-ultimate'),
            'type' => Controls::DIMENSIONS,
            'default' => [
                'unit' => 'px',
                'size' => 100,
            ],
            'range' => [
                '%' => [
                    'min' => 0,
                    'max' => 50,
                    'step' => .1,
                ],
                'px' => [
                    'min' => -200,
                    'max' => 200,
                    'step' => 1,
                ],
                'em' => [
                    'min' => 0,
                    'max' => 10,
                    'step' => .1,
                ],
            ],
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover-figure-backend .oxi-image-hover-icon .oxi-icons' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'description' => 'Allows you to add rounded corners to Icon with 4 values.',
                ]
        );
        $this->add_responsive_control(
                'oxi-image-flip-back-icon-margin', $this->style, [
            'label' => esc_html__('Margin', 'image-hover-effects-ultimate'),
            'type' => Controls::DIMENSIONS,
            'default' => [
                'unit' => 'px',
                'size' => '',
            ],
            'range' => [
                'px' => [
                    'min' => 1,
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
                '{{WRAPPER}} .oxi-image-hover-figure-backend .oxi-image-hover-icon' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'description' => 'Margin properties are used to create space around Icon.',
                ]
        );
        $this->add_control(
                'oxi-image-flip-back-icon-animation', $this->style, [
            'label' => esc_html__('Animation', 'image-hover-effects-ultimate'),
            'type' => Controls::SELECT,
            'default' => 'solid',
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
                '{{WRAPPER}} .oxi-image-hover-figure-backend .oxi-image-hover-icon' => '',
            ],
            'description' => 'Allows you to animated Icon while viewing.',
                ]
        );
        $this->add_control(
                'oxi-image-flip-back-icon-animation-delay', $this->style, [
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
                '{{WRAPPER}} .oxi-image-hover-figure-backend .oxi-image-hover-icon' => '',
            ],
            'description' => 'Allows you to animation delay of Icon while viewing.',
                ]
        );

        $this->end_controls_section();
    }

    public function register_back_button_settings() {
        $this->start_controls_section(
                'oxi-image-hover', [
            'label' => esc_html__('Button Settings', 'image-hover-effects-ultimate'),
            'showing' => false,
                ]
        );
        $this->add_control(
                'oxi-image-flip-back-button-position',
                $this->style,
                [
                    'label' => esc_html__('Position', 'image-hover-effects-ultimate'),
                    'type' => Controls::CHOOSE,
                    'operator' => Controls::OPERATOR_ICON,
                    'default' => '',
                    'toggle' => true,
                    'options' => [
                        'left' => [
                            'title' => esc_html__('Left', 'image-hover-effects-ultimate'),
                            'icon' => 'fa fa-align-left',
                        ],
                        'center' => [
                            'title' => esc_html__('Center', 'image-hover-effects-ultimate'),
                            'icon' => 'fa fa-align-center',
                        ],
                        'right' => [
                            'title' => esc_html__('Right', 'image-hover-effects-ultimate'),
                            'icon' => 'fa fa-align-right',
                        ],
                    ],
                    'selector' => [
                        '{{WRAPPER}}  .oxi-image-hover-button' => 'text-align:{{VALUE}}',
                    ],
                    'description' => 'Allows you set Button Align as Left, Center or Right.',
                ]
        );

        $this->add_group_control(
                'oxi-image-flip-back-button-typho', $this->style, [
            'type' => Controls::TYPOGRAPHY,
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover-button a.oxi-image-btn' => '',
            ]
                ]
        );
        $this->start_controls_tabs(
                'oxi-image-hover-start-tabs',
                [
                    'options' => [
                        'normal' => esc_html__('Normal ', 'image-hover-effects-ultimate'),
                        'hover' => esc_html__('Hover ', 'image-hover-effects-ultimate'),
                    ]
                ]
        );
        $this->start_controls_tab();
        $this->add_control(
                'oxi-image-flip-back-button-color', $this->style, [
            'label' => esc_html__('Color', 'image-hover-effects-ultimate'),
            'type' => Controls::COLOR,
            'default' => '#ffffff',
            'selector' => [
                '{{WRAPPER}}  .oxi-image-hover-button a.oxi-image-btn' => 'color: {{VALUE}};',
                '{{WRAPPER}}  .oxi-image-hover-button a.oxi-image-btn:hover' => 'color: {{VALUE}};',
            ],
            'description' => 'Color property is used to set the color of the Button.',
                ]
        );
        $this->add_control(
                'oxi-image-flip-back-button-background', $this->style, [
            'label' => esc_html__('Background', 'image-hover-effects-ultimate'),
            'type' => Controls::GRADIENT,
            'default' => 'rgba(171, 0, 201, 1)',
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover-button a.oxi-image-btn' => 'background: {{VALUE}};',
                '{{WRAPPER}} .oxi-image-hover-button a.oxi-image-btn:hover' => 'background: {{VALUE}};',
            ],
            'description' => 'Background property is used to set the Background of the Button.',
                ]
        );
        $this->add_group_control(
                'oxi-image-flip-back-button-border', $this->style, [
            'type' => Controls::BORDER,
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover-button  a.oxi-image-btn' => '',
            ],
            'simpledescription' => 'Button',
            'description' => 'Border property is used to set the Border of the Button.',
                ]
        );
        $this->add_group_control(
                'oxi-image-flip-back-button-tx-shadow', $this->style, [
            'type' => Controls::TEXTSHADOW,
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover-button  a.oxi-image-btn' => '',
                '{{WRAPPER}} .oxi-image-hover-button  a.oxi-image-btn:hover' => '',
            ],
            'description' => 'Text Shadow property adds shadow to Button.',
                ]
        );

        $this->add_responsive_control(
                'oxi-image-flip-back-button-radius', $this->style, [
            'label' => esc_html__('Border Radius', 'image-hover-effects-ultimate'),
            'type' => Controls::DIMENSIONS,
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
                    'max' => 50,
                    'step' => 1,
                ],
                'em' => [
                    'min' => 0,
                    'max' => 100,
                    'step' => .1,
                ],
            ],
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover-button a.oxi-image-btn' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                '{{WRAPPER}} .oxi-image-hover-button a.oxi-image-btn:hover' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'description' => 'Allows you to add rounded corners to Button with options.',
                ]
        );
        $this->add_group_control(
                'oxi-image-flip-back-button-boxshadow', $this->style, [
            'type' => Controls::BOXSHADOW,
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover-button a.oxi-image-btn' => '',
                '{{WRAPPER}} .oxi-image-hover-button a.oxi-image-btn:hover' => '',
            ],
            'description' => 'Allows you to attaches one or more shadows into Button.',
                ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab();
        $this->add_control(
                'oxi-image-flip-back-button-hover-color', $this->style, [
            'label' => esc_html__('Color', 'image-hover-effects-ultimate'),
            'type' => Controls::COLOR,
            'default' => '#ffffff',
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover-figure .oxi-image-hover-button a.oxi-image-btn:hover' => 'color: {{VALUE}};',
            ],
            'description' => 'Color property is used to set the Hover color of the Button.',
                ]
        );
        $this->add_control(
                'oxi-image-flip-back-button-hover-background', $this->style, [
            'label' => esc_html__('Background', 'image-hover-effects-ultimate'),
            'type' => Controls::GRADIENT,
            'default' => '#ffffff',
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover-figure .oxi-image-hover-button a.oxi-image-btn:hover' => 'background: {{VALUE}};',
            ],
            'description' => 'Background property is used to set the Hover Background of the Button.',
                ]
        );
        $this->add_group_control(
                'oxi-image-flip-back-button-hover-border', $this->style, [
            'type' => Controls::BORDER,
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover-figure .oxi-image-hover-button a.oxi-image-btn:hover' => '',
            ],
            'description' => 'Border property is used to set the Hover Border of the Button.',
                ]
        );
        $this->add_group_control(
                'oxi-image-flip-back-button-hover-tx-shadow', $this->style, [
            'type' => Controls::TEXTSHADOW,
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover-figure .oxi-image-hover-button a.oxi-image-btn:hover' => '',
            ],
            'description' => 'Text Shadow property adds shadow to Hover Button.',
                ]
        );

        $this->add_responsive_control(
                'oxi-image-flip-back-button-hover-radius', $this->style, [
            'label' => esc_html__('Border Radius', 'image-hover-effects-ultimate'),
            'type' => Controls::DIMENSIONS,
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
                    'max' => 50,
                    'step' => 1,
                ],
                'em' => [
                    'min' => 0,
                    'max' => 100,
                    'step' => .1,
                ],
            ],
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover-figure .oxi-image-hover-button a.oxi-image-btn:hover' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'description' => 'Allows you to add rounded corners at hover to Button with options.',
                ]
        );
        $this->add_group_control(
                'oxi-image-flip-back-button-hover-boxshadow', $this->style, [
            'type' => Controls::BOXSHADOW,
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover-figure .oxi-image-hover-button a.oxi-image-btn:hover' => '',
            ],
            'description' => 'Allows you at hover to attaches one or more shadows into Button.',
                ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_responsive_control(
                'oxi-image-flip-back-button-padding', $this->style, [
            'label' => esc_html__('Padding', 'image-hover-effects-ultimate'),
            'type' => Controls::DIMENSIONS,
            'separator' => TRUE,
            'default' => [
                'unit' => 'px',
                'size' => '',
            ],
            'range' => [
                'px' => [
                    'min' => 1,
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
                '{{WRAPPER}} .oxi-image-hover-button a.oxi-image-btn' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'simpledescription' => 'Generate space around a Button, inside of any defined borders or Background.',
            'description' => 'Generate space around a Button, inside of any defined borders or Background.',
                ]
        );
        $this->add_responsive_control(
                'oxi-image-flip-back-button-margin', $this->style, [
            'label' => esc_html__('Margin', 'image-hover-effects-ultimate'),
            'type' => Controls::DIMENSIONS,
            'default' => [
                'unit' => 'px',
                'size' => '',
            ],
            'range' => [
                'px' => [
                    'min' => -100,
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
                '{{WRAPPER}} .oxi-image-hover-button a.oxi-image-btn' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'description' => 'Generate space around a Button, Outside of Content.',
                ]
        );
        $this->add_control(
                'oxi-image-flip-back-button-animation', $this->style, [
            'label' => esc_html__('Animation', 'image-hover-effects-ultimate'),
            'type' => Controls::SELECT,
            'default' => 'solid',
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
                '{{WRAPPER}} .oxi-image-hover-button' => '',
            ],
            'description' => 'Allows you to animated Button while viewing.',
                ]
        );
        $this->add_control(
                'oxi-image-flip-back-button-animation-delay', $this->style, [
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
                '{{WRAPPER}} .oxi-image-hover-button' => '',
            ],
            'description' => 'Allows you to animation delay at Button while viewing.',
                ]
        );

        $this->end_controls_section();
    }

    public function modal_opener() {
        $this->add_substitute_control('', [], [
            'type' => Controls::MODALOPENER,
            'title' => esc_html__('Add New Flip Box', 'image-hover-effects-ultimate'),
            'sub-title' => esc_html__('Open Flip Box Form', 'image-hover-effects-ultimate'),
            'showing' => TRUE,
        ]);
    }

    public function modal_form_data() {
        ?><div class="modal-header">
            <h4 class="modal-title">Image Hover Form</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <?php
            $this->add_control(
                    'image_hover_front_heading', $this->style, [
                'label' => esc_html__('Title', 'image-hover-effects-ultimate'),
                'type' => Controls::TEXT,
                'default' => '',
                'placeholder' => 'Heading',
                'description' => 'Add Your Flipbox Backend Title else make it blank.'
                    ]
            );
            $this->add_control(
                    'image_hover_back_heading', $this->style, [
                'label' => esc_html__('Title', 'image-hover-effects-ultimate'),
                'type' => Controls::TEXT,
                'default' => '',
                'placeholder' => 'Heading',
                'description' => 'Add Your Flipbox Backend Title.'
                    ]
            );
            $this->add_control(
                    'image_hover_front_icon', $this->style, [
                'label' => esc_html__('Icon', 'image-hover-effects-ultimate'),
                'type' => Controls::ICON,
                    ]
            );
            $this->add_control(
                    'image_hover_back_icon', $this->style, [
                'label' => esc_html__('Icon', 'image-hover-effects-ultimate'),
                'type' => Controls::ICON,
                    ]
            );
            $this->add_control(
                    'image_hover_front_description', $this->style, [
                'label' => esc_html__('Short Description', 'image-hover-effects-ultimate'),
                'type' => Controls::TEXTAREA,
                'default' => '',
                'description' => 'Add Your Description Unless make it blank.'
                    ]
            );
            $this->add_control(
                    'image_hover_back_description', $this->style, [
                'label' => esc_html__('Short Description', 'image-hover-effects-ultimate'),
                'type' => Controls::TEXTAREA,
                'default' => '',
                'description' => 'Add Your Description Unless make it blank.'
                    ]
            );
            $this->start_controls_tabs(
                    'image_hover-start-tabs', [
                'separator' => TRUE,
                'options' => [
                    'frontend' => esc_html__('Front Image', 'image-hover-effects-ultimate'),
                    'backend' => esc_html__('Backend Image', 'image-hover-effects-ultimate'),
                ]
                    ]
            );
            $this->start_controls_tab();

            $this->add_group_control(
                    'image_hover_front_image', $this->style,
                    [
                        'label' => esc_html__('Image', 'image-hover-effects-ultimate'),
                        'type' => Controls::MEDIA,
                        'description' => 'Add or Modify Your Front Background Image. Adjust Front Background to get better design.'
                    ]
            );

            $this->end_controls_tab();

            $this->start_controls_tab();
            $this->add_group_control(
                    'image_hover_back_image', $this->style,
                    [
                        'label' => esc_html__('Feature Image', 'image-hover-effects-ultimate'),
                        'type' => Controls::MEDIA,
                        'description' => 'Add or Modify Your Backend Image. Adjust Backend background to get better design.'
                    ]
            );
            $this->end_controls_tab();
            $this->end_controls_tabs();

            $this->add_group_control(
                    'image_hover_button_link', $this->style, [
                'label' => esc_html__('URL', 'image-hover-effects-ultimate'),
                'type' => Controls::URL,
                'separator' => TRUE,
                'default' => '',
                'placeholder' => 'https://www.yoururl.com',
                'description' => 'Add Your Desire Link or Url Unless make it blank'
                    ]
            );
            $this->add_control(
                    'image_hover_button_text', $this->style, [
                'label' => esc_html__('Button Text', 'image-hover-effects-ultimate'),
                'type' => Controls::TEXT,
                'default' => '',
                'description' => 'Customize your button text. Button will only view while Url given'
                    ]
            );
            ?>
        </div>
        <?php
    }

    /**
     * Template Parent Item Data Rearrange
     *
     * @since 2.0.0
     */
    public function Rearrange() {
        return '<li class="list-group-item" id="{{id}}">{{image_hover_front_heading}}</li>';
    }

}
