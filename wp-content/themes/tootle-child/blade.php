<?php
//-----------------------------------------------------multiple image upload with content-------------------------------------//
add_action( 'admin_enqueue_scripts', 'blade_grve_backend_scripts', 10, 1 );
function blade_grve_backend_scripts( $hook ) {
	global $post, $pagenow;

	wp_register_style( 'blade-grve-page-feature-section', get_stylesheet_directory_uri() . '/admin/css/grve-page-feature-section.css', array(), '2.5.8' );
	wp_register_style( 'blade-grve-admin-meta', get_stylesheet_directory_uri() . '/admin/css/grve-admin-meta.css', array(), '1.0' );
	wp_register_style( 'blade-grve-custom-sidebars', get_stylesheet_directory_uri() . '/admin/css/grve-custom-sidebars.css', array(), '1.0'  );
	wp_register_style( 'blade-grve-custom-nav-menu', get_stylesheet_directory_uri() . '/admin/css/grve-custom-nav-menu.css', array(), '1.0'  );


	$grve_upload_slider_texts = array(
		'modal_title' => esc_html__( 'Insert Images', 'blade' ),
		'modal_button_title' => esc_html__( 'Insert Images', 'blade' ),
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
	);

	$grve_upload_image_replace_texts = array(
		'modal_title' => esc_html__( 'Replace Image', 'blade' ),
		'modal_button_title' => esc_html__( 'Replace Image', 'blade' ),
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
	);

	$grve_upload_media_texts = array(
		'modal_title' => esc_html__( 'Insert Media', 'blade' ),
		'modal_button_title' => esc_html__( 'Insert Media', 'blade' ),
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
	);

	$grve_upload_image_texts = array(
		'modal_title' => esc_html__( 'Insert Image', 'blade' ),
		'modal_button_title' => esc_html__( 'Insert Image', 'blade' ),
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
	);

	$grve_feature_section_texts = array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
	);

	$grve_custom_sidebar_texts = array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
	);

	wp_register_script( 'blade-grve-custom-sidebars', get_stylesheet_directory_uri() . '/admin/js/grve-custom-sidebars.js', array( 'jquery'), false, '1.0.0' );
	wp_localize_script( 'blade-grve-custom-sidebars', 'grve_custom_sidebar_texts', $grve_custom_sidebar_texts );

	wp_register_script( 'blade-grve-upload-slider-script', get_stylesheet_directory_uri() . '/admin/js/grve-upload-slider.js', array( 'jquery'), false, '1.0.0' );
	wp_localize_script( 'blade-grve-upload-slider-script', 'grve_upload_slider_texts', $grve_upload_slider_texts );

	wp_register_script( 'blade-grve-upload-feature-slider-script', get_stylesheet_directory_uri() . '/admin/js/grve-upload-feature-slider.js', array( 'jquery'), false, '1.3.0' );
	wp_localize_script( 'blade-grve-upload-feature-slider-script', 'grve_upload_feature_slider_texts', $grve_upload_slider_texts );

	wp_register_script( 'blade-grve-upload-image-replace-script', get_stylesheet_directory_uri() . '/admin/js/grve-upload-image-replace.js', array( 'jquery'), false, '1.0.0' );
	wp_localize_script( 'blade-grve-upload-image-replace-script', 'grve_upload_image_replace_texts', $grve_upload_image_replace_texts );

	wp_register_script( 'blade-grve-upload-simple-media-script', get_stylesheet_directory_uri() . '/admin/js/grve-upload-simple.js', array( 'jquery'), false, '1.0.0' );
	wp_localize_script( 'blade-grve-upload-simple-media-script', 'grve_upload_media_texts', $grve_upload_media_texts );

	wp_register_script( 'blade-grve-upload-image-script', get_stylesheet_directory_uri() . '/admin/js/grve-upload-image.js', array( 'jquery'), false, '1.0.0' );
	wp_localize_script( 'blade-grve-upload-image-script', 'grve_upload_image_texts', $grve_upload_image_texts );

	wp_register_script( 'blade-grve-page-feature-section-script', get_stylesheet_directory_uri() . '/admin/js/grve-page-feature-section.js', array( 'jquery', 'wp-color-picker' ), false, '2.0.0' );
	wp_localize_script( 'blade-grve-page-feature-section-script', 'grve_feature_section_texts', $grve_feature_section_texts );

	wp_register_script( 'blade-grve-post-options-script', get_stylesheet_directory_uri() . '/admin/js/grve-post-options.js', array( 'jquery'), false, '1.0.0' );
	wp_register_script( 'blade-grve-portfolio-options-script', get_stylesheet_directory_uri() . '/admin/js/grve-portfolio-options.js', array( 'jquery'), false, '1.0.0' );

	wp_register_script( 'blade-grve-custom-nav-menu-script', get_stylesheet_directory_uri().'/admin/js/grve-custom-nav-menu.js', array( 'jquery'), false, '1.4.0' );

	if ( 'post-new.php' == $hook || 'post.php' == $hook ) {


		$feature_section_post_types = blade_grve_option( 'feature_section_post_types' );

		if ( !empty( $feature_section_post_types ) && in_array( $post->post_type, $feature_section_post_types ) && 'attachment' != $post->post_type ) {

			wp_enqueue_style( 'blade-grve-admin-meta' );
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_style( 'blade-grve-page-feature-section' );

			wp_enqueue_script( 'blade-grve-upload-simple-media-script' );
			wp_enqueue_script( 'blade-grve-upload-image-script' );
			wp_enqueue_script( 'blade-grve-upload-slider-script' );
			wp_enqueue_script( 'blade-grve-upload-feature-slider-script' );
			wp_enqueue_script( 'blade-grve-upload-image-replace-script' );
			wp_enqueue_script( 'blade-grve-page-feature-section-script' );
		}


        if ( 'post' === $post->post_type ) {

			wp_enqueue_style( 'blade-grve-admin-meta' );
			wp_enqueue_style( 'wp-color-picker' );
            wp_enqueue_style( 'blade-grve-page-feature-section' );

			wp_enqueue_script( 'blade-grve-upload-simple-media-script' );
			wp_enqueue_script( 'blade-grve-upload-image-script' );
			wp_enqueue_script( 'blade-grve-upload-slider-script' );
			wp_enqueue_script( 'blade-grve-upload-feature-slider-script' );
			wp_enqueue_script( 'blade-grve-upload-image-replace-script' );
			wp_enqueue_script( 'blade-grve-page-feature-section-script' );
			wp_enqueue_script( 'blade-grve-post-options-script' );

        } else if ( 'page' === $post->post_type || 'portfolio' === $post->post_type || 'product' === $post->post_type ) {

			wp_enqueue_style( 'blade-grve-admin-meta' );
			wp_enqueue_style( 'wp-color-picker' );
            wp_enqueue_style( 'blade-grve-page-feature-section' );

			wp_enqueue_script( 'blade-grve-upload-simple-media-script' );
			wp_enqueue_script( 'blade-grve-upload-image-script' );
			wp_enqueue_script( 'blade-grve-upload-slider-script' );
			wp_enqueue_script( 'blade-grve-upload-feature-slider-script' );
			wp_enqueue_script( 'blade-grve-upload-image-replace-script' );
			wp_enqueue_script( 'blade-grve-page-feature-section-script' );

			wp_enqueue_script( 'blade-grve-portfolio-options-script' );

        } else if ( 'testimonial' === $post->post_type ) {

			wp_enqueue_style( 'blade-grve-admin-meta' );

        }
    }

	if ( 'edit-tags.php' == $hook || 'term.php' == $hook ) {
		wp_enqueue_style( 'blade-grve-admin-meta' );
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_style( 'blade-grve-page-feature-section' );


		wp_enqueue_media();
		wp_enqueue_script( 'blade-grve-page-feature-section-script' );
		wp_enqueue_script( 'blade-grve-upload-image-script' );
		wp_enqueue_script( 'blade-grve-upload-image-replace-script' );

	}

	if ( 'nav-menus.php' == $hook ) {
		wp_enqueue_style( 'blade-grve-custom-nav-menu' );

		wp_enqueue_media();
		wp_enqueue_script( 'blade-grve-upload-simple-media-script' );
		wp_enqueue_script( 'blade-grve-custom-nav-menu-script' );
	}


	if ( isset( $_GET['page'] ) && ( 'blade-grve-custom-sidebar-settings' == $_GET['page'] ) ) {

		wp_enqueue_style( 'blade-grve-custom-sidebars' );
		wp_enqueue_script( 'jquery-ui-sortable' );
		wp_enqueue_script( 'blade-grve-custom-sidebars' );
	}

	wp_register_style(
		'redux-custom-css',
		get_stylesheet_directory_uri() . '/admin/css/grve-redux-panel.css',
		array(),
		time(),
		'all'
	);
	wp_enqueue_style( 'redux-custom-css' );



}

add_action( 'add_meta_boxes', 'blade_grve_generic_options_add_custom_boxes_robin' );
function blade_grve_generic_options_add_custom_boxes_robin() {

	if ( function_exists( 'vc_is_inline' ) && vc_is_inline() ) {
		return;
	}

	//General Page Options
	add_meta_box(
		'grve-page-options',
		esc_html__( 'Page Options', 'blade' ),
		'blade_grve_page_options_box',
		'page'
	);
	add_meta_box(
		'grve-page-options',
		esc_html__( 'Portfolio Options', 'blade' ),
		'blade_grve_page_options_box',
		'portfolio'
	);
	add_meta_box(
		'grve-page-options',
		esc_html__( 'Post Options', 'blade' ),
		'blade_grve_page_options_box',
		'post'
	);
	add_meta_box(
		'grve-page-options',
		esc_html__( 'Product Options', 'blade' ),
		'blade_grve_page_options_box',
		'product'
	);

	$feature_section_post_types = blade_grve_option( 'feature_section_post_types');

	if ( !empty( $feature_section_post_types ) ) {

		foreach ( $feature_section_post_types as $key => $value ) {

			if ( 'attachment' != $value ) {

				add_meta_box(
					'grve_page_feature_section',
					esc_html__( 'Feature Section', 'blade' ),
					'blade_grve_page_feature_section_box',
					$value,
					'advanced',
					'low'
				);

			}

		}
	}

}
function blade_grve_page_feature_section_box( $post ) {

	wp_nonce_field( 'grve_nonce_save', 'grve_page_feature_save_nonce' );

	$post_id = $post->ID;
	blade_grve_admin_get_feature_section( $post_id );

}
function blade_grve_page_options_box( $post ) {

	$post_type = get_post_type( $post->ID );

	switch( $post_type ) {
		case 'portfolio':
			$grve_theme_options_info = esc_html__( 'Inherit : Theme Options - Portfolio Options.', 'blade' );
			$grve_theme_options_info_text_empty =  esc_html__('If empty, text is configured from: Theme Options - Portfolio Options.', 'blade' );
		break;
		case 'post':
			$grve_theme_options_info = esc_html__( 'Inherit : Theme Options - Blog Options - Single Post.', 'blade' );
			$grve_theme_options_info_text_empty =  esc_html__('If empty, text is configured from: Theme Options - Blog Options - Single Post.', 'blade' );
		break;
		case 'product':
			$grve_theme_options_info = esc_html__( 'Inherit : Theme Options - WooCommerce Options - Single Product.', 'blade' );
			$grve_theme_options_info_text_empty =  esc_html__('If empty, text is configured from: Theme Options - WooCommerce Options - Single Product.', 'blade' );
		break;
		case 'page':
		default:
			$grve_theme_options_info = esc_html__( 'Inherit : Theme Options - Page Options.', 'blade' );
			$grve_theme_options_info_text_empty =  esc_html__('If empty, text is configured from: Theme Options - Page Options.', 'blade' );
		break;
	}

	wp_nonce_field( 'grve_nonce_save', 'grve_page_save_nonce' );


	$grve_custom_title_options = get_post_meta( $post->ID, 'grve_custom_title_options', true );
	$grve_description = get_post_meta( $post->ID, 'grve_description', true );

	//Layout Fields
	$grve_layout = get_post_meta( $post->ID, 'grve_layout', true );
	$grve_sidebar = get_post_meta( $post->ID, 'grve_sidebar', true );
	$grve_fixed_sidebar = get_post_meta( $post->ID, 'grve_fixed_sidebar', true );
	$grve_post_content_width = get_post_meta( $post->ID, 'grve_post_content_width', true ); //Post Only

	//Sliding Area
	$grve_sidearea_visibility = get_post_meta( $post->ID, 'grve_sidearea_visibility', true );
	$grve_sidearea_sidebar = get_post_meta( $post->ID, 'grve_sidearea_sidebar', true );

	//Scrolling Page
	$grve_scrolling_page = get_post_meta( $post->ID, 'grve_scrolling_page', true );
	$grve_responsive_scrolling = get_post_meta( $post->ID, 'grve_responsive_scrolling', true );
	$grve_scrolling_lock_anchors = get_post_meta( $post->ID, 'grve_scrolling_lock_anchors', true );
	$grve_scrolling_direction = get_post_meta( $post->ID, 'grve_scrolling_direction', true );
	$grve_scrolling_loop = get_post_meta( $post->ID, 'grve_scrolling_loop', true );
	$grve_scrolling_speed = get_post_meta( $post->ID, 'grve_scrolling_speed', true );	
	
	//Header - Main Menu Fields
	$grve_header_overlapping = get_post_meta( $post->ID, 'grve_header_overlapping', true );
	$grve_header_style = get_post_meta( $post->ID, 'grve_header_style', true );
	$grve_main_navigation_menu = get_post_meta( $post->ID, 'grve_main_navigation_menu', true );
	$grve_sticky_header_type = get_post_meta( $post->ID, 'grve_sticky_header_type', true );
	$grve_menu_type = get_post_meta( $post->ID, 'grve_menu_type', true );

	//Extras
	$grve_details_title = get_post_meta( $post->ID, 'grve_details_title', true ); //Portfolio Only
	$grve_details = get_post_meta( $post->ID, 'grve_details', true ); //Portfolio Only
	$grve_backlink_id = get_post_meta( $post->ID, 'grve_backlink_id', true ); //Portfolio Only
	$grve_anchor_navigation_menu = get_post_meta( $post->ID, 'grve_anchor_navigation_menu', true );
	$grve_theme_loader = get_post_meta( $post->ID, 'grve_theme_loader', true );

	//Visibility Fields
	$grve_disable_top_bar = get_post_meta( $post->ID, 'grve_disable_top_bar', true );
	$grve_disable_sticky = get_post_meta( $post->ID, 'grve_disable_sticky', true );
	$grve_disable_logo = get_post_meta( $post->ID, 'grve_disable_logo', true );
	$grve_disable_menu = get_post_meta( $post->ID, 'grve_disable_menu', true );
	$grve_disable_menu_items = get_post_meta( $post->ID, 'grve_disable_menu_items', true );
	$grve_disable_breadcrumbs = get_post_meta( $post->ID, 'grve_disable_breadcrumbs', true );
	$grve_disable_title = get_post_meta( $post->ID, 'grve_disable_title', true );
	$grve_disable_media = get_post_meta( $post->ID, 'grve_disable_media', true ); //Post Only
	$grve_disable_content = get_post_meta( $post->ID, 'grve_disable_content', true ); //Page Only
	$grve_disable_recent_entries = get_post_meta( $post->ID, 'grve_disable_recent_entries', true );//Portfolio Only
	$grve_disable_footer = get_post_meta( $post->ID, 'grve_disable_footer', true );
	$grve_disable_copyright = get_post_meta( $post->ID, 'grve_disable_copyright', true );
	$grve_disable_back_to_top = get_post_meta( $post->ID, 'grve_disable_back_to_top', true );

	?>

	<!-- GRVE METABOXES -->
	<div class="grve-metabox-content">

		<!-- TABS -->
		<div class="grve-tabs">

			<ul class="grve-tab-links">
				<li class="active"><a href="#grve-page-option-tab-header"><?php esc_html_e( 'Header / Main Menu', 'blade' ); ?></a></li>
				<li><a href="#grve-page-option-tab-title"><?php esc_html_e( 'Title / Description', 'blade' ); ?></a></li>
				<li><a href="#grve-page-option-tab-layout"><?php esc_html_e( 'Layout / Sidebars', 'blade' ); ?></a></li>
				<li><a href="#grve-page-option-tab-sliding-area"><?php esc_html_e( 'Sliding Area', 'blade' ); ?></a></li>
				<?php if( 'page' == $post_type ) { ?>
				<li><a href="#grve-page-option-tab-scrolling-sections"><?php esc_html_e( 'Scrolling Sections', 'blade' ); ?></a></li>
				<?php } ?>
				<li><a href="#grve-page-option-tab-extras"><?php esc_html_e( 'Extras', 'blade' ); ?></a></li>
				<li><a href="#grve-page-option-tab-visibility"><?php esc_html_e( 'Visibility', 'blade' ); ?></a></li>
			</ul>
			<div class="grve-tab-content">

				<div id="grve-page-option-tab-header" class="grve-tab-item active">
					<?php

						//Header Overlapping Option
						blade_grve_print_admin_option(
							array(
								'type' => 'select',
								'name' => 'grve_header_overlapping',
								'id' => 'grve_header_overlapping',
								'value' => $grve_header_overlapping,
								'options' => array(
									'' => esc_html__( '-- Inherit --', 'blade' ),
									'yes' => esc_html__( 'Yes', 'blade' ),
									'no' => esc_html__( 'No', 'blade' ),
								),
								'label' => array(
									"title" => esc_html__( 'Header Overlapping', 'blade' ),
									"desc" => esc_html__( 'Select if you want to overlap your page header', 'blade' ),
									"info" => $grve_theme_options_info,
								),
							)
						);

						//Header Style Option
						blade_grve_print_admin_option(
							array(
								'type' => 'select',
								'name' => 'grve_header_style',
								'id' => 'grve_header_style',
								'value' => $grve_header_style,
								'options' => array(
									'' => esc_html__( '-- Inherit --', 'blade' ),
									'default' => esc_html__( 'Default', 'blade' ),
									'dark' => esc_html__( 'Dark', 'blade' ),
									'light' => esc_html__( 'Light', 'blade' ),
								),
								'label' => array(
									"title" => esc_html__( 'Header Style', 'blade' ),
									"desc" => esc_html__( 'With this option you can change the coloring of your header. In case that you use Slider in Feature Section, select the header style per slide/image.', 'blade' ),
									"info" => $grve_theme_options_info,
								),
							)
						);

						//Main Navigation Menu Option
						blade_grve_print_admin_option_wrapper_start(
							array(
								'type' => 'select',
								'label' => array(
									"title" => esc_html__( 'Main Navigation Menu', 'blade' ),
									"desc" => esc_html__( 'Select alternative main navigation menu.', 'blade' ),
									"info" => esc_html__( 'Inherit : Menus - Theme Locations - Header Menu.', 'blade' ),
								),
							)
						);
						blade_grve_print_menu_selection( $grve_main_navigation_menu, 'grve-main-navigation-menu', 'grve_main_navigation_menu', 'default' );
						blade_grve_print_admin_option_wrapper_end();

						//Menu Type
						blade_grve_print_admin_option(
							array(
								'type' => 'select',
								'name' => 'grve_menu_type',
								'id' => 'grve_menu_type',
								'value' => $grve_menu_type,
								'options' => array(
									'' => esc_html__( '-- Inherit --', 'blade' ),
									'classic' => esc_html__( 'Classic', 'blade' ),
									'button' => esc_html__( 'Button Style', 'blade' ),
									'underline' => esc_html__( 'Underline', 'blade' ),
									'hidden' => esc_html__( 'Hidden', 'blade' ),
								),
								'label' => array(
									"title" => esc_html__( 'Menu Type', 'blade' ),
									"desc" => esc_html__( 'With this option you can select the type of the menu ( Not available for Side Header Mode ).', 'blade' ),
									"info" => esc_html__( 'Inherit : Theme Options - Header Options.', 'blade' ),
								),
							)
						);

						//Sticky Header Type
						blade_grve_print_admin_option(
							array(
								'type' => 'select',
								'name' => 'grve_sticky_header_type',
								'id' => 'grve_sticky_header_type',
								'value' => $grve_sticky_header_type,
								'options' => array(
									'' => esc_html__( '-- Inherit --', 'blade' ),
									'simple' => esc_html__( 'Simple', 'blade' ),
									'shrink' => esc_html__( 'Shrink', 'blade' ),
									'advanced' => esc_html__( 'Advanced Shrink', 'blade' ),
								),
								'label' => array(
									"title" => esc_html__( 'Sticky Header Type', 'blade' ),
									"desc" => esc_html__( 'With this option you can select the type of sticky header.', 'blade' ),
									"info" => esc_html__( 'Inherit : Theme Options - Header Options - Sticky Header Options.', 'blade' ),
								),
							)
						);
					?>
				</div>
				<div id="grve-page-option-tab-title" class="grve-tab-item">
					<?php

						echo '<div id="grve_page_title">';

						blade_grve_print_admin_option(
							array(
								'type' => 'select',
								'name' => 'grve_disable_title',
								'id' => 'grve_disable_title',
								'value' => $grve_disable_title,
								'options' => array(
									'' => esc_html__( 'Visible', 'blade' ),
									'yes' => esc_html__( 'Hidden', 'blade' ),

								),
								'label' => array(
									"title" => esc_html__( 'Title/Description Visibility', 'blade' ),
									"desc" => esc_html__( 'Select if you want to hide your title and decription .', 'blade' ),
								),
								'group_id' => 'grve_page_title',
							)
						);

						//Description Option
						blade_grve_print_admin_option(
							array(
								'type' => 'textfield',
								'name' => 'grve_description',
								'id' => 'grve_description',
								'value' => $grve_description,
								'label' => array(
									'title' => esc_html__( 'Description', 'blade' ),
									'desc' => esc_html__( 'Enter your page description.', 'blade' ),
								),
								'dependency' =>
								'[
									{ "id" : "grve_disable_title", "values" : [""] }
								]',
							)
						);

						//Custom Title Option
						blade_grve_print_admin_option(
							array(
								'type' => 'select',
								'name' => 'grve_page_title_custom',
								'id' => 'grve_page_title_custom',
								'value' => blade_grve_array_value( $grve_custom_title_options, 'custom' ),
								'options' => array(
									'' => esc_html__( '-- Inherit --', 'blade' ),
									'custom' => esc_html__( 'Custom', 'blade' ),

								),
								'label' => array(
									"title" => esc_html__( 'Title Options', 'blade' ),
									"info" => $grve_theme_options_info,
								),
								'group_id' => 'grve_page_title',
								'highlight' => 'highlight',
								'dependency' =>
								'[
									{ "id" : "grve_disable_title", "values" : [""] }
								]',
							)
						);
						blade_grve_print_admin_option(
							array(
								'type' => 'textfield',
								'name' => 'grve_page_title_height',
								'id' => 'grve_page_title_height',
								'value' => blade_grve_array_value( $grve_custom_title_options, 'height', '350' ),
								'label' => array(
									"title" => esc_html__( 'Title Area Height', 'blade' ),
								),
								'dependency' =>
								'[
									{ "id" : "grve_page_title_custom", "values" : ["custom"] },
									{ "id" : "grve_disable_title", "values" : [""] }
								]',
							)
						);
						blade_grve_print_admin_option(
							array(
								'type' => 'textfield',
								'name' => 'grve_page_title_min_height',
								'id' => 'grve_page_title_min_height',
								'value' => blade_grve_array_value( $grve_custom_title_options, 'min_height', '320' ),
								'label' => array(
									"title" => esc_html__( 'Title Area Minimum Height in px', 'blade' ),
								),
								'dependency' =>
								'[
									{ "id" : "grve_page_title_custom", "values" : ["custom"] },
									{ "id" : "grve_disable_title", "values" : [""] }
								]',
							)
						);
						blade_grve_print_admin_option(
							array(
								'type' => 'select-colorpicker',
								'name' => 'grve_page_title_bg_color',
								'id' => 'grve_page_title_bg_color',
								'value' => blade_grve_array_value( $grve_custom_title_options, 'bg_color', 'light' ),
								'value2' => blade_grve_array_value( $grve_custom_title_options, 'bg_color_custom', '#ffffff' ),
								'label' => array(
									"title" => esc_html__( 'Background Color', 'blade' ),
								),
								'dependency' =>
								'[
									{ "id" : "grve_page_title_custom", "values" : ["custom"] },
									{ "id" : "grve_disable_title", "values" : [""] }
								]',
								'multiple' => 'multi',
							)
						);
						blade_grve_print_admin_option(
							array(
								'type' => 'select-colorpicker',
								'name' => 'grve_page_title_title_color',
								'id' => 'grve_page_title_title_color',
								'value' => blade_grve_array_value( $grve_custom_title_options, 'title_color', 'dark' ),
								'value2' => blade_grve_array_value( $grve_custom_title_options, 'title_color_custom', '#000000' ),
								'label' => array(
									"title" => esc_html__( 'Title Color', 'blade' ),
								),
								'dependency' =>
								'[
									{ "id" : "grve_page_title_custom", "values" : ["custom"] },
									{ "id" : "grve_disable_title", "values" : [""] }
								]',
								'multiple' => 'multi',
							)
						);

						blade_grve_print_admin_option(
							array(
								'type' => 'select-colorpicker',
								'name' => 'grve_page_title_caption_color',
								'id' => 'grve_page_title_caption_color',
								'value' => blade_grve_array_value( $grve_custom_title_options, 'caption_color', 'dark' ),
								'value2' => blade_grve_array_value( $grve_custom_title_options, 'caption_color_custom', '#000000' ),
								'label' => array(
									"title" => esc_html__( 'Description Color', 'blade' ),
								),
								'dependency' =>
								'[
									{ "id" : "grve_page_title_custom", "values" : ["custom"] },
									{ "id" : "grve_disable_title", "values" : [""] }
								]',
								'multiple' => 'multi',
							)
						);

						global $blade_grve_media_bg_position_selection;
						blade_grve_print_admin_option(
							array(
								'type' => 'select',
								'name' => 'grve_page_title_content_position',
								'id' => 'grve_page_title_content_position',
								'value' => blade_grve_array_value( $grve_custom_title_options, 'content_position', 'center-center' ),
								'options' => $blade_grve_media_bg_position_selection,
								'label' => array(
									"title" => esc_html__( 'Content Position', 'blade' ),
								),
								'dependency' =>
								'[
									{ "id" : "grve_page_title_custom", "values" : ["custom"] },
									{ "id" : "grve_disable_title", "values" : [""] }
								]',
							)
						);

						blade_grve_print_admin_option(
							array(
								'type' => 'select-text-animation',
								'name' => 'grve_page_title_content_animation',
								'value' => blade_grve_array_value( $grve_custom_title_options, 'content_animation', 'fade-in' ),
								'label' => esc_html__( 'Content Animation', 'blade' ),
								'dependency' =>
								'[
									{ "id" : "grve_page_title_custom", "values" : ["custom"] },
									{ "id" : "grve_disable_title", "values" : [""] }
								]',
							)
						);


						blade_grve_print_admin_option(
							array(
								'type' => 'select',
								'name' => 'grve_page_title_bg_mode',
								'id' => 'grve_page_title_bg_mode',
								'value' => blade_grve_array_value( $grve_custom_title_options, 'bg_mode'),
								'options' => array(
									'' => esc_html__( 'Color Only', 'blade' ),
									'featured' => esc_html__( 'Featured Image', 'blade' ),
									'custom' => esc_html__( 'Custom Image', 'blade' ),

								),
								'label' => array(
									"title" => esc_html__( 'Background', 'blade' ),
								),
								'group_id' => 'grve_page_title',
								'dependency' =>
								'[
									{ "id" : "grve_page_title_custom", "values" : ["custom"] },
									{ "id" : "grve_disable_title", "values" : [""] }

								]',
							)
						);
						blade_grve_print_admin_option(
							array(
								'type' => 'select-image',
								'name' => 'grve_page_title_bg_image_id',
								'id' => 'grve_page_title_bg_image_id',
								'value' => blade_grve_array_value( $grve_custom_title_options, 'bg_image_id'),
								'label' => array(
									"title" => esc_html__( 'Background Image', 'blade' ),
								),
								'width' => 'fullwidth',
								'dependency' =>
								'[
									{ "id" : "grve_page_title_custom", "values" : ["custom"] },
									{ "id" : "grve_page_title_bg_mode", "values" : ["custom"] },
									{ "id" : "grve_disable_title", "values" : [""] }

								]',
							)
						);
						blade_grve_print_admin_option(
							array(
								'type' => 'select-bg-position',
								'name' => 'grve_page_title_bg_position',
								'id' => 'grve_page_title_bg_position',
								'value' => blade_grve_array_value( $grve_custom_title_options, 'bg_position', 'center-center'),
								'label' => array(
									"title" => esc_html__( 'Background Position', 'blade' ),
								),
								'dependency' =>
								'[
									{ "id" : "grve_page_title_custom", "values" : ["custom"] },
									{ "id" : "grve_page_title_bg_mode", "values" : ["featured","custom"] },
									{ "id" : "grve_disable_title", "values" : [""] }
								]',
							)
						);

						blade_grve_print_admin_option(
							array(
								'type' => 'select-pattern-overlay',
								'name' => 'grve_page_title_pattern_overlay',
								'value' => blade_grve_array_value( $grve_custom_title_options, 'pattern_overlay'),
								'label' => esc_html__( 'Pattern Overlay', 'blade' ),
								'dependency' =>
								'[
									{ "id" : "grve_page_title_custom", "values" : ["custom"] },
									{ "id" : "grve_page_title_bg_mode", "values" : ["featured","custom"] },
									{ "id" : "grve_disable_title", "values" : [""] }
								]',
							)
						);
						blade_grve_print_admin_option(
							array(
								'type' => 'select-colorpicker',
								'name' => 'grve_page_title_color_overlay',
								'value' => blade_grve_array_value( $grve_custom_title_options, 'color_overlay', 'dark' ),
								'value2' => blade_grve_array_value( $grve_custom_title_options, 'color_overlay_custom', '#000000' ),
								'label' => esc_html__( 'Color Overlay', 'blade' ),
								'multiple' => 'multi',
								'dependency' =>
								'[
									{ "id" : "grve_page_title_custom", "values" : ["custom"] },
									{ "id" : "grve_page_title_bg_mode", "values" : ["featured","custom"] },
									{ "id" : "grve_disable_title", "values" : [""] }
								]',
							)
						);
						blade_grve_print_admin_option(
							array(
								'type' => 'select-opacity',
								'name' => 'grve_page_title_opacity_overlay',
								'value' => blade_grve_array_value( $grve_custom_title_options, 'opacity_overlay', '0' ),
								'label' => esc_html__( 'Opacity Overlay', 'blade' ),
								'dependency' =>
								'[
									{ "id" : "grve_page_title_custom", "values" : ["custom"] },
									{ "id" : "grve_page_title_bg_mode", "values" : ["featured","custom"] },
									{ "id" : "grve_disable_title", "values" : [""] }
								]',
							)
						);

						echo '</div>';
					?>
				</div>
				<div id="grve-page-option-tab-layout" class="grve-tab-item">
					<?php

						//Layout Option
						blade_grve_print_admin_option(
							array(
								'type' => 'select',
								'name' => 'grve_layout',
								'id' => 'grve_layout',
								'value' => $grve_layout,
								'options' => array(
									'' => esc_html__( '-- Inherit --', 'blade' ),
									'none' => esc_html__( 'Full Width', 'blade' ),
									'left' => esc_html__( 'Left Sidebar', 'blade' ),
									'right' => esc_html__( 'Right Sidebar', 'blade' ),
								),
								'label' => array(
									"title" => esc_html__( 'Layout', 'blade' ),
									"desc" => esc_html__( 'Select page content and sidebar alignment.', 'blade' ),
									"info" => $grve_theme_options_info,
								),
							)
						);

						//Sidebar Option
						blade_grve_print_admin_option_wrapper_start(
							array(
								'type' => 'select',
								'label' => array(
									"title" => esc_html__( 'Sidebar', 'blade' ),
									"desc" => esc_html__( 'Select page sidebar.', 'blade' ),
									"info" => $grve_theme_options_info,
								),
							)
						);
						blade_grve_print_sidebar_selection( $grve_sidebar, 'grve_sidebar', 'grve_sidebar' );
						blade_grve_print_admin_option_wrapper_end();

						//Fixed Sidebar Option
						blade_grve_print_admin_option(
							array(
								'type' => 'select',
								'name' => 'grve_fixed_sidebar',
								'id' => 'grve_fixed_sidebar',
								'value' => $grve_fixed_sidebar,
								'options' => array(
									'no' => esc_html__( 'No', 'blade' ),
									'yes' => esc_html__( 'Yes', 'blade' ),
								),
								'label' => array(
									"title" => esc_html__( 'Fixed Sidebar', 'blade' ),
									"desc" => esc_html__( 'If selected, sidebar will be fixed.', 'blade' ),
								),
							)
						);

						//Posts Content Width
						if ( 'post' == $post_type ) {
							blade_grve_print_admin_option(
								array(
									'type' => 'select',
									'name' => 'grve_post_content_width',
									'id' => 'grve_post_content_width',
									'value' => $grve_post_content_width,
									'options' => array(
										'' => esc_html__( '-- Inherit --', 'blade' ),
										'1170' => esc_html__( 'Large' , 'blade' ),
										'990' => esc_html__( 'Medium' , 'blade' ),
										'600' => esc_html__( 'Small' , 'blade' ),
									),
									'label' => array(
										"title" => esc_html__( 'Post Content Width', 'blade' ),
										"desc" => esc_html__( 'Select the Single Post Content width (only for Full Width Post Layout)', 'blade' ),
										"info" => $grve_theme_options_info,
									),
								)
							);
						}

					?>
				</div>
				<div id="grve-page-option-tab-sliding-area" class="grve-tab-item">
					<?php
						//Sidearea Visibility
						blade_grve_print_admin_option(
							array(
								'type' => 'select',
								'name' => 'grve_sidearea_visibility',
								'id' => 'grve_sidearea_visibility',
								'value' => $grve_sidearea_visibility,
								'options' => array(
									'' => esc_html__( '-- Inherit --', 'blade' ),
									'no' => esc_html__( 'No', 'blade' ),
									'yes' => esc_html__( 'Yes', 'blade' ),
								),
								'label' => array(
									"title" => esc_html__( 'Sliding Area Visibility', 'blade' ),
									"info" => $grve_theme_options_info,
								),
							)
						);

						//Sidearea Sidebar Option
						blade_grve_print_admin_option_wrapper_start(
							array(
								'type' => 'select',
								'label' => array(
									"title" => esc_html__( 'Sliding Area Sidebar', 'blade' ),
									"desc" => esc_html__( 'Select sliding area sidebar.', 'blade' ),
									"info" => $grve_theme_options_info,
								),
							)
						);
						blade_grve_print_sidebar_selection( $grve_sidearea_sidebar, 'grve_sidearea_sidebar', 'grve_sidearea_sidebar' );
						blade_grve_print_admin_option_wrapper_end();
					?>
				</div>
				<div id="grve-page-option-tab-extras" class="grve-tab-item">
					<?php

						//Details Option
						if ( 'portfolio' == $post_type) {
							blade_grve_print_admin_option(
								array(
									'type' => 'textfield',
									'name' => 'grve_details_title',
									'id' => 'grve_details_title',
									'value' => $grve_details_title,
									'label' => array(
										'title' => esc_html__( 'Details Title', 'blade' ),
										'desc' => esc_html__( 'Enter your details title.', 'blade' ),
										'info' => $grve_theme_options_info_text_empty,
									),
									'width' => 'fullwidth',
								)
							);
							blade_grve_print_admin_option(
								array(
									'type' => 'textarea',
									'name' => 'grve_details',
									'id' => 'grve_details',
									'value' => $grve_details,
									'label' => array(
										'title' => esc_html__( 'Details Area', 'blade' ),
										'desc' => esc_html__( 'Enter your details area.', 'blade' ),
									),
									'width' => 'fullwidth',
								)
							);

							//Backlink page
							blade_grve_print_admin_option_wrapper_start(
								array(
									'type' => 'select',
									'label' => array(
										"title" => esc_html__( 'Backlink', 'blade' ),
										"desc" => esc_html__( 'Select your backlink page.', 'blade' ),
										"info" => $grve_theme_options_info,
									),
								)
							);
							blade_grve_print_page_selection( $grve_backlink_id, 'grve-backlink-id', 'grve_backlink_id' );
							blade_grve_print_admin_option_wrapper_end();


						}

						//Anchor Navigation Menu Option

						blade_grve_print_admin_option_wrapper_start(
							array(
								'type' => 'select',
								'label' => array(
									"title" => esc_html__( 'Anchor Navigation Menu', 'blade' ),
									"desc" => esc_html__( 'Select page anchor navigation menu.', 'blade' ),
								),
							)
						);
						blade_grve_print_menu_selection( $grve_anchor_navigation_menu, 'grve-page-navigation-menu', 'grve_anchor_navigation_menu' );
						blade_grve_print_admin_option_wrapper_end();

						//Sidearea Visibility
						blade_grve_print_admin_option(
							array(
								'type' => 'select',
								'name' => 'grve_theme_loader',
								'id' => 'grve_theme_loader',
								'value' => $grve_theme_loader,
								'options' => array(
									'' => esc_html__( '-- Inherit --', 'blade' ),
									'no' => esc_html__( 'No', 'blade' ),
									'yes' => esc_html__( 'Yes', 'blade' ),
								),
								'label' => array(
									"title" => esc_html__( 'Theme Loader Visibility', 'blade' ),
									"info" => esc_html__( 'Inherit : Theme Options - General Settings.', 'blade' ),
								),
							)
						);

					?>
				</div>
				<div id="grve-page-option-tab-scrolling-sections" class="grve-tab-item">
					<?php

						//Responsive Scrolling Option
						if ( 'page' == $post_type) {

							echo '<div id="grve_page_scrolling_section">';

							blade_grve_print_admin_option(
								array(
									'type' => 'select',
									'name' => 'grve_scrolling_page',
									'id' => 'grve_scrolling_page',
									'value' => $grve_scrolling_page,
									'options' => array(
										'' => esc_html__( 'Full Page', 'blade' ),
										'pilling' => esc_html__( 'Page Pilling', 'blade' ),
									),
									'label' => array(
										'title' => esc_html__( 'Scrolling Sections Plugin', 'blade' ),
										'desc' => esc_html__( 'Select the scrolling sections plugin you want to use.', 'blade' ),
										'info' => esc_html__( 'Note: The following options are available only for Scrolling Full Screen Sections Template.', 'blade' ),
									),
									'highlight' => 'highlight',
									'group_id' => 'grve_page_scrolling_section',
								)
							);
							blade_grve_print_admin_option(
								array(
									'type' => 'select',
									'name' => 'grve_scrolling_lock_anchors',
									'id' => 'grve_scrolling_lock_anchors',
									'value' => $grve_scrolling_lock_anchors,
									'options' => array(
										'' => esc_html__( 'URL without /#', 'blade' ),
										'no' => esc_html__( 'Allow Anchor Links in URL', 'blade' ),
									),
									'label' => array(
										'title' => esc_html__( 'Anchor Links', 'blade' ),
										'desc' => esc_html__( 'Select if you want to allow anchor links.', 'blade' ),
									),
								)
							);
							blade_grve_print_admin_option(
								array(
									'type' => 'select',
									'name' => 'grve_scrolling_loop',
									'id' => 'grve_scrolling_loop',
									'value' => $grve_scrolling_loop,
									'options' => array(
										'' => esc_html__( 'None', 'blade' ),
										'top' => esc_html__( 'Loop Top', 'blade' ),
										'bottom' => esc_html__( 'Loop Bottom', 'blade' ),
										'both' => esc_html__( 'Loop Top/Bottom', 'blade' ),
									),
									'label' => array(
										'title' => esc_html__( 'Loop', 'blade' ),
										'desc' => esc_html__( 'Select if you want to loop.', 'blade' ),
									),
								)
							);
							blade_grve_print_admin_option(
								array(
									'type' => 'select',
									'name' => 'grve_scrolling_direction',
									'id' => 'grve_scrolling_direction',
									'value' => $grve_scrolling_direction,
									'options' => array(
										'' => esc_html__( 'Vertical', 'blade' ),
										'horizontal' => esc_html__( 'Horizontal', 'blade' ),
									),
									'label' => array(
										'title' => esc_html__( 'Direction', 'blade' ),
										'desc' => esc_html__( 'Select scrolling direction.', 'blade' ),
									),
									'dependency' =>
									'[
										{ "id" : "grve_scrolling_page", "values" : ["pilling"] }
									]',
								)
							);
							blade_grve_print_admin_option(
								array(
									'type' => 'textfield',
									'name' => 'grve_scrolling_speed',
									'id' => 'grve_scrolling_speed',
									'value' => $grve_scrolling_speed,
									'label' => array(
										'title' => esc_html__( 'Speed (ms)', 'blade' ),
										'desc' => esc_html__( 'Enter scrolling speed.', 'blade' ),
									),
									'default_value' => '1000',

								)
							);
							blade_grve_print_admin_option(
								array(
									'type' => 'select',
									'name' => 'grve_responsive_scrolling',
									'id' => 'grve_responsive_scrolling',
									'value' => $grve_responsive_scrolling,
									'options' => array(
										'' => esc_html__( '-- Inherit --', 'blade' ),
										'yes' => esc_html__( 'Yes', 'blade' ),
										'no' => esc_html__( 'No', 'blade' ),
									),
									'label' => array(
										'title' => esc_html__( 'Responsive Scrolling Full Sections', 'blade' ),
										'desc' => esc_html__( 'Select if you want to maintain the scrolling feature on devices.', 'blade' ),
										"info" => esc_html__( 'Inherit : Theme Options - Miscellaneous.', 'blade' ),
									),
								)
							);

							echo '</div>';
						}

					?>
				</div>				
				<div id="grve-page-option-tab-visibility" class="grve-tab-item">
					<?php

						blade_grve_print_admin_option(
							array(
								'type' => 'checkbox',
								'name' => 'grve_disable_top_bar',
								'id' => 'grve_disable_top_bar',
								'value' => $grve_disable_top_bar,
								'label' => array(
									"title" => esc_html__( 'Disable Top Bar', 'blade' ),
									"desc" => esc_html__( 'If selected, top bar will be hidden.', 'blade' ),
								),
							)
						);

						blade_grve_print_admin_option(
							array(
								'type' => 'checkbox',
								'name' => 'grve_disable_sticky',
								'id' => 'grve_disable_sticky',
								'value' => $grve_disable_sticky,
								'label' => array(
									"title" => esc_html__( 'Disable Sticky Header', 'blade' ),
									"desc" => esc_html__( 'If selected, sticky header will be disabled.', 'blade' ),
								),
							)
						);

						blade_grve_print_admin_option(
							array(
								'type' => 'checkbox',
								'name' => 'grve_disable_logo',
								'id' => 'grve_disable_logo',
								'value' => $grve_disable_logo,
								'label' => array(
									"title" => esc_html__( 'Disable Logo', 'blade' ),
									"desc" => esc_html__( 'If selected, logo will be disabled.', 'blade' ),
								),
							)
						);
						blade_grve_print_admin_option(
							array(
								'type' => 'checkbox',
								'name' => 'grve_disable_menu',
								'id' => 'grve_disable_menu',
								'value' => $grve_disable_menu,
								'label' => array(
									"title" => esc_html__( 'Disable Main Menu', 'blade' ),
									"desc" => esc_html__( 'If selected, main menu will be hidden.', 'blade' ),
								),
							)
						);

						blade_grve_print_admin_option(
							array(
								'type' => 'checkbox',
								'name' => 'grve_disable_menu_item_search',
								'id' => 'grve_disable_menu_item_search',
								'value' => blade_grve_array_value( $grve_disable_menu_items, 'search'),
								'label' => array(
									"title" => esc_html__( 'Disable Main Menu Item Search', 'blade' ),
									"desc" => esc_html__( 'If selected, main menu item will be hidden.', 'blade' ),
								),
							)
						);
						blade_grve_print_admin_option(
							array(
								'type' => 'checkbox',
								'name' => 'grve_disable_menu_item_form',
								'id' => 'grve_disable_menu_item_form',
								'value' => blade_grve_array_value( $grve_disable_menu_items, 'form'),
								'label' => array(
									"title" => esc_html__( 'Disable Main Menu Item Contact Form', 'blade' ),
									"desc" => esc_html__( 'If selected, main menu item will be hidden.', 'blade' ),
								),
							)
						);
						blade_grve_print_admin_option(
							array(
								'type' => 'checkbox',
								'name' => 'grve_disable_menu_item_language',
								'id' => 'grve_disable_menu_item_language',
								'value' => blade_grve_array_value( $grve_disable_menu_items, 'language'),
								'label' => array(
									"title" => esc_html__( 'Disable Main Menu Item Language Selector', 'blade' ),
									"desc" => esc_html__( 'If selected, main menu item will be hidden.', 'blade' ),
								),
							)
						);
						blade_grve_print_admin_option(
							array(
								'type' => 'checkbox',
								'name' => 'grve_disable_menu_item_cart',
								'id' => 'grve_disable_menu_item_cart',
								'value' => blade_grve_array_value( $grve_disable_menu_items, 'cart'),
								'label' => array(
									"title" => esc_html__( 'Disable Main Menu Item Shopping Cart', 'blade' ),
									"desc" => esc_html__( 'If selected, main menu item will be hidden.', 'blade' ),
								),
							)
						);
						blade_grve_print_admin_option(
							array(
								'type' => 'checkbox',
								'name' => 'grve_disable_menu_item_social',
								'id' => 'grve_disable_menu_item_social',
								'value' => blade_grve_array_value( $grve_disable_menu_items, 'social'),
								'label' => array(
									"title" => esc_html__( 'Disable Main Menu Item Social Icons', 'blade' ),
									"desc" => esc_html__( 'If selected, main menu item will be hidden.', 'blade' ),
								),
							)
						);

						blade_grve_print_admin_option(
							array(
								'type' => 'checkbox',
								'name' => 'grve_disable_breadcrumbs',
								'id' => 'grve_disable_breadcrumbs',
								'value' => $grve_disable_breadcrumbs,
								'label' => array(
									"title" => esc_html__( 'Disable Breadcrumbs', 'blade' ),
									"desc" => esc_html__( 'If selected, breadcrumbs items will be hidden.', 'blade' ),
								),
							)
						);

						if ( 'page' == $post_type ) {
							if ( blade_grve_woocommerce_enabled() && $post->ID == wc_get_page_id( 'shop' ) ) {
								//Skip
							} else {
								blade_grve_print_admin_option(
									array(
										'type' => 'checkbox',
										'name' => 'grve_disable_content',
										'id' => 'grve_disable_content',
										'value' => $grve_disable_content,
										'label' => array(
											"title" => esc_html__( 'Disable Content Area', 'blade' ),
											"desc" => esc_html__( 'If selected, content area will be hidden (including sidebar and comments).', 'blade' ),
										),
									)
								);
							}
						}

						if ( 'post' == $post_type ) {
							blade_grve_print_admin_option(
								array(
									'type' => 'checkbox',
									'name' => 'grve_disable_media',
									'id' => 'grve_disable_media',
									'value' => $grve_disable_media,
									'label' => array(
										"title" => esc_html__( 'Disable Media Area', 'blade' ),
										"desc" => esc_html__( 'If selected, media area will be hidden.', 'blade' ),
									),
								)
							);
						}
						if ( 'portfolio' == $post_type ) {
							blade_grve_print_admin_option(
								array(
									'type' => 'checkbox',
									'name' => 'grve_disable_recent_entries',
									'id' => 'grve_disable_recent_entries',
									'value' => $grve_disable_recent_entries,
									'label' => array(
										"title" => esc_html__( 'Disable Recent Entries', 'blade' ),
										"desc" => esc_html__( 'If selected, recent entries area will be hidden.', 'blade' ),
									),
								)
							);
						}

						blade_grve_print_admin_option(
							array(
								'type' => 'checkbox',
								'name' => 'grve_disable_footer',
								'id' => 'grve_disable_footer',
								'value' => $grve_disable_footer,
								'label' => array(
									"title" => esc_html__( 'Disable Footer Widgets', 'blade' ),
									"desc" => esc_html__( 'If selected, footer widgets will be hidden.', 'blade' ),
								),
							)
						);

						blade_grve_print_admin_option(
							array(
								'type' => 'checkbox',
								'name' => 'grve_disable_copyright',
								'id' => 'grve_disable_copyright',
								'value' => $grve_disable_copyright,
								'label' => array(
									"title" => esc_html__( 'Disable Footer Copyright', 'blade' ),
									"desc" => esc_html__( 'If selected, footer copyright area will be hidden.', 'blade' ),
								),
							)
						);
						
						blade_grve_print_admin_option(
							array(
								'type' => 'checkbox',
								'name' => 'grve_disable_back_to_top',
								'id' => 'grve_disable_back_to_top',
								'value' => $grve_disable_back_to_top,
								'label' => array(
									"title" => esc_html__( 'Disable Back to Top', 'blade' ),
									"desc" => esc_html__( 'If selected, Back to Top button will be hidden.', 'blade' ),
								),
							)
						);

					?>
				</div>
			</div>
		</div>
	</div>

<?php
}

function blade_grve_admin_get_feature_section( $post_id ) {

	//Feature Section
	$feature_section = get_post_meta( $post_id, 'grve_feature_section', true );

	//Feature Settings
	$feature_settings = blade_grve_array_value( $feature_section, 'feature_settings' );

	$feature_element = blade_grve_array_value( $feature_settings, 'element' );

	$feature_size = blade_grve_array_value( $feature_settings, 'size' );
	$feature_height = blade_grve_array_value( $feature_settings, 'height', '550' );
	$feature_min_height = blade_grve_array_value( $feature_settings, 'min_height', '320' );
	$feature_bg_color  = blade_grve_array_value( $feature_settings, 'bg_color', 'dark' );
	$feature_bg_color_custom  = blade_grve_array_value( $feature_settings, 'bg_color_custom', '#000000' );
	$feature_header_position = blade_grve_array_value( $feature_settings, 'header_position', 'above' );

	//Feature Single Item
	$feature_single_item = blade_grve_array_value( $feature_section, 'single_item' );
	$feature_single_item_button = blade_grve_array_value( $feature_single_item, 'button' );
	$feature_single_item_button2 = blade_grve_array_value( $feature_single_item, 'button2' );


	//Slider Item
	$slider_items = blade_grve_array_value( $feature_section, 'slider_items' );
	$slider_settings = blade_grve_array_value( $feature_section, 'slider_settings' );

	$slider_speed = blade_grve_array_value( $slider_settings, 'slideshow_speed', '3500' );
	$slider_pause = blade_grve_array_value( $slider_settings, 'slider_pause', 'no' );
	$slider_dir_nav = blade_grve_array_value( $slider_settings, 'direction_nav', '1' );
	$slider_dir_nav_color = blade_grve_array_value( $slider_settings, 'direction_nav_color', 'light' );
	$slider_transition = blade_grve_array_value( $slider_settings, 'transition', 'slide' );
	$slider_effect = blade_grve_array_value( $slider_settings, 'slider_effect' );

	//Map Item
	$map_items = blade_grve_array_value( $feature_section, 'map_items' );
	$map_settings = blade_grve_array_value( $feature_section, 'map_settings' );

	$map_zoom = blade_grve_array_value( $map_settings, 'zoom', 14 );
	$map_marker = blade_grve_array_value( $map_settings, 'marker' );
	$map_disable_style = blade_grve_array_value( $map_settings, 'disable_style', 'no' );

			//Revolution slider
			$revslider_alias = blade_grve_array_value( $feature_section, 'revslider_alias' );
			echo '<pre>----';

var_dump($feature_element);
echo '----</pre>';
		?>

		<div class="grve-fields-wrapper grve-highlight">
			<div class="grve-label">
				<label for="grve-page-feature-element">
					<span class="grve-title"><?php esc_html_e( 'Feature Element', 'blade' ); ?></span>
					<span class="grve-description"><?php esc_html_e( 'Select feature section element', 'blade' ); ?></span>
				</label>
			</div>
			<div class="grve-field-items-wrapper">
				<div class="grve-field-item">
					<select id="grve-page-feature-element" name="grve_page_feature_element">
						<option value="" <?php selected( "", $feature_element ); ?>><?php esc_html_e( 'None', 'blade' ); ?></option>
						<option value="title" <?php selected( "title", $feature_element ); ?>><?php esc_html_e( 'Title', 'blade' ); ?></option>
						<option value="image" <?php selected( "image", $feature_element ); ?>><?php esc_html_e( 'Image', 'blade' ); ?></option>
						<option value="video" <?php selected( "video", $feature_element ); ?>><?php esc_html_e( 'Video', 'blade' ); ?></option>
						<option value="slider" <?php selected( "slider", $feature_element ); ?>><?php esc_html_e( 'Slider', 'blade' ); ?></option>
						<option value="revslider" <?php selected( "revslider", $feature_element ); ?>><?php esc_html_e( 'Revolution Slider', 'blade' ); ?></option>
						<option value="map" <?php selected( "map", $feature_element ); ?>><?php esc_html_e( 'Map', 'blade' ); ?></option>
					</select>
				</div>
			</div>
		</div>

		<div id="grve-feature-section-options" class="grve-feature-section-item postbox" <?php if ( "" != $feature_element ) { ?> style="display:none;" <?php } ?>>

			<div class="grve-fields-wrapper grve-feature-options-wrapper">
				<div class="grve-label">
					<label for="grve-page-feature-element">
						<span class="grve-title"><?php esc_html_e( 'Feature Size', 'blade' ); ?></span>
						<span class="grve-description"><?php esc_html_e( 'With Custom Size option you can select the feature height in px.', 'blade' ); ?></span>
					</label>
				</div>
				<div class="grve-field-items-wrapper">
					<div class="grve-field-item">
						<select name="grve_page_feature_size" id="grve-page-feature-size">
							<option value="" <?php selected( "", $feature_size ); ?>><?php esc_html_e( 'Full Screen', 'blade' ); ?></option>
							<option value="custom" <?php selected( "custom", $feature_size ); ?>><?php esc_html_e( 'Custom Size', 'blade' ); ?></option>
						</select>
					</div>
					<div class="grve-field-item">
						<span id="grve-feature-section-height" <?php if ( "" == $feature_size ) { ?> style="display:none;" <?php } ?>>
							<input type="text" name="grve_page_feature_height" value="<?php echo esc_attr( $feature_height ); ?>" />
							<span class="grve-sub-title"><?php esc_html_e( 'Height in px', 'blade' ); ?></span>
							<input type="text" name="grve_page_feature_min_height" value="<?php echo esc_attr( $feature_min_height ); ?>"/>
							<span class="grve-sub-title"><?php esc_html_e( 'Minimum Height in px', 'blade' ); ?></span>
						</span>
					</div>
				</div>
			</div>
			<?php
				blade_grve_print_admin_option(
					array(
						'type' => 'select',
						'options' => array(
							'above' => esc_html__( 'Header above Feature', 'blade' ),
							'below' => esc_html__( 'Header below Feature', 'blade' ),
						),
						'name' => 'grve_page_feature_header_position',
						'value' => $feature_header_position,
						'label' => array(
							'title' => esc_html__( 'Feature/Header Position', 'blade' ),
							'desc' => esc_html__( 'With this option header will be shown above or below feature section.', 'blade' ),
						),
					)
				);
			?>
			<div class="grve-feature-options-wrapper">
			<?php

				blade_grve_print_admin_option(
					array(
						'type' => 'select-colorpicker',
						'name' => 'grve_page_feature_bg_color',
						'value' => $feature_bg_color,
						'value2' => $feature_bg_color_custom,
						'label' => esc_html__( 'Background Color', 'blade' ),
						'multiple' => 'multi',
					)
				);
			?>
			</div>

		</div>



		<div id="grve-feature-section-slider" class="grve-feature-section-item" <?php if ( "slider" != $feature_element ) { ?> style="display:none;" <?php } ?>>

			<div class="postbox">
				<h3 class="grve-title">
					<span><?php esc_html_e( 'Slider Settings', 'blade' ); ?></span>
				</h3>
				<div class="inside">

					<?php
						blade_grve_print_admin_option(
							array(
								'type' => 'textfield',
								'name' => 'grve_page_slider_settings_speed',
								'value' => $slider_speed,
								'label' => esc_html__( 'Slideshow Speed', 'blade' ),
							)
						);
						blade_grve_print_admin_option(
							array(
								'type' => 'select',
								'name' => 'grve_page_slider_settings_pause',
								'options' => array(
									'no' => esc_html__( 'No', 'blade' ),
									'yes' => esc_html__( 'Yes', 'blade' ),
								),
								'value' => $slider_pause,
								'label' => esc_html__( 'Pause on Hover', 'blade' ),
							)
						);

						blade_grve_print_admin_option(
							array(
								'type' => 'select',
								'options' => array(
									'1' => esc_html__( 'Style 1', 'blade' ),
									'2' => esc_html__( 'Style 2', 'blade' ),
									'3' => esc_html__( 'Style 3', 'blade' ),
									'4' => esc_html__( 'Style 4', 'blade' ),
									'0' => esc_html__( 'No Navigation', 'blade' ),
								),
								'name' => 'grve_page_slider_settings_direction_nav',
								'value' => $slider_dir_nav,
								'label' => array(
									'title' => esc_html__( 'Navigation Buttons', 'blade' ),
								),
							)
						);

						blade_grve_print_admin_option(
							array(
								'type' => 'select',
								'options' => array(
									'slide' => esc_html__( 'Slide', 'blade' ),
									'fade' => esc_html__( 'Fade', 'blade' ),
									'backSlide' => esc_html__( 'Back Slide', 'blade' ),
									'goDown' => esc_html__( 'Go Down', 'blade' ),
								),
								'name' => 'grve_page_slider_settings_transition',
								'value' => $slider_transition,
								'label' => array(
									'title' => esc_html__( 'Transition', 'blade' ),
								),
							)
						);

						blade_grve_print_admin_option(
							array(
								'type' => 'select',
								'options' => array(
									'' => esc_html__( 'None', 'blade' ),
									'animated' => esc_html__( 'Animated', 'blade' ),
									'parallax' => esc_html__( 'Parallax', 'blade' ),
								),
								'name' => 'grve_page_slider_settings_effect',
								'value' => $slider_effect,
								'label' => array(
									'title' => esc_html__( 'Slider Effect', 'blade' ),
								),
							)
						);
					?>

					<div class="grve-fields-wrapper">
						<div class="grve-label">
							<label for="grve-page-feature-element">
								<span class="grve-title"><?php esc_html_e( 'Add Slides', 'blade' ); ?></span>
							</label>
						</div>
						<div class="grve-field-items-wrapper">
							<div class="grve-field-item">
								<input type="button" class="grve-upload-feature-slider-button button-primary" value="<?php esc_attr_e( 'Insert Images to Slider', 'blade' ); ?>"/>
								<span id="grve-upload-feature-slider-button-spinner" class="grve-action-spinner"></span>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
		<div id="grve-feature-slider-container" data-mode="slider-full" class="grve-feature-section-item" <?php if ( 'slider' != $feature_element ) { ?> style="display:none;" <?php } ?>>
			<?php
				if( !empty( $slider_items ) ) {
					blade_grve_print_admin_feature_slider_items( $slider_items );
				}
			?>
		</div>

		<div id="grve-feature-map-container" class="grve-feature-section-item" <?php if ( 'map' != $feature_element ) { ?> style="display:none;" <?php } ?>>
			<div class="grve-map-item postbox">
				<h3 class="grve-title">
					<span><?php esc_html_e( 'Map', 'blade' ); ?></span>
				</h3>
				<div class="inside">
					<div class="grve-fields-wrapper">
						<div class="grve-label">
							<label for="grve-page-feature-element">
								<span class="grve-title"><?php esc_html_e( 'Single Point Zoom', 'blade' ); ?></span>
							</label>
						</div>
						<div class="grve-field-items-wrapper">
							<div class="grve-field-item">
								<select id="grve-page-feature-map-zoom" name="grve_page_feature_map_zoom">
									<?php for ( $i=1; $i < 20; $i++ ) { ?>
										<option value="<?php echo esc_attr( $i ); ?>" <?php selected( $i, $map_zoom ); ?>><?php echo esc_html( $i ); ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
					</div>
					<div class="grve-fields-wrapper">
						<div class="grve-label">
							<label for="grve-page-feature-element">
								<span class="grve-title"><?php esc_html_e( 'Global Marker', 'blade' ); ?></span>
							</label>
						</div>
						<div class="grve-field-items-wrapper">
							<div class="grve-field-item grve-field-item-fullwidth">
								<input type="text" class="grve-upload-simple-media-field" id="grve-page-feature-map-marker" name="grve_page_feature_map_marker" value="<?php echo esc_attr( $map_marker ); ?>"/>
								<label></label>
								<input type="button" data-media-type="image" class="grve-upload-simple-media-button button-primary" value="<?php esc_attr_e( 'Insert Marker', 'blade' ); ?>"/>
								<input type="button" class="grve-remove-simple-media-button button" value="<?php esc_attr_e( 'Remove', 'blade' ); ?>"/>
							</div>
						</div>
					</div>
					<div class="grve-fields-wrapper">
						<div class="grve-label">
							<label for="grve-page-feature-element">
								<span class="grve-title"><?php esc_html_e( 'Disable Custom Style', 'blade' ); ?></span>
							</label>
						</div>
						<div class="grve-field-items-wrapper">
							<div class="grve-field-item">
								<select id="grve-page-feature-map-disable-style" name="grve_page_feature_map_disable_style">
									<option value="no" <?php selected( "no", $map_disable_style ); ?>><?php esc_html_e( 'No', 'blade' ); ?></option>
									<option value="yes" <?php selected( "yes", $map_disable_style ); ?>><?php esc_html_e( 'Yes', 'blade' ); ?></option>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="grve-fields-wrapper">
					<div class="grve-label">
						<label for="grve-page-feature-element">
							<span class="grve-title"><?php esc_html_e( 'Add Map Points', 'blade' ); ?></span>
						</label>
					</div>
					<div class="grve-field-items-wrapper">
						<div class="grve-field-item">
							<input type="button" id="grve-upload-multi-map-point" class="grve-upload-multi-map-point button-primary" value="<?php esc_attr_e( 'Insert Point to Map', 'blade' ); ?>"/>
							<span id="grve-upload-multi-map-button-spinner" class="grve-action-spinner"></span>
						</div>
					</div>
				</div>
			</div>
			<?php blade_grve_print_admin_feature_map_items( $map_items ); ?>
		</div>

		<div id="grve-feature-single-container" class="grve-feature-section-item" <?php if ( 'title' != $feature_element && 'image' != $feature_element && 'video' != $feature_element ) { ?> style="display:none;" <?php } ?>>
			<div class="grve-video-item postbox">
				<span class="grve-modal-spinner"></span>
				<h3 class="grve-title">
					<span><?php esc_html_e( 'Options', 'blade' ); ?></span>
				</h3>
				<div class="inside">

					<!-- GRVE METABOXES -->
					<div class="grve-metabox-content">

						<!-- TABS -->
						<div class="grve-tabs">

							<ul class="grve-tab-links">
								<li class="grve-feature-required grve-item-feature-video-settings active"><a id="grve-feature-single-tab-video-link" href="#grve-feature-single-tab-video"><?php esc_html_e( 'Video', 'blade' ); ?></a></li>
								<li class="grve-feature-required grve-item-feature-bg-settings"><a id="grve-feature-single-tab-bg-link" href="#grve-feature-single-tab-bg"><?php esc_html_e( 'Background', 'blade' ); ?></a></li>
								<li class="grve-feature-required grve-item-feature-content-settings"><a id="grve-feature-single-tab-content-link" href="#grve-feature-single-tab-content"><?php esc_html_e( 'Content', 'blade' ); ?></a></li>
								<li class="grve-feature-required grve-item-feature-revslider-settings"><a id="grve-feature-single-tab-revslider-link" href="#grve-feature-single-tab-revslider"><?php esc_html_e( 'Revolution Slider', 'blade' ); ?></a></li>
								<li class="grve-feature-required grve-item-feature-button-settings"><a href="#grve-feature-single-tab-button"><?php esc_html_e( 'First Button', 'blade' ); ?></a></li>
								<li class="grve-feature-required grve-item-feature-button-settings"><a href="#grve-feature-single-tab-button2"><?php esc_html_e( 'Second Button', 'blade' ); ?></a></li>
								<li><a href="#grve-feature-single-tab-extra"><?php esc_html_e( 'Extra', 'blade' ); ?></a></li>
							</ul>

							<div class="grve-tab-content">
								<div id="grve-feature-single-tab-video" class="grve-tab-item active">
									<?php blade_grve_print_admin_feature_item_video_options( $feature_single_item ); ?>
								</div>
								<div id="grve-feature-single-tab-revslider" class="grve-tab-item">
									<?php
										blade_grve_print_admin_option(
												array(
													'type' => 'select',
													'options' => blade_grve_get_revolution_selection(),
													'name' => 'grve_page_revslider',
													'value' => $revslider_alias,
													'label' => array(
														'title' => esc_html__( 'Revolution Slider', 'blade' ),
													),
												)
											);
									?>
								</div>
								<div id="grve-feature-single-tab-bg" class="grve-tab-item">
									<?php blade_grve_print_admin_feature_item_background_options( $feature_single_item ); ?>
									<?php blade_grve_print_admin_feature_item_overlay_options( $feature_single_item ); ?>
								</div>
								<div id="grve-feature-single-tab-content" class="grve-tab-item">
									<?php blade_grve_print_admin_feature_item_content_options( $feature_single_item ); ?>
								</div>
								<div id="grve-feature-single-tab-button" class="grve-tab-item">
									<?php blade_grve_print_admin_feature_item_button_options( $feature_single_item_button, 'grve_single_item_button_' ); ?>
								</div>
								<div id="grve-feature-single-tab-button2" class="grve-tab-item">
									<?php blade_grve_print_admin_feature_item_button_options( $feature_single_item_button2, 'grve_single_item_button2_' ); ?>
								</div>
								<div id="grve-feature-single-tab-extra" class="grve-tab-item">
									<?php blade_grve_print_admin_feature_item_extra_options( $feature_single_item ); ?>
								</div>
							</div>

						</div>
						<!-- END TABS -->

					</div>
					<!-- END GRVE METABOXES -->
				</div>
			</div>
		</div>
	<?php
}
function blade_grve_option( $id, $fallback = false, $param = false ) {
	global $blade_grve_options;
	$grve_theme_options = $blade_grve_options;

	if ( $fallback == false ) $fallback = '';
	$output = ( isset($grve_theme_options[$id]) && $grve_theme_options[$id] !== '' ) ? $grve_theme_options[$id] : $fallback;
	if ( !empty($grve_theme_options[$id]) && $param ) {
		$output = ( isset($grve_theme_options[$id][$param]) && $grve_theme_options[$id][$param] !== '' ) ? $grve_theme_options[$id][$param] : $fallback;
		if ( 'font-family' == $param ) {
			$output = urldecode( $output );
			if ( strpos($output, ' ') && !strpos($output, ',') ) {
				$output = '"' . $output . '"';
			}
		}
	}
	return $output;
}
function blade_grve_print_admin_option_wrapper_start( $item ) {

	$data_dependency = $item_highlight = $item_width = '';

	$item_type = blade_grve_array_value( $item, 'type' );
	$item_label = blade_grve_array_value( $item, 'label' );
	$item_required = blade_grve_array_value( $item, 'required' );
	$item_dependency = blade_grve_array_value( $item, 'dependency' );
	$item_multiple = blade_grve_array_value( $item, 'multiple' );
	$item_highlight = blade_grve_array_value( $item, 'highlight', 'standard' );
	$item_width = blade_grve_array_value( $item, 'width', 'normal' );
	$item_wrap_class = blade_grve_array_value( $item, 'wrap_class' );

	$wrapper_attributes = array();
	if( !empty( $item_dependency ) ) {
		$wrapper_attributes[] = "data-dependency='" . esc_attr( $item_dependency ) . "'";
	}

	$label_class = 'grve-label';
	if ( 'label' == $item_type ) {
		$label_class = 'grve-label grve-header-label';
	}

	$item_title = $item_desc = $item_info = '';

	if ( is_array ( $item_label ) ) {
		$item_title = blade_grve_array_value( $item_label, 'title' );
		$item_desc = blade_grve_array_value( $item_label, 'desc' );
		$item_info = blade_grve_array_value( $item_label, 'info' );
	} else {
		$item_title = $item_label;
	}

	//Classes
	$option_wrapper_classes = array( 'grve-fields-wrapper' );
	$option_wrapper_classes[] = 'grve-' . $item_highlight;
	if ( !empty ( $item_wrap_class ) ) {
		$option_wrapper_classes[] = $item_wrap_class;
	}
	$option_wrapper_class_string = implode( ' ', $option_wrapper_classes );

	$wrapper_attributes[] = 'class="' . esc_attr( $option_wrapper_class_string ) . '"';

	?>
	<div <?php echo implode( ' ', $wrapper_attributes ); ?>>
		<div class="<?php echo esc_attr( $label_class ); ?>">
			<label>
				<span class="grve-title"><?php echo esc_html( $item_title ); ?></span>
				<span class="grve-description"><?php echo esc_html( $item_desc ); ?></span>
				<span class="grve-info"><?php echo esc_html( $item_info ); ?></span>
			</label>
		</div>
		<div class="grve-field-items-wrapper">
			<?php if ( '' == $item_multiple ) { ?>
			<div class="grve-field-item grve-field-item-<?php echo esc_attr( $item_width ); ?>">
			<?php } ?>

<?php
}

function blade_grve_print_admin_option_wrapper_end( $multiple = '' ) {
	?>
			<?php if ( '' == $multiple ) { ?>
			</div>
			<?php } ?>
		</div>
	</div>

	<?php
}

/**
 * Prints Admin Feature Setting
 */
function blade_grve_print_admin_option( $item ) {

	$item_type = blade_grve_array_value( $item, 'type' );
	$item_options = blade_grve_array_value( $item, 'options' );
	$item_label = blade_grve_array_value( $item, 'label' );
	$item_id = blade_grve_array_value( $item, 'id' );
	$item_group_id = blade_grve_array_value( $item, 'group_id' );
	$item_name = blade_grve_array_value( $item, 'name' );
	$item_default_value = blade_grve_array_value( $item, 'default_value' );
	$item_value = blade_grve_array_value( $item, 'value', $item_default_value );
	$item2_default_value = blade_grve_array_value( $item, 'default_value2' );
	$item2_value = blade_grve_array_value( $item, 'value2', $item2_default_value );	
	$item_required = blade_grve_array_value( $item, 'required' );
	$item_dependency = blade_grve_array_value( $item, 'dependency' );
	$item_multiple = blade_grve_array_value( $item, 'multiple' );
	$item_type_usage = blade_grve_array_value( $item, 'type_usage' );
	$item_class = blade_grve_array_value( $item, 'extra_class' );

	$item_attributes = array();

	$dependency_field = $item_id_attr = '';
	if( !empty( $item_group_id ) ) {
		$item_attributes[] = 'class="grve-dependency-field ' . esc_attr( $item_class ) . '"';
		$item_attributes[] = 'data-group="' . esc_attr( $item_group_id ) . '"';
	} else {
		$item_attributes[] = 'class="' . esc_attr( $item_class ) . '"';
	}

	if( !empty( $item_id ) ) {
		$item_attributes[] = 'id="' . esc_attr( $item_id ) . '"';
	}

	if ( 'hidden' == $item_type ) {
	?>
	<input type="hidden" name="<?php echo esc_attr( $item_name ); ?>" value="<?php echo esc_attr( $item_value ); ?>" <?php echo implode( ' ', $item_attributes ); ?>/>
	<?php
		return;
	}

	blade_grve_print_admin_option_wrapper_start( $item );
	?>

	<?php if ( 'textfield' == $item_type ) { ?>

		<input type="text" name="<?php echo esc_attr( $item_name ); ?>" value="<?php echo esc_attr( $item_value ); ?>" <?php echo implode( ' ', $item_attributes ); ?>/>

	<?php } elseif ( 'textarea' == $item_type ) { ?>

		<textarea name="<?php echo esc_attr( $item_name ); ?>" cols="40" rows="5" <?php echo implode( ' ', $item_attributes ); ?>><?php echo wp_kses_post( $item_value ); ?></textarea>

	<?php } elseif ( 'select' == $item_type ) { ?>

		<select name="<?php echo esc_attr( $item_name ); ?>" <?php echo implode( ' ', $item_attributes ); ?>>
			<?php blade_grve_print_select_options( $item_options, $item_value ); ?>
		</select>

	<?php } elseif ( 'checkbox' == $item_type ) { ?>

		<input type="checkbox" name="<?php echo esc_attr( $item_name ); ?>" value="yes" <?php checked( $item_value, 'yes' ); ?> <?php echo implode( ' ', $item_attributes ); ?>/>

	<?php } elseif ( 'select-boolean' == $item_type ) { ?>

		<select name="<?php echo esc_attr( $item_name ); ?>" <?php echo implode( ' ', $item_attributes ); ?>>
			<?php blade_grve_print_media_boolean_selection( $item_value ); ?>
		</select>

	<?php } elseif ( 'select-tag' == $item_type ) { ?>

		<select name="<?php echo esc_attr( $item_name ); ?>" <?php echo implode( ' ', $item_attributes ); ?>>
			<?php blade_grve_print_media_tag_selection( $item_value ); ?>
		</select>

	<?php } elseif ( 'select-colorpicker' == $item_type ) { ?>

		<div class="grve-field-item">
			<select class="grve-select-color-extra" name="<?php echo esc_attr( $item_name ); ?>">
			<?php
				if ( 'sidebar-inpage' == $item_type_usage ) {
					blade_grve_print_select_options(
						array(
							'' => esc_html__( '-- Inherit --', 'blade' ),
							'none' => esc_html__( 'None', 'blade' ),
						),
						$item_value
					);
				}
				blade_grve_print_media_color_extra_selection( $item_value );
			?>
			</select>
		</div>
		<div class="grve-field-item">
			<div class="grve-wp-colorpicker">
				<?php
					if ( strpos( $item_name,'color_overlay') !== false) {
						$custom_name = str_replace ( 'color_overlay' , 'color_overlay_custom', $item_name );
					} else {
						$custom_name = str_replace ( 'color' , 'color_custom', $item_name );
					}
				?>
				<input type="text" name="<?php echo esc_attr( $custom_name ); ?>" class="wp-color-picker-field" value="<?php echo esc_attr( $item2_value ); ?>" data-default-color="#000000"/>
			</div>
		</div>

	<?php } elseif ( 'select-image' == $item_type ) { ?>

		<?php

			$thumb_src = wp_get_attachment_image_src( $item_value, 'thumbnail' );
			$thumbnail_url = $thumb_src[0];
			$visibility_class = '';
			if ( empty( $thumbnail_url ) ) {
				$thumbnail_url = get_stylesheet_directory_uri() . '/includes/images/no-image.jpg';
				$alt = '';
			} else {
				$alt = get_post_meta( $item_value, '_wp_attachment_image_alt', true );
				$alt = ! empty( $alt ) ? esc_attr( $alt ) : '';
				$visibility_class = 'grve-visible';
			}
		?>

			<div class="grve-thumb-container <?php echo esc_attr( $visibility_class ); ?>" data-mode="custom-image" data-field-name="<?php echo esc_attr( $item_name ); ?>" >
				<input class="grve-upload-media-id" type="hidden" value="<?php echo esc_attr( $item_value ); ?>" name="<?php echo esc_attr( $item_name ); ?>">
				<?php echo '<img class="grve-thumb" src="' . esc_url( $thumbnail_url ) . '" attid="' . $item_value . '" alt="' . $alt . '" width="120" height="120"/>'; ?>
				<a class="grve-upload-remove-image" href="#"></a>
			</div>
			<div class="grve-upload-replace-image"></div>


	<?php } elseif ( 'colorpicker' == $item_type ) { ?>

		<input type="text" name="<?php echo esc_attr( $item_name ); ?>" class="wp-color-picker-field" value="<?php echo esc_attr( $item_value ); ?>" data-default-color="#ffffff" <?php echo implode( ' ', $item_attributes ); ?>/>

		<?php } elseif ( 'select-color' == $item_type ) { ?>

		<select name="<?php echo esc_attr( $item_name ); ?>" <?php echo implode( ' ', $item_attributes ); ?>>
			<?php blade_grve_print_media_color_selection( $item_value ); ?>
		</select>

	<?php } elseif ( 'select-color-extra' == $item_type ) { ?>

		<select name="<?php echo esc_attr( $item_name ); ?>" <?php echo implode( ' ', $item_attributes ); ?>>
			<?php blade_grve_print_media_color_extra_selection( $item_value ); ?>
		</select>

	<?php } elseif ( 'select-opacity' == $item_type ) { ?>

		<select name="<?php echo esc_attr( $item_name ); ?>" <?php echo implode( ' ', $item_attributes ); ?>>
			<?php blade_grve_print_media_opacity_selection( $item_value ); ?>
		</select>

	<?php } elseif ( 'select-style' == $item_type ) { ?>

		<select name="<?php echo esc_attr( $item_name ); ?>" <?php echo implode( ' ', $item_attributes ); ?>>
			<?php blade_grve_print_media_style_selection( $item_value ); ?>
		</select>

	<?php } elseif ( 'select-header-style' == $item_type ) { ?>

		<select name="<?php echo esc_attr( $item_name ); ?>" <?php echo implode( ' ', $item_attributes ); ?>>
			<?php blade_grve_print_media_header_style_selection( $item_value ); ?>
		</select>

	<?php } elseif ( 'select-align' == $item_type ) { ?>

		<select name="<?php echo esc_attr( $item_name ); ?>" <?php echo implode( ' ', $item_attributes ); ?>>
			<?php blade_grve_print_media_align_selection( $item_value ); ?>
		</select>

	<?php } elseif ( 'select-text-animation' == $item_type ) { ?>

		<select name="<?php echo esc_attr( $item_name ); ?>" <?php echo implode( ' ', $item_attributes ); ?>>
			<?php blade_grve_print_media_text_animation_selection( $item_value ); ?>
		</select>

	<?php } elseif ( 'select-button-target' == $item_type ) { ?>

		<select name="<?php echo esc_attr( $item_name ); ?>" <?php echo implode( ' ', $item_attributes ); ?>>
			<?php blade_grve_print_media_button_target_selection( $item_value ); ?>
		</select>

	<?php } elseif ( 'select-button-type' == $item_type ) { ?>

		<select name="<?php echo esc_attr( $item_name ); ?>" <?php echo implode( ' ', $item_attributes ); ?>>
			<?php blade_grve_print_media_button_type_selection( $item_value ); ?>
		</select>

	<?php } elseif ( 'select-button-color' == $item_type ) { ?>

		<select name="<?php echo esc_attr( $item_name ); ?>" <?php echo implode( ' ', $item_attributes ); ?>>
			<?php blade_grve_print_media_button_color_selection( $item_value ); ?>
		</select>

	<?php } elseif ( 'select-button-size' == $item_type ) { ?>

		<select name="<?php echo esc_attr( $item_name ); ?>" <?php echo implode( ' ', $item_attributes ); ?>>
			<?php blade_grve_print_media_button_size_selection( $item_value ); ?>
		</select>

	<?php } elseif ( 'select-button-shape' == $item_type ) { ?>

		<select name="<?php echo esc_attr( $item_name ); ?>" <?php echo implode( ' ', $item_attributes ); ?>>
			<?php blade_grve_print_media_button_shape_selection( $item_value ); ?>
		</select>

	<?php } elseif ( 'select-pattern-overlay' == $item_type ) { ?>

		<select name="<?php echo esc_attr( $item_name ); ?>" <?php echo implode( ' ', $item_attributes ); ?>>
			<?php blade_grve_print_media_pattern_overlay_selection( $item_value ); ?>
		</select>

	<?php } elseif ( 'select-color-overlay' == $item_type ) { ?>

		<select name="<?php echo esc_attr( $item_name ); ?>" <?php echo implode( ' ', $item_attributes ); ?>>
			<?php blade_grve_print_media_color_overlay_selection( $item_value ); ?>
		</select>

	<?php } elseif ( 'select-bg-image' == $item_type ) { ?>

		<input type="text" class="grve-upload-simple-media-field"  name="<?php echo esc_attr( $item_name ); ?>" value="<?php echo esc_attr( $item_value ); ?>"/>
		<label></label>
		<input type="button" data-media-type="image" class="grve-upload-simple-media-button button-primary" value="<?php esc_attr_e( 'Upload Image', 'blade' ); ?>"/>
		<input type="button" class="grve-remove-simple-media-button button" value="<?php esc_attr_e( 'Remove', 'blade' ); ?>"/>

	<?php } elseif ( 'select-bg-position' == $item_type ) { ?>

		<select name="<?php echo esc_attr( $item_name ); ?>" <?php echo implode( ' ', $item_attributes ); ?>>
			<?php blade_grve_print_media_bg_position_selection( $item_value ); ?>
		</select>

	<?php } elseif ( 'select-bg-position-inherit' == $item_type ) { ?>

		<select name="<?php echo esc_attr( $item_name ); ?>" <?php echo implode( ' ', $item_attributes ); ?>>
			<option value="" <?php selected( "", $item_value ); ?>><?php esc_html_e( 'Inherit from above', 'blade' ); ?></option>
			<?php blade_grve_print_media_bg_position_selection( $item_value ); ?>
		</select>

	<?php } elseif ( 'select-bg-effect' == $item_type ) { ?>

		<select name="<?php echo esc_attr( $item_name ); ?>" <?php echo implode( ' ', $item_attributes ); ?>>
			<?php blade_grve_print_media_bg_effect_selection( $item_value ); ?>
		</select>

	<?php } elseif ( 'select-bg-video' == $item_type ) { ?>

		<input type="text" class="grve-upload-simple-media-field grve-meta-text" name="<?php echo esc_attr( $item_name ); ?>" value="<?php echo esc_attr( $item_value ); ?>"/>
		<label></label>
		<input type="button" data-media-type="video" class="grve-upload-simple-media-button button" value="<?php esc_attr_e( 'Upload Media', 'blade' ); ?>"/>
		<input type="button" class="grve-remove-simple-media-button button" value="<?php esc_attr_e( 'Remove', 'blade' ); ?>"/>

	<?php } ?>

	<?php
	blade_grve_print_admin_option_wrapper_end( $item_multiple );
}
function blade_grve_array_value( $input_array, $id, $fallback = false, $param = false ) {

	if ( $fallback == false ) $fallback = '';
	$output = ( isset($input_array[$id]) && $input_array[$id] !== '' ) ? $input_array[$id] : $fallback;
	if ( !empty($input_array[$id]) && $param ) {
		$output = ( isset($input_array[$id][$param]) && $input_array[$id][$param] !== '' ) ? $input_array[$id][$param] : $fallback;
	}
	return $output;
}

function blade_grve_print_select_options( $selector_array, $current_value = "" ) {

	foreach ( $selector_array as $value=>$display_value ) {
	?>
		<option value="<?php echo esc_attr( $value ); ?>" <?php selected( $current_value, $value ); ?>><?php echo esc_html( $display_value ); ?></option>
	<?php
	}

}

function blade_grve_print_media_tag_selection( $current_value = "" ) {
	global $blade_grve_media_tag_selection;
	blade_grve_print_select_options( $blade_grve_media_tag_selection, $current_value );
}

function blade_grve_print_media_boolean_selection( $current_value = "" ) {
	global $blade_grve_media_boolean_selection;
	blade_grve_print_select_options( $blade_grve_media_boolean_selection, $current_value );
}
function blade_grve_print_media_button_color_selection( $current_value = "" ) {
	global $blade_grve_button_color_selection;
	blade_grve_print_select_options( $blade_grve_button_color_selection, $current_value );
}
function blade_grve_print_media_button_size_selection( $current_value = "" ) {
	global $blade_grve_button_size_selection;
	blade_grve_print_select_options( $blade_grve_button_size_selection, $current_value );
}
function blade_grve_print_media_button_shape_selection( $current_value = "" ) {
	global $blade_grve_button_shape_selection;
	blade_grve_print_select_options( $blade_grve_button_shape_selection, $current_value );
}
function blade_grve_print_media_button_type_selection( $current_value = "" ) {
	global $blade_grve_button_type_selection;
	blade_grve_print_select_options( $blade_grve_button_type_selection, $current_value );
}
function blade_grve_print_media_button_target_selection( $current_value = "" ) {
	global $blade_grve_button_target_selection;
	blade_grve_print_select_options( $blade_grve_button_target_selection, $current_value );
}

function blade_grve_print_media_style_selection( $current_value = "" ) {
	global $blade_grve_media_style_selection;
	blade_grve_print_select_options( $blade_grve_media_style_selection, $current_value );
}
function blade_grve_print_media_color_selection( $current_value = "" ) {
	global $blade_grve_media_color_selection;
	blade_grve_print_select_options( $blade_grve_media_color_selection, $current_value );
}

function blade_grve_print_media_color_extra_selection( $current_value = "" ) {
	global $blade_grve_media_color_extra_selection;
	blade_grve_print_select_options( $blade_grve_media_color_extra_selection, $current_value );
}

function blade_grve_print_media_opacity_selection( $current_value = "" ) {
	global $blade_grve_media_opacity_selection;
	blade_grve_print_select_options( $blade_grve_media_opacity_selection, $current_value );
}

function blade_grve_print_media_align_selection( $current_value = "" ) {
	global $blade_grve_media_align_selection;
	blade_grve_print_select_options( $blade_grve_media_align_selection, $current_value );
}
function blade_grve_print_media_header_style_selection( $current_value = "" ) {
	global $blade_grve_media_header_style_selection;
	blade_grve_print_select_options( $blade_grve_media_header_style_selection, $current_value );
}

function blade_grve_print_media_color_overlay_selection( $current_value = "" ) {
	global $blade_grve_media_color_overlay_selection;
	blade_grve_print_select_options( $blade_grve_media_color_overlay_selection, $current_value );
}
function blade_grve_print_media_pattern_overlay_selection( $current_value = "" ) {
	global $blade_grve_media_pattern_overlay_selection;
	blade_grve_print_select_options( $blade_grve_media_pattern_overlay_selection, $current_value );
}

function blade_grve_print_media_text_animation_selection( $current_value = "" ) {
	global $blade_grve_media_text_animation_selection;
	blade_grve_print_select_options( $blade_grve_media_text_animation_selection, $current_value );
}

function blade_grve_print_media_bg_position_selection( $current_value = "center-center" ) {
	global $blade_grve_media_bg_position_selection;
	blade_grve_print_select_options( $blade_grve_media_bg_position_selection, $current_value );
}

function blade_grve_print_media_bg_effect_selection( $current_value = "" ) {
	global $blade_grve_media_bg_effect_selection;
	blade_grve_print_select_options( $blade_grve_media_bg_effect_selection, $current_value );
}

function blade_grve_print_menu_selection( $menu_id, $id, $name, $default = 'none' ) {

	?>
	<select id="<?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr( $name ); ?>">
		<option value="" <?php selected( '', $menu_id ); ?>>
			<?php
				if ( 'none' == $default ){
					esc_html_e( 'None', 'blade' );
				} else {
					esc_html_e( '-- Inherit --', 'blade' );
				}
			?>
		</option>
	<?php
		$menus = wp_get_nav_menus();
		if ( ! empty( $menus ) ) {
			foreach ( $menus as $item ) {
	?>
				<option value="<?php echo esc_attr( $item->term_id ); ?>" <?php selected( $item->term_id, $menu_id ); ?>>
					<?php echo esc_html( $item->name ); ?>
				</option>
	<?php
			}
		}
	?>
	</select>
	<?php
}
function blade_grve_print_sidebar_selection( $sidebar, $id, $name ) {
	global $wp_registered_sidebars;

	?>
	<select id="<?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr( $name ); ?>">
		<option value="" <?php selected( '', $sidebar ); ?>><?php echo esc_html__( '-- Inherit --', 'blade' ); ?></option>
	<?php
	foreach ( $wp_registered_sidebars as $key => $value ) {
		?>
		<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $key, $sidebar ); ?>><?php echo esc_html( $value['name'] ); ?></option>
		<?php
	}
	?>
	</select>
	<?php
}

/**
 * Function to print page selector
 */
function blade_grve_print_page_selection( $page_id, $id, $name ) {

?>
	<select id="<?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr( $name ); ?>">
		<option value="" <?php selected( '', $page_id ); ?>>
			<?php esc_html_e( '-- Inherit --', 'blade' ); ?>
		</option>
<?php
		$pages = get_pages();
		foreach ( $pages as $page ) {
?>
			<option value="<?php echo esc_attr( $page->ID ); ?>" <?php selected( $page->ID, $page_id ); ?>>
				<?php echo esc_html( $page->post_title ); ?>
			</option>
<?php
		}
?>
	</select>
<?php

}
function blade_grve_woocommerce_enabled() {

	if ( class_exists( 'woocommerce' ) ) {
		return true;
	}
	return false;

}

function blade_grve_is_woo_shop() {
	if ( blade_grve_woocommerce_enabled() && is_shop() && !is_search() ) {
		return true;
	}
	return false;
}

function blade_grve_is_woo_tax() {
	if ( blade_grve_woocommerce_enabled() && is_product_taxonomy() ) {
		return true;
	}
	return false;
}

function blade_grve_is_woo_category() {
	if ( blade_grve_woocommerce_enabled() && is_product_category() ) {
		return true;
	}
	return false;
}

function blade_grve_is_woo_tag() {
	if ( blade_grve_woocommerce_enabled() && is_product_tag() ) {
		return true;
	}
	return false;
}
//-----------------------------------------------------multiple image upload with content-------------------------------------//
function blade_grve_generic_options_save_postdata( $post_id , $post ) {

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( isset( $_POST['grve_page_feature_save_nonce'] ) && wp_verify_nonce( $_POST['grve_page_feature_save_nonce'], 'grve_nonce_save' ) ) {

		if ( blade_grve_check_permissions( $post_id ) ) {
			blade_grve_admin_save_feature_section( $post_id );
		}

	}

	if ( isset( $_POST['grve_page_save_nonce'] ) && wp_verify_nonce( $_POST['grve_page_save_nonce'], 'grve_nonce_save' ) ) {

		if ( blade_grve_check_permissions( $post_id ) ) {

			$grve_page_options = array (
				array(
					'name' => 'Description',
					'id' => 'grve_description',
				),
				array(
					'name' => 'Details Title',
					'id' => 'grve_details_title',
				),
				array(
					'name' => 'Details',
					'id' => 'grve_details',
				),
				array(
					'name' => 'Backlink',
					'id' => 'grve_backlink_id',
				),
				array(
					'name' => 'Layout',
					'id' => 'grve_layout',
				),
				array(
					'name' => 'Sidebar',
					'id' => 'grve_sidebar',
				),
				array(
					'name' => 'Post Content width',
					'id' => 'grve_post_content_width',
				),
				array(
					'name' => 'Sidearea Area Visibility',
					'id' => 'grve_sidearea_visibility',
				),
				array(
					'name' => 'Sidearea Sidebar',
					'id' => 'grve_sidearea_sidebar',
				),
				array(
					'name' => 'Fixed Sidebar',
					'id' => 'grve_fixed_sidebar',
				),
				array(
					'name' => 'Header Overlapping',
					'id' => 'grve_header_overlapping',
				),
				array(
					'name' => 'Header Style',
					'id' => 'grve_header_style',
				),
				array(
					'name' => 'Navigation Anchor Menu',
					'id' => 'grve_anchor_navigation_menu',
				),
				array(
					'name' => 'Theme Loader',
					'id' => 'grve_theme_loader',
				),
				array(
					'name' => 'Scrolling Page',
					'id' => 'grve_scrolling_page',
				),
				array(
					'name' => 'Responsive Scrolling',
					'id' => 'grve_responsive_scrolling',
				),
				array(
					'name' => 'Scrolling Lock Anchors',
					'id' => 'grve_scrolling_lock_anchors',
				),
				array(
					'name' => 'Scrolling Direction',
					'id' => 'grve_scrolling_direction',
				),
				array(
					'name' => 'Scrolling Loop',
					'id' => 'grve_scrolling_loop',
				),
				array(
					'name' => 'Scrolling Speed',
					'id' => 'grve_scrolling_speed',
				),
				array(
					'name' => 'Main Navigation Menu',
					'id' => 'grve_main_navigation_menu',
				),
				array(
					'name' => 'Menu Type',
					'id' => 'grve_menu_type',
				),
				array(
					'name' => 'Sticky Header Type',
					'id' => 'grve_sticky_header_type',
				),
				array(
					'name' => 'Disable Sticky',
					'id' => 'grve_disable_sticky',
				),
				array(
					'name' => 'Disable Top Bar',
					'id' => 'grve_disable_top_bar',
				),
				array(
					'name' => 'Disable Logo',
					'id' => 'grve_disable_logo',
				),
				array(
					'name' => 'Disable Menu',
					'id' => 'grve_disable_menu',
				),
				array(
					'name' => 'Disable Menu Items',
					'id' => 'grve_disable_menu_items',
				),
				array(
					'name' => 'disable Breadcrumbs',
					'id' => 'grve_disable_breadcrumbs',
				),
				array(
					'name' => 'Disable Title',
					'id' => 'grve_disable_title',
				),
				array(
					'name' => 'Disable Media',
					'id' => 'grve_disable_media',
				),
				array(
					'name' => 'Disable Content',
					'id' => 'grve_disable_content',
				),
				array(
					'name' => 'Disable Recent Entries',
					'id' => 'grve_disable_recent_entries',
				),
				array(
					'name' => 'Disable Footer',
					'id' => 'grve_disable_footer',
				),
				array(
					'name' => 'Disable Copyright',
					'id' => 'grve_disable_copyright',
				),
				array(
					'name' => 'Disable Back to Top',
					'id' => 'grve_disable_back_to_top',
				),			
			);

			$grve_disable_menu_items_options = array (
				array(
					'param_id' => 'search',
					'id' => 'grve_disable_menu_item_search',
					'default' => '',
				),
				array(
					'param_id' => 'form',
					'id' => 'grve_disable_menu_item_form',
					'default' => '',
				),
				array(
					'param_id' => 'language',
					'id' => 'grve_disable_menu_item_language',
					'default' => '',
				),
				array(
					'param_id' => 'cart',
					'id' => 'grve_disable_menu_item_cart',
					'default' => '',
				),
				array(
					'param_id' => 'social',
					'id' => 'grve_disable_menu_item_social',
					'default' => '',
				),
			);

			$grve_page_title_options = array (
				array(
					'param_id' => 'custom',
					'id' => 'grve_page_title_custom',
					'default' => '',
				),
				array(
					'param_id' => 'height',
					'id' => 'grve_page_title_height',
					'default' => '350',
				),
				array(
					'param_id' => 'min_height',
					'id' => 'grve_page_title_min_height',
					'default' => '320',
				),
				array(
					'param_id' => 'bg_color',
					'id' => 'grve_page_title_bg_color',
					'default' => 'light',
				),
				array(
					'param_id' => 'bg_color_custom',
					'id' => 'grve_page_title_bg_color_custom',
					'default' => '#ffffff',
				),
				array(
					'param_id' => 'title_color',
					'id' => 'grve_page_title_title_color',
					'default' => 'dark',
				),
				array(
					'param_id' => 'title_color_custom',
					'id' => 'grve_page_title_title_color_custom',
					'default' => '#000000',
				),
				array(
					'param_id' => 'caption_color',
					'id' => 'grve_page_title_caption_color',
					'default' => 'dark',
				),
				array(
					'param_id' => 'caption_color_custom',
					'id' => 'grve_page_title_caption_color_custom',
					'default' => '#000000',
				),
				array(
					'param_id' => 'content_position',
					'id' => 'grve_page_title_content_position',
					'default' => 'center-center',
				),
				array(
					'param_id' => 'content_animation',
					'id' => 'grve_page_title_content_animation',
					'default' => 'fade-in',
				),
				array(
					'param_id' => 'bg_mode',
					'id' => 'grve_page_title_bg_mode',
					'default' => '',
				),
				array(
					'param_id' => 'bg_image_id',
					'id' => 'grve_page_title_bg_image_id',
					'default' => '0',
				),
				array(
					'param_id' => 'bg_position',
					'id' => 'grve_page_title_bg_position',
					'default' => 'center-center',
				),
				array(
					'param_id' => 'pattern_overlay',
					'id' => 'grve_page_title_pattern_overlay',
					'default' => '',
				),
				array(
					'param_id' => 'color_overlay',
					'id' => 'grve_page_title_color_overlay',
					'default' => 'dark',
				),
				array(
					'param_id' => 'color_overlay_custom',
					'id' => 'grve_page_title_color_overlay_custom',
					'default' => '#000000',
				),
				array(
					'param_id' => 'opacity_overlay',
					'id' => 'grve_page_title_opacity_overlay',
					'default' => '0',
				),
			);

			//Update Single custom fields
			foreach ( $grve_page_options as $value ) {
				$new_meta_value = ( isset( $_POST[$value['id']] ) ? $_POST[$value['id']] : '' );
				$meta_key = $value['id'];


				$meta_value = get_post_meta( $post_id, $meta_key, true );

				if ( $new_meta_value && '' == $meta_value ) {
					add_post_meta( $post_id, $meta_key, $new_meta_value, true );
				} elseif ( $new_meta_value && $new_meta_value != $meta_value ) {
					update_post_meta( $post_id, $meta_key, $new_meta_value );
				} elseif ( '' == $new_meta_value && $meta_value ) {
					delete_post_meta( $post_id, $meta_key );
				}
			}

			//Update Menu Items Visibility array
			blade_grve_update_meta_array( $post_id, 'grve_disable_menu_items', $grve_disable_menu_items_options );
			//Update Title Options array
			blade_grve_update_meta_array( $post_id, 'grve_custom_title_options', $grve_page_title_options );
		}
	}

}
function blade_grve_admin_save_feature_section( $post_id ) {

	//Feature Section variable
	$feature_section = array();


	if ( isset( $_POST['grve_page_feature_element'] ) ) {

		//Feature Settings

		$feature_section['feature_settings'] = array (
			'element' => $_POST['grve_page_feature_element'],
			'size' => $_POST['grve_page_feature_size'],
			'height' => $_POST['grve_page_feature_height'],
			'min_height' => $_POST['grve_page_feature_min_height'],
			'header_position' => $_POST['grve_page_feature_header_position'],
			'bg_color' => $_POST['grve_page_feature_bg_color'],
			'bg_color_custom' => $_POST['grve_page_feature_bg_color_custom'],
		);


		//Feature Revolution Slider
		if ( isset( $_POST['grve_page_revslider'] ) ) {
			$feature_section['revslider_alias'] = $_POST['grve_page_revslider'];
		}

		//Feature Single Item
		if ( isset( $_POST['grve_single_item_title'] ) ) {


			$feature_section['single_item'] = array (

				'title' => $_POST['grve_single_item_title'],
				'title_color' => $_POST['grve_single_item_title_color'],
				'title_color_custom' => $_POST['grve_single_item_title_color_custom'],
				'title_tag' => $_POST['grve_single_item_title_tag'],
				'caption' => $_POST['grve_single_item_caption'],
				'caption_color' => $_POST['grve_single_item_caption_color'],
				'caption_color_custom' => $_POST['grve_single_item_caption_color_custom'],
				'caption_tag' => $_POST['grve_single_item_caption_tag'],
				'subheading' => $_POST['grve_single_item_subheading'],
				'subheading_color' => $_POST['grve_single_item_subheading_color'],
				'subheading_color_custom' => $_POST['grve_single_item_subheading_color_custom'],
				'subheading_tag' => $_POST['grve_single_item_subheading_tag'],
				'content_position' => $_POST['grve_single_item_content_position'],
				'content_animation' => $_POST['grve_single_item_content_animation'],
				'content_image_id' => $_POST['grve_single_item_content_image_id'],
				'content_image_size' => $_POST['grve_single_item_content_image_size'],
				'content_image_max_height' => $_POST['grve_single_item_content_image_max_height'],
				'pattern_overlay' => $_POST['grve_single_item_pattern_overlay'],
				'color_overlay' => $_POST['grve_single_item_color_overlay'],
				'color_overlay_custom' => $_POST['grve_single_item_color_overlay_custom'],
				'opacity_overlay' => $_POST['grve_single_item_opacity_overlay'],
				'bg_image_id' => $_POST['grve_single_item_bg_image_id'],
				'bg_position' => $_POST['grve_single_item_bg_position'],
				'bg_tablet_sm_position' => $_POST['grve_single_item_bg_tablet_sm_position'],
				'image_effect' => $_POST['grve_single_item_image_effect'],
				'video_webm' => $_POST['grve_single_item_video_webm'],
				'video_mp4' => $_POST['grve_single_item_video_mp4'],
				'video_ogv' => $_POST['grve_single_item_video_ogv'],
				'video_poster' => $_POST['grve_single_item_video_poster'],
				'video_loop' => $_POST['grve_single_item_video_loop'],
				'video_muted' => $_POST['grve_single_item_video_muted'],
				'video_effect' => $_POST['grve_single_item_video_effect'],

				'button' => array(
					'id' => $_POST['grve_single_item_button_id'],
					'text' => $_POST['grve_single_item_button_text'],
					'url' => $_POST['grve_single_item_button_url'],
					'target' => $_POST['grve_single_item_button_target'],
					'color' => $_POST['grve_single_item_button_color'],
					'hover_color' => $_POST['grve_single_item_button_hover_color'],
					'size' => $_POST['grve_single_item_button_size'],
					'shape' => $_POST['grve_single_item_button_shape'],
					'type' => $_POST['grve_single_item_button_type'],
					'class' => $_POST['grve_single_item_button_class'],
				),
				'button2' => array(
					'id' => $_POST['grve_single_item_button2_id'],
					'text' => $_POST['grve_single_item_button2_text'],
					'url' => $_POST['grve_single_item_button2_url'],
					'target' => $_POST['grve_single_item_button2_target'],
					'color' => $_POST['grve_single_item_button2_color'],
					'hover_color' => $_POST['grve_single_item_button2_hover_color'],
					'size' => $_POST['grve_single_item_button2_size'],
					'shape' => $_POST['grve_single_item_button2_shape'],
					'type' => $_POST['grve_single_item_button2_type'],
					'class' => $_POST['grve_single_item_button2_class'],
				),
				'arrow_enabled' => $_POST['grve_single_item_arrow_enabled'],
				'arrow_align' => $_POST['grve_single_item_arrow_align'],
				'arrow_color' => $_POST['grve_single_item_arrow_color'],
				'arrow_color_custom' => $_POST['grve_single_item_arrow_color_custom'],
				'el_class' => $_POST['grve_single_item_el_class'],

			);
		}

		//Feature Slider Items
		$slider_items = array();
		if ( isset( $_POST['grve_slider_item_id'] ) ) {

			$num_of_images = sizeof( $_POST['grve_slider_item_id'] );
			for ( $i=0; $i < $num_of_images; $i++ ) {

				$slide = array (
					'id' => $_POST['grve_slider_item_id'][ $i ],
					'bg_image_id' => $_POST['grve_slider_item_bg_image_id'][ $i ],
					'bg_position' => $_POST['grve_slider_item_bg_position'][ $i ],
					'bg_tablet_sm_position' => $_POST['grve_slider_item_bg_tablet_sm_position'][ $i ],
					'header_style' => $_POST['grve_slider_item_header_style'][ $i ],
					'title' => $_POST['grve_slider_item_title'][ $i ],
					'title_color' => $_POST['grve_slider_item_title_color'][ $i ],
					'title_color_custom' => $_POST['grve_slider_item_title_color_custom'][ $i ],
					'title_tag' => $_POST['grve_slider_item_title_tag'][ $i ],
					'caption' => $_POST['grve_slider_item_caption'][ $i ],
					'caption_color' => $_POST['grve_slider_item_caption_color'][ $i ],
					'caption_color_custom' => $_POST['grve_slider_item_caption_color_custom'][ $i ],
					'caption_tag' => $_POST['grve_slider_item_caption_tag'][ $i ],
					'subheading' => $_POST['grve_slider_item_subheading'][ $i ],
					'subheading_color' => $_POST['grve_slider_item_subheading_color'][ $i ],
					'subheading_color_custom' => $_POST['grve_slider_item_subheading_color_custom'][ $i ],
					'subheading_tag' => $_POST['grve_slider_item_subheading_tag'][ $i ],
					'content_position' => $_POST['grve_slider_item_content_position'][ $i ],
					'content_animation' => $_POST['grve_slider_item_content_animation'][ $i ],
					'content_image_id' => $_POST['grve_slider_item_content_image_id'][ $i ],
					'content_image_size' => $_POST['grve_slider_item_content_image_size'][ $i ],
					'content_image_max_height' => $_POST['grve_slider_item_content_image_max_height'][ $i ],
					'pattern_overlay' => $_POST['grve_slider_item_pattern_overlay'][ $i ],
					'color_overlay' => $_POST['grve_slider_item_color_overlay'][ $i ],
					'color_overlay_custom' => $_POST['grve_slider_item_color_overlay_custom'][ $i ],
					'opacity_overlay' => $_POST['grve_slider_item_opacity_overlay'][ $i ],
					'button' => array(
						'id' => $_POST['grve_slider_item_button_id'][ $i ],
						'text' => $_POST['grve_slider_item_button_text'][ $i ],
						'url' => $_POST['grve_slider_item_button_url'][ $i ],
						'target' => $_POST['grve_slider_item_button_target'][ $i ],
						'color' => $_POST['grve_slider_item_button_color'][ $i ],
						'hover_color' => $_POST['grve_slider_item_button_hover_color'][ $i ],
						'size' => $_POST['grve_slider_item_button_size'][ $i ],
						'shape' => $_POST['grve_slider_item_button_shape'][ $i ],
						'type' => $_POST['grve_slider_item_button_type'][ $i ],
						'class' => $_POST['grve_slider_item_button_class'][ $i ],
					),
					'button2' => array(
						'id' => $_POST['grve_slider_item_button2_id'][ $i ],
						'text' => $_POST['grve_slider_item_button2_text'][ $i ],
						'url' => $_POST['grve_slider_item_button2_url'][ $i ],
						'target' => $_POST['grve_slider_item_button2_target'][ $i ],
						'color' => $_POST['grve_slider_item_button2_color'][ $i ],
						'hover_color' => $_POST['grve_slider_item_button2_hover_color'][ $i ],
						'size' => $_POST['grve_slider_item_button2_size'][ $i ],
						'shape' => $_POST['grve_slider_item_button2_shape'][ $i ],
						'type' => $_POST['grve_slider_item_button2_type'][ $i ],
						'class' => $_POST['grve_slider_item_button2_class'][ $i ],
					),
					'arrow_enabled' => $_POST['grve_slider_item_arrow_enabled'][ $i ],
					'arrow_align' => $_POST['grve_slider_item_arrow_align'][ $i ],
					'arrow_color' => $_POST['grve_slider_item_arrow_color'][ $i ],
					'arrow_color_custom' => $_POST['grve_slider_item_arrow_color_custom'][ $i ],
					'el_class' => $_POST['grve_slider_item_el_class'][ $i ],
				);

				$slider_items[] = $slide;
			}

		}



		if( !empty( $slider_items ) ) {
			$feature_section['slider_items'] = $slider_items;

			$feature_section['slider_settings'] = array (
				'slideshow_speed' => $_POST['grve_page_slider_settings_speed'],
				'direction_nav' => $_POST['grve_page_slider_settings_direction_nav'],
				'slider_pause' => $_POST['grve_page_slider_settings_pause'],
				'transition' => $_POST['grve_page_slider_settings_transition'],
				'slider_effect' => $_POST['grve_page_slider_settings_effect'],
			);
		}

		//Feature Map Items
		$map_items = array();
		if ( isset( $_POST['grve_map_item_point_id'] ) ) {

			$num_of_map_points = sizeof( $_POST['grve_map_item_point_id'] );
			for ( $i=0; $i < $num_of_map_points; $i++ ) {

				$this_point = array (
					'id' => $_POST['grve_map_item_point_id'][ $i ],
					'lat' => $_POST['grve_map_item_point_lat'][ $i ],
					'lng' => $_POST['grve_map_item_point_lng'][ $i ],
					'marker' => $_POST['grve_map_item_point_marker'][ $i ],
					'title' => $_POST['grve_map_item_point_title'][ $i ],
					'info_text' => $_POST['grve_map_item_point_infotext'][ $i ],
					'info_text_open' => $_POST['grve_map_item_point_infotext_open'][ $i ],
					'button_text' => $_POST['grve_map_item_point_button_text'][ $i ],
					'button_url' => $_POST['grve_map_item_point_button_url'][ $i ],
					'button_target' => $_POST['grve_map_item_point_button_target'][ $i ],
					'button_class' => $_POST['grve_map_item_point_button_class'][ $i ],
				);
				$map_items[] =  $this_point;
			}

		}

		if( !empty( $map_items ) ) {

			$feature_section['map_items'] = $map_items;
			$feature_section['map_settings'] = array (
				'zoom' => $_POST['grve_page_feature_map_zoom'],
				'marker' => $_POST['grve_page_feature_map_marker'],
				'disable_style' => $_POST['grve_page_feature_map_disable_style'],
			);

		}

	}

	//Save Feature Section

	$new_meta_value = $feature_section;
	$meta_key = 'grve_feature_section';
	$meta_value = get_post_meta( $post_id, $meta_key, true );

	if ( $new_meta_value && '' == $meta_value ) {
		if ( !add_post_meta( $post_id, $meta_key, $new_meta_value, true ) ) {
			update_post_meta( $post_id, $meta_key, $new_meta_value );
		}
	} elseif ( $new_meta_value && $new_meta_value != $meta_value ) {
		update_post_meta( $post_id, $meta_key, $new_meta_value );
	} elseif ( '' == $new_meta_value && $meta_value ) {
		delete_post_meta( $post_id, $meta_key, $meta_value );
	}

}
function blade_grve_check_permissions( $post_id ) {

	if ( 'post' == $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_post', $post_id ) ) {
			return false;
		}
	} else {
		if ( !current_user_can( 'edit_page', $post_id ) ) {
			return false;
		}
	}
	return true;
}
?>