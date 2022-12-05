<?php

namespace OXI_IMAGE_HOVER_PLUGINS\Modules\Carousel\Admin;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Description of Effects1
 *
 * @author biplob
 */
use OXI_IMAGE_HOVER_PLUGINS\Modules\Carousel\Modules as Modules;
use OXI_IMAGE_HOVER_PLUGINS\Classes\Controls as Controls;

class Effects3 extends Modules {

    public function register_carousel_query_settings() {
        $this->start_controls_section(
                'display-post',
                [
                    'label' => esc_html__('Carousel Query', 'image-hover-effects-ultimate'),
                    'showing' => TRUE,
                ]
        );
        $this->add_control(
                'carousel_note',
                $this->style,
                [
                    'label' => esc_html__('Note', 'image-hover-effects-ultimate'),
                    'type' => Controls::HEADING,
                    'description' => 'Works after saving and reloading all the fields '
                ]
        );
        $this->add_control(
                'carousel_register_style',
                $this->style,
                [
                    'label' => esc_html__('Carousel Style', 'image-hover-effects-ultimate'),
                    'loader' => TRUE,
                    'type' => Controls::SELECT,
                    'options' => $this->all_style(),
                    'description' => 'Confirm Your Shortcode name which one you wanna create carousel.'
                ]
        );
        $this->add_control(
                'carousel_effect',
                $this->style,
                [
                    'label' => esc_html__('Carousel Effect', 'image-hover-effects-ultimate'),
                    'type' => Controls::SELECT,
                    'default' => 'slide',
                    'options' => [
                        'slide' => esc_html__('Slide', 'image-hover-effects-ultimate'),
                        'fade' => esc_html__('Fade', 'image-hover-effects-ultimate'),
                        'cube' => esc_html__('Cube', 'image-hover-effects-ultimate'),
                        'coverflow' => esc_html__('Coverflow', 'image-hover-effects-ultimate'),
                        'flip' => esc_html__('Flip', 'image-hover-effects-ultimate'),
                    ],
                    'description' => 'Select Carousel Type as Slide or Fade or Cube or Coverflow or Flip. Kindly save and reload page as Carousel works'
                ]
        );
        $this->add_responsive_control(
                'carousel_width',
                $this->style,
                [
                    'label' => esc_html__('Max Width', 'image-hover-effects-ultimate'),
                    'type' => Controls::SLIDER,
                    'default' => [
                        'unit' => 'px',
                        'size' => '500',
                    ],
                    'description' => 'Adjusting the width requires effective modification',
                    'condition' => [
                        'carousel_effect' => ['fade', 'cube', 'flip'],
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1400,
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
                            'step' => 1,
                        ],
                    ],
                    'selector' => [
                        '.oxi-addons-container{{WRAPPER}}' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
        );
        $this->add_responsive_control(
                'carousel_item',
                $this->style,
                [
                    'label' => esc_html__('Item Show', 'image-hover-effects-ultimate'),
                    'type' => Controls::SLIDER,
                    'default' => [
                        'unit' => 'px',
                        'size' => '3',
                    ],
                    'condition' => [
                        'carousel_effect' => ['slide', 'coverflow'],
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 10,
                            'step' => 1,
                        ],
                    ],
                    'description' => 'How many Image you want to View While carousel',
                ]
        );

        $this->add_control(
                'carousel_autoplay',
                $this->style,
                [
                    'label' => esc_html__('Autoplay', 'image-hover-effects-ultimate'),
                    'type' => Controls::SWITCHER,
                    'separator' => TRUE,
                    'loader' => TRUE,
                    'default' => 'yes',
                    'yes' => esc_html__('Yes', 'image-hover-effects-ultimate'),
                    'no' => esc_html__('No', 'image-hover-effects-ultimate'),
                    'return_value' => 'yes',
                    'description' => 'Carousel Autoplay Mode: True or False',
                ]
        );
        $this->add_control(
                'carousel_autoplay_speed',
                $this->style,
                [
                    'label' => esc_html__('Autoplay Speed', 'image-hover-effects-ultimate'),
                    'type' => Controls::NUMBER,
                    'default' => 2000,
                    'condition' => [
                        'carousel_autoplay' => 'yes',
                    ],
                    'description' => 'Carousel autoplay Time, Based on Millisecond',
                ]
        );
        $this->add_control(
                'carousel_speed',
                $this->style,
                [
                    'label' => esc_html__('Animation Speed', 'image-hover-effects-ultimate'),
                    'type' => Controls::NUMBER,
                    'default' => 500,
                    'description' => 'Carousel Animation Time, Based on Millisecond',
                ]
        );
        $this->add_control(
                'carousel_pause_on_hover',
                $this->style,
                [
                    'label' => esc_html__('Pause on Hover', 'image-hover-effects-ultimate'),
                    'type' => Controls::SWITCHER,
                    'loader' => TRUE,
                    'default' => 'yes',
                    'yes' => esc_html__('Yes', 'image-hover-effects-ultimate'),
                    'no' => esc_html__('No', 'image-hover-effects-ultimate'),
                    'return_value' => 'yes',
                    'description' => 'Carousel Pause on Hover : True or False',
                ]
        );
        $this->add_control(
                'carousel_infinite',
                $this->style,
                [
                    'label' => esc_html__('Infinite Loop', 'image-hover-effects-ultimate'),
                    'type' => Controls::SWITCHER,
                    'loader' => TRUE,
                    'default' => 'yes',
                    'yes' => esc_html__('Yes', 'image-hover-effects-ultimate'),
                    'no' => esc_html__('No', 'image-hover-effects-ultimate'),
                    'return_value' => 'yes',
                    'description' => 'Carousel Infinite Loop : True or False',
                ]
        );
        $this->add_control(
                'carousel_adaptive_height',
                $this->style,
                [
                    'label' => esc_html__('Adaptive Height', 'image-hover-effects-ultimate'),
                    'type' => Controls::SWITCHER,
                    'loader' => TRUE,
                    'default' => 'yes',
                    'yes' => esc_html__('Yes', 'image-hover-effects-ultimate'),
                    'no' => esc_html__('No', 'image-hover-effects-ultimate'),
                    'return_value' => 'yes',
                    'description' => 'Carousel Adaptive Height : True or False',
                ]
        );
        $this->add_control(
                'carousel_grab_cursor',
                $this->style,
                [
                    'label' => esc_html__('Grab Cursor', 'image-hover-effects-ultimate'),
                    'type' => Controls::SWITCHER,
                    'loader' => TRUE,
                    'default' => 'no',
                    'yes' => esc_html__('Yes', 'image-hover-effects-ultimate'),
                    'no' => esc_html__('No', 'image-hover-effects-ultimate'),
                    'return_value' => 'yes',
                    'description' => 'Carousel Grab Cursor : True or False',
                ]
        );
        $this->add_control(
                'carousel_direction',
                $this->style,
                [
                    'label' => esc_html__('Direction', 'image-hover-effects-ultimate'),
                    'type' => Controls::SELECT,
                    'default' => 'ltr',
                    'options' => [
                        'ltr' => esc_html__('Left', 'image-hover-effects-ultimate'),
                        'rtl' => esc_html__('Right', 'image-hover-effects-ultimate'),
                    ],
                    'description' => 'Carousel Direction : Left or Right',
                ]
        );
        $this->add_control(
                'carousel_show_arrows',
                $this->style,
                [
                    'label' => esc_html__('Arrows', 'image-hover-effects-ultimate'),
                    'type' => Controls::SWITCHER,
                    'loader' => TRUE,
                    'default' => 'yes',
                    'yes' => esc_html__('Yes', 'image-hover-effects-ultimate'),
                    'no' => esc_html__('No', 'image-hover-effects-ultimate'),
                    'return_value' => 'yes',
                    'description' => 'Carousel Arrows Options : True or False',
                ]
        );
        $this->add_control(
                'carousel_show_dots',
                $this->style,
                [
                    'label' => esc_html__('Dots', 'image-hover-effects-ultimate'),
                    'type' => Controls::SWITCHER,
                    'loader' => TRUE,
                    'default' => 'no',
                    'yes' => esc_html__('Yes', 'image-hover-effects-ultimate'),
                    'no' => esc_html__('No', 'image-hover-effects-ultimate'),
                    'return_value' => 'yes',
                    'description' => 'Carousel Dots Options : True or False',
                ]
        );

        $this->end_controls_section();
    }

    public function register_carousel_dots_settings() {
        $this->start_controls_section(
                'shortcode-addons',
                [
                    'label' => esc_html__('Carousel Dots', 'image-hover-effects-ultimate'),
                    'showing' => FALSE,
                    'condition' => [
                        'carousel_show_dots' => 'yes',
                    ],
                ]
        );

        $this->add_responsive_control(
                'carousel_dots_width_height',
                $this->style,
                [
                    'label' => esc_html__('Width & Height', 'image-hover-effects-ultimate'),
                    'type' => Controls::SLIDER,
                    'default' => [
                        'unit' => 'px',
                        'size' => '12',
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 50,
                            'step' => 1,
                        ],
                        'em' => [
                            'min' => 0,
                            'max' => 10,
                            'step' => 1,
                        ],
                    ],
                    'selector' => [
                        '{{WRAPPER}} .oxi_carousel_dots .swiper-pagination-bullet' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    ],
                    'description' => 'Carousel Dots Width & Height with multiple Options',
                ]
        );
        $this->add_responsive_control(
                'carousel_dots_position_Y',
                $this->style,
                [
                    'label' => esc_html__('Position Y', 'image-hover-effects-ultimate'),
                    'type' => Controls::SLIDER,
                    'default' => [
                        'unit' => '%',
                        'size' => '25',
                    ],
                    'range' => [
                        'px' => [
                            'min' => -900,
                            'max' => 900,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => -100,
                            'max' => 100,
                            'step' => 1,
                        ],
                        'em' => [
                            'min' => -100,
                            'max' => 100,
                            'step' => 1,
                        ],
                    ],
                    'selector' => [
                        '{{WRAPPER}} .oxi_carousel_dots' => 'bottom: {{SIZE}}{{UNIT}} !important;',
                    ],
                    'description' => 'Carousel Dots Position Y with multiple Options',
                ]
        );
        $this->add_responsive_control(
                'carousel_dots_spacing',
                $this->style,
                [
                    'label' => esc_html__('Spacing', 'image-hover-effects-ultimate'),
                    'type' => Controls::SLIDER,
                    'default' => [
                        'unit' => 'px',
                        'size' => '3',
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 30,
                            'step' => 1,
                        ],
                        'em' => [
                            'min' => 0,
                            'max' => 5,
                            'step' => 1,
                        ],
                    ],
                    'selector' => [
                        '{{WRAPPER}} .oxi_carousel_dots .swiper-pagination-bullet' => 'margin: {{SIZE}}{{UNIT}};',
                    ],
                    'description' => 'Carousel Dots Spacing with multiple Options',
                ]
        );
        $this->start_controls_tabs(
                'shortcode-addons-start-tabs',
                [
                    'options' => [
                        'normal' => esc_html__('Normal', 'image-hover-effects-ultimate'),
                        'hover' => esc_html__('Hover', 'image-hover-effects-ultimate'),
                        'active' => esc_html__('Active', 'image-hover-effects-ultimate'),
                    ]
                ]
        );
        $this->start_controls_tab();
        ;
        $this->add_control(
                'carousel_dots_bg_color',
                $this->style,
                [
                    'label' => esc_html__('Color', 'image-hover-effects-ultimate'),
                    'type' => Controls::COLOR,
                    'default' => 'rgb(0, 0, 0)',
                    'oparetor' => 'RGB',
                    'selector' => [
                        '{{WRAPPER}} .oxi_carousel_dots .swiper-pagination-bullet' => 'background: {{VALUE}};',
                    ],
                    'description' => 'Customize Carousel Dots Color ',
                ]
        );
        $this->add_group_control(
                'carousel_dots_border',
                $this->style,
                [
                    'type' => Controls::BORDER,
                    'selector' => [
                        '{{WRAPPER}} .oxi_carousel_dots .swiper-pagination-bullet' => '',
                    ],
                    'description' => 'Carousel Dots Border with multiple Options',
                ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab();
        $this->add_control(
                'carousel_dots_bg_color_hover',
                $this->style,
                [
                    'label' => esc_html__('Background', 'image-hover-effects-ultimate'),
                    'type' => Controls::COLOR,
                    'default' => 'rgb(119, 119, 119)',
                    'oparetor' => 'RGB',
                    'selector' => [
                        '{{WRAPPER}} .oxi_carousel_dots .swiper-pagination-bullet:hover' => 'background: {{VALUE}};',
                    ],
                    'description' => 'Customize Carousel Dots Color ',
                ]
        );
        $this->add_group_control(
                'carousel_dots_border_hover',
                $this->style,
                [
                    'type' => Controls::BORDER,
                    'selector' => [
                        '{{WRAPPER}} .oxi_carousel_dots .swiper-pagination-bullet:hover' => '',
                    ],
                    'description' => 'Carousel Dots Border with multiple Options',
                ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab();
        $this->add_control(
                'carousel_dots_bg_color_active',
                $this->style,
                [
                    'label' => esc_html__('Color', 'image-hover-effects-ultimate'),
                    'type' => Controls::COLOR,
                    'default' => '#AB00C9',
                    'oparetor' => 'RGB',
                    'selector' => [
                        '{{WRAPPER}} .oxi_carousel_dots .swiper-pagination-bullet-active' => 'background: {{VALUE}};',
                    ],
                    'description' => 'Customize Carousel Dots Color ',
                ]
        );
        $this->add_group_control(
                'carousel_dots_border_active',
                $this->style,
                [
                    'type' => Controls::BORDER,
                    'selector' => [
                        '{{WRAPPER}} .oxi_carousel_dots .swiper-pagination-bullet-active' => '',
                    ],
                    'description' => 'Carousel Dots Border with multiple Options',
                ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_responsive_control(
                'carousel_dots_border_radius_normal',
                $this->style,
                [
                    'label' => esc_html__('Border Radius', 'image-hover-effects-ultimate'),
                    'type' => Controls::DIMENSIONS,
                    'separator' => TRUE,
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
                        '{{WRAPPER}} .oxi_carousel_dots .swiper-pagination-bullet' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'description' => 'Carousel Dots Border Radius with multiple Options',
                ]
        );
        $this->end_controls_section();
    }

}
