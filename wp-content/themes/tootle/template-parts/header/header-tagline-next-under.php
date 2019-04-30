<?php

$evolve_title_tagline_class_2  = '';
$evolve_helper_tagline_class_2 = '';
$evolve_row_class_2            = '';

if ( ( evolve_theme_mod( 'evl_tagline_pos', 'disable' ) !== "disable" && evolve_theme_mod( 'evl_tagline_pos', 'disable' ) !== "next" && ( '' == ( evolve_theme_mod( 'evl_header_logo', '' ) ) ) ) || evolve_theme_mod( 'evl_pos_logo', 'left' ) == "disable" ||
     ( evolve_theme_mod( 'evl_tagline_pos', 'disable' ) == "disable" && ( '' == ( evolve_theme_mod( 'evl_header_logo', '' ) ) ) ) ) {
	$evolve_title_tagline_class_2 = '</div><!-- .col-md-auto .order-2 .order-md-1 -->';
}

if ( evolve_theme_mod( 'evl_tagline_pos', 'disable' ) == "next" && evolve_theme_mod( 'evl_pos_logo', 'left' ) == "disable" && evolve_theme_mod( 'evl_tagline_pos', 'disable' ) != "disable" ) {
	$evolve_title_tagline_class_2 = '';
}

if ( evolve_theme_mod( 'evl_header_logo', '' ) && ( evolve_theme_mod( 'evl_pos_logo', 'left' ) == 'left' || evolve_theme_mod( 'evl_pos_logo', 'left' ) == 'center' || evolve_theme_mod( 'evl_pos_logo', 'left' ) == 'right' ) && evolve_theme_mod( 'evl_tagline_pos', 'disable' ) != "disable" ) {
	$evolve_helper_tagline_class_2 = '</div><!-- .col .order-2 -->';
}

if ( evolve_theme_mod( 'evl_header_logo', '' ) && evolve_theme_mod( 'evl_tagline_pos', 'disable' ) == "next" && evolve_theme_mod( 'evl_pos_logo', 'left' ) == 'disable' ) {
	$evolve_helper_tagline_class_2 = '';
}

if ( evolve_theme_mod( 'evl_header_logo', '' ) && evolve_theme_mod( 'evl_tagline_pos', 'disable' ) == "next" && ( evolve_theme_mod( 'evl_pos_logo', 'left' ) != 'center' && evolve_theme_mod( 'evl_pos_logo', 'left' ) != 'disable' ) && evolve_theme_mod( 'evl_tagline_pos', 'disable' ) != "disable" ) {
	$evolve_row_class_2 = '</div><!-- .row .align-items-center -->';
} else {
	$evolve_row_class_2 = '';
}

if ( evolve_theme_mod( 'evl_tagline_pos', 'disable' ) == 'next' || evolve_theme_mod( 'evl_tagline_pos', 'disable' ) == 'under' ) {
	get_template_part( 'template-parts/header/header', 'tagline' );
}

if ( ( evolve_theme_mod( 'evl_tagline_pos', 'disable' ) != 'next' && evolve_theme_mod( 'evl_tagline_pos', 'disable' ) != 'disable' ) && ( '' == ( evolve_theme_mod( 'evl_header_logo', '' ) ) ) || evolve_theme_mod( 'evl_pos_logo', 'left' ) == "disable" ) {
	echo $evolve_title_tagline_class_2;
}

if ( ( evolve_theme_mod( 'evl_header_logo', '' ) && evolve_theme_mod( 'evl_pos_logo', 'left' ) !== 'disable' ) || ( evolve_theme_mod( 'evl_header_logo', '' ) ) ) {
	echo $evolve_row_class_2 . $evolve_helper_tagline_class_2;
}