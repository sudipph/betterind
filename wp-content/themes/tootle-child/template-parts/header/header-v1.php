<header class="header-v1 header-wrapper dinamic_background_image" role="banner" itemscope="itemscope" itemtype="http://schema.org/WPHeader">
	<div class="header-overlay">
			<?php 
			$display_header = 'display_quickbytes_option';
			$display_quick = 'display_default_option';
			$post_type = get_cc_post_type();
			$solarticle = news_type();
			$solarticle_class_static = '';
			$solarticle_class = '';
			if( $solarticle == 'solarticle'){
				$solarticle_class = 'universal_solution_article_backcolor';
				$solarticle_class_static = 'universal_solution_article_backcolor_static';
			?>
				<style>
				#u8{
					background-image: url(<?php echo get_stylesheet_directory_uri();?>/images/u8.png);
					z-index:1;
					top: 2em;
				}
				</style> 
				
				<?php
				}
			if(show_template()=='single-quickbyte.php' && $post_type=='quickbyte'){
				$display_header = 'display_default_option '.$post_type;
				$display_quick = 'display_quickbytes_option '.$post_type;
			}

			//get_next_post_by_id($post_id)
			?>
			<div class="header-pattern only_for_quickbyte <?php echo $display_quick;?>" style="display:">
					<div class="header container-fluid">
						<div class="row align-items-center justify-content-between">

							<?php
							if (evolve_theme_mod('evl_tagline_pos', 'disable') == "next") {
								$evolve_social_woo_class = 'col-12 col-md order-1 order-md-3';
							} else {
								$evolve_social_woo_class = 'col-12 col-md order-1 order-md-2';
							}
							if (evolve_theme_mod('evl_header_logo', '') && evolve_theme_mod('evl_pos_logo', 'left') !== 'disable') {
								if (evolve_theme_mod('evl_pos_logo', 'left') == "center") {
									$evolve_social_woo_class = 'col-12 order-1';
								}
								if (evolve_theme_mod('evl_pos_logo', 'left') == "left") {
									$evolve_social_woo_class = 'col order-1 order-md-3';
								}
								if (evolve_theme_mod('evl_pos_logo', 'left') == "right") {
									$evolve_social_woo_class = 'col-12 order-1';
								}
							}
							if (evolve_theme_mod('evl_pos_logo', 'left') != "disable") {
								evolve_header_logo();
							}
							get_template_part('template-parts/header/header', 'tagline-above');

							if (evolve_theme_mod('evl_blog_title', '0') != "1") {
								get_template_part('template-parts/header/header', 'website-title-quick-bytes');
							}
							//--------------------------search box
							// echo '<div class="col-md-23 mr-md-9 order-3 order-md8" style=" position: absolute;">';
							// if (evolve_theme_mod('evl_searchbox', true)) {
							// 	evolve_header_search('1');
							// }
							// echo '</div>';
							//--------------------------search box
							get_template_part('template-parts/header/header', 'tagline-next-under'); ?>
						</div><!-- .row .align-items-center -->
					</div><!-- .header .container -->
			</div>


			<div class="header-pattern not_for_quickbyte <?php echo $display_header; echo ' '.$solarticle_class_static?>" style="display:">

					

					<div class="header container-fluid">
						<div class="row align-items-center justify-content-between">

							<?php
							if (evolve_theme_mod('evl_tagline_pos', 'disable') == "next") {
								$evolve_social_woo_class = 'col-12 col-md order-1 order-md-3';
							} else {
								$evolve_social_woo_class = 'col-12 col-md order-1 order-md-2';
							}

							if (evolve_theme_mod('evl_header_logo', '') && evolve_theme_mod('evl_pos_logo', 'left') !== 'disable') {
								if (evolve_theme_mod('evl_pos_logo', 'left') == "center") {
									$evolve_social_woo_class = 'col-12 order-1';
								}
								if (evolve_theme_mod('evl_pos_logo', 'left') == "left") {
									$evolve_social_woo_class = 'col order-1 order-md-3';
								}
								if (evolve_theme_mod('evl_pos_logo', 'left') == "right") {
									$evolve_social_woo_class = 'col-12 order-1';
								}
							}

							/*echo '<div class="' . $evolve_social_woo_class . '">';

							if (evolve_theme_mod('evl_social_links', 0)) {
								evolve_social_media_links();
							}

							if (class_exists('Woocommerce')) {
								evolve_woocommerce_menu();
							}

							echo '</div>';*/

							if (evolve_theme_mod('evl_pos_logo', 'left') != "disable") {
								evolve_header_logo();
							}

							get_template_part('template-parts/header/header', 'tagline-above');

							if (evolve_theme_mod('evl_blog_title', '0') != "1") {
								get_template_part('template-parts/header/header', 'website-title');
							}

							//--------------------------search box
							echo '<div class="col-md-23 mr-md-9 order-3 order-md8" style=" position: absolute;">';
							if (evolve_theme_mod('evl_searchbox', true)) {
							//evolve_header_search( '1' );
								evolve_header_search('1');
							}
							echo '</div>';
							//--------------------------search box

							get_template_part('template-parts/header/header', 'tagline-next-under'); ?>

						</div><!-- .row .align-items-center -->
					</div><!-- .header .container -->

							

			</div>
			
			
			<!-- .header-pattern -->
			<!--logo change-->
			
			<div class="menu-header red_color_logo display_none">
				<div class="container">
					<div class="row" style="width:100%;">
						<div class="logo">
							<a href="<?php echo get_site_url();?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/u11.png"></a>
							<span class="cross_logo">
								<a href="javascript:go_to_menu_option('closed');" class="show_on_mobile"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/u279.png"></a>
								<a href="javascript:go_to_menu_option('closed');" class="show_on_desktop close_text_on_menu">CLOSE</a>
							</span>
						</div>
					</div>
				</div>
			</div>
			<!-- logo change-->
							


















							<!-- quick_bytes menu-->
			<div class="menu-header quick_bytes <?php echo $display_quick;?>" id="sticky_menu_rotate_quick_bytes" style="border:1px;display:">
				<div class="container">
					<div class="row align-items-center">
						<?php 
						
								echo '<nav class="navbar navbar-expand-md main-menu mr-auto col-12 col-sm mobile_view_menu_option">
											
												<div class="container-fluid">
													<div class="row" style="width:100%;">
														<div class="col font_style border_right no_border">
														<a href="'.get_site_url().'/quick-bytes/" class="black_color">
														<div class="menu_image  quick_bytes_menu"><img class="home_menu" width="25" src="' . get_stylesheet_directory_uri() . '/images/u1508.png"> ALL QUICKBYTES</div>
														
														</a>
														</div>
														
														
														<div class="col font_style border_right_next">
														<a href="'.get_next_post_by_id().'" class="black_color">
														<div class="menu_image quick_bytes_menu"> NEXT ARTICLE <div class="arr"></div></div>
														</a></div>
													</div>
												</div>
											</nav>';
						

						?>

					</div><!-- .row .align-items-center -->
				</div><!-- .container -->

				<div class="menu-header menu_box_dinamic_section">
					<div class="container">
						<div class="row align-items-center">
							<nav class="navbar navbar-expand-md main-menu mr-auto col-12 col-sm">
								<div class="container-fluid">
									<div class="row menu_data_from_ajax show_section" style="width:100%;">
											

									</div>
								</div>
							</nav>
						</div>
					</div>
				</div>
				
				
				<!-- <div id="primary_menu_show_hide" style="display:none;">
				
					<div id="primary-menu"  class="collapse navbar-collapse" data-hover="dropdown" data-animations="fadeInUp fadeInDown fadeInDown fadeInDown">
															
					</div>
				
				</div> -->
		
			</div>
			
			<!-- quick_bytes menu-->





















			
			<div class="menu-header <?php echo $display_header;?>" id="sticky_menu_rotate" style="border:1px;display:">
				<div class="container">
					<div class="row align-items-center">
						<?php 
						if (evolve_theme_mod('evl_main_menu', false) !== true) {
							if (has_nav_menu('primary-menu')) {
								echo '<nav class="navbar navbar-expand-md main-menu mr-auto col-12 col-sm mobile_view_menu_option">
											<!--<div class="row col-12">-->
												<div class="container-fluid">
													<div class="row" style="width:100%;">
														<div class="col font_style border_right">
														<a href="javascript:go_to_menu_option(\'menu\');" class="black_color">
														<div class="menu_image"><img width="25" src="' . get_stylesheet_directory_uri() . '/images/icons8-menu-30.png"></div>
														<div class="menu_name">MENU</div>
														</a>
														</div>
														<div class="col font_style border_right">
														<a href="javascript:go_to_menu_option(\'shop\');" class="black_color">
														<div class="menu_image"><img width="35" src="' . get_stylesheet_directory_uri() . '/images/u274.png"></div>
														<div class="menu_name">SHOP</div></a> </div>
														<div class="col font_style border_right">
														<a href="javascript:go_to_menu_option(\'video\');" class="black_color">
														<div class="menu_image"><img width="35" src="' . get_stylesheet_directory_uri() . '/images/u275.png"></div>
														<div class="menu_name">VIDEO</div></a></div>
														<div class="col font_style border_right">
														<a href="javascript:go_to_menu_option(\'podcasts\');" class="black_color">
														<div class="menu_image"><img width="35" src="' . get_stylesheet_directory_uri() . '/images/u276.png"></div>
														<div class="menu_name">PODCAST</div></a></div>
														<div class="col font_style">
														<a href="javascript:go_to_menu_option(\'impact\');" class="black_color">
														<div class="menu_image"><img width="35" src="' . get_stylesheet_directory_uri() . '/images/u269.png"></div>
														<div class="menu_name">IMPACT</div></a></div>
													</div>
												</div>

												<!--<div class="col-xs-2 border_right"> <span class="" ><img src=""></span>
												<span class="menu_title">MENU</span></div>
												<div class="col-xs-2 col-half-offset border_right"><span class="menu_title">SHOP</span></div>
												<div class="col-xs-2 col-half-offset border_right"><span class="menu_title">VIDEO</span></div>
												<div class="col-xs-2 col-half-offset border_right"><span class="menu_title">PODCAST</span></div>
												<div class="col-xs-2 col-half-offset border_no"><span class="menu_title">IMPACT</span></div>

											</div>-->
											<!--<div class="navbar-toggler" data-toggle="collapse" data-target="#primary-menu" aria-controls="primary-menu" aria-expanded="false" aria-label="' . __("Primary", "evolve") . '">
												<div class="col-12">1</div>' . evolve_get_svg('menu') . '
												</div>-->
											</nav>';
							}
						}

						?>

					</div><!-- .row .align-items-center -->
				</div><!-- .container -->

				<div class="menu-header menu_box_dinamic_section">
					<div class="container">
						<div class="row align-items-center">
							<nav class="navbar navbar-expand-md main-menu mr-auto col-12 col-sm">
								<div class="container-fluid">
									<div class="row menu_data_from_ajax show_section2" style="width:100%;">
											

									</div>
								</div>
							</nav>
						</div>
					</div>
				</div>
				
				
				<div id="primary_menu_show_hide" style="display:none;">
				
					<div id="primary-menu"  class="collapse navbar-collapse" data-hover="dropdown" data-animations="fadeInUp fadeInDown fadeInDown fadeInDown">
															<?php wp_nav_menu(array(
															'theme_location' => 'primary-menu',
															'depth' => 10,
															'container' => false,
															'menu_class' => 'navbar-nav mr-auto',
															'fallback_cb' => 'evolve_custom_menu_walker::fallback',
															'walker' => new evolve_custom_menu_walker(),
														)); ?>
					</div>
				
				</div>
		
			</div><!-- .menu-header -->

				<div class="menu-header menu_box_dinamic_ajax_section display_none" style="overflow-y: auto;">
					<div class="container">
						<div class="row align-items-center">
							<nav class="navbar navbar-expand-md main-menu mr-auto col-12 col-sm">
								<div class="container-fluid">
									<div class="row menu_data_from_ajax_bk" style="width:100%;">
											

									</div>
								</div>
							</nav>
						</div>
					</div>
				</div>
			<!--menu open--->
			
			<!--menu open -->
			<!--ajax page open--->
			
			<!--ajax page open -->

			<?php
		if (is_page('home')) {
			echo do_shortcode('[Home_Page_Header_Content]');
			?>
				<div class="row arrow_head <?php echo $post->post_name;?> 2">
	            	<div id="" class="down_arrow"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/down.png"></div>
	          	</div>
				  <?php

				} elseif (is_page('tbi-corner')) {
   					// echo do_shortcode('[TBI_Corner]');
					?>
				<!-- <div class="row arrow_head">
	            	<div id="" class="down_arrow"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/down.png"></div>
	          	</div> -->
				<?php

		}

		?>
	</div>
	<div class="background_shade"></div>
</header><!-- .header-v1 -->


