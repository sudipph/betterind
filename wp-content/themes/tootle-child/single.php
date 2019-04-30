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

?>
<style>
@media (min-width: 768px) {
	div.row.solarticle.content-post{
		    width: 80%;
	}
}

@media (min-width: 768px) {
		div.row.top-stories.content-post div.posts.card-columns article{
			border:0;
			padding-bottom:0;
		}
		.share_beside_author.content_post_unique{
			display:none;
		}
		article .post-content,
			.list-group .container-fluid .post-content {
				width: 60%;
				/* width: 100%; */
				float: right;
				position: relative;
			}
}

</style>
<?php
//echo $get_meta_val['card_type'];
while (have_posts()) :
	the_post();

$get_meta_val = get_post_meta(get_the_id(), 'gallery_data', true);
$my_category = wp_get_post_terms(get_the_ID(), 'story_package', array("fields" => "all"));
	//var_dump( $get_meta_val);
$post_type = get_post_type();
//echo $get_meta_val['card_type'];
//$terms_placement = get_the_terms( get_the_ID() , array( 'placement') );
$terms_placement = wp_get_post_terms(get_the_ID(), 'placement', array("fields" => "slugs"));
$post_id = get_the_id();

$topstories = false;
$top_story_check = in_array('top-stories',$terms_placement);
if($top_story_check==true){
	$topstories = true;
}
//

//echo 'aa';
// var_dump($topstories);
// var_dump($terms_placement);
// echo $get_meta_val['card_type'].'-';
//echo $get_meta_val['card_type'];

if (isset($get_meta_val['card_type']) && $get_meta_val['card_type'] == 'successstory' && (isset($_GET['placement']) && $_GET['placement']=='success') ) {
	?>
	<style>
	@media (min-width: 768px) {
		div.row.solarticle.content-post{
				width: 100%;
		}
	}
	</style>
	<?php
		get_template_part( 'template-parts/post/successstorycontent', 'post' );	
}elseif (isset($get_meta_val['card_type']) && $get_meta_val['card_type'] == 'story') {

	///get_template_part( 'template-parts/post/content', 'post' );	
	get_template_part('template-parts/post/story', 'post');
	//&& (isset($_GET['placement']) && $_GET['placement']=='sol') 
}elseif(isset($get_meta_val['card_type']) && $get_meta_val['card_type'] == 'pod_cast'){
	
	?>
	<style>
	@media (min-width: 768px) {
		div.row.top-story.content-post{
				width: 85%;
		}
	}
	</style>

	<?php
			//get_template_part( 'template-parts/post/content', 'post' );	
	get_template_part('template-parts/post/pod_cast', 'post');
}elseif(isset($get_meta_val['card_type']) && $get_meta_val['card_type'] == 'video'){
	
	?>
	<style>
	@media (min-width: 768px) {
		div.row.top-story.content-post{
				width: 85%;
		}
	}
	</style>

	<?php
			//get_template_part( 'template-parts/post/content', 'post' );	
	get_template_part('template-parts/post/video', 'post');
}elseif(isset($get_meta_val['card_type']) && $get_meta_val['card_type'] == 'solarticle'  ) {
	?>
	<style>
	@media (min-width: 768px) {
		div.row.solarticle.content-post{
				width: 100% !important;
		}
	}
	</style>
	<?php
	//get_template_part('template-parts/post/content-solution', 'post');
	get_template_part('template-parts/post/content_solarticle', 'post');
} else if ($post_type == 'quickbyte') {

	echo '<div class="container-fluid">';
	echo '<div class="row">';

	echo quick_bytes_details_page(get_the_id(), get_the_title(), get_the_content(), get_the_author(), get_the_date(), get_the_post_thumbnail_url());
	echo '</div>';
	echo '</div>';
		//get_template_part( 'template-parts/post/quickbytes_single', 'post' );	
}elseif($topstories == true ||$get_meta_val['card_type']=='top-stories'){
	//echo 'top_stories';
	?>
	<style>
	@media (min-width: 768px) {
		div.row.top-story.content-post{
				width: 85%;
		}
	}
	</style>

	<?php
			//get_template_part( 'template-parts/post/content', 'post' );	
	get_template_part('template-parts/post/topstories', 'post');
} else{
		get_template_part( 'template-parts/post/content', 'post' );	
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
if (isset($get_meta_val['card_type']) && $get_meta_val['card_type'] == 'successstory' && (isset($_GET['placement']) && $_GET['placement']=='success') ) {
}else if ($post_type == 'quickbyte') {

	?>
				<script type="text/javascript">
			jQuery(document).ready(function() {
				//jQuery(".main-slider-container").basicSlider();
			});
			</script>
		<?php
		
} else if (isset($get_meta_val['card_type']) && $get_meta_val['card_type'] == 'solarticle' && (isset($_GET['placement']) && $_GET['placement']=='sol')  ) {
	//related_story_show_footer($my_category[0]->term_id, $post_id);
} else if (isset($get_meta_val['card_type']) && $get_meta_val['card_type'] == 'story') {
	related_story_show_footer($my_category[0]->term_id, $post_id);
}else if(isset($get_meta_val['card_type']) && $get_meta_val['card_type'] == 'top-stories'){
	do_action('evolve_sidebars_area');
	echo ajax_load_more_post($post_id);
}else if(isset($get_meta_val['card_type']) && $get_meta_val['card_type'] == 'video'){
	
}else if(isset($get_meta_val['card_type']) && $get_meta_val['card_type'] == 'pod_cast'){
	
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