<?php

namespace OXI_IMAGE_HOVER_PLUGINS\Modules\Square\Render;

if (!defined('ABSPATH')) {
    exit;
}

use OXI_IMAGE_HOVER_PLUGINS\Page\Public_Render;

class Effects7 extends Public_Render {

    public function public_css() {
        wp_enqueue_style('oxi-image-hover-square', OXI_IMAGE_HOVER_URL . '/Modules/Square/Files/square.css', false, OXI_IMAGE_HOVER_PLUGIN_VERSION);
        wp_enqueue_style('oxi-image-hover-square-style-7', OXI_IMAGE_HOVER_URL . '/Modules/Square/Files/style-7.css', false, OXI_IMAGE_HOVER_PLUGIN_VERSION);
    }

    public function default_render($style, $child, $admin) {

        foreach ($child as $key => $val) {
            $value = json_decode(stripslashes($val['rawdata']), true);
            $text = $content = $button = $hr = $ht = '';
            ?>
            <div class="oxi-image-hover-style <?php $this->column_render('oxi-image-hover-col', $style); ?> <?php
            if ($admin == "admin"):
                echo 'oxi-addons-admin-edit-list';
            endif;
            ?>" <?php $this->animation_render('oxi-image-hover-animation', $style); ?>>
                <div class="oxi-image-hover-style-square">
                    <div class="oxi-image-hover oxi-image-square-hover oxi-image-square-hover-style-7 oxi-image-square-hover-<?php echo esc_attr($this->oxiid); ?>-<?php echo esc_attr($val['id']); ?>">
                        <?php
                        if ($this->checkurl_render('image_hover_button_link', $value) === true && empty($value['image_hover_button_text'])):
                            $ht = true;
                            ?>
                            <a <?php $this->url_render('image_hover_button_link', $value); ?>>
                                <?php
                            endif;
                            ?>
                            <div class="oxi-image-hover-figure <?php echo esc_attr($this->style['image_hover_effects']); ?>">
                                <div class="oxi-image-hover-image">
                                    <img <?php $this->media_render('image_hover_image', $value); ?>>
                                </div>
                                <div class="oxi-image-hover-figure-caption">
                                    <div class="oxi-image-hover-caption-tab <?php echo esc_attr($this->style['oxi-image-hover-content-alignment']); ?>">
                                        <?php
                                        if ($value['image_hover_heading'] != ''):
                                            ?>
                                            <div class="oxi-image-hover-figure-heading <?php echo esc_attr($this->style['oxi-image-hover-heading-animation']); ?> <?php echo esc_attr($this->style['oxi-image-hover-heading-animation-delay']); ?>"><h3 class="oxi-image-hover-heading <?php
                                                if (isset($this->style['oxi-image-hover-heading-underline'])):
                                                    echo esc_attr($this->style['oxi-image-hover-heading-underline']);
                                                endif;
                                                ?>"><?php $this->text_render($value['image_hover_heading']); ?></h3></div>
                                                <?php
                                            endif;
                                            if ($value['image_hover_description'] != ''):
                                                ?>
                                            <div class="oxi-image-hover-content <?php echo esc_attr($this->style['oxi-image-hover-desc-animation']); ?> <?php echo esc_attr($this->style['oxi-image-hover-desc-animation-delay']); ?>"><?php $this->text_render($value['image_hover_description']); ?></div>
                                            <?php
                                        endif;
                                        if ($value['image_hover_button_text'] != '' && $this->checkurl_render('image_hover_button_link', $value) == true):
                                            ?>
                                            <div class="oxi-image-hover-button <?php echo esc_attr($this->style['oxi-image-hover-button-animation']); ?> <?php echo esc_attr($this->style['oxi-image-hover-button-animation-delay']); ?>">
                                                <a <?php $this->url_render('image_hover_button_link', $value); ?> class="oxi-image-btn"><?php $this->text_render($value['image_hover_button_text']); ?></a>
                                            </div>
                                            <?php
                                        endif;
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                            if ($ht === true):
                                ?>
                            </a>
                            <?php
                        endif;
                        ?>
                    </div>
                </div>
                <?php
                if ($admin == 'admin') :
                    $this->oxi_addons_admin_edit_delete_clone($val['id']);
                endif;
                ?>
            </div>
            <?php
            if ($this->media_background_render('image_hover_feature_image', $value) != ''):
                $url = $this->media_background_render('image_hover_feature_image', $value);
                $this->inline_css .= ' .oxi-image-hover-style-square .oxi-image-square-hover-' . $this->oxiid . '-' . $val['id'] . ' .oxi-image-hover-figure-caption:after{background: url(' . $url . ');-moz-background-size: 100% 100% !important;-o-background-size: 100% 100% !important; background-size: 100% 100% !important;}';
            endif;
        }
    }

    public function old_render() {
        $style = $this->dbdata['css'];
        $styledata = explode('|', $style);
        foreach ($this->child as $k => $value) {
            $rowdata = [
                'image_hover_heading' => $value['title'],
                'image_hover_description' => $value['files'],
                'image_hover_image-select' => 'media-library',
                'image_hover_image-image' => $value['image'],
                'image_hover_feature_image-select' => 'media-library',
                'image_hover_feature_image-image' => $value['hoverimage'],
                'image_hover_button_link-url' => $value['link'],
                'image_hover_button_link-target' => $styledata[17] == '_blank' ? 'yes' : '',
                'image_hover_button_text' => $value['buttom_text'],
            ];
            $dd = json_encode($rowdata);
            $this->wpdb->query($this->wpdb->prepare("UPDATE {$this->child_table} SET rawdata = %s WHERE id = %d", $dd, $value['id']));
        }

        $new = [
            'image-hover-style-id' => $this->oxiid,
            'oxi-addons-elements-template' => $this->dbdata['style_name'],
            'oxi-image-hover-col-lap' => $this->old_column_render($styledata[1], 'lap'),
            'oxi-image-hover-col-tab' => $this->old_column_render($styledata[1], 'tab'),
            'oxi-image-hover-col-mob' => $this->old_column_render($styledata[1], 'mob'),
            'oxi-image-hover-border-radius-lap-top' => 0,
            'oxi-image-hover-border-radius-lap-right' => 0,
            'oxi-image-hover-border-radius-lap-bottom' => 0,
            'oxi-image-hover-border-radius-lap-left' => 0,
            'oxi-image-hover-border-radius-lap-choices' => '%',
            'oxi-image-hover-width-lap-choices' => 'px',
            'oxi-image-hover-width-lap-size' => $styledata[5],
            'oxi-image-hover-height-lap-choices' => '%',
            'oxi-image-hover-height-lap-size' => ($styledata[7] / $styledata[5] * 100),
            'oxi-image-hover-margin-lap-top' => $styledata[9],
            'oxi-image-hover-margin-lap-right' => $styledata[9],
            'oxi-image-hover-margin-lap-bottom' => $styledata[9],
            'oxi-image-hover-margin-lap-left' => $styledata[9],
            'oxi-image-hover-margin-lap-choices' => 'px',
            /////
            'oxi-image-hover-padding-lap-top' => 0,
            'oxi-image-hover-padding-lap-right' => 0,
            'oxi-image-hover-padding-lap-bottom' => $styledata[11],
            'oxi-image-hover-padding-lap-left' => 0,
            'oxi-image-hover-padding-lap-choices' => 'px',
            //////
            'oxi-image-hover-background-color' => $styledata[13],
            'oxi-image-hover-background-img' => '',
            'oxi-image-hover-content-alignment' => $this->old_alignment_render($styledata[15]),
            'oxi-image-hover-animation-type' => $styledata[19],
            'oxi-image-hover-animation-duration-size' => $styledata[21] * 1000,
            'oxi-image-hover-desc-animation' => $styledata[23],
            'oxi-image-hover-heading-animation' => $styledata[23],
            'oxi-image-hover-button-animation' => $styledata[23],
            'oxi-image-hover-heading-animation-delay' => '',
            'oxi-image-hover-desc-animation-delay' => '',
            'oxi-image-hover-button-animation-delay' => '',
            'oxi-image-hover-boxshadow-shadow' => 'yes',
            'oxi-image-hover-boxshadow-type' => 'inset',
            'oxi-image-hover-boxshadow-horizontal-size' => 0,
            'oxi-image-hover-boxshadow-vertical-size' => 0,
            'oxi-image-hover-boxshadow-blur-size' => 0,
            'oxi-image-hover-boxshadow-spread-size' => $styledata[25],
            'oxi-image-hover-boxshadow-color' => $styledata[27],
            ///
            //
            //////
            'oxi-image-hover-heading-typho-size-lap-size' => $styledata[33],
            'oxi-image-hover-heading-typho-size-lap-choices' => 'px',
            'oxi-image-hover-heading-underline' => '',
            'oxi-image-hover-heading-color' => $styledata[35],
            'oxi-image-hover-heading-typho-font' => $styledata[37],
            'oxi-image-hover-heading-typho-weight' => $styledata[39],
            'oxi-image-hover-heading-margin-lap-top' => ($styledata[89] != '' ? $styledata[89] : 0),
            'oxi-image-hover-heading-margin-lap-right' => 0,
            'oxi-image-hover-heading-margin-lap-bottom' => $styledata[45],
            'oxi-image-hover-heading-margin-lap-left' => 0,
            'oxi-image-hover-heading-margin-lap-choices' => 'px',
            'oxi-image-hover-heading-padding-lap-top' => $styledata[87],
            'oxi-image-hover-heading-padding-lap-right' => $styledata[11],
            'oxi-image-hover-heading-padding-lap-bottom' => $styledata[87],
            'oxi-image-hover-heading-padding-lap-left' => $styledata[11],
            'oxi-image-hover-heading-padding-lap-choices' => 'px',
            'oxi-image-hover-heading-background-color' => $styledata[85],
            'oxi-image-hover-background-img' => '',
            /////
            'oxi-image-hover-heading-underline' => ($styledata[41] == 'no' ? '' : ''),
            'oxi-image-hover-underline-color' => $styledata[35],
            ///
            'oxi-image-hover-desc-typho-size-lap-size' => $styledata[47],
            'oxi-image-hover-desc-typho-size-lap-choices' => 'px',
            'oxi-image-hover-desc-color' => $styledata[49],
            'oxi-image-hover-desc-typho-font' => $styledata[51],
            'oxi-image-hover-desc-typho-weight' => $styledata[53],
            'oxi-image-hover-desc-margin-lap-top' => '0',
            'oxi-image-hover-desc-margin-lap-right' => $styledata[11],
            'oxi-image-hover-desc-margin-lap-bottom' => $styledata[55],
            'oxi-image-hover-desc-margin-lap-left' => $styledata[11],
            'oxi-image-hover-desc-margin-lap-choices' => 'px',
            ////
            'oxi-image-hover-button-typho-size-lap-size' => $styledata[57],
            'oxi-image-hover-button-typho-size-lap-choices' => 'px',
            'oxi-image-hover-button-color' => $styledata[59],
            'oxi-image-hover-button-background' => $styledata[61],
            'oxi-image-hover-button-typho-font' => $styledata[63],
            'oxi-image-hover-button-typho-weight' => $styledata[65],
            'oxi-image-hover-button-hover-color' => $styledata[67],
            'oxi-image-hover-button-hover-background' => $styledata[69],
            ///
            'oxi-image-hover-button-radius-lap-top' => $styledata[71],
            'oxi-image-hover-button-radius-lap-right' => $styledata[71],
            'oxi-image-hover-button-radius-lap-bottom' => $styledata[71],
            'oxi-image-hover-button-radius-lap-left' => $styledata[71],
            'oxi-image-hover-button-radius-lap-choices' => 'px',
            ///
            'oxi-image-hover-button-padding-lap-top' => $styledata[73],
            'oxi-image-hover-button-padding-lap-right' => $styledata[75],
            'oxi-image-hover-button-padding-lap-bottom' => $styledata[73],
            'oxi-image-hover-button-padding-lap-left' => $styledata[75],
            'oxi-image-hover-button-padding-lap-choices' => 'px',
            'oxi-image-hover-button-position' => $this->old_button_alignment_render($styledata[77]),
            ///
            'oxi-image-hover-button-margin-lap-top' => 0,
            'oxi-image-hover-button-margin-lap-right' => 0,
            'oxi-image-hover-button-margin-lap-bottom' => 0,
            'oxi-image-hover-button-margin-lap-left' => 0,
            'oxi-image-hover-button-margin-lap-choices' => 'px',
            ///
            'image-hover-custom-css' => $styledata[83],
            'image_hover_effects' => $styledata[91],
        ];
        $row = json_encode($new);
        $this->wpdb->query($this->wpdb->prepare("UPDATE {$this->parent_table} SET rawdata = %s WHERE id = %d", $row, $this->oxiid));
        $name = explode('-', $this->dbdata['style_name']);
        $cls = '\OXI_IMAGE_HOVER_PLUGINS\Modules\Square\Admin\Effects' . $name[1];
        $CLASS = new $cls('admin');
        $CLASS->template_css_render($new);
    }

}
