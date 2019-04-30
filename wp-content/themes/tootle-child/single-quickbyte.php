<?php

/*
    Single Post Part
    ======================================= */

/*
    Header Area
    --------------------------------------- */

get_header();

/*
	Before Content Area

	---------------------------------------
	Hooked: evolve_primary_container_open() - 10
	--------------------------------------- */
?>
<div class="transparent_background_image_quickbytes"></div>
<div class="background_image_quickbytes"></div>
<div class="title_for_quick_bytes">
			<div  class="inner_quick_bytes_title">
			<span class="quick_bytes_title">QUICK BYTES</span>
			</div>
			
</div>
<?php
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


while (have_posts()) :
	the_post();

$get_meta_val = get_post_meta(get_the_id(), 'gallery_data', true);
$my_category = wp_get_post_terms(get_the_ID(), 'story_package', array("fields" => "all"));
	//var_dump( $get_meta_val);
$post_type = get_post_type();
	//echo $get_meta_val['card_type'];
$post_id = get_the_id();
//echo $post_type;
if (isset($get_meta_val['card_type']) && $get_meta_val['card_type'] == 'story') {
			//get_template_part( 'template-parts/post/content', 'post' );	
	get_template_part('template-parts/post/story', 'post');
} else if ($post_type == 'quickbyte') {
	wp_enqueue_script('owl-style-owlstart4', get_stylesheet_directory_uri() . '/js/owl.start3.js');
	echo '<div class="single_quick_bytes_background_color"></div>';
	echo '<div class="container-fluid quick_bytes_single_quick_bytes">';
	//echo '<div class="row">';

	echo quick_bytes_details_page(get_the_id(), get_the_title(), get_the_content(), get_the_author(), get_the_date(), get_the_post_thumbnail_url());
	//echo '</div>';
	echo '</div>';
		//get_template_part( 'template-parts/post/quickbytes_single', 'post' );	
} else {

	get_template_part('template-parts/post/content', 'post');
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
<style>
@media (min-width: 768px){
	footer.footer,
	div.header-overlay .menu-header.display_quickbytes_option,
	#sticky_menu_rotate{
		display:none !important;
	}
#primary_custom{
	    max-width: 60%;
    margin: 0 auto;
    margin-top: 80px;
}
#primary_custom article {
    margin: 0 auto;
    width: 191px;
    height: 276px;
    float: left;
    margin-right: 15px;
    margin-left: 15px;
    margin-bottom: 45px;
	position: relative;
	z-index: 101;
}
.owl-buttons .owl-next .fa-stack svg,
.owl-buttons .owl-prev .fa-stack svg {
	width: 30px;
}
.container-fluid {
	width: 85%;
}
svg.svg-inline--fa.fa-chevron-left.fa-w-10,
.fa-stack .svg-inline--fa.fa-chevron-right.fa-w-10 {
    color: #fff;
}
#primary_custom article .row.quickbytes_image {
    border-radius: 10px;
    background-size: cover;
    height: 276px;
    object-fit: cover;
}
.post-title-display {
    z-index: 6000;
    position: relative;
    display: block;
    color: white;
}
 .col-3.padding_left {
    max-width: 100%;
    max-height: 40px;
}
 .col-9.with_expand_link {
    max-width: 100%;
    flex: auto;
    padding: 0;
    z-index: 300;
    position: relative;
    display: inline-flex;
}
.date_time,h1.post-title,.row.post-meta.align-items-center,
.row.post-meta.post-meta-footer.align-items-top,
a.btn.btn-sm{
	display:none;
}
.transparent_background_image_quickbytes{
		    background-color: black;
			width: 100%;
			position: fixed;
			height: 100%;
			top: 0;
			left: 0;
			z-index: 1;
		
	}
	.title_for_quick_bytes{
		width: 100%;
    z-index: 100;
    color: white;
	}
	.inner_quick_bytes_title{
		    text-align: center;
	}
	.inner_quick_bytes_title{
		    text-align: center;
	}
	span.quick_bytes_title{
		font-family: 'Cabin-Bold', 'Cabin Bold', 'Cabin';
    font-weight: 700;
    font-style: normal;
    font-size: 40px;
    color: #FFFFFF;
    text-align: center;
	
	padding-bottom: 10px;
	}
	.top_header_area_for_desktop .middle_image .middle_image_inner{
		margin-top: 141px;
		margin-left: -160px;
		z-index: 101;
	}
	.container-fluid .quick_bytes_details_class{
		z-index:101;
	}
}
</style>
<div id="primary_custom" class="col-sm-12">
<?php
	echo quick_bytes_list();
	?>
	</div>
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