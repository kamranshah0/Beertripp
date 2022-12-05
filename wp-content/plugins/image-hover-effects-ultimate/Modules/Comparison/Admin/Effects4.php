<?php

namespace OXI_IMAGE_HOVER_PLUGINS\Modules\Comparison\Admin;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Description of Effects1
 *
 * @author biplob
 */
use OXI_IMAGE_HOVER_PLUGINS\Classes\Controls as Controls;
use OXI_IMAGE_HOVER_PLUGINS\Modules\Comparison\Modules as Modules;

class Effects4 extends Modules {

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
        $this->end_section_devider();
        $this->start_section_devider();
        $this->register_image_settings();
        $this->end_section_devider();
        $this->end_section_tabs();
    }

    /*
     * @return void
     * Start Module Method for Image Setting #Light-box
     */

    public function register_image_settings() {
        $this->start_controls_section(
                'shortcode-addons', [
            'label' => esc_html__('Image Settings', 'image-hover-effects-ultimate'),
            'showing' => true,
                ]
        );
        $this->add_responsive_control(
                'oxi_image_magnifier_image_position',
                $this->style,
                [
                    'label' => esc_html__('Image Postion', 'image-hover-effects-ultimate'),
                    'type' => Controls::CHOOSE,
                    'default' => 'center',
                    'operator' => Controls::OPERATOR_ICON,
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
                        '{{WRAPPER}}  .oxi-addons-main-wrapper-image-comparison' => 'justify-content: {{VALUE}};',
                    ],
                    'description' => 'Set Image Positions if you wanna set Custom Positions else default center value will works.',
                ]
        );

        $this->add_control(
                'oxi_image_magnifier_image_switcher',
                $this->style,
                [
                    'label' => esc_html__('Custom Width', 'image-hover-effects-ultimate'),
                    'type' => Controls::SWITCHER,
                    'default' => 'no',
                    'loader' => true,
                    'label_on' => esc_html__('Yes', 'image-hover-effects-ultimate'),
                    'label_off' => esc_html__('No', 'image-hover-effects-ultimate'),
                    'return_value' => 'oxi__image_width',
                    'description' => 'Wanna Set Image Custom  Width.',
                ]
        );
        $this->add_responsive_control(
                'oxi_image_magnifier_image_width',
                $this->style,
                [
                    'label' => esc_html__('Width', 'image-hover-effects-ultimate'),
                    'type' => Controls::SLIDER,
                    'condition' => [
                        'oxi_image_magnifier_image_switcher' => 'oxi__image_width',
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => '',
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1500,
                            'step' => 10,
                        ],
                        '%' => [
                            'min' => 10,
                            'max' => 100,
                            'step' => 1,
                        ],
                    ],
                    'selector' => [
                        '{{WRAPPER}} .oxi-addons-main-wrapper-image-comparison .oxi-addons-main.oxi__image_width' => 'width: {{SIZE}}{{UNIT}} !important;',
                    ],
                    'description' => 'Set Image Width as like as you want with multiple options.',
                ]
        );
        $this->add_responsive_control(
                'oxi_image_magnifier_image_height',
                $this->style,
                [
                    'label' => esc_html__('Height', 'image-hover-effects-ultimate'),
                    'type' => Controls::SLIDER,
                    'condition' => [
                        'oxi_image_magnifier_image_switcher' => 'oxi__image_width',
                    ],
                    'default' => [
                        'unit' => '%',
                        'size' => '',
                    ],
                    'range' => [
                        'px' => [
                            'min' => 10,
                            'max' => 1500,
                            'step' => 10,
                        ],
                        '%' => [
                            'min' => 10,
                            'max' => 150,
                            'step' => 1,
                        ],
                    ],
                    'selector' => [
                        '{{WRAPPER}} .oxi-addons-main-wrapper-image-comparison .oxi-addons-main.oxi__image_width::after' => 'padding-bottom: {{SIZE}}{{UNIT}} !important;',
                    ],
                    'description' => 'Set Image Height as like as you want with multiple options.',
                ]
        );
        $this->add_control(
                'oxi_image_comparison_hover_width', $this->style, [
            'label' => esc_html__('Hover Devider', 'image-hover-effects-ultimate'),
            'type' => Controls::SLIDER,
            'separator' => true,
            'default' => [
                'unit' => '%',
                'size' => 5,
            ],
            'range' => [
                '%' => [
                    'min' => 2,
                    'max' => 100,
                    'step' => 1,
                ],
            ],
            'description' => 'Set Image Hover Width as How many Devider to show into sinlge image .',
                ]
        );
        $this->add_control(
                'oxi_image_comparison_hover_transition', $this->style, [
            'label' => esc_html__('Hover Transition', 'image-hover-effects-ultimate'),
            'type' => Controls::SLIDER,
            'default' => [
                'unit' => 'px',
                'size' => 1.5,
            ],
            'range' => [
                'px' => [
                    'min' => 0.0,
                    'max' => 5,
                    'step' => 0.01,
                ],
            ],
            'selector' => [
                '{{WRAPPER}} .oxi_addons_image_style_4_box .oxi_addons_font_view_img' => 'transition:all {{SIZE}}s ease-in-out;',
            ],
            'description' => 'Set Image Hover Transition as like as you want with Second options.',
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
            $this->start_controls_tabs(
                    'shortcode-addons-start-tabs', [
                'options' => [
                    'before' => esc_html__('Before Image', 'image-hover-effects-ultimate'),
                    'after' => esc_html__('After Image', 'image-hover-effects-ultimate'),
                ],
                    ]
            );
            $this->start_controls_tab();
            $this->add_group_control(
                    'oxi_image_comparison_image_one',
                    $this->style,
                    [
                        'label' => esc_html__('URL', 'image-hover-effects-ultimate'),
                        'type' => Controls::MEDIA,
                        'default' => [
                            'type' => 'media-library',
                            'link' => 'https://www.oxilabdemos.com/image-hover/wp-content/uploads/2020/01/placeholder.png',
                        ],
                        'description' => 'Update Your Before Image of Comparison Box.',
                    ]
            );
            $this->end_controls_tab();
            $this->start_controls_tab();
            $this->add_group_control(
                    'oxi_image_comparison_image_two',
                    $this->style,
                    [
                        'label' => esc_html__('URL', 'image-hover-effects-ultimate'),
                        'type' => Controls::MEDIA,
                        'default' => [
                            'type' => 'media-library',
                            'link' => 'https://www.oxilabdemos.com/image-hover/wp-content/uploads/2020/01/placeholder.png',
                        ],
                        'description' => 'Update Your After Image of Comparison Box.',
                    ]
            );
            $this->end_controls_tab();
            $this->end_controls_tabs();
            ?>
        </div>
            <?php
        }

    }
    