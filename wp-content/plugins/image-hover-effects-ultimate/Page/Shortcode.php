<?php

namespace OXI_IMAGE_HOVER_PLUGINS\Page;

if (!defined('ABSPATH')) {
    exit;
}

class Shortcode {

    /**
     * Database Parent Table
     *
     * @since 9.3.0
     */
    public $parent_table;

    /**
     * Database Import Table
     *
     * @since 9.3.0
     */
    public $child_table;

    /**
     * Database Import Table
     *
     * @since 9.3.0
     */
    public $import_table;

    /**
     * Define $wpdb
     *
     * @since 9.3.0
     */
    public $wpdb;

    use \OXI_IMAGE_HOVER_PLUGINS\Helper\Public_Helper;
    use \OXI_IMAGE_HOVER_PLUGINS\Helper\CSS_JS_Loader;

    /**
     * Constructor of Oxilab tabs Home Page
     *
     * @since 9.3.0
     */
    public function __construct() {
        global $wpdb;
        $this->wpdb = $wpdb;
        $this->parent_table = $this->wpdb->prefix . 'image_hover_ultimate_style';
        $this->child_table = $this->wpdb->prefix . 'image_hover_ultimate_list';
        $this->import_table = $this->wpdb->prefix . 'oxi_div_import';
        $this->CSSJS_load();
        $this->Render();
    }

    public function CSSJS_load() {
        $this->manual_import_style();
        $this->admin_css_loader();
        $this->admin_home();
        $this->admin_rest_api();
        apply_filters('oxi-image-hover-plugin/admin_menu', TRUE);
    }

    /**
     * Admin Notice JS file loader
     * @return void
     */
    public function admin_rest_api() {
        wp_enqueue_script('oxi-image-hover-shortcode', OXI_IMAGE_HOVER_URL . '/assets/backend/js/shortcode.js', false, OXI_IMAGE_HOVER_TEXTDOMAIN);
    }

    /**
     * Plugin Name Convert to View
     *
     * @since 9.3.0
     */
    public function name_($data) {
        $data = str_replace('_', ' ', $data);
        $data = str_replace('-', ' ', $data);
        $data = str_replace('+', ' ', $data);
        echo esc_html(ucwords($data));
    }

    public function database_data() {
        return $this->wpdb->get_results("SELECT * FROM  $this->parent_table ORDER BY id DESC", ARRAY_A);
    }

    /**
     * Generate safe path
     * @since v1.0.0
     */
    public function safe_path($path) {

        $path = str_replace(['//', '\\\\'], ['/', '\\'], $path);
        return str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $path);
    }

    public function manual_import_style() {
        if (!empty($_REQUEST['_wpnonce'])) {
            $nonce = $_REQUEST['_wpnonce'];
        }

        if (!empty($_POST['importdatasubmit']) && sanitize_text_field($_POST['importdatasubmit']) == 'Save') {
            if (!wp_verify_nonce($nonce, 'image-hover-effects-ultimate-import')) {
                die('You do not have sufficient permissions to access this page.');
            } else {
                if (isset($_FILES['importimagehoverultimatefile'])) :
                    $filename = $_FILES["importimagehoverultimatefile"]["name"];

                    if (!current_user_can('upload_files')) :
                        wp_die(__('You do not have permission to upload files.'));
                    endif;

                    $allowedMimes = array(
                        'json' => 'text/plain'
                    );

                    $fileInfo = wp_check_filetype(basename($_FILES['importimagehoverultimatefile']['name']), $allowedMimes);
                    if (empty($fileInfo['ext'])) {
                        wp_die(__('You do not have permission to upload files.'));
                    }

                    $content = json_decode(file_get_contents($_FILES['importimagehoverultimatefile']['tmp_name']), true);

                    if (empty($content)) {
                        return new \WP_Error('file_error', 'Invalid File');
                    }
                    $style = $content['style'];
                    if (!is_array($style)) {
                        return new \WP_Error('file_error', 'Invalid Content In File');
                    }
                    $ImportApi = new \OXI_IMAGE_HOVER_PLUGINS\Classes\ImageApi;
                    $new_slug = $ImportApi->post_json_import($content);
                    echo '<script type="text/javascript"> document.location.href = "' . $new_slug . '"; </script>';
                    exit;
                endif;
            }
        }
    }

    public function Render() {
        ?>
        <div class="oxi-addons-row">
        <?php
        $this->Admin_header();
        $this->created_shortcode();
        $this->create_new();
        ?>
        </div>
        <?php
    }

    public function Admin_header() {
        ?>
        <div class="oxi-addons-wrapper">
            <div class="oxi-addons-import-layouts">
                <h1>Image Hover › Shortcode</h1>
                <p>Collect Image Hover Shortcode, Edit, Delect, Clone or Export it.</p>
            </div>
        </div>
        <?php
        apply_filters('oxi-image-hover-support-and-comments', TRUE);
    }

    public function create_new() {
        ?>

        <div class="oxi-addons-row">
            <div class="oxi-addons-col-1 oxi-import">
                <div class="oxi-addons-style-preview">
                    <div class="oxilab-admin-style-preview-top">
                        <a href="#" id="oxi-import-style">
                            <div class="oxilab-admin-add-new-item">
                                <span>
                                    <i class="fas fa-plus-circle oxi-icons"></i>
                                    Import Image Hover Files
                                </span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="oxi-addons-style-import-modal">
            <form method="post" id="oxi-addons-import-modal-form" enctype="multipart/form-data">
                <div class="modal-dialog modal-sm modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Import JSON Files</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <input class="form-control" type="file" name="importimagehoverultimatefile" accept=".json,application/json,.zip,application/octet-stream,application/zip,application/x-zip,application/x-zip-compressed">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-success" name="importdatasubmit" id="importdatasubmit" value="Save">
                        </div>
                    </div>
                </div>
        <?php echo wp_nonce_field("image-hover-effects-ultimate-import") ?>
            </form>
        </div>

        <div class="modal fade" id="oxi-addons-style-clone-modal">
            <form method="post" id="oxi-addons-style-clone-modal-form">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Layouts Clone</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class=" form-group row">
                                <label for="addons-style-name" class="col-sm-6 col-form-label" oxi-addons-tooltip="Give your Shortcode Name Here">Name</label>
                                <div class="col-sm-6 addons-dtm-laptop-lock">
                                    <input class="form-control" type="text" value="" id="addons-style-name" name="addons-style-name" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" id="oxistyleid" name="oxistyleid" value="">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-success" name="addonsdatasubmit" id="addonsdatasubmit" value="Save">
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <?php
    }

    public function created_shortcode() {
        ?>
        <div class="oxi-addons-row">
            <div class="oxi-addons-row table-responsive abop" style="margin-bottom: 20px; opacity: 0; height: 0px">
                <table class="table table-hover widefat oxi_addons_table_data" style="background-color: #fff; border: 1px solid #ccc">
                    <thead>
                        <tr>
                            <th style="width: 5%">ID</th>
                            <th style="width: 15%">Name</th>
                            <th style="width: 10%">Templates</th>
                            <th style="width: 30%">Shortcode</th>
                            <th style="width: 40%">Edit Delete</th>
                        </tr>
                    </thead>
                    <tbody>
        <?php
        foreach ($this->database_data() as $value) {

            $effects = $this->effects_converter($value['style_name']);

            $id = $value['id'];
            ?>
                            <tr>
                                <td><?php echo (int) $id; ?></td>
                                <td><?php $this->name_($value['name']) ?></td>
                                <td><?php $this->name_($value['style_name']) ?></td>
                                <td><span>Shortcode &nbsp;&nbsp;<input type="text" onclick="this.setSelectionRange(0, this.value.length)" value="[iheu_ultimate_oxi id=&quot;<?php echo (int) $id ?>&quot;]"></span> <br>
                                    <span>Php Code &nbsp;&nbsp; <input type="text" onclick="this.setSelectionRange(0, this.value.length)" value="&lt;?php echo do_shortcode(&#039;[iheu_ultimate_oxi  id=&quot;<?php echo (int) $id ?>&quot;]&#039;); ?&gt;"></span>
                                </td>
                                <td>
                                    <a href="<?php echo esc_url(admin_url("admin.php?page=oxi-image-hover-ultimate&effects=$effects&styleid=$id")) ?>" title="Edit" class="btn btn-primary" style="float:left; margin-right: 5px;">Edit</a>
                                    <a href="#" title="Clone" class="btn btn-secondary oxi-addons-style-clone" datavalue="<?php echo (int) $id; ?>" style="float:left; margin-right: 5px;">Clone</a>
                                    <a href="<?php echo esc_url(rest_url() . 'ImageHoverUltimate/v1/shortcode_export?styleid=' . $id . '& _wpnonce=' . wp_create_nonce('wp_rest')); ?>" title="Export" class="btn btn-info" style="float:left; margin-right: 5px;">Export</a>

                                    <button class="btn btn-danger oxi-addons-style-delete" style="float:left" title="Delete" value="<?php echo (int) $id; ?>" type="button" value="delete">Delete</button>
                                </td>
                            </tr>
            <?php
        }
        ?>
                    </tbody>
                </table>
            </div>
            <br>
            <br>
        </div>
        <?php
    }

}
