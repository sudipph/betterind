<?php

/*
    Single Post Part
    ======================================= */

/*
    Header Area
    --------------------------------------- */
	$ct = 'single_success_stories';
get_header();

/*
	Before Content Area

	---------------------------------------
	Hooked: evolve_primary_container_open() - 10
	--------------------------------------- */

do_action('evolve_before_content_area');

/*
	Before Post Title

	---------------------------------------
	Hooked: evolve_breadcrumbs() - 10
	--------------------------------------- */

do_action('evolve_before_post_title');

/*
	Before Post Content

	---------------------------------------
	Hooked: evolve_pagination_before() - 10
	--------------------------------------- */

do_action('evolve_before_post_content');

echo 'aaaaaaaaaaaaaaaaaaaaaaa';
while (have_posts()) :
	the_post();

$post_id = get_the_id();
echo get_the_ID();
$get_meta_val = get_post_meta($post_id , 'gallery_data', true);
echo $post_id;
  //$gallery_data = get_post_meta($post_id , 'gallery_data', true);
$my_category = wp_get_post_terms(get_the_ID(), 'story_package', array("fields" => "all"));
	//var_dump( $get_meta_val);
$post_type = get_post_type();
	

//echo $post_type;
var_dump($get_meta_val);
echo $get_meta_val['card_type'];

if ($get_meta_val['card_type'] == 'story') {
			//get_template_part( 'template-parts/post/content', 'post' );	
	get_template_part('template-parts/post/story', 'post');
} else if ($post_type == 'quickbyte') {

	echo '<div class="container-fluid">';
	echo '<div class="row">';
	echo quick_bytes_details_page(get_the_id(), get_the_title(), get_the_content(), get_the_author(), get_the_date(), get_the_post_thumbnail_url());
	echo '</div>';
	echo '</div>';
		//get_template_part( 'template-parts/post/quickbytes_single', 'post' );	
}else if ($post_type == 'success_stories') {
	get_template_part('template-parts/post/content', 'post');
} else {
//echo 'content';
	get_template_part('template-parts/post/content_solarticle', 'post');
}


	/*
		After Post Content

		---------------------------------------
		Hooked: evolve_similar_posts() - 10
				evolve_pagination_after() - 20
				evolve_comments_template() - 30
		--------------------------------------- */

do_action('evolve_after_post_content');

endwhile;

/*
   	After Content Area

	---------------------------------------
	Hooked: evolve_primary_container_close() - 10
	--------------------------------------- */

do_action('evolve_after_content_area');

/*
	Sidebars

	---------------------------------------
	Hooked: evolve_sidebars() - 10
	--------------------------------------- */
	//echo $get_meta_val['card_type'];
if ($post_type == 'quickbyte') {

	?>
				<script type="text/javascript">
			jQuery(document).ready(function() {
				//jQuery(".main-slider-container").basicSlider();
			});
			</script>
		<?php
		/*
		
		//?>

		<style>
		
		#slider-wrapper {
			
			width: 100%;
    		height: auto;
		}
		#slider {width:100%; height:400px; position:relative;}
		.sp {width:100%; height:auto; position:absolute;}
		.background_image{
			background-size: cover;
    		background-repeat: no-repeat;
		}
		#nav {
			
			width:100%;
			position: absolute;
			bottom: 28%;}
		#button-previous {float:left;}
		#button-next {float:right;}
		</style>

		<script>
		jQuery(document).ready(function(){
			jQuery('.sp').first().addClass('active');
			jQuery('.sp').hide();    
			jQuery('.active').show();
			
			jQuery('#button-next').click(function(){
			
				jQuery('.active').removeClass('active').addClass('oldActive');    
							   if ( jQuery('.oldActive').is(':last-child')) {
					jQuery('.sp').first().addClass('active');
					}
					else{
						jQuery('.oldActive').next().addClass('active');
					}
					jQuery('.oldActive').removeClass('oldActive');
					
					
					jQuery(".sp").animate({right: "360px"},
					{ 
						complete : function(){
							//jQuery(".red_color_logo").css('display','none');
							jQuery(".active").css("left", "360px");
							jQuery(".active").animate({left: "0px"});
						}
					});

					//jQuery('.sp').fadeOut();
					//jQuery('.active').fadeIn();
					
					
				});
				
				jQuery('#button-previous').click(function(){
					jQuery('.active').removeClass('active').addClass('oldActive');    
					   if ( jQuery('.oldActive').is(':first-child')) {
						jQuery('.sp').last().addClass('active');
					}
					   else{
						jQuery('.oldActive').prev().addClass('active');
					   }
					   jQuery('.oldActive').removeClass('oldActive');
					   jQuery('.sp').fadeOut();
					   jQuery('.active').fadeIn();
				});
					
			});
		</script>
		<?php
	 */
} else if ($get_meta_val['card_type'] == 'story') {
	related_story_show_footer($my_category[0]->term_id, $post_id);
} else if ($post_type == 'post') {
	do_action('evolve_sidebars_area');

	echo ajax_load_more_post($post_id);

} else {

	do_action('evolve_sidebars_area');
}
/*
	Footer Area
	--------------------------------------- */

get_footer();