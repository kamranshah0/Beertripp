<?php

namespace OXI_IMAGE_HOVER_PLUGINS\Modules\Filter\Admin;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Description of Effects1
 *
 * @author biplob
 */
use OXI_IMAGE_HOVER_PLUGINS\Modules\Filter\Modules as Modules;
use OXI_IMAGE_HOVER_PLUGINS\Classes\Controls as Controls;

class Effects2 extends Modules {

    public function modal_form_data() {
        ?>
        <div class="modal-header">
            <h4 class="modal-title">Image Hover Form</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body"> 
            <?php
            $this->add_control(
                    'image_hover_heading', $this->style, [
                'label' => esc_html__('Title', 'image-hover-effects-ultimate'),
                'type' => Controls::TEXT,
                'default' => 'Title 01',
                'placeholder' => 'Title 01',
                'description' => 'Set Title For repeting Your Category Data.'
                    ]
            );

            $this->add_control(
                    'image_hover_info', $this->style, [
                'label' => esc_html__('Image Hover Shortcode', 'image-hover-effects-ultimate'),
                'type' => Controls::TEXTAREA,
                'description' => 'Add Image Hover Shortcode. After saved kindly reload to loading CSS or JS properly '
                    ]
            );
            $this->add_responsive_control(
                    'category_item_col', $this->style, [
                'label' => esc_html__('Category Width', 'image-hover-effects-ultimate'),
                'type' => Controls::SELECT,
                'default' => '',
                'options' => [
                    '' => esc_html__('Same Width', 'image-hover-effects-ultimate'),
                    'grid_item_width_2' => esc_html__('Width 2', 'image-hover-effects-ultimate'),
                    'grid_item_width_3' => esc_html__('Width 3', 'image-hover-effects-ultimate'),
                    'grid_item_width_4' => esc_html__('Width 4', 'image-hover-effects-ultimate'),
                ],
                'description' => 'Select Width range for this Shortcode. '
                    ]
            );
           
            $this->add_control(
                    'image_hover_category_select', $this->style, [
                'label' => esc_html__('Category Select', 'image-hover-effects-ultimate'),
                'type' => Controls::SELECT,
                'multiple' => TRUE,
                'options' => $this->allcategory,
                'description' => 'Select Category For your Shortcode. '
                    ]
            );
            ?>
        </div>
        <?php
    }

}
