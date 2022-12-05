<?php

namespace OXI_IMAGE_HOVER_PLUGINS\Modules\Magnifier;

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
            ]
                ]
        );
        $this->register_general_tabs();
        $this->register_custom_tabs();
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

        $this->end_section_devider();
        $this->start_section_devider();
        $this->register_image_settings();
        $this->register_magnifi_settings();

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
        $this->add_group_control(
                'oxi-image-hover-col', $this->style, [
            'type' => Controls::COLUMN,
            'selector' => [
                '{{WRAPPER}} .oxi_addons__image_magnifier_column' => '',
            ],
                ]
        );

        $this->add_group_control(
                'oxi_image_magnifier_button_border',
                $this->style,
                [
                    'type' => Controls::BORDER,
                    'selector' => [
                        '{{WRAPPER}} .oxi_addons__image_magnifier' => '',
                    ],
                    'description' => 'Border property is used to set the Border of the Magnifier Body.',
                ]
        );
        $this->add_responsive_control(
                'oxi_image_magnifier_radius',
                $this->style,
                [
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
                            'min' => -100,
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
                        '{{WRAPPER}} .oxi_addons__image_magnifier' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .oxi_addons__image_magnifier .oxi_addons__image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .oxi_addons__image_magnifier .zoomableInPlace' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .oxi_addons__image_magnifier .zoomable' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'description' => 'Allows you to add rounded corners to Magnifier with options.',
                ]
        );
        $this->add_group_control(
                'oxi_image_magnifier_shadow',
                $this->style,
                [
                    'label' => esc_html__('Box Shadow', 'image-hover-effects-ultimate'),
                    'type' => Controls::BOXSHADOW,
                    'selector' => [
                        '{{WRAPPER}} .oxi_addons__image_magnifier' => '',
                    ],
                    'description' => 'Allows you at hover to attaches one or more shadows into Magnifier Body.',
                ]
        );
        $this->add_responsive_control(
                'oxi_image_magnifier_margin',
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
                        '{{WRAPPER}} .oxi_addons__image_magnifier_column' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'description' => 'Generate space outside of Magnifier Body.',
                ]
        );
        $this->end_controls_section();
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
                    'default' => '0 auto',
                    'operator' => Controls::OPERATOR_ICON,
                    'options' => [
                        '0 0 0 auto' => [
                            'title' => esc_html__('Left', 'image-hover-effects-ultimate'),
                            'icon' => 'fa fa-align-left',
                        ],
                        '0 auto' => [
                            'title' => esc_html__('Center', 'image-hover-effects-ultimate'),
                            'icon' => 'fa fa-align-center',
                        ],
                        '0 auto 0 0' => [
                            'title' => esc_html__('Right', 'image-hover-effects-ultimate'),
                            'icon' => 'fa fa-align-right',
                        ],
                    ],
                    'selector' => [
                        '{{WRAPPER}} .oxi_addons__image_magnifier_style_body ' => 'margin: {{VALUE}};',
                    ],
                    'description' => 'Set Image Positions IF you wanna set Custom Positions else default center value will works.',
                ]
        );

        $this->add_control(
                'oxi_image_magnifier_image_switcher',
                $this->style,
                [
                    'label' => esc_html__('Custom Width Height', 'image-hover-effects-ultimate'),
                    'type' => Controls::SWITCHER,
                    'default' => 'no',
                    'loader' => true,
                    'label_on' => esc_html__('Yes', 'image-hover-effects-ultimate'),
                    'label_off' => esc_html__('No', 'image-hover-effects-ultimate'),
                    'return_value' => 'oxi__image_height_width',
                    'description' => 'Wanna Set Image Custom Height or Width.',
                ]
        );
        $this->add_responsive_control(
                'oxi_image_magnifier_image_width',
                $this->style,
                [
                    'label' => esc_html__('Width', 'image-hover-effects-ultimate'),
                    'type' => Controls::SLIDER,
                    'condition' => [
                        'oxi_image_magnifier_image_switcher' => 'oxi__image_height_width',
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => '',
                    ],
                    'range' => [
                        '%' => [
                            'min' => 50,
                            'max' => 100,
                            'step' => 1,
                        ],
                        'px' => [
                            'min' => 100,
                            'max' => 1500,
                            'step' => 10,
                        ],
                    ],
                    'selector' => [
                        '{{WRAPPER}} .oxi_addons__image_magnifier_style_body' => 'max-width: {{SIZE}}{{UNIT}};',
                    ],
                    'description' => 'Set Image Width as like as you want with multiple options.',
                ]
        );
        $this->add_responsive_control(
                'oxi_image_magnifier_height',
                $this->style,
                [
                    'label' => esc_html__('Height', 'image-hover-effects-ultimate'),
                    'type' => Controls::SLIDER,
                    'default' => [
                        'unit' => 'px',
                        'size' => '',
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1200,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 1,
                            'max' => 100,
                            'step' => 1,
                        ],
                    ],
                    'selector' => [
                        '{{WRAPPER}} .oxi_addons__image_magnifier_style_body.oxi__image_height_width:after' => 'padding-bottom: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'oxi_image_magnifier_image_switcher' => 'oxi__image_height_width',
                    ],
                    'description' => 'Set Image Height as like as you want with multiple options.',
                ]
        );
        $this->add_control(
                'oxi_image_magnifier_grayscale_switter',
                $this->style,
                [
                    'label' => esc_html__('Grayscale', 'image-hover-effects-ultimate'),
                    'type' => Controls::SWITCHER,
                    'default' => 'no',
                    'loader' => true,
                    'label_on' => esc_html__('Yes', 'image-hover-effects-ultimate'),
                    'label_off' => esc_html__('No', 'image-hover-effects-ultimate'),
                    'return_value' => 'oxi_addons_grayscale',
                    'description' => 'Set Grayscale Property if you wanna Grayscale like black & white or Colorful.',
                ]
        );
        $this->add_responsive_control(
                'oxi_image_magnifier_opacity',
                $this->style,
                [
                    'label' => esc_html__('Opacity', 'image-hover-effects-ultimate'),
                    'type' => Controls::SLIDER,
                    'default' => [
                        'unit' => 'px',
                        'size' => '',
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1,
                            'step' => 0.1,
                        ],
                    ],
                    'description' => 'Set Opacity Property if you wanna set Opacity of your Image Or Not.',
                    'selector' => [
                        '{{WRAPPER}} .oxi_addons__image_magnifier .oxi_addons__image' => 'opacity: {{SIZE}};',
                    ],
                ]
        );

        $this->end_controls_section();
    }

    /*
     * @return void
     * Start Module Method for Magnifi Setting #Light-box
     */

    public function register_magnifi_settings() {
        $this->start_controls_section(
                'shortcode-addons', [
            'label' => esc_html__('Magnifi Settings', 'image-hover-effects-ultimate'),
            'showing' => false,
                ]
        );
        $this->add_control(
                'oxi_image_magnifier_magnifi_zoom',
                $this->style,
                [
                    'label' => esc_html__('Zoom', 'image-hover-effects-ultimate'),
                    'type' => Controls::SLIDER,
                    'default' => [
                        'unit' => 'px',
                        'size' => 2,
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 10,
                            'step' => 1,
                        ],
                    ],
                    'description' => 'How much Zoom you wnat to add while Hover Image.',
                ]
        );

        $this->add_control(
                'oxi_image_magnifier_magnifi_switcher',
                $this->style,
                [
                    'label' => esc_html__('Magnifi Width Height', 'image-hover-effects-ultimate'),
                    'type' => Controls::SWITCHER,
                    'default' => 'no',
                    'loader' => true,
                    'label_on' => esc_html__('Yes', 'image-hover-effects-ultimate'),
                    'label_off' => esc_html__('No', 'image-hover-effects-ultimate'),
                    'return_value' => 'yes',
                    'description' => 'Wanna Custom Height or Width Hover Magnifier?',
                ]
        );

        $this->add_control(
                'oxi_image_magnifier_magnifi_width',
                $this->style,
                [
                    'label' => esc_html__('Width', 'image-hover-effects-ultimate'),
                    'type' => Controls::SLIDER,
                    'condition' => [
                        'oxi_image_magnifier_magnifi_switcher' => 'yes',
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => '',
                    ],
                    'range' => [
                        'px' => [
                            'min' => 100,
                            'max' => 1500,
                            'step' => 10,
                        ],
                    ],
                    'description' => 'Set Custom Width For Magnifier?',
                ]
        );
        $this->add_control(
                'oxi_image_magnifier_magnifi_height',
                $this->style,
                [
                    'label' => esc_html__('Height', 'image-hover-effects-ultimate'),
                    'type' => Controls::SLIDER,
                    'default' => [
                        'unit' => 'px',
                        'size' => '',
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1200,
                            'step' => 1,
                        ],
                    ],
                    'condition' => [
                        'oxi_image_magnifier_magnifi_switcher' => 'yes',
                    ],
                    'description' => 'Set Custom Height For Magnifier?',
                ]
        );

        $this->end_controls_section();
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

    /*
     * @return void
     * Start Module Method for Modal Opener and Modal  #Light-box
     */

    public function modal_opener() {
        $this->add_substitute_control('', [], [
            'type' => Controls::MODALOPENER,
            'title' => esc_html__('Add New Magnifier', 'image-hover-effects-ultimate'),
            'sub-title' => esc_html__('Open Magnifier Form', 'image-hover-effects-ultimate'),
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
            $this->add_group_control(
                    'oxi_image_magnifier_img', $this->style, [
                'label' => esc_html__('Media Type', 'image-hover-effects-ultimate'),
                'type' => Controls::MEDIA,
                'default' => [
                    'type' => 'media-library',
                    'link' => 'https://www.shortcode-addons.com/wp-content/uploads/2020/01/placeholder.png',
                ],
                    ]
            );

            $this->add_control(
                    'oxi_image_magnifier_magnifi_position', $this->style, [
                'label' => esc_html__('Magnifi Position', 'image-hover-effects-ultimate'),
                'type' => Controls::SELECT,
                'default' => 'right',
                'loader' => true,
                'options' => [
                    'none' => esc_html__('Default', 'image-hover-effects-ultimate'),
                    'top' => esc_html__('Top', 'image-hover-effects-ultimate'),
                    'right' => esc_html__('Right', 'image-hover-effects-ultimate'),
                    'bottom' => esc_html__('Bottom', 'image-hover-effects-ultimate'),
                    'left' => esc_html__('Left', 'image-hover-effects-ultimate'),
                ],
                    ]
            );
            $this->add_control(
                    'oxi_image_magnifier_magnifi_position_top', $this->style, [
                'label' => esc_html__('Top Position', 'image-hover-effects-ultimate'),
                'description' => 'After save You will show the changes',
                'type' => Controls::SLIDER,
                'condition' => [
                    'oxi_image_magnifier_magnifi_position' => 'top',
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => '',
                ],
                'range' => [
                    'px' => [
                        'min' => -500,
                        'max' => 500,
                        'step' => 2,
                    ],
                ],
                    ]
            );
            $this->add_control(
                    'oxi_image_magnifier_magnifi_position_right', $this->style, [
                'label' => esc_html__('Right Position', 'image-hover-effects-ultimate'),
                'type' => Controls::SLIDER,
                'description' => 'After save You will show the changes',
                'condition' => [
                    'oxi_image_magnifier_magnifi_position' => 'right',
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => '',
                ],
                'range' => [
                    'px' => [
                        'min' => -500,
                        'max' => 500,
                        'step' => 2,
                    ],
                ],
                    ]
            );
            $this->add_control(
                    'oxi_image_magnifier_magnifi_position_bottom', $this->style, [
                'label' => esc_html__('Bottom Position', 'image-hover-effects-ultimate'),
                'type' => Controls::SLIDER,
                'description' => '   save You will show the changes',
                'condition' => [
                    'oxi_image_magnifier_magnifi_position' => 'bottom',
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => '',
                ],
                'range' => [
                    'px' => [
                        'min' => -500,
                        'max' => 500,
                        'step' => 2,
                    ],
                ],
                    ]
            );
            $this->add_control(
                    'oxi_image_magnifier_magnifi_position_left', $this->style, [
                'label' => esc_html__('Left Position', 'image-hover-effects-ultimate'),
                'type' => Controls::SLIDER,
                'condition' => [
                    'oxi_image_magnifier_magnifi_position' => 'left',
                ],
                'description' => 'After save You will show the changes',
                'default' => [
                    'unit' => 'px',
                    'size' => '',
                ],
                'range' => [
                    'px' => [
                        'min' => -500,
                        'max' => 500,
                        'step' => 2,
                    ],
                ],
                    ]
            );
            ?>
        </div>
        <?php
    }

}
