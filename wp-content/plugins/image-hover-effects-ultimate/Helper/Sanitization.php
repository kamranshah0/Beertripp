<?php

namespace OXI_IMAGE_HOVER_PLUGINS\Helper;

if (!defined('ABSPATH')) {
    exit;
}

/**
 *
 * @author $biplob018
 */
use OXI_IMAGE_HOVER_PLUGINS\Classes\Controls as Controls;

trait Sanitization {

    /**
     * font settings sanitize
     * works at layouts page to adding font Settings sanitize
     */
    public function AdminTextSenitize($data) {
        $data = str_replace('\\\\"', '&quot;', $data);
        $data = str_replace('\\\"', '&quot;', $data);
        $data = str_replace('\\"', '&quot;', $data);
        $data = str_replace('\"', '&quot;', $data);
        $data = str_replace('"', '&quot;', $data);
        $data = str_replace('\\\\&quot;', '&quot;', $data);
        $data = str_replace('\\\&quot;', '&quot;', $data);
        $data = str_replace('\\&quot;', '&quot;', $data);
        $data = str_replace('\&quot;', '&quot;', $data);
        $data = str_replace("\\\\'", '&apos;', $data);
        $data = str_replace("\\\'", '&apos;', $data);
        $data = str_replace("\\'", '&apos;', $data);
        $data = str_replace("\'", '&apos;', $data);
        $data = str_replace("\\\\&apos;", '&apos;', $data);
        $data = str_replace("\\\&apos;", '&apos;', $data);
        $data = str_replace("\\&apos;", '&apos;', $data);
        $data = str_replace("\&apos;", '&apos;', $data);
        $data = str_replace("'", '&apos;', $data);
        $data = str_replace('<', '&lt;', $data);
        $data = str_replace('>', '&gt;', $data);
        $data = sanitize_text_field($data);
        return $data;
    }

    /*
     * Image Hover Style Admin Panel Body
     *
     * @since 9.3.0
     */

    public function start_section_tabs($id, array $arg = []) {
        ?>
        <div class="oxi-addons-tabs-content-tabs" id="shortcode-addons-section-<?php
        if (array_key_exists('condition', $arg)) :
            foreach ($arg['condition'] as $value) {
                echo esc_attr($value);
            }
        endif;

        echo '"  ' . (array_key_exists('padding', $arg) ? 'style="padding: ' . esc_attr($arg['padding']) . '"' : '') . '>';
    }

    /*
     * Image Hover Style Admin Panel header
     *
     * @since 9.3.0
     */

    public function start_section_header($id, array $arg = []) {
        ?>
             <ul class="oxi-addons-tabs-ul">  
             <?php
             foreach ($arg['options'] as $key => $value) {
                 echo '<li ref="#shortcode-addons-section-' . esc_attr($key) . '">' . esc_html($value) . '</li>';
             }
             ?>
        </ul>
        <?php
    }

    /*
     * Image Hover Style Admin Panel end Body
     *
     * @since 9.3.0
     */

    public function end_section_tabs() {
        ?>
        </div>
        <?php
    }

    /*
     * Image Hover Style Admin Panel Col 6 or Entry devider
     *
     * @since 9.3.0
     */

    public function start_section_devider() {
        ?>
        <div class="oxi-addons-col-6">
            <?php
        }

        /*
         * Image Hover Style Admin Panel end Entry Divider
         *
         * @since 9.3.0
         */

        public function end_section_devider() {
            ?>
        </div>
        <?php
    }

    /*
     * Image Hover Style Admin Panel Form Dependency
     *
     * @since 9.3.0
     */

    public function forms_condition(array $arg = []) {

        if (array_key_exists('condition', $arg)) :
            $i = $arg['condition'] != '' ? count($arg['condition']) : 0;

            $data = '';
            $s = 1;
            $form_condition = array_key_exists('form_condition', $arg) ? $arg['form_condition'] : '';
            $notcondition = array_key_exists('notcondition', $arg) ? $arg['notcondition'] : false;

            foreach ($arg['condition'] != '' ? $arg['condition'] : [] as $key => $value) {
                if (is_array($value)) :
                    $c = count($value);
                    $crow = 1;
                    if ($c > 1 && $i > 1) :
                        $data .= '(';
                    endif;
                    foreach ($value as $item) {
                        $data .= $form_condition . $key . ' === \'' . $item . '\'';
                        if ($crow < $c) :
                            $data .= ' || ';
                            $crow++;
                        endif;
                    }
                    if ($c > 1 && $i > 1) :
                        $data .= ')';
                    endif;
                elseif ($value == 'COMPILED') :
                    $data .= $form_condition . $key;
                elseif ($value == 'EMPTY') :
                    $data .= $form_condition . $key . ' !== \'\'';
                elseif (empty($value)) :
                    $data .= $form_condition . $key;
                elseif ($notcondition) :
                    $data .= $form_condition . $key . ' !== \'' . $value . '\'';
                else :
                    $data .= $form_condition . $key . ' === \'' . $value . '\'';
                endif;
                if ($s < $i) :
                    $data .= ' && ';
                    $s++;
                endif;
            }
            if (!empty($data)) :
                echo 'data-condition="' . esc_attr($data) . '"';
            endif;
        endif;
    }

    /*
     * Image Hover Style Admin Panel Each Tabs
     *
     * @since 9.3.0
     */

    public function start_controls_section($id, array $arg = []) {
        $defualt = ['showing' => FALSE];
        $arg = array_merge($defualt, $arg);
        ?>
        <div class="oxi-addons-content-div <?php echo (($arg['showing']) ? '' : 'oxi-admin-head-d-none'); ?> " <?php $this->forms_condition($arg) ?>>
            <div class="oxi-head">
                <?php echo esc_html($arg['label']); ?>
                <div class="oxi-head-toggle"></div>
            </div>
            <div class="oxi-addons-content-div-body">

                <?php
            }

            /*
             * Image Hover Style Admin Panel end Each Tabs
             *
             * @since 9.3.0
             */

            public function end_controls_section() {
                ?>
            </div>
        </div>
        <?php
    }

    /*
     * Image Hover Style Admin Panel Section Inner Tabs
     * This Tabs like inner tabs as Normal view and Hover View
     *
     * @since 9.3.0
     */

    public function start_controls_tabs($id, array $arg = []) {
        $defualt = ['options' => ['normal' => 'Normal', 'hover' => 'Hover']];
        $arg = array_merge($defualt, $arg);
        $separator = (array_key_exists('separator', $arg) ? ($arg['separator'] === TRUE ? 'shortcode-form-control-separator-before' : '') : '');
        ?>

        <div class="shortcode-form-control shortcode-control-type-control-tabs  <?php echo esc_attr($separator); ?>">
            <div class="shortcode-form-control-content shortcode-form-control-content-tabs">
                <div class="shortcode-form-control-field">

                    <?php
                    foreach ($arg['options'] as $key => $value) {
                        ?>
                        <div class="shortcode-control-type-control-tab-child">
                            <div class="shortcode-control-content">
                                <?php echo esc_html($value); ?>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="shortcode-form-control-content">
                <?php
            }

            /*
             * Image Hover Style Admin Panel end Section Inner Tabs
             *
             * @since 9.3.0
             */

            public function end_controls_tabs() {
                ?>
            </div> </div>
        <?php
    }

    /*
     * Image Hover Style Admin Panel Section Inner Tabs Child
     *
     * @since 9.3.0
     */

    public function start_controls_tab() {
        ?>
        <div class="shortcode-form-control-content shortcode-form-control-tabs-content shortcode-control-tab-close">
            <?php
        }

        /*
         * Image Hover Style Admin Panel End Section Inner Tabs Child
         *
         * @since 9.3.0
         */

        public function end_controls_tab() {
            ?>
        </div>
        <?php
    }

    /*
     * Image Hover Style Admin Panel  Section Popover
     *
     * @since 9.3.0
     */

    public function start_popover_control($id, array $arg = []) {

        $separator = (array_key_exists('separator', $arg) ? ($arg['separator'] === TRUE ? 'shortcode-form-control-separator-before' : '') : '');
        ?>
        <div class="shortcode-form-control shortcode-control-type-popover <?php echo esc_attr($separator); ?>" <?php $this->forms_condition($arg) ?>>
            <div class="shortcode-form-control-content shortcode-form-control-content-popover">
                <div class="shortcode-form-control-field">
                    <label for="" class="shortcode-form-control-title"><?php echo esc_html($arg['label']); ?></label>
                    <div class="shortcode-form-control-input-wrapper">
                        <span class="dashicons popover-set"></span>
                    </div>
                </div>
                <?php
                if (array_key_exists('description', $arg)):
                    ?>
                    <div class="shortcode-form-control-description"><?php echo esc_html($arg['description']); ?></div>
                    <?php
                endif;
                ?>

            </div>
            <div class="shortcode-form-control-content shortcode-form-control-content-popover-body">

                <?php
            }

            /*
             * Image Hover Style Admin Panel end Popover
             *
             * @since 9.3.0
             */

            public function end_popover_control() {
                echo '</div></div>';
            }

            /*
             * Image Hover Style Admin Panel Form Add Control.
             * Call All Input Control from here Based on Control Name.
             *
             * @since 9.3.0
             */

            public function add_control($id, array $data = [], array $arg = []) {
                /*
                 * Responsive Control Start
                 * @since 9.3.0
                 */
                $responsiveclass = $responsive = '';
                if (array_key_exists('responsive', $arg)) :
                    if ($arg['responsive'] == 'laptop') :
                        $responsiveclass = 'shortcode-addons-form-responsive-laptop';
                    elseif ($arg['responsive'] == 'tab') :
                        $responsiveclass = 'shortcode-addons-form-responsive-tab';
                    elseif ($arg['responsive'] == 'mobile') :
                        $responsiveclass = 'shortcode-addons-form-responsive-mobile';
                    endif;
                    $responsive = 'yes';
                endif;
                $defualt = [
                    'type' => 'text',
                    'label' => 'Input Text',
                    'default' => '',
                    'label_on' => esc_html__('Yes', 'image-hover-effects-ultimate'),
                    'label_off' => esc_html__('No', 'image-hover-effects-ultimate'),
                    'placeholder' => esc_html__('', 'image-hover-effects-ultimate'),
                    'selector-data' => TRUE,
                    'render' => TRUE,
                    'responsive' => 'laptop',
                ];

                /*
                 * Data Currection while Its comes from group Control
                 */
                if (array_key_exists('selector-value', $arg)) :
                    foreach ($arg['selector'] as $key => $value) {
                        $arg['selector'][$key] = $arg['selector-value'];
                    }
                endif;

                $arg = array_merge($defualt, $arg);
                if ($arg['type'] == 'animation') :
                    $arg['type'] = 'select';
                    $arg['options'] = [
                        '' => esc_html__('None', 'image-hover-effects-ultimate'),
                        'bounce' => esc_html__('Bounce', 'image-hover-effects-ultimate'),
                        'flash' => esc_html__('Flash', 'image-hover-effects-ultimate'),
                        'pulse' => esc_html__('Pulse', 'image-hover-effects-ultimate'),
                        'rubberBand' => esc_html__('RubberBand', 'image-hover-effects-ultimate'),
                        'shake' => esc_html__('Shake', 'image-hover-effects-ultimate'),
                        'swing' => esc_html__('Swing', 'image-hover-effects-ultimate'),
                        'tada' => esc_html__('Tada', 'image-hover-effects-ultimate'),
                        'wobble' => esc_html__('Wobble', 'image-hover-effects-ultimate'),
                        'jello' => esc_html__('Jello', 'image-hover-effects-ultimate'),
                    ];
                endif;

                $toggle = (array_key_exists('toggle', $arg) ? 'shortcode-addons-form-toggle' : '');
                $separator = (array_key_exists('separator', $arg) ? ($arg['separator'] === TRUE ? 'shortcode-form-control-separator-before' : '') : '');

                $loader = (array_key_exists('loader', $arg) ? $arg['loader'] == TRUE ? ' shortcode-addons-control-loader ' : '' : '');
                ?>



                <div class="shortcode-form-control shortcode-control-type-<?php echo esc_attr($arg['type']); ?> <?php echo esc_attr($separator); ?>  <?php echo esc_attr($toggle); ?>  <?php echo esc_attr($responsiveclass); ?> <?php echo esc_attr($loader); ?> " <?php $this->forms_condition($arg) ?>>
                    <div class="shortcode-form-control-content">
                        <div class="shortcode-form-control-field">
                            <label for="" class="shortcode-form-control-title"><?php echo esc_html($arg['label']); ?></label>
                            <?php
                            if ($responsive == 'yes') :
                                ?>
                                <div class="shortcode-form-control-responsive-switchers">
                                    <a class="shortcode-form-responsive-switcher shortcode-form-responsive-switcher-desktop" data-device="desktop">
                                        <span class="dashicons dashicons-desktop"></span>
                                    </a>
                                    <a class="shortcode-form-responsive-switcher shortcode-form-responsive-switcher-tablet" data-device="tablet">
                                        <span class="dashicons dashicons-tablet"></span>
                                    </a>
                                    <a class="shortcode-form-responsive-switcher shortcode-form-responsive-switcher-mobile" data-device="mobile">
                                        <span class="dashicons dashicons-smartphone"></span>
                                    </a>
                                </div>
                                <?php
                            endif;

                            $fun = $arg['type'] . '_admin_control';
                            $this->$fun($id, $data, $arg);
                            ?>
                        </div>
                        <?php
                        if (array_key_exists('description', $arg)):
                            ?>
                            <div class="shortcode-form-control-description"><?php echo esc_html($arg['description']); ?></div>
                            <?php
                        endif;
                        ?>
                    </div>
                </div>
                <?php
            }

            /*
             * Image Hover Style Admin Panel Responsive Control.
             * Can Possible to modify any Add control to Responsive Control
             *
             * @since 9.3.0
             */

            public function add_responsive_control($id, array $data = [], array $arg = []) {
                $lap = $id . '-lap';
                $tab = $id . '-tab';
                $mob = $id . '-mob';
                $laparg = ['responsive' => 'laptop'];
                $tabarg = ['responsive' => 'tab'];
                $mobarg = ['responsive' => 'mobile'];
                $this->add_control($lap, $data, array_merge($arg, $laparg));
                $this->add_control($tab, $data, array_merge($arg, $tabarg));
                $this->add_control($mob, $data, array_merge($arg, $mobarg));
            }

            /*
             * Image Hover Style Admin Panel Group Control.
             *
             * @since 9.3.0
             */

            public function add_group_control($id, array $data = [], array $arg = []) {
                $defualt = [
                    'type' => 'text',
                    'label' => 'Input Text',
                    'description' => '',
                    'simpledescription' => ''
                ];
                $arg = array_merge($defualt, $arg);
                $fun = $arg['type'] . '_admin_group_control';
                $this->$fun($id, $data, $arg);
            }

            /*
             * Image Hover Style Admin Panel Repeater Control.
             *
             * @since 9.3.0
             */

            public function add_repeater_control($id, array $data = [], array $arg = []) {

                $separator = (array_key_exists('separator', $arg) ? ($arg['separator'] === TRUE ? 'shortcode-form-control-separator-before' : '') : '');
                $buttontext = (array_key_exists('button', $arg) ? $arg['button'] : 'Add Item');
                ?>


                <div class="shortcode-form-control shortcode-control-type-<?php echo esc_attr($arg['type']); ?> <?php echo esc_attr($separator); ?>" <?php $this->forms_condition($arg) ?> id="<?php echo esc_attr($id); ?>">
                    <div class="shortcode-form-control-content">
                        <div class="shortcode-form-control-field">
                            <label for="" class="shortcode-form-control-title"><?php echo esc_html($arg['label']); ?></label>
                        </div>
                        <div class="shortcode-form-repeater-fields-wrapper">
                            <?php
                            if (array_key_exists($id, $data)) :
                                foreach ($data[$id] as $k => $vl) {
                                    $style = [];
                                    foreach ($vl as $c => $v) {
                                        $style[$id . 'saarsa' . $k . 'saarsa' . $c] = $v;
                                    }
                                    ?>
                                    <div class="shortcode-form-repeater-fields" tab-title="<?php echo esc_html($arg['title_field']); ?>">
                                        <div class="shortcode-form-repeater-controls">
                                            <div class="shortcode-form-repeater-controls-title">
                                                <?php echo esc_html($vl[$arg['title_field']]); ?>
                                            </div>
                                            <div class="shortcode-form-repeater-controls-duplicate">
                                                <span class="dashicons dashicons-admin-page"></span>
                                            </div>
                                            <div class="shortcode-form-repeater-controls-remove">
                                                <span class="dashicons dashicons-trash"></span>
                                            </div>
                                        </div>
                                        <div class="shortcode-form-repeater-content">
                                            <?php
                                            foreach ($arg['fields'] as $key => $value) {
                                                $controller = (array_key_exists('controller', $value) ? $value['controller'] : 'add_control');
                                                $child = $id . 'saarsa' . $k . 'saarsa' . $key;
                                                $value['conditional'] = (array_key_exists('conditional', $value) ? ($value['conditional'] == 'outside') ? 'outside' : 'inside' : '');
                                                $value['form_condition'] = (array_key_exists('conditional', $value) ? ($value['conditional'] == 'inside') ? $id . 'saarsa' . $k . 'saarsa' : '' : '');

                                                if ($controller == 'add_control' || $controller == 'add_group_control' || $controller == 'add_responsive_control') :
                                                    $this->$controller($child, $style, $value);
                                                else :
                                                    $this->$controller($child, $value);
                                                endif;
                                            }
                                            ?>
                                        </div>
                                    </div>   
                                    <?php
                                }
                            endif;
                            ?>

                        </div>   
                        <?php
                        $this->add_control(
                                $id . 'nm',
                                $data,
                                ['type' => Controls::HIDDEN, 'default' => '0',]
                        );
                        ?>
                        <div class="shortcode-form-repeater-button-wrapper"><a href="#" parent-id="<?php echo esc_attr($id); ?>" class="shortcode-form-repeater-button"><span class="dashicons dashicons-plus"></span> <?php esc_html($buttontext) ?></a></div>
                    </div>
                </div>                                
                <?php
                $this->repeater .= '<div id="repeater-' . esc_attr($id) . '-initial-data">
                                <div class="shortcode-form-repeater-fields" tab-title="' . esc_html($arg['title_field']) . '">
                                    <div class="shortcode-form-repeater-controls">
                                        <div class="shortcode-form-repeater-controls-title">
                                            Title Goes Here
                                        </div>
                                        <div class="shortcode-form-repeater-controls-duplicate">
                                            <span class="dashicons dashicons-admin-page"></span>
                                        </div>
                                        <div class="shortcode-form-repeater-controls-remove">
                                            <span class="dashicons dashicons-trash"></span>
                                        </div>
                                    </div>
                                    <div class="shortcode-form-repeater-content">';
                foreach ($arg['fields'] as $key => $value) {
                    $controller = (array_key_exists('controller', $value) ? $value['controller'] : 'add_control');
                    $child = $id . 'saarsarepidrepsaarsa' . $key;
                    $value['conditional'] = (array_key_exists('conditional', $value) ? ($value['conditional'] == 'outside') ? 'outside' : 'inside' : '');
                    $value['form_condition'] = (array_key_exists('conditional', $value) ? ($value['conditional'] == 'inside') ? $id . 'saarsarepidrepsaarsa' : '' : '');
                    ob_start();
                    if ($controller == 'add_control' || $controller == 'add_group_control' || $controller == 'add_responsive_control') :

                        $this->$controller($child, [], $value);
                    else :
                        $this->$controller($child, $value);
                    endif;

                    $this->repeater .= ob_get_clean();
                }
                $this->repeater .= '         </div>
                                </div>
                            </div>';
            }

            public function add_rearrange_control($id, array $data = [], array $arg = []) {

                $separator = (array_key_exists('separator', $arg) ? ($arg['separator'] === TRUE ? 'shortcode-form-control-separator-before' : '') : '');
                $value = array_key_exists($id, $data) ? $data[$id] : $arg['default'];
                ?>
                <div class="shortcode-form-control shortcode-control-type-<?php echo esc_attr($arg['type']); ?> <?php echo esc_attr($separator); ?>" <?php $this->forms_condition($arg) ?>>
                    <div class="shortcode-form-control-content">
                        <div class="shortcode-form-control-field">
                            <label for="" class="shortcode-form-control-title"><?php echo esc_html($arg['label']); ?></label>
                        </div>
                        <div class="shortcode-form-rearrange-fields-wrapper" vlid="#<?php echo esc_attr($id); ?>">
                            <?php
                            $rearrange = explode(',', $value);
                            foreach ($rearrange as $k => $vl) {
                                if ($vl != '') :
                                    ?>
                                    <div class="shortcode-form-repeater-fields" id="<?php echo esc_attr($vl); ?>">
                                        <div class="shortcode-form-repeater-controls">
                                            <div class="shortcode-form-repeater-controls-title">
                                                <?php echo esc_html($arg['fields'][$vl]['label']); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                endif;
                            }
                            ?>
                            <div class="shortcode-form-control-input-wrapper">
                                <input type="hidden" value="<?php echo esc_attr($value) ?>" name="<?php esc_attr($id) ?>" id="<?php echo esc_attr($id); ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }

            /*
             * Image Hover Style Admin Panel Heading Input.
             *
             * @since 9.3.0
             */

            public function heading_admin_control($id, array $data = [], array $arg = []) {
                echo ' ';
            }

            /*
             * Image Hover Style Admin Panel Switcher Input.
             *
             * @since 9.3.0
             */

            public function separator_admin_control($id, array $data = [], array $arg = []) {
                echo '';
            }

            public function multiple_selector_handler($data, $val) {

                $val = preg_replace_callback('/\{\{\K(.*?)(?=}})/', function ($match) use ($data) {
                    $ER = explode('.', $match[0]);
                    if (strpos($match[0], 'SIZE') !== FALSE) :
                        $size = array_key_exists($ER[0] . '-size', $data) ? $data[$ER[0] . '-size'] : '';
                        $match[0] = str_replace('.SIZE', $size, $match[0]);
                    endif;
                    if (strpos($match[0], 'UNIT') !== FALSE) :
                        $size = array_key_exists($ER[0] . '-choices', $data) ? $data[$ER[0] . '-choices'] : '';
                        $match[0] = str_replace('.UNIT', $size, $match[0]);
                    endif;
                    if (strpos($match[0], 'VALUE') !== FALSE) :
                        $size = array_key_exists($ER[0], $data) ? $data[$ER[0]] : '';
                        $match[0] = str_replace('.VALUE', $size, $match[0]);
                    endif;
                    return str_replace($ER[0], '', $match[0]);
                }, $val);
                return str_replace("{{", '', str_replace("}}", '', $val));
            }

            /*
             * Image Hover Style Admin Panel Switcher Input.
             *
             * @since 9.3.0
             */

            public function switcher_admin_control($id, array $data = [], array $arg = []) {
                $value = array_key_exists($id, $data) ? $data[$id] : $arg['default'];
                ?>
                <div class="shortcode-form-control-input-wrapper">
                    <label class="shortcode-switcher">
                        <input type="checkbox" <?php
                        if (isset($arg['return_value']) && $value == $arg['return_value']):
                            echo 'checked ckdflt="true"';
                        endif;
                        ?> value="<?php echo esc_html($arg['return_value']); ?>"  name="<?php echo esc_attr($id); ?>" id="<?php echo esc_attr($id); ?>"/>
                        <span data-on="<?php echo esc_attr($arg['label_on']); ?>" data-off="<?php echo esc_attr($arg['label_off']); ?>"></span>
                    </label>
                </div>
                <?php
            }

            /*
             * Image Hover Style Admin Panel Text Input.
             *
             * @since 9.3.0
             */

            public function text_admin_control($id, array $data = [], array $arg = []) {
                $value = array_key_exists($id, $data) ? $data[$id] : $arg['default'];
                $retunvalue = array_key_exists('selector', $arg) ? htmlspecialchars(json_encode($arg['selector'])) : '';
                if (array_key_exists('link', $arg)) :
                    ?>
                    <div class="shortcode-form-control-input-wrapper shortcode-form-control-input-link">
                        <input type="text"  name="<?php echo esc_attr($id); ?>" id="<?php echo esc_attr($id); ?>" value="<?php echo esc_html($value); ?>" placeholder="<?php echo esc_html($arg['placeholder']); ?>" retundata='<?php echo esc_attr($retunvalue); ?>'>
                        <span class="dashicons dashicons-admin-generic"></span>
                        <?php
                    else :
                        ?>
                        <div class="shortcode-form-control-input-wrapper">
                            <input type="text"  name="<?php echo esc_attr($id); ?>" id="<?php echo esc_attr($id); ?>" value="<?php echo esc_html($value); ?>" placeholder="<?php echo esc_html($arg['placeholder']); ?>" retundata='<?php echo esc_attr($retunvalue); ?>'>
                        </div>
                    <?php
                    endif;
                }

                /*
                 * Image Hover Style Admin Panel Hidden Input.
                 *
                 * @since 9.3.0
                 */

                public function hidden_admin_control($id, array $data = [], array $arg = []) {
                    $value = array_key_exists($id, $data) ? $data[$id] : $arg['default'];
                    ?>
                    <div class="shortcode-form-control-input-wrapper">
                        <input type="hidden" value="<?php echo esc_html($value); ?>" name="<?php echo esc_attr($id); ?>" id="<?php echo esc_attr($id); ?>">
                    </div>
                    <?php
                }

                /*
                 * Image Hover Style Admin Panel Textarea Input.
                 *
                 * @since 9.3.0
                 */

                public function textarea_admin_control($id, array $data = [], array $arg = []) {
                    $value = array_key_exists($id, $data) ? $data[$id] : $arg['default'];
                    if ($id === 'image-hover-custom-css'):
                        $value = str_replace("<br>", "", str_replace("&nbsp;", " ", $value));
                    endif;

                    $retunvalue = array_key_exists('selector', $arg) ? htmlspecialchars(json_encode($arg['selector'])) : '';
                    ?>
                    <div class="shortcode-form-control-input-wrapper">
                        <textarea  name="<?php echo esc_attr($id); ?>" id="<?php echo esc_attr($id); ?>" retundata='<?php echo esc_attr($retunvalue); ?>' class="shortcode-form-control-tag-area" rows="<?php echo (int) ((strlen($value) / 50) + 2); ?>" placeholder="<?php echo esc_html($arg['placeholder']); ?>"><?php echo esc_html($value); ?></textarea>
                    </div>
                    <?php
                }

                /*
                 * Image Hover Style Admin Panel WYSIWYG Input.
                 *
                 * @since 9.3.0
                 */

                public function wysiwyg_admin_control($id, array $data = [], array $arg = []) {
                    $value = array_key_exists($id, $data) ? $data[$id] : $arg['default'];
                    $retunvalue = array_key_exists('selector', $arg) ? htmlspecialchars(json_encode($arg['selector'])) : '';
                    ?>
                    <div class="shortcode-form-control-input-wrapper"  retundata='<?php echo esc_attr($retunvalue); ?>'>
                        <?php
                        echo wp_editor(
                                $value,
                                $id,
                                $settings = array(
                            'textarea_name' => $id,
                            'wpautop' => false,
                            'textarea_rows' => 7,
                            'force_br_newlines' => true,
                            'force_p_newlines' => false
                                )
                        );
                        ?>
                    </div>
                    <?php
                }

                /*
                 * Image Hover Style Admin Panel Image Input.
                 *
                 * @since 9.3.0
                 */

                public function image_admin_control($id, array $data = [], array $arg = []) {
                    $value = array_key_exists($id, $data) ? $data[$id] : $arg['default'];
                    ?>
                    <div class="shortcode-form-control-input-wrapper">
                        <div class="shortcode-addons-media-control <?php
                        if (empty($value)):
                            echo 'shortcode-addons-media-control-hidden-button';
                        endif;
                        ?>">

                            <div class="shortcode-addons-media-control-pre-load">
                            </div>
                            <div class="shortcode-addons-media-control-image-load" style="background-image: url(<?php echo esc_url($value); ?>);" ckdflt="background-image: url(<?php echo esc_url($value); ?>);">
                                <div class="shortcode-addons-media-control-image-load-delete-button">
                                </div>
                            </div>
                            <div class="shortcode-addons-media-control-choose-image">
                                Choose Image
                            </div>
                        </div>
                        <input type="hidden" class="shortcode-addons-media-control-link" id="<?php echo esc_attr($id); ?>" name="<?php echo esc_attr($id); ?>" value="<?php echo esc_url($value); ?>">
                        <input type="hidden" class="shortcode-addons-media-control-link-alt" id="<?php echo esc_attr($id); ?>-alt" name="<?php echo esc_attr($id); ?>-alt" value="" >
                    </div>
                    <?php
                }

                /*
                 * Image Hover Style Admin Panel Number Input.
                 *
                 * @since 9.3.0
                 */

                public function number_admin_control($id, array $data = [], array $arg = []) {

                    $value = array_key_exists($id, $data) ? $data[$id] : $arg['default'];
                    $retunvalue = array_key_exists('selector', $arg) ? htmlspecialchars(json_encode($arg['selector'])) : '';
                    if (array_key_exists('selector-data', $arg) && $arg['selector-data'] == TRUE && $this->render_condition_control($id, $data, $arg)) :
                        if (array_key_exists('selector', $arg)) :
                            foreach ($arg['selector'] as $key => $val) {
                                $key = (strpos($key, '{{KEY}}') ? str_replace('{{KEY}}', explode('saarsa', $id)[1], $key) : $key);
                                $class = str_replace('{{WRAPPER}}', $this->CSSWRAPPER, $key);
                                $file = str_replace('{{VALUE}}', $value, $val);
                                if (strpos($file, '{{') !== FALSE) :
                                    $file = $this->multiple_selector_handler($data, $file);
                                endif;
                                if (!empty($value)) :
                                    $this->CSSDATA[$arg['responsive']][$class][$file] = $file;
                                endif;
                            }
                        endif;
                    endif;

                    $defualt = ['min' => 0, 'max' => 1000, 'step' => 1,];
                    $arg = array_merge($defualt, $arg);
                    ?>
                    <div class="shortcode-form-control-input-wrapper">
                        <input id="<?php echo esc_attr($id); ?>" name="<?php echo esc_attr($id); ?>" type="number" min="<?php echo esc_attr($arg['min']); ?>" max="<?php echo esc_attr($arg['max']); ?>" step="<?php echo esc_attr($arg['step']); ?>" value="<?php echo esc_attr($value); ?>"  responsive="<?php echo esc_attr($arg['responsive']); ?>" retundata='<?php echo esc_attr($retunvalue); ?>'>
                    </div>
                    <?php
                }

                /*
                 * Image Hover Style Admin Panel Slider Input.
                 *
                 * @since 9.3.0
                 * Done With Number Information
                 */

                public function slider_admin_control($id, array $data = [], array $arg = []) {
                    $unit = array_key_exists($id . '-choices', $data) ? $data[$id . '-choices'] : $arg['default']['unit'];
                    $size = array_key_exists($id . '-size', $data) ? $data[$id . '-size'] : $arg['default']['size'];
                    $retunvalue = array_key_exists('selector', $arg) ? htmlspecialchars(json_encode($arg['selector'])) : '';
                    if (array_key_exists('selector-data', $arg) && $arg['selector-data'] == TRUE && $arg['render'] == TRUE && $this->render_condition_control($id, $data, $arg)) :
                        if (array_key_exists('selector', $arg)) :
                            foreach ($arg['selector'] as $key => $val) {
                                if ($size != '' && $val != '') :
                                    $key = (strpos($key, '{{KEY}}') ? str_replace('{{KEY}}', explode('saarsa', $id)[1], $key) : $key);
                                    $class = str_replace('{{WRAPPER}}', $this->CSSWRAPPER, $key);
                                    $file = str_replace('{{SIZE}}', $size, $val);
                                    $file = str_replace('{{UNIT}}', $unit, $file);
                                    if (strpos($file, '{{') !== FALSE) :
                                        $file = $this->multiple_selector_handler($data, $file);
                                    endif;
                                    if (!empty($size)) :
                                        $this->CSSDATA[$arg['responsive']][$class][$file] = $file;
                                    endif;
                                endif;
                            }
                        endif;
                    endif;
                    if (array_key_exists('range', $arg)) :
                        if (count($arg['range']) > 1) :
                            ?>
                            <div class="shortcode-form-units-choices">
                                <?php
                                foreach ($arg['range'] as $key => $val) {
                                    $rand = rand(10000, 233333333);
                                    ?>
                                    <input id="<?php echo esc_attr($id); ?>-choices-<?php echo esc_attr($rand); ?>" type="radio" name="<?php echo esc_attr($id); ?>-choices"  value="<?php echo esc_html($key); ?>" <?php
                                    if ($key == $unit):
                                        echo 'checked';
                                    endif;
                                    ?> min="<?php echo esc_attr($val['min']); ?>" max="<?php echo esc_html($val['max']); ?>" step="<?php echo esc_html($val['step']); ?>">
                                    <label class="shortcode-form-units-choices-label" for="<?php echo esc_attr($id); ?>-choices-<?php echo esc_attr($rand); ?>"><?php echo esc_html($key); ?></label>
                                    <?php
                                }
                                ?>
                            </div>
                            <?php
                        endif;
                    endif;
                    ?>
                    <div class="shortcode-form-control-input-wrapper">
                        <div class="shortcode-form-slider" id="<?php echo esc_attr($id); ?>-slider"></div>
                        <div class="shortcode-form-slider-input">
                            <input name="<?php echo esc_attr($id); ?>-size" custom="<?php
                            if (array_key_exists('custom', $arg)):
                                echo esc_attr($arg['custom']);
                            endif;
                            ?>" id="<?php echo esc_attr($id); ?>-size" type="number" min="<?php
                                   echo esc_attr($arg['range'][$unit]['min']);
                                   ?>" max="<?php
                                   echo esc_attr($arg['range'][$unit]['max']);
                                   ?>" step="<?php echo esc_attr($arg['range'][$unit]['step']); ?>" value="<?php echo esc_attr($size); ?>" default-value="<?php echo esc_attr($size); ?>" <?php
                                   if (array_key_exists($id . '-choices', $data)):
                                       echo 'unit="' . esc_attr($data[$id . '-choices']) . '"';
                                   endif;
                                   ?> responsive="<?php echo esc_attr($arg['responsive']); ?>" retundata='<?php echo esc_attr($retunvalue); ?>'>
                        </div>
                    </div>
                    <?php
                }

                /*
                 * Image Hover Style Admin Panel Select Input.
                 *
                 * @since 9.3.0
                 */

                public function select_admin_control($id, array $data = [], array $arg = []) {
                    $id = (array_key_exists('repeater', $arg) ? $id . ']' : $id);
                    $value = array_key_exists($id, $data) ? $data[$id] : $arg['default'];
                    $retun = [];

                    if (array_key_exists('selector-data', $arg) && $arg['selector-data'] == TRUE && $this->render_condition_control($id, $data, $arg)) {
                        if (array_key_exists('selector', $arg)) :
                            foreach ($arg['selector'] as $key => $val) {
                                $key = (strpos($key, '{{KEY}}') ? str_replace('{{KEY}}', explode('saarsa', $id)[1], $key) : $key);
                                if (!empty($value) && !empty($val) && $arg['render'] == TRUE) {
                                    $class = str_replace('{{WRAPPER}}', $this->CSSWRAPPER, $key);
                                    $file = str_replace('{{VALUE}}', $value, $val);
                                    if (strpos($file, '{{') !== FALSE) :
                                        $file = $this->multiple_selector_handler($data, $file);
                                    endif;
                                    if (!empty($value)) :
                                        $this->CSSDATA[$arg['responsive']][$class][$file] = $file;
                                    endif;
                                }
                                $retun[$key][$key]['type'] = ($val != '' ? 'CSS' : 'HTML');
                                $retun[$key][$key]['value'] = $val;
                            }
                        endif;
                    }
                    $retunvalue = array_key_exists('selector', $arg) ? htmlspecialchars(json_encode($retun)) : '';
                    $multiple = (array_key_exists('multiple', $arg) && $arg['multiple']) == true ? TRUE : FALSE;
                    ?>
                    <div class="shortcode-form-control-input-wrapper">
                        <div class="shortcode-form-control-input-select-wrapper">
                            <select id="<?php echo esc_attr($id); ?>" class="shortcode-addons-select-input <?php
                            if ($multiple):
                                echo 'js-example-basic-multiple" multiple';
                            else:
                                echo '"';
                            endif;
                            ?> name="<?php echo esc_attr($id); ?><?php
                                    if ($multiple):
                                        echo '[]';
                                    endif;
                                    ?>"  responsive="<?php echo esc_attr($arg['responsive']); ?>" retundata='<?php echo esc_attr($retunvalue); ?>'>
                                        <?php
                                        foreach ($arg['options'] as $key => $val) {
                                            if (is_array($val)) :
                                                if (isset($val[0]) && $val[0] == true) :
                                                    ?>
                                            <optgroup label="<?php echo esc_html($val[1]); ?>">
                                                <?php
                                            else :
                                                ?>
                                            </optgroup>
                                        <?php
                                        endif;
                                    else :
                                        if (is_array($value)) :
                                            $new = array_flip($value);
                                            ?>
                                            <option value="<?php echo esc_html($key); ?>" <?php
                                            if (array_key_exists($key, $new)):
                                                echo 'selected';
                                            endif;
                                            ?>><?php echo esc_html($val); ?></option>
                                                    <?php
                                                else :
                                                    ?>
                                            <option value="<?php echo esc_html($key); ?>" <?php
                                            if ($value == $key):
                                                echo 'selected';
                                            endif;
                                            ?>><?php echo esc_html($val); ?></option>
                                                <?php
                                                endif;
                                            endif;
                                        }
                                        ?>
                            </select>
                        </div>
                    </div>
                    <?php
                }

                /*
                 * Image Hover Style Admin Panel Choose Input.
                 *
                 * @since 9.3.0
                 */

                public function choose_admin_control($id, array $data = [], array $arg = []) {
                    $value = array_key_exists($id, $data) ? $data[$id] : $arg['default'];
                    $retun = [];

                    $operator = array_key_exists('operator', $arg) ? $arg['operator'] : 'text';
                    if (array_key_exists('selector-data', $arg) && $arg['selector-data'] == TRUE && $this->render_condition_control($id, $data, $arg)) {
                        if (array_key_exists('selector', $arg)) :
                            foreach ($arg['selector'] as $key => $val) {
                                $key = (strpos($key, '{{KEY}}') ? str_replace('{{KEY}}', explode('saarsa', $id)[1], $key) : $key);
                                if (!empty($val)) {
                                    $class = str_replace('{{WRAPPER}}', $this->CSSWRAPPER, $key);
                                    $file = str_replace('{{VALUE}}', $value, $val);
                                    if (strpos($file, '{{') !== FALSE) :
                                        $file = $this->multiple_selector_handler($data, $file);
                                    endif;
                                    if (!empty($value)) :
                                        $this->CSSDATA[$arg['responsive']][$class][$file] = $file;
                                    endif;
                                }
                                $retun[$key][$key]['type'] = ($val != '' ? 'CSS' : 'HTML');
                                $retun[$key][$key]['value'] = $val;
                            }
                        endif;
                    }
                    $retunvalue = array_key_exists('selector', $arg) ? htmlspecialchars(json_encode($retun)) : '';
                    ?>
                    <div class="shortcode-form-control-input-wrapper">
                        <div class="shortcode-form-choices" responsive="<?php echo esc_attr($arg['responsive']) ?>" retundata='<?php echo esc_attr($retunvalue); ?>'>
                            <?php
                            foreach ($arg['options'] as $key => $val) {
                                ?>
                                <input id="<?php echo esc_attr($id); ?>-<?php echo esc_attr($key); ?>" type="radio" name="<?php echo esc_attr($id); ?>" value="<?php echo esc_html($key); ?>" <?php
                                if ($value == $key):
                                    echo 'checked  ckdflt="true"';
                                endif;
                                ?>>
                                <label class="shortcode-form-choices-label" for="<?php echo esc_attr($id); ?>-<?php echo esc_html($key); ?>" tooltip="<?php echo esc_html($val['title']); ?>">
                                    <?php
                                    if ($operator == 'text'):
                                        echo esc_html($val['title']);
                                    else:
                                        echo '<i class="' . esc_attr($val['icon']) . '" aria-hidden="true"></i>';
                                    endif;
                                    ?>
                                </label>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                }

                /*
                 * Image Hover Style Admin Panel Color Input.
                 *
                 * @since 9.3.0
                 */

                public function render_condition_control($id, array $data = [], array $arg = []) {

                    if (array_key_exists('condition', $arg)) :
                        foreach ($arg['condition'] as $key => $value) {
                            if (array_key_exists('conditional', $arg) && $arg['conditional'] == 'outside') :
                                $data = $this->style;
                            elseif (array_key_exists('conditional', $arg) && $arg['conditional'] == 'inside' && isset($arg['form_condition'])) :
                                $key = $arg['form_condition'] . $key;
                            endif;
                            if (strpos($key, '&') !== FALSE) :
                                return true;
                            endif;
                            if (!array_key_exists($key, $data)) :
                                return false;
                            endif;
                            if ($data[$key] != $value) :
                                if (is_array($value)) :
                                    $t = false;
                                    foreach ($value as $val) {
                                        if ($data[$key] == $val) :
                                            $t = true;
                                        endif;
                                    }
                                    return $t;
                                endif;
                                if ($value == 'EMPTY' && $data[$key] != '0') :
                                    return true;
                                endif;
                                if (strpos($data[$key], '&') !== FALSE) :
                                    return true;
                                endif;
                                return false;
                            endif;
                        }
                    endif;
                    return true;
                }

                public function color_admin_control($id, array $data = [], array $arg = []) {
                    $id = (array_key_exists('repeater', $arg) ? $id . ']' : $id);
                    $value = array_key_exists($id, $data) ? $data[$id] : $arg['default'];
                    $retunvalue = array_key_exists('selector', $arg) ? htmlspecialchars(json_encode($arg['selector'])) : '';
                    if (array_key_exists('selector-data', $arg) && $arg['selector-data'] == TRUE && $arg['render'] == TRUE && $this->render_condition_control($id, $data, $arg)) {
                        if (array_key_exists('selector', $arg)) :
                            foreach ($arg['selector'] as $key => $val) {
                                $key = (strpos($key, '{{KEY}}') ? str_replace('{{KEY}}', explode('saarsa', $id)[1], $key) : $key);
                                $class = str_replace('{{WRAPPER}}', $this->CSSWRAPPER, $key);
                                $file = str_replace('{{VALUE}}', $value, $val);
                                if (!empty($value)) :
                                    $this->CSSDATA[$arg['responsive']][$class][$file] = $file;
                                endif;
                            }
                        endif;
                    }
                    ?>
                    <div class="shortcode-form-control-input-wrapper">
                        <input <?php
                        if (array_key_exists('oparetor', $arg)):
                            echo 'data-format="rgb" data-opacity="TRUE"';
                        endif;
                        ?> type="text"  class="oxi-addons-minicolor" id="<?php echo esc_attr($id); ?>" name="<?php echo esc_attr($id); ?>" value="<?php echo esc_attr($value); ?>" responsive="<?php echo esc_attr($arg['responsive']); ?>" retundata='<?php echo esc_attr($retunvalue); ?>' custom="<?php
                            if (array_key_exists('custom', $arg)):
                                echo esc_attr($arg['custom']);
                            endif;
                            ?>">
                    </div>
                    <?php
                }

                /*
                 * Image Hover Style Admin Panel Icon Selector.
                 *
                 * @since 9.3.0
                 */

                public function icon_admin_control($id, array $data = [], array $arg = []) {
                    $id = (array_key_exists('repeater', $arg) ? $id . ']' : $id);
                    $value = array_key_exists($id, $data) ? $data[$id] : $arg['default'];
                    ?>
                    <div class="shortcode-form-control-input-wrapper">
                        <input type="text"  class="oxi-admin-icon-selector" id="<?php echo esc_attr($id); ?>" name="<?php echo esc_attr($id); ?>" value="<?php echo esc_attr($value); ?>">
                        <span class="input-group-addon"></span>
                    </div>
                    <?php
                }

                /*
                 * Image Hover Style Admin Panel Font Selector.
                 *
                 * @since 9.3.0
                 */

                public function font_admin_control($id, array $data = [], array $arg = []) {
                    $id = (array_key_exists('repeater', $arg) ? $id . ']' : $id);
                    $retunvalue = '';
                    $value = array_key_exists($id, $data) ? $data[$id] : $arg['default'];
                    if ($value != '' && array_key_exists($value, $this->google_font)) :
                        $this->font[$value] = $value;
                    endif;

                    if (array_key_exists('selector-data', $arg) && $arg['selector-data'] == TRUE) {
                        if (array_key_exists('selector', $arg) && $value != '') :
                            foreach ($arg['selector'] as $key => $val) {
                                if ($arg['render'] == TRUE && !empty($val)) :
                                    $key = (strpos($key, '{{KEY}}') ? str_replace('{{KEY}}', explode('saarsa', $id)[1], $key) : $key);
                                    $class = str_replace('{{WRAPPER}}', $this->CSSWRAPPER, $key);
                                    $file = str_replace('{{VALUE}}', str_replace("+", ' ', $value), $val);
                                    if (!empty($value)) :
                                        $this->CSSDATA[$arg['responsive']][$class][$file] = $file;
                                    endif;
                                endif;
                            }
                        endif;
                    }
                    $retunvalue = array_key_exists('selector', $arg) ? htmlspecialchars(json_encode($arg['selector'])) : '';
                    ?>
                    <div class="shortcode-form-control-input-wrapper">
                        <input type="text"  class="shortcode-addons-family" id="<?php echo esc_attr($id); ?>" name="<?php echo esc_attr($id); ?>" value="<?php echo esc_attr($value); ?>" responsive="<?php echo esc_attr($arg['responsive']); ?>" retundata='<?php echo esc_attr($retunvalue); ?>'>
                    </div>
                    <?php
                }

                /*
                 * Image Hover Style Admin Panel Date and Time Selector.
                 *
                 * @since 9.3.0
                 */

                public function date_time_admin_control($id, array $data = [], array $arg = []) {
                    $id = (array_key_exists('repeater', $arg) ? $id . ']' : $id);
                    $value = array_key_exists($id, $data) ? $data[$id] : $arg['default'];
                    $format = 'date';
                    if (array_key_exists('time', $arg)) :
                        if ($arg['time'] == TRUE) :
                            $format = 'datetime-local';
                        endif;
                    endif;
                    ?>
                    <div class="shortcode-form-control-input-wrapper">
                        <input type="<?php echo esc_attr($format); ?>"  id="<?php echo esc_attr($id); ?>" name="<?php echo esc_attr($id); ?>" value="<?php echo esc_attr($value); ?>">
                    </div>
                    <?php
                }

                /*
                 * Image Hover Style Admin Panel Gradient Selector.
                 *
                 * @since 9.3.0
                 */

                public function gradient_admin_control($id, array $data = [], array $arg = []) {
                    $id = (array_key_exists('repeater', $arg) ? $id . ']' : $id);
                    $value = array_key_exists($id, $data) ? $data[$id] : $arg['default'];
                    $retunvalue = array_key_exists('selector', $arg) ? htmlspecialchars(json_encode($arg['selector'])) : '';
                    if (array_key_exists('selector-data', $arg) && $arg['selector-data'] == TRUE) {

                        if (array_key_exists('selector', $arg)) :

                            foreach ($arg['selector'] as $key => $val) {
                                if ($arg['render'] == TRUE) :

                                    $key = (strpos($key, '{{KEY}}') ? str_replace('{{KEY}}', explode('saarsa', $id)[1], $key) : $key);
                                    $class = str_replace('{{WRAPPER}}', $this->CSSWRAPPER, $key);
                                    $file = str_replace('{{VALUE}}', $value, $val);
                                    if (!empty($value)) :

                                        $this->CSSDATA[$arg['responsive']][$class][$file] = $file;
                                    endif;
                                endif;
                            }
                        endif;
                    }
                    $background = (array_key_exists('gradient', $arg) ? $arg['gradient'] : '');
                    ?>
                    <div class="shortcode-form-control-input-wrapper">
                        <input type="text" background="<?php echo esc_attr($background); ?>"  class="oxi-addons-gradient-color" id="<?php echo esc_attr($id); ?>" name="<?php echo esc_attr($id); ?>" value="<?php echo esc_attr($value) ?>" responsive="<?php echo esc_attr($arg['responsive']); ?>" retundata='<?php echo esc_attr($retunvalue); ?>'>
                    </div>
                    <?php
                }

                /*
                 * Image Hover Style Admin Panel Dimensions Selector.
                 *
                 * @since 9.3.0
                 */

                public function dimensions_admin_control($id, array $data = [], array $arg = []) {
                    $unit = array_key_exists($id . '-choices', $data) ? $data[$id . '-choices'] : $arg['default']['unit'];
                    $top = array_key_exists($id . '-top', $data) ? $data[$id . '-top'] : $arg['default']['size'];
                    $bottom = array_key_exists($id . '-bottom', $data) ? $data[$id . '-bottom'] : $top;
                    $left = array_key_exists($id . '-left', $data) ? $data[$id . '-left'] : $top;
                    $right = array_key_exists($id . '-right', $data) ? $data[$id . '-right'] : $top;

                    $retunvalue = array_key_exists('selector', $arg) ? htmlspecialchars(json_encode($arg['selector'])) : '';
                    $ar = [$top, $bottom, $left, $right];
                    $unlink = (count(array_unique($ar)) === 1 ? '' : 'link-dimensions-unlink');
                    if (array_key_exists('selector-data', $arg) && $arg['selector-data'] == TRUE && $arg['render'] == TRUE) {
                        if (array_key_exists('selector', $arg)) :
                            if (isset($top) && isset($right) && isset($bottom) && isset($left)) :
                                foreach ($arg['selector'] as $key => $val) {
                                    $key = (strpos($key, '{{KEY}}') ? str_replace('{{KEY}}', explode('saarsa', $id)[1], $key) : $key);
                                    $class = str_replace('{{WRAPPER}}', $this->CSSWRAPPER, $key);
                                    $file = str_replace('{{UNIT}}', $unit, $val);
                                    $file = str_replace('{{TOP}}', $top, $file);
                                    $file = str_replace('{{RIGHT}}', $right, $file);
                                    $file = str_replace('{{BOTTOM}}', $bottom, $file);
                                    $file = str_replace('{{LEFT}}', $left, $file);
                                    $this->CSSDATA[$arg['responsive']][$class][$file] = $file;
                                }
                            endif;
                        endif;
                    }

                    if (array_key_exists('range', $arg)) :
                        if (count($arg['range']) > 1) :
                            ?>
                            <div class="shortcode-form-units-choices">
                                <?php
                                foreach ($arg['range'] as $key => $val) {
                                    $rand = rand(10000, 233333333);
                                    ?>

                                    <input id="<?php echo esc_attr($id); ?>-choices-<?php echo esc_attr($rand); ?>" type="radio" name="<?php echo esc_attr($id); ?>-choices"  value="<?php echo esc_html($key); ?>" <?php
                                    if ($key == $unit):
                                        echo 'checked';
                                    endif;
                                    ?>  min="<?php echo esc_attr($val['min']); ?>" max="<?php echo esc_attr($val['max']); ?>" step="<?php echo esc_attr($val['step']); ?>">
                                    <label class="shortcode-form-units-choices-label" for="<?php echo esc_attr($id); ?>-choices-<?php echo esc_attr($rand); ?>"><?php echo esc_html($key); ?></label>

                                    <?php
                                }
                                ?>
                            </div>
                            <?php
                        endif;
                    endif;
                    $unitvalue = array_key_exists($id . '-choices', $data) ? 'unit="' . $data[$id . '-choices'] . '"' : '';
                    ?>
                    <div class="shortcode-form-control-input-wrapper">
                        <ul class="shortcode-form-control-dimensions">
                            <li class="shortcode-form-control-dimension">
                                <input id="<?php echo esc_attr($id); ?>-top" input-id="<?php echo esc_attr($id); ?>" name="<?php echo esc_attr($id); ?>-top" type="number"  min="<?php echo esc_attr($arg['range'][$unit]['min']); ?>" max="<?php echo esc_attr($arg['range'][$unit]['max']); ?>" step="<?php echo esc_attr($arg['range'][$unit]['step']); ?>" value="<?php echo esc_attr($top); ?>" default-value="<?php echo esc_attr($top); ?>" <?php echo esc_attr($unitvalue); ?> responsive="<?php echo esc_attr($arg['responsive']); ?>" retundata='<?php echo esc_attr($retunvalue); ?>'>
                                <label for="<?php echo esc_attr($id); ?>-top" class="shortcode-form-control-dimension-label">Top</label>
                            </li>
                            <li class="shortcode-form-control-dimension">
                                <input id="<?php echo esc_attr($id); ?>-right" input-id="<?php echo esc_attr($id); ?>" name="<?php echo esc_attr($id); ?>-right" type="number"  min="<?php echo esc_attr($arg['range'][$unit]['min']); ?>" max="<?php echo esc_attr($arg['range'][$unit]['max']); ?>" step="<?php echo esc_attr($arg['range'][$unit]['step']); ?>" value="<?php echo esc_attr($right); ?>" default-value="<?php echo esc_attr($right); ?>" <?php echo esc_attr($unitvalue); ?> responsive="<?php echo esc_attr($arg['responsive']); ?>" retundata='<?php echo esc_attr($retunvalue); ?>'>
                                <label for="<?php echo esc_attr($id); ?>-right" class="shortcode-form-control-dimension-label">Right</label>
                            </li>
                            <li class="shortcode-form-control-dimension">
                                <input id="<?php echo esc_attr($id); ?>-bottom" input-id="<?php echo esc_attr($id); ?>" name="<?php echo esc_attr($id); ?>-bottom" type="number"  min="<?php echo esc_attr($arg['range'][$unit]['min']); ?>" max="<?php echo esc_attr($arg['range'][$unit]['max']); ?>" step="<?php echo esc_attr($arg['range'][$unit]['step']); ?>" value="<?php echo esc_attr($bottom); ?>" default-value="<?php echo esc_attr($bottom); ?>" <?php echo esc_attr($unitvalue); ?> responsive="<?php echo esc_attr($arg['responsive']); ?>" retundata='<?php echo esc_attr($retunvalue); ?>'>
                                <label for="<?php echo esc_attr($id); ?>-bottom" class="shortcode-form-control-dimension-label">Bottom</label>
                            </li>
                            <li class="shortcode-form-control-dimension">
                                <input id="<?php echo esc_attr($id); ?>-left" input-id="<?php echo esc_attr($id); ?>" name="<?php echo esc_attr($id); ?>-left" type="number"  min="<?php echo esc_attr($arg['range'][$unit]['min']); ?>" max="<?php echo esc_attr($arg['range'][$unit]['max']); ?>" step="<?php echo esc_attr($arg['range'][$unit]['step']); ?>" value="<?php echo esc_attr($left); ?>" default-value="<?php echo esc_attr($left); ?>" <?php echo esc_attr($unitvalue); ?> responsive="<?php echo esc_attr($arg['responsive']); ?>" retundata='<?php echo esc_attr($retunvalue); ?>'>
                                <label for="<?php echo esc_attr($id); ?>-left" class="shortcode-form-control-dimension-label">Left</label>
                            </li>
                            <li class="shortcode-form-control-dimension">
                                <button type="button" class="shortcode-form-link-dimensions <?php echo esc_attr($unlink); ?>"  data-tooltip="Link values together"></button>
                            </li>
                        </ul>
                    </div>
                    <?php
                }

                /*
                 * Image Hover Style Admin Panel Column Size.
                 *
                 * @since 9.3.0
                 * Complete Simple Interface
                 */

                public function column_admin_group_control($id, array $data = [], array $arg = []) {

                    $selector = array_key_exists('selector', $arg) ? $arg['selector'] : '';
                    $select = array_key_exists('selector', $arg) ? 'selector' : '';
                    $cond = $condition = '';
                    if (array_key_exists('condition', $arg)) :
                        $cond = 'condition';
                        $condition = $arg['condition'];
                    endif;
                    $this->add_control(
                            $lap = $id . '-lap',
                            $data,
                            [
                                'label' => esc_html__('Column Size', 'image-hover-effects-ultimate'),
                                'type' => Controls::SELECT,
                                'responsive' => 'laptop',
                                'description' => $arg['description'],
                                'default' => 'oxi-bt-col-lg-12',
                                'options' => [
                                    'oxi-bt-col-lg-12' => esc_html__('Col 1', 'image-hover-effects-ultimate'),
                                    'oxi-bt-col-lg-6' => esc_html__('Col 2', 'image-hover-effects-ultimate'),
                                    'oxi-bt-col-lg-4' => esc_html__('Col 3', 'image-hover-effects-ultimate'),
                                    'oxi-bt-col-lg-3' => esc_html__('Col 4', 'image-hover-effects-ultimate'),
                                    'oxi-bt-col-lg-5' => esc_html__('Col 5', 'image-hover-effects-ultimate'),
                                    'oxi-bt-col-lg-2' => esc_html__('Col 6', 'image-hover-effects-ultimate'),
                                    'oxi-bt-col-lg-7' => esc_html__('Col 7', 'image-hover-effects-ultimate'),
                                    'oxi-bt-col-lg-8' => esc_html__('Col 8', 'image-hover-effects-ultimate'),
                                    'oxi-bt-col-lg-1' => esc_html__('Col 12', 'image-hover-effects-ultimate'),
                                ],
                                'description' => 'Define how much column you want to show into single rows. Customize possible with desktop or tab or mobile Settings.',
                                $select => $selector,
                                'form_condition' => (array_key_exists('form_condition', $arg) ? $arg['form_condition'] : ''),
                                $cond => $condition
                            ]
                    );
                    $this->add_control(
                            $tab = $id . '-tab',
                            $data,
                            [
                                'label' => esc_html__('Column Size', 'image-hover-effects-ultimate'),
                                'type' => Controls::SELECT,
                                'responsive' => 'tab',
                                'default' => 'oxi-bt-col-md-12',
                                'description' => $arg['description'],
                                'options' => [
                                    '' => esc_html__('Default', 'image-hover-effects-ultimate'),
                                    'oxi-bt-col-md-12' => esc_html__('Col 1', 'image-hover-effects-ultimate'),
                                    'oxi-bt-col-md-6' => esc_html__('Col 2', 'image-hover-effects-ultimate'),
                                    'oxi-bt-col-md-4' => esc_html__('Col 3', 'image-hover-effects-ultimate'),
                                    'oxi-bt-col-md-3' => esc_html__('Col 4', 'image-hover-effects-ultimate'),
                                    'oxi-bt-col-md-2' => esc_html__('Col 6', 'image-hover-effects-ultimate'),
                                    'oxi-bt-col-md-1' => esc_html__('Col 12', 'image-hover-effects-ultimate'),
                                ],
                                'description' => 'Define how much column you want to show into single rows. Customize possible with desktop or tab or mobile Settings.',
                                $select => $selector,
                                'form_condition' => (array_key_exists('form_condition', $arg) ? $arg['form_condition'] : ''),
                                $cond => $condition
                            ]
                    );
                    $this->add_control(
                            $mob = $id . '-mob',
                            $data,
                            [
                                'label' => esc_html__('Column Size', 'image-hover-effects-ultimate'),
                                'type' => Controls::SELECT,
                                'default' => 'oxi-bt-col-lg-12',
                                'responsive' => 'mobile',
                                'description' => $arg['description'],
                                'options' => [
                                    '' => esc_html__('Default', 'image-hover-effects-ultimate'),
                                    'oxi-bt-col-sm-12' => esc_html__('Col 1', 'image-hover-effects-ultimate'),
                                    'oxi-bt-col-sm-6' => esc_html__('Col 2', 'image-hover-effects-ultimate'),
                                    'oxi-bt-col-sm-4' => esc_html__('Col 3', 'image-hover-effects-ultimate'),
                                    'oxi-bt-col-sm-3' => esc_html__('Col 4', 'image-hover-effects-ultimate'),
                                    'oxi-bt-col-sm-5' => esc_html__('Col 5', 'image-hover-effects-ultimate'),
                                    'oxi-bt-col-sm-2' => esc_html__('Col 6', 'image-hover-effects-ultimate'),
                                    'oxi-bt-col-sm-1' => esc_html__('Col 12', 'image-hover-effects-ultimate'),
                                ],
                                'description' => 'Define how much column you want to show into single rows. Customize possible with desktop or tab or mobile Settings.',
                                $select => $selector,
                                'form_condition' => (array_key_exists('form_condition', $arg) ? $arg['form_condition'] : ''),
                                $cond => $condition
                            ]
                    );
                }

                /*
                 * Image Hover Style Admin Panel Typography.
                 *
                 * @since 9.3.0
                 * Simple Interface Enable
                 */

                public function typography_admin_group_control($id, array $data = [], array $arg = []) {
                    $cond = $condition = '';
                    if (array_key_exists('condition', $arg)) :
                        $cond = 'condition';
                        $condition = $arg['condition'];
                    endif;

                    $separator = array_key_exists('separator', $arg) ? $arg['separator'] : FALSE;
                    $selector_key = $selector = $selectorvalue = $loader = $loadervalue = '';
                    if (array_key_exists('selector', $arg)) :
                        $selectorvalue = 'selector-value';
                        $selector_key = 'selector';
                        $selector = $arg['selector'];
                    endif;
                    if (array_key_exists('loader', $arg)) :
                        $loader = 'loader';
                        $loadervalue = $arg['loader'];
                    endif;

                    $this->start_popover_control(
                            $id,
                            [
                                'label' => esc_html__('Typography', 'image-hover-effects-ultimate'),
                                $cond => $condition,
                                'form_condition' => (array_key_exists('form_condition', $arg) ? $arg['form_condition'] : ''),
                                'description' => $arg['description'],
                                'separator' => $separator,
                            ]
                    );

                    $this->add_control(
                            $id . '-font',
                            $data,
                            [
                                'label' => esc_html__('Font Family', 'image-hover-effects-ultimate'),
                                'type' => Controls::FONT,
                                $selectorvalue => 'font-family:"{{VALUE}}";',
                                $selector_key => $selector,
                                $loader => $loadervalue
                            ]
                    );
                    $this->add_responsive_control(
                            $id . '-size',
                            $data,
                            [
                                'label' => esc_html__('Size', 'image-hover-effects-ultimate'),
                                'type' => Controls::SLIDER,
                                'default' => [
                                    'unit' => 'px',
                                    'size' => '',
                                ],
                                $loader => $loadervalue,
                                $selectorvalue => 'font-size: {{SIZE}}{{UNIT}};',
                                $selector_key => $selector,
                                'range' => [
                                    'px' => [
                                        'min' => 0,
                                        'max' => 100,
                                        'step' => 1,
                                    ],
                                    'em' => [
                                        'min' => 0,
                                        'max' => 10,
                                        'step' => 0.1,
                                    ],
                                    'rem' => [
                                        'min' => 0,
                                        'max' => 10,
                                        'step' => 0.1,
                                    ],
                                    'vm' => [
                                        'min' => 0,
                                        'max' => 10,
                                        'step' => 0.1,
                                    ],
                                ],
                            ]
                    );
                    $this->add_control(
                            $id . '-weight',
                            $data,
                            [
                                'label' => esc_html__('Weight', 'image-hover-effects-ultimate'),
                                'type' => Controls::SELECT,
                                $selectorvalue => 'font-weight: {{VALUE}};',
                                $loader => $loadervalue,
                                $selector_key => $selector,
                                'options' => [
                                    '100' => esc_html__('100', 'image-hover-effects-ultimate'),
                                    '200' => esc_html__('200', 'image-hover-effects-ultimate'),
                                    '300' => esc_html__('300', 'image-hover-effects-ultimate'),
                                    '400' => esc_html__('400', 'image-hover-effects-ultimate'),
                                    '500' => esc_html__('500', 'image-hover-effects-ultimate'),
                                    '600' => esc_html__('600', 'image-hover-effects-ultimate'),
                                    '700' => esc_html__('700', 'image-hover-effects-ultimate'),
                                    '800' => esc_html__('800', 'image-hover-effects-ultimate'),
                                    '900' => esc_html__('900', 'image-hover-effects-ultimate'),
                                    '' => esc_html__('Default', 'image-hover-effects-ultimate'),
                                    'normal' => esc_html__('Normal', 'image-hover-effects-ultimate'),
                                    'bold' => esc_html__('Bold', 'image-hover-effects-ultimate')
                                ],
                            ]
                    );
                    $this->add_control(
                            $id . '-transform',
                            $data,
                            [
                                'label' => esc_html__('Transform', 'image-hover-effects-ultimate'),
                                'type' => Controls::SELECT,
                                'default' => '',
                                'options' => [
                                    '' => esc_html__('Default', 'image-hover-effects-ultimate'),
                                    'uppercase' => esc_html__('Uppercase', 'image-hover-effects-ultimate'),
                                    'lowercase' => esc_html__('Lowercase', 'image-hover-effects-ultimate'),
                                    'capitalize' => esc_html__('Capitalize', 'image-hover-effects-ultimate'),
                                    'none' => esc_html__('Normal', 'image-hover-effects-ultimate'),
                                ],
                                $loader => $loadervalue,
                                $selectorvalue => 'text-transform: {{VALUE}};',
                                $selector_key => $selector,
                            ]
                    );
                    $this->add_control(
                            $id . '-style',
                            $data,
                            [
                                'label' => esc_html__('Style', 'image-hover-effects-ultimate'),
                                'type' => Controls::SELECT,
                                'default' => '',
                                'options' => [
                                    '' => esc_html__('Default', 'image-hover-effects-ultimate'),
                                    'normal' => esc_html__('normal', 'image-hover-effects-ultimate'),
                                    'italic' => esc_html__('Italic', 'image-hover-effects-ultimate'),
                                    'oblique' => esc_html__('Oblique', 'image-hover-effects-ultimate'),
                                ],
                                $loader => $loadervalue,
                                $selectorvalue => 'font-style: {{VALUE}};',
                                $selector_key => $selector,
                            ]
                    );
                    $this->add_control(
                            $id . '-decoration',
                            $data,
                            [
                                'label' => esc_html__('Decoration', 'image-hover-effects-ultimate'),
                                'type' => Controls::SELECT,
                                'default' => '',
                                'options' => [
                                    '' => esc_html__('Default', 'image-hover-effects-ultimate'),
                                    'underline' => esc_html__('Underline', 'image-hover-effects-ultimate'),
                                    'overline' => esc_html__('Overline', 'image-hover-effects-ultimate'),
                                    'line-through' => esc_html__('Line Through', 'image-hover-effects-ultimate'),
                                    'none' => esc_html__('None', 'image-hover-effects-ultimate'),
                                ],
                                $loader => $loadervalue,
                                $selectorvalue => 'text-decoration: {{VALUE}};',
                                $selector_key => $selector,
                            ]
                    );
                    if (array_key_exists('include', $arg)) :
                        if ($arg['include'] == 'align_normal') :
                            $this->add_responsive_control(
                                    $id . '-align',
                                    $data,
                                    [
                                        'label' => esc_html__('Text Align', 'image-hover-effects-ultimate'),
                                        'type' => Controls::SELECT,
                                        'default' => '',
                                        'options' => [
                                            '' => esc_html__('Default', 'image-hover-effects-ultimate'),
                                            'left' => esc_html__('Left', 'image-hover-effects-ultimate'),
                                            'center' => esc_html__('Center', 'image-hover-effects-ultimate'),
                                            'right' => esc_html__('Right', 'image-hover-effects-ultimate'),
                                        ],
                                        $loader => $loadervalue,
                                        $selectorvalue => 'text-align: {{VALUE}};',
                                        $selector_key => $selector,
                                    ]
                            );
                        else :
                            $this->add_responsive_control(
                                    $id . '-justify',
                                    $data,
                                    [
                                        'label' => esc_html__('Justify Content', 'image-hover-effects-ultimate'),
                                        'type' => Controls::SELECT,
                                        'default' => '',
                                        'options' => [
                                            '' => esc_html__('Default', 'image-hover-effects-ultimate'),
                                            'flex-start' => esc_html__('Flex Start', 'image-hover-effects-ultimate'),
                                            'flex-end' => esc_html__('Flex End', 'image-hover-effects-ultimate'),
                                            'center' => esc_html__('Center', 'image-hover-effects-ultimate'),
                                            'space-around' => esc_html__('Space Around', 'image-hover-effects-ultimate'),
                                            'space-between' => esc_html__('Space Between', 'image-hover-effects-ultimate'),
                                        ],
                                        $loader => $loadervalue,
                                        $selectorvalue => 'justify-content: {{VALUE}};',
                                        $selector_key => $selector,
                                    ]
                            );
                            $this->add_responsive_control(
                                    $id . '-align',
                                    $data,
                                    [
                                        'label' => esc_html__('Align Items', 'image-hover-effects-ultimate'),
                                        'type' => Controls::SELECT,
                                        'default' => '',
                                        'options' => [
                                            '' => esc_html__('Default', 'image-hover-effects-ultimate'),
                                            'stretch' => esc_html__('Stretch', 'image-hover-effects-ultimate'),
                                            'baseline' => esc_html__('Baseline', 'image-hover-effects-ultimate'),
                                            'center' => esc_html__('Center', 'image-hover-effects-ultimate'),
                                            'flex-start' => esc_html__('Flex Start', 'image-hover-effects-ultimate'),
                                            'flex-end' => esc_html__('Flex End', 'image-hover-effects-ultimate'),
                                        ],
                                        $loader => $loadervalue,
                                        $selectorvalue => 'align-items: {{VALUE}};',
                                        $selector_key => $selector,
                                    ]
                            );
                        endif;
                    endif;

                    $this->add_responsive_control(
                            $id . '-l-height',
                            $data,
                            [
                                'label' => esc_html__('Line Height', 'image-hover-effects-ultimate'),
                                'type' => Controls::SLIDER,
                                'default' => [
                                    'unit' => 'px',
                                    'size' => '',
                                ],
                                'range' => [
                                    'px' => [
                                        'min' => 0,
                                        'max' => 100,
                                        'step' => 1,
                                    ],
                                    'em' => [
                                        'min' => 0,
                                        'max' => 10,
                                        'step' => 0.1,
                                    ],
                                ],
                                $loader => $loadervalue,
                                $selectorvalue => 'line-height: {{SIZE}}{{UNIT}};',
                                $selector_key => $selector,
                            ]
                    );
                    $this->add_responsive_control(
                            $id . '-l-spacing',
                            $data,
                            [
                                'label' => esc_html__('Letter Spacing', 'image-hover-effects-ultimate'),
                                'type' => Controls::SLIDER,
                                'default' => [
                                    'unit' => 'px',
                                    'size' => '',
                                ],
                                'range' => [
                                    'px' => [
                                        'min' => 0,
                                        'max' => 100,
                                        'step' => 0.1,
                                    ],
                                    'em' => [
                                        'min' => 0,
                                        'max' => 10,
                                        'step' => 0.01,
                                    ],
                                ],
                                $loader => $loadervalue,
                                $selectorvalue => 'letter-spacing: {{SIZE}}{{UNIT}};',
                                $selector_key => $selector,
                            ]
                    );
                    $this->end_popover_control();
                }

                /*
                 * Image Hover Style Admin Panel Media Group Control.
                 *
                 * @since 9.3.0
                 *
                 * Works at any version
                 */

                public function media_admin_group_control($id, array $data = [], array $arg = []) {
                    $type = array_key_exists('default', $arg) ? $arg['default']['type'] : 'media-library';
                    $value = array_key_exists('default', $arg) ? $arg['default']['link'] : '';
                    $level = array_key_exists('label', $arg) ? $arg['label'] : 'Photo Source';
                    $separator = array_key_exists('separator', $arg) ? $arg['separator'] : FALSE;
                    ?>
                    <div class="shortcode-form-control" style="padding: 0;" <?php $this->forms_condition($arg) ?>>
                        <?php
                        $this->add_control(
                                $id . '-select',
                                $data,
                                [
                                    'label' => esc_html__($level, 'image-hover-effects-ultimate'),
                                    'type' => Controls::CHOOSE,
                                    'loader' => TRUE,
                                    'default' => $type,
                                    'separator' => $separator,
                                    'options' => [
                                        'media-library' => [
                                            'title' => esc_html__('Media Library', 'image-hover-effects-ultimate'),
                                            'icon' => 'fa fa-align-left',
                                        ],
                                        'custom-url' => [
                                            'title' => esc_html__('Custom URL', 'image-hover-effects-ultimate'),
                                            'icon' => 'fa fa-align-center',
                                        ]
                                    ],
                                ]
                        );
                        $this->add_control(
                                $id . '-image',
                                $data,
                                [
                                    'label' => esc_html__('Image', 'image-hover-effects-ultimate'),
                                    'type' => Controls::IMAGE,
                                    'loader' => TRUE,
                                    'default' => $value,
                                    'condition' => [
                                        $id . '-select' => 'media-library',
                                    ],
                                    'simpledescription' => $arg['description'],
                                    'description' => $arg['description'],
                                ]
                        );
                        $this->add_control(
                                $id . '-url',
                                $data,
                                [
                                    'label' => esc_html__('Image URL', 'image-hover-effects-ultimate'),
                                    'type' => Controls::TEXT,
                                    'default' => $value,
                                    'loader' => TRUE,
                                    'placeholder' => 'www.example.com/image.jpg',
                                    'condition' => [
                                        $id . '-select' => 'custom-url',
                                    ],
                                    'simpledescription' => $arg['description'],
                                    'description' => $arg['description'],
                                ]
                        );
                        ?>
                    </div>
                    <?php
                }

                /*
                 * Image Hover Style Admin Panel Box Shadow Control.
                 *
                 * @since 9.3.0
                 * Only Works At Customizable Version
                 */

                public function boxshadow_admin_group_control($id, array $data = [], array $arg = []) {

                    $cond = $condition = $boxshadow = '';
                    $separator = array_key_exists('separator', $arg) ? $arg['separator'] : FALSE;
                    if (array_key_exists('condition', $arg)) :
                        $cond = 'condition';
                        $condition = $arg['condition'];
                    endif;
                    $true = TRUE;
                    $selector_key = $selector = $selectorvalue = $loader = $loadervalue = '';
                    if (!array_key_exists($id . '-shadow', $data)) :
                        $data[$id . '-shadow'] = 'yes';
                    endif;
                    if (!array_key_exists($id . '-blur-size', $data)) :
                        $data[$id . '-blur-size'] = 0;
                    endif;
                    if (!array_key_exists($id . '-horizontal-size', $data)) :
                        $data[$id . '-horizontal-size'] = 0;
                    endif;
                    if (!array_key_exists($id . '-vertical-size', $data)) :
                        $data[$id . '-vertical-size'] = 0;
                    endif;

                    if (array_key_exists($id . '-shadow', $data) && $data[$id . '-shadow'] == 'yes' && array_key_exists($id . '-color', $data) && array_key_exists($id . '-blur-size', $data) && array_key_exists($id . '-spread-size', $data) && array_key_exists($id . '-horizontal-size', $data) && array_key_exists($id . '-vertical-size', $data)) :
                        $true = ($data[$id . '-blur-size'] == 0 || empty($data[$id . '-blur-size'])) && ($data[$id . '-spread-size'] == 0 || empty($data[$id . '-spread-size'])) && ($data[$id . '-horizontal-size'] == 0 || empty($data[$id . '-horizontal-size'])) && ($data[$id . '-vertical-size'] == 0 || empty($data[$id . '-vertical-size'])) ? TRUE : FALSE;
                        $boxshadow = ($true == FALSE ? '-webkit-box-shadow:' . (array_key_exists($id . '-type', $data) ? $data[$id . '-type'] : '') . ' ' . $data[$id . '-horizontal-size'] . 'px ' . $data[$id . '-vertical-size'] . 'px ' . $data[$id . '-blur-size'] . 'px ' . $data[$id . '-spread-size'] . 'px ' . $data[$id . '-color'] . ';' : '');
                        $boxshadow .= ($true == FALSE ? '-moz-box-shadow:' . (array_key_exists($id . '-type', $data) ? $data[$id . '-type'] : '') . ' ' . $data[$id . '-horizontal-size'] . 'px ' . $data[$id . '-vertical-size'] . 'px ' . $data[$id . '-blur-size'] . 'px ' . $data[$id . '-spread-size'] . 'px ' . $data[$id . '-color'] . ';' : '');
                        $boxshadow .= ($true == FALSE ? 'box-shadow:' . (array_key_exists($id . '-type', $data) ? $data[$id . '-type'] : '') . ' ' . $data[$id . '-horizontal-size'] . 'px ' . $data[$id . '-vertical-size'] . 'px ' . $data[$id . '-blur-size'] . 'px ' . $data[$id . '-spread-size'] . 'px ' . $data[$id . '-color'] . ';' : '');
                    endif;

                    if (array_key_exists('selector', $arg)) :
                        $selectorvalue = 'selector-value';
                        $selector_key = 'selector';
                        $selector = $arg['selector'];
                        $boxshadow = array_key_exists($id . '-shadow', $data) && $data[$id . '-shadow'] == 'yes' ? $boxshadow : '';
                        foreach ($arg['selector'] as $key => $val) {
                            $key = (strpos($key, '{{KEY}}') ? str_replace('{{KEY}}', explode('saarsa', $id)[1], $key) : $key);
                            $class = str_replace('{{WRAPPER}}', $this->CSSWRAPPER, $key);
                            $this->CSSDATA['laptop'][$class][$boxshadow] = $boxshadow;
                        }
                    endif;
                    $this->start_popover_control(
                            $id,
                            [
                                'label' => esc_html__('Box Shadow', 'image-hover-effects-ultimate'),
                                $cond => $condition,
                                'form_condition' => (array_key_exists('form_condition', $arg) ? $arg['form_condition'] : ''),
                                'separator' => $separator,
                                'description' => $arg['description'],
                            ]
                    );
                    $this->add_control(
                            $id . '-shadow',
                            $data,
                            [
                                'label' => esc_html__('Shadow', 'image-hover-effects-ultimate'),
                                'type' => Controls::SWITCHER,
                                'default' => '',
                                'label_on' => esc_html__('Yes', 'image-hover-effects-ultimate'),
                                'label_off' => esc_html__('None', 'image-hover-effects-ultimate'),
                                'return_value' => 'yes',
                            ]
                    );
                    $this->add_control(
                            $id . '-type',
                            $data,
                            [
                                'label' => esc_html__('Type', 'image-hover-effects-ultimate'),
                                'type' => Controls::CHOOSE,
                                'default' => '',
                                'options' => [
                                    '' => [
                                        'title' => esc_html__('Outline', 'image-hover-effects-ultimate'),
                                        'icon' => 'fa fa-align-left',
                                    ],
                                    'inset' => [
                                        'title' => esc_html__('Inset', 'image-hover-effects-ultimate'),
                                        'icon' => 'fa fa-align-center',
                                    ],
                                ],
                                'condition' => [$id . '-shadow' => 'yes']
                            ]
                    );

                    $this->add_control(
                            $id . '-horizontal',
                            $data,
                            [
                                'label' => esc_html__('Horizontal', 'image-hover-effects-ultimate'),
                                'type' => Controls::SLIDER,
                                'default' => [
                                    'unit' => 'px',
                                    'size' => 0,
                                ],
                                'range' => [
                                    'px' => [
                                        'min' => -50,
                                        'max' => 100,
                                        'step' => 1,
                                    ],
                                ],
                                'custom' => $id . '|||||box-shadow',
                                $selectorvalue => '{{VALUE}}',
                                $selector_key => $selector,
                                'render' => FALSE,
                                'condition' => [$id . '-shadow' => 'yes']
                            ]
                    );
                    $this->add_control(
                            $id . '-vertical',
                            $data,
                            [
                                'label' => esc_html__('Vertical', 'image-hover-effects-ultimate'),
                                'type' => Controls::SLIDER,
                                'default' => [
                                    'unit' => 'px',
                                    'size' => 0,
                                ],
                                'range' => [
                                    'px' => [
                                        'min' => -50,
                                        'max' => 100,
                                        'step' => 1,
                                    ],
                                ],
                                'custom' => $id . '|||||box-shadow',
                                $selectorvalue => '{{VALUE}}',
                                $selector_key => $selector,
                                'render' => FALSE,
                                'condition' => [$id . '-shadow' => 'yes']
                            ]
                    );
                    $this->add_control(
                            $id . '-blur',
                            $data,
                            [
                                'label' => esc_html__('Blur', 'image-hover-effects-ultimate'),
                                'type' => Controls::SLIDER,
                                'default' => [
                                    'unit' => 'px',
                                    'size' => 0,
                                ],
                                'range' => [
                                    'px' => [
                                        'min' => 0,
                                        'max' => 100,
                                        'step' => 1,
                                    ],
                                ],
                                'custom' => $id . '|||||box-shadow',
                                $selectorvalue => '{{VALUE}}',
                                $selector_key => $selector,
                                'render' => FALSE,
                                'condition' => [$id . '-shadow' => 'yes']
                            ]
                    );
                    $this->add_control(
                            $id . '-spread',
                            $data,
                            [
                                'label' => esc_html__('Spread', 'image-hover-effects-ultimate'),
                                'type' => Controls::SLIDER,
                                'default' => [
                                    'unit' => 'px',
                                    'size' => 0,
                                ],
                                'range' => [
                                    'px' => [
                                        'min' => -50,
                                        'max' => 100,
                                        'step' => 1,
                                    ],
                                ],
                                'custom' => $id . '|||||box-shadow',
                                $selectorvalue => '{{VALUE}}',
                                $selector_key => $selector,
                                'render' => FALSE,
                                'condition' => [$id . '-shadow' => 'yes']
                            ]
                    );
                    $this->add_control(
                            $id . '-color',
                            $data,
                            [
                                'label' => esc_html__('Color', 'image-hover-effects-ultimate'),
                                'separator' => TRUE,
                                'type' => Controls::COLOR,
                                'oparetor' => 'RGB',
                                'default' => '#CCC',
                                'custom' => $id . '|||||box-shadow',
                                $selectorvalue => '{{VALUE}}',
                                $selector_key => $selector,
                                'render' => FALSE,
                                'condition' => [$id . '-shadow' => 'yes']
                            ]
                    );
                    $this->end_popover_control();
                }

                /*
                 * Image Hover Style Admin Panel Text Shadow .
                 *
                 * @since 9.3.0
                 * Only Works at Customizable Options
                 */

                public function textshadow_admin_group_control($id, array $data = [], array $arg = []) {

                    $separator = array_key_exists('separator', $arg) ? $arg['separator'] : FALSE;
                    $cond = $condition = $textshadow = '';
                    if (array_key_exists('condition', $arg)) :
                        $cond = 'condition';
                        $condition = $arg['condition'];
                    endif;
                    $true = TRUE;
                    $selector_key = $selector = $selectorvalue = $loader = $loadervalue = '';
                    if (array_key_exists($id . '-color', $data) && array_key_exists($id . '-blur-size', $data) && array_key_exists($id . '-horizontal-size', $data) && array_key_exists($id . '-vertical-size', $data)) :
                        $true = ($data[$id . '-blur-size'] == 0 || empty($data[$id . '-blur-size'])) && ($data[$id . '-horizontal-size'] == 0 || empty($data[$id . '-horizontal-size'])) && ($data[$id . '-vertical-size'] == 0 || empty($data[$id . '-vertical-size'])) ? TRUE : FALSE;
                        $textshadow = ($true == FALSE ? 'text-shadow: ' . $data[$id . '-horizontal-size'] . 'px ' . $data[$id . '-vertical-size'] . 'px ' . $data[$id . '-blur-size'] . 'px ' . $data[$id . '-color'] . ';' : '');
                    endif;
                    if (array_key_exists('selector', $arg)) :
                        $selectorvalue = 'selector-value';
                        $selector_key = 'selector';
                        $selector = $arg['selector'];
                        foreach ($arg['selector'] as $key => $val) {
                            $key = (strpos($key, '{{KEY}}') ? str_replace('{{KEY}}', explode('saarsa', $id)[1], $key) : $key);
                            $class = str_replace('{{WRAPPER}}', $this->CSSWRAPPER, $key);
                            $this->CSSDATA['laptop'][$class][$textshadow] = $textshadow;
                        }
                    endif;
                    $this->start_popover_control(
                            $id,
                            [
                                'label' => esc_html__('Text Shadow', 'image-hover-effects-ultimate'),
                                $cond => $condition,
                                'form_condition' => (array_key_exists('form_condition', $arg) ? $arg['form_condition'] : ''),
                                'separator' => $separator,
                                'description' => $arg['description'],
                            ]
                    );
                    $this->add_control(
                            $id . '-color',
                            $data,
                            [
                                'label' => esc_html__('Color', 'image-hover-effects-ultimate'),
                                'type' => Controls::COLOR,
                                'oparetor' => 'RGB',
                                'default' => '#FFF',
                                'custom' => $id . '|||||text-shadow',
                                $selectorvalue => '{{VALUE}}',
                                $selector_key => $selector,
                                'render' => FALSE,
                            ]
                    );
                    $this->add_control(
                            $id . '-blur',
                            $data,
                            [
                                'label' => esc_html__('Blur', 'image-hover-effects-ultimate'),
                                'type' => Controls::SLIDER,
                                'separator' => TRUE,
                                'custom' => $id . '|||||text-shadow',
                                'render' => FALSE,
                                'default' => [
                                    'unit' => 'px',
                                    'size' => 0,
                                ],
                                'range' => [
                                    'px' => [
                                        'min' => -50,
                                        'max' => 100,
                                        'step' => 1,
                                    ],
                                ],
                                $selectorvalue => '{{VALUE}}',
                                $selector_key => $selector
                            ]
                    );
                    $this->add_control(
                            $id . '-horizontal',
                            $data,
                            [
                                'label' => esc_html__('Horizontal', 'image-hover-effects-ultimate'),
                                'type' => Controls::SLIDER,
                                'custom' => $id . '|||||text-shadow',
                                'render' => FALSE,
                                'default' => [
                                    'unit' => 'px',
                                    'size' => 0,
                                ],
                                'range' => [
                                    'px' => [
                                        'min' => -50,
                                        'max' => 100,
                                        'step' => 1,
                                    ],
                                ],
                                $selectorvalue => '{{VALUE}}',
                                $selector_key => $selector
                            ]
                    );
                    $this->add_control(
                            $id . '-vertical',
                            $data,
                            [
                                'label' => esc_html__('Vertical', 'image-hover-effects-ultimate'),
                                'type' => Controls::SLIDER,
                                'custom' => $id . '|||||text-shadow',
                                'render' => FALSE,
                                'default' => [
                                    'unit' => 'px',
                                    'size' => 0,
                                ],
                                'range' => [
                                    'px' => [
                                        'min' => -50,
                                        'max' => 100,
                                        'step' => 1,
                                    ],
                                ],
                                $selectorvalue => '{{VALUE}}',
                                $selector_key => $selector
                            ]
                    );

                    $this->end_popover_control();
                }

                /*
                 * Image Hover Style Admin Panel Text Shadow .
                 *
                 * @since 9.3.0
                 *
                 * Simple Interface Enable
                 */

                public function animation_admin_group_control($id, array $data = [], array $arg = []) {
                    $cond = $condition = '';
                    if (array_key_exists('condition', $arg)) :
                        $cond = 'condition';
                        $condition = $arg['condition'];
                    endif;
                    $separator = array_key_exists('separator', $arg) ? $arg['separator'] : FALSE;

                    $this->start_popover_control(
                            $id,
                            [
                                'label' => esc_html__('Animation', 'image-hover-effects-ultimate'),
                                $cond => $condition,
                                'form_condition' => (array_key_exists('form_condition', $arg) ? $arg['form_condition'] : ''),
                                'separator' => $separator,
                                'simpledescription' => 'Customize how long your animation will works',
                                'description' => 'Customize animation with animation type, Animation Duration with Delay and Looping Options',
                            ]
                    );
                    $this->add_control(
                            $id . '-type',
                            $data,
                            [
                                'label' => esc_html__('Type', 'image-hover-effects-ultimate'),
                                'type' => Controls::SELECT,
                                'default' => '',
                                'options' => [
                                    'optgroup0' => [true, 'Attention Seekers'],
                                    '' => esc_html__('None', 'image-hover-effects-ultimate'),
                                    'optgroup1' => [false],
                                    'optgroup2' => [true, 'Attention Seekers'],
                                    'bounce' => esc_html__('Bounce', 'image-hover-effects-ultimate'),
                                    'flash' => esc_html__('Flash', 'image-hover-effects-ultimate'),
                                    'pulse' => esc_html__('Pulse', 'image-hover-effects-ultimate'),
                                    'rubberBand' => esc_html__('RubberBand', 'image-hover-effects-ultimate'),
                                    'shake' => esc_html__('Shake', 'image-hover-effects-ultimate'),
                                    'swing' => esc_html__('Swing', 'image-hover-effects-ultimate'),
                                    'tada' => esc_html__('Tada', 'image-hover-effects-ultimate'),
                                    'wobble' => esc_html__('Wobble', 'image-hover-effects-ultimate'),
                                    'jello' => esc_html__('Jello', 'image-hover-effects-ultimate'),
                                    'optgroup3' => [false],
                                    'optgroup4' => [true, 'Bouncing Entrances'],
                                    'bounceIn' => esc_html__('BounceIn', 'image-hover-effects-ultimate'),
                                    'bounceInDown' => esc_html__('BounceInDown', 'image-hover-effects-ultimate'),
                                    'bounceInLeft' => esc_html__('BounceInLeft', 'image-hover-effects-ultimate'),
                                    'bounceInRight' => esc_html__('BounceInRight', 'image-hover-effects-ultimate'),
                                    'bounceInUp' => esc_html__('BounceInUp', 'image-hover-effects-ultimate'),
                                    'optgroup5' => [false],
                                    'optgroup6' => [true, 'Fading Entrances'],
                                    'fadeIn' => esc_html__('FadeIn', 'image-hover-effects-ultimate'),
                                    'fadeInDown' => esc_html__('FadeInDown', 'image-hover-effects-ultimate'),
                                    'fadeInDownBig' => esc_html__('FadeInDownBig', 'image-hover-effects-ultimate'),
                                    'fadeInLeft' => esc_html__('FadeInLeft', 'image-hover-effects-ultimate'),
                                    'fadeInLeftBig' => esc_html__('FadeInLeftBig', 'image-hover-effects-ultimate'),
                                    'fadeInRight' => esc_html__('FadeInRight', 'image-hover-effects-ultimate'),
                                    'fadeInRightBig' => esc_html__('FadeInRightBig', 'image-hover-effects-ultimate'),
                                    'fadeInUp' => esc_html__('FadeInUp', 'image-hover-effects-ultimate'),
                                    'fadeInUpBig' => esc_html__('FadeInUpBig', 'image-hover-effects-ultimate'),
                                    'optgroup7' => [false],
                                    'optgroup8' => [true, 'Flippers'],
                                    'flip' => esc_html__('Flip', 'image-hover-effects-ultimate'),
                                    'flipInX' => esc_html__('FlipInX', 'image-hover-effects-ultimate'),
                                    'flipInY' => esc_html__('FlipInY', 'image-hover-effects-ultimate'),
                                    'optgroup9' => [false],
                                    'optgroup10' => [true, 'Lightspeed'],
                                    'lightSpeedIn' => esc_html__('LightSpeedIn', 'image-hover-effects-ultimate'),
                                    'optgroup11' => [false],
                                    'optgroup12' => [true, 'Rotating Entrances'],
                                    'rotateIn' => esc_html__('RotateIn', 'image-hover-effects-ultimate'),
                                    'rotateInDownLeft' => esc_html__('RotateInDownLeft', 'image-hover-effects-ultimate'),
                                    'rotateInDownRight' => esc_html__('RotateInDownRight', 'image-hover-effects-ultimate'),
                                    'rotateInUpLeft' => esc_html__('RotateInUpLeft', 'image-hover-effects-ultimate'),
                                    'rotateInUpRight' => esc_html__('RotateInUpRight', 'image-hover-effects-ultimate'),
                                    'optgroup13' => [false],
                                    'optgroup14' => [true, 'Sliding Entrances'],
                                    'slideInUp' => esc_html__('SlideInUp', 'image-hover-effects-ultimate'),
                                    'slideInDown' => esc_html__('SlideInDown', 'image-hover-effects-ultimate'),
                                    'slideInLeft' => esc_html__('SlideInLeft', 'image-hover-effects-ultimate'),
                                    'slideInRight' => esc_html__('SlideInRight', 'image-hover-effects-ultimate'),
                                    'optgroup15' => [false],
                                    'optgroup16' => [true, 'Zoom Entrances'],
                                    'zoomIn' => esc_html__('ZoomIn', 'image-hover-effects-ultimate'),
                                    'zoomInDown' => esc_html__('ZoomInDown', 'image-hover-effects-ultimate'),
                                    'zoomInLeft' => esc_html__('ZoomInLeft', 'image-hover-effects-ultimate'),
                                    'zoomInRight' => esc_html__('ZoomInRight', 'image-hover-effects-ultimate'),
                                    'zoomInUp' => esc_html__('ZoomInUp', 'image-hover-effects-ultimate'),
                                    'optgroup17' => [false],
                                    'optgroup18' => [true, 'Specials'],
                                    'hinge' => esc_html__('Hinge', 'image-hover-effects-ultimate'),
                                    'rollIn' => esc_html__('RollIn', 'image-hover-effects-ultimate'),
                                    'optgroup19' => [false],
                                ],
                            ]
                    );
                    $this->add_control(
                            $id . '-duration',
                            $data,
                            [
                                'label' => esc_html__('Duration (ms)', 'image-hover-effects-ultimate'),
                                'type' => Controls::SLIDER,
                                'default' => [
                                    'unit' => 'px',
                                    'size' => 1000,
                                ],
                                'range' => [
                                    'px' => [
                                        'min' => 00,
                                        'max' => 10000,
                                        'step' => 100,
                                    ],
                                ],
                                'condition' => [
                                    $id . '-type' => 'EMPTY',
                                ],
                            ]
                    );
                    $this->add_control(
                            $id . '-delay',
                            $data,
                            [
                                'label' => esc_html__('Delay (ms)', 'image-hover-effects-ultimate'),
                                'type' => Controls::SLIDER,
                                'default' => [
                                    'unit' => 'px',
                                    'size' => 0,
                                ],
                                'range' => [
                                    'px' => [
                                        'min' => 00,
                                        'max' => 10000,
                                        'step' => 100,
                                    ],
                                ],
                                'condition' => [
                                    $id . '-type' => 'EMPTY',
                                ],
                            ]
                    );
                    $this->add_control(
                            $id . '-offset',
                            $data,
                            [
                                'label' => esc_html__('Offset', 'image-hover-effects-ultimate'),
                                'type' => Controls::SLIDER,
                                'default' => [
                                    'unit' => 'px',
                                    'size' => 100,
                                ],
                                'range' => [
                                    'px' => [
                                        'min' => 0,
                                        'max' => 100,
                                        'step' => 1,
                                    ],
                                ],
                                'condition' => [
                                    $id . '-type' => 'EMPTY',
                                ],
                            ]
                    );
                    $this->add_control(
                            $id . '-looping',
                            $data,
                            [
                                'label' => esc_html__('Looping', 'image-hover-effects-ultimate'),
                                'type' => Controls::SWITCHER,
                                'default' => '',
                                'loader' => TRUE,
                                'label_on' => esc_html__('Yes', 'image-hover-effects-ultimate'),
                                'label_off' => esc_html__('No', 'image-hover-effects-ultimate'),
                                'return_value' => 'yes',
                                'condition' => [
                                    $id . '-type' => 'EMPTY',
                                ],
                            ]
                    );
                    $this->end_popover_control();
                }

                /*
                 * Image Hover Style Admin Panel Border .
                 *
                 * @since 9.3.0
                 * Complete Simple Version
                 */

                public function border_admin_group_control($id, array $data = [], array $arg = []) {
                    $cond = $condition = '';
                    if (array_key_exists('condition', $arg)) :
                        $cond = 'condition';
                        $condition = $arg['condition'];
                    endif;
                    $separator = array_key_exists('separator', $arg) ? $arg['separator'] : FALSE;
                    $selector_key = $selector = $selectorvalue = $loader = $loadervalue = $render = '';
                    if (array_key_exists('selector', $arg)) :
                        $selectorvalue = 'selector-value';
                        $selector_key = 'selector';
                        $selector = $arg['selector'];
                    endif;
                    if (array_key_exists('loader', $arg)) :
                        $loader = 'loader';
                        $loadervalue = $arg['loader'];
                    endif;
                    if (array_key_exists($id . '-type', $data) && $data[$id . '-type'] == '') :
                        $render = 'render';
                    endif;

                    $this->start_popover_control(
                            $id,
                            [
                                'label' => esc_html__('Border', 'image-hover-effects-ultimate'),
                                $cond => $condition,
                                'form_condition' => (array_key_exists('form_condition', $arg) ? $arg['form_condition'] : ''),
                                'separator' => $separator,
                                'description' => $arg['description'],
                            ]
                    );
                    $this->add_control(
                            $id . '-type',
                            $data,
                            [
                                'label' => esc_html__('Type', 'image-hover-effects-ultimate'),
                                'type' => Controls::SELECT,
                                'default' => '',
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
                                $loader => $loadervalue,
                                $selectorvalue => 'border-style: {{VALUE}};',
                                $selector_key => $selector,
                            ]
                    );
                    $this->add_responsive_control(
                            $id . '-width',
                            $data,
                            [
                                'label' => esc_html__('Width', 'image-hover-effects-ultimate'),
                                'type' => Controls::DIMENSIONS,
                                $render => FALSE,
                                'default' => [
                                    'unit' => 'px',
                                    'size' => '',
                                ],
                                'range' => [
                                    'px' => [
                                        'min' => -100,
                                        'max' => 100,
                                        'step' => 1,
                                    ],
                                    'em' => [
                                        'min' => 0,
                                        'max' => 10,
                                        'step' => 0.01,
                                    ],
                                ],
                                'condition' => [
                                    $id . '-type' => 'EMPTY',
                                ],
                                $loader => $loadervalue,
                                $selectorvalue => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                $selector_key => $selector,
                            ]
                    );
                    $this->add_control(
                            $id . '-color',
                            $data,
                            [
                                'label' => esc_html__('Color', 'image-hover-effects-ultimate'),
                                'type' => Controls::COLOR,
                                $render => FALSE,
                                'default' => '',
                                $loader => $loadervalue,
                                $selectorvalue => 'border-color: {{VALUE}};',
                                $selector_key => $selector,
                                'condition' => [
                                    $id . '-type' => 'EMPTY',
                                ],
                            ]
                    );
                    $this->end_popover_control();
                }

                /*
                 * Image Hover Style Admin Panel Background .
                 *
                 * @since 9.3.0
                 * Simple Interface Enable
                 */

                public function background_admin_group_control($id, array $data = [], array $arg = []) {

                    $backround = '';
                    $render = FALSE;
                    if (array_key_exists($id . '-color', $data)) :
                        $color = $data[$id . '-color'];
                        if (array_key_exists($id . '-img', $data) && $data[$id . '-img'] == 'yes') :
                            if (strpos(strtolower($color), 'gradient') === FALSE) :
                                $color = 'linear-gradient(0deg, ' . $color . ' 0%, ' . $color . ' 100%)';
                            endif;
                            if ($data[$id . '-select'] == 'media-library') :
                                $backround .= 'background: ' . $color . ', url(\'' . $data[$id . '-image'] . '\') ' . $data[$id . '-repeat'] . ' ' . $data[$id . '-position'] . ';';
                            else :
                                $backround .= 'background: ' . $color . ', url(\'' . $data[$id . '-url'] . '\') ' . $data[$id . '-repeat'] . ' ' . $data[$id . '-position'] . ';';
                            endif;
                        else :
                            $backround .= 'background: ' . $color . ';';
                        endif;
                    endif;
                    if (array_key_exists('selector', $arg)) :
                        foreach ($arg['selector'] as $key => $val) {
                            $key = (strpos($key, '{{KEY}}') ? str_replace('{{KEY}}', explode('saarsa', $id)[1], $key) : $key);
                            $class = str_replace('{{WRAPPER}}', $this->CSSWRAPPER, $key);
                            $this->CSSDATA['laptop'][$class][$backround] = $backround;
                            $render = TRUE;
                        }
                    endif;

                    $selector_key = $selector = $selectorvalue = $loader = $loadervalue = '';
                    if (array_key_exists('selector', $arg)) :
                        $selectorvalue = 'selector-value';
                        $selector_key = 'selector';
                        $selector = $arg['selector'];
                    endif;
                    if (array_key_exists('loader', $arg)) :
                        $loader = 'loader';
                        $loadervalue = $arg['loader'];
                    endif;
                    $separator = array_key_exists('separator', $arg) ? $arg['separator'] : FALSE;
                    $this->start_popover_control(
                            $id,
                            [
                                'label' => esc_html__('Background', 'image-hover-effects-ultimate'),
                                'condition' => array_key_exists('condition', $arg) ? $arg['condition'] : '',
                                'form_condition' => (array_key_exists('form_condition', $arg) ? $arg['form_condition'] : ''),
                                'separator' => $separator,
                                'simpledescription' => $arg['simpledescription'],
                                'description' => $arg['description'],
                            ]
                    );
                    $this->add_control(
                            $id . '-color',
                            $data,
                            [
                                'label' => esc_html__('Color', 'image-hover-effects-ultimate'),
                                'type' => Controls::GRADIENT,
                                'gradient' => $id,
                                'oparetor' => 'RGB',
                                'render' => FALSE,
                                $selectorvalue => '',
                                $selector_key => $selector,
                            ]
                    );

                    $this->add_control(
                            $id . '-img',
                            $data,
                            [
                                'label' => esc_html__('Image', 'image-hover-effects-ultimate'),
                                'type' => Controls::SWITCHER,
                                'loader' => TRUE,
                                'label_on' => esc_html__('Yes', 'image-hover-effects-ultimate'),
                                'label_off' => esc_html__('No', 'image-hover-effects-ultimate'),
                                'return_value' => 'yes',
                            ]
                    );
                    $this->add_control(
                            $id . '-select',
                            $data,
                            [
                                'label' => esc_html__('Photo Source', 'image-hover-effects-ultimate'),
                                'separator' => TRUE,
                                'loader' => TRUE,
                                'type' => Controls::CHOOSE,
                                'default' => 'media-library',
                                'options' => [
                                    'media-library' => [
                                        'title' => esc_html__('Media Library', 'image-hover-effects-ultimate'),
                                        'icon' => 'fa fa-align-left',
                                    ],
                                    'custom-url' => [
                                        'title' => esc_html__('Custom URL', 'image-hover-effects-ultimate'),
                                        'icon' => 'fa fa-align-center',
                                    ]
                                ],
                                'condition' => [
                                    $id . '-img' => 'yes',
                                ],
                            ]
                    );
                    $this->add_control(
                            $id . '-image',
                            $data,
                            [
                                'label' => esc_html__('Image', 'image-hover-effects-ultimate'),
                                'type' => Controls::IMAGE,
                                'default' => '',
                                'loader' => TRUE,
                                'condition' => [
                                    $id . '-select' => 'media-library',
                                    $id . '-img' => 'yes',
                                ],
                            ]
                    );
                    $this->add_control(
                            $id . '-url',
                            $data,
                            [
                                'label' => esc_html__('Image URL', 'image-hover-effects-ultimate'),
                                'type' => Controls::TEXT,
                                'default' => '',
                                'loader' => TRUE,
                                'placeholder' => 'www.example.com/image.jpg',
                                'condition' => [
                                    $id . '-select' => 'custom-url',
                                    $id . '-img' => 'yes',
                                ],
                            ]
                    );
                    $this->add_control(
                            $id . '-position',
                            $data,
                            [
                                'label' => esc_html__('Position', 'image-hover-effects-ultimate'),
                                'type' => Controls::SELECT,
                                'default' => 'center center',
                                'render' => $render,
                                'options' => [
                                    '' => esc_html__('Default', 'image-hover-effects-ultimate'),
                                    'top left' => esc_html__('Top Left', 'image-hover-effects-ultimate'),
                                    'top center' => esc_html__('Top Center', 'image-hover-effects-ultimate'),
                                    'top right' => esc_html__('Top Right', 'image-hover-effects-ultimate'),
                                    'center left' => esc_html__('Center Left', 'image-hover-effects-ultimate'),
                                    'center center' => esc_html__('Center Center', 'image-hover-effects-ultimate'),
                                    'center right' => esc_html__('Center Right', 'image-hover-effects-ultimate'),
                                    'bottom left' => esc_html__('Bottom Left', 'image-hover-effects-ultimate'),
                                    'bottom center' => esc_html__('Bottom Center', 'image-hover-effects-ultimate'),
                                    'bottom right' => esc_html__('Bottom Right', 'image-hover-effects-ultimate'),
                                ],
                                'loader' => TRUE,
                                'condition' => [
                                    $id . '-img' => 'yes',
                                    '((' . $id . '-select === \'media-library\' && ' . $id . '-image !== \'\') || (' . $id . '-select === \'custom-url\' && ' . $id . '-url !== \'\'))' => 'COMPILED',
                                ],
                            ]
                    );
                    $this->add_control(
                            $id . '-attachment',
                            $data,
                            [
                                'label' => esc_html__('Attachment', 'image-hover-effects-ultimate'),
                                'type' => Controls::SELECT,
                                'default' => '',
                                'render' => $render,
                                'options' => [
                                    '' => esc_html__('Default', 'image-hover-effects-ultimate'),
                                    'scroll' => esc_html__('Scroll', 'image-hover-effects-ultimate'),
                                    'fixed' => esc_html__('Fixed', 'image-hover-effects-ultimate'),
                                ],
                                $loader => $loadervalue,
                                $selectorvalue => 'background-attachment: {{VALUE}};',
                                $selector_key => $selector,
                                'condition' => [
                                    $id . '-img' => 'yes',
                                    '((' . $id . '-select === \'media-library\' && ' . $id . '-image !== \'\') || (' . $id . '-select === \'custom-url\' && ' . $id . '-url !== \'\'))' => 'COMPILED',
                                ],
                            ]
                    );
                    $this->add_control(
                            $id . '-repeat',
                            $data,
                            [
                                'label' => esc_html__('Repeat', 'image-hover-effects-ultimate'),
                                'type' => Controls::SELECT,
                                'default' => 'no-repeat',
                                'render' => $render,
                                'options' => [
                                    '' => esc_html__('Default', 'image-hover-effects-ultimate'),
                                    'no-repeat' => esc_html__('No-Repeat', 'image-hover-effects-ultimate'),
                                    'repeat' => esc_html__('Repeat', 'image-hover-effects-ultimate'),
                                    'repeat-x' => esc_html__('Repeat-x', 'image-hover-effects-ultimate'),
                                    'repeat-y' => esc_html__('Repeat-y', 'image-hover-effects-ultimate'),
                                ],
                                'loader' => TRUE,
                                'condition' => [
                                    $id . '-img' => 'yes',
                                    '((' . $id . '-select === \'media-library\' && ' . $id . '-image !== \'\') || (' . $id . '-select === \'custom-url\' && ' . $id . '-url !== \'\'))' => 'COMPILED',
                                ],
                            ]
                    );
                    $this->add_responsive_control(
                            $id . '-size',
                            $data,
                            [
                                'label' => esc_html__('Size', 'image-hover-effects-ultimate'),
                                'type' => Controls::SELECT,
                                'default' => 'cover',
                                'render' => $render,
                                'options' => [
                                    '' => esc_html__('Default', 'image-hover-effects-ultimate'),
                                    'auto' => esc_html__('Auto', 'image-hover-effects-ultimate'),
                                    'cover' => esc_html__('Cover', 'image-hover-effects-ultimate'),
                                    'contain' => esc_html__('Contain', 'image-hover-effects-ultimate'),
                                ],
                                $loader => $loadervalue,
                                $selectorvalue => 'background-size: {{VALUE}};',
                                $selector_key => $selector,
                                'condition' => [
                                    $id . '-img' => 'yes',
                                    '((' . $id . '-select === \'media-library\' && ' . $id . '-image !== \'\') || (' . $id . '-select === \'custom-url\' && ' . $id . '-url !== \'\'))' => 'COMPILED',
                                ],
                            ]
                    );
                    $this->end_popover_control();
                }

                /*
                 * Image Hover Style Admin Panel Background .
                 *
                 * @since 9.3.0
                 * Simple Interfaece Enable
                 */

                public function url_admin_group_control($id, array $data = [], array $arg = []) {
                    if (array_key_exists('condition', $arg)) :
                        $cond = 'condition';
                        $condition = $arg['condition'];
                    else :
                        $cond = $condition = '';
                    endif;
                    $form_condition = array_key_exists('form_condition', $arg) ? $arg['form_condition'] : '';
                    $separator = array_key_exists('separator', $arg) ? $arg['separator'] : FALSE;
                    $this->add_control(
                            $id . '-url',
                            $data,
                            [
                                'label' => esc_html__('Link', 'image-hover-effects-ultimate'),
                                'type' => Controls::TEXT,
                                'link' => TRUE,
                                'separator' => $separator,
                                'placeholder' => 'http://www.example.com/',
                                'form_condition' => (array_key_exists('form_condition', $arg) ? $arg['form_condition'] : ''),
                                $cond => $condition
                            ]
                    );
                    ?>
                    <div class="shortcode-form-control-content shortcode-form-control-content-popover-body">
                        <?php
                        $this->add_control(
                                $id . '-target',
                                $data,
                                [
                                    'label' => esc_html__('New Window?', 'image-hover-effects-ultimate'),
                                    'type' => Controls::SWITCHER,
                                    'default' => '',
                                    'label_on' => esc_html__('Yes', 'image-hover-effects-ultimate'),
                                    'label_off' => esc_html__('No', 'image-hover-effects-ultimate'),
                                    'return_value' => 'yes',
                                ]
                        );
                        $this->add_control(
                                $id . '-follow',
                                $data,
                                [
                                    'label' => esc_html__('No Follow', 'image-hover-effects-ultimate'),
                                    'type' => Controls::SWITCHER,
                                    'default' => '',
                                    'label_on' => esc_html__('Yes', 'image-hover-effects-ultimate'),
                                    'label_off' => esc_html__('No', 'image-hover-effects-ultimate'),
                                    'return_value' => 'yes',
                                ]
                        );
                        $this->add_control(
                                $id . '-id',
                                $data,
                                [
                                    'label' => esc_html__('CSS ID', 'image-hover-effects-ultimate'),
                                    'type' => Controls::TEXT,
                                    'default' => '',
                                    'placeholder' => 'Your Custom ID for this link',
                                ]
                        );
                        ?>
                    </div>
                    <?php
                    if (array_key_exists('description', $arg)):
                        echo '<div class="shortcode-form-control-description">' . esc_html($arg['description']) . '</div>';
                    endif;
                    ?>
                </div>
                <?php
            }

            /*
             *
             *
             * Templates Substitute Data
             *
             *
             *
             *
             */
            /*
             * Image Hover Style Admin Panel Template Substitute Control.
             *
             * @since 9.3.0
             */

            public function add_substitute_control($id, array $data = [], array $arg = []) {
                $fun = $arg['type'] . '_substitute_control';
                $this->$fun($id, $data, $arg);
            }

            /*
             * Image Hover Style Admin Panel Template Substitute Modal Opener.
             *
             * @since 9.3.0
             */

            public function modalopener_substitute_control($id, array $data = [], array $arg = []) {
                $default = [
                    'showing' => FALSE,
                    'title' => 'Add New Items',
                    'sub-title' => 'Add New Items'
                ];
                $arg = array_merge($default, $arg);
                /*
                 * $arg['title'] = 'Add New Items';
                 * $arg['sub-title'] = 'Add New Items 02';
                 *
                 */
                ?>
                <div class="oxi-addons-item-form shortcode-addons-templates-right-panel <?php
                if ($arg['showing'] != true):
                    echo 'oxi-admin-head-d-none';
                endif;
                ?>"  <?php
                $this->forms_condition($arg);
                ?>>
                    <div class="oxi-addons-item-form-heading shortcode-addons-templates-right-panel-heading">
                        <?php echo esc_html($arg['title']); ?>
                        <div class="oxi-head-toggle"></div>
                    </div>
                    <div class="oxi-addons-item-form-item shortcode-addons-templates-right-panel-body" id="oxi-addons-list-data-modal-open">
                        <span>
                            <i class="dashicons dashicons-plus-alt oxi-icons"></i>
                            <?php echo esc_html($arg['sub-title']); ?>
                        </span>
                    </div>
                </div>
                <?php
            }

            /*
             * Image Hover Style Admin Panel Template Shortcode name.
             *
             * @since 9.3.0
             */

            public function shortcodename_substitute_control($id, array $data = [], array $arg = []) {
                $default = [
                    'showing' => FALSE,
                    'title' => 'Shortcode Name',
                    'placeholder' => 'Set Your Shortcode Name'
                ];
                $arg = array_merge($default, $arg);
                /*
                 * $arg['title'] = 'Add New Items';
                 * $arg['sub-title'] = 'Add New Items 02';
                 *
                 */
                ?>
                <div class="oxi-addons-shortcode  shortcode-addons-templates-right-panel <?php
                if ($arg['showing'] != true):
                    echo 'oxi-admin-head-d-none';
                endif;
                ?>">
                    <div class="oxi-addons-shortcode-heading  shortcode-addons-templates-right-panel-heading">
                        <?php echo esc_html($arg['title']); ?>
                        <div class="oxi-head-toggle"></div>
                    </div>
                    <div class="oxi-addons-shortcode-body  shortcode-addons-templates-right-panel-body">
                        <form method="post" id="shortcode-addons-name-change-submit">
                            <div class="input-group my-2">
                                <input type="hidden" class="form-control" name="addonsstylenameid" value="<?php echo (int) $data['id']; ?>">
                                <input type="text" class="form-control" name="addonsstylename" placeholder="<?php echo esc_html($arg['placeholder']); ?>" value="<?php echo esc_attr($data['name']); ?>">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-success" id="addonsstylenamechange">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <?php
            }

            public function shortcodestyle_substitute_control($id, array $data = [], array $arg = []) {
                if (count($this->StyleChanger) > 0) :
                    $default = [
                        'showing' => FALSE,
                        'title' => 'Template Changer',
                    ];
                    $arg = array_merge($default, $arg);
                    /*
                     * $arg['title'] = 'Add New Items';
                     * $arg['sub-title'] = 'Add New Items 02';
                     *
                     */
                    ?>


                    <div class="oxi-addons-shortcode  shortcode-addons-templates-right-panel <?php
                    if ($arg['showing'] != true):
                        echo 'oxi-admin-head-d-none';
                    endif;
                    ?>">
                        <div class="oxi-addons-shortcode-heading  shortcode-addons-templates-right-panel-heading">

                            <?php
                            echo esc_html($arg['title']);
                            echo ' ';
                            if (apply_filters('oxi-image-hover-plugin-version', false) == false):
                                echo '<span style="color:red">Pro Only</span>';
                            endif;
                            ?>
                            <div class="oxi-head-toggle"></div>
                        </div>
                        <div class="oxi-addons-shortcode-body  shortcode-addons-templates-right-panel-body">
                            <form method="post" id="shortcode-addons-style-change-submit">
                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label for="exampleFormControlSelect1">Current Template</label>
                                        <select class="form-control" name="shortcode-current-style-name" id="shortcode-current-style-name">

                                            <?php
                                            foreach ($this->StyleChanger as $val) {
                                                ?>
                                                <option value="<?php echo esc_attr(strtolower($val)); ?>" <?php
                                                if (strtolower($this->dbdata['style_name']) == strtolower($val)):
                                                    echo 'selected';
                                                endif;
                                                ?>><?php echo esc_html(ucfirst($val)); ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4 pt-4 mt-2">
                                        <input type="hidden" class="form-control" name="shortcode-addons-style-change-submit-id" id="shortcode-addons-style-change-submit-id" value="<?php echo (int) $this->oxiid; ?>">
                                        <button type="submit" id="shortcode-addons-style-change-submit-button" class="btn btn-primary" premium="<?php
                                        if (apply_filters('oxi-image-hover-plugin-version', false) == false):
                                            echo 'ache';
                                        endif;
                                        ?>">Save</button>
                                    </div>
                                </div>
                                <p style="color:red" >Template change is not recommended. We suggest it only for developer. Please change it if you have much knowledge in HTML or can create style from zero level</p>
                            </form>
                        </div>
                    </div>
                    <?php
                endif;
            }

            /*
             * Image Hover Style Admin Panel Template Shortcode Info.
             *
             * @since 9.3.0
             */

            public function shortcodeinfo_substitute_control($id, array $data = [], array $arg = []) {
                $default = [
                    'showing' => FALSE,
                    'title' => 'Shortcode',
                ];
                $arg = array_merge($default, $arg);
                /*
                 * $arg['title'] = 'Add New Items';
                 * $arg['sub-title'] = 'Add New Items 02';
                 *
                 */
                ?>
                <div class="oxi-addons-shortcode shortcode-addons-templates-right-panel <?php
                if ($arg['showing'] != true):
                    echo esc_attr('oxi-admin-head-d-none');
                endif;
                ?>">
                    <div class="oxi-addons-shortcode-heading  shortcode-addons-templates-right-panel-heading">
                        <?php echo esc_html($arg['title']); ?>
                        <div class="oxi-head-toggle"></div>
                    </div>
                    <div class="oxi-addons-shortcode-body shortcode-addons-templates-right-panel-body">
                        <em>Shortcode for posts/pages/plugins</em>
                        <p>Copy &amp;
                            paste the shortcode directly into any WordPress post, page or Page Builder.</p>
                        <input type="text" class="form-control" onclick="this.setSelectionRange(0, this.value.length)" value="[iheu_ultimate_oxi id=&quot;<?php echo esc_attr($id); ?>&quot;]">
                        <span></span>
                        <em>Shortcode for templates/themes</em>
                        <p>Copy &amp;
                            paste this code into a template file to include the slideshow within your theme.</p>
                        <input type="text" class="form-control" onclick="this.setSelectionRange(0, this.value.length)" value="&lt;?php echo do_shortcode('[iheu_ultimate_oxi  id=&quot;<?php echo esc_attr($id); ?>&quot;]'); ?&gt;">
                        <span></span>
                    </div>
                </div>
                <?php
            }

            public function allowed_html_sanitize($rawdata) {
                $allowed_tags = array(
                    'a' => array(
                        'class' => array(),
                        'href' => array(),
                        'rel' => array(),
                        'title' => array(),
                    ),
                    'abbr' => array(
                        'title' => array(),
                    ),
                    'b' => array(),
                    'br' => array(),
                    'blockquote' => array(
                        'cite' => array(),
                    ),
                    'cite' => array(
                        'title' => array(),
                    ),
                    'code' => array(),
                    'del' => array(
                        'datetime' => array(),
                        'title' => array(),
                    ),
                    'dd' => array(),
                    'div' => array(
                        'class' => array(),
                        'title' => array(),
                        'style' => array(),
                        'id' => array(),
                    ),
                    'table' => array(
                        'class' => array(),
                        'id' => array(),
                        'style' => array(),
                    ),
                    'button' => array(
                        'class' => array(),
                        'type' => array(),
                        'value' => array(),
                    ),
                    'thead' => array(),
                    'tbody' => array(),
                    'tr' => array(),
                    'td' => array(),
                    'dt' => array(),
                    'em' => array(),
                    'h1' => array(),
                    'h2' => array(),
                    'h3' => array(),
                    'h4' => array(),
                    'h5' => array(),
                    'h6' => array(),
                    'i' => array(
                        'class' => array(),
                    ),
                    'img' => array(
                        'alt' => array(),
                        'class' => array(),
                        'height' => array(),
                        'src' => array(),
                        'width' => array(),
                    ),
                    'li' => array(
                        'class' => array(),
                        'id' => array(),
                    ),
                    'ol' => array(
                        'class' => array(),
                    ),
                    'p' => array(
                        'class' => array(),
                    ),
                    'q' => array(
                        'cite' => array(),
                        'title' => array(),
                    ),
                    'span' => array(
                        'class' => array(),
                        'title' => array(),
                        'style' => array(),
                    ),
                    'strike' => array(),
                    'strong' => array(),
                    'ul' => array(
                        'class' => array(),
                    ),
                );

                echo wp_kses($rawdata, $allowed_tags);
            }

            public function rearrange_substitute_control($id, array $data = [], array $arg = []) {
                $default = [
                    'showing' => FALSE,
                    'title' => 'Image Hover Rearrange',
                    'sub-title' => 'Image Hover Rearrange'
                ];
                $arg = array_merge($default, $arg);
                /*
                 * $arg['title'] = 'Add New Items';
                 * $arg['sub-title'] = 'Add New Items 02';
                 *
                 */
                ?>
                <div class="oxi-addons-item-form shortcode-addons-templates-right-panel <?php
                if ($arg['showing'] != true):
                    echo 'oxi-admin-head-d-none';
                endif;
                ?>" <?php $this->forms_condition($arg) ?>>
                    <div class="oxi-addons-item-form-heading shortcode-addons-templates-right-panel-heading">
        <?php echo esc_html($arg['title']); ?>
                        <div class="oxi-head-toggle"></div>
                    </div>
                    <div class="oxi-addons-item-form-item shortcode-addons-templates-right-panel-body"
                         id="oxi-addons-rearrange-data-modal-open">
                        <span>
                            <i class="dashicons dashicons-plus-alt oxi-icons"></i>
        <?php echo esc_html($arg['sub-title']); ?>
                        </span>
                    </div>
                </div>
                <div id="oxi-addons-list-rearrange-modal" class="modal fade bd-example-modal-sm" role="dialog">
                    <div class="modal-dialog modal-sm">
                        <form id="oxi-addons-form-rearrange-submit">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Image Rearrange</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="col-12 alert text-center" id="oxi-addons-list-rearrange-saving">
                                        <i class="fa fa-spinner fa-spin"></i>
                                    </div>
                                    <ul class="col-12 list-group" id="oxi-addons-modal-rearrange">
                                    </ul>
                                </div>
                                <div class="modal-footer">
                                    <input type="hidden" id="oxi-addons-list-rearrange-data">
                                    <button type="button" id="oxi-addons-list-rearrange-close" class="btn btn-danger"
                                            data-dismiss="modal">Close</button>
                                    <input type="submit" id="oxi-addons-list-rearrange-submit" class="btn btn-primary" value="Save">
                                </div>
                            </div>
                        </form>
                        <div id="modal-rearrange-store-file">
        <?php $this->allowed_html_sanitize($id); ?>
                        </div>
                    </div>
                </div>
                <?php
            }

        }
        