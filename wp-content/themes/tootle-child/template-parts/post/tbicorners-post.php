<?php

/*
Displays Post Content
======================================= */
global $cat_key;
$gallery_data = get_post_meta(get_the_ID(), 'gallery_data', true);
?>

<article  id="post-<?php the_ID();?>" <?php post_class('spotlight_article_loop');?> itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
<div class="row">
<!-- <div class="col-12"> -->
	<?php

echo '<div class="col-5 thumbnail-post">

<a href="';
the_permalink();
echo '">';
the_post_thumbnail('evolve-post-thumbnail', array('class' => 'd-block w-100', 'itemprop' => 'image'));
echo '<div class="mask"><div class="icon"></div></div></a>';
?>
	<div class="row">
						<span class="written_by">Written by <?php echo get_the_author(); ?></span>
						<span class="published updated" itemprop="datePublished" pubdate="">
						<?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?>
						</span>
	</div>
<?php
echo '</div>';
//evolve_featured_image( '1' );
 ?>

	<div class="col-7 with_expand_link">
		<div class="inner_content">
<?php
if (isset($gallery_data['image_url'])) {
    ?>
			<div class="sponsors_image">
			<img src="<?php echo $gallery_data['image_url'] ?>" width="30">
			</div>
		<?php

}
the_title('<h1 class="post-title-display" itemprop="name">', '</h1>');
?>
			<!-- <div class="col-12 expand_button">

			<div class="spotlight_expand">
				<span class="post_content_click" rel="<?php the_ID();?>_<?php echo $cat_key; ?>">Expand <div class="up_down_arrow"></div></span>
			</div>
			</div>-->
		</div>
	</div>

    <div class="post-content" style="display:none;" id="post_content_with_id_<?php the_ID();?>_<?php echo $cat_key; ?>" itemprop="mainContentOfPage">

	<?php //evolve_featured_image( '2' );

//
if (!is_page() && ((evolve_theme_mod('evl_post_layout', 'two') != "one" || (evolve_theme_mod('evl_post_layout', 'two') == "one" && evolve_theme_mod('evl_excerpt_thumbnail', '0') == "1")))) {
    //Description
    //the_excerpt(); ?>

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

    evolve_post_meta('header');

    //time and post by
    if (is_search()) {
        the_excerpt();
    } else {
        the_content();
    }

    evolve_wp_link_pages();

    ?>
		    <!-- .post-content -->

				<?php if (!is_page() && (((evolve_theme_mod('evl_post_layout', 'two') != "one" || evolve_theme_mod('evl_post_layout', 'two') == "one" && evolve_theme_mod('evl_excerpt_thumbnail', '0') == "1") && (comments_open() || get_comments_number() || evolve_get_terms('cats') || evolve_get_terms('tags') || (evolve_theme_mod('evl_share_this', 'single') == "single_archive" && !is_home()) || (evolve_theme_mod('evl_share_this', 'single') == "all"))))) {?>

				    <div class="row post-meta post-meta-footer align-items-top">

						<?php evolve_post_meta('footer');

        if (evolve_theme_mod('evl_post_layout', 'two') != "one" && (comments_open() || get_comments_number()) && !is_search()) {?>

				            <div class="col-md-6 comment-count">

								<?php echo evolve_get_svg('comment');
            comments_popup_link(__('Leave a Comment', 'evolve'), __('1 Comment', 'evolve'), __('% Comments', 'evolve')); ?>

				            </div><!-- .col .comment-count -->

						<?php }

        evolve_sharethis();?>

				    </div><!-- .row .post-meta .post-meta-footer .align-items-top -->

				<?php }?>

		    <a class="btn btn-sm" href="<?php the_permalink();?>">

				<?php _e('Read More', 'evolve');?>

		    </a>

<?php } else {

    if (is_search()) {
        the_excerpt();
    } else {
        the_content();
    }

    evolve_wp_link_pages();?>
<div class="row col-12">
<div class="spotlight_expand_back"><span class="post_content_click" rel="<?php the_ID();?>_<?php echo $cat_key; ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/up_gray.png" width="25"></span> </div>
</div>

    </div><!-- .post-content -->

	<?php if (!is_page() && ((is_single() || (evolve_theme_mod('evl_post_layout', 'two') == "one") && (comments_open() || get_comments_number() || evolve_get_terms('cats') || evolve_get_terms('tags') || (evolve_theme_mod('evl_share_this', 'single') == "single_archive" && !is_home()) || (evolve_theme_mod('evl_share_this', 'single') == "all"))))) {?>

        <div class="row post-meta post-meta-footer align-items-top">

			<?php evolve_post_meta('footer');
        evolve_sharethis();?>

        </div><!-- .row .post-meta .post-meta-footer .align-items-top -->

	<?php }
}?>
<!-- </div> -->
</div>
</article><!-- .post -->

