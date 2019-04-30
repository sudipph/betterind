<?php

//define('TOP_STORIES','top_stories');
define('TOP_STORIES', '');
define('TOP_STORIES_TITLE', 'Top Story');
define('TOP_STORIES_TITLES', 'Top Stories');

define('AUTHOR', 'author');
define('AUTHOR_TITLE', 'Author');
define('AUTHOR_TITLES', 'Author');

define('AWARDS', 'awards');
define('AWARDS_TITLE', 'Awards');
define('AWARDS_TITLES', 'Awards');

//define('FEATURED_VIDEO','featured_video');
define('FEATURED_VIDEO', '');
define('FEATURED_VIDEO_TITLE', 'Featured Video');
define('FEATURED_VIDEO_TITLES', 'Featured Videos');

define('STORY_PACKAGES', '');
define('STORY_PACKAGES_TITLE', 'Story Package');
define('STORY_PACKAGES_TITLES', 'Story Packages');
define('STORY_PACKAGES_CATEGORY_TAG', 'story-package');
define('STORY_PACKAGES_CATEGORY', 'Subject');

define('STORIES', '');
define('STORIES_TITLE', 'Story');
define('STORIES_TITLES', 'Stories');

define('SPOTLIGHT', '');
define('SPOTLIGHT_TITLE', 'Spotlight');
define('SPOTLIGHT_TITLES', 'Spotlights');

define('QUICKBYTE', 'quickbyte');
define('QUICKBYTE_TITLE', 'Quickbyte');
define('QUICKBYTE_TITLES', 'Quickbytes');

define('TBI_CORNER', '');
define('TBI_CORNER_TITLE', 'TBI Corner');
define('TBI_CORNER_TITLES', 'TBI Corners');
//solutions_library
define('FUTURE_INDIA', '');
define('FUTURE_INDIA_TITLE', 'Solutions Library');
define('FUTURE_INDIA_TITLES', 'Solutions Library');
//rainwater_harvesting
define('RAINWATER', '');
define('RAINWATER_TITLE', 'Rainwater Harvesting');
define('RAINWATER_TITLES', 'Rainwater Harvesting');

define('SHOP', 'shop');
define('SHOP_TITLE', 'Product');
define('SHOP_TITLES', 'Products');

define('CONTACTS', 'contacts_database');
define('CONTACTS_TITLE', 'Contacts Database');
define('CONTACTS_TITLES', 'Contacts Database');
///success_stories
define('SUCCESS_STORY', '');
define('SUCCESS_STORY_TITLE', 'Success Story');
define('SUCCESS_STORY_TITLES', 'Success Stories');

define('CUSTOM_FIELD_FILTER', 'post');

define('ADD_FIELD_FOR_POST_LIST', 'post');
define('ADMIN_FILTER_FIELD_VALUE', 'card_type');

define('POST_CATEGORY', 'Subject');

define('POST_CATEGORY1', 'Story Package');
define('POST_CATEGORY1_SLUG', 'story_package');

define('POST_SOLUTION_LIBRARY_TITLE', 'Solutions Library');
define('POST_SOLUTION_LIBRARY', 'solutions_library');

define('POST_SOL_CAT', 'Solutions Library');
//solution_library
define('POST_SOL_CAT_SLUG', '');

$card_type_array = array(
    'top-stories' => 'Regular Post',
    'tourism' => 'Tourism',
    'pod_cast' => 'POD Cast',
    'video' => 'Video',
    'story' => 'Story',
    'spotlights' => 'Spotlights',
    'tbicorners' => 'TBI Corners',
    'solarticle' => 'Solution Article',
     'successstory' => 'Success Story',

);

function tr_create_my_taxonomy()
{
   
    $tag = 'Story Package';
    $labels = array(
        'name' => _x($tag, 'Taxonomy General Name', 'hierarchical_tags'),
        'singular_name' => _x($tag, 'Taxonomy Singular Name', 'hierarchical_tags'),
        'menu_name' => __($tag, 'hierarchical_tags'),
        'all_items' => __('All ' . $tag, 'hierarchical_tags'),
        'parent_item' => __('Parent ' . $tag, 'hierarchical_tags'),
        'parent_item_colon' => __('Parent ' . $tag . ':', 'hierarchical_tags'),
        'new_item_name' => __('New ' . $tag . ' Name', 'hierarchical_tags'),
        'add_new_item' => __('Add New ' . $tag . '', 'hierarchical_tags'),
        'edit_item' => __('Edit ' . $tag . '', 'hierarchical_tags'),
        'update_item' => __('Update ' . $tag . '', 'hierarchical_tags'),
        'view_item' => __('View ' . $tag . '', 'hierarchical_tags'),
        'separate_items_with_commas' => __('Separate tags with commas', 'hierarchical_tags'),
        'add_or_remove_items' => __('Add or remove tags', 'hierarchical_tags'),
        'choose_from_most_used' => __('Choose from the most used', 'hierarchical_tags'),
        'popular_items' => __('Popular ' . $tag, 'hierarchical_tags'),
        'search_items' => __('Search ' . $tag, 'hierarchical_tags'),
        'not_found' => __('Not Found', 'hierarchical_tags'),
    );
    register_taxonomy(
        POST_CATEGORY1_SLUG,
        'post',
        array(
            'labels' => $labels,
            'label' => __(POST_CATEGORY1),
            'rewrite' => array('slug' => POST_CATEGORY1_SLUG),
            'hierarchical' => false,
            'parent_item' => null,
            'parent_item_colon' => null,

            'show_ui' => true,
            'show_in_quick_edit' => false,
            'meta_box_cb' => false,
        )
    );
    //$tag = 'Solutions Library';
    $tag = 'Category';
    $labels = array(
        'name' => _x($tag, 'Taxonomy General Name', 'hierarchical_tags'),
        'singular_name' => _x($tag, 'Taxonomy Singular Name', 'hierarchical_tags'),
        'menu_name' => __($tag, 'hierarchical_tags'),
        'all_items' => __('All ' . $tag, 'hierarchical_tags'),
        'parent_item' => __('Parent ' . $tag, 'hierarchical_tags'),
        'parent_item_colon' => __('Parent ' . $tag . ':', 'hierarchical_tags'),
        'new_item_name' => __('New ' . $tag . ' Name', 'hierarchical_tags'),
        'add_new_item' => __('Add New ' . $tag . '', 'hierarchical_tags'),
        'edit_item' => __('Edit ' . $tag . '', 'hierarchical_tags'),
        'update_item' => __('Update ' . $tag . '', 'hierarchical_tags'),
        'view_item' => __('View ' . $tag . '', 'hierarchical_tags'),
        'separate_items_with_commas' => __('Separate tags with commas', 'hierarchical_tags'),
        'add_or_remove_items' => __('Add or remove tags', 'hierarchical_tags'),
        'choose_from_most_used' => __('Choose from the most used', 'hierarchical_tags'),
        'popular_items' => __('Popular ' . $tag, 'hierarchical_tags'),
        'search_items' => __('Search ' . $tag, 'hierarchical_tags'),
        'not_found' => __('Not Found', 'hierarchical_tags'),
    );
    register_taxonomy(
        POST_SOLUTION_LIBRARY,
        array('post', 'success_stories'),
        array(
            'labels' => $labels,
            'label' => __(POST_SOLUTION_LIBRARY_TITLE),
            'rewrite' => array('slug' => POST_SOLUTION_LIBRARY),
            'hierarchical' => false,
            'meta_box_cb' => "post_categories_meta_box",
            'parent_item' => null,
            'parent_item_colon' => null,
        )
    );
    //$tag = 'Solutions Library';
    $tag = 'Quick Bytes Category';
    $labels = array(
        'name' => _x($tag, 'Taxonomy General Name', 'hierarchical_tags'),
        'singular_name' => _x($tag, 'Taxonomy Singular Name', 'hierarchical_tags'),
        'menu_name' => __($tag, 'hierarchical_tags'),
        'all_items' => __('All ' . $tag, 'hierarchical_tags'),
        'parent_item' => __('Parent ' . $tag, 'hierarchical_tags'),
        'parent_item_colon' => __('Parent ' . $tag . ':', 'hierarchical_tags'),
        'new_item_name' => __('New ' . $tag . ' Name', 'hierarchical_tags'),
        'add_new_item' => __('Add New ' . $tag . '', 'hierarchical_tags'),
        'edit_item' => __('Edit ' . $tag . '', 'hierarchical_tags'),
        'update_item' => __('Update ' . $tag . '', 'hierarchical_tags'),
        'view_item' => __('View ' . $tag . '', 'hierarchical_tags'),
        'separate_items_with_commas' => __('Separate tags with commas', 'hierarchical_tags'),
        'add_or_remove_items' => __('Add or remove tags', 'hierarchical_tags'),
        'choose_from_most_used' => __('Choose from the most used', 'hierarchical_tags'),
        'popular_items' => __('Popular ' . $tag, 'hierarchical_tags'),
        'search_items' => __('Search ' . $tag, 'hierarchical_tags'),
        'not_found' => __('Not Found', 'hierarchical_tags'),
    );
    // register_taxonomy(
    //     'quickbyte',
    //     array('quickbyte'),
    //     array(
    //         'labels' => $labels,
    //         'label' => __('Quick Bytes'),
    //         'rewrite' => array('slug' => 'quickbyte'),
    //         'hierarchical' => false,
    //         'meta_box_cb' => "post_categories_meta_box",
    //         'parent_item' => null,
    //         'parent_item_colon' => null,
    //     )
    // );
    //$tag = 'Solutions Library';
    $tag = 'Contact Category';
    $labels = array(
        'name' => _x($tag, 'Taxonomy General Name', 'hierarchical_tags'),
        'singular_name' => _x($tag, 'Taxonomy Singular Name', 'hierarchical_tags'),
        'menu_name' => __($tag, 'hierarchical_tags'),
        'all_items' => __('All ' . $tag, 'hierarchical_tags'),
        'parent_item' => __('Parent ' . $tag, 'hierarchical_tags'),
        'parent_item_colon' => __('Parent ' . $tag . ':', 'hierarchical_tags'),
        'new_item_name' => __('New ' . $tag . ' Name', 'hierarchical_tags'),
        'add_new_item' => __('Add New ' . $tag . '', 'hierarchical_tags'),
        'edit_item' => __('Edit ' . $tag . '', 'hierarchical_tags'),
        'update_item' => __('Update ' . $tag . '', 'hierarchical_tags'),
        'view_item' => __('View ' . $tag . '', 'hierarchical_tags'),
        'separate_items_with_commas' => __('Separate tags with commas', 'hierarchical_tags'),
        'add_or_remove_items' => __('Add or remove tags', 'hierarchical_tags'),
        'choose_from_most_used' => __('Choose from the most used', 'hierarchical_tags'),
        'popular_items' => __('Popular ' . $tag, 'hierarchical_tags'),
        'search_items' => __('Search ' . $tag, 'hierarchical_tags'),
        'not_found' => __('Not Found', 'hierarchical_tags'),
    );
    register_taxonomy(
        'contacts_database',
        array('contacts_database'),
        array(
            'labels' => $labels,
            'label' => __('Contact Category'),
            'rewrite' => array('slug' => 'contacts_database'),
            'hierarchical' => false,
            'meta_box_cb' => "post_categories_meta_box",
            'parent_item' => null,
            'parent_item_colon' => null,
        )
    );

    if (POST_SOL_CAT_SLUG != '') {

        register_taxonomy(
            POST_SOL_CAT_SLUG,
            'future_india',
            array(
                'label' => __(POST_SOL_CAT),
                'rewrite' => array('slug' => POST_SOL_CAT_SLUG),
                'hierarchical' => false,
                'parent_item' => null,
                'parent_item_colon' => null,
                'query_var' => true,
            )
        );

    }

}
add_action('init', 'tr_create_my_taxonomy');

function revcon_change_cat_label()
{
    global $submenu;
    $submenu['edit.php'][15][0] = POST_CATEGORY; // Rename categories to Authors
}
function revcon_change_cat_object()
{
    global $wp_taxonomies;
    $labels = &$wp_taxonomies['category']->labels;
    $labels->name = POST_CATEGORY;
    $labels->singular_name = POST_CATEGORY;
    $labels->add_new = 'Add ' . POST_CATEGORY;
    $labels->add_new_item = 'Add ' . POST_CATEGORY;
    $labels->edit_item = 'Edit ' . POST_CATEGORY;
    $labels->new_item = POST_CATEGORY;
    $labels->view_item = 'View ' . POST_CATEGORY;
    $labels->search_items = 'Search ' . POST_CATEGORY;
    $labels->not_found = 'No ' . POST_CATEGORY . ' found';
    $labels->not_found_in_trash = 'No ' . POST_CATEGORY . ' found in Trash';
    $labels->all_items = 'All ' . POST_CATEGORY;
    $labels->menu_name = POST_CATEGORY;
    $labels->name_admin_bar = POST_CATEGORY;
}
add_action('init', 'revcon_change_cat_object');

add_action('admin_menu', 'revcon_change_cat_label');
//----------------------------------remove admin bar from frontend--------------------------------//
//add_filter('show_admin_bar', '__return_false');

//----------------------------------remove admin bar from frontend--------------------------------//
//--------------------------------------post type create----------------------------------//
function xcompile_post_type_labels($singular = 'Post', $plural = 'Posts')
{
    $p_lower = strtolower($plural);
    $s_lower = strtolower($singular);

    return [
        'name' => $plural,
        'singular_name' => $singular,
        'add_new_item' => "New $singular",
        'edit_item' => "Edit $singular",
        'view_item' => "View $singular",
        'view_items' => "View $plural",
        'search_items' => "Search $plural",
        'not_found' => "No $p_lower found",
        'not_found_in_trash' => "No $p_lower found in trash",
        'parent_item_colon' => "Parent $singular",
        'all_items' => "All $plural",
        'archives' => "$singular Archives",
        'attributes' => "$singular Attributes",
        'insert_into_item' => "Insert into $s_lower",
        'uploaded_to_this_item' => "Uploaded to this $s_lower",
    ];
}
add_action('init', function () {
    if (TOP_STORIES != '') {
        $type = TOP_STORIES;

        // Call the function and save it to $labels
        $labels = xcompile_post_type_labels(TOP_STORIES_TITLE, TOP_STORIES_TITLES);

        $arguments = [
            'public' => true,
            'description' => 'Case ' . TOP_STORIES_TITLES . ' for portfolio.',
            'labels' => $labels, // Changed to labels
            'supports' => ['title', 'editor', 'revisions', 'page-attributes', 'thumbnail'],
        ];
        /*---------------------------------category-----------------------------------------*/
        /*$arguments = [
        'taxonomies' => ['post_tag'], // And post tags
        'register_meta_box_cb' => 'study_meta_box',
        'labels'  => $labels,
        'description' => 'Case studies for portfolio.',
        'menu_icon' => 'dashicons-desktop',
        'public' => true,
        'has_archive' => true,
        'hierarchical' => false,
        'show_in_rest' => true,
        'rest_base' => 'studies',
        'supports' => ['title', 'editor', 'revisions', 'page-attributes', 'thumbnail'],
        'rewrite' => [ 'slug' => 'studies' ]
        ];*/
        /*---------------------------------category-----------------------------------------*/
        register_post_type($type, $arguments);
    }
    if (AUTHOR != '') {
        $type = AUTHOR;

        // Call the function and save it to $labels
        $labels = xcompile_post_type_labels(AUTHOR_TITLE, AUTHOR_TITLES);

        $arguments = [
            'public' => true,
            'description' => 'Case ' . AUTHOR_TITLES . ' for portfolio.',
            'labels' => $labels, // Changed to labels
            'show_in_menu' => 'front-sections',
            'has_archive' => true,
            'supports' => ['title', 'editor', 'revisions', 'page-attributes', 'thumbnail'],
        ];
        /*---------------------------------category-----------------------------------------*/
        /*---------------------------------category-----------------------------------------*/
        register_post_type($type, $arguments);
        //flush_rewrite_rules();
    }
    if (AWARDS != '') {
        $type = AWARDS;

        // Call the function and save it to $labels
        $labels = xcompile_post_type_labels(AWARDS_TITLE, AWARDS_TITLES);

        $arguments = [
            'public' => true,
            'description' => 'Case ' . AWARDS_TITLES . ' for portfolio.',
            'labels' => $labels, // Changed to labels
            'show_in_menu' => 'front-sections',
            'has_archive' => true,
            'supports' => ['title', 'editor', 'revisions', 'page-attributes', 'thumbnail'],
        ];
        /*---------------------------------category-----------------------------------------*/
        /*---------------------------------category-----------------------------------------*/
        register_post_type($type, $arguments);

    }
    if (FEATURED_VIDEO != '') {
        $type1 = FEATURED_VIDEO;

        // Call the function and save it to $labels
        $labels1 = xcompile_post_type_labels(FEATURED_VIDEO_TITLE, FEATURED_VIDEO_TITLES);

        $arguments1 = [
            'public' => true,
            'description' => 'Case ' . FEATURED_VIDEO_TITLES . ' for portfolio.',
            'has_archive' => true,
            'labels' => $labels1, // Changed to labels
        ];
        register_post_type($type1, $arguments1);
    }
    if (STORY_PACKAGES != '') {
        $type2 = STORY_PACKAGES;

        // Call the function and save it to $labels
        $labels2 = xcompile_post_type_labels(STORY_PACKAGES_TITLE, STORY_PACKAGES_TITLES);

        $arguments2 = [
            'public' => true,
            'description' => 'Case ' . STORY_PACKAGES_TITLES . ' for portfolio.',
            'menu_icon' => 'dashicons-desktop',
            'supports' => ['title', 'editor', 'author', 'excerpt', 'page-attributes', 'revisions', 'page-attributes', 'thumbnail'],
            'has_archive' => true,
            'labels' => $labels2, // Changed to labels
        ];
        //,'trackbacks'
        register_post_type($type2, $arguments2);
    }
    if (STORIES != '') {
        $type3 = STORIES;

        // Call the function and save it to $labels
        $labels3 = xcompile_post_type_labels(STORIES_TITLE, STORIES_TITLES);

        $arguments3 = [
            'public' => true,
            'description' => 'Case ' . STORIES_TITLES . ' for portfolio.',
            'labels' => $labels3, // Changed to labels
            'supports' => ['title', 'editor', 'author', 'excerpt', 'page-attributes', 'revisions', 'page-attributes', 'thumbnail'],
            'has_archive' => true,
            'show_in_menu' => 'edit.php?post_type=story_packages',
        ];
        /*,'trackbacks'*/
        register_post_type($type3, $arguments3);
    }
//---------
    if (SPOTLIGHT != '') {
        $type3 = SPOTLIGHT;

        // Call the function and save it to $labels
        $labels3 = xcompile_post_type_labels(SPOTLIGHT_TITLE, SPOTLIGHT_TITLES);

        $arguments3 = [
            'public' => true,
            'description' => 'Case ' . SPOTLIGHT_TITLES . ' for portfolio.',
            'labels' => $labels3, // Changed to labels
            'has_archive' => true,
            'supports' => ['title', 'editor', 'revisions', 'page-attributes', 'thumbnail'],

        ];
        /**/
        register_post_type($type3, $arguments3);
    }
    $type3 = QUICKBYTE;

    // Call the function and save it to $labels
    $labels3 = xcompile_post_type_labels(QUICKBYTE_TITLE, QUICKBYTE_TITLES);

    $arguments3 = [
        'public' => true,
        'description' => 'Case ' . QUICKBYTE_TITLES . ' for portfolio.',
        'labels' => $labels3, // Changed to labels
        'supports' => ['title', 'editor', 'revisions', 'page-attributes', 'thumbnail'],
        'has_archive' => true,
        'show_in_menu' => 'front-sections',

    ];
    /**/
    register_post_type($type3, $arguments3);

    // register_taxonomy(
    // 'quick_category', //taxonomy
    // QUICKBYTE, //post-type
    // array(
    //     'hierarchical'  => false,
    //     'label'         => __( QUICKBYTE_TITLES .' Category','taxonomy general name'),
    //     'singular_name' => __( 'Tag', 'taxonomy general name' ),
    //     'rewrite' => array('slug' => 'quick_category'),
    //     'hierarchical' => false,
    //     'meta_box_cb'       => "post_categories_meta_box",
    //     'parent_item'  => null,
    //     'parent_item_colon' => null
    // ));

    if (TBI_CORNER != '') {
        $type3 = TBI_CORNER;

        // Call the function and save it to $labels
        $labels3 = xcompile_post_type_labels(TBI_CORNER_TITLE, TBI_CORNER_TITLES);

        $arguments3 = [
            'public' => true,
            'description' => 'Case ' . TBI_CORNER_TITLES . ' for portfolio.',
            'labels' => $labels3, // Changed to labels
            'has_archive' => true,
            'supports' => ['title', 'editor', 'revisions', 'page-attributes', 'thumbnail'],

        ];
        /**/
        register_post_type($type3, $arguments3);
    }
    if (FUTURE_INDIA != '') {

        $type3 = FUTURE_INDIA;

        // Call the function and save it to $labels
        $labels3 = xcompile_post_type_labels(FUTURE_INDIA_TITLE, FUTURE_INDIA_TITLES);

        $arguments3 = [
            'public' => true,
            'description' => 'Case ' . FUTURE_INDIA_TITLES . ' for portfolio.',
            'labels' => $labels3, // Changed to labels
            'show_in_menu' => 'front-sections-future',
            'has_archive' => true,
            'supports' => ['title', 'editor', 'revisions', 'page-attributes', 'thumbnail'],

        ];
        /**/
        register_post_type($type3, $arguments3);
    }
    if (RAINWATER != '') {

        $type3 = RAINWATER;

        // Call the function and save it to $labels
        $labels3 = xcompile_post_type_labels(RAINWATER_TITLE, RAINWATER_TITLES);

        $arguments3 = [
            'public' => true,
            'description' => 'Case ' . RAINWATER_TITLES . ' for portfolio.',
            'labels' => $labels3, // Changed to labels
            'show_in_menu' => 'front-sections-future',
            'has_archive' => true,
            'supports' => ['title', 'editor', 'revisions', 'page-attributes', 'thumbnail'],

        ];
        /**/
        register_post_type($type3, $arguments3);
    }

    $type3 = SHOP;

    // Call the function and save it to $labels
    $labels3 = xcompile_post_type_labels(SHOP_TITLE, SHOP_TITLES);

    $arguments3 = [
        'public' => true,
        'description' => 'Case ' . SHOP_TITLES . ' for portfolio.',
        'labels' => $labels3, // Changed to labels
        'show_in_menu' => 'front-sections',
        'has_archive' => true,
        'supports' => ['title', 'editor', 'revisions', 'page-attributes', 'thumbnail'],

    ];
    /**/
    register_post_type($type3, $arguments3);

    $type3 = CONTACTS;

    // Call the function and save it to $labels
    $labels3 = xcompile_post_type_labels(CONTACTS_TITLE, CONTACTS_TITLES);

    $arguments3 = [
        'public' => true,
        'description' => 'Case ' . CONTACTS_TITLES . ' for portfolio.',
        'labels' => $labels3, // Changed to labels
        'show_in_menu' => 'front-sections',
        'has_archive' => true,
        'supports' => ['title', 'editor', 'revisions', 'page-attributes', 'thumbnail'],
        'taxonomies' => array('type', 'location'),
        'rewrite' => array('slug' => 'tag'),
    ];
    /**/
    register_post_type($type3, $arguments3);

    register_taxonomy(
        'type', //taxonomy
        CONTACTS, //post-type
        array(
            'hierarchical' => false,
            'label' => __('Location', 'taxonomy general name'),
            'singular_name' => __('Tag', 'taxonomy general name'),
            'rewrite' => true,
            'query_var' => true,
        ));

    $type3 = SUCCESS_STORY;

    // Call the function and save it to $labels
    if( $type3!=''){
    $labels3 = xcompile_post_type_labels(SUCCESS_STORY_TITLE, SUCCESS_STORY_TITLES);

    $arguments3 = [
        'public' => true,
        'description' => 'Case ' . SUCCESS_STORY_TITLES . ' for portfolio.',
        'labels' => $labels3, // Changed to labels
        'show_in_menu' => 'story',
        'has_archive' => true,
        'supports' => ['title', 'editor', 'revisions', 'page-attributes', 'thumbnail'],

    ];
    /**/
    register_post_type($type3, $arguments3);
}
    flush_rewrite_rules();
});

//------------------------theme settings---------------------------------------------//

//-------------------------add css for admin-----------------------------------------//

add_action('admin_enqueue_scripts', 'custom_backend_scripts', 10, 1);
function custom_backend_scripts($hook)
{
    global $post, $pagenow;

    wp_register_script('bootstrap_min', get_stylesheet_directory_uri() . '/js/bootstrap.min.js', array('jquery'), false, '1.0.0');
    wp_enqueue_script('bootstrap_min');
    wp_register_script('admin-custom', get_stylesheet_directory_uri() . '/admin/js/admin-custom.js', array('jquery'), false, '1.0.0');
    wp_enqueue_script('admin-custom');
    wp_register_style('custom-page-feature-section', get_stylesheet_directory_uri() . '/css/admin_style.css', array(), '1.0');
    wp_enqueue_style('custom-page-feature-section');
}

//-------------------------add css for admin------------------------------------------//

add_action('restrict_manage_posts', 'wpse45436_admin_posts_filter_restrict_manage_posts');

function wpse45436_admin_posts_filter_restrict_manage_posts()
{
    global $card_type_array;
    $type = 'post';
    if (isset($_GET['post_type'])) {
        $type = $_GET['post_type'];
    }

    //add filter to the post type you want
    if (CUSTOM_FIELD_FILTER == $type) {
        /*$card_type_array = array(
        'label1' => 'value1', //Replace label1 with name and value1 with the value of custom field
        'label2' => 'value2', //Replace label2 with name and value2 with another value of custom field
        );*/

        ?>
        <select name="<?php echo ADMIN_FILTER_FIELD_VALUE; ?>">
<option value=""><?php _e('Filter By ', 'wose45436');?></option>
        <?php $current_v = isset($_GET[ADMIN_FILTER_FIELD_VALUE]) ? $_GET[ADMIN_FILTER_FIELD_VALUE] : '';
        foreach ($card_type_array as $label => $value) {
            printf(
                '<option value="%s"%s>%s</option>',
                $label,
                $label == $current_v ? ' selected="selected"' : '',
                $value
            );
        }
        ?>
        </select>
        <?php
}
}
/** if submitted filter by post meta */
add_filter('parse_query', 'wpse45436_posts_filter');
function wpse45436_posts_filter($query)
{
    global $pagenow;
    $type = 'post';
    if (isset($_GET['post_type'])) {
        $type = $_GET['post_type'];
    }
    if (CUSTOM_FIELD_FILTER == $type && is_admin() && $pagenow == 'edit.php' && isset($_GET[ADMIN_FILTER_FIELD_VALUE]) && $_GET[ADMIN_FILTER_FIELD_VALUE] != '') {
        $query->query_vars['meta_key'] = 'gallery_data'; //Replace META_KEY to the actual meta key
        $query->query_vars['meta_value'] = sprintf(':"%s";', $_GET[ADMIN_FILTER_FIELD_VALUE]);
        $query->query_vars['meta_compare'] = 'like';

        echo $GLOBALS['wp_query']->request;
    }

}

//-------------------------------------------------post_type list----------------------------//
add_filter('manage_' . ADD_FIELD_FOR_POST_LIST . '_posts_columns', 'set_custom_edit_book_columns');
function set_custom_edit_book_columns($columns)
{

    //unset( $columns['categories'] );
    unset($columns['author']);
    $columns['book_author'] = __('Card Type', 'your_text_domain');
    if (isset($_GET['card_type']) && $_GET['card_type'] == 'story') {
        $columns['story_pack'] = __('Story Package', 'your_text_domain');

    }
    //$columns['publisher'] = __( 'Publisher', 'your_text_domain' );

    return $columns;
}

// Add the data to the custom columns for the book post type:
add_action('manage_' . ADD_FIELD_FOR_POST_LIST . '_posts_custom_column', 'custom_book_column', 10, 2);
function custom_book_column($column, $post_id)
{
    global $card_type_array;
    switch ($column) {

        case 'publisher':
            $terms = get_the_term_list($post_id, 'book_author', '', ',', '');
            if (is_string($terms)) {
                echo $terms;
            } else {
                _e('Unable to get author(s)', 'your_text_domain');
            }

            break;

        case 'book_author':
            $gallery = get_post_meta($post_id, 'gallery_data', true);
            //var_dump($gallery);
            if (isset($gallery['card_type']) && $gallery['card_type'] != '') {

                echo '<div class="card_type_custom_field">' . $card_type_array[$gallery['card_type']] . '</div>';
            }
            break;
        case 'story_pack':
            //echo $post_id;
            $selected_term = get_the_terms($post_id, 'story_package');
            //var_dump($selected_term[0]->name);

            //var_dump($gallery);
            if (isset($selected_term[0]->name) && $selected_term[0]->name != '') {

                echo '<div class="card_type_custom_field">' . $selected_term[0]->name . '</div>';
            }
            break;

    }
}

function create_book_taxonomies()
{
    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
        'name' => _x(STORY_PACKAGES_CATEGORY, 'taxonomy general name', 'textdomain'),
        'singular_name' => _x(STORY_PACKAGES_CATEGORY, 'taxonomy singular name', 'textdomain'),
        'search_items' => __('Search ' . STORY_PACKAGES_CATEGORY, 'textdomain'),
        'all_items' => __('All ' . STORY_PACKAGES_CATEGORY, 'textdomain'),
        'parent_item' => __('Parent ' . STORY_PACKAGES_CATEGORY, 'textdomain'),
        'parent_item_colon' => __('Parent ' . STORY_PACKAGES_CATEGORY . ':', 'textdomain'),
        'edit_item' => __('Edit ' . STORY_PACKAGES_CATEGORY, 'textdomain'),
        'update_item' => __('Update ' . STORY_PACKAGES_CATEGORY, 'textdomain'),
        'add_new_item' => __('Add New ' . STORY_PACKAGES_CATEGORY, 'textdomain'),
        'new_item_name' => __('New ' . STORY_PACKAGES_CATEGORY . ' Name', 'textdomain'),
        'menu_name' => __(STORY_PACKAGES_CATEGORY, 'textdomain'),
    );

    $args = array(
        'hierarchical' => false,
        'parent_item' => null,
        'parent_item_colon' => null,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => STORY_PACKAGES_CATEGORY_TAG),
    );

    register_taxonomy(STORY_PACKAGES_CATEGORY_TAG, array(STORY_PACKAGES), $args);
}
add_action('init', 'create_book_taxonomies', 0);
/*admin settings*/

//remove content box from post type
/*add_action('init', function () {
remove_post_type_support('author', 'editor');
}, 99);*/

function fzisotope_categories_meta_box()
{
    // remove_meta_box('fzisotope_categoriesdiv', 'fzisotope_post', 'side');
    //add_meta_box('fzisotope_categoriesdiv', 'Select Category', 'fzisotope_categories_meta_box', 'fzisotope_post', 'normal', 'high');
    //categorydiv
    remove_meta_box('story_packagediv', 'post', 'side');
    remove_meta_box('solutions_librarydiv', 'post', 'side');

    //post_content_post_dinamic_content
    //print '<pre>';print_r( $wp_meta_boxes['post'] );print '<pre>';
}

//add_action('admin_init', 'fzisotope_categories_meta_box', 0);

function remove_dashboard_meta()
{
    global $wp_meta_boxes;
    var_dump($wp_meta_boxes);
    $wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now'];
}

//add_action('admin_init', 'remove_dashboard_meta');

function save_story_package($meta, $post_id)
{

    wp_set_post_terms($post_id, array($meta['my_terms']), 'category', false);
}

/** post type*/

add_filter('manage_edit-quickbyte_columns', 'my_columns');
function my_columns($columns)
{
    $columns['article_category'] = 'Category';
    return $columns;
}

add_action('manage_quickbyte_posts_custom_column', 'my_manage_article_columns', 10, 2);

function my_manage_article_columns($column, $post_id)
{
    global $post;

    switch ($column) {

        /* If displaying the 'article_category' column. */
        case 'article_category':

            /* Get the genres for the post. */
            $terms = get_the_terms($post_id, 'quick_category');

            /* If terms were found. */
            if (!empty($terms)) {

                $out = array();

                /* Loop through each term, linking to the 'edit posts' page for the specific term. */
                foreach ($terms as $term) {
                    $out[] = sprintf('<a href="%s">%s</a>',
                        esc_url(add_query_arg(array('post_type' => $post->post_type, 'article_category' => $term->slug), 'edit.php')),
                        esc_html(sanitize_term_field('name', $term->name, $term->term_id, 'article_category', 'display'))
                    );
                }

                /* Join the terms, separating them with a comma. */
                echo join(', ', $out);
            }

            /* If no terms were found, output a default message. */
            else {
                _e('No Articles');
            }

            break;

        /* Just break out of the switch statement for everything else. */
        default:
            break;
    }
}

add_filter('manage_edit-contacts_database_columns', 'my_columns_contacts_database');
function my_columns_contacts_database($columns)
{
    $columns['article_category'] = 'Category';
    $columns['article_location'] = 'Location';
    return $columns;
}

add_action('manage_contacts_database_posts_custom_column', 'my_manage_article_columns_contacts_database', 10, 2);

function my_manage_article_columns_contacts_database($column, $post_id)
{
    global $post;

    switch ($column) {

        /* If displaying the 'article_category' column. */
        case 'article_category':

            /* Get the genres for the post. */
            $terms = get_the_terms($post_id, 'solutions_library');

            /* If terms were found. */
            if (!empty($terms)) {

                $out = array();

                /* Loop through each term, linking to the 'edit posts' page for the specific term. */
                foreach ($terms as $term) {
                    $out[] = sprintf('<a href="%s">%s</a>',
                        esc_url(add_query_arg(array('post_type' => $post->post_type, 'article_category' => $term->slug), 'edit.php')),
                        esc_html(sanitize_term_field('name', $term->name, $term->term_id, 'article_category', 'display'))
                    );
                }

                /* Join the terms, separating them with a comma. */
                echo join(', ', $out);
            }

            /* If no terms were found, output a default message. */
            else {
                _e('No Category');
            }

            break;
        case 'article_location':

            /* Get the genres for the post. */
            $terms = get_the_terms($post_id, 'type');

            /* If terms were found. */
            if (!empty($terms)) {

                $out = array();

                /* Loop through each term, linking to the 'edit posts' page for the specific term. */
                foreach ($terms as $term) {
                    $out[] = sprintf('<a href="%s">%s</a>',
                        esc_url(add_query_arg(array('post_type' => $post->post_type, 'article_category' => $term->slug), 'edit.php')),
                        esc_html(sanitize_term_field('name', $term->name, $term->term_id, 'article_category', 'display'))
                    );
                }

                /* Join the terms, separating them with a comma. */
                echo join(', ', $out);
            }

            /* If no terms were found, output a default message. */
            else {
                _e('No Location');
            }

            break;
        /* Just break out of the switch statement for everything else. */
        default:
            break;
    }
}

add_filter('manage_edit-success_stories_columns', 'my_columns_success_stories');
function my_columns_success_stories($columns)
{
    $columns['article_category'] = 'Category';
    return $columns;
}

add_action('manage_success_stories_posts_custom_column', 'my_manage_article_columns_success_stories', 10, 2);

function my_manage_article_columns_success_stories($column, $post_id)
{
    global $post;

    switch ($column) {

        /* If displaying the 'article_category' column. */
        case 'article_category':

            /* Get the genres for the post. */
            $terms = get_the_terms($post_id, 'solutions_library');

            /* If terms were found. */
            if (!empty($terms)) {

                $out = array();

                /* Loop through each term, linking to the 'edit posts' page for the specific term. */
                foreach ($terms as $term) {
                    $out[] = sprintf('<a href="%s">%s</a>',
                        esc_url(add_query_arg(array('post_type' => $post->post_type, 'article_category' => $term->slug), 'edit.php')),
                        esc_html(sanitize_term_field('name', $term->name, $term->term_id, 'article_category', 'display'))
                    );
                }

                /* Join the terms, separating them with a comma. */
                echo join(', ', $out);
            }

            /* If no terms were found, output a default message. */
            else {
                _e('No Articles');
            }

            break;

        /* Just break out of the switch statement for everything else. */
        default:
            break;
    }
}

add_action( 'init', 'wpshout_add_taxonomies_to_courses' );
function wpshout_add_taxonomies_to_courses() {
	register_taxonomy_for_object_type( 'category', 'quickbyte' );
	
}




function wpse_139269_term_radio_checklist( $args ) {
    if ( ! empty( $args['taxonomy'] ) && $args['taxonomy'] === 'category' /* <== Change to your required taxonomy */ ) {
        if ( empty( $args['walker'] ) || is_a( $args['walker'], 'Walker' ) ) { // Don't override 3rd party walkers.
            if ( ! class_exists( 'WPSE_139269_Walker_Category_Radio_Checklist' ) ) {
                /**
                 * Custom walker for switching checkbox inputs to radio.
                 *
                 * @see Walker_Category_Checklist
                 */
                class WPSE_139269_Walker_Category_Radio_Checklist extends Walker_Category_Checklist {
                    function walk( $elements, $max_depth, $args = array() ) {
                        $output = parent::walk( $elements, $max_depth, $args );
                        $output = str_replace(
                            array( 'type="checkbox"', "type='checkbox'" ),
                            array( 'type="radio"', "type='radio'" ),
                            $output
                        );

                        return $output;
                    }
                }
            }

            $args['walker'] = new WPSE_139269_Walker_Category_Radio_Checklist;
        }
    }

    return $args;
}

add_filter( 'wp_terms_checklist_args', 'wpse_139269_term_radio_checklist' );