<?php
global $my_category,$post;
$class_helper = '';

$class_helper .= isset($my_category)?$my_category:'';
$gallery_data = get_post_meta(get_the_ID(), 'gallery_data', true);
?>
<article id="post-<?php the_ID();?>" <?php post_class('story-post-content-page');?> itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
<?php
$cat = get_the_category();
?>

    <div class="post-content position_unset story-post" itemprop="mainContentOfPage">
		<div class="story_package_top_block">
			<div class="story_package_title_box">
				<div class="col category" style="border:1px solid;"><?php echo $cat[0]->name ?></div>
				<div class="story_pack_title"><?php echo $my_category[0]->name; ?></div>
			</div>
			<div class="row story_package_sub_block">
				<div class="story_time_line">Story Time Line</div>
				<?php related_story_show($my_category[0]->term_id, get_the_ID());?>
			</div>
		</div>

		<?php
		echo '<div class="thumbnail-post-single" id="dinamic_height_with_title">';
		the_post_thumbnail('full', array('class' => 'd-block w-100', 'itemprop' => 'image'));
		echo '</div>';
		?>
	</div>
	<div class="content_title_box">
					<?php

if (is_single() || is_page()) {

    if (get_post_meta($post->ID, 'evolve_page_title', true) == "yes" || get_post_meta($post->ID, 'evolve_page_title', true) == "") {
        the_title('<h1 class="post-title" itemprop="name" id="dinamic_title_height">', '</h1>');
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
	<div class="row post-meta align-items-center story_post">
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
		</div>
		<div class="share_beside_author story-post"><?php share();?></div>	
	</div>
</div>
<div class="main_content">

						<?php
//evolve_post_meta( 'header' );

//time and post by
if (is_search()) {
    the_excerpt();
} else {
	echo change_first_content(get_the_content());
    //the_content();
}

//    evolve_wp_link_pages();

?>
		    <!-- .post-content -->

				<?php /*if ( ! is_page() && ( ( ( evolve_theme_mod( 'evl_post_layout', 'two' ) != "one" || evolve_theme_mod( 'evl_post_layout', 'two' ) == "one" && evolve_theme_mod( 'evl_excerpt_thumbnail', '0' ) == "1" ) && ( comments_open() || get_comments_number() || evolve_get_terms( 'cats' ) || evolve_get_terms( 'tags' ) || ( evolve_theme_mod( 'evl_share_this', 'single' ) == "single_archive" && ! is_home() ) || ( evolve_theme_mod( 'evl_share_this', 'single' ) == "all" ) ) ) ) ) { ?>

<div class="row post-meta post-meta-footer align-items-top">

<?php evolve_post_meta( 'footer' );

if ( evolve_theme_mod( 'evl_post_layout', 'two' ) != "one" && ( comments_open() || get_comments_number() ) && ! is_search() ) { ?>

<div class="col-md-6 comment-count">

<?php echo evolve_get_svg( 'comment' );
comments_popup_link( __( 'Leave a Comment', 'evolve' ), __( '1 Comment', 'evolve' ), __( '% Comments', 'evolve' ) ); ?>

</div><!-- .col .comment-count -->

<?php }

//evolve_sharethis(); ?>

</div><!-- .row .post-meta .post-meta-footer .align-items-top -->

<?php }*/

primary_cta($gallery_data);
?>

		    
            <div class="share_button"><?php echo do_shortcode('[Sassy_Social_Share] ') ?></div>
<div class="author_details_outline only_for_desktop_view"><?php get_user_info_box(get_the_author_meta('ID'));?></div>
<?php /*} else {

if ( is_search() ) {
the_excerpt();
} else {
the_content();
}

evolve_wp_link_pages(); ?>

</div><!-- .post-content -->

<?php if ( ! is_page() && ( ( is_single() || ( evolve_theme_mod( 'evl_post_layout', 'two' ) == "one" ) && ( comments_open() || get_comments_number() || evolve_get_terms( 'cats' ) || evolve_get_terms( 'tags' ) || ( evolve_theme_mod( 'evl_share_this', 'single' ) == "single_archive" && ! is_home() ) || ( evolve_theme_mod( 'evl_share_this', 'single' ) == "all" ) ) ) ) ) { ?>

<div class="row post-meta post-meta-footer align-items-top">

<?php evolve_post_meta( 'footer' );
evolve_sharethis(); ?>

</div><!-- .row .post-meta .post-meta-footer .align-items-top -->

<?php }
} */?>
</div>
</article><!-- .post -->

