<?php

if ( evolve_theme_mod( 'evl_tagline_pos', 'disable' ) == "next" ) {
	$evolve_title_class_1 = '<div class="col-12 col-md-auto order-1">';
	$evolve_title_class_2 = '</div>';
} else if ( evolve_theme_mod( 'evl_tagline_pos', 'disable' ) == "disable" && '' == ( evolve_theme_mod( 'evl_header_logo', '' ) ) ) {
	$evolve_title_class_1 = "<div class='col-md-auto mr-md-auto order-2 order-md-1'>";
	$evolve_title_class_2 = "</div>";
} else if ( evolve_theme_mod( 'evl_tagline_pos', 'disable' ) == "next" && evolve_theme_mod( 'evl_header_logo', '' ) ) {
	$evolve_title_class_1 = "<div class='col-md-auto mr-md-auto order-3 order-md-1'>";
	$evolve_title_class_2 = "</div>";
} else if ( evolve_theme_mod( 'evl_tagline_pos', 'disable' ) == "disable" && evolve_theme_mod( 'evl_header_logo', '' ) && evolve_theme_mod( 'evl_pos_logo', 'left' ) == "center" ) {
	$evolve_title_class_1 = "<div class='col-12 order-3'>";
	$evolve_title_class_2 = "</div>";
} else if ( ( evolve_theme_mod( 'evl_tagline_pos', 'disable' ) == "disable" && evolve_theme_mod( 'evl_header_logo', '' ) ) || evolve_theme_mod( 'evl_tagline_pos', 'disable' ) == "next" && '' == ( evolve_theme_mod( 'evl_header_logo', '' ) ) ) {
	$evolve_title_class_1 = "<div class='col-md-auto mr-md-auto order-2 order-md-1'>";
	$evolve_title_class_2 = "</div>";
} else {
	$evolve_title_class_1 = "";
	$evolve_title_class_2 = "";
}
?>
<style>
div.header-pattern.only_for_quickbyte{
	background-color:rgba(0, 0, 0, 0.4) !important;
}
.ax_default_new{
    /* background-image: url(<?php echo get_stylesheet_directory_uri();?>/images/u1439.png) !important; */
    width: 14px !important;
    height: 14px;
  }</style>
  <?php
echo '<div class="header_image_position" style="text-align: center;">';
echo '<div id="u10" class="ax_default_new icon">
<a href="'.get_site_url().'"><img  width="14" height="14" src="'.get_stylesheet_directory_uri().'/images/u1439.png"></a>

</div>';
//<img id="u10_img" class="img " src="'.get_stylesheet_directory_uri().'/images/u10.png">
echo '<a href="'.get_site_url().'"><img style="width: 40vw;" src="' . esc_url( get_header_image() ) . '" width=""></a>
<div class="quick_bytes_heading_top">QUICK BYTES</div></div>';

if ( is_front_page() ) :

	echo $evolve_title_class_1;
	?><h1 id="website-title"><a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ) ?></a>
    </h1><?php
	echo $evolve_title_class_2;

else :

	echo $evolve_title_class_1;
	?><h4 id="website-title"><a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ) ?></a>
    </h4><?php
	echo $evolve_title_class_2;

endif;
