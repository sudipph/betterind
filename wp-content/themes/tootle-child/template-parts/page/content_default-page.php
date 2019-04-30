<?php

/*
Displays Page Content
======================================= */
$banner_option = check_page_settings();
$show_banner = '';
if($banner_option == 'yes'){
$show_banner = 'show_top_banner';
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class($show_banner); ?> itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
<div class="main_content view_page_title <?php echo $post->post_name;?> no_top_margin" >
	<?php if (class_exists('bbPress') && (bbp_is_reply_edit() || bbp_is_topic_edit())) {
            } else {
                if (is_page() && (get_post_meta($post->ID, 'evolve_page_title', true) == "yes" || get_post_meta($post->ID, 'evolve_page_title', true) == "")) {
                    the_title('<h1 class="post-title" itemprop="name">', '</h1>');
                    //the_title('<div class="post-title_for_mobile_view" itemprop="name">', '</div>');
                }
            }

if (evolve_theme_mod('evl_edit_post', '0') == "1") {
    if (current_user_can('edit_post', $post->ID)) :
        edit_post_link('', '<span class="btn btn-sm edit-post">' . evolve_get_svg('pencil') . '', '</span>');
    endif;
} ?>
<!-- post-content -->
    <div class="new_template_without_title" itemprop="mainContentOfPage">

		<?php the_content();

    evolve_wp_link_pages(); ?>

    </div><!-- .post-content -->
</div>
</article><!-- #post -->