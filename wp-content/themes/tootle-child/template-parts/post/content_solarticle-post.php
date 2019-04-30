<?php

/*
Displays Post Content
======================================= */
//var_dump($GLOBALS);
global $ki,$ct;
//echo $GLOBALS['wp_query']->request;
$banner_option = check_page_settings();
//echo 'solarticle'.$ct;
$class_helper = '';
$top_story = $_GET['meta'];
$class_helper .= isset($top_story)?$top_story:'';
$c_card_type = 'solarticle';
$class_helper .= ' '.$ct;
$gallery_data = get_post_meta(get_the_ID(), 'gallery_data', true);
echo $class_helper;
//var_dump($gallery_data);
//$category = get_the_category();
$terms = get_the_terms( $post->ID , array( 'solutions_library') );
$color_picker = '#024A4F';
if(isset($terms[0]->term_id)){
    $color_picker = get_term_meta($terms[0]->term_id, 'color-picker', true);
    //var_dump($color_picker);
}
//echo $color_picker;
//var_dump($terms[0]->term_id);
$color_picker = (isset($color_picker) && $color_picker!=''?$color_picker:'#024A4F');
//var_dump($color_picker);
//
?>
<style>
.full_area h3{
    color:<?php echo (isset($color_picker)?$color_picker:'');?>;
}
#mainNav .active a{
    color:<?php echo (isset($color_picker)?$color_picker:'');?>;
    font-size:20px;
}
.universal_solution_article_color{
    color:<?php echo (isset($color_picker)?$color_picker:'');?>;
}
.universal_solution_article_backcolor{
    background-color:<?php echo (isset($color_picker)?$color_picker:'');?> !important;
}
.solution_article_title {
    border-left: 3px solid <?php echo (isset($color_picker)?$color_picker:'');?> !important;
    border-right: 3px solid <?php echo (isset($color_picker)?$color_picker:'');?> !important;
}
.right_area section{
    border-top:3px solid <?php echo (isset($color_picker)?$color_picker:'');?>;
}
</style>
<article id="post-<?php the_ID();?>" <?php post_class($class_helper.' content-post content_post_'.(isset($ki)?$ki:$ki));?> itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
<div class="solution_article_separator" style="background-color:<?php echo (isset($color_picker)?$color_picker:'');?>">
<div class="solution_article_inner">
	<?php
echo '<div class="post-content" itemprop="mainContentOfPage">';
the_post_thumbnail('evolve-post-thumbnail', array('class' => 'd-block w-100', 'itemprop' => 'image'));
$category = get_the_category();
if (isset($category[0]->name)) {
    ?>
		 <!-- <div class="col category"><?php echo $category[0]->name; ?></div> -->
		<?php
}
echo '</div>';
?>
	<?php 
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
    <div class="count_success_story"><?php echo get_solution_count_by_post_id(get_the_ID(),true);?> Success Stories</div>
    
   </div>

<div class="share_button_position set_height">
    <?php echo share_button_icon(30);?>
    </div>

   </div>
   </div>
<div id="close_left_panel"></div>
   <div class="main_content content_solarticle_post">
    <div class="full_area">
        <div class="short_content"><?php the_excerpt();?></div>
        <div class="left_area">
<?php  left_menu_scroller();?>
        </div>
        <div class="right_area">

        
        <?php
        $arr = return_array_for_scroller();
        $i=1;
        foreach($arr as $k=>$vall){
         $k = str_replace(' ','_',$k);
         $k = strtolower($k);
        ?>
        <section id="<?php echo $k;?>"><h2 class="solution_article_title"><?php echo $vall;?></h2>
        <?php   
        //echo $k;
        if($k=='general'){
            $general_info = isset($gallery_data['general_info'][$c_card_type]) ? $gallery_data['general_info'][$c_card_type] : '';
            echo '<div class="'.$k.'">'.$general_info.'</div>';
        }
        if($k=='estimated_cost'){
            $ecost = isset($gallery_data['ecost'][$c_card_type]) ? $gallery_data['ecost'][$c_card_type] : '';
            echo '<div class="'.$k.'">'.$ecost.'</div>';
        }
        if($k=='materials_required'){
            $material = isset($gallery_data['material'][$c_card_type]) ? $gallery_data['material'][$c_card_type] : '';
            echo '<div class="'.$k.'">'.$material.'</div>';
        }
        if($k=='procedure'){
            $procedure = isset($gallery_data['procedure'][$c_card_type]) ? $gallery_data['procedure'][$c_card_type] : '';
            echo '<div class="'.$k.'">'.$procedure.'</div>';
        }
        if($k=='expected_results'){
            $expected = isset($gallery_data['expected'][$c_card_type]) ? $gallery_data['expected'][$c_card_type] : '';
            echo '<div class="'.$k.'">'.$expected.'</div>';
        }    
        ?>
        </section>
          <!-- <li class="<?php echo ($i==1?'active':'')?>"><a href="#<?php echo $k;?>"><?php echo $vall;?></a></li> -->
          <?php
          $i++;
        }
        ?>
        

        </div>

       </div>
					<?php

    //time and post by
    // if (is_search()) {
    //     the_excerpt();
    // } else {
    //     the_content();
    // }

    evolve_wp_link_pages();

    ?>
		    <!-- .post-content -->

				<?php if (!is_page() && (((evolve_theme_mod('evl_post_layout', 'two') != "one" || evolve_theme_mod('evl_post_layout', 'two') == "one" && evolve_theme_mod('evl_excerpt_thumbnail', '0') == "1") && (comments_open() || get_comments_number() || evolve_get_terms('cats') || evolve_get_terms('tags') || (evolve_theme_mod('evl_share_this', 'single') == "single_archive" && !is_home()) || (evolve_theme_mod('evl_share_this', 'single') == "all"))))) {?>

				   <?php ?><!-- .row .post-meta .post-meta-footer .align-items-top -->

				<?php }?>
    
   
            
             <?php
            primary_cta($gallery_data);
            ?>
            <!-- <div class="share_button"><?php echo do_shortcode('[Sassy_Social_Share] ') ?></div> -->
            <div class="row success_story_button big">
                <div class="covr" style="">
                    <button  type="button" style="color:<?php echo $color_picker;?>;border-color:<?php echo $color_picker;?>" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                    <?php _e('I HAVE A SUCCESS STORY', 'evolve');?>
                    </button>
                </div>
                <?php $total_success_story = get_solution_count_by_post_id(get_the_ID(),true);?>
                <div class="success_story_count_button_cover">
                    <div class="success_story_count_button" style=""> See <?php echo $total_success_story;?> Success Stories </div>
                    <!-- <div class="arrow"><i class="far fa-angle-down"></i></div> -->

                </div>

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

            </div>
        </div>
            

<?php 
} else {

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
}
$ki++;?>

</article><!-- .post -->

