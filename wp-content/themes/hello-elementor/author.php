<?php
 
   get_header();
?>
<main id="content" class="site-main post-488 page type-page status-publish hentry" role="main">
    <div class="page-content">
        <div data-elementor-type="wp-page" data-elementor-id="488" class="elementor elementor-488">
            <section
                class="elementor-section elementor-top-section elementor-element elementor-element-da44f77 elementor-section-boxed elementor-section-height-default elementor-section-height-default"
                data-id="da44f77" data-element_type="section">
                <div class="elementor-container elementor-column-gap-default">
                    <div class="elementor-column elementor-col-70 elementor-top-column elementor-element elementor-element-8d5ae7c"
                        data-id="8d5ae7c" data-element_type="column">
                        <div class="elementor-widget-wrap elementor-element-populated">
                            <div class="elementor-element elementor-element-318df7c elementor-widget elementor-widget-shortcode"
                                data-id="318df7c" data-element_type="widget" data-widget_type="shortcode.default">
                                <div class="elementor-widget-container">
                                    <div class="elementor-shortcode">
                                        <?php 
                                       
                                        // echo "<pre>";
                                        // print_r(get_user_by('slug', 'jack'));
                                        // echo "</pre>";

                                    //    $user=get_user_by('slug', 'jack');
                                    //   echo $user->ID;
                                        ?>
                                        <?php echo do_shortcode('[custom-detail-page]'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="elementor-column elementor-col-30 elementor-top-column elementor-element elementor-element-7e42edb"
                        data-id="7e42edb" data-element_type="column">
                        <div class="elementor-widget-wrap elementor-element-populated">
                            <div class="elementor-element elementor-element-9a1b141 elementor-widget elementor-widget-shortcode"
                                data-id="9a1b141" data-element_type="widget" data-widget_type="shortcode.default">
                                <div class="elementor-widget-container">
                                    <div class="elementor-shortcode">
                                    <?php echo do_shortcode('[custom-sidebar]'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section
                class="elementor-section elementor-top-section elementor-element elementor-element-e2a84ff elementor-section-boxed elementor-section-height-default elementor-section-height-default"
                data-id="e2a84ff" data-element_type="section">
                <div class="elementor-container elementor-column-gap-default">
                    <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-91c3211"
                        data-id="91c3211" data-element_type="column">
                        <div class="elementor-widget-wrap elementor-element-populated">
                            <div class="elementor-element elementor-element-0b47d95 elementor-widget elementor-widget-shortcode"
                                data-id="0b47d95" data-element_type="widget" data-widget_type="shortcode.default">
                                <div class="elementor-widget-container">
                                    <div class="elementor-shortcode">
                                    <?php echo do_shortcode('[custom-detail-section]'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="post-tags">
        </div>
    </div>

    <section id="comments" class="comments-area">




    </section><!-- .comments-area -->
</main>
<?php get_footer(); ?>