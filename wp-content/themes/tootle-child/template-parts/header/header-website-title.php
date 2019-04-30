<?php
$solarticle = news_type();
$template = show_template();
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
 /* .ax_default{
    background-image: url(<?php echo get_stylesheet_directory_uri();?>/images/u198.png);
    width: 3px;
    height: 15px;
  } */
  </style> 
  <?php
 if(show_template()=='taxonomy.php' && $solarticle == 'solarticle'){
?>
<style>
	@media (min-width: 320px) and (max-width: 480px) {
div.content.solarticle.content-post {
    position: absolute;
  }
}
  </style> 
  
<?php
 }
echo '<div class="header_image_position">';
//echo get_cc_post_type();

if($solarticle == 'solarticle'){
	$previous = "javascript:history.go(-1)";
	if(isset($_SERVER['HTTP_REFERER'])) {
		$previous = $_SERVER['HTTP_REFERER'];
	}
	//echo $solarticle ;
	if( $template=='taxonomy.php'){
		$previous = get_site_url().'/solutions-library/';
	}
	echo '<div id="uarrow" class="uarrow icon">
	<a href="'.$previous.'"><img src="'.get_stylesheet_directory_uri().'/images/u2418.png"></a></div>';
}else{
	echo '<div id="u10" class="ax_default icon"></div>';
}

//<img id="u10_img" class="img " src="'.get_stylesheet_directory_uri().'/images/u10.png">
echo '<a href="'.get_site_url().'"><img  src="' . esc_url( get_header_image() ) . '" width=""></a>';

echo '</div>';

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
