<?php

namespace OXI_IMAGE_HOVER_PLUGINS\Modules\Flipbox\Admin;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Description of Effects1
 *
 * @author biplo
 */
use OXI_IMAGE_HOVER_PLUGINS\Modules\Flipbox\Modules as Modules;
use OXI_IMAGE_HOVER_PLUGINS\Classes\Controls as Controls;

class Effects12 extends Modules {

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

    public function register_back_icon_settings() {
        $this->start_controls_section(
                'oxi-image-hover', [
            'label' => esc_html__('Icon Settings', 'image-hover-effects-ultimate'),
            'showing' => FALSE,
                ]
        );
        $this->add_control(
                'oxi-image-flip-back-icon-underline', $this->style, [
            'label' => esc_html__('Icon Underline', 'image-hover-effects-ultimate'),
            'type' => Controls::CHOOSE,
            'operator' => Controls::OPERATOR_TEXT,
            'default' => '',
            'options' => [
                'oxi-image-hover-icon-underline' => [
                    'title' => esc_html__('Show', 'image-hover-effects-ultimate'),
                ],
                '' => [
                    'title' => esc_html__('Hide', 'image-hover-effects-ultimate'),
                ],
            ],
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover-figure-backend .oxi-image-hover-icon' => '',
            ],
            'description' => 'Allows you to set Icon Underline.',
                ]
        );
        $this->add_control(
                'oxi-image-flip-back-icon-position', $this->style, [
            'label' => esc_html__('Position', 'image-hover-effects-ultimate'),
            'type' => Controls::CHOOSE,
            'operator' => Controls::OPERATOR_ICON,
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
        $this->start_controls_section(
                'oxi-image-flip-back-icon-underline', [
            'label' => esc_html__('Icon Underline', 'image-hover-effects-ultimate'),
            'showing' => false,
            'condition' => [
                'oxi-image-flip-back-icon-underline' => 'oxi-image-hover-icon-underline'
            ]
                ]
        );
        $this->add_control(
                'oxi-image-flip-back-icon-underline-position',
                $this->style,
                [
                    'label' => esc_html__('Position', 'image-hover-effects-ultimate'),
                    'type' => Controls::CHOOSE,
                    'operator' => Controls::OPERATOR_ICON,
                    'toggle' => true,
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
                        '{{WRAPPER}} .oxi-image-hover-figure-backend .oxi-image-hover-icon.oxi-image-hover-icon-underline:before' => '{{VALUE}}',
                    ],
                    'description' => 'Allows you to set Icon Underline Position.',
                ]
        );

        $this->add_control(
                'oxi-image-flip-back-icon-underline-color', $this->style, [
            'label' => esc_html__('Color', 'image-hover-effects-ultimate'),
            'type' => Controls::COLOR,
            'default' => '#ffffff',
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover-figure-backend .oxi-image-hover-icon.oxi-image-hover-icon-underline:before' => 'border-bottom-color: {{VALUE}};',
            ],
            'description' => 'Allows you to set Icon Underline Color.',
                ]
        );
        $this->add_control(
                'oxi-image-flip-back-icon-underline-type', $this->style, [
            'label' => esc_html__('Underline Type', 'image-hover-effects-ultimate'),
            'type' => Controls::SELECT,
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
                '{{WRAPPER}} .oxi-image-hover-figure-backend .oxi-image-hover-icon.oxi-image-hover-icon-underline:before' => 'border-bottom-style: {{VALUE}};',
            ],
            'description' => 'Allows you to set Icon Underline Type.',
                ]
        );
        $this->add_responsive_control(
                'oxi-image-flip-back-icon-underline-width', $this->style, [
            'label' => esc_html__('Width', 'image-hover-effects-ultimate'),
            'type' => Controls::SLIDER,
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
                '{{WRAPPER}} .oxi-image-hover-figure-backend .oxi-image-hover-icon.oxi-image-hover-icon-underline:before' => 'width:{{SIZE}}{{UNIT}};',
            ],
            'description' => 'Allows you to set Icon Underline Width.',
                ]
        );
        $this->add_responsive_control(
                'oxi-image-flip-back-icon-underline-height', $this->style, [
            'label' => esc_html__('Size', 'image-hover-effects-ultimate'),
            'type' => Controls::SLIDER,
            'default' => [
                'unit' => 'px',
                'size' => 2,
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
                '{{WRAPPER}} .oxi-image-hover-figure-backend .oxi-image-hover-icon.oxi-image-hover-icon-underline:before' => 'border-bottom-width: {{SIZE}}{{UNIT}};',
            ],
            'description' => 'Allows you to set Icon Underline Height.',
                ]
        );

        $this->add_responsive_control(
                'oxi-image-flip-back-icon-underline-distance', $this->style, [
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
                '{{WRAPPER}} .oxi-image-hover-figure-backend .oxi-image-hover-icon.oxi-image-hover-icon-underline' => 'margin-bottom:{{SIZE}}{{UNIT}};',
            ],
            'description' => 'Allows you to set Icon Underline Distance.',
                ]
        );
        $this->end_controls_section();
    }

    public function modal_form_data() {
        ?>
        <div class="modal-header">
            <h4 class="modal-title">Image Hover Form</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <?php
            $this->add_control(
                    'image_hover_front_heading', $this->style, [
                'label' => esc_html__('Front Title', 'image-hover-effects-ultimate'),
                'type' => Controls::TEXT,
                'default' => 'Border Flipbox',
                'placeholder' => '',
                'description' => 'Add Your Flipbox Front Title.'
                    ]
            );
            $this->add_control(
                    'image_hover_back_heading', $this->style, [
                'label' => esc_html__('Backend Title', 'image-hover-effects-ultimate'),
                'type' => Controls::TEXT,
                'default' => 'Border Flipbox',
                'placeholder' => 'Heading',
                'description' => 'Add Your Flipbox Backend Title.'
                    ]
            );
            $this->add_control(
                    'image_hover_front_icon', $this->style, [
                'label' => esc_html__('Front Icon', 'image-hover-effects-ultimate'),
                'type' => Controls::ICON,
                'description' => 'Add Your Flipbox Front Icon.'
                    ]
            );
            $this->add_control(
                    'image_hover_back_icon', $this->style, [
                'label' => esc_html__('Backend Icon', 'image-hover-effects-ultimate'),
                'type' => Controls::ICON,
                'description' => 'Add Your Flipbox Backend Icon.'
                    ]
            );
            $this->add_control(
                    'image_hover_back_description', $this->style, [
                'label' => esc_html__('Backend Description', 'image-hover-effects-ultimate'),
                'type' => Controls::TEXTAREA,
                'description' => 'Add Your Backend Description Unless make it blank.'
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
                    'image_hover_front_image', $this->style, [
                'label' => esc_html__('Image', 'image-hover-effects-ultimate'),
                'type' => Controls::MEDIA,
                'description' => 'Add or Modify Your Front Image. Adjust Front background to get better design.'
                    ]
            );

            $this->end_controls_tab();

            $this->start_controls_tab();
            $this->add_group_control(
                    'image_hover_back_image', $this->style, [
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
