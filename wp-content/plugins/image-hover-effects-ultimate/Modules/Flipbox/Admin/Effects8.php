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

class Effects8 extends Modules {

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
        $this->register_back_button_settings();
        $this->end_section_devider();

        $this->end_section_tabs();
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
                'default' => '',
                'placeholder' => 'Heading',
                'description' => 'Add Your Flipbox Front Title.'
                    ]
            );
            $this->add_control(
                    'image_hover_back_heading', $this->style, [
                'label' => esc_html__('Backend Title', 'image-hover-effects-ultimate'),
                'type' => Controls::TEXT,
                'default' => '',
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
