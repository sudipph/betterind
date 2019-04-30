<?php
/*
Template Name: TBI Corner Template
 */

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

$category_arr = get_category_by_post('tbicorners');
//var_dump($category_arr);
foreach ($category_arr as $cat_key => $cat_value) {

    $wpb_all_query = new WP_Query(array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'cat' => $cat_key,
        'meta_query' => array(
            array(
                'key' => 'gallery_data',
                'value' => 'tbicorners',
                'compare' => 'like',
            ),
        ),
        'posts_per_page' => -1));
    echo '<div class="row spotlight_heading" ><div class="col-12"><div class="category_title_spotlight">' . $cat_value . '</div></div><div class="see_all"><span>See All</span></div></div>';
    if ($wpb_all_query->have_posts()):

        while ($wpb_all_query->have_posts()): $wpb_all_query->the_post();

            get_template_part('template-parts/post/tbicorners', 'post');

            /*
            After Post Content

            ---------------------------------------
            Hooked: evolve_comments_template() - 30
            --------------------------------------- */

            //do_action( 'evolve_after_post_content' );

        endwhile;

    endif;
}
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

//do_action( 'evolve_sidebars_area' );

/*
Footer Area
--------------------------------------- */

get_footer();
