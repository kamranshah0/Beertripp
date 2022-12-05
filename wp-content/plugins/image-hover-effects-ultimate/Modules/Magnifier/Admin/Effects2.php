<?php

namespace OXI_IMAGE_HOVER_PLUGINS\Modules\Magnifier\Admin;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Description of Effects1
 *
 * @author biplob
 */
use OXI_IMAGE_HOVER_PLUGINS\Modules\Magnifier\Modules as Modules;
use OXI_IMAGE_HOVER_PLUGINS\Classes\Controls as Controls;

class Effects2 extends Modules {

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
     * Start Module Method for Magnifi Setting #Light-box
     */

    public function register_magnifi_settings() {
        $this->start_controls_section(
                'shortcode-addons', [
            'label' => esc_html__('Magnifier Settings', 'image-hover-effects-ultimate'),
            'showing' => false,
                ]
        );

        $this->add_control(
                'oxi_image_magnifier_magnifi_offset_switcher',
                $this->style,
                [
                    'label' => esc_html__('Offset', 'image-hover-effects-ultimate'),
                    'type' => Controls::SWITCHER,
                    'default' => 'no',
                    'loader' => true,
                    'label_on' => esc_html__('Yes', 'image-hover-effects-ultimate'),
                    'label_off' => esc_html__('No', 'image-hover-effects-ultimate'),
                    'return_value' => 'yes',
                    'description' => 'Allows you to Offset Issues for Offset X and Offset Y.',
                ]
        );
        $this->add_control(
                'oxi_image_magnifier_offset_x',
                $this->style,
                [
                    'label' => esc_html__('Offset X', 'image-hover-effects-ultimate'),
                    'type' => Controls::SLIDER,
                    'condition' => [
                        'oxi_image_magnifier_magnifi_offset_switcher' => 'yes',
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => '',
                    ],
                    'range' => [
                        'px' => [
                            'min' => -500,
                            'max' => 500,
                            'step' => 10,
                        ],
                    ],
                    'description' => 'Allows you to set Offset X.',
                ]
        );
        $this->add_control(
                'oxi_image_magnifier_offset_y',
                $this->style,
                [
                    'label' => esc_html__('Offset Y', 'image-hover-effects-ultimate'),
                    'type' => Controls::SLIDER,
                    'default' => [
                        'unit' => 'px',
                        'size' => '',
                    ],
                    'range' => [
                        'px' => [
                            'min' => -500,
                            'max' => 500,
                            'step' => 1,
                        ],
                    ],
                    'condition' => [
                        'oxi_image_magnifier_magnifi_offset_switcher' => 'yes',
                    ],
                    'description' => 'Allows you to set Offset Y.',
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
                    'description' => 'Wanna Set Magnifier Custom Height or Width.',
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
                    'description' => 'Set Magnifier Width as like as you want.',
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
                    'description' => 'Set Magnifier Height as like as you want.',
                ]
        );
        $this->add_responsive_control(
                'oxi_image_magnifier_magnifi_radius',
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
                        '{{WRAPPER}} .oxi_addons_magnifier_previewholder_stylesd_Sad, #zoomple_previewholder.oxi_addons_magnifier_previewholder_style_2' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                        '{{WRAPPER}} .oxi_addons_magnifier_previewholder_stylesd_Sad, #zoomple_previewholder.oxi_addons_magnifier_previewholder_style_2 .overlay' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                        '{{WRAPPER}} .oxi_addons_magnifier_previewholder_stylesd_Sad, #zoomple_previewholder.oxi_addons_magnifier_previewholder_style_2  .image_wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                    ],
                    'description' => 'Allows you to add rounded corners to Magnifier with options.',
                ]
        );
        $this->add_group_control(
                'oxi_image_magnifier_magnifi_box_shadow',
                $this->style,
                [
                    'label' => esc_html__('Box Shadow', 'image-hover-effects-ultimate'),
                    'type' => Controls::BOXSHADOW,
                    'selector' => [
                        '.oxi_____disabled,  .oxi_addons_magnifier_' . $this->oxiid . ' .image_wrap' => '',
                    ],
                    'description' => 'Allows you at hover to attaches one or more shadows into Magnifier Popup.',
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
            $this->add_group_control(
                    'oxi_image_magnifier_img', $this->style, [
                'label' => esc_html__('Media Type', 'image-hover-effects-ultimate'),
                'type' => Controls::MEDIA,
                'default' => [
                    'type' => 'media-library',
                    'link' => '',
                ],
                    ]
            );
            ?></div><?php
        }

    }
    