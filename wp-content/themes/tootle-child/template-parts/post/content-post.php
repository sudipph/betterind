<?php

/*
Displays Post Content
======================================= */
//var_dump($GLOBALS);


global $ki, $post_type, $total_post_count;
//var_dump( $post->post_count);
//echo '---------------------------------------';
//echo $GLOBALS['wp_query']->request;
$banner_option = check_page_settings();
//var_dump( $banner_option);
//echo 'hello';
//die();
$class_helper = '';
$top_story = $_GET['meta'];
$class_helper .= isset($top_story) ? $top_story : '';

$gallery_data = get_post_meta(get_the_ID(), 'gallery_data', true);
$border_button = '';
if ($ki == $total_post_count) {
    $border_button = 'style="border-bottom:0;"';
}
?>

<article  id="post-<?php the_ID();?>" <?php echo $border_button;
post_class($class_helper . ' content-post content_post_' . (isset($ki) ? $ki : $ki)); ?> itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">

	<?php
echo '<div class="post-content" itemprop="mainContentOfPage">';
the_post_thumbnail('evolve-post-thumbnail', array('class' => 'd-block w-100', 'itemprop' => 'image'));
$category = get_the_category();
if (isset($category[0]->name)) {
    ?>
		 <div class="col category"><?php echo $category[0]->name; ?></div>
		<?php
}
echo '</div>';
?>



	<?php //evolve_featured_image( '2' );

//
if (!is_page() && ((evolve_theme_mod('evl_post_layout', 'two') != "one" || (evolve_theme_mod('evl_post_layout', 'two') == "one" && evolve_theme_mod('evl_excerpt_thumbnail', '0') == "1")))) {

    ?>

           <div class="content_title_box">

                <div class="disabled_in_mobile_view show_in_content">
                    
                        <?php
//var_dump($gallery_data);
    if (isset($gallery_data['image_url'])) {
//if (isset($gallery_data['image_desc'])) {
    ?>
    <div class="sponsors_title_with_images  content_post">
                        <div class="sponsors_title">
                        <?php //echo $gallery_data['image_desc']; ?>
                        In Association with
                    </div>
                    <?php
//}

    ?>
                    <div class="sponsors_images">
                        <img src="<?php echo $gallery_data['image_url'] ?>" width="30">
                    </div></div>
<?php }?>
                    
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

    //evolve_post_meta( 'header' );
    evolve_post_meta('custom','content_post_unique');

    ?>
   </div>
    <!-- <div class="inner_content_width_slider show_only_desktop">
            <?php echo do_shortcode('[manual_related_posts_new2]'); ?>
    </div> -->
   <div class="main_content width_change ">
        <div class="inner_content_width" style="width: 82%;">

					<?php

    //time and post by
    if (is_search()) {
        the_excerpt();
    } else {
        //the_content();

        $ex = get_the_excerpt();
        //echo $ex ;
        if ($ex != '') {
            $data_content = strip_tags($ex);
            $contetn_without_sp = clean_sp($data_content);
            if (preg_match('/[a-z]/i', $contetn_without_sp, $match)) {

                $fstring = $match[0];
            }
            // echo $fstring;

            //$fstring = substr(rtrim(ltrim($contetn_without_sp)), 0, 1);

            $final_string = str_replace_first($fstring, '<span class="big">' . $fstring . '</span>', $data_content);
            echo '<p>' . $final_string . '</p>';
        }

    }
?>
</div>
                    <!-- share button -->
                    <div class="right_share_button show_only_on_desktop">
                            <span class="social_icons">
                            <?php echo social_icon_with_share(true)?>
                            </span>
                            <!-- <div class="right_slider_for_related_article">
                            <?php echo do_shortcode('[manual_related_posts_new2]'); ?>
                            </div> -->
                    </div>

                    <!-- share button -->
<?php
    evolve_wp_link_pages();

    ?>


				<?php if (!is_page() && (((evolve_theme_mod('evl_post_layout', 'two') != "one" || evolve_theme_mod('evl_post_layout', 'two') == "one" && evolve_theme_mod('evl_excerpt_thumbnail', '0') == "1") && (comments_open() || get_comments_number() || evolve_get_terms('cats') || evolve_get_terms('tags') || (evolve_theme_mod('evl_share_this', 'single') == "single_archive" && !is_home()) || (evolve_theme_mod('evl_share_this', 'single') == "all"))))) {?>



				<?php }?>



            <?php
//primary_cta($gallery_data);
    ?>
            <div class="share_button"><?php echo do_shortcode('[Sassy_Social_Share] ') ?></div>
            
        </div>


        <div class="read_more_option read_more_hide_option_<?php echo get_the_ID(); ?>">

                <a class="btn btn-sm" href="<?php echo get_permalink(); ?>">

					<?php _e('Read More', 'evolve');?>

				</a>
	    </div>
<?php } else {

    if (is_search()) {
        the_excerpt();
    } else {
        the_content();
        // the_excerpt();
    }

    evolve_wp_link_pages();?>



    </div><!-- .post-content -->

	<?php if (!is_page() && ((is_single() || (evolve_theme_mod('evl_post_layout', 'two') == "one") && (comments_open() || get_comments_number() || evolve_get_terms('cats') || evolve_get_terms('tags') || (evolve_theme_mod('evl_share_this', 'single') == "single_archive" && !is_home()) || (evolve_theme_mod('evl_share_this', 'single') == "all"))))) {?>

        <div class="row post-meta post-meta-footer align-items-top">

			<?php evolve_post_meta('footer');
        evolve_sharethis();?>

        </div><!-- .row .post-meta .post-meta-footer .align-items-top -->

	<?php }
}

// echo $total_post_count;
// echo '----'.$ki;
if ($ki != $total_post_count) {
    ?>
<div class="row next_bar_border content_post" style="margin-top: 6vh;"><div class="next_post_border">Next Post</div></div>
<?php
}
$ki++;
?>
</article><!-- .post -->

