<?php

/*
Displays Post Content
======================================= */
//var_dump($GLOBALS);
global $ki,$post_type,$post;

//echo $GLOBALS['wp_query']->request;
$banner_option = check_page_settings();
//var_dump( $banner_option);
//echo 'hello';
//die();
$class_helper = '';
$top_story = $_GET['meta'];
$class_helper .= isset($top_story)?$top_story:'';

$gallery_data = get_post_meta(get_the_ID(), 'gallery_data', true);

?>

<article id="post-<?php the_ID();?>" <?php post_class($class_helper.' content-post content_post_'.(isset($ki)?$ki:$ki));?> itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">

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

                <div class="disabled_in_mobile_view">
                    <div class="sponsors_title_with_images">
                        <?php
                        //var_dump($gallery_data);
if (isset($gallery_data['image_desc'])) {
    ?> 
                        <div class="sponsors_title">
                        <?php echo $gallery_data['image_desc']?>
                    </div> 
                    <?php
}
if (isset($gallery_data['image_url'])) {
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

    //evolve_post_meta( 'header' );
    evolve_post_meta('custom');

    ?>
   </div>
   <div class="main_content">
   <!-- <div class="main_semi_content"> -->
   
					<?php

    //time and post by
    if (is_search()) {
        the_excerpt();
    } else {
        //the_content();
        the_excerpt();
    }

    evolve_wp_link_pages();

    ?>
		    

				<?php if (!is_page() && (((evolve_theme_mod('evl_post_layout', 'two') != "one" || evolve_theme_mod('evl_post_layout', 'two') == "one" && evolve_theme_mod('evl_excerpt_thumbnail', '0') == "1") && (comments_open() || get_comments_number() || evolve_get_terms('cats') || evolve_get_terms('tags') || (evolve_theme_mod('evl_share_this', 'single') == "single_archive" && !is_home()) || (evolve_theme_mod('evl_share_this', 'single') == "all"))))) {?>

				  

				<?php }?>
    
    
            
            <?php
            //primary_cta($gallery_data);
            ?>
            <div class="share_button"><?php echo do_shortcode('[Sassy_Social_Share] ') ?></div>
        </div>
            
        <div class="read_more_option read_more_hide_option_<?php echo get_the_ID();?>">
				
                <a class="btn btn-sm" href="<?php echo get_permalink();?>">

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
$ki++;

?>

<!-- <div class="row next_bar_border" style="margin-top: 6vh;"><div class="next_post_border">Next Post</div></div> -->
</article><!-- .post -->

