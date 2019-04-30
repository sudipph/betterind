<?php

/*
Displays Post Content
======================================= */
global $my_category, $get_meta_val;
$gallery_data = get_post_meta(get_the_ID(), 'gallery_data', true);

$class_helper = '';

$class_helper .= isset($get_meta_val['card_type']) ? $get_meta_val['card_type'] : '';

$class_helper .= ' content-post';
?>

<article id="post-<?php the_ID();?>" <?php post_class($class_helper);?> itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">

	<?php

$cat = get_the_category();
?>

    <div class="post-content" itemprop="mainContentOfPage">
	<div class="col category" style="border:1px solid;"><?php echo $cat[0]->name ?></div>
	<div class="story_pack_title"><?php echo $my_category[0]->name; ?></div>
	<?php

echo '<div class="thumbnail-post-single">';
the_post_thumbnail('evolve-post-thumbnail', array('class' => 'd-block w-100', 'itemprop' => 'image'));
echo '</div>';
?>

			</div>
			<div class="content_title_box">

                <div class="disabled_in_mobile_view">
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
					<?php

if (is_single() || is_page()) {

    if (get_post_meta($post->ID, 'evolve_page_title', true) == "yes" || get_post_meta($post->ID, 'evolve_page_title', true) == "") {
        the_title('<h1 class="post-title" itemprop="name">', '</h1>');
    }
} else {
    if (evolve_theme_mod('evl_post_layout', 'two') != "one") {
        $evolve_title = the_title('', '', false);
        echo '<h2 class="post-title" itemprop="name"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">';
        evolve_truncate(intval(evolve_theme_mod('evl_posts_excerpt_title_length', '40')), $evolve_title);
        echo '</a></h2>';
    } else {
        the_title('<h2 class="post-title" itemprop="name"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
    }
}
//
?>
						<div class="row post-meta align-items-center topstories_post">

							<div class="author vcard">
								<span class="written_by_author">
								<?php echo get_avatar(get_the_author_meta('ID'), 32); ?>
								</span>
								<div class="written_by_box_area">
									<span class="by_color"> by</span>
									<span class="written_by"><?php echo get_the_author(); ?></span>
									<span class="published updated" itemprop="datePublished" pubdate="">
									<?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?>
									</span>
								</div>
								<div class="optional_area"></div>
							    <div class="share_beside_author"><?php share();?></div>
							</div>

						</div>
</div>
<div class="main_content top_story_width_change">
<div class="inner_content_width_slider show_only_desktop">
    <?php //echo do_shortcode('[manual_related_posts_new2]'); ?>
    <span class="social_icons left_side_social_icon">
    
        <?php echo social_icon_with_share(true)?>
   
    </span>
</div>
<div class="inner_content_width" style="width: 82%;">
						<?php
                 $pod_cast_value = isset($gallery_data['podcast_shortcode']['pod_cast'])?$gallery_data['podcast_shortcode']['pod_cast']:'';
if (isset($pod_cast_value) && $pod_cast_value != '') {
   //echo $pod_cast_value;
    if (isset($pod_cast_value)) {

                                                            preg_match('/<iframe.*src=\"(.*)\".*><\/iframe>/isU', $pod_cast_value, $matches);
                                                           // var_dump($matches);
                                                           echo '<div class="content_for_subtitle">'; 
                                                           echo '<iframe src="' . $matches[1] . '" width="600" height="350" frameborder="0" scrolling="no"></iframe>';
                                                            echo '</div>';
                                                        }
}

if (is_search()) {
    the_excerpt();
} else {
    echo change_first_content(get_the_content());
   // the_content();
}

?>
</div>
<!-- <div class="right_share_button show_only_on_desktop">

        <span class="social_icons">
            
        <?php echo social_icon_with_share(true)?>

        
        </span>
    <div class="right_slider_for_related_article">
    <?php echo do_shortcode('[manual_related_posts_new2]'); ?>
    </div>
</div> -->
				<?php

primary_cta($gallery_data);
?>


	<div class="share_button"><?php echo do_shortcode('[Sassy_Social_Share] ') ?></div>
</div>

</article><!-- .post -->

