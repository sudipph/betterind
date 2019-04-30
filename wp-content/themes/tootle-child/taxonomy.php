<?php
/**
* A Simple Category Template
*/
   
$ct = 'taxonomy_template';
get_header();

/*
	Before Content Area

	---------------------------------------
	Hooked: evolve_primary_container_open() - 10
	--------------------------------------- */

do_action( 'evolve_before_content_area' );
//echo 'taxo';
if ( have_posts() ) :

	/*
		Before Post Title

		---------------------------------------
		Hooked: evolve_breadcrumbs() - 10
				evolve_archive_page_title() - 20
		--------------------------------------- */

	//do_action( 'evolve_before_post_title' );

	/*
		Before Archive Loop

		---------------------------------------
		Hooked: evolve_pagination_before() - 10
				evolve_posts_loop_open() - 20
		--------------------------------------- */

	do_action( 'evolve_before_posts_loop' );
	
	$taxonomy = get_query_var( 'taxonomy' );

	//echo $taxonomy;
	if($taxonomy=='solutions_library'){
		?>
		<style>
		@media (min-width: 768px){
			div.row.content-post.taxonomy_template{
				width:100%;
			}
		}

			</style>
		<?php
		$term = get_queried_object();
		//var_dump($term->term_id);
		//echo $term->name;
		
		custom_banner_section($term->name,$term->description,$term->term_id);
		get_post_id_array($term->term_id);
		echo '<section class="solution_article_by_post_id">';
		echo do_shortcode('[TBI_solution_article term_id="'.$term->term_id.'" title="'.$term->name.'" ]');
		echo '</section>';
		echo '<section class="success_story_by_post_id">';
		echo do_shortcode('[TBI_success postarr="true" tax_id="'.$term->term_id.'" count="3" title="SUCCESS STORIES" seeall="true" story_button="true"]');
		echo '</section>';

	}else{
		while ( have_posts() ) :
			the_post();
			//echo get_the_category();
			
			//get_template_part( 'template-parts/post/content_taxonomy', 'post' );
		endwhile;
	}
	

	/*
		After Archive Loop

	---------------------------------------
	Hooked: evolve_posts_loop_close() - 10
			evolve_pagination_after() - 20
	--------------------------------------- */

	do_action( 'evolve_after_posts_loop' );

else :

	get_template_part( 'template-parts/post/content', 'none' );

endif;

/*
   	After Content Area

	---------------------------------------
	Hooked: evolve_primary_container_close() - 10
	--------------------------------------- */

do_action( 'evolve_after_content_area' );

/*
	Sidebars

	---------------------------------------
	Hooked: evolve_sidebars() - 10
	--------------------------------------- */

do_action( 'evolve_sidebars_area' );

/*
	Footer Area
	--------------------------------------- */

get_footer();