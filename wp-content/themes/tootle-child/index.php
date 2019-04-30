<?php

/*
    Main Index To Display Content
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

do_action( 'evolve_before_content_area' );
if(isset($_GET['meta']) && $_GET['meta']=='top-stories'){
?>
<style>
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
}
//echo $_GET['meta'];
if ( have_posts() ) :

	/*
		Before Posts Loop

		---------------------------------------
		Hooked: evolve_pagination_before() - 10
				evolve_posts_loop_open() - 20
		--------------------------------------- */
	$ki=1;
	do_action( 'evolve_before_posts_loop' );
	$total_post_count = total_post_count();

	while ( have_posts() ) :
		the_post();
		get_template_part( 'template-parts/post/content', 'post' );
	endwhile;

	/*
		After Posts Loop

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