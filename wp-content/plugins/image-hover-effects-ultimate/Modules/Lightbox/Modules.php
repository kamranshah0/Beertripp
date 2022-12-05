<?php

namespace OXI_IMAGE_HOVER_PLUGINS\Modules\Lightbox;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Description of Modules
 *
 * @author biplo
 */
use OXI_IMAGE_HOVER_PLUGINS\Classes\Controls as Controls;
use OXI_IMAGE_HOVER_PLUGINS\Page\Admin_Render as Admin_Render;

class Modules extends Admin_Render {

    public function register_controls() {
        $this->start_section_header(
                'oxi-image-hover-start-tabs', [
            'options' => [
                'general-settings' => esc_html__('General Settings', 'image-hover-effects-ultimate'),
                'custom' => esc_html__('Custom CSS', 'image-hover-effects-ultimate'),
            ],
                ]
        );
        $this->register_general_tabs();
        $this->register_custom_tabs();
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

    public function register_general_tabs() {
        $this->start_section_tabs(
                'oxi-image-hover-start-tabs', [
            'condition' => [
                'oxi-image-hover-start-tabs' => 'general-settings',
            ],
                ]
        );
        $this->start_section_devider();
        $this->register_general_style();
        $this->register_image_settings();
        $this->register_icon_settings();
        $this->register_button_settings();
        $this->register_overlay_icon_settings();
        $this->register_overlay_image_settings();
        $this->end_section_devider();
        $this->start_section_devider();
        $this->register_light_settings();
        $this->register_heading_details_settings();
        $this->end_section_devider();
        $this->end_section_tabs();
    }

    /*
     * @return void
     * Start Module Method for Genaral Style  #Light-box
     */

    public function register_general_style() {
        $this->start_controls_section(
                'oxi-image-hover', [
            'label' => esc_html__('General Style', 'image-hover-effects-ultimate'),
            'showing' => true,
                ]
        );
        $this->add_control(
                'oxi_image_light_box_clickable',
                $this->style,
                [
                    'label' => esc_html__('Show Clickable Box', 'image-hover-effects-ultimate'),
                    'type' => Controls::SELECT,
                    'loader' => true,
                    'default' => 'image',
                    'options' => [
                        'image' => esc_html__('Image', 'image-hover-effects-ultimate'),
                        'button' => esc_html__('Button', 'image-hover-effects-ultimate'),
                        'icon' => esc_html__('Icon', 'image-hover-effects-ultimate'),
                    ],
                    'description' => 'Select Body type for Lightbox.'
                ]
        );
        $this->add_group_control(
                'oxi-image-hover-col',
                $this->style,
                [
                    'type' => Controls::COLUMN,
                    'default' => 'oxi-bt-col-lg-1',
                    'selector' => [
                        '{{WRAPPER}} .oxi_addons__light_box' => '',
                    ],
                ]
        );

        $this->add_group_control(
                'oxi_image_light_box_bg_color',
                $this->style,
                [
                    'label' => esc_html__('Background Color', 'image-hover-effects-ultimate'),
                    'type' => Controls::BACKGROUND,
                    'selector' => [
                        '{{WRAPPER}} .oxi_addons__light_box  .oxi_addons__light_box_parent' => '',
                    ],
                    'description' => 'Customize Content Background.'
                ]
        );
        $this->add_responsive_control(
                'oxi_image_light_box_padding',
                $this->style,
                [
                    'label' => esc_html__('Padding', 'image-hover-effects-ultimate'),
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
                            'min' => 0,
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
                        '{{WRAPPER}} .oxi_addons__light_box .oxi_addons__light_box_parent' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'description' => 'Padding used to generate space around an Lightbox content.',
                ]
        );
        $this->add_responsive_control(
                'oxi_image_light_box_margin',
                $this->style,
                [
                    'label' => esc_html__('Margin', 'image-hover-effects-ultimate'),
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
                        '{{WRAPPER}} .oxi_addons__light_box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'description' => 'Margin properties are used to create space outside of Content .',
                ]
        );
        $this->end_controls_section();
    }

    /*
     * @return void
     * Start Module Method forImage Setting #Light-box
     */

    public function register_image_settings() {
        $this->start_controls_section(
                'oxi-image-hover', [
            'label' => esc_html__('Image Settings', 'image-hover-effects-ultimate'),
            'showing' => false,
            'condition' => [
                'oxi_image_light_box_clickable' => 'image',
            ],
                ]
        );

        $this->add_control(
                'oxi_image_light_box_custom_width_height_swither',
                $this->style,
                [
                    'label' => esc_html__('Width Height', 'image-hover-effects-ultimate'),
                    'type' => Controls::SWITCHER,
                    'default' => 'no',
                    'loader' => true,
                    'label_on' => esc_html__('Custom', 'image-hover-effects-ultimate'),
                    'label_off' => esc_html__('Auto', 'image-hover-effects-ultimate'),
                    'return_value' => 'oxi_addons__custom_width_height',
                    'description' => 'Wanna set Custom Width height?',
                ]
        );
        $this->add_responsive_control(
                'oxi_image_light_box_width',
                $this->style,
                [
                    'label' => esc_html__('Width', 'image-hover-effects-ultimate'),
                    'type' => Controls::SLIDER,
                    'default' => [
                        'unit' => '%',
                        'size' => 100,
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1500,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                            'step' => 1,
                        ],
                        'rem' => [
                            'min' => 1,
                            'max' => 200,
                            'step' => 2,
                        ],
                    ],
                    'condition' => [
                        'oxi_image_light_box_custom_width_height_swither' => 'oxi_addons__custom_width_height',
                    ],
                    'selector' => [
                        '{{WRAPPER}} .oxi_addons__light_box  .oxi_addons__image_main.oxi_addons__custom_width_height' => 'width:{{SIZE}}{{UNIT}} !important; max-width: 100%;',
                    ],
                    'description' => 'Set Your Image Width with multiple options.',
                ]
        );
        $this->add_responsive_control(
                'oxi_image_light_box_height',
                $this->style,
                [
                    'label' => esc_html__('Height', 'image-hover-effects-ultimate'),
                    'type' => Controls::SLIDER,
                    'default' => [
                        'unit' => '%',
                        'size' => 70,
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 800,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 250,
                            'step' => .1,
                        ],
                        'rem' => [
                            'min' => 1,
                            'max' => 200,
                            'step' => 2,
                        ],
                    ],
                    'condition' => [
                        'oxi_image_light_box_custom_width_height_swither' => 'oxi_addons__custom_width_height',
                    ],
                    'selector' => [
                        '{{WRAPPER}} .oxi_addons__light_box  .oxi_addons__image_main.oxi_addons__custom_width_height::after' => 'padding-bottom:{{SIZE}}{{UNIT}};',
                    ],
                    'description' => 'Set Your Image Height with multiple options.',
                ]
        );
        $this->add_group_control(
                'oxi_image_front_width_border',
                $this->style,
                [
                    'type' => Controls::BORDER,
                    'selector' => [
                        '{{WRAPPER}} .oxi_addons__light_box .oxi_addons__image_main' => '',
                    ],
                    'description' => 'Border property is used to set the Border of the Image.',
                ]
        );

        $this->add_responsive_control(
                'oxi_image_front_width_border_radius',
                $this->style,
                [
                    'label' => esc_html__('Border radius', 'image-hover-effects-ultimate'),
                    'separator' => false,
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
                            'min' => 0,
                            'max' => 500,
                            'step' => 1,
                        ],
                        'em' => [
                            'min' => 0,
                            'max' => 10,
                            'step' => .1,
                        ],
                    ],
                    'selector' => [
                        '{{WRAPPER}} .oxi_addons__light_box .oxi_addons__image_main' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .oxi_addons__light_box .oxi_addons__image_main::after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'description' => 'Allows you to add rounded corners to Image with options.',
                ]
        );
        $this->add_group_control(
                'oxi_image_light_box_image_width_box_shadow',
                $this->style,
                [
                    'label' => esc_html__('Box Shadow', 'image-hover-effects-ultimate'),
                    'type' => Controls::BOXSHADOW,
                    'selector' => [
                        '{{WRAPPER}} .oxi_addons__light_box .oxi_addons__image_main' => '',
                    ],
                    'description' => 'Allows you to attaches one or more shadows into Image.',
                ]
        );

        $this->end_controls_section();
    }

    /*
     * @return void
     * Start Module Method for Icon Settings  #Light-box
     */

    public function register_icon_settings() {
        $this->start_controls_section(
                'oxi-image-hover', [
            'label' => esc_html__('Icon Settings', 'image-hover-effects-ultimate'),
            'showing' => false,
            'condition' => [
                'oxi_image_light_box_clickable' => 'icon',
            ],
                ]
        );

        $this->add_responsive_control(
                'oxi_image_light_box_icon_font_size',
                $this->style,
                [
                    'label' => esc_html__('Size', 'image-hover-effects-ultimate'),
                    'type' => Controls::SLIDER,
                    'default' => [
                        'unit' => 'px',
                        'size' => '30',
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 50,
                            'step' => .1,
                        ],
                        'em' => [
                            'min' => 0,
                            'max' => 5,
                            'step' => .1,
                        ],
                    ],
                    'selector' => [
                        '{{WRAPPER}} .oxi_addons__light_box  .oxi_addons__icon > .oxi-icons' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                    'description' => 'Set Your Icon Size with multiple options.',
                ]
        );
        $this->add_responsive_control(
                'oxi_image_light_box_icon_width_height_custom',
                $this->style,
                [
                    'label' => esc_html__('Height & Width', 'image-hover-effects-ultimate'),
                    'type' => Controls::SLIDER,
                    'default' => [
                        'unit' => 'px',
                        'size' => '80',
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 50,
                            'step' => .1,
                        ],
                        'em' => [
                            'min' => 0,
                            'max' => 5,
                            'step' => .1,
                        ],
                    ],
                    'selector' => [
                        '{{WRAPPER}} .oxi_addons__light_box .oxi_addons__icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    ],
                    'description' => 'Set Your Icon Custom Height & Width with multiple options.',
                ]
        );
        $this->add_control(
                'oxi_image_light_box_icon_color',
                $this->style,
                [
                    'label' => esc_html__('Icon Color', 'image-hover-effects-ultimate'),
                    'type' => Controls::COLOR,
                    'default' => '#ffffff',
                    'selector' => [
                        '{{WRAPPER}} .oxi_addons__light_box .oxi_addons__icon .oxi-icons' => 'color: {{VALUE}};',
                    ],
                    'description' => 'Select Your Icon Color.',
                ]
        );
        $this->add_control(
                'oxi_image_light_box_icon_background',
                $this->style,
                [
                    'label' => esc_html__('Background', 'image-hover-effects-ultimate'),
                    'type' => Controls::COLOR,
                    'oparetor' => 'RGB',
                    'default' => '#000',
                    'selector' => [
                        '{{WRAPPER}} .oxi_addons__light_box .oxi_addons__icon' => 'background:{{VALUE}};',
                    ],
                    'description' => 'Customize Your Icon Background Color.',
                ]
        );
        $this->add_control(
                'oxi_image_light_box_icon_alignment',
                $this->style,
                [
                    'label' => esc_html__('Icon Alignment', 'image-hover-effects-ultimate'),
                    'type' => Controls::CHOOSE,
                    'operator' => Controls::OPERATOR_ICON,
                    'default' => 'center',
                    'options' => [
                        'flex-start' => [
                            'title' => esc_html__('Left', 'image-hover-effects-ultimate'),
                            'icon' => 'fa fa-align-left',
                        ],
                        'center' => [
                            'title' => esc_html__('Center', 'image-hover-effects-ultimate'),
                            'icon' => 'fa fa-align-center',
                        ],
                        'flex-end' => [
                            'title' => esc_html__('Right', 'image-hover-effects-ultimate'),
                            'icon' => 'fa fa-align-right',
                        ],
                    ],
                    'selector' => [
                        '{{WRAPPER}} .oxi_addons__light_box .oxi_addons__light_box_parent' => 'justify-content: {{VALUE}};',
                    ],
                    'description' => 'Set Your Icon Position.',
                ]
        );
        $this->add_group_control(
                'oxi_image_light_box_icon_border',
                $this->style,
                [
                    'type' => Controls::BORDER,
                    'selector' => [
                        '{{WRAPPER}} .oxi_addons__light_box .oxi_addons__icon' => '',
                    ],
                    'description' => 'Border property is used to set the Border of the Icon Body.',
                ]
        );
        $this->add_responsive_control(
                'oxi_image_light_box_icon_radius',
                $this->style,
                [
                    'label' => esc_html__('Border Radius', 'image-hover-effects-ultimate'),
                    'type' => Controls::DIMENSIONS,
                    'default' => [
                        'unit' => 'px',
                        'size' => '50',
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 50,
                            'step' => .1,
                        ],
                        'em' => [
                            'min' => 0,
                            'max' => 10,
                            'step' => .1,
                        ],
                    ],
                    'selector' => [
                        '{{WRAPPER}} .oxi_addons__light_box .oxi_addons__icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .oxi_addons__light_box .oxi_addons__icon::after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'description' => 'Allows you to add rounded corners to Icon Body with options.',
                ]
        );
        $this->add_group_control(
                'oxi_image_light_box_icon_shadow',
                $this->style,
                [
                    'type' => Controls::BOXSHADOW,
                    'selector' => [
                        '{{WRAPPER}} .oxi_addons__light_box .oxi_addons__icon' => '',
                    ],
                    'description' => 'Allows you to attaches one or more shadows into Icon Body.',
                ]
        );

        $this->end_controls_section();
    }

    /*
     * @return void
     * Start Module Method for Light Settings  #Light-box
     */

    public function register_light_settings() {
        $this->start_controls_section(
                'oxi-image-hover', [
            'label' => esc_html__('Light Settings', 'image-hover-effects-ultimate'),
            'showing' => true,
                ]
        );

        $this->add_control(
                'oxi_image_light_box_bg_light_box',
                $this->style,
                [
                    'label' => esc_html__('Background', 'image-hover-effects-ultimate'),
                    'type' => Controls::COLOR,
                    'oparetor' => 'RGB',
                    'default' => '#000',
                    'selector' => [
                        '.oxi_____disabled, .oxi_addons_light_box_overlay_' . $this->oxiid . ' .lg' => 'background:{{VALUE}};',
                    ],
                    'description' => 'Customize Lightbox Background Color.',
                ]
        );

        $this->end_controls_section();
    }

    /*
     * @return void
     * Start Module Method for Heading Details Settings  #Light-box
     */

    public function register_heading_details_settings() {
        $this->start_controls_section(
                'oxi-image-hover', [
            'label' => esc_html__('Heading Details Settings', 'image-hover-effects-ultimate'),
            'showing' => true,
                ]
        );

        $this->add_control(
                'oxi_image_light_box_bg_heading_details',
                $this->style,
                [
                    'label' => esc_html__('Background', 'image-hover-effects-ultimate'),
                    'type' => Controls::COLOR,
                    'oparetor' => 'RGB',
                    'default' => 'rgba(59, 59, 59, 0.64)',
                    'selector' => [
                        '.oxi_____disabled, .oxi_addons_light_box_overlay_' . $this->oxiid . ' .lg-sub-html' => 'background:{{VALUE}};',
                    ],
                    'description' => 'Allows you to set Backgroud Color of Lightbox Text and Descriptions.',
                ]
        );
        $this->start_controls_tabs(
                'shortcode-addons-start-tabs',
                [
                    'options' => [
                        'heading' => esc_html__('Heading', 'image-hover-effects-ultimate'),
                        'description' => esc_html__('Description', 'image-hover-effects-ultimate'),
                    ],
                ]
        );
        $this->start_controls_tab();
        $this->add_control(
                'oxi_image_light_box_tag',
                $this->style,
                [
                    'label' => esc_html__('Tag', 'image-hover-effects-ultimate'),
                    'type' => Controls::SELECT,
                    'default' => 'h3',
                    'loader' => true,
                    'options' => [
                        'h1' => esc_html__('H1', 'image-hover-effects-ultimate'),
                        'h2' => esc_html__('H2', 'image-hover-effects-ultimate'),
                        'h3' => esc_html__('H3', 'image-hover-effects-ultimate'),
                        'h4' => esc_html__('H4', 'image-hover-effects-ultimate'),
                        'h5' => esc_html__('H5', 'image-hover-effects-ultimate'),
                        'h6' => esc_html__('H6', 'image-hover-effects-ultimate'),
                        'div' => esc_html__('DIV', 'image-hover-effects-ultimate'),
                    ],
                    'description' => 'Confirm Your Haading Tag.',
                ]
        );
        $this->add_group_control(
                'oxi_image_light_box_heading_typo',
                $this->style,
                [
                    'label' => esc_html__('Typography', 'image-hover-effects-ultimate'),
                    'type' => Controls::TYPOGRAPHY,
                    'include' => Controls::ALIGNNORMAL,
                    'selector' => [
                        '.oxi_____disabled, .oxi_addons_light_box_overlay_' . $this->oxiid . ' .oxi_addons__heading' => '',
                    ],
                ]
        );
        $this->add_control(
                'oxi_image_light_box_heading_color',
                $this->style,
                [
                    'label' => esc_html__('Color', 'image-hover-effects-ultimate'),
                    'type' => Controls::COLOR,
                    'default' => '#fff',
                    'selector' => [
                        '.oxi_____disabled, .oxi_addons_light_box_overlay_' . $this->oxiid . ' .oxi_addons__heading' => 'color:{{VALUE}};',
                    ],
                    'description' => 'Customize Heading Color.',
                ]
        );

        $this->add_responsive_control(
                'oxi_image_light_box_heading_padding',
                $this->style,
                [
                    'label' => esc_html__('Padding', 'image-hover-effects-ultimate'),
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
                            'min' => 0,
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
                        '.oxi_____disabled, .oxi_addons_light_box_overlay_' . $this->oxiid . ' .oxi_addons__heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                    ],
                    'description' => 'Update Your Text Padding with Multiple values.',
                ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab();
        $this->add_group_control(
                'oxi_image_light_box_desc_typo',
                $this->style,
                [
                    'label' => esc_html__('Typography', 'image-hover-effects-ultimate'),
                    'type' => Controls::TYPOGRAPHY,
                    'include' => Controls::ALIGNNORMAL,
                    'selector' => [
                        '.oxi_____disabled, .oxi_addons_light_box_overlay_' . $this->oxiid . ' .oxi_addons__details' => '',
                    ],
                ]
        );
        $this->add_control(
                'oxi_image_light_box_desc_color',
                $this->style,
                [
                    'label' => esc_html__('Color', 'image-hover-effects-ultimate'),
                    'type' => Controls::COLOR,
                    'default' => '#fff',
                    'selector' => [
                        '.oxi_____disabled, .oxi_addons_light_box_overlay_' . $this->oxiid . ' .oxi_addons__details' => 'color:{{VALUE}};',
                    ],
                    'description' => 'Customize Descriptions Color.',
                ]
        );

        $this->add_responsive_control(
                'oxi_image_light_box_desc_padding',
                $this->style,
                [
                    'label' => esc_html__('Padding', 'image-hover-effects-ultimate'),
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
                            'min' => 0,
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
                        '.oxi_____disabled, .oxi_addons_light_box_overlay_' . $this->oxiid . ' .oxi_addons__details_light_box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'description' => 'Update Your Text Padding with Multiple values.',
                ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    /*
     * @return void
     * Start Module Method for Button Settings  #Light-box
     */

    public function register_button_settings() {
        $this->start_controls_section(
                'shortcode-addons',
                [
                    'label' => esc_html__('Button Setting', 'image-hover-effects-ultimate'),
                    'showing' => false,
                    'condition' => [
                        'oxi_image_light_box_clickable' => 'button',
                    ],
                ]
        );
        $this->add_control(
                'oxi_image_light_box_btn_position',
                $this->style,
                [
                    'label' => esc_html__('Button Position', 'image-hover-effects-ultimate'),
                    'type' => Controls::CHOOSE,
                    'default' => 'center',
                    'loader' => true,
                    'options' => [
                        'left' => [
                            'title' => esc_html__('Left', 'image-hover-effects-ultimate'),
                        ],
                        'center' => [
                            'title' => esc_html__('Center', 'image-hover-effects-ultimate'),
                        ],
                        'right' => [
                            'title' => esc_html__('Right', 'image-hover-effects-ultimate'),
                        ],
                    ],
                    'selector' => [
                        '{{WRAPPER}} .oxi_addons__light_box .oxi_addons__button_main' => 'text-align:{{VALUE}};',
                    ],
                    'description' => 'Allows you set Button Align as Left, Center or Right.',
                ]
        );
        $this->add_group_control(
                'oxi_image_light_box_btn_text_typho',
                $this->style,
                [
                    'type' => Controls::TYPOGRAPHY,
                    'selector' => [
                        '{{WRAPPER}} .oxi_addons__light_box .oxi_addons__button' => '',
                    ],
                ]
        );
        $this->start_controls_tabs(
                'shortcode-addons-start-tabs',
                [
                    'options' => [
                        'normal' => esc_html__('Normal View', 'image-hover-effects-ultimate'),
                        'hover' => esc_html__('Hover View', 'image-hover-effects-ultimate'),
                    ],
                ]
        );
        $this->start_controls_tab();
        $this->add_control(
                'oxi_image_light_box_btn_color',
                $this->style,
                [
                    'label' => esc_html__('Color', 'image-hover-effects-ultimate'),
                    'type' => Controls::COLOR,
                    'default' => '#fff',
                    'selector' => [
                        '{{WRAPPER}} .oxi_addons__light_box .oxi_addons__button' => 'color:{{VALUE}};',
                    ],
                    'description' => 'Color property is used to set the color of the Button.',
                ]
        );
        $this->add_control(
                'oxi_image_light_box_btn_bg_color',
                $this->style,
                [
                    'label' => esc_html__('Background Color', 'image-hover-effects-ultimate'),
                    'type' => Controls::COLOR,
                    'default' => 'rgba(17, 106, 177, 1.00)',
                    'oparetor' => 'RGB',
                    'selector' => [
                        '{{WRAPPER}} .oxi_addons__light_box .oxi_addons__button' => 'background-color:{{VALUE}};',
                    ],
                    'description' => 'Background property is used to set the Background of the Button.',
                ]
        );

        $this->add_group_control(
                'oxi_image_light_box_btn_br',
                $this->style,
                [
                    'type' => Controls::BORDER,
                    'selector' => [
                        '{{WRAPPER}} .oxi_addons__light_box .oxi_addons__button' => '',
                    ],
                    'description' => 'Border property is used to set the Border of the Button.',
                ]
        );

        $this->add_responsive_control(
                'oxi_image_light_box_btn_br_radius',
                $this->style,
                [
                    'label' => esc_html__('Border radius', 'image-hover-effects-ultimate'),
                    'separator' => false,
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
                            'min' => 0,
                            'max' => 500,
                            'step' => 1,
                        ],
                        'em' => [
                            'min' => 0,
                            'max' => 10,
                            'step' => .1,
                        ],
                    ],
                    'selector' => [
                        '{{WRAPPER}} .oxi_addons__light_box .oxi_addons__button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'description' => 'Allows you to add rounded corners to Button with options.',
                ]
        );
        $this->add_group_control(
                'oxi_image_light_box_btn_box_shadow_button',
                $this->style,
                [
                    'type' => Controls::BOXSHADOW,
                    'selector' => [
                        '{{WRAPPER}} .oxi_addons__light_box .oxi_addons__button' => '',
                    ],
                    'description' => 'Allows you to attaches one or more shadows into Button.',
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab();
        $this->add_control(
                'oxi_image_light_box_btn_hover_color',
                $this->style,
                [
                    'label' => esc_html__('Color', 'image-hover-effects-ultimate'),
                    'type' => Controls::COLOR,
                    'default' => '#fff',
                    'selector' => [
                        '{{WRAPPER}} .oxi_addons__light_box .oxi_addons__button:hover' => 'color:{{VALUE}};',
                    ],
                    'description' => 'Color property is used to set the Hover color of the Button.',
                ]
        );
        $this->add_control(
                'oxi_image_light_box_btn_hover_bg_color',
                $this->style,
                [
                    'label' => esc_html__('Background Color', 'image-hover-effects-ultimate'),
                    'type' => Controls::COLOR,
                    'default' => 'rgba(17, 106, 177, 1.00)',
                    'oparetor' => 'RGB',
                    'selector' => [
                        '{{WRAPPER}} .oxi_addons__light_box .oxi_addons__button:hover' => 'background-color:{{VALUE}};',
                    ],
                    'description' => 'Background property is used to set the Hover Background of the Button.',
                ]
        );

        $this->add_group_control(
                'oxi_image_light_box_btn_h-br',
                $this->style,
                [
                    'type' => Controls::BORDER,
                    'selector' => [
                        '{{WRAPPER}} .oxi_addons__light_box .oxi_addons__button:hover' => '',
                    ],
                    'description' => 'Border property is used to set the Hover Border of the Button.',
                ]
        );

        $this->add_responsive_control(
                'oxi_image_light_box_btn_hover-br-radius',
                $this->style,
                [
                    'label' => esc_html__('Border radius', 'image-hover-effects-ultimate'),
                    'separator' => false,
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
                            'min' => 0,
                            'max' => 500,
                            'step' => 1,
                        ],
                        'em' => [
                            'min' => 0,
                            'max' => 10,
                            'step' => .1,
                        ],
                    ],
                    'selector' => [
                        '{{WRAPPER}} .oxi_addons__light_box .oxi_addons__button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'description' => 'Allows you to add rounded corners at hover to Button with options.',
                ]
        );

        $this->add_group_control(
                'oxi_image_light_box_btn_h_box_shadow',
                $this->style,
                [
                    'type' => Controls::BOXSHADOW,
                    'selector' => [
                        '{{WRAPPER}} .oxi_addons__light_box .oxi_addons__button:hover' => '',
                    ],
                    'description' => 'Allows you at hover to attaches one or more shadows into Button.',
                ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();
        $this->add_responsive_control(
                'oxi_image_light_box_btn_padding',
                $this->style,
                [
                    'label' => esc_html__('Padding', 'image-hover-effects-ultimate'),
                    'type' => Controls::DIMENSIONS,
                    'separator' => true,
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
                        '{{WRAPPER}} .oxi_addons__light_box .oxi_addons__button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'description' => 'Generate space around a Button, inside of any defined borders or Background.',
                ]
        );
        $this->add_responsive_control(
                'oxi_image_light_box_btn_margin',
                $this->style,
                [
                    'label' => esc_html__('Margin', 'image-hover-effects-ultimate'),
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
                        '{{WRAPPER}} .oxi_addons__light_box .oxi_addons__button_main' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'description' => 'Generate space around a Button, Outside of Content.',
                ]
        );

        $this->end_controls_section();
    }

    /*
     * @return void
     * Start Module Method for Icon overlay Settings  #Light-box
     */

    public function register_overlay_icon_settings() {

        $this->start_controls_section(
                'shortcode-addons',
                [
                    'label' => esc_html__('Icon Overlay Settings', 'image-hover-effects-ultimate'),
                    'showing' => true,
                    'condition' => [
                        'oxi_image_light_box_clickable' => 'icon',
                    ],
                ]
        );
        $this->add_control(
                'oxi_image_light_box_bg_overlay_icon_icon',
                $this->style,
                [
                    'label' => esc_html__('Icon', 'image-hover-effects-ultimate'),
                    'type' => Controls::ICON,
                    'default' => 'fas fa-search',
                    'placeholder' => 'example:- fas fa-search',
                    'description' => 'Select Icon for Overlay.',
                ]
        );

        $this->add_responsive_control(
                'oxi_image_light_box_icon_size_overlay_icon_icon',
                $this->style,
                [
                    'label' => esc_html__('Size', 'image-hover-effects-ultimate'),
                    'type' => Controls::SLIDER,
                    'default' => [
                        'unit' => 'px',
                        'size' => '30',
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 50,
                            'step' => .1,
                        ],
                        'em' => [
                            'min' => 0,
                            'max' => 5,
                            'step' => .1,
                        ],
                    ],
                    'selector' => [
                        '{{WRAPPER}} .oxi_addons__light_box .oxi_addons__overlay .oxi-icons' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                    'description' => 'Customize Overlay Icon Size with Multiple Options.',
                ]
        );
        $this->add_control(
                'oxi_image_light_box_bg_overlay_bg_icon',
                $this->style,
                [
                    'label' => esc_html__('Background', 'image-hover-effects-ultimate'),
                    'type' => Controls::COLOR,
                    'oparetor' => 'RGB',
                    'default' => 'rgba(59, 59, 59, 0.64)',
                    'selector' => [
                        '{{WRAPPER}} .oxi_addons__light_box .oxi_addons__icon:hover::after' => 'background:{{VALUE}};',
                    ],
                    'description' => 'Customize Overlay Icon Background Color.',
                ]
        );
        $this->end_controls_section();
    }

    /*
     * @return void
     * Start Module Method for overlay Image Settings  #Light-box
     */

    public function register_overlay_image_settings() {
        $this->start_controls_section(
                'shortcode-addons',
                [
                    'label' => esc_html__('Image Overlay Settings', 'image-hover-effects-ultimate'),
                    'showing' => false,
                    'condition' => [
                        'oxi_image_light_box_clickable' => 'image',
                    ],
                ]
        );
        $this->add_control(
                'oxi_image_light_box_bg_overlay_icon',
                $this->style,
                [
                    'label' => esc_html__('Icon', 'image-hover-effects-ultimate'),
                    'type' => Controls::ICON,
                    'default' => 'fas fa-search',
                    'placeholder' => 'example:- fas fa-search',
                    'description' => 'Select Image Overlay Icon.',
                ]
        );

        $this->add_responsive_control(
                'oxi_image_light_box_icon_size_overlay_icon',
                $this->style,
                [
                    'label' => esc_html__('Size', 'image-hover-effects-ultimate'),
                    'type' => Controls::SLIDER,
                    'default' => [
                        'unit' => 'px',
                        'size' => '30',
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 50,
                            'step' => .1,
                        ],
                        'em' => [
                            'min' => 0,
                            'max' => 5,
                            'step' => .1,
                        ],
                    ],
                    'selector' => [
                        '{{WRAPPER}} .oxi_addons__light_box .oxi_addons__overlay .oxi-icons' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                    'description' => 'Customize Image Overlay Icon Size.',
                ]
        );
        $this->add_control(
                'oxi_image_light_box_bg_overlay_color',
                $this->style,
                [
                    'label' => esc_html__('Color', 'image-hover-effects-ultimate'),
                    'type' => Controls::COLOR,
                    'default' => '#fff',
                    'selector' => [
                        '{{WRAPPER}} .oxi_addons__light_box .oxi_addons__overlay .oxi-icons' => 'color:{{VALUE}};',
                    ],
                    'description' => 'Confirm Image Overlay Color.',
                ]
        );
        $this->add_control(
                'oxi_image_light_box_bg_overlay_bg',
                $this->style,
                [
                    'label' => esc_html__('Background', 'image-hover-effects-ultimate'),
                    'type' => Controls::COLOR,
                    'oparetor' => 'RGB',
                    'default' => 'rgba(59, 59, 59, 0.64)',
                    'selector' => [
                        '{{WRAPPER}} .oxi_addons__light_box .oxi_addons__image_main:hover::after' => 'background:{{VALUE}};',
                    ],
                    'description' => 'Customize Image Overlay Background Color.',
                ]
        );
        $this->end_controls_section();
    }

    /*
     * @return void
     * Start Module Method for Modal Opener and Modal  #Light-box
     */

    public function modal_opener() {
        $this->add_substitute_control('', [], [
            'type' => Controls::MODALOPENER,
            'title' => esc_html__('Add New Light box', 'image-hover-effects-ultimate'),
            'sub-title' => esc_html__('Open Light Box Form', 'image-hover-effects-ultimate'),
            'showing' => true,
        ]);
    }

    public function modal_form_data() {
        ?>
        <div class="modal-header">
            <h4 class="modal-title">Image Hover Form</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <?php
            $this->start_controls_section(
                    'oxi-image-hover', [
                'label' => esc_html__('General Style', 'image-hover-effects-ultimate'),
                'showing' => true,
                    ]
            );

            $this->add_group_control(
                    'oxi_image_light_box_image_front', $this->style, [
                'label' => esc_html__('Media Type', 'image-hover-effects-ultimate'),
                'type' => Controls::MEDIA,
                'default' => [
                    'type' => 'media-library',
                    'link' => 'https://www.shortcode-addons.com/wp-content/uploads/2020/01/placeholder.png',
                ],
                'condition' => [
                    'oxi_image_light_box_clickable' => 'image',
                ],
                    ]
            );
            $this->add_control(
                    'oxi_image_light_box_button_icon', $this->style, [
                'label' => esc_html__('Icon', 'image-hover-effects-ultimate'),
                'type' => Controls::ICON,
                'default' => 'fab fa-accusoft',
                'condition' => [
                    'oxi_image_light_box_clickable' => 'icon',
                ],
                    ]
            );
            $this->add_control(
                    'oxi_image_light_box_button_text', $this->style, [
                'label' => esc_html__('Button Text', 'image-hover-effects-ultimate'),
                'type' => Controls::TEXT,
                'default' => esc_html__('Show Popup', 'image-hover-effects-ultimate'),
                'selector' => [
                    '{{WRAPPER}} .oxi_addons__light_box_{{KEY}} .oxi_addons__button' => '',
                ],
                'condition' => [
                    'oxi_image_light_box_clickable' => 'button',
                ],
                    ]
            );

            $this->end_controls_section();
            $this->start_controls_section(
                    'oxi-image-hover', [
                'label' => esc_html__('Popup Settings', 'image-hover-effects-ultimate'),
                'showing' => true,
                    ]
            );
            $this->add_control(
                    'oxi_image_light_box_select_type', $this->style, [
                'label' => esc_html__('Select Type', 'image-hover-effects-ultimate'),
                'type' => Controls::SELECT,
                'default' => 'image',
                'loader' => true,
                'options' => [
                    'image' => esc_html__('Image', 'image-hover-effects-ultimate'),
                    'video' => esc_html__('Video', 'image-hover-effects-ultimate'),
                ],
                    ]
            );
            $this->add_group_control(
                    'oxi_image_light_box_image', $this->style, [
                'label' => esc_html__('Media Type', 'image-hover-effects-ultimate'),
                'type' => Controls::MEDIA,
                'default' => [
                    'type' => 'media-library',
                    'link' => 'https://www.shortcode-addons.com/wp-content/uploads/2020/01/placeholder.png',
                ],
                'condition' => [
                    'oxi_image_light_box_select_type' => 'image',
                ],
                    ]
            );
            $this->add_control(
                    'oxi_image_light_box_video', $this->style, [
                'label' => esc_html__('Youtube Link', 'image-hover-effects-ultimate'),
                'type' => Controls::TEXT,
                'placeholder' => 'https://www.youtube.com/watch?v=sEWx6H8gZH8',
                'default' => 'https://www.youtube.com/watch?v=sEWx6H8gZH8',
                'condition' => [
                    'oxi_image_light_box_select_type' => 'video',
                ],
                    ]
            );
            $this->add_control(
                    'oxi_image_light_box_title', $this->style, [
                'label' => esc_html__('Title', 'image-hover-effects-ultimate'),
                'type' => Controls::TEXT,
                'default' => esc_html__('What is Lorem Ipsum? ', 'image-hover-effects-ultimate'),
                'selector' => [
                    '{{WRAPPER}} .oxi_addons__light_box_{{KEY}} .oxi_addons__heading' => '',
                ],
                    ]
            );
            $this->add_control(
                    'oxi_image_light_box_desc', $this->style, [
                'label' => esc_html__('Description', 'image-hover-effects-ultimate'),
                'type' => Controls::TEXTAREA,
                'default' => esc_html__('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrytandard ', 'image-hover-effects-ultimate'),
                'selector' => [
                    '{{WRAPPER}} .oxi_addons__light_box_{{KEY}} .oxi_addons__details' => '',
                ],
                    ]
            );

            $this->end_controls_section();
            ?>
        </div>
        <?php
    }

}
