<?php

/*
Displays Post Content
======================================= */
//var_dump($GLOBALS);
//echo $GLOBALS['wp_query']->request;
$gallery_data = get_post_meta(get_the_ID(), 'gallery_data', true);
//var_dump($gallery_data);
?>

<article id="post-<?php the_ID();?>" <?php post_class();?> itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">

	<?php

//evolve_featured_image( '1' );
echo '<div class="thumbnail-post-single" style="position: relative;">';
the_post_thumbnail('evolve-post-thumbnail', array('class' => 'd-block w-100', 'itemprop' => 'image'));
//$category = get_the_category();

/*if (isset($category[0]->name)) {
    ?>
		 <div class="col category_display"><?php echo $category[0]->name; ?></div>
		<?php
}*/
echo '</div>';
?>

    <div class="post-content" itemprop="mainContentOfPage">

	<?php //evolve_featured_image( '2' );

//
if (!is_page() && ((evolve_theme_mod('evl_post_layout', 'two') != "one" || (evolve_theme_mod('evl_post_layout', 'two') == "one" && evolve_theme_mod('evl_excerpt_thumbnail', '0') == "1")))) {
    //echo 'Description';
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

    //evolve_post_meta( 'header' );
    //evolve_post_meta('custom');

    ?>
    <div class="row post-meta align-items-center">
				<div class="col author vcard">
				<span class="written_by_author">
				<?php echo get_avatar( get_the_author_meta( 'ID' ) , 32 );?>
				</span>
				<span class="written_by">Written by <?php echo get_the_author();?></span>
				<span class="published updated" itemprop="datePublished" pubdate="">
				<?php echo get_the_time('jS F Y');// human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?>
				</span>
					
				
				</div>
				
			</div>
            <div class="main_content_box">
					<?php

    //time and post by
    if (is_search()) {
        the_excerpt();
    } else {
        the_content();
    }

    ?>
    </div>
    <?php
    if( isset($gallery_data['general_info']['solarticle']) && null !== $gallery_data['general_info']['solarticle'] ){
    ?>
    <div class="general_info">GENERAL RECOMMENDATIONS</div>
    <div class="general_info">
        <?php echo isset($gallery_data['general_info']['solarticle'])?$gallery_data['general_info']['solarticle']:'';?>
    </div>
    <?php
    }
    if( isset($gallery_data['ecost']['solarticle']) && null !== $gallery_data['ecost']['solarticle'] ){
    ?>
    <div class="general_info">ESTIMATED COST</div>
    <div class="ecost">
        <?php echo isset($gallery_data['ecost']['solarticle'])?$gallery_data['ecost']['solarticle']:'';?>
    </div>
    <?php
    }
    if( isset($gallery_data['material']['solarticle']) && null !== $gallery_data['material']['solarticle'] ){
    ?>
    <div class="material_info_header">MATERIALS REQUIRED</div>
    <div class="material_info">
        <?php echo isset($gallery_data['material']['solarticle'])?$gallery_data['material']['solarticle']:'';?>
    </div>
    <?php
    }
    if( isset($gallery_data['procedure']['solarticle']) && null !== $gallery_data['procedure']['solarticle'] ){
    ?>
    <div class="procedure_info_header">PROCEDURE</div>
    <div class="procedure_info">
        <?php echo isset($gallery_data['procedure']['solarticle'])?$gallery_data['procedure']['solarticle']:'';?>
    </div>
    <?php
    }
    if( isset($gallery_data['expected']['solarticle']) && null !== $gallery_data['expected']['solarticle'] ){
    ?>
    <div class="expected_info_header">EXPECTED</div>
    <div class="expected_info">
        <?php echo isset($gallery_data['expected']['solarticle'])?$gallery_data['expected']['solarticle']:'';?>
    </div>
    <?php
    }
    ?>
    
    <?php
    evolve_wp_link_pages();

    ?>
		    <!-- .post-content -->

				<?php if (!is_page() && (((evolve_theme_mod('evl_post_layout', 'two') != "one" || evolve_theme_mod('evl_post_layout', 'two') == "one" && evolve_theme_mod('evl_excerpt_thumbnail', '0') == "1") && (comments_open() || get_comments_number() || evolve_get_terms('cats') || evolve_get_terms('tags') || (evolve_theme_mod('evl_share_this', 'single') == "single_archive" && !is_home()) || (evolve_theme_mod('evl_share_this', 'single') == "all"))))) {?>

				   <?php /* <div class="row post-meta post-meta-footer align-items-top">

    <?php evolve_post_meta( 'footer' );

    if ( evolve_theme_mod( 'evl_post_layout', 'two' ) != "one" && ( comments_open() || get_comments_number() ) && ! is_search() ) { ?>

    <div class="col-md-6 comment-count">

    <?php echo evolve_get_svg( 'comment' );
    comments_popup_link( __( 'Leave a Comment', 'evolve' ), __( '1 Comment', 'evolve' ), __( '% Comments', 'evolve' ) ); ?>

    </div><!-- .col .comment-count -->

    <?php }

    evolve_sharethis(); ?>

    </div> */?><!-- .row .post-meta .post-meta-footer .align-items-top -->

				<?php }?>

		    <!-- <a class="btn btn-sm" href="<?php the_permalink();?>">

				<?php _e('Read More', 'evolve');?>

		    </a> -->
            <!-- <a class="btn btn-sm" href="javascript:open_success_story('<?php echo get_the_ID();?>');">

				<?php _e('I HAVE A SUCCESS STORY', 'evolve');?>

            </a> -->
            <button  type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
  <?php _e('I HAVE A SUCCESS STORY', 'evolve');?>
</button>

<!-- Modal -->

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="z-index:9999;">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Success Story</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> <form data-toggle="validator" role="form" method="post" id="success_story">
      <input type="hidden" name="solutions_library" id="solutions_library" value="">
      <input type="hidden" name="post_id" id="post_id" value="<?php echo get_the_ID();?>">
            <div class="modal-body">
                
               
                        <div class="form-row">
                        
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Name</label>
                            <input type="text" class="form-control" name="fullname" id="fullname" placeholder="Name" required>
                            </div>  
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Email</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                            </div>
                            <div class="form-group col-md-12">
                            <label for="inputPassword4">Success Story</label>
                            <textarea name="success_story_text" class="form-control" id="success_story_text" required></textarea>
                            
                            </div>
                        </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary"  >Save changes</button>
                <!-- onClick="save_success_story();" -->
            </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="exampleSuccessmsg" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="z-index:9999;">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Success Message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
            <div class="modal-body">
                    <div class="form-row">
                    Your Story Submitted Successfully.   
                    </div>
            </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>





            <!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal"><?php _e('I HAVE A SUCCESS STORY', 'evolve');?></button>


<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="z-index:9999;">
  <div class="modal-dialog">

   
    <div class="modal-content" >
      <div class="modal-header">
          <h4 class="modal-title">Success Story</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div> -->

<?php } else {

    if (is_search()) {
        the_excerpt();
    } else {
        the_content();
    }

    evolve_wp_link_pages();?>

    </div><!-- .post-content -->

	<?php if (!is_page() && ((is_single() || (evolve_theme_mod('evl_post_layout', 'two') == "one") && (comments_open() || get_comments_number() || evolve_get_terms('cats') || evolve_get_terms('tags') || (evolve_theme_mod('evl_share_this', 'single') == "single_archive" && !is_home()) || (evolve_theme_mod('evl_share_this', 'single') == "all"))))) {?>

        <div class="row post-meta post-meta-footer align-items-top">

			<?php evolve_post_meta('footer');
        evolve_sharethis();?>

        </div><!-- .row .post-meta .post-meta-footer .align-items-top -->

	<?php }
}?>

</article><!-- .post -->

