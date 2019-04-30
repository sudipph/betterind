<?php ini_set('display_errors', '1');
$gallery_data = get_post_meta(get_the_ID(), 'gallery_data', true);
global $my_category, $get_meta_val;
$class_helper = '';

$class_helper .= isset($get_meta_val['card_type']) ? $get_meta_val['card_type'] : '';

$class_helper .= ' content-post';
?>
<li id="<?php echo get_the_id(); ?>" <?php if (!has_post_thumbnail($class_helper)) {?> class="list-group no-img"<?php } else {?>class="list-group"<?php }?>>
    <div class="container-fluid">
    <div class="row next_bar_border"><div class="next_post_border">Next Post</div></div>
        <div class="post-content" style="position:relative;">
            <div class="next_post_image">
                <?php if (has_post_thumbnail()) {the_post_thumbnail('alm-thumbnail', array('class' => 'img-fluid'));}?>
            </div>
            <?php
$category = get_the_category();
if (isset($category[0]->name)) {
    ?>
                 <div class="col category_display"><?php echo $category[0]->name; ?></div>
                <?php
}
?>
        </div>

        <div class="content_title_box">
            <div class="disabled_in_mobile_view show_in_default">
                    <div class="sponsors_title_with_images">
                        <?php
if (isset($gallery_data['image_url'])) {
//if (isset($gallery_data['image_desc'])) {
    ?>
                        <div class="sponsors_title">
                        <?php //echo $gallery_data['image_desc']; ?>
                        In Association with
                    </div>
                    <?php
//}

    ?>
                    <div class="sponsors_images">
                        <img src="<?php echo $gallery_data['image_url'] ?>" width="30">
                    </div>
<?php }?>
                    </div>
                </div>
                <div>
            <h1 class="post-title">
                <a href="<?php the_permalink();?>" title="<?php the_title();?>"><?php the_title();?></a>
            </h1></div>
            <?php evolve_post_meta('custom','default_unique'); //the_time("F d, Y"); ?>

        </div>

            <div class="main_content default_content_width_change">
                <div class="inner_content_width_slider show_only_desktop">
                    
                    <?php echo bawmrp_the_content_new_in_ajax2(); ?>
                </div>
            <div class="main_semi_content semi_page_id_<?php echo get_the_ID(); ?> inner_content_width">
                    <?php //the_excerpt();
                    //the_content();
                    the_excerpt()
                    //primary_cta($gallery_data);
                    ?>
                    <div class="share_button"><?php echo do_shortcode('[Sassy_Social_Share] ') ?></div>
            </div>
            <div class="read_more_option read_more_hide_option_<?php echo get_the_ID(); ?>">
				<!-- <a class="btn btn-sm" href="javascript:open_full_page('semi_page_id_<?php echo get_the_ID(); ?>','<?php echo get_the_ID(); ?>');">

					<?php _e('Read More', 'evolve');?>

                </a> -->
                <a class="btn btn-sm" href="<?php echo get_permalink(); ?>">

					<?php _e('Read More', 'evolve');?>

				</a>
	</div>
</div>

            <aside id="secondary" class="<?php echo $class_helper; ?> aside col-sm-12 col-md-4">
                <div id="execphp-2" class="widget widget_execphp">
                    <div class="widget-content">
                        <div class="execphpwidget">
                            <div class="bawmrp next_to_next show_only_in_mobile">
                            <?php echo bawmrp_the_content_new_in_ajax(); ?>

                            </div>

                            </div>
                            </div>
                            </div>
            </aside>

    </div>
</li>