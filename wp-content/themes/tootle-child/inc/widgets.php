<?php

function evolve_widgets_init() {

	/*
	   Register Sidebar Widgets
	   ======================================= */

	register_sidebar( array(
		'name'          => __( 'Sidebar 1', 'evolve' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<div class="widget-before-title"><div class="widget-title-background"></div><h3 class="widget-title">',
		'after_title'   => '</h3></div>',
	) );

	register_sidebar( array(
		'name'          => __( 'Sidebar 2', 'evolve' ),
		'id'            => 'sidebar-2',
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<div class="widget-before-title"><div class="widget-title-background"></div><h3 class="widget-title">',
		'after_title'   => '</h3></div>',
	) );

	/*
	   Register Header Widgets
	   ======================================= */
	$evolve_header_widgets = '1';
	if ( ( evolve_theme_mod( 'evl_widgets_header', 'disable' ) == "one" ) ) {
		$evolve_header_widgets = '1';
	}

	if ( ( evolve_theme_mod( 'evl_widgets_header', 'disable' ) == "two" ) ) {
		$evolve_header_widgets = '2';
	}

	if ( ( evolve_theme_mod( 'evl_widgets_header', 'disable' ) == "three" ) ) {
		$evolve_header_widgets = '3';
	}

	if ( ( evolve_theme_mod( 'evl_widgets_header', 'disable' ) == "four" ) ) {
		$evolve_header_widgets = '4';
	}

	$evolve_header_widgets_args_one = array(
		'name'          => __( 'Header 1', 'evolve' ),
		'id'            => 'header',
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<div class="widget-before-title"><div class="widget-title-background"></div><h3 class="widget-title">',
		'after_title'   => '</h3></div>',
	);

	$evolve_header_widgets_args_more = array(
		'name'          => __( 'Header %d', 'evolve' ),
		'id'            => 'header',
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<div class="widget-before-title"><div class="widget-title-background"></div><h3 class="widget-title">',
		'after_title'   => '</h3></div>',
	);

	if ( $evolve_header_widgets == '1' ) {
		register_sidebar( $evolve_header_widgets_args_one );
	} else {
		register_sidebars( $evolve_header_widgets, $evolve_header_widgets_args_more );
	}

	/*
	   Register Footer Widgets
	   ======================================= */
	$evolve_footer_widgets = '1';
	if ( ( evolve_theme_mod( 'evl_widgets_num', 'disable' ) == "one" ) ) {
		$evolve_footer_widgets = '1';
	}

	if ( ( evolve_theme_mod( 'evl_widgets_num', 'disable' ) == "two" ) ) {
		$evolve_footer_widgets = '2';
	}

	if ( ( evolve_theme_mod( 'evl_widgets_num', 'disable' ) == "three" ) ) {
		$evolve_footer_widgets = '3';
	}

	if ( ( evolve_theme_mod( 'evl_widgets_num', 'disable' ) == "four" ) ) {
		$evolve_footer_widgets = '4';
	}

	$evolve_footer_widgets_args_one = array(
		'name'          => __( 'Footer 1', 'evolve' ),
		'id'            => 'footer',
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<div class="widget-before-title"><div class="widget-title-background"></div><h3 class="widget-title">',
		'after_title'   => '</h3></div>',
	);

	$evolve_footer_widgets_args_more = array(
		'name'          => __( 'Footer %d', 'evolve' ),
		'id'            => 'footer',
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<div class="widget-before-title"><div class="widget-title-background"></div><h3 class="widget-title">',
		'after_title'   => '</h3></div>',
	);

	if ( $evolve_footer_widgets == '1' ) {
		register_sidebar( $evolve_footer_widgets_args_one );
	} else {
		register_sidebars( $evolve_footer_widgets, $evolve_footer_widgets_args_more );
	}

	/*
	   Tabs Widget
	   ======================================= */

	get_template_part( 'inc/tabs-widget' );
	get_template_part( 'inc/tabs-widget1' );
}

add_action( 'widgets_init', 'evolve_widgets_init' );