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

class Effects2 extends Modules {

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
                    'separator' => TRUE,
                    'loader' => TRUE,
                    'default' => 'coverflow',
                    'options' => [
                        'coverflow' => esc_html__('Coverflow', 'image-hover-effects-ultimate'),
                        'carousel' => esc_html__('Flipster', 'image-hover-effects-ultimate'),
                        'wheel' => esc_html__('Wheel', 'image-hover-effects-ultimate'),
                        'flat' => esc_html__('Flat', 'image-hover-effects-ultimate'),
                    ],
                    'description' => 'Select Carousel Type as Coverflow or Flipster or Wheel or Flat Design.'
                ]
        );
        $this->add_control(
                'carousel_flipster_spacing',
                $this->style,
                [
                    'label' => esc_html__('Autoplay Speed', 'image-hover-effects-ultimate'),
                    'type' => Controls::NUMBER,
                    'default' => -0.25,
                    'step' => 0.01,
                    'min' => -1,
                    'max' => 1,
                    'description' => 'Select Flipster Spacing, Recomendation Coverflow as 0, Flipster as -0.5, Wheel as 0 and Flat comes with -0.25.'
                ]
        );
        $this->add_control(
                'carousel_autoplay',
                $this->style,
                [
                    'label' => esc_html__('Autoplay', 'image-hover-effects-ultimate'),
                    'type' => Controls::SWITCHER,
                    'loader' => TRUE,
                    'default' => 'yes',
                    'yes' => esc_html__('Yes', 'image-hover-effects-ultimate'),
                    'no' => esc_html__('No', 'image-hover-effects-ultimate'),
                    'return_value' => 'yes',
                    'description' => 'Confirm carousel Autoplay Mode True or False.'
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
                    'description' => 'Select Carousel Auto Play Deration as MilliSecond.'
                ]
        );
        $this->add_control(
                'carousel_fadeIn',
                $this->style,
                [
                    'label' => esc_html__('Fade In (ms)', 'image-hover-effects-ultimate'),
                    'type' => Controls::NUMBER,
                    'default' => 500,
                    'description' => 'Select Carousel Auto Play Deration as MilliSecond.'
                ]
        );
        $this->add_control(
                'carousel_center_mode',
                $this->style,
                [
                    'label' => esc_html__('Item Starts From Center?', 'image-hover-effects-ultimate'),
                    'type' => Controls::SWITCHER,
                    'loader' => TRUE,
                    'default' => 'no',
                    'yes' => esc_html__('Yes', 'image-hover-effects-ultimate'),
                    'no' => esc_html__('No', 'image-hover-effects-ultimate'),
                    'return_value' => 'yes',
                    'description' => 'Item Center Mode: True or False.'
                ]
        );
        $this->add_control(
                'carousel_start_number',
                $this->style,
                [
                    'label' => esc_html__('Enter Starts Number', 'image-hover-effects-ultimate'),
                    'type' => Controls::NUMBER,
                    'default' => 2,
                    'condition' => [
                        '! carousel_center_mode' => '',
                    ],
                    'description' => 'Carousel Start Number like with Item will Start as Carousel on.'
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
                    'description' => 'Confirm Carousel Pause on Hover: True or False.'
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
                    'description' => 'Confirm Carousel Infinite Loop: True or False.'
                ]
        );

        $this->add_control(
                'carousel_click',
                $this->style,
                [
                    'label' => esc_html__('On Click Play?', 'image-hover-effects-ultimate'),
                    'type' => Controls::SWITCHER,
                    'loader' => TRUE,
                    'default' => 'yes',
                    'yes' => esc_html__('Yes', 'image-hover-effects-ultimate'),
                    'no' => esc_html__('No', 'image-hover-effects-ultimate'),
                    'return_value' => 'yes',
                    'description' => ' Carousel On Click Play: True or False.'
                ]
        );
        $this->add_control(
                'carousel_touch',
                $this->style,
                [
                    'label' => esc_html__('On Touch Play?', 'image-hover-effects-ultimate'),
                    'type' => Controls::SWITCHER,
                    'loader' => TRUE,
                    'default' => 'yes',
                    'yes' => esc_html__('Yes', 'image-hover-effects-ultimate'),
                    'no' => esc_html__('No', 'image-hover-effects-ultimate'),
                    'return_value' => 'yes',
                    'description' => ' Carousel On Touch Play: True or False.'
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
                    'description' => ' Carousel Arrows: True or False.'
                ]
        );

        $this->end_controls_section();
    }

    public function register_carousel_dots_settings() {

    }

}
