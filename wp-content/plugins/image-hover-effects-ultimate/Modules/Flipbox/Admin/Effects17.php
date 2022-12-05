<?php

namespace OXI_IMAGE_HOVER_PLUGINS\Modules\Flipbox\Admin;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Description of Effects17
 *
 * @author biplo
 */
use OXI_IMAGE_HOVER_PLUGINS\Modules\Flipbox\Modules as Modules;
use OXI_IMAGE_HOVER_PLUGINS\Classes\Controls as Controls;

class Effects17 extends Modules {

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
        $this->end_section_devider();
        $this->end_section_tabs();
    }

    public function register_front_heading_settings() {
        $this->start_controls_section(
                'oxi-image-hover', [
            'label' => esc_html__('Heading Settings', 'image-hover-effects-ultimate'),
            'showing' => TRUE,
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
        $this->add_control(
                'oxi-image-flip-front-heading-background-color', $this->style, [
            'label' => esc_html__('Background', 'image-hover-effects-ultimate'),
            'type' => Controls::GRADIENT,
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover-figure-front-section .oxi-image-hover-heading' => 'background: {{VALUE}};',
            ],
            'description' => 'This property will works as background of Heading.',
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
        $this->register_back_button_settings();
        $this->end_section_devider();
        $this->end_section_tabs();
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
                '{{WRAPPER}} .oxi-image-hover-figure-backend-section-body' => '',
            ],
            'description' => 'Customize Content Aginment as Top, Bottom, Left or Center.',
                ]
        );
        $this->add_group_control(
                'oxi-image-flip-back-background', $this->style, [
            'type' => Controls::BACKGROUND,
            'selector' => [
                '{{WRAPPER}} .oxi-image-hover-figure-backend' => '',
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
                '{{WRAPPER}} .oxi-image-hover-figure-backend-section-body' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'description' => 'Generate space around a Flipbox, inside of any defined borders or Background.',
                ]
        );
        $this->add_responsive_control(
                'oxi-image-flip-back-margin', $this->style, [
            'label' => esc_html__('Margin', 'image-hover-effects-ultimate'),
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
                '{{WRAPPER}} .oxi-image-hover-figure-back-section' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'description' => 'Generate space outside a Flipbox.',
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
                'placeholder' => 'Heading',
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
                    'image_hover_back_description', $this->style, [
                'label' => esc_html__('Short Description', 'image-hover-effects-ultimate'),
                'type' => Controls::TEXTAREA,
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
                    'image_hover_front_image', $this->style, [
                'label' => esc_html__('Image', 'image-hover-effects-ultimate'),
                'type' => Controls::MEDIA,
                'description' => 'Add or Modify Your Front Image.'
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
