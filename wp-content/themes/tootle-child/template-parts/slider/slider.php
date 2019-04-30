<?php

/*
   Displays Sliders
   ======================================= */

$evolve_slider_page_id = '';

if ( ! empty( $post->ID ) ) {
	if ( ! is_home() && ! is_front_page() && ! is_archive() ) {
		$evolve_slider_page_id = $post->ID;
	}
	if ( ! is_home() && is_front_page() ) {
		$evolve_slider_page_id = $post->ID;
	}
}
if ( is_home() && ! is_front_page() ) {
	$evolve_slider_page_id = get_option( 'page_for_posts' );
}

/*
   Bootstrap Slider
   ======================================= */

if ( ( get_post_meta( $evolve_slider_page_id, 'evolve_slider_type', true ) == 'bootstrap' && evolve_theme_mod( 'evl_bootstrap_slider_support', '0' ) == '1' ) || ( evolve_theme_mod( 'evl_bootstrap_slider', '0' ) == '1' && evolve_theme_mod( 'evl_bootstrap_slider_support', '0' ) == '1' ) ) {
	evolve_bootstrap();
}

/*
   Parallax Slider
   ======================================= */

if ( ( get_post_meta( $evolve_slider_page_id, 'evolve_slider_type', true ) == 'parallax' && evolve_theme_mod( 'evl_parallax_slider_support', '0' ) == '1' ) || ( evolve_theme_mod( 'evl_parallax_slider', '0' ) == '1' && evolve_theme_mod( 'evl_parallax_slider_support', '0' ) == '1' ) ) {
	evolve_parallax();
}

/*
   Posts Slider
   ======================================= */

if ( ( get_post_meta( $evolve_slider_page_id, 'evolve_slider_type', true ) == 'posts' && evolve_theme_mod( 'evl_carousel_slider', '0' ) == '1' ) || ( evolve_theme_mod( 'evl_posts_slider', '0' ) == '1' && evolve_theme_mod( 'evl_carousel_slider', '0' ) == '1' ) ) {
	evolve_posts_slider();
}


