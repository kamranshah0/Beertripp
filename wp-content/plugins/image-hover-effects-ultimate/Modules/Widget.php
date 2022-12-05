<?php

namespace OXI_IMAGE_HOVER_PLUGINS\Modules;

if (!defined('ABSPATH')) {
    exit;
}

class Widget extends \WP_Widget {

    function __construct() {
        parent::__construct(
                'iheu_widget',
                esc_html__('Image Hover Effects Ultimate', 'image-hover-effects-ultimate'),
                array('description' => esc_html__('Image Hover Effects Ultimate Widget', 'image-hover-effects-ultimate'),)
        );
    }

    public function widget($args, $instance) {
        $title = apply_filters('widget_title', $instance['title']);
        echo $args['before_widget'];
        \OXI_IMAGE_HOVER_PLUGINS\Classes\Bootstrap::instance()->shortcode_render($title, 'user');
        echo $args['after_widget'];
    }

    public function iheu_widget_widget() {
        register_widget($this);
    }

    public function form($instance) {
        if (isset($instance['title'])) {
            $title = $instance['title'];
        } else {
            $title = esc_html__('1', 'image-hover-effects-ultimate');
        }
        ?>
        <p>
            <label for="<?php echo esc_html__($this->get_field_id('title'), 'image-hover-effects-ultimate'); ?>"><?php echo esc_html__('Style ID:', 'image-hover-effects-ultimate'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title']) ) ? strip_tags($new_instance['title']) : '';
        return $instance;
    }

}
