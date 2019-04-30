<?php
define('TOP_STORIES','top-stories');
//ini_set('display_errors', 1);
define('META', 'meta');
define('CHECK_BOX_DEFAULT_VALUE', 1);

require_once('admin_functions.php');
require_once('custom_field.php');
require_once('front-function.php');
require_once('shortcode-function.php');
require_once('shortcode_placement.php');
require get_stylesheet_directory() . '/inc/tabs-widget_top_stories.php';
require get_stylesheet_directory() . '/inc/template-functions.php';
require get_stylesheet_directory() . '/inc/tabs-widget_details.php';
require get_stylesheet_directory() . '/inc/tabs-widget_featured_video.php';
require get_stylesheet_directory() . '/inc/tabs-widget_story_package.php';
require get_stylesheet_directory() . '/inc/tabs-widget_dynamic_post.php';
require get_stylesheet_directory() . '/inc/tabs-widget_quickbytes.php';
require get_stylesheet_directory() . '/inc/category_image.php';
require get_stylesheet_directory() . '/inc/solutions_library_custom_field_for_category.php';
require get_stylesheet_directory() . '/inc/solutions_library_image.php';
require get_stylesheet_directory() . '/inc/template-tags.php';
require get_stylesheet_directory() . '/inc/front-page-elements.php';

require get_stylesheet_directory() . '/inc/tabs-widget_placement.php';
require get_stylesheet_directory() . '/inc/tabs-widget_placement_responsive.php';


//require_once('add-front-css.php');
//require_once('blade.php');
add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');
function my_theme_enqueue_styles()
{
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('custom-style', get_stylesheet_directory_uri() . '/css/custom_style.css');
    wp_enqueue_style('font-style', '//fonts.googleapis.com/css?family=Cabin');

    wp_enqueue_style('font_awasome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
    


    wp_enqueue_style('font-style1', '//fonts.googleapis.com/css?family=Playfair+Display');
    wp_enqueue_style('font-style2', '//fonts.googleapis.com/css?family=Roboto');
    wp_enqueue_style('font-style3', '//fonts.googleapis.com/css?family=Crete+Round');
    wp_enqueue_style('font-style4', '//fonts.googleapis.com/css?family=Fjalla+One');

    wp_enqueue_script('jquery_slider', get_stylesheet_directory_uri() . '/js/slider.js', array('jquery'), 1.1, true);
    wp_enqueue_script('jquery_validator', get_stylesheet_directory_uri() . '/js/validator.min.js', array('jquery'), 1.1, true);
     wp_enqueue_script('jquery_validate', get_stylesheet_directory_uri() . '/js/jquery.validate.min.js', array('jquery'), 1.1, true);
     wp_enqueue_script('touchFlow', get_stylesheet_directory_uri() . '/js/jquery.touchFlow.js', array('jquery'), 1.1, true); 
     

    //<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    
    wp_enqueue_style('slider-style', get_stylesheet_directory_uri() . '/css/slider.css');
    //wp_enqueue_style('slider-font-awesome', get_stylesheet_directory_uri() . '/css/font-awesome.min.css');
    wp_enqueue_style('slider-font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css');
    
    if(get_post_type()=='quickbyte'){
        wp_enqueue_script('owl-quick-bytes', get_stylesheet_directory_uri() . '/js/owl.quickbytes.js');
    }
    

}
function total_post_count(){
 global $wp_query;

return $wp_query->post_count;
}
function solution_drop_down($selected=''){
    $post_list = new WP_Query(array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'meta_query' => array(
            array(
                'key' => 'gallery_data',
                'value' => sprintf(':"%s";', 'solarticle'),
                'compare' => 'like',
            ),
        ),
        'posts_per_page' => -1,
    ));
    $select_box = '';
    if($post_list->have_posts()){
        $select_box .= '<select name="gallery[solution_post]" id="solution_post"><option value="0">Select Solution</option>';
        while ($post_list->have_posts()) :
            $post_list->the_post();
            $sid = get_the_ID();
            $selected_b = '';
            if($selected == $sid){$selected_b = 'selected';}
            $select_box .= '<option value="'.$sid.'" '.$selected_b.'>'.get_the_title().'</option>';
       
        endwhile;
        $select_box .= '</select>';
    }
    return $select_box ;
}
add_action('wp_head', 'add_conditional_css');
function add_conditional_css()
{
    if (is_page('home')) {
        ?>
        <style>
        .header-height {
            height: 100vh !important;
        }       
        .dinamic_background_image {
            height: 100vh !important;
            background-size: cover !important;
        }
        .header-overlay {
            height: 100vh;
            background: rgba(0,0,0,0.65);
        }
        </style>
        <?php

    } else {
        ?>

        <?php

    }
    ?>
    <script>
    var ajax_url = '<?php echo admin_url('admin-ajax.php'); ?>';
    </script>
    <?php

}
add_action('admin_head', 'admin_add_conditional_css');
function admin_add_conditional_css()
{
    ?>
    <script>
    var ajax_url = '<?php echo admin_url('admin-ajax.php'); ?>';
    </script>
    <?php

}
//add_action('admin_menu', 'add_custom_link_into_appearnace_menu');
function add_custom_link_into_appearnace_menu()
{
    global $submenu;
    $permalink = 'http://www.cusomtlink.com';
    var_dump($submenu);
    $submenu['admin.php'][] = array('Custom Link', 'manage_options', $permalink);
}
/*
function post_type($name,$selected=''){
    
    $args = array(
       'public'   => true,
       '_builtin' => true,
    );

    $output = 'names'; // names or objects, note names is the default
    $operator = 'and'; // 'and' or 'or'

    $post_types = get_post_types( $args, $output, $operator ); 
    $args2 = array(
       'public'   => true,
       '_builtin' => false,
    );

    $post_types2 = get_post_types( $args2, $output, $operator ); 
    $all_post_type = array_merge($post_types,$post_types2);
    ?>
    <select name="<?php echo $name;?>" id="<?php echo $name;?>">
    <?php
    foreach( $all_post_type as $post_type ) { ?>
        <option value="<?php echo $post_type; ?>" <?php echo ($post_type==$selected?'selected':'')?> ><?php echo $post_type; ?></option>
    <?php } ?>
    </select>
<?php
}


function story_packages_front_design($param,$subcount=0){
    global $wpdb, $post;
    
    //$post_id = $param['{ID}'];
    $cat_id = $param->term_id;


        $meta_key = '_custom_post_type_onomies_relationship';
        $object_ids = $post_id ;
        $meta_value = get_post_meta( $post_id, $meta_key ) ;

        $cpt_taxonomies ='stories';
        $query = $wpdb->prepare( "SELECT meta_value 
                    FROM {$wpdb->postmeta} wpmeta 
                    INNER JOIN {$wpdb->posts} wpposts ON
                        wpposts.ID = wpmeta.meta_value AND
                        wpposts.post_type IN ('" .  $cpt_taxonomies . "') AND
                        wpposts.post_status = 'publish'
                    WHERE wpmeta.post_id IN (" .  $object_ids  . ') AND wpmeta.meta_key = %s', CPT_ONOMIES_POSTMETA_KEY );
                    
        $cpt_ids = $wpdb->get_col( $query );
        //var_dump($cpt_ids);

        $category = get_the_terms( $post_id ,'subject');

        //var_dump($category);
        $thumb = get_the_post_thumbnail( $post_id, 'thumbnail', array( 'class' => 'alignleft' ) );
        ob_start();

        ?>
            <div class="row">
                     <div id="tab-recent" class="tab-pane" role="tabpanel" aria-labelledby="recent-tab">
                        <?php if ( $thumb ){ ?>

                            <div class="post-content" itemprop="mainContentOfPage">

                                <div class="thumbnail-post">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail( 'tabs-img', array( 'itemprop' => 'image' ) ); ?>
                                    <div class="mask"><div class="icon"></div></div>
                                    </a>
                                    <?php
                                    if(isset($category[0]->name)){                                    
                                    ?>
                                    <div class="col-5 category_display"><?php echo $category[0]->name?></div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        <?php }else{?>

                            <div class="post-content" itemprop="mainContentOfPage">

                                <div class="thumbnail-post">
                                    <a href="<?php the_permalink(); ?>">
                                    <img class="d-block w-100" src="<?php echo get_stylesheet_directory_uri()?>/assets/images/no-thumbnail-post.jpg" alt="" itemprop="image">
                                    <div class="mask"><div class="icon"></div></div>
                                    </a>
                                    <?php
                                    if(isset($category[0]->name)){                                    
                                    ?>
                                    <div class="col-5 category_display"><?php echo $category[0]->name?></div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php } ?>
                            
                        <div class="post-holder title_with_author">
                            <a href="<?php the_permalink(); ?>"><?php echo $param['{TITLE}'];; ?></a>
                            <div class="meta author_and_time">
                                <div class="author">
                                <?php //echo get_author_name(); ?>
                                </div>
                                <div class="time">
                                <?php 
                                    //echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago';
                                ?>
                                </div>
                            </div>
                        </div>
                     </div>
                     <div class="row col-12 text-right slide_box">
                         <div class="col-12 text-right p-3 slide_box_selector_<?php echo $post_id;?>" >
                         
                         <?php
                         $total_stories = count($cpt_ids);
                        if($total_stories>0){ 
                                echo '<a href="javascript:void(0);" class="slide_down">';
                             echo $total_stories;
                             ?>
                             Stories
                             <?php
                             echo '</a>';
                        }else{
                           echo $total_stories;
                             ?>
                             Stories
                             <?php 
                        }
                         ?>

                         </div>

                     </div>
            </div>
            <?php
            if($total_stories>0){ ?>
                <div class="row" id="slide_box_selector_<?php echo $post_id;?>">
                <?php
                $show_related_post = $cpt_ids;
                if($subcount!=0){
                   $show_related_post = array_slice($cpt_ids, 0, $subcount);
                }
                    $args = array(
                        'post_type' => 'stories',
                        'post__in' => $show_related_post
                    );
                    
                    $posts = get_posts($args);

                    foreach ($posts as $p) :
                       // var_dump($p);
                        ?>
                        <div class="col-3 block"><div class="date_circle"><p><?php echo date('M j', strtotime($p->post_date)); ;?></p>
                        </div>
                        <span class="year_story"><?php echo date('Y', strtotime($p->post_date)); ;?></span></div>
                        <div class="col-9">
                            <div class="story_title"><?php echo $p->post_title?></div>
                            <div class="story_author"> by <span class="author_style"><?php echo the_author_meta( 'user_login' , $p->post_author );?></span></div>
                        </div>
                    <?php
                        //post!
                    endforeach;
                ?>
                </div>
        <?php
            }


    $my_full_html = ob_get_clean();

    //var_dump($show_related_post);
    return $my_full_html;


}

function meta_query_param($post_type,$meta_key,$meta_value)
{
     $events_query = new WP_Query( 
        array('post_type' => array($post_type), 'meta_query' => array( array( 'key' => $meta_key, 'value' => $meta_value ) )) 
        );

        while ( $events_query->have_posts() ) :
            $events_query->the_post();
            echo get_the_title() . '<br/>';
        endwhile;
}
function get_category_from_post_id($post_id){
    $post_categories = wp_get_post_categories( $post_id );
    $cats = array();
        
    foreach($post_categories as $c){
        $cat = get_category( $c );
        $cats[] = array( 'name' => $cat->name, 'slug' => $cat->slug );
    }
    return $cats;
}
 */
function post_type($name, $selected = '')
{

    $args = array(
        'public' => true,
        '_builtin' => true,
    );

    $output = 'names'; // names or objects, note names is the default
    $operator = 'and'; // 'and' or 'or'

    $post_types = get_post_types($args, $output, $operator);
    $args2 = array(
        'public' => true,
        '_builtin' => false,
    );

    $post_types2 = get_post_types($args2, $output, $operator);
    $all_post_type = array_merge($post_types, $post_types2);
    ?>
    <select name="<?php echo $name; ?>" id="<?php echo $name; ?>">
    <?php
    foreach ($all_post_type as $post_type) { ?>
        <option value="<?php echo $post_type; ?>" <?php echo ($post_type == $selected ? 'selected' : '') ?> ><?php echo $post_type; ?></option>
    <?php 
} ?>
    </select>
<?php

}


/*function front_rpp_form_script($hook_suffix) { 
        
            wp_enqueue_script( 'owl-slick',  get_stylesheet_directory_uri() . '/js/owl.carousel.js', array ( 'jquery' ), 1.1, true);
            wp_enqueue_style( 'owl-style-name',  get_stylesheet_directory_uri() . '/js/owl.carousel.css' );
            wp_enqueue_style( 'owl-style-owl-theme',  get_stylesheet_directory_uri() . '/js/owl.theme.css' );
            
}*/



function meta_query_param($post_type, $meta_key, $meta_value)
{
    $events_query = new WP_Query(
        array('post_type' => array($post_type), 'meta_query' => array(array('key' => $meta_key, 'value' => $meta_value)))
    );

    while ($events_query->have_posts()) :
        $events_query->the_post();
    echo get_the_title() . '<br/>';
    endwhile;
}
function get_category_from_post_id($post_id)
{
    $post_categories = wp_get_post_categories($post_id);
    $cats = array();

    foreach ($post_categories as $c) {
        $cat = get_category($c);
        $cats[] = array('name' => $cat->name, 'slug' => $cat->slug);
    }
    return $cats;
}

function front_rpp_form_script($hook_suffix)
{

    wp_enqueue_script('owl-slick', get_stylesheet_directory_uri() . '/js/owl.carousel.js', array('jquery'), 1.1, true);
    wp_enqueue_style('owl-style-name', get_stylesheet_directory_uri() . '/js/owl.carousel.css');
    wp_enqueue_style('owl-style-owl-theme', get_stylesheet_directory_uri() . '/js/owl.theme.css');

}
add_action('wp_enqueue_scripts', 'front_rpp_form_script');
function youtube_link_to_embeded_code($code)
{
    $return = preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i", "<iframe width=\"420\" height=\"315\" src=\"//www.youtube.com/embed/$1\" frameborder=\"0\" allowfullscreen></iframe>", $code);
    return $return;
}








//------------------------theme settings---------------------------------------------//

$themename = "Setting";
$shortname = "mob";
$options = array(

    // array(
    //     "name" => "Home Page Settings",
    //     "type" => "title"
    // ),

    array(
        "type" => "close"
     ),

    // array(
    //     "name" => "Theme Color",
    //     "desc" => "Choose the base color for your mobile theme!",
    //     "id" => $shortname . "_color",
    //     "std" => "C00000",
    //     "type" => "colorjs"
    // ),

    // array(
    //     "name" => "Theme Width",
    //     "desc" => "Choose a width for the theme. Enter 100% for full width or define the width in pixels like 320px",
    //     "id" => $shortname . "_width",
    //     "std" => "360px",
    //     "type" => "text"
    // ),

    array(
        "type" => "close"
    )
);

add_action('admin_menu', 'mytheme_add_admin');
function mytheme_add_admin()
{

    global $themename, $shortname, $options;

    if (isset($_GET['page']) && $_GET['page'] == basename(__FILE__)) {

        if ('save' == $_REQUEST['action']) {

            foreach ($options as $value) {
                update_option($value['id'], $_REQUEST[$value['id']]);
            }

            foreach ($options as $value) {
                if (isset($_REQUEST[$value['id']])) {
                    update_option($value['id'], $_REQUEST[$value['id']]);
                } else {
                    delete_option($value['id']);
                }
            }
            $gallery_data = array();
            if (isset($_REQUEST['gallery']) && $_REQUEST['gallery']) {
                    // Build array for saving post meta

                for ($i = 0; $i < count($_REQUEST['gallery']['title_name']); $i++) {
                    if ('' != $_REQUEST['gallery']['title_name'][$i]) {
                        $gallery_data['title_name'][] = $_REQUEST['gallery']['title_name'][$i];
                        $gallery_data['title_link'][] = $_REQUEST['gallery']['title_link'][$i];
                    }
                }

            }
            if (isset($_REQUEST['gallery']['home_page_description']) && $_REQUEST['gallery']['home_page_description'] != '') {
                $gallery_data['home_page_description'] = $_REQUEST['gallery']['home_page_description'];
            }
            if (isset($_REQUEST['gallery']['home_page_background_image']) && $_REQUEST['gallery']['home_page_background_image'] != '') {
                $gallery_data['home_page_background_image'] = $_REQUEST['gallery']['home_page_background_image'];
            }
            if (isset($_REQUEST['gallery']['home_page_content_image']) && $_REQUEST['gallery']['home_page_content_image'] != '') {
                $gallery_data['home_page_content_image'] = $_REQUEST['gallery']['home_page_content_image'];
            }
            

            if (isset($_REQUEST['gallery']['tbi_corner_background_image']) && $_REQUEST['gallery']['tbi_corner_background_image'] != '') {
                $gallery_data['tbi_corner_background_image'] = $_REQUEST['gallery']['tbi_corner_background_image'];
            }
            if (isset($_REQUEST['gallery']['tbi_corner_description']) && $_REQUEST['gallery']['tbi_corner_description'] != '') {
                $gallery_data['tbi_corner_description'] = $_REQUEST['gallery']['tbi_corner_description'];
            }
            if (isset($_REQUEST['gallery']['tbi_corner_title']) && $_REQUEST['gallery']['tbi_corner_title'] != '') {
                $gallery_data['tbi_corner_title'] = $_REQUEST['gallery']['tbi_corner_title'];
            }
            if (isset($_REQUEST['gallery']['tbi_facebook']) && $_REQUEST['gallery']['tbi_facebook'] != '') {
                $gallery_data['tbi_facebook'] = $_REQUEST['gallery']['tbi_facebook'];
            }
            if (isset($_REQUEST['gallery']['tbi_twitter']) && $_REQUEST['gallery']['tbi_twitter'] != '') {
                $gallery_data['tbi_twitter'] = $_REQUEST['gallery']['tbi_twitter'];
            }


            $gallery_data = json_encode($gallery_data);
            if ($gallery_data) {
                update_option('evolve_child_theme_settings', $gallery_data);
            }

            header("location: themes.php?page=functions.php&saved=true");
           // die;

        } else if ('reset' == $_REQUEST['action']) {

            foreach ($options as $value) {
                delete_option($value['id']);
            }

            header("Location: themes.php?page=functions.php&reset=true");
            die;

        }
    }

    add_theme_page($themename, "" . $themename, 'edit_themes', basename(__FILE__), 'mytheme_admin');

}
function mytheme_admin()
{

    global $themename, $shortname, $options;

    if ($_REQUEST['saved']) echo '<div id="message" class="updated fade"><p><strong>' . $themename . ' settings saved.</strong></p></div>';
    if ($_REQUEST['reset']) echo '<div id="message" class="updated fade"><p><strong>' . $themename . ' settings reset.</strong></p></div>';

    ?>
    <div class="wrap" style="margin:0 auto; padding:20px 0px 0px;">

    <form method="post" >


    <?php 
    global $redux_demo;

    echo ' ' . $redux_demo['css-editor'];


        foreach ($options as $value) {
            switch ($value['type']) {

                case "open":
                    ?>
        <div style="width:808px; background:#eee; border:1px solid #ddd; padding:20px; overflow:hidden; display: block; margin: 0px 0px 30px;">

        <?php break;

        case "close":
            ?>

            </div>

            <?php break;

        case "misc":
            ?>
            <div style="width:808px; background:#fffde2; border:1px solid #ddd; padding:20px; overflow:hidden; display: block; margin: 0px 0px 30px;">
                <?php echo $value['name']; ?>
            </div>
            <?php break;

        case "title":
            ?>

            <div style="width:810px; height:50px; background:#555; padding:9px 20px; overflow:hidden; margin:0px; font-family:Verdana, sans-serif; font-size:18px; font-weight:normal; color:#EEE;">
                <?php echo $value['name']; ?>
            </div>

            <?php break;

        case 'text':
            ?>

            <div style="width:808px; padding:0px 0px 10px; margin:0px 0px 10px; border-bottom:1px solid #ddd; overflow:hidden;">
                <span style="font-family:Arial, sans-serif; font-size:16px; font-weight:bold; color:#444; display:block; padding:5px 0px;">
                    <?php echo $value['name']; ?>
                </span>
                <?php if ($value['image'] != "") { ?>
                    <div style="width:808px; padding:10px 0px; overflow:hidden;">
                        <img style="padding:5px; background:#FFF; border:1px solid #ddd;" src="<?php bloginfo('template_url'); ?>/images/<?php echo $value['image']; ?>" alt="image" />
                    </div>
                <?php 
            } ?>
                <input style="width:200px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if (get_settings($value['id']) != "") {
                                                                                                                                                                echo stripslashes(get_settings($value['id']));
                                                                                                                                                            } else {
                                                                                                                                                                echo stripslashes($value['std']);
                                                                                                                                                            } ?>" />
                <br/>
                <span style="font-family:Arial, sans-serif; font-size:11px; font-weight:bold; color:#444; display:block; padding:5px 0px;">
                    <?php echo $value['desc']; ?>
                </span>
            </div>

            <?php break;

        case 'colorjs':
            ?>

            <div style="width:808px; padding:0px 0px 10px; margin:0px 0px 10px; border-bottom:1px solid #ddd; overflow:hidden;">
                <span style="font-family:Arial, sans-serif; font-size:16px; font-weight:bold; color:#444; display:block; padding:5px 0px;"><?php echo $value['name']; ?></span>

                <input style="width:200px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if (get_settings($value['id']) != "") {
                                                                                                                                                                echo stripslashes(get_settings($value['id']));
                                                                                                                                                            } else {
                                                                                                                                                                echo stripslashes($value['std']);
                                                                                                                                                            } ?>" class="color" />
                <br/>
                
                <span style="font-family:Arial, sans-serif; font-size:11px; font-weight:bold; color:#444; display:block; padding:5px 0px;">
                    <?php echo $value['desc']; ?>
                </span>
            </div>

            <?php
            break;

        case 'textarea':
            ?>

            <div style="width:808px; padding:0px 0px 10px; margin:0px 0px 10px; border-bottom:1px solid #ddd; overflow:hidden;">
                <span style="font-family:Arial, sans-serif; font-size:16px; font-weight:bold; color:#444; display:block; padding:5px 0px;">
                    <?php echo $value['name']; ?>
                </span>
                <?php if ($value['image'] != "") { ?>
                    <div style="width:808px; padding:10px 0px; overflow:hidden;">
                        <img style="padding:5px; background:#FFF; border:1px solid #ddd;" src="<?php bloginfo('template_url'); ?>/images/<?php echo $value['image']; ?>" alt="image" />
                    </div>
                <?php 
            } ?>
                <textarea name="<?php echo $value['id']; ?>" style="width:400px; height:200px;" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if (get_settings($value['id']) != "") {
                                                                                                                                                        echo stripslashes(get_settings($value['id']));
                                                                                                                                                    } else {
                                                                                                                                                        echo stripslashes($value['std']);
                                                                                                                                                    } ?></textarea>
                <br/>
                <span style="font-family:Arial, sans-serif; font-size:11px; font-weight:bold; color:#444; display:block; padding:5px 0px;">
                    <?php echo $value['desc']; ?>
                </span>
            </div>

            <?php
            break;
            /*Ralph Damiano*/
        case 'select':
            ?>

            <div style="width:808px; padding:0px 0px 10px; margin:0px 0px 10px; border-bottom:1px solid #ddd; overflow:hidden;">
                <span style="font-family:Arial, sans-serif; font-size:16px; font-weight:bold; color:#444; display:block; padding:5px 0px;">
                    <?php echo $value['name']; ?>
                </span>
                <?php if ($value['image'] != "") { ?>
                    <div style="width:808px; padding:10px 0px; overflow:hidden;">
                        <img style="padding:5px; background:#FFF; border:1px solid #ddd;" src="<?php bloginfo('template_url'); ?>/images/<?php echo $value['image']; ?>" alt="image" />
                    </div>
                <?php 
            } ?>
                <select style="width:240px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"><?php foreach ($value['options'] as $option) { ?><option<?php if (get_settings($value['id']) == $option) {
                                                                                                                                                                            echo ' selected="selected"';
                                                                                                                                                                        } elseif ($option == $value['std']) {
                                                                                                                                                                            echo ' selected="selected"';
                                                                                                                                                                        } ?>><?php echo $option; ?></option><?php 
                                                                                                                                                                                                        } ?></select>
                <br/>
                <span style="font-family:Arial, sans-serif; font-size:11px; font-weight:bold; color:#444; display:block; padding:5px 0px;">
                    <?php echo $value['desc']; ?>
                </span>
            </div>

            <?php
            break;

        case "checkbox":
            ?>

            <div style="width:808px; padding:0px 0px 10px; margin:0px 0px 10px; border-bottom:1px solid #ddd; overflow:hidden;">
                <span style="font-family:Arial, sans-serif; font-size:16px; font-weight:bold; color:#444; display:block; padding:5px 0px;">
                    <?php echo $value['name']; ?>
                </span>
                <?php if ($value['image'] != "") { ?>
                    <div style="width:808px; padding:10px 0px; overflow:hidden;">
                        <img style="padding:5px; background:#FFF; border:1px solid #ddd;" src="<?php bloginfo('template_url'); ?>/images/<?php echo $value['image']; ?>" alt="image" />
                    </div>
                <?php 
            } ?>
                <?php if (get_option($value['id'])) {
                    $checked = "checked=\"checked\"";
                } else {
                    $checked = "";
                } ?>
                <input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
                <br/>
                <span style="font-family:Arial, sans-serif; font-size:11px; font-weight:bold; color:#444; display:block; padding:5px 0px;">
                    <?php echo $value['desc']; ?>
                </span>
            </div>


            <?php
            break;

        case "submit":
            ?>

            <p class="submit">
            <input name="save" type="submit" value="Save changes" />
            <input type="hidden" name="action" value="save" />
            </p>

            <?php break;
        }
    }
    ?>
    <!--  add dinamic -->
    <?php
    $full_settings = get_option('evolve_child_theme_settings');
    $full_settings = json_decode($full_settings);
  // var_dump($full_settings);
    ?>
    <div style="width:808px; background:#eee; border:1px solid #ddd; padding:20px; overflow:hidden; display: block; margin: 0px 0px 30px;">
        
            <div class="row head_border"><h5>Home Page Custom Menu :</h5></div>
                <div class="row">
                            <?php
                            
                            //var_dump($full_settings);
                            if (isset($full_settings->title_name)) {
                                for ($i = 0; $i < count($full_settings->title_name); $i++) {
                                    ?>
                                <div style="width:100%;" id="">
                                        <div class="field_row">
                                                <div class="field_left">
                                                    <div class="form_field">
                                                        <label class="title_lable">Title :</label>
                                                        <input class="title_setting" value="<?php echo (isset($full_settings->title_name[$i]) ? $full_settings->title_name[$i] : ''); ?>" type="text" name="gallery[title_name][]" />
                                                    </div>
                                                    <div class="form_field">
                                                        <label  class="title_lable">Title Link :</label>
                                                        <input class="title_setting" value="<?php echo (isset($full_settings->title_link[$i]) ? $full_settings->title_link[$i] : ''); ?>" type="text" name="gallery[title_link][]" />
                                                    </div>
                                                </div>


                                                <div class="field_right remove_button_class" id="remove_button_class_display" style="" > 
                                                    
                                                    <input class="button" type="button" value="Remove" onclick="remove_field(this)" /> 
                                                </div>


                                            <div class="clear"></div>
                                        </div>
                                </div>
                            <?php

                        }
                    }
                    ?>
                    <div style="width:100%;" id="master-row">
                            <div class="field_row">
                                <div class="field_left">
                                    <div class="form_field">
                                        <label class="title_lable">Title :</label>
                                        <input class="title_setting" value="" type="text" name="gallery[title_name][]" />
                                    </div>
                                    <div class="form_field">
                                        <label  class="title_lable">Title Link :</label>
                                        <input class="title_setting" value="" type="text" name="gallery[title_link][]" />
                                    </div>
                                </div>


                                <div class="field_right remove_button_class" id="remove_button" style="" > 
                                    
                                    <input class="button" type="button" value="Remove" onclick="remove_field(this)" /> 
                                </div>


                                <div class="clear"></div>
                            </div>
                    </div>
                    <div id="field_wrap"></div>                       
                    <div id="add_field_row" class="row" style="width:100%;padding-left:20px;">
                        <input class="button" type="button" value="Add Field" onclick="add_field_row(this);" />
                    </div>
                </div>
                <div class="row head_border"><h5>Home Page Background Image :</h5></div>
                <div class="row">
                    <div style="display:" id="">
                        <div class="field_row">
                                <div class="field_left">
                                    <div class="form_field">
                                        <label class="title_lable">Content :</label>
                                        <textarea class="title_setting" name="gallery[home_page_description]" id="home_page_description" cols="30" rows="10"><?php echo (isset($full_settings->home_page_description) ? $full_settings->home_page_description : ''); ?></textarea>
                                    </div>
                                    <div class="image">
                                        <div class="form_field">
                                            <label class="title_lable">Background Image :</label>
                                            <input class="meta_image_url title_setting" value="<?php echo (isset($full_settings->home_page_background_image) ? $full_settings->home_page_background_image : ''); ?>" type="text" name="gallery[home_page_background_image]" />                                                                                
                                        </div> 
                                        <div class="field_right image_wrap field_right_image">
                                            <?php if (isset($full_settings->home_page_background_image)) { ?>
                                                <img src="<?php echo (isset($full_settings->home_page_background_image) ? $full_settings->home_page_background_image : ''); ?>" height="48" width="48">
                                            <?php 
                                        } ?>
                                        </div> 
                                        <div class="field_right field_right_button"> 
                                            <input type="button" class="button" value="Choose File" onclick="add_image(this)" />
                                            <!-- <br />
                                            <input class="button" type="button" value="Remove" onclick="remove_field(this)" />  -->
                                        </div>
                                    </div>
                                </div>
                                

                               
                                <div class="field_left">
                                    <div class="image">
                                        <div class="form_field">
                                            <label class="title_lable">Content Image :</label>
                                            <input class="meta_image_url title_setting" value="<?php echo (isset($full_settings->home_page_content_image) ? $full_settings->home_page_content_image : ''); ?>" type="text" name="gallery[home_page_content_image]" />                                                                                
                                        </div>   

                                        <div class="field_right image_wrap field_right_image">
                                            <?php if (isset($full_settings->home_page_content_image)) { ?>
                                                <img src="<?php echo (isset($full_settings->home_page_content_image) ? $full_settings->home_page_content_image : ''); ?>" height="48" width="48">
                                            <?php 
                                        } ?>
                                        </div> 
                                        <div class="field_right field_right_button"> 
                                            <input type="button" class="button" value="Choose File" onclick="add_content_image(this)" />
                                            <!-- <br />
                                            <input class="button" type="button" value="Remove" onclick="remove_field(this)" />  -->
                                        </div>
                                    </div>
                                </div>
                                <div class="clear"></div>
                        </div>
                    </div>         
                </div>
            </div> 


             <?php
            tbi_corner_setting_page($full_settings);
            facebook_link_setting_page($full_settings);
            ?>                           
            <!--  add dinamic -->
                <p class="submit">
                    <input name="save" type="submit" value="Save changes" />
                    <input type="hidden" name="action" value="save" />
                </p>
        </form>
            <form method="post">
                <p class="submit">
            
                <input type="hidden" name="action" value="reset" />
                </p>
            </form>
            <style type="text/css">
                    .field_left {
                    float:left;
                    }

                    .field_right {
                    float:left;
                    margin-left:10px;
                    }

                    .clear {
                    clear:both;
                    }

                    #dynamic_form {
                    width:100%;
                    }

                    #dynamic_form input[type=text] {
                    width:300px;
                    }

                    #dynamic_form .field_row {
                    /*border:1px solid #999;*/
                    margin-bottom:10px;
                    padding:10px;
                    }

                    #dynamic_form label {
                    padding:0 6px;
                    }
            </style>

        <script type="text/javascript">
            function add_image(obj) {
                var parent=jQuery(obj).parent().parent('div.image');
                

                tb_show('', 'media-upload.php?TB_iframe=true');
                var inputField = jQuery(parent).find("input.meta_image_url");
                window.send_to_editor = function(html) {
                    console.log(html);
                    var url = jQuery(html).attr('src');
                    console.log(url);

                    inputField.val(url);
                    jQuery(parent)
                    .find("div.image_wrap")
                    .html('<img src="'+url+'" height="48" width="48" />');

                    // inputField.closest('p').prev('.awdMetaImage').html('<img height=120 width=120 src="'+url+'"/><p>URL: '+ url + '</p>'); 

                    tb_remove();
                };

                return false;  
            }
            function add_content_image(obj) {
                var parent=jQuery(obj).parent().parent('div.image');
                var inputField = jQuery(parent).find("input.meta_image_url");

                tb_show('', 'media-upload.php?TB_iframe=true');

                window.send_to_editor = function(html) {
                    console.log(html);
                    var url = jQuery(html).attr('src');
                    console.log(url);

                    inputField.val(url);
                    jQuery(parent)
                    .find("div.image_wrap")
                    .html('<img src="'+url+'" height="48" width="48" />');

                    // inputField.closest('p').prev('.awdMetaImage').html('<img height=120 width=120 src="'+url+'"/><p>URL: '+ url + '</p>'); 

                    tb_remove();
                };

                return false;  
            }
            function remove_field(obj) {
                var parent=jQuery(obj).parent().parent();
                //console.log(parent)
                parent.remove();
            }

            function add_field_row(cc) {
                var row = jQuery('#master-row').html();
                row = row.replace('remove_button_class', 'remove_button_class_display');
                jQuery(row).appendTo('#field_wrap');
                //console.log(jQuery(cc).find('#remove_button').css('display'));
                //jQuery(cc).parent().find('#master-row').find('#remove_button').css('display','block');
                //console.log(cc);
                //cc++;
            }
        </script>
    <?php

}
function tbi_corner_setting_page($full_settings)
{

    ?>
            <div style="width:808px; background:#eee; border:1px solid #ddd; padding:20px; overflow:hidden; display: block; margin: 0px 0px 30px;">
           
                
                <div class="row head_border">
                    <h5>TBI Corner Settings :</h5>
                </div>
                <div class="row">
                    <div style="display:">
                        <div class="field_row">
                                <div class="field_left">
                                    <div class="form_field">
                                        <label class="title_lable">Title :</label>
                                        
                                        <input class="title_setting" value="<?php echo (isset($full_settings->tbi_corner_title) ? $full_settings->tbi_corner_title : ''); ?>" type="text" name="gallery[tbi_corner_title]" />
                                    </div>
                                    <div class="form_field">
                                        <label class="title_lable">Content :</label>
                                        <textarea class="title_setting" name="gallery[tbi_corner_description]" id="tbi_corner_description" cols="30" rows="10"><?php echo stripslashes((isset($full_settings->tbi_corner_description) ? $full_settings->tbi_corner_description : '')); ?></textarea>
                                    </div>
                                    <div class="form_field">
                                        <label class="title_lable">Background Image :</label>
                                        <input class="meta_image_url title_setting" value="<?php echo (isset($full_settings->tbi_corner_background_image) ? $full_settings->tbi_corner_background_image : ''); ?>" type="text" name="gallery[tbi_corner_background_image]" />                                                                                
                                    </div>                                        
                                </div>
                                    <div class="field_right image_wrap field_right_image">
                                        <?php if (isset($full_settings->tbi_corner_background_image)) { ?>
                                            <img src="<?php echo (isset($full_settings->tbi_corner_background_image) ? $full_settings->tbi_corner_background_image : ''); ?>" height="48" width="48">
                                        <?php 
                                        } ?>
                                    </div> 
                                <div class="field_right field_right_button"> 
                                    <input type="button" class="button" value="Choose File" onclick="add_image(this)" />
                                    <!-- <br />
                                    <input class="button" type="button" value="Remove" onclick="remove_field(this)" />  -->
                                </div>
                                <div class="clear"></div>
                        </div>
                    </div>         
                </div>
            </div> 
     
<?php

}

function facebook_link_setting_page($full_settings)
{
    
    ?>
            <div style="width:808px; background:#eee; border:1px solid #ddd; padding:20px; overflow:hidden; display: block; margin: 0px 0px 30px;">
                <div class="row head_border">
                    <h5>Share Link Settings :</h5>
                </div>
                <div class="row">
                    <div style="display:" >
                        <div class="field_row">
                                <div class="field_left">
                                    <div class="form_field">
                                        <label class="title_lable"> Facebook Link :</label>
                                        
                                        <input class="title_setting" value="<?php echo (isset($full_settings->tbi_facebook) ? $full_settings->tbi_facebook : ''); ?>" type="text" name="gallery[tbi_facebook]" />
                                    </div>
                                    <div class="form_field">
                                        <label class="title_lable"> Twitter Link :</label>
                                        
                                        <input class="title_setting" value="<?php echo (isset($full_settings->tbi_twitter) ? $full_settings->tbi_twitter : ''); ?>" type="text" name="gallery[tbi_twitter]" />
                                    </div>
                                
                                                                           
                                </div>
                                
                                <div class="clear"></div>
                        </div>
                    </div>         
                </div>
            </div> 
<?php

}

//------------------------theme settings---------------------------------------------//
//----------------------related post------------------------//
add_shortcode('manual_related_posts_new', 'bawmrp_the_content_new');
add_shortcode('manual_related_posts_new2', 'bawmrp_the_content_new2');

add_shortcode('bawmrp_new', 'bawmrp_the_content_new');
remove_filter('the_content', 'bawmrp_the_content', 8);
add_action('add_slider_on_load','bawmrp_the_content_new2');
//add_filter('the_content', 'bawmrp_the_content_new', 9);
function bawmrp_the_content_new2($content = '')
{

    $a = shortcode_atts( array(
		'enable' => 'false',
		'bar' => 'something else',
    ), $content );
    
    global $post, $in_bawmrp_loop;
    wp_enqueue_script('owl-style-owlstart3', get_stylesheet_directory_uri() . '/js/owl.start4.js');
    $bawmrp_options = get_option('bawmrp');
    if (!$post || (isset($bawmrp_options['in_content']) && $bawmrp_options['in_content'] != 'on') && $content != '' || apply_filters('stop_bawmrp', false)) {
        return $content;
    }
   // var_dump($a['enable'] );
//echo 'if out';
    if ((is_home() && $bawmrp_options['in_homepage'] == 'on' && in_the_loop()) ||
        is_singular($bawmrp_options['post_types'])||$a['enable']==true) {
//echo 'if';
        $ids_manual = wp_parse_id_list(bawmrp_get_related_posts($post->ID));
        $lang = isset($_GET['lang']) ? $_GET['lang'] : get_locale();
        $transient_name = apply_filters('bawmrp_transient_name', 'bawmrp_' . $post->ID . '_' . substr(md5(serialize($ids_manual) . serialize($bawmrp_options) . get_permalink($post->ID) . $lang), 0, 12));
        // var_dump('sssdd');
        // if ( $contents = get_transient( $transient_name ) ) {
        //     var_dump('sssdd');
        //     extract( $contents );
        //     if ( ! empty( $list ) && is_array( $list ) && isset( $bawmrp_options['random_posts'] ) ) {
        //         shuffle( $list );
        //     }
        //     $final = $content . $head . @implode( "\n", $list ) . $foot;
        //     $content = apply_filters( 'bawmrp_posts_content', $final, $content, $head, $list, $foot );
        //     return $content;
        // }
        // var_dump('sssdd');
        $ids_auto = isset($bawmrp_options['auto_posts']) && 'none' != $bawmrp_options['auto_posts'] ? bawmrp_get_related_posts_auto($post) : array();
        $ids = wp_parse_id_list(array_merge($ids_manual, $ids_auto));
        if (defined('ICL_LANGUAGE_CODE')) {
            $head_title = isset($bawmrp_options['head_titles'][$post->post_type][bawmrp_wpml_lang_by_code(ICL_LANGUAGE_CODE)]) && is_string($bawmrp_options['head_titles'][$post->post_type][bawmrp_wpml_lang_by_code(ICL_LANGUAGE_CODE)]) ? $bawmrp_options['head_titles'][$post->post_type][bawmrp_wpml_lang_by_code(ICL_LANGUAGE_CODE)] : $head_title;
        } elseif (isset($bawmrp_options['head_titles'][$post->post_type][get_locale()]) && is_string($bawmrp_options['head_titles'][$post->post_type][get_locale()])) {
            $head_title = $bawmrp_options['head_titles'][$post->post_type][get_locale()];
        } else {
            $head_title = isset($bawmrp_options['head_titles'][$post->post_type]) && is_string($bawmrp_options['head_titles'][$post->post_type]) ? $bawmrp_options['head_titles'][$post->post_type] : $head_title;
        }

        if (!empty($ids) && is_array($ids) && isset($ids[0]) && $ids[0] != 0) {
            $ids = wp_parse_id_list($ids);
            $list = array();
            if (isset($bawmrp_options['random_posts'])) {
                shuffle($ids);
            }
            if ((int) $bawmrp_options['max_posts'] > 0 && count($ids) > (int) $bawmrp_options['max_posts']) {
                $ids = array_slice($ids, 0, (int) $bawmrp_options['max_posts']);
            }

            $head = '<div class="bawmrp main desktop_position_change"><h3>' . $head_title . '</h3>';
            $head .= '<div class="border_line"></div>';
            do_action('bawmrp_first_li');
            $style = apply_filters('bawmrp_li_style', 'float:left;width:120px;height:auto;overflow:hidden;list-style:none;border-right: 1px solid #ccc;text-align:center;padding:0px 5px;');
            $n = 0;
            $in_bawmrp_loop = true;
            //
            $list[] = '<div id="" class="nav_h_responsive_type_y  nav_v_type"><ul>';
            foreach ($ids as $id) {
                if (in_array($id, $ids_manual)) {
                    $class = 'bawmrp_manual';
                } elseif (in_array($id, get_option('sticky_posts'))) {
                    $class = 'bawmrp_sticky';
                } elseif (in_array($id, $ids_auto)) {
                    $class = 'bawmrp_auto';
                }

                $_content = '';
                if (isset($bawmrp_options['display_content'])) {
                    $p = get_post($id);
                    $_content = '<br />' . apply_filters('the_excerpt', $p->post_excerpt) . '<p>&nbsp;</p>';
                }
                $_content = apply_filters('bawmrp_the_content', $_content, $id);
                $_content = apply_filters('bawmrp_more_content', $_content);
                if ($bawmrp_options['in_content_mode'] == 'list') {
                    $list[] = '<li class="' . $class . '">' .
                    '<a href="' . esc_url(apply_filters('the_permalink', get_permalink($id))) . '">' .
                    get_the_title($id) .
                        '</a>' .
                        $_content .
                        '</li>';
                } else {
                    $no_thumb = apply_filters('bawmrp_no_thumb', admin_url('/images/w-logo-blue.png'), $id);
                    $thumb_size = apply_filters('bawmrp_thumb_size', array(100, 100));
                    if (current_theme_supports('post-thumbnails')) {
                        $thumb = has_post_thumbnail($id) ? get_the_post_thumbnail($id, $thumb_size) : '<img alt="" src="' . baw_first_image(isset($bawmrp_options['first_image']) && $bawmrp_options['first_image'] == 'on' ? $id : null, $no_thumb) . '" height="' . $thumb_size[0] . '" width="' . $thumb_size[1] . '" />';
                    } else {
                        $thumb = '<img src="' . baw_first_image(isset($bawmrp_options['first_image']) && $bawmrp_options['first_image'] == 'on' ? $id : null, $no_thumb) . '" height="' . $thumb_size[0] . '" width="' . $thumb_size[1] . '" />';
                    }
                    //$list[] = '<li style="' . esc_attr( $style ) . '" class="' . $class . '"><a href="' . esc_url( apply_filters( 'the_permalink', get_permalink( $id ) ) ) . '">' . $thumb . '<br />' . get_the_title( $id ) . '</a></li>';
                    $list[] = '<li class="item selected_product related_post1" rel="' . $id . ' " ><div class="div_for_slider_content">' . $thumb . '<div class="div_for_slider_title"><a href="' . esc_url(apply_filters('the_permalink', get_permalink($id))) . '">' . get_the_title($id) . '</a></div><div class="div_for_slider_date">' . get_the_date('d M Y') . '</div></div></li>';

                }
                $list = apply_filters('bawmrp_li', $list, ++$n);
            }
            do_action('bawmrp_last_li');
            $list[] = '</ul></div>';
            $list = apply_filters('bawmrp_list_li', $list);
            if ($bawmrp_options['in_content_mode'] == 'list') {
                $foot = '</ul></div>';
            } else {
                $foot = '</div><div style="clear:both;"></div>';
            }
            $final = $content . $head . implode("\n", $list) . $foot;
            $content = apply_filters('bawmrp_posts_content', $final, $content, $head, $list, $foot);
        } else {
            $head = ''; //<div class="bawmrp"><h3>' . esc_html( $head_title ) . '</h3>';
            $list = ''; //<ul><li>' . __( 'No posts found.' ) . '</li></ul>';
            $foot = ''; //</div>';
            $final = $content . $head . $list . $foot;
            $content = apply_filters('bawmrp_posts_content', $final, $content, $head, $list, $foot);
        }
    }
    if (!empty($list)) {
        set_transient($transient_name, array('head' => $head, 'list' => $list, 'foot' => $foot));
    }
    $in_bawmrp_loop = false;
    return $content;
}

function bawmrp_the_content_new($content = '')
{

    global $post, $in_bawmrp_loop;
    wp_enqueue_script('owl-style-owlstart3', get_stylesheet_directory_uri() . '/js/owl.start3.js');
    $bawmrp_options = get_option('bawmrp');
    if (!$post || (isset($bawmrp_options['in_content']) && $bawmrp_options['in_content'] != 'on') && $content != '' || apply_filters('stop_bawmrp', false)) {
        return $content;
    }
    if ((is_home() && $bawmrp_options['in_homepage'] == 'on' && in_the_loop()) ||
        is_singular($bawmrp_options['post_types'])) {
        $ids_manual = wp_parse_id_list(bawmrp_get_related_posts($post->ID));
        $lang = isset($_GET['lang']) ? $_GET['lang'] : get_locale();
        $transient_name = apply_filters('bawmrp_transient_name', 'bawmrp_' . $post->ID . '_' . substr(md5(serialize($ids_manual) . serialize($bawmrp_options) . get_permalink($post->ID) . $lang), 0, 12));
        $ids_auto = isset($bawmrp_options['auto_posts']) && 'none' != $bawmrp_options['auto_posts'] ? bawmrp_get_related_posts_auto($post) : array();
        $ids = wp_parse_id_list(array_merge($ids_manual, $ids_auto));
        if (defined('ICL_LANGUAGE_CODE')) {
            $head_title = isset($bawmrp_options['head_titles'][$post->post_type][bawmrp_wpml_lang_by_code(ICL_LANGUAGE_CODE)]) && is_string($bawmrp_options['head_titles'][$post->post_type][bawmrp_wpml_lang_by_code(ICL_LANGUAGE_CODE)]) ? $bawmrp_options['head_titles'][$post->post_type][bawmrp_wpml_lang_by_code(ICL_LANGUAGE_CODE)] : $head_title;
        } elseif (isset($bawmrp_options['head_titles'][$post->post_type][get_locale()]) && is_string($bawmrp_options['head_titles'][$post->post_type][get_locale()])) {
            $head_title = $bawmrp_options['head_titles'][$post->post_type][get_locale()];
        } else {
            $head_title = isset($bawmrp_options['head_titles'][$post->post_type]) && is_string($bawmrp_options['head_titles'][$post->post_type]) ? $bawmrp_options['head_titles'][$post->post_type] : $head_title;
        }
        if (!empty($ids) && is_array($ids) && isset($ids[0]) && $ids[0] != 0) {
            $ids = wp_parse_id_list($ids);
            $list = array();
            if (isset($bawmrp_options['random_posts'])) {
                shuffle($ids);
            }
            if ((int)$bawmrp_options['max_posts'] > 0 && count($ids) > (int)$bawmrp_options['max_posts']) {
                $ids = array_slice($ids, 0, (int)$bawmrp_options['max_posts']);
            }
            $head = '<div class="bawmrp main desktop_position_change show_for_mobile"><h3>' . $head_title . '</h3>';
            $head .= '<div class="border_line"></div>';
            do_action('bawmrp_first_li');
            $style = apply_filters('bawmrp_li_style', 'float:left;width:120px;height:auto;overflow:hidden;list-style:none;border-right: 1px solid #ccc;text-align:center;padding:0px 5px;');
            $n = 0;
            $in_bawmrp_loop = true;
            //nav_v_type
            $list[] = '<div id="" class="nav_h_responsive_type  "><ul>';
            foreach ($ids as $id) {
                if (in_array($id, $ids_manual)) {
                    $class = 'bawmrp_manual';
                } elseif (in_array($id, get_option('sticky_posts'))) {
                    $class = 'bawmrp_sticky';
                } elseif (in_array($id, $ids_auto)) {
                    $class = 'bawmrp_auto';
                }

                $_content = '';
                if (isset($bawmrp_options['display_content'])) {
                    $p = get_post($id);
                    $_content = '<br />' . apply_filters('the_excerpt', $p->post_excerpt) . '<p>&nbsp;</p>';
                }
                $_content = apply_filters('bawmrp_the_content', $_content, $id);
                $_content = apply_filters('bawmrp_more_content', $_content);
                if ($bawmrp_options['in_content_mode'] == 'list') {
                    $list[] = '<li class="' . $class . '">' .
                        '<a href="' . esc_url(apply_filters('the_permalink', get_permalink($id))) . '">' .
                        get_the_title($id) .
                        '</a>' .
                        $_content .
                        '</li>';
                } else {
                    $no_thumb = apply_filters('bawmrp_no_thumb', admin_url('/images/w-logo-blue.png'), $id);
                    $thumb_size = apply_filters('bawmrp_thumb_size', array(100, 100));
                    if (current_theme_supports('post-thumbnails')) {
                        $thumb = has_post_thumbnail($id) ? get_the_post_thumbnail($id, $thumb_size) : '<img alt="" src="' . baw_first_image(isset($bawmrp_options['first_image']) && $bawmrp_options['first_image'] == 'on' ? $id : null, $no_thumb) . '" height="' . $thumb_size[0] . '" width="' . $thumb_size[1] . '" />';
                    } else {
                        $thumb = '<img src="' . baw_first_image(isset($bawmrp_options['first_image']) && $bawmrp_options['first_image'] == 'on' ? $id : null, $no_thumb) . '" height="' . $thumb_size[0] . '" width="' . $thumb_size[1] . '" />';
                    }
                    //$list[] = '<li style="' . esc_attr( $style ) . '" class="' . $class . '"><a href="' . esc_url( apply_filters( 'the_permalink', get_permalink( $id ) ) ) . '">' . $thumb . '<br />' . get_the_title( $id ) . '</a></li>';
                    $list[] = '<li class="item selected_product related_post1" rel="' . $id . ' " ><div class="div_for_slider_content">' . $thumb . '<div class="div_for_slider_title"><a href="' . esc_url(apply_filters('the_permalink', get_permalink($id))) . '">' . get_the_title($id) . '</a></div><div class="div_for_slider_date">'.get_the_date('d M Y').'</div></div></li>';

                }
                $list = apply_filters('bawmrp_li', $list, ++$n);
            }
            do_action('bawmrp_last_li');
            $list[] = '</ul></div>';
            $list = apply_filters('bawmrp_list_li', $list);
            if ($bawmrp_options['in_content_mode'] == 'list') {
                $foot = '</ul></div>';
            } else {
                $foot = '</div><div style="clear:both;"></div>';
            }
            $final = $content . $head . implode("\n", $list) . $foot;
            $content = apply_filters('bawmrp_posts_content', $final, $content, $head, $list, $foot);
        } else {
            $head = '';//<div class="bawmrp"><h3>' . esc_html( $head_title ) . '</h3>';
            $list = '';//<ul><li>' . __( 'No posts found.' ) . '</li></ul>';
            $foot = '';//</div>';
            $final = $content . $head . $list . $foot;
            $content = apply_filters('bawmrp_posts_content', $final, $content, $head, $list, $foot);
        }
    }
    if (!empty($list)) {
        set_transient($transient_name, array('head' => $head, 'list' => $list, 'foot' => $foot));
    }
    $in_bawmrp_loop = false;
    return $content;
}

function bawmrp_the_content_new_in_ajax2($content = '')
{

    global $post, $in_bawmrp_loop;

    wp_enqueue_script('owl-style-owlstart3', get_stylesheet_directory_uri() . '/js/owl.start4.js');

    $bawmrp_options = get_option('bawmrp');
    //var_dump($bawmrp_options);
    if (!$post || (isset($bawmrp_options['in_content']) && $bawmrp_options['in_content'] != 'on') && $content != '' || apply_filters('stop_bawmrp', false)) {
        return $content;
    }
    $ids_manual = wp_parse_id_list(bawmrp_get_related_posts_new($post->ID));
    $lang = isset($_GET['lang']) ? $_GET['lang'] : get_locale();
    $transient_name = apply_filters('bawmrp_transient_name', 'bawmrp_' . $post->ID . '_' . substr(md5(serialize($ids_manual) . serialize($bawmrp_options) . get_permalink($post->ID) . $lang), 0, 12));
    $ids_auto = isset($bawmrp_options['auto_posts']) && 'none' != $bawmrp_options['auto_posts'] ? bawmrp_get_related_posts_auto($post) : array();
    $ids = wp_parse_id_list(array_merge($ids_manual, $ids_auto));
    if (defined('ICL_LANGUAGE_CODE')) {
        $head_title = isset($bawmrp_options['head_titles'][$post->post_type][bawmrp_wpml_lang_by_code(ICL_LANGUAGE_CODE)]) && is_string($bawmrp_options['head_titles'][$post->post_type][bawmrp_wpml_lang_by_code(ICL_LANGUAGE_CODE)]) ? $bawmrp_options['head_titles'][$post->post_type][bawmrp_wpml_lang_by_code(ICL_LANGUAGE_CODE)] : $head_title;
    } elseif (isset($bawmrp_options['head_titles'][$post->post_type][get_locale()]) && is_string($bawmrp_options['head_titles'][$post->post_type][get_locale()])) {
        $head_title = $bawmrp_options['head_titles'][$post->post_type][get_locale()];
    } else {
        $head_title = isset($bawmrp_options['head_titles'][$post->post_type]) && is_string($bawmrp_options['head_titles'][$post->post_type]) ? $bawmrp_options['head_titles'][$post->post_type] : $head_title;
    }

    if (!empty($ids) && is_array($ids) && isset($ids[0]) && $ids[0] != 0) {
       
        $ids = wp_parse_id_list($ids);
        $list = array();
        if (isset($bawmrp_options['random_posts'])) {
            shuffle($ids);
        }
        if ((int)$bawmrp_options['max_posts'] > 0 && count($ids) > (int)$bawmrp_options['max_posts']) {
            $ids = array_slice($ids, 0, (int)$bawmrp_options['max_posts']);
        }

        $head = '<div class="bawmrp border_check_later desktop_position_change"><h3>' . $head_title . '</h3>';
        $head .= '<div class="border_line"></div>';
        do_action('bawmrp_first_li');
        $style = apply_filters('bawmrp_li_style', 'float:left;width:120px;height:auto;overflow:hidden;list-style:none;border-right: 1px solid #ccc;text-align:center;padding:0px 5px;');
        $n = 0;
        $in_bawmrp_loop = true;
        $list[] = '<div id="" class="nav_h_responsive_type_y"><ul>';
        foreach ($ids as $id) {
            if (in_array($id, $ids_manual)) {
                $class = 'bawmrp_manual';
            } elseif (in_array($id, get_option('sticky_posts'))) {
                $class = 'bawmrp_sticky';
            } elseif (in_array($id, $ids_auto)) {
                $class = 'bawmrp_auto';
            }

            $_content = '';
            if (isset($bawmrp_options['display_content'])) {
                $p = get_post($id);
                $_content = '<br />' . apply_filters('the_excerpt', $p->post_excerpt) . '<p>&nbsp;</p>';
            }
            $_content = apply_filters('bawmrp_the_content', $_content, $id);
            $_content = apply_filters('bawmrp_more_content', $_content);
            if ($bawmrp_options['in_content_mode'] == 'list') {
                $list[] = '<li class="' . $class . '">' .
                    '<a href="' . esc_url(apply_filters('the_permalink', get_permalink($id))) . '">' .
                    get_the_title($id) .
                    '</a>' .
                    $_content .
                    '</li>';
            } else {
                $no_thumb = apply_filters('bawmrp_no_thumb', admin_url('/images/w-logo-blue.png'), $id);
                $thumb_size = apply_filters('bawmrp_thumb_size', array(100, 100));
                if (current_theme_supports('post-thumbnails')) {
                    $thumb = has_post_thumbnail($id) ? get_the_post_thumbnail($id, $thumb_size) : '<img alt="" src="' . baw_first_image(isset($bawmrp_options['first_image']) && $bawmrp_options['first_image'] == 'on' ? $id : null, $no_thumb) . '" height="' . $thumb_size[0] . '" width="' . $thumb_size[1] . '" />';
                } else {
                    $thumb = '<img src="' . baw_first_image(isset($bawmrp_options['first_image']) && $bawmrp_options['first_image'] == 'on' ? $id : null, $no_thumb) . '" height="' . $thumb_size[0] . '" width="' . $thumb_size[1] . '" />';
                }
                    //$list[] = '<li style="' . esc_attr( $style ) . '" class="' . $class . '"><a href="' . esc_url( apply_filters( 'the_permalink', get_permalink( $id ) ) ) . '">' . $thumb . '<br />' . get_the_title( $id ) . '</a></li>';
                $list[] = '<li class="item selected_product related_post2" rel="' . $id . ' " ><div class="div_for_slider_content">' . $thumb . '<div class="div_for_slider_title"><a href="' . esc_url(apply_filters('the_permalink', get_permalink($id))) . '">' . get_the_title($id) . '</a></div><div class="div_for_slider_date">'.get_the_date('d M Y').'</div></div></li>';

            }
            $list = apply_filters('bawmrp_li', $list, ++$n);
        }
        do_action('bawmrp_last_li');
        $list[] = '</ul></div>';
        $list = apply_filters('bawmrp_list_li', $list);
        if ($bawmrp_options['in_content_mode'] == 'list') {
            $foot = '</ul></div>';
        } else {
            $foot = '</div><div style="clear:both;"></div>';
        }
        $final = $content . $head . implode("\n", $list) . $foot;
        $content = apply_filters('bawmrp_posts_content', $final, $content, $head, $list, $foot);
    } else {

        $head = '';//<div class="bawmrp"><h3>' . esc_html( $head_title ) . '</h3>';
        $list = '';//<ul><li>' . __( 'No posts found.' ) . '</li></ul>';
        $foot = '';//</div>';
        $final = $content . $head . $list . $foot;
        $content = apply_filters('bawmrp_posts_content', $final, $content, $head, $list, $foot);
    }
    //}

    if (!empty($list)) {
        set_transient($transient_name, array('head' => $head, 'list' => $list, 'foot' => $foot));
    }
    $in_bawmrp_loop = false;
    return $content;
}

function bawmrp_the_content_new_in_ajax($content = '')
{

    global $post, $in_bawmrp_loop;

    wp_enqueue_script('owl-style-owlstart3', get_stylesheet_directory_uri() . '/js/owl.start3.js');

    $bawmrp_options = get_option('bawmrp');
    //var_dump($bawmrp_options);
    if (!$post || (isset($bawmrp_options['in_content']) && $bawmrp_options['in_content'] != 'on') && $content != '' || apply_filters('stop_bawmrp', false)) {
        return $content;
    }
    //echo 'post';
    //var_dump(is_home());
    //var_dump($bawmrp_options['in_homepage']);
    //var_dump(in_the_loop());
    //( is_home() && $bawmrp_options['in_homepage']=='on' && in_the_loop() ) || is_singular( $bawmrp_options['post_types'] ) 
    //echo $post->ID;
	//if ( ( is_home() && $bawmrp_options['in_homepage']=='on' && in_the_loop() ) || is_singular( $bawmrp_options['post_types'] ) ) {

    $ids_manual = wp_parse_id_list(bawmrp_get_related_posts_new($post->ID));
    $lang = isset($_GET['lang']) ? $_GET['lang'] : get_locale();
    $transient_name = apply_filters('bawmrp_transient_name', 'bawmrp_' . $post->ID . '_' . substr(md5(serialize($ids_manual) . serialize($bawmrp_options) . get_permalink($post->ID) . $lang), 0, 12));
        // var_dump('sssdd');
        // if ( $contents = get_transient( $transient_name ) ) {
        //     var_dump('sssdd');
		// 	extract( $contents );
		// 	if ( ! empty( $list ) && is_array( $list ) && isset( $bawmrp_options['random_posts'] ) ) {
		// 		shuffle( $list );
		// 	}
		// 	$final = $content . $head . @implode( "\n", $list ) . $foot;
		// 	$content = apply_filters( 'bawmrp_posts_content', $final, $content, $head, $list, $foot );
		// 	return $content;
        // }
        // var_dump('sssdd');
    $ids_auto = isset($bawmrp_options['auto_posts']) && 'none' != $bawmrp_options['auto_posts'] ? bawmrp_get_related_posts_auto($post) : array();
    $ids = wp_parse_id_list(array_merge($ids_manual, $ids_auto));
    if (defined('ICL_LANGUAGE_CODE')) {
        $head_title = isset($bawmrp_options['head_titles'][$post->post_type][bawmrp_wpml_lang_by_code(ICL_LANGUAGE_CODE)]) && is_string($bawmrp_options['head_titles'][$post->post_type][bawmrp_wpml_lang_by_code(ICL_LANGUAGE_CODE)]) ? $bawmrp_options['head_titles'][$post->post_type][bawmrp_wpml_lang_by_code(ICL_LANGUAGE_CODE)] : $head_title;
    } elseif (isset($bawmrp_options['head_titles'][$post->post_type][get_locale()]) && is_string($bawmrp_options['head_titles'][$post->post_type][get_locale()])) {
        $head_title = $bawmrp_options['head_titles'][$post->post_type][get_locale()];
    } else {
        $head_title = isset($bawmrp_options['head_titles'][$post->post_type]) && is_string($bawmrp_options['head_titles'][$post->post_type]) ? $bawmrp_options['head_titles'][$post->post_type] : $head_title;
    }

    if (!empty($ids) && is_array($ids) && isset($ids[0]) && $ids[0] != 0) {
       
        $ids = wp_parse_id_list($ids);
        $list = array();
        if (isset($bawmrp_options['random_posts'])) {
            shuffle($ids);
        }
        if ((int)$bawmrp_options['max_posts'] > 0 && count($ids) > (int)$bawmrp_options['max_posts']) {
            $ids = array_slice($ids, 0, (int)$bawmrp_options['max_posts']);
        }

        $head = '<div class="bawmrp border_check_later desktop_position_change"><h3>' . $head_title . '</h3>';
        $head .= '<div class="border_line"></div>';
        do_action('bawmrp_first_li');
        $style = apply_filters('bawmrp_li_style', 'float:left;width:120px;height:auto;overflow:hidden;list-style:none;border-right: 1px solid #ccc;text-align:center;padding:0px 5px;');
        $n = 0;
        $in_bawmrp_loop = true;
        $list[] = '<div id="" class="nav_h_responsive_type"><ul>';
        foreach ($ids as $id) {
            if (in_array($id, $ids_manual)) {
                $class = 'bawmrp_manual';
            } elseif (in_array($id, get_option('sticky_posts'))) {
                $class = 'bawmrp_sticky';
            } elseif (in_array($id, $ids_auto)) {
                $class = 'bawmrp_auto';
            }

            $_content = '';
            if (isset($bawmrp_options['display_content'])) {
                $p = get_post($id);
                $_content = '<br />' . apply_filters('the_excerpt', $p->post_excerpt) . '<p>&nbsp;</p>';
            }
            $_content = apply_filters('bawmrp_the_content', $_content, $id);
            $_content = apply_filters('bawmrp_more_content', $_content);
            if ($bawmrp_options['in_content_mode'] == 'list') {
                $list[] = '<li class="' . $class . '">' .
                    '<a href="' . esc_url(apply_filters('the_permalink', get_permalink($id))) . '">' .
                    get_the_title($id) .
                    '</a>' .
                    $_content .
                    '</li>';
            } else {
                $no_thumb = apply_filters('bawmrp_no_thumb', admin_url('/images/w-logo-blue.png'), $id);
                $thumb_size = apply_filters('bawmrp_thumb_size', array(100, 100));
                if (current_theme_supports('post-thumbnails')) {
                    $thumb = has_post_thumbnail($id) ? get_the_post_thumbnail($id, $thumb_size) : '<img alt="" src="' . baw_first_image(isset($bawmrp_options['first_image']) && $bawmrp_options['first_image'] == 'on' ? $id : null, $no_thumb) . '" height="' . $thumb_size[0] . '" width="' . $thumb_size[1] . '" />';
                } else {
                    $thumb = '<img src="' . baw_first_image(isset($bawmrp_options['first_image']) && $bawmrp_options['first_image'] == 'on' ? $id : null, $no_thumb) . '" height="' . $thumb_size[0] . '" width="' . $thumb_size[1] . '" />';
                }
                    //$list[] = '<li style="' . esc_attr( $style ) . '" class="' . $class . '"><a href="' . esc_url( apply_filters( 'the_permalink', get_permalink( $id ) ) ) . '">' . $thumb . '<br />' . get_the_title( $id ) . '</a></li>';
                $list[] = '<li class="item selected_product related_post2" rel="' . $id . ' " ><div class="div_for_slider_content">' . $thumb . '<div class="div_for_slider_title"><a href="' . esc_url(apply_filters('the_permalink', get_permalink($id))) . '">' . get_the_title($id) . '</a></div><div class="div_for_slider_date">'.get_the_date('d M Y').'</div></div></li>';

            }
            $list = apply_filters('bawmrp_li', $list, ++$n);
        }
        do_action('bawmrp_last_li');
        $list[] = '</ul></div>';
        $list = apply_filters('bawmrp_list_li', $list);
        if ($bawmrp_options['in_content_mode'] == 'list') {
            $foot = '</ul></div>';
        } else {
            $foot = '</div><div style="clear:both;"></div>';
        }
        $final = $content . $head . implode("\n", $list) . $foot;
        $content = apply_filters('bawmrp_posts_content', $final, $content, $head, $list, $foot);
    } else {

        $head = '';//<div class="bawmrp"><h3>' . esc_html( $head_title ) . '</h3>';
        $list = '';//<ul><li>' . __( 'No posts found.' ) . '</li></ul>';
        $foot = '';//</div>';
        $final = $content . $head . $list . $foot;
        $content = apply_filters('bawmrp_posts_content', $final, $content, $head, $list, $foot);
    }
    //}

    if (!empty($list)) {
        set_transient($transient_name, array('head' => $head, 'list' => $list, 'foot' => $foot));
    }
    $in_bawmrp_loop = false;
    return $content;
}

function bawmrp_get_related_posts_new($post_id, $only_published = true)
{
    global $wpdb;
    $bawmrp_options = get_option('bawmrp');
    $ids = get_post_meta($post_id, '_yyarpp', true);
    if ($only_published) {
        $ids = !empty($ids) ? implode(',', wp_parse_id_list(wp_list_pluck(get_posts(array('include' => $ids, 'post_type' => $bawmrp_options['post_types'])), 'ID'))) : array();
    } else {
        $ids = !empty($ids) ? implode(',', wp_parse_id_list($ids)) : array();
    }
	/*
	$ids_bonus = $wpdb->get_row( "SELECT group_concat(post_id) as ids FROM $wpdb->postmeta WHERE post_id != {$post_id} AND meta_key='_yyarpp' AND concat(',',meta_value,',') LIKE '%,{$post_id},%'" );
	if ( ! is_admin() && reset( $ids_bonus ) ) {
		if ( ! is_array( $ids ) ) {
			$ids .= ',' . reset( $ids_bonus );
		}else{
			$ids[] = reset( $ids_bonus );
		}
	}
     */
    return $ids;
}
function wpdocs_five_posts_on_homepage($query)
{
    global $wp_query;
   
    //echo $_REQUEST[META];
    if (isset($_REQUEST[META]) && $_REQUEST[META] == TOP_STORIES && $query->is_main_query()) {

        // $query->set( 'post_type', 'post' );
        // $query->set( 'posts_per_page', 5 );
        // $query->set( 'meta_query', array(
        //         array(
        //             'key' => 'gallery_data',
        //             'value' => 'spotlights',
        //             'compare' => 'like'
        //         )
        // ));
        // return $query;

        // $query->set('meta_query', array(
        //     array(
        //         'key' => 'gallery_data',
        //         'value' => 'top-stories',
        //         'compare' => 'like'
        //     )
        // ));
        $query->set('tax_query', array(
            array(
                'taxonomy' => 'placement',
                'terms' => TOP_STORIES,
                'field' => 'slug',
                 'include_children' => true,
                  'operator' => 'IN'
            )
        ));
          

    }
}

add_action('pre_get_posts', 'wpdocs_five_posts_on_homepage');
//var_dump(get_category_by_post());
function get_category_by_post($meta_value = 'spotlights')
{

    $category = [];
    $wpb_all_query = new WP_Query(array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'meta_query' => array(
            array(
                'key' => 'gallery_data',
                'value' => $meta_value,
                'compare' => 'like'
            )
        ),
        'posts_per_page' => -1
    ));

    if ($wpb_all_query->have_posts()) :

        while ($wpb_all_query->have_posts()) : $wpb_all_query->the_post();
    
           
        //$category_obj = get_the_category();
        //var_dump($category_obj);
       // $slug = $category_obj[0]->slug;
        //echo $slug;
       // $category[$slug] = $category_obj->name;
        //echo get_the_ID() ;
    $terms = get_the_terms(get_the_ID(), 'category');
    foreach ($terms as $term) {
            //var_dump($term);
        $category[$term->term_id] = $term->name;
          // echo $term->nam.'---';
    }



    endwhile;

    endif;
    return $category;
    // $terms = get_the_terms( $post->ID , 'myposttype_category' );
    // foreach ( $terms as $term ) {
    //   echo $term->name;
    // }
}


function home_page_top_banner_section()
{
    $full_settings = get_option('evolve_child_theme_settings');
    $full_settings = json_decode($full_settings);
            //var_dump($full_settings);
    $menu = '';
    if (isset($full_settings->title_name)) {
        for ($i = 0; $i < count($full_settings->title_name); $i++) {
            $menu .= '<div class="menu_inner_div"><a href="' . (isset($full_settings->title_link[$i]) ? $full_settings->title_link[$i] : '#') . '">' . $full_settings->title_name[$i] . '</a></div>';
        }
    }
    ?>
    <style>
    .dinamic_background_image{
        background-image:url('<?php echo (isset($full_settings->home_page_background_image) ? $full_settings->home_page_background_image : '') ?>');
        background-repeat: no-repeat;
        background-position: center;
        background-size: contain;
    }
    </style>
     <div class="row ">
    <div class="col">
      <div class="jumbotron" style="background-color:transparent;">
        
        <p class="lead head_top_content"><?php echo (isset($full_settings->home_page_description) ? $full_settings->home_page_description : '') ?></p>
        <div class="col header_menu_area"><?php echo $menu; ?></div>

        
      </div>
    </div>
  </div>
    <?php

}
add_shortcode('Home_Page_Header_Content', 'home_page_top_banner_section');
function tbi_corner_top_banner_section()
{
    $full_settings = get_option('evolve_child_theme_settings');
    $full_settings = json_decode($full_settings);
            //var_dump($full_settings);
    $menu = '';
    ?>
    <style>
    .dinamic_background_image{
        background-image:url('<?php echo (isset($full_settings->tbi_corner_background_image) ? $full_settings->tbi_corner_background_image : '') ?>');
        background-repeat: no-repeat;
        background-position: center;
        background-size: contain;
    }
    </style>
     <div class="row ">
    <div class="col">
      <div class="jumbotron" style="background-color:transparent;">
      <div class="col header_title_area"><?php echo (isset($full_settings->tbi_corner_title) ? $full_settings->tbi_corner_title : ''); ?></div>
        <p class="lead head_top_content"><?php echo stripslashes((isset($full_settings->tbi_corner_description) ? $full_settings->tbi_corner_description : '')) ?></p>
        <div class="col header_menu_area"><?php echo $menu; ?></div>
      </div>
    </div>
  </div>
    <?php
}
add_shortcode('TBI_Corner', 'tbi_corner_top_banner_section');

/*shortcode helper*/
/*
add_action('init', 'my_recent_posts_button');
function my_recent_posts_button() {

    if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
       return;
    }
 
    if ( get_user_option('rich_editing') == 'true' ) {
       add_filter( 'mce_external_plugins', 'register_button_js' );
       add_filter( 'mce_buttons', 'register_button' );
    }
 
 }
 function register_button($buttons) {
    //Add the button ID to the $button array
$buttons[] = "recentposts";
return $buttons;
}

 function register_button_js( $plugin_array ) {
    $plugin_array['recentposts'] = get_stylesheet_directory_uri() . '/admin/js/shortcode_helper.js';
    return $plugin_array;
 }


 add_action ( 'after_wp_tiny_mce', 'mytheme_tinymce_extra_vars' );
 
if ( !function_exists( 'mytheme_tinymce_extra_vars' ) ) {
	function mytheme_tinymce_extra_vars() { ?>
		<script type="text/javascript">
			var tinyMCE_object = <?php echo json_encode(
				array(
					'button_name' => esc_html__('My button name', 'mythemeslug'),
					'button_title' => esc_html__('The title of the pop up box', 'mythemeslug'),
					'image_title' => esc_html__('Image', 'mythemeslug'),
					'image_button_title' => esc_html__('Upload image', 'mythemeslug'),
				)
				);
			?>;
		</script><?php
	}
}*/
add_action('init', 'remove_comment_support');

function remove_comment_support()
{
    global $ajax_load_more;
    remove_action('wp_enqueue_scripts', array($ajax_load_more, 'alm_enqueue_scripts'));

    remove_action('evolve_after_post_content', 'evolve_comments_template', 0);
    remove_action('add_meta_boxes', 'myplugin_add_meta_box');
    remove_action('admin_menu', 'h5ap_custom_submenu_page');
}

add_action('wp_enqueue_scripts', 'wp_ajax_load_more_alm_enqueue_scripts');
function wp_ajax_load_more_alm_enqueue_scripts()
{
    $options = get_option('alm_settings');


   		/*
     *	alm_js_dependencies
     *
     * ALM Core Filter
     *
     * @return Boolean
     */
    $dependencies = apply_filters('alm_js_dependencies', array('jquery'));


   		// Core ALM JS   		
    $suffix = (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) ? '' : '.min'; // Use minified libraries if SCRIPT_DEBUG is turned off
        // echo plugin_dir_url('ajax-load-more/core/dist/js/');
        // die();
        
        
           //wp_register_script( 'ajax-load-more', get_site_url().'/wp-content/plugins/ajax-load-more/core/dist/js/ajax-load-more'. $suffix .'.js', $dependencies,  ALM_VERSION, true );
    wp_register_script('ajax-load-more', get_site_url() . '/wp-content/themes/tootle-child/alm_templates/js/ajax-load-more.js', $dependencies, ALM_VERSION, true);

   		// Progress Bar JS
    wp_register_script('ajax-load-more-progress', get_site_url() . '/wp-content/plugins/ajax-load-more/vendor/js/pace/pace.min.js', 'ajax-load-more', ALM_VERSION, true);

   		// Masonry JS
           //wp_register_script( 'ajax-load-more-masonry', get_site_url().'/wp-content/plugins/ajax-load-more/vendor/js/masonry/masonry.pkgd.min.js', 'ajax-load-more',  '4.2.1', true );
    wp_register_script('ajax-load-more-masonry', get_site_url() . '/wp-content/themes/tootle-child/alm_templates/js/masonry.js', 'ajax-load-more', '4.2.1', true);
           

   		// Core CSS
    if (!alm_do_inline_css('_alm_inline_css') && !alm_css_disabled('_alm_disable_css')) { // Not inline or disabled
        $file = get_site_url() . '/wp-content/plugins/ajax-load-more/core/dist/css/' . ALM_SLUG . '.min.css';
        ALM_ENQUEUE::alm_enqueue_css(ALM_SLUG, $file);
    }

   		// Prevent loading of unnessasry posts - move user to top of page
    $scrolltop = 'false';
    if (!isset($options['_alm_scroll_top']) || $options['_alm_scroll_top'] != '1') { // if unset or false
        $scrolltop = 'false';
    } else { // if checked
        $scrolltop = 'true';
    }

    wp_localize_script(
        'ajax-load-more',
        'alm_localize',
        array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'alm_nonce' => wp_create_nonce("ajax_load_more_nonce"),
            'pluginurl' => ALM_URL,
            'scrolltop' => $scrolltop,
            'ajax_object' => array('is_single' => true, 'is_singular' => true)
        )
    );
}
function facebook_like_function()
{
$full_settings = get_option('evolve_child_theme_settings');
    $full_settings = json_decode($full_settings);
    ?>


<div class="facebook_body home_page_share_box" style="background-color:red;" >
    <div class="row content_share">
        <div class="col p-2 m-4 facebook_content"> Follow us to keep updated on the latest stories from The Better India</div>
    </div>
    <div class="row share_content_share">
        <div class="col-12">
            <?php if(isset($full_settings->tbi_facebook) && $full_settings->tbi_facebook!='' && $full_settings->tbi_facebook!='#'){ ?>
                <div class="facebook_button" onClick="javascript:window.open('<?php echo $full_settings->tbi_facebook; ?>', '_blank');">
                    <div class="facebook_button_content" ><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/u205.png" width=""> Like us on Facebook</div>
                </div>
            <?php } ?>
        </div>
        <div class="col-12" style="padding-top: 15px;">
            <?php if(isset($full_settings->tbi_twitter) && $full_settings->tbi_twitter!='' && $full_settings->tbi_twitter!='#'){ ?>
                <div class="twitter_button padding_tuiter" onClick="javascript:window.open('<?php echo $full_settings->tbi_twitter; ?>', '_blank');">
                    <!-- <div class="facebook_button_logo"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/u209t.png" width=""></div> -->
                    <div class="facebook_button_content"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/u209t.png" width=""> Follow us on Twitter</div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>    
<?php

}
add_shortcode('facebook_like', 'facebook_like_function');
/*
function quick_bytes_details_page($id,$title,$content,$author,$date,$thumbnail){
    $content_length = 70;
    echo $id.'--'.$title.'--'.$content.'--'.$author.'--'.$date;
    $content = strip_tags($content);
    //$content_arr = str_split($content, 70);
    $content_arr = explode("\n", wordwrap($content, $content_length));
    $total_arr_length = count($content_arr);
    $gallery_data = get_post_meta( $id, 'gallery_data', true );
   //echo $gallery_data['background_image_url'];
    //echo $thumbnail;
    ?>
    <div class="row">
        <div id="slider-wrapper">
            <div id="slider" class="grid-container background-size background_image" style="background-image:url(<?php echo isset($gallery_data['background_image_url'])?$gallery_data['background_image_url']:''; ?>);">
    <?php
    if($total_arr_length > 0){
        foreach($content_arr as $key=>$content_value){
            $cnumber = $key+1;
            ?>
            <div class="grid-item sp" >
                <div class="row">
                    <div class="col-4 thumbnail_image circle"><p><img src="<?php echo $thumbnail;?>" width=""></p></div>
                    <div class="col content_title"> <?php echo $title?>
                    <span class="card_option">Card <?php echo $cnumber;?> of <?php echo $total_arr_length; ?></span>
                    </div>
                </div>
                <div class="row full_content">
                    <?php echo $content_value;?>
                </div>
            </div>
            <?php
        }

    }
    //var_dump($content_arr);
    ?>
            </div>
        </div>
        <div id="nav"><div id="button-previous" style="cursor:pointer"><img src="<?php echo get_stylesheet_directory_uri()?>/images/left_white.png" width="25"></div>
        <div id="button-next"  style="cursor:pointer"><img src="<?php echo get_stylesheet_directory_uri()?>/images/right_white.png"  width="25"></div></div> 
    </div>


    <!-- <div class="row">
        <div id="slider-wrapper">
            <div id="slider">
                <div class="sp" style="background: blue;">akjdfalfkdj</div>
                <div class="sp" style="background: yellow;">akjdfautlfkdkjkhkj</div>
                <div class="sp" style="background: green;" >akjdfalfkdiyukjkhkj</div>
                <div class="sp" style="background: red;">akjdfalfkdkkljjkhkj</div>
            </div>
        </div>

            <div id="nav"><div id="button-previous" style="cursor:pointer">prev</div>
            <div id="button-next"  style="cursor:pointer">next</div></div>
            
    </div> -->
    <?php
}*/
function quick_bytes_details_page($id, $title, $content, $author, $date, $thumbnail)
{
    $content_length = 70;
   // echo $id.'--'.$title.'--'.$content.'--'.$author.'--'.$date;
    $content = strip_tags($content);
    //$content_arr = str_split($content, 70);
    $content_arr = explode("\n", wordwrap($content, $content_length));
    $total_arr_length = count($content_arr);
    $gallery_data = get_post_meta($id, 'gallery_data', true);
    
   //echo $gallery_data['background_image_url'];
    //echo $thumbnail;
    $order = $gallery_data['content_order'];
    $sort = asort($order);
    //var_dump($order);
    $total_order = count($order);
    ob_start();
    ?>
   <style>
    div.row.content-post.post_t_quickbyte{
        background-image:url(<?php echo isset($gallery_data['background_image_url']) ? $gallery_data['background_image_url'] : ''; ?>);
    }
    div.row.content-post.for_desktop_view{
        background-image:url(<?php echo isset($gallery_data['background_image_url']) ? $gallery_data['background_image_url'] : ''; ?>) !important;
    }
    div.single_quick_bytes_background_color{
        background-color:<?php echo isset($gallery_data['color-picker'])?$gallery_data['color-picker']:'';?>;
    }
   </style>
            <div class="row main-slider-container quick_bytes_details_class" >
                <div class="row content-post post_t_quickbyte for_desktop_view" style=""></div>
                <div id="" class="owl-demo3_dinamic_class owl-carousel">
                                

                                    <!--style="background-image:url(<?php echo isset($gallery_data['background_image_url']) ? $gallery_data['background_image_url'] : ''; ?>);"-->
                                    <div class="item selected_product single_separate" style="">
                                     <?php //var_dump($gallery_data['color-picker']);?>
                                     
                                     
                                     <div class="quick_bytes_shade_color" style="background-color:<?php echo isset($gallery_data['color-picker'])?$gallery_data['color-picker']:'';?>"></div> 

                                    <div class="col single_separate">
                                        <div class="section1">
                                            <div class="col-4 thumbnail_image circle single_separate"><p><img class="single_separate" src="<?php echo isset($gallery_data['background_image_url']) ? $gallery_data['background_image_url'] : '';//$thumbnail; ?>" width=""></p></div>
                                            </div>
                                            <div class="section2">
                                            <h3 ><?php echo $title ?></h3>
                                        </div>
                                        <div class="section3">            
                                            <div class="author_name">by <span class="capitalize"><?php echo $author.'';?></span></div>
                                            <div class="date_name"> <?php echo date('d M Y',strtotime($date));?></div>
                                        </div>    
                                            
                                        </div>
                                    </div>
                                    <?php
                                    if ($total_order > 0) {
                                        foreach ($order as $key => $content_value) {
                                            $cnumber = $key + 1;
                                            $thumbnail = isset($gallery_data['background_image_url']) ? $gallery_data['background_image_url'] : '';
                                            /*style="background-image:url(<?php echo isset($gallery_data['background_image_url']) ? $gallery_data['background_image_url'] : ''; ?>);"*/
                                            ?>
                                            <div class="item selected_product" >
                                            <?php //var_dump($gallery_data);?>
                                            <div class="quick_bytes_shade_color" style="background-color:<?php echo isset($gallery_data['color-picker'])?$gallery_data['color-picker']:'';?>"></div>    
                                            <div class="row related_item">
                                                    <div class="row_section1">
                                                        <div class="col-4 thumbnail_image circle"><p><img src="<?php echo $thumbnail; ?>" width=""></p></div>
                                                        <div class="col content_title"> <?php echo $title ?>
                                                        <span class="card_option">Card <?php echo $cnumber; ?> of <?php echo $total_order; ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="row_section2">
                                                        <div class="row full_content">
                                                            <?php 
                                                            $general_info = isset($gallery_data['quick_content'][$key]) ? $gallery_data['quick_content'][$key] : '';
                                                            echo $general_info; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                        </div>
                                            <?php

                                        }

                                    }
                                    //var_dump($content_arr);
                                    ?>
                                
                                
                    </div>       
            </div>    
       
        
        <!-- <img src="<?php echo get_stylesheet_directory_uri() ?>/images/left_white.png" width="25">
        
        <img src="<?php echo get_stylesheet_directory_uri() ?>/images/right_white.png"  width="25"> -->
       
    

    <?php
    $return = ob_get_clean();
    return $return;
}


function related_story_show_footer($term_id, $postid)
{
    
    $some_args = array(
        'tax_query' => array(
            array(
                'taxonomy' => 'story_package',
                'field' => 'term_id',
                'terms' => $term_id,
            )

        ),
        'meta_query' => array(
            array(
                'key'       => 'gallery_data',
                'value'     => sprintf(':"%s";', 'story'),
                'compare'   => 'like',
            )
            
        ),
        'post_status' => 'publish',
        'post_type' => 'post',
        'posts_per_page'=>-1,
        'orderby'   => 'date',
                            'order' => 'ASC',
    );
   // $query = new WP_Query( $some_args );
    //var_dump($query->request);
    $s = get_posts($some_args);
    $total_post = count($s);
    if ($total_post > 0) {
        echo '<aside id="secondary" class="aside col-sm-12 col-md-4 desktop_position_change">';
        //var_dump($s->have_posts());die();
        echo '<div class="row inthis_package">IN THIS PACKAGE</div>';
        echo '<div class="row story_package_border_with_margin">';
        echo '<div id="touchFlow" class="nav_h_responsive_type"><ul>';
        foreach ($s as $kk=>$val) {
            // var_dump($p);
            $post_id = $val->ID;
            $active_radious = '';
            if ($post_id == $postid) {
                $active_radious = 'activate';
            }
            ?>
            <li>
                    <div class="col block">
                    <div class="date_circle background_option <?php echo $active_radious;?>"></div>
                    <div class="background_border_option <?php echo $active_radious;?>_new"></div>
                    <span><?php echo ($kk + 1) ?></span>
                    <div class="date_circle <?php echo $active_radious;?>"><p>
                        <?php 
                        $thumb = get_the_post_thumbnail($post_id, 'thumbnail', array('class' => 'img-responsive'));
                        echo $thumb;//echo date('M j', strtotime($p->post_date)); ;?></p>
                    </div>
                    <span class="year_story"><?php //echo date('Y', strtotime($val->post_date)); ;?></span>
                    </div>
                    <div class="col text_matter">
                        <div class="story_title <?php echo $active_radious;?>">
                        <?php
                        if ($post_id != $postid) {
                            ?>
                        <a href="<?php echo get_permalink($post_id) ?>">
                        
                        <?php echo custom_echo($val->post_title,60); ?>

                        </a>
                        <?php

                    } else {
                        echo custom_echo($val->post_title,60);
                    } ?>
                        </div>
                        <div class="story_author"> <span class="author_style"><?php echo date('j F, Y', strtotime($val->post_date));//echo the_author_meta( 'user_login' , $p->post_author );?></span>
                        </div>
                    </div>
                
                </li>
                <?php
              // $s->the_post();
            }
            echo '</ul></div>';
            echo '</div>';
            echo '</div>';
        }
    }

    function related_story_show($term_id, $postid)
    {
        $some_args = array(
            'tax_query' => array(
                array(
                    'taxonomy' => 'story_package',
                    'field' => 'term_id',
                    'terms' => $term_id,
                )

            ),
            'meta_query' => array(
                array(
                    'key'       => 'gallery_data',
                    'value'     => sprintf(':"%s";', 'story'),
                    'compare'   => 'like',
                )
                
            ),
            'post_status' => 'publish',
            'post_type' => 'post',
            'posts_per_page'=>-1,
            'orderby'   => 'date',
                            'order' => 'ASC',
        );
   // $query = new WP_Query( $some_args );
    //var_dump($query->request);
        $s = get_posts($some_args);
        //var_dump($s);
        $total_post = count($s);
        if ($total_post > 0) {
        //var_dump($s->have_posts());die();
            echo '<div id="touchFlow" class="nav_h_responsive_type"><ul>';
            foreach ($s as $kk => $val) {
            // var_dump($p);
            $post_id = $val->ID;
            $active_radious = '';
            if ($post_id == $postid) {
                $active_radious = 'activate';
            }
                ?>
                <li>
                    <div class="col block">
                        
                            <div class="date_circle background_option <?php echo $active_radious;?>"></div>
                            <div class="background_border_option <?php echo $active_radious;?>_new"></div>
                            <span><?php echo ($kk + 1) ?></span>
                            <div class="date_circle <?php echo $active_radious;?>"><p>
                            
                            <?php 
                            

                            $thumb = get_the_post_thumbnail($post_id, 'thumbnail', array('class' => 'img-responsive'));
                            if ($post_id != $postid) {
                                ?>
                                <a href="<?php echo get_permalink($post_id) ?>">
                                <?php

                            }
                            ?>
                            
                            <?php
                            echo $thumb;//echo date('M j', strtotime($p->post_date)); 
                            if ($post_id != $postid) {
                                ?>
                                </a>
                                <?php

                            }
                            ?>
                            </p>
                            </div>
                    
                    </div>
                    <div class="col text_matter disabled_in_mobile_view">
                        <div class="story_title <?php echo $active_radious;?>">
                        <?php
                        if ($post_id != $postid) {
                            ?>
                        <a href="<?php echo get_permalink($post_id) ?>">
                        
                        <?php 
                        
                        echo custom_echo($val->post_title,60); ?>

                        </a>
                        <?php

                    } else {
                        echo custom_echo($val->post_title,60);
                    } ?>
                        </div>
                        <div class="story_author"> <span class="author_style"><?php echo date('j F, Y', strtotime($val->post_date));//echo the_author_meta( 'user_login' , $p->post_author );?></span>
                        </div>
                    </div>
                   
                </li>
                <?php
            }
            echo '</ul></div>';
        }
    }



    function ajax_load_more_post($post_not_in)
    {
            $get_meta_val = get_post_meta(get_the_id(), 'gallery_data', true);
            $class_helper = '';
            $class_helper .= isset($get_meta_val['card_type'])?$get_meta_val['card_type']:'';
            //echo $get_meta_val['card_type'];
            //return do_shortcode('[ajax_load_more post_type="post" post__not_in="'.$post_not_in.'" posts_per_page="2" images_loaded="true" button_loading_label="More"]');
            return '<div class="row block_full_width '.$class_helper.'">' . do_shortcode('[ajax_load_more post_type="post" transition="masonry" post__not_in="' . $post_not_in . '" posts_per_page="1" images_loaded="true" button_loading_label="More"]') . '</div>';
    }


    function frontpage_admin_menu()
    {

        add_menu_page(
            'The Better India',
            'The Better India',
            'read',
            'front-sections',
            '',
            'dashicons-admin-home',
            5
        );
        add_menu_page(
            'Main Post Types',
            'Main Post Types',
            'read',
            'front-sections1',
            '',
            'dashicons-admin-home',
            5
        );
        add_submenu_page('edit.php?post_type=book', 'My Custom Page', 'My Custom Page', 'manage_options', 'front-sections1');
        // add_menu_page(
        //     'Future of India',
        //     'Future of India',
        //     'read',
        //     'front-sections-future',
        //     '',
        //     'dashicons-admin-home',
        //     6
        // );

    }

    add_action('admin_menu', 'frontpage_admin_menu');
    function myprefix_unregister_tags() {
        unregister_taxonomy_for_object_type('post_tag', 'post');
    }
    add_action('init', 'myprefix_unregister_tags');
    add_shortcode('TBI_AUTHOR', 'post_type_author');
    function post_type_author($atts)
    {
         $default = array(
        'header' => '',
        'slug' => '',
         'title' => 'AUTHORS',
        'count' => -1,
        'link' => '#',
    );
    $a = shortcode_atts($default, $atts);
        ?>
    <div class="container">
    <div class="row">
    <?php if(isset($a['title']) && $a['title']!=""){?>
        <div class="title_for_header"><?php echo $a['title'];?></div>
    <?php } ?>
      <?php if(isset($a['link']) && $a['link']!="" && $a['link']!="#"){?>
        <div class="see_all_author"><a href="<?php echo $a['link'];?>"> See All </a></div>
      <?php } ?>
    </div>
    <div class="row">  
        <div id="owl-demo" class="owl-demo3_dinamic_class owl-carousel">
        <?php
        $loop = new WP_Query(array('post_type' => 'author', 'posts_per_page' => -1)); ?>

            <?php 
            if ( $wpb_all_query->have_posts() ){
                    while ($loop->have_posts()) : $loop->the_post(); 
                        //get_the_ID();
                    $gallery_data = get_post_meta(get_the_ID(), 'gallery_data', true);
                    ?>
                            <div class="item selected_product">
                                <div class="thumbnail_image"> <?php echo get_the_post_thumbnail(); ?></div>
                                <?php the_title('<h2 class="entry-title"><a href="' . get_permalink() . '" title="' . the_title_attribute('echo=0') . '" rel="bookmark">', '</a></h2>'); ?>
                                <?php
                                if (isset($gallery_data['author_type'])) {
                                    ?>
                                <div class="founder_info"><?php 
                                                            echo $gallery_data['author_type'];
                                                            ?></div>
                                <?php

                            } ?>
                                <!-- <div class="entry-content">
                                    <?php the_content(); ?>
                                </div> -->

                        </div>  
                        <?php 
                        endwhile;
            }else{
                echo "Record Not Found.";
            }
    ?>
        </div>
    </div>
 </div>
    <script>
         jQuery(document).ready(function(){

            jQuery(".owl-demo3_dinamic_class").owlCarousel({
                items : 1,
                lazyLoad : true,
                navigation : false
            }); 

        });
    </script>
    <?php

}
//add_action('evolve_after_content_area', 'call_tbi_author');
function call_tbi_author()
{
    if (is_page('tbi-corner')) {
        //echo do_shortcode('[TBI_AUTHOR]');
    }
}




add_shortcode('TBI_AWARDS', 'post_type_awards');
function post_type_awards($atts)
{
    $default = array(
        'header' => '',
        'slug' => '',
         'title' => 'AWARDS',
        'count' => -1,
        'link' => '#',
    );
    $a = shortcode_atts($default, $atts);

   // if (is_page('tbi-corner')) {
        ?>
                <div class="container">
                <div class="row">
                    <?php if(isset($a['title']) && $a['title']!=""){?>
                        <div class="title_for_header"><?php echo $a['title'];?></div>
                    <?php } ?>
                    <?php if(isset($a['link']) && $a['link']!="" && $a['link']!="#"){?>
                        <div class="see_all_author"><a href="<?php echo $a['link'];?>"> See All </a></div>
                    <?php } ?>
                </div>
                <div class="row">  
                    <div id="owl-demo" class="owl-demo3_dinamic_class owl-carousel">
                    <?php
                    $loop = new WP_Query(array('post_type' => 'awards', 'posts_per_page' => -1)); ?>
                        
                        <?php 
                        if ( $loop->have_posts() ){
                            while ($loop->have_posts()) : $loop->the_post(); 
                                //get_the_ID();
                            $gallery_data = get_post_meta(get_the_ID(), 'gallery_data', true);
                            ?>
                                <div class="item selected_product">
                                    <div class="thumbnail_image"> <?php echo get_the_post_thumbnail(); ?></div>
                                    <?php the_title('<h2 class="entry-title"><a href="' . get_permalink() . '" title="' . the_title_attribute('echo=0') . '" rel="bookmark">', '</a></h2>'); ?>
                                    <?php

                                    if (isset($gallery_data['awards_info'])) {
                                        ?>
                                    <div class="founder_info"><?php 
                                                                echo $gallery_data['awards_info'];
                                                                ?></div>
                                    <?php

                                } ?>
                                    <!-- <div class="entry-content">
                                        <?php the_content(); ?>
                                    </div> -->

                            </div>  
                            <?php 
                            endwhile;

                        }else{
                            echo "Record Not Found.";
                        }
                            ?>
                    </div>
                </div>
            </div>
                <script>
                    jQuery(document).ready(function(){

                        jQuery(".owl-demo3_dinamic_class").owlCarousel({
                            items : 1,
                            lazyLoad : true,
                            navigation : false
                        }); 

                    });
                </script>
    <?php

//}
}
//add_action('evolve_after_content_area', 'call_tbi_awards');
function call_tbi_awards()
{
    echo do_shortcode('[TBI_AWARDS]');
}

add_action('wp_ajax_nopriv_ajax_menu_page', 'my_ajax_pagination');
add_action('wp_ajax_ajax_menu_page', 'my_ajax_pagination');

function my_ajax_pagination()
{
    //echo $_REQUEST['page_name'];
    if ($_REQUEST['page_name'] == 'shop') {
        post_type_dynamic('shop');
    } elseif ($_REQUEST['page_name'] == 'video') {
        meta_query_post_type_dynamic('video');
    } elseif ($_REQUEST['page_name'] == 'podcasts') {
        meta_query_post_type_podcasts('podcast');
    } elseif ($_REQUEST['page_name'] == 'impact') {
        meta_query_post_type_dynamic('impact');
    }elseif ($_REQUEST['page_name'] == 'menu') {
        echo '<div id="primary-menu" style="display:block;" class="collapse navbar-collapse" data-hover="dropdown" data-animations="fadeInUp fadeInDown fadeInDown fadeInDown">';
								wp_nav_menu(array(
												'theme_location' => 'primary-menu',
												'depth' => 10,
												'container' => false,
												'menu_class' => 'navbar-nav mr-auto',
												'fallback_cb' => 'evolve_custom_menu_walker::fallback',
												'walker' => new evolve_custom_menu_walker(),
											)); 
											echo '</div>';
    }


    die();
}
function filter_search($query)
{
    if ($query->is_search && $_GET['post_type'] == 'contacts_database') {
        $query->set('post_type', array('contacts_database'));
    };
    return $query;
};
add_filter('pre_get_posts', 'filter_search');
function meta_query_post_type_podcasts($meta_value)
{
    ?>
    <div class="container <?php echo $meta_value;?>">
    
    <div class="row">  
        <div id="owl-demo" class="owl-demo3_dinamic_class load_from_ajax">
        <?php

        $args = array(
            'post_type' => 'post',
            'posts_per_page' => -1,
            'orderby' => 'menu_order',
            'order' => 'ASC',
            'meta_query' => array(
                array(
                    'key' => 'gallery_data',
                    'value' => $meta_value,
                    'compare' => 'like',
                ),
            ),
        );
       // var_dump($args);
        $loop = new WP_Query($args);
        ?>

            <?php while ($loop->have_posts()) : $loop->the_post(); 
                //get_the_ID();
            $gallery_data = get_post_meta(get_the_ID(), 'gallery_data', true);
            //var_dump($gallery_data);
            //echo $gallery_data['youtube_link'];
            ?>
                    <div class="item selected_product">
                        <?php
                        if (isset($gallery_data['podcast_shortcode']['pod_cast'])) {
                            $shortcode = $gallery_data['podcast_shortcode']['pod_cast'];

                            ?>
                        <div class="thumbnail_video"> <?php 
                                                        if (isset($gallery_data['podcast_shortcode']['pod_cast'])) {
                                                            preg_match('/<iframe.*src=\"(.*)\".*><\/iframe>/isU', $gallery_data['podcast_shortcode']['pod_cast'], $matches);
                                                            echo '<iframe src="' . $matches[1] . '" width="300" height="182" frameborder="0" scrolling="no"></iframe>';
                                                        }
                                                        ?></div>
                        <?php

                    }
                    
                    //human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago';
                    ?>

                        <?php the_title('<h2 class="entry-title">', '</h2>');
                        //<a href="' . get_permalink() . '" title="' . the_title_attribute('echo=0') . '" rel="bookmark"> ?>
                        <?php 
                        echo '<div class="podcust_timeline">';
                        echo get_the_time('M j - h:i');
                        echo '</div>';
                        ?>
                        <div class="entry-content">
                            <?php $content = get_the_content();
                            $content_tag = strip_tags($content);

                            echo substr($content_tag, 0, 70) . '...'; ?>
                            <div class="bottom_border_shop"></div>
                        </div>
                        

                  </div>  
				<?php endwhile;
    ?>
        </div>
    </div>
    <div class="view_all_show_only_desktop show_on_desktop"><div class="view_all click_on_view">VIEW ALL</div></div>
 </div>
    <?php

}
add_action('wp_head','head_css_defuine');
function head_css_defuine(){
    //var_dump(is_page('home'));
    ?>
    <style>
    <?php 
    
    if(is_page('home')==false){?>    
     .ax_default{
    background-image: url(<?php echo get_stylesheet_directory_uri();?>/images/u198.png);
    width: 3px;
    height: 15px;
  }
  #u8{
    background-image: url(<?php echo get_stylesheet_directory_uri();?>/images/u197.png);
    width: 30px;
    height: 15px;
    background-repeat: no-repeat;
  }
  <?php }else{ ?>
  .ax_default{
    background-image: url(<?php echo get_stylesheet_directory_uri();?>/images/u10.png);
    width: 3px;
    height: 15px;
  }
  #u8{
    background-image: url(<?php echo get_stylesheet_directory_uri();?>/images/u8.png);
    width: 30px;
    height: 15px;
    background-repeat: no-repeat;
  }
  <?php } ?>
    </style>
<?php

}
function meta_query_post_type_dynamic($meta_value)
{
    ?>
    <div class="container <?php echo $meta_value;?>">
    
    <div class="row">  
        <div id="owl-demo" class="owl-demo3_dinamic_class load_from_ajax">
        <?php

        $args = array(
            'post_type' => 'post',
            'posts_per_page' => -1,
            'orderby' => 'menu_order',
            'order' => 'ASC',
            'meta_query' => array(
                array(
                    'key' => 'gallery_data',
                    'value' => $meta_value,
                    'compare' => 'like',
                ),
            ),
        );
        $loop = new WP_Query($args);
        ?>

            <?php while ($loop->have_posts()) : $loop->the_post(); 
                //get_the_ID();
            $gallery_data = get_post_meta(get_the_ID(), 'gallery_data', true);
            //var_dump($gallery_data);
            //echo $gallery_data['youtube_link'];
            ?>
                    <div class="item selected_product">
                        <?php
                        if (isset($gallery_data['youtube_link'])) {
                            ?>
                        <div class="thumbnail_video"> <?php echo youtube_link_to_embeded_code($gallery_data['youtube_link']) ?></div>
                        <?php

                    }
                    ?>

                        <?php the_title('<h2 class="entry-title">', '</h2>');
                        //<a href="' . get_permalink() . '" title="' . the_title_attribute('echo=0') . '" rel="bookmark"> ?>
                        <div class="entry-content">
                            <?php $content = get_the_content();
                            $content_tag = strip_tags($content);

                            echo substr($content_tag, 0, 70) . '...'; ?>
                            <div class="bottom_border_shop"></div>
                        </div>
                        
                            
                  </div>  
				<?php endwhile;
    ?>
        </div>
    </div>
    <div class="view_all_show_only_desktop show_on_desktop"><div class="view_all click_on_view">VIEW ALL</div></div>
 </div>
    <?php

}

function post_type_dynamic($post_type)
{
    ?>
    <div class="container <?php echo $post_type;?>">
    
    <div class="row">  
        <div id="owl-demo" class="owl-demo3_dinamic_class load_from_ajax">
        <?php
        $loop = new WP_Query(array('post_type' => $post_type, 'posts_per_page' => -1,'orderby' => 'menu_order', 'order' => 'desc')); ?>
        
            <?php while ($loop->have_posts()) : $loop->the_post(); 
                //get_the_ID();
            $gallery_data = get_post_meta(get_the_ID(), 'gallery_data', true);
            //var_dump($gallery_data);
            ?>
                    <div class="item selected_product">
                        <div class="thumbnail_image"> 
                            <a href="<?php echo isset($gallery_data['product_link'])?$gallery_data['product_link']:'#';?>" target="_blank">
                                <?php echo get_the_post_thumbnail(); ?>
                            </a>
                        </div>
                         <a href="<?php echo isset($gallery_data['product_link'])?$gallery_data['product_link']:'#';?>" target="_blank">
                        <?php the_title('<h2 class="entry-title">', '</h2>');
                        //<a href="' . get_permalink() . '" title="' . the_title_attribute('echo=0') . '" rel="bookmark"> ?>
                        </a>
                        <div class="entry-content">
                            <?php the_content(); ?>
                        </div>
                    <div class="button_area">
                        <?php

                        if (isset($gallery_data['price_info'])) {
                            ?>
                            <a href="<?php echo isset($gallery_data['product_link'])?$gallery_data['product_link']:'#';?>" target="_blank">
                        <div class="founder_info btn"><?php 
                                                        echo 'Rs. ' . $gallery_data['price_info'];
                                                        ?></div></a>
                        <?php

                    } ?>
                        
                   <div class="bottom_border_shop"></div>
                </div>     
                  </div>  
				<?php endwhile;
    ?>
        </div>
    </div>
    <div class="view_all_show_only_desktop show_on_desktop"><div class="view_all click_on_view">VIEW ALL</div></div>
 </div>
    <?php

}



//--------------------------------------------------------wordpress exporter

remove_action('admin_menu', 'wp_csv_import_admin_menu');
function wp_csv_import_admin_menu_update()
{
    require_once ABSPATH . '/wp-admin/admin.php';
    //$plugin = new WpCsvImporter;
    add_submenu_page(
        'tools.php',
        'Wp CSV Importer',
        'Wp CSV Importer',
        'manage_options',
        'wp-csv-importer',
        'wp_csv_importer_form_update'
    );
}
add_action('admin_menu', 'wp_csv_import_admin_menu_update');


function wp_csv_importer_form_update()
{
  //  var_dump(class_exists(WpCsvImporter));
    if (null !== class_exists('WpCsvImporter')) {
        $plugin = new WpCsvImporter;
        $opt_draft = $plugin->process_option(
            'csv_importer_import_as_draft',
            'publish',
            $_POST
        );
        $opt_cat = $plugin->process_option('csv_importer_cat', 0, $_POST);

        if ('POST' == $_SERVER['REQUEST_METHOD']) {
            $plugin->post(compact('opt_draft', 'opt_cat'));
        }

        // form HTML {{{
        ?>
					<div id="wp-settings"> 
					<div class="wrap">
						<h1>Wp CSV Importer Settings</h1><hr />
						<p align="center"><a href="<?php echo plugins_url('sample/sample.csv', __FILE__); ?>" target="_blank">Download Sample File </a></p>
						<form class="add:the-list: validate" method="post" enctype="multipart/form-data">
						<div style="width: 80%; padding: 10px; margin: 10px;"> 
						<!-- <div id="wpimporter-tab-menu">
                            <a id="wpimporter-general" class="wpimporter-tab-links active" >General</a> 
                            <a  id="wpimporter-pro" class="wpimporter-tab-links">Go Pro</a> 
                            <a  id="wpimporter-support" class="wpimporter-tab-links">Support</a> 
                            </div> -->

						<div class="wpimporter-setting">
						<!-- General Setting -->	
						<div class="first wpimporter-tab" id="div-wpimporter-general">
						<h2>General Settings</h2>
							<?php wp_nonce_field('ve_import_csv_action', 've_csv_nonce_field'); ?>
							<!-- Parent category -->
							<p><label for="page_type">Choose Post Type:</label> 
							<select name="page_type" id="page_type">
								<option value="">Select post type</option>
								<?php 

        $args = array(
            'public' => true,
            '_builtin' => false
        );

        $output = 'names'; // names or objects, note names is the default
        $operator = 'and'; // 'and' or 'or'

        $post_types = get_post_types($args, $output, $operator);
        array_push($post_types, 'post');
        array_push($post_types, 'page');
        foreach ($post_types as $post_type) {

            echo '<option value="' . $post_type . '" >' . $post_type . '</option>';
        }

        ?>
						</select>

							<!-- File input --></p>

							<p><label for="csv_import">Upload file:</label><input name="csv_import" id="csv_import" type="file" value="" aria-required="true" /></p>
							<p class="submit"><?php submit_button("Import Now"); ?></p>
						</form>
						</div><!-- end wrap -->
						<!-- General Setting -->	
						<div class="wpimporter-tab" id="div-wpimporter-pro">
						<h2><a href="https://rgaddons.wordpress.com/wp-importer-pro/" target="_blank">GO PRO</a></h2>
						
						<h2 style="color:green;text-align:left;"><strong>Pay one time use lifetime!!!!!</strong> Hurry up!!!!</h2>
						
						<p>We have released an add-on for <strong><a href="https://wordpress.org/plugins/wp-csv-importer/" target="_blank">WP CSV Importer</a></strong> which not only demonstrates the flexibility of <strong>WP Importer</strong>, but also adds some important features:</p>
						<ol>
							<li>* Create/Update unlimited posts</li>
							<li>* Create/Update unlimited pages</li>
							<li>* Create/Update unlimited custom post type pages</li>
							<li>* An option for define to featured image for each post</li>
							<li>* An option for define to category name for each post</li>
							<li>* An option for define to unlimited custom fileds value</li>
							<li>* An option for define to custom taxonomy name for each post</li>
							<li>* An option for define to post menu order</li>
							<li>* An option for define to post author</li>
							<li>* An option for define to post status</li>
							<li>* An option for define to custom post slug name</li>
							<li>* Faster support</li>
						</ol>
						
						<p> <a href="https://rgaddons.wordpress.com/wp-importer-pro/">Click Here</a> for upgrade to Pro version.</p>
						
						<p> <a href="mailto:raghunath.0087@gmail.com">Click here </a> for send your query for us </p>

						
						</div>
							<!-- Support -->
						<div class="last author wpimporter-tab" id="div-wpimporter-support">
						<h2>Plugin Support</h2>
						<table>
						<tr>
						<td width="30%"><p><a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=ZEMSYQUZRUK6A" target="_blank" style="font-size: 17px; font-weight: bold;"><img src="<?php echo plugins_url('images/btn_donate_LG.gif', __FILE__); ?>" title="Donate for this plugin"></a></p>
						
						<p><strong>Plugin Author:</strong><br><img src="<?php echo plugins_url('images/raghu.jpg', __FILE__); ?>" width="50" height="50"><br><a href="http://raghunathgurjar.wordpress.com" target="_blank">MR Web Solution</a></p>
						<p><a href="mailto:raghunath.0087@gmail.com" target="_blank" class="contact-author">Contact Author</a></p>
					</td>
						<td>
						<p><strong>My Other Plugins:</strong><br>
						<ol>
							<li><a href="https://wordpress.org/plugins/custom-share-buttons-with-floating-sidebar" target="_blank">Custom Share Buttons With Floating Sidebar</a></li>
									<li><a href="https://wordpress.org/plugins/protect-wp-admin/" target="_blank">Protect WP-Admin</a></li>
									<li><a href="https://wordpress.org/plugins/wp-sales-notifier/" target="_blank">WP Sales Notifier</a></li>
									<li><a href="https://wordpress.org/plugins/wp-categories-widget/" target="_blank">WP Categories Widget</a></li>
									<li><a href="https://wordpress.org/plugins/wp-protect-content/" target="_blank">WP Protect Content</a></li>
									<li><a href="https://wordpress.org/plugins/wp-version-remover/" target="_blank">WP Version Remover</a></li>
									<li><a href="https://wordpress.org/plugins/wp-posts-widget/" target="_blank">WP Post Widget</a></li>
									<li><a href="https://wordpress.org/plugins/wp-importer" target="_blank">WP Importer</a></li>
									<li><a href="https://wordpress.org/plugins/wp-csv-importer/" target="_blank">WP CSV Importer</a></li>
									<li><a href="https://wordpress.org/plugins/wp-testimonial/" target="_blank">WP Testimonial</a></li>
									<li><a href="https://wordpress.org/plugins/wc-sales-count-manager/" target="_blank">WooCommerce Sales Count Manager</a></li>
									<li><a href="https://wordpress.org/plugins/wp-social-buttons/" target="_blank">WP Social Buttons</a></li>
									<li><a href="https://wordpress.org/plugins/wp-youtube-gallery/" target="_blank">WP Youtube Gallery</a></li>
									<li><a href="https://wordpress.org/plugins/tweets-slider/" target="_blank">Tweets Slider</a></li>
									<li><a href="https://wordpress.org/plugins/rg-responsive-gallery/" target="_blank">RG Responsive Slider</a></li>
									<li><a href="https://wordpress.org/plugins/cf7-advance-security" target="_blank">Contact Form 7 Advance Security WP-Admin</a></li>
									<li><a href="https://wordpress.org/plugins/wp-easy-recipe/" target="_blank">WP Easy Recipe</a></li>
							</ol></p></td>
						</tr>
						</table>

						</div>
					</div>
					</div>
					<!-- End Genral settings -->
					<?php
        // end form HTML }}}
}
}

function state_cities_drop_down($selected_val)
{
    $state_city = state_city();
    //var_dump($state_city);
    //echo $selected_val;
    ?>
<select name="gallery[location_info]" value="" style="width:230" >
    <option selected="selected">-Select-</option>
    <?php
    $content = '';
    foreach ($state_city as $k => $res) {
        // var_dump($k);
       // var_dump($res);


        $content .= '<option disabled="disabled" style="background-color:#3E3E3E"><font color="#000000"><i>-' . $k . '-</i></font></option>';

        foreach ($res as $city) {
            $selected = '';
            if ($selected_val == $city) {
                $selected = 'selected';
            }
            $content .= '<option value = "' . $city . '" ' . $selected . '>' . $city . '</option>';


        }
    }
    echo $content;
    ?>
</select>
    <?php

}
function city_state_drop_down()
{
    //https://www.codeproject.com/Questions/646443/country-state-list-via-array-in-javascript
    ?>
    <script>
    var country_arr = new Array("Afghanistan", "Albania", "Algeria", "American Samoa", "Angola", "Anguilla", "Antartica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Ashmore and Cartier Island", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegovina", "Botswana", "Brazil", "British Virgin Islands", "Brunei", "Bulgaria", "Burkina Faso", "Burma", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Clipperton Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo, Democratic Republic", "Congo, Republic of the", "Cook Islands", "Costa Rica", "Cote d' Ivoire ", " Croatia ", " Cuba ", " Cyprus ", " Czeck Republic ", " Denmark ", " Djibouti ", " Dominica ", " Dominican Republic ", " Ecuador ", " Egypt ", " El Salvador ", " Equatorial Guinea ", " Eritrea ", " Estonia ", " Ethiopia ", " Europa Island ", " Falkland Islands ", " Faroe Islands ", " Fiji ", " Finland ", " France ", " French Guiana ", " French Polynesia ", " Antarctic Lands ", " Gabon ", " Gambia, The ", " Gaza Strip ", " Georgia ", " Germany ", " Ghana ", " Gibraltar ", " Glorioso Islands ", " Greece ", " Greenland ", " Grenada ", " Guadeloupe ", " Guam ", " Guatemala ", " Guernsey ", " Guinea ", " Guinea - Bissau ", " Guyana ", " Haiti ", " Heard Island ", " Holy See(Vatican City) ", " Honduras ", " Hong Kong ", " Howland Island ", " Hungary ", " Iceland ", " India ", " Indonesia ", " Iran ", " Iraq ", " Ireland ", " Ireland, Northern ", " Israel ", " Italy ", " Jamaica ", " Jan Mayen ", " Japan ", " Jarvis Island ", " Jersey ", " Johnston Atoll ", " Jordan ", " Juan de Nova Island ", " Kazakhstan ", " Kenya ", " Kiribati ", " Korea, North ", " Korea, South ", " Kuwait ", " Kyrgyzstan ", " Laos ", " Latvia ", " Lebanon ", " Lesotho ", " Liberia ", " Libya ", " Liechtenstein ", " Lithuania ", " Luxembourg ", " Macau ", " Macedonia ", " Madagascar ", " Malawi ", " Malaysia ", " Maldives ", " Mali ", " Malta ", " Man, Isle of ", " Marshall Islands ", " Martinique ", " Mauritania ", " Mauritius ", " Mayotte ", " Mexico ", " Micronesia ", " Midway Islands ", " Moldova ", " Monaco ", " Mongolia ", " Montserrat ", " Morocco ", " Mozambique ", " Namibia ", " Nauru ", " Nepal ", " Netherlands ", " Netherlands Antilles ", " new Caledonia ", " new Zealand ", " Nicaragua ", " Niger ", " Nigeria ", " Niue ", " Norfolk Island ", " Northern Mariana Islands ", " Norway ", " Oman ", " Pakistan ", " Palau ", " Panama ", " Papua new Guinea ", " Paraguay ", " Peru ", " Philippines ", " Pitcaim Islands ", " Poland ", " Portugal ", " Puerto Rico ", " Qatar ", " Reunion ", " Romainia ", " Russia ", " Rwanda ", " Saint Helena ", " Saint Kitts and Nevis ", " Saint Lucia ", " Saint Pierre and Miquelon ", " Saint Vincent ", " Samoa ", " San Marino ", " Sao Tome and Principe ", " Saudi Arabia ", " Scotland ", " Senegal ", " Seychelles ", " Sierra Leone ", " Singapore ", " Slovakia ", " Slovenia ", " Solomon Islands ", " Somalia ", " South Africa ", " South Georgia ", " Spain ", " Spratly Islands ", " Sri Lanka ", " Sudan ", " Suriname ", " Svalbard ", " Swaziland ", " Sweden ", " Switzerland ", " Syria ", " Taiwan ", " Tajikistan ", " Tanzania ", " Thailand ", " Tobago ", " Toga ", " Tokelau ", " Tonga ", " Trinidad ", " Tunisia ", " Turkey ", " Turkmenistan ", " Tuvalu ", " Uganda ", " Ukraine ", " United Arab Emirates ", " United Kingdom ", " Uruguay ", " USA ", " Uzbekistan ", " Vanuatu ", " Venezuela ", " Vietnam ", " Virgin Islands ", " Wales ", " Wallis and Futuna ", " West Bank ", " Western Sahara ", " Yemen ", " Yugoslavia ", " Zambia ", " Zimbabwe ");

var s_a = new Array();
s_a[0] = " ";
s_a[1] = " Badakhshan | Badghis | Baghlan | Balkh | Bamian | Farah | Faryab | Ghazni | Ghowr | Helmand | Herat | Jowzjan | Kabol | Kandahar | Kapisa | Konar | Kondoz | Laghman | Lowgar | Nangarhar | Nimruz | Oruzgan | Paktia | Paktika | Parvan | Samangan | Sar - e Pol | Takhar | Vardak | Zabol ";
s_a[2] = " Berat | Bulqize | Delvine | Devoll(Bilisht) | Diber(Peshkopi) | Durres | Elbasan | Fier | Gjirokaster | Gramsh | Has(Krume) | Kavaje | Kolonje(Erseke) | Korce | Kruje | Kucove | Kukes | Kurbin | Lezhe | Librazhd | Lushnje | Malesi e Madhe(Koplik) | Mallakaster(Ballsh) | Mat(Burrel) | Mirdite(Rreshen) | Peqin | Permet | Pogradec | Puke | Sarande | Shkoder | Skrapar(Corovode) | Tepelene | Tirane(Tirana) | Tirane(Tirana) | Tropoje(Bajram Curri) | Vlore ";
s_a[3] = " Adrar | Ain Defla | Ain Temouchent | Alger | Annaba | Batna | Bechar | Bejaia | Biskra | Blida | Bordj Bou Arreridj | Bouira | Boumerdes | Chlef | Constantine | Djelfa | El Bayadh | El Oued | El Tarf | Ghardaia | Guelma | Illizi | Jijel | Khenchela | Laghouat | M 'Sila|Mascara|Medea|Mila|Mostaganem|Naama|Oran|Ouargla|Oum el Bouaghi|Relizane|Saida|Setif|Sidi Bel Abbes|Skikda|Souk Ahras|Tamanghasset|Tebessa|Tiaret|Tindouf|Tipaza|Tissemsilt|Tizi Ouzou|Tlemcen";
s_a[4] = "Eastern|Manu' a | Rose Island | Swains Island | Western ";
s_a[5] = " Andorra la Vella | Bengo | Benguela | Bie | Cabinda | Canillo | Cuando Cubango | Cuanza Norte | Cuanza Sul | Cunene | Encamp | Escaldes - Engordany | Huambo | Huila | La Massana | Luanda | Lunda Norte | Lunda Sul | Malanje | Moxico | Namibe | Ordino | Sant Julia de Loria | Uige | Zaire ";
s_a[6] = " Anguilla ";
s_a[7] = " Antartica ";
s_a[8] = " Barbuda | Redonda | Saint George | Saint John | Saint Mary | Saint Paul | Saint Peter | Saint Philip ";
s_a[9] = " Antartica e Islas del Atlantico Sur | Buenos Aires | Buenos Aires Capital Federal | Catamarca | Chaco | Chubut | Cordoba | Corrientes | Entre Rios | Formosa | Jujuy | La Pampa | La Rioja | Mendoza | Misiones | Neuquen | Rio Negro | Salta | San Juan | San Luis | Santa Cruz | Santa Fe | Santiago del Estero | Tierra del Fuego | Tucuman ";
s_a[10] = " Aragatsotn | Ararat | Armavir | Geghark 'unik' | Kotayk '|Lorri|Shirak|Syunik' | Tavush | Vayots ' Dzor|Yerevan";
s_a[11] = "Aruba";
s_a[12] = "Ashmore and Cartier Island";
s_a[13] = "Australian Capital Territory|New South Wales|Northern Territory|Queensland|South Australia|Tasmania|Victoria|Western Australia";
s_a[14] = "Burgenland|Kaernten|Niederoesterreich|Oberoesterreich|Salzburg|Steiermark|Tirol|Vorarlberg|Wien";
s_a[15] = "Abseron Rayonu|Agcabadi Rayonu|Agdam Rayonu|Agdas Rayonu|Agstafa Rayonu|Agsu Rayonu|Ali Bayramli Sahari|Astara Rayonu|Baki Sahari|Balakan Rayonu|Barda Rayonu|Beylaqan Rayonu|Bilasuvar Rayonu|Cabrayil Rayonu|Calilabad Rayonu|Daskasan Rayonu|Davaci Rayonu|Fuzuli Rayonu|Gadabay Rayonu|Ganca Sahari|Goranboy Rayonu|Goycay Rayonu|Haciqabul Rayonu|Imisli Rayonu|Ismayilli Rayonu|Kalbacar Rayonu|Kurdamir Rayonu|Lacin Rayonu|Lankaran Rayonu|Lankaran Sahari|Lerik Rayonu|Masalli Rayonu|Mingacevir Sahari|Naftalan Sahari|Naxcivan Muxtar Respublikasi|Neftcala Rayonu|Oguz Rayonu|Qabala Rayonu|Qax Rayonu|Qazax Rayonu|Qobustan Rayonu|Quba Rayonu|Qubadli Rayonu|Qusar Rayonu|Saatli Rayonu|Sabirabad Rayonu|Saki Rayonu|Saki Sahari|Salyan Rayonu|Samaxi Rayonu|Samkir Rayonu|Samux Rayonu|Siyazan Rayonu|Sumqayit Sahari|Susa Rayonu|Susa Sahari|Tartar Rayonu|Tovuz Rayonu|Ucar Rayonu|Xacmaz Rayonu|Xankandi Sahari|Xanlar Rayonu|Xizi Rayonu|Xocali Rayonu|Xocavand Rayonu|Yardimli Rayonu|Yevlax Rayonu|Yevlax Sahari|Zangilan Rayonu|Zaqatala Rayonu|Zardab Rayonu";
s_a[16] = "Acklins and Crooked Islands|Bimini|Cat Island|Exuma|Freeport|Fresh Creek|Governor' s Harbour | Green Turtle Cay | Harbour Island | High Rock | Inagua | Kemps Bay | Long Island | Marsh Harbour | Mayaguana | new Providence | Nicholls Town and Berry Islands | Ragged Island | Rock Sound | San Salvador and Rum Cay | Sandy Point ";
s_a[17] = " Al Hadd | Al Manamah | Al Mintaqah al Gharbiyah | Al Mintaqah al Wusta | Al Mintaqah ash Shamaliyah | Al Muharraq | Ar Rifa ' wa al Mintaqah al Janubiyah|Jidd Hafs|Juzur Hawar|Madinat ' Isa | Madinat Hamad | Sitrah ";
s_a[18] = " Barguna | Barisal | Bhola | Jhalokati | Patuakhali | Pirojpur | Bandarban | Brahmanbaria | Chandpur | Chittagong | Comilla | Cox 's Bazar|Feni|Khagrachari|Lakshmipur|Noakhali|Rangamati|Dhaka|Faridpur|Gazipur|Gopalganj|Jamalpur|Kishoreganj|Madaripur|Manikganj|Munshiganj|Mymensingh|Narayanganj|Narsingdi|Netrokona|Rajbari|Shariatpur|Sherpur|Tangail|Bagerhat|Chuadanga|Jessore|Jhenaidah|Khulna|Kushtia|Magura|Meherpur|Narail|Satkhira|Bogra|Dinajpur|Gaibandha|Jaipurhat|Kurigram|Lalmonirhat|Naogaon|Natore|Nawabganj|Nilphamari|Pabna|Panchagarh|Rajshahi|Rangpur|Sirajganj|Thakurgaon|Habiganj|Maulvi bazar|Sunamganj|Sylhet";
s_a[19] = "Bridgetown|Christ Church|Saint Andrew|Saint George|Saint James|Saint John|Saint Joseph|Saint Lucy|Saint Michael|Saint Peter|Saint Philip|Saint Thomas";
s_a[20] = "Brestskaya (Brest)|Homyel' skaya(Homyel ')|Horad Minsk|Hrodzyenskaya (Hrodna)|Mahilyowskaya (Mahilyow)|Minskaya|Vitsyebskaya (Vitsyebsk)";
s_a[21] = "Antwerpen|Brabant Wallon|Brussels Capitol Region|Hainaut|Liege|Limburg|Luxembourg|Namur|Oost-Vlaanderen|Vlaams Brabant|West-Vlaanderen";
s_a[22] = "Belize|Cayo|Corozal|Orange Walk|Stann Creek|Toledo";
s_a[23] = "Alibori|Atakora|Atlantique|Borgou|Collines|Couffo|Donga|Littoral|Mono|Oueme|Plateau|Zou";
s_a[24] = "Devonshire|Hamilton|Hamilton|Paget|Pembroke|Saint George|Saint Georges|Sandys|Smiths|Southampton|Warwick";
s_a[25] = "Bumthang|Chhukha|Chirang|Daga|Geylegphug|Ha|Lhuntshi|Mongar|Paro|Pemagatsel|Punakha|Samchi|Samdrup Jongkhar|Shemgang|Tashigang|Thimphu|Tongsa|Wangdi Phodrang";
s_a[26] = "Beni|Chuquisaca|Cochabamba|La Paz|Oruro|Pando|Potosi|Santa Cruz|Tarija";
s_a[27] = "Federation of Bosnia and Herzegovina|Republika Srpska";
s_a[28] = "Central|Chobe|Francistown|Gaborone|Ghanzi|Kgalagadi|Kgatleng|Kweneng|Lobatse|Ngamiland|North-East|Selebi-Pikwe|South-East|Southern";
s_a[29] = "Acre|Alagoas|Amapa|Amazonas|Bahia|Ceara|Distrito Federal|Espirito Santo|Goias|Maranhao|Mato Grosso|Mato Grosso do Sul|Minas Gerais|Para|Paraiba|Parana|Pernambuco|Piaui|Rio de Janeiro|Rio Grande do Norte|Rio Grande do Sul|Rondonia|Roraima|Santa Catarina|Sao Paulo|Sergipe|Tocantins";
s_a[30] = "Anegada|Jost Van Dyke|Tortola|Virgin Gorda";
s_a[31] = "Belait|Brunei and Muara|Temburong|Tutong";
s_a[32] = "Blagoevgrad|Burgas|Dobrich|Gabrovo|Khaskovo|Kurdzhali|Kyustendil|Lovech|Montana|Pazardzhik|Pernik|Pleven|Plovdiv|Razgrad|Ruse|Shumen|Silistra|Sliven|Smolyan|Sofiya|Sofiya-Grad|Stara Zagora|Turgovishte|Varna|Veliko Turnovo|Vidin|Vratsa|Yambol";
s_a[33] = "Bale|Bam|Banwa|Bazega|Bougouriba|Boulgou|Boulkiemde|Comoe|Ganzourgou|Gnagna|Gourma|Houet|Ioba|Kadiogo|Kenedougou|Komandjari|Kompienga|Kossi|Koupelogo|Kouritenga|Kourweogo|Leraba|Loroum|Mouhoun|Nahouri|Namentenga|Naumbiel|Nayala|Oubritenga|Oudalan|Passore|Poni|Samentenga|Sanguie|Seno|Sissili|Soum|Sourou|Tapoa|Tuy|Yagha|Yatenga|Ziro|Zondomo|Zoundweogo";
s_a[34] = "Ayeyarwady|Bago|Chin State|Kachin State|Kayah State|Kayin State|Magway|Mandalay|Mon State|Rakhine State|Sagaing|Shan State|Tanintharyi|Yangon";
s_a[35] = "Bubanza|Bujumbura|Bururi|Cankuzo|Cibitoke|Gitega|Karuzi|Kayanza|Kirundo|Makamba|Muramvya|Muyinga|Mwaro|Ngozi|Rutana|Ruyigi";
s_a[36] = "Banteay Mean Cheay|Batdambang|Kampong Cham|Kampong Chhnang|Kampong Spoe|Kampong Thum|Kampot|Kandal|Kaoh Kong|Keb|Kracheh|Mondol Kiri|Otdar Mean Cheay|Pailin|Phnum Penh|Pouthisat|Preah Seihanu (Sihanoukville)|Preah Vihear|Prey Veng|Rotanah Kiri|Siem Reab|Stoeng Treng|Svay Rieng|Takev";
s_a[37] = "Adamaoua|Centre|Est|Extreme-Nord|Littoral|Nord|Nord-Ouest|Ouest|Sud|Sud-Ouest";
s_a[38] = "Alberta|British Columbia|Manitoba|New Brunswick|Newfoundland|Northwest Territories|Nova Scotia|Nunavut|Ontario|Prince Edward Island|Quebec|Saskatchewan|Yukon Territory";
s_a[39] = "Boa Vista|Brava|Maio|Mosteiros|Paul|Porto Novo|Praia|Ribeira Grande|Sal|Santa Catarina|Santa Cruz|Sao Domingos|Sao Filipe|Sao Nicolau|Sao Vicente|Tarrafal";
s_a[40] = "Creek|Eastern|Midland|South Town|Spot Bay|Stake Bay|West End|Western";
s_a[41] = "Bamingui-Bangoran|Bangui|Basse-Kotto|Gribingui|Haut-Mbomou|Haute-Kotto|Haute-Sangha|Kemo-Gribingui|Lobaye|Mbomou|Nana-Mambere|Ombella-Mpoko|Ouaka|Ouham|Ouham-Pende|Sangha|Vakaga";
s_a[42] = "Batha|Biltine|Borkou-Ennedi-Tibesti|Chari-Baguirmi|Guera|Kanem|Lac|Logone Occidental|Logone Oriental|Mayo-Kebbi|Moyen-Chari|Ouaddai|Salamat|Tandjile";
s_a[43] = "Aisen del General Carlos Ibanez del Campo|Antofagasta|Araucania|Atacama|Bio-Bio|Coquimbo|Libertador General Bernardo O' Higgins | Los Lagos | Magallanes y de la Antartica Chilena | Maule | Region Metropolitana(Santiago) | Tarapaca | Valparaiso ";
s_a[44] = " Anhui | Beijing | Chongqing | Fujian | Gansu | Guangdong | Guangxi | Guizhou | Hainan | Hebei | Heilongjiang | Henan | Hubei | Hunan | Jiangsu | Jiangxi | Jilin | Liaoning | Nei Mongol | Ningxia | Qinghai | Shaanxi | Shandong | Shanghai | Shanxi | Sichuan | Tianjin | Xinjiang | Xizang(Tibet) | Yunnan | Zhejiang ";
s_a[45] = " Christmas Island ";
s_a[46] = " Clipperton Island ";
s_a[47] = " Direction Island | Home Island | Horsburgh Island | North Keeling Island | South Island | West Island ";
s_a[48] = " Amazonas | Antioquia | Arauca | Atlantico | Bolivar | Boyaca | Caldas | Caqueta | Casanare | Cauca | Cesar | Choco | Cordoba | Cundinamarca | Distrito Capital de Santa Fe de Bogota | Guainia | Guaviare | Huila | La Guajira | Magdalena | Meta | Narino | Norte de Santander | Putumayo | Quindio | Risaralda | San Andres y Providencia | Santander | Sucre | Tolima | Valle del Cauca | Vaupes | Vichada ";
// <!-- -->
s_a[49] = " Anjouan(Nzwani) | Domoni | Fomboni | Grande Comore(Njazidja) | Moheli(Mwali) | Moroni | Moutsamoudou ";
s_a[50] = " Bandundu | Bas - Congo | Equateur | Kasai - Occidental | Kasai - Oriental | Katanga | Kinshasa | Maniema | Nord - Kivu | Orientale | Sud - Kivu ";
s_a[51] = " Bouenza | Brazzaville | Cuvette | Kouilou | Lekoumou | Likouala | Niari | Plateaux | Pool | Sangha ";
s_a[52] = " Aitutaki | Atiu | Avarua | Mangaia | Manihiki | Manuae | Mauke | Mitiaro | Nassau Island | Palmerston | Penrhyn | Pukapuka | Rakahanga | Rarotonga | Suwarrow | Takutea ";
s_a[53] = " Alajuela | Cartago | Guanacaste | Heredia | Limon | Puntarenas | San Jose ";
s_a[54] = " Abengourou | Abidjan | Aboisso | Adiake '|Adzope|Agboville|Agnibilekrou|Ale' pe '|Bangolo|Beoumi|Biankouma|Bocanda|Bondoukou|Bongouanou|Bouafle|Bouake|Bouna|Boundiali|Dabakala|Dabon|Daloa|Danane|Daoukro|Dimbokro|Divo|Duekoue|Ferkessedougou|Gagnoa|Grand Bassam|Grand-Lahou|Guiglo|Issia|Jacqueville|Katiola|Korhogo|Lakota|Man|Mankono|Mbahiakro|Odienne|Oume|Sakassou|San-Pedro|Sassandra|Seguela|Sinfra|Soubre|Tabou|Tanda|Tiassale|Tiebissou|Tingrela|Touba|Toulepleu|Toumodi|Vavoua|Yamoussoukro|Zuenoula";
s_a[55] = "Bjelovarsko-Bilogorska Zupanija|Brodsko-Posavska Zupanija|Dubrovacko-Neretvanska Zupanija|Istarska Zupanija|Karlovacka Zupanija|Koprivnicko-Krizevacka Zupanija|Krapinsko-Zagorska Zupanija|Licko-Senjska Zupanija|Medimurska Zupanija|Osjecko-Baranjska Zupanija|Pozesko-Slavonska Zupanija|Primorsko-Goranska Zupanija|Sibensko-Kninska Zupanija|Sisacko-Moslavacka Zupanija|Splitsko-Dalmatinska Zupanija|Varazdinska Zupanija|Viroviticko-Podravska Zupanija|Vukovarsko-Srijemska Zupanija|Zadarska Zupanija|Zagreb|Zagrebacka Zupanija";
s_a[56] = "Camaguey|Ciego de Avila|Cienfuegos|Ciudad de La Habana|Granma|Guantanamo|Holguin|Isla de la Juventud|La Habana|Las Tunas|Matanzas|Pinar del Rio|Sancti Spiritus|Santiago de Cuba|Villa Clara";
s_a[57] = "Famagusta|Kyrenia|Larnaca|Limassol|Nicosia|Paphos";
s_a[58] = "Brnensky|Budejovicky|Jihlavsky|Karlovarsky|Kralovehradecky|Liberecky|Olomoucky|Ostravsky|Pardubicky|Plzensky|Praha|Stredocesky|Ustecky|Zlinsky";
s_a[59] = "Arhus|Bornholm|Fredericksberg|Frederiksborg|Fyn|Kobenhavn|Kobenhavns|Nordjylland|Ribe|Ringkobing|Roskilde|Sonderjylland|Storstrom|Vejle|Vestsjalland|Viborg";
s_a[60] = "' Ali Sabih | Dikhil | Djibouti | Obock | Tadjoura ";
s_a[61] = " Saint Andrew | Saint David | Saint George | Saint John | Saint Joseph | Saint Luke | Saint Mark | Saint Patrick | Saint Paul | Saint Peter ";
s_a[62] = " Azua | Baoruco | Barahona | Dajabon | Distrito Nacional | Duarte | El Seibo | Elias Pina | Espaillat | Hato Mayor | Independencia | La Altagracia | La Romana | La Vega | Maria Trinidad Sanchez | Monsenor Nouel | Monte Cristi | Monte Plata | Pedernales | Peravia | Puerto Plata | Salcedo | Samana | San Cristobal | San Juan | San Pedro de Macoris | Sanchez Ramirez | Santiago | Santiago Rodriguez | Valverde ";
// <!-- -->
s_a[63] = " Azuay | Bolivar | Canar | Carchi | Chimborazo | Cotopaxi | El Oro | Esmeraldas | Galapagos | Guayas | Imbabura | Loja | Los Rios | Manabi | Morona - Santiago | Napo | Orellana | Pastaza | Pichincha | Sucumbios | Tungurahua | Zamora - Chinchipe ";
s_a[64] = " Ad Daqahliyah | Al Bahr al Ahmar | Al Buhayrah | Al Fayyum | Al Gharbiyah | Al Iskandariyah | Al Isma 'iliyah|Al Jizah|Al Minufiyah|Al Minya|Al Qahirah|Al Qalyubiyah|Al Wadi al Jadid|As Suways|Ash Sharqiyah|Aswan|Asyut|Bani Suwayf|Bur Sa' id | Dumyat | Janub Sina '|Kafr ash Shaykh|Matruh|Qina|Shamal Sina' | Suhaj ";
s_a[65] = " Ahuachapan | Cabanas | Chalatenango | Cuscatlan | La Libertad | La Paz | La Union | Morazan | San Miguel | San Salvador | San Vicente | Santa Ana | Sonsonate | Usulutan ";
s_a[66] = " Annobon | Bioko Norte | Bioko Sur | Centro Sur | Kie - Ntem | Litoral | Wele - Nzas ";
s_a[67] = " Akale Guzay | Barka | Denkel | Hamasen | Sahil | Semhar | Senhit | Seraye ";
s_a[68] = " Harjumaa(Tallinn) | Hiiumaa(Kardla) | Ida - Virumaa(Johvi) | Jarvamaa(Paide) | Jogevamaa(Jogeva) | Laane - Virumaa(Rakvere) | Laanemaa(Haapsalu) | Parnumaa(Parnu) | Polvamaa(Polva) | Raplamaa(Rapla) | Saaremaa(Kuessaare) | Tartumaa(Tartu) | Valgamaa(Valga) | Viljandimaa(Viljandi) | Vorumaa(Voru) "
s_a[69] = " Adis Abeba(Addis Ababa) | Afar | Amara | Dire Dawa | Gambela Hizboch | Hareri Hizb | Oromiya | Sumale | Tigray | YeDebub Biheroch Bihereseboch na Hizboch ";
s_a[70] = " Europa Island ";
s_a[71] = " Falkland Islands(Islas Malvinas) "
s_a[72] = " Bordoy | Eysturoy | Mykines | Sandoy | Skuvoy | Streymoy | Suduroy | Tvoroyri | Vagar ";
s_a[73] = " Central | Eastern | Northern | Rotuma | Western ";
s_a[74] = " Aland | Etela - Suomen Laani | Ita - Suomen Laani | Lansi - Suomen Laani | Lappi | Oulun Laani ";
s_a[75] = " Alsace | Aquitaine | Auvergne | Basse - Normandie | Bourgogne | Bretagne | Centre | Champagne - Ardenne | Corse | Franche - Comte | Haute - Normandie | Ile - de - France | Languedoc - Roussillon | Limousin | Lorraine | Midi - Pyrenees | Nord - Pas - de - Calais | Pays de la Loire | Picardie | Poitou - Charentes | Provence - Alpes - Cote d 'Azur|Rhone-Alpes";
s_a[76] = "French Guiana";
s_a[77] = "Archipel des Marquises|Archipel des Tuamotu|Archipel des Tubuai|Iles du Vent|Iles Sous-le-Vent";
s_a[78] = "Adelie Land|Ile Crozet|Iles Kerguelen|Iles Saint-Paul et Amsterdam";
s_a[79] = "Estuaire|Haut-Ogooue|Moyen-Ogooue|Ngounie|Nyanga|Ogooue-Ivindo|Ogooue-Lolo|Ogooue-Maritime|Woleu-Ntem";
s_a[80] = "Banjul|Central River|Lower River|North Bank|Upper River|Western";
s_a[81] = "Gaza Strip";
s_a[82] = "Abashis|Abkhazia or Ap' khazet 'is Avtonomiuri Respublika (Sokhumi)|Adigenis|Ajaria or Acharis Avtonomiuri Respublika (Bat' umi) | Akhalgoris | Akhalk 'alak' is | Akhalts 'ikhis|Akhmetis|Ambrolauris|Aspindzis|Baghdat' is | Bolnisis | Borjomis | Ch 'khorotsqus|Ch' okhatauris | Chiat 'ura|Dedop' listsqaros | Dmanisis | Dushet 'is|Gardabanis|Gori|Goris|Gurjaanis|Javis|K' arelis | K 'ut' aisi | Kaspis | Kharagaulis | Khashuris | Khobis | Khonis | Lagodekhis | Lanch 'khut' is | Lentekhis | Marneulis | Martvilis | Mestiis | Mts 'khet' is | Ninotsmindis | Onis | Ozurget 'is|P' ot 'i|Qazbegis|Qvarlis|Rust' avi | Sach 'kheris|Sagarejos|Samtrediis|Senakis|Sighnaghis|T' bilisi | T 'elavis|T' erjolis | T 'et' ritsqaros | T 'ianet' is | Tqibuli | Ts 'ageris|Tsalenjikhis|Tsalkis|Tsqaltubo|Vanis|Zestap' onis | Zugdidi | Zugdidis ";
s_a[83] = " Baden - Wuerttemberg | Bayern | Berlin | Brandenburg | Bremen | Hamburg | Hessen | Mecklenburg - Vorpommern | Niedersachsen | Nordrhein - Westfalen | Rheinland - Pfalz | Saarland | Sachsen | Sachsen - Anhalt | Schleswig - Holstein | Thueringen ";
s_a[84] = " Ashanti | Brong - Ahafo | Central | Eastern | Greater Accra | Northern | Upper East | Upper West | Volta | Western ";
s_a[85] = " Gibraltar ";
s_a[86] = " Ile du Lys | Ile Glorieuse ";
s_a[87] = " Aitolia kai Akarnania | Akhaia | Argolis | Arkadhia | Arta | Attiki | Ayion Oros(Mt . Athos) | Dhodhekanisos | Drama | Evritania | Evros | Evvoia | Florina | Fokis | Fthiotis | Grevena | Ilia | Imathia | Ioannina | Irakleion | Kardhitsa | Kastoria | Kavala | Kefallinia | Kerkyra | Khalkidhiki | Khania | Khios | Kikladhes | Kilkis | Korinthia | Kozani | Lakonia | Larisa | Lasithi | Lesvos | Levkas | Magnisia | Messinia | Pella | Pieria | Preveza | Rethimni | Rodhopi | Samos | Serrai | Thesprotia | Thessaloniki | Trikala | Voiotia | Xanthi | Zakinthos ";
s_a[88] = " Avannaa(Nordgronland) | Kitaa(Vestgronland) | Tunu(Ostgronland) "
s_a[89] = " Carriacou and Petit Martinique | Saint Andrew | Saint David | Saint George | Saint John | Saint Mark | Saint Patrick ";
s_a[90] = " Basse - Terre | Grande - Terre | Iles de la Petite Terre | Iles des Saintes | Marie - Galante ";
s_a[91] = " Guam ";
s_a[92] = " Alta Verapaz | Baja Verapaz | Chimaltenango | Chiquimula | El Progreso | Escuintla | Guatemala | Huehuetenango | Izabal | Jalapa | Jutiapa | Peten | Quetzaltenango | Quiche | Retalhuleu | Sacatepequez | San Marcos | Santa Rosa | Solola | Suchitepequez | Totonicapan | Zacapa ";
s_a[93] = " Castel | Forest | St . Andrew | St . Martin | St . Peter Port | St . Pierre du Bois | St . Sampson | St . Saviour | Torteval | Vale ";
s_a[94] = " Beyla | Boffa | Boke | Conakry | Coyah | Dabola | Dalaba | Dinguiraye | Dubreka | Faranah | Forecariah | Fria | Gaoual | Gueckedou | Kankan | Kerouane | Kindia | Kissidougou | Koubia | Koundara | Kouroussa | Labe | Lelouma | Lola | Macenta | Mali | Mamou | Mandiana | Nzerekore | Pita | Siguiri | Telimele | Tougue | Yomou ";
s_a[95] = " Bafata | Biombo | Bissau | Bolama - Bijagos | Cacheu | Gabu | Oio | Quinara | Tombali ";
s_a[96] = " Barima - Waini | Cuyuni - Mazaruni | Demerara - Mahaica | East Berbice - Corentyne | Essequibo Islands - West Demerara | Mahaica - Berbice | Pomeroon - Supenaam | Potaro - Siparuni | Upper Demerara - Berbice | Upper Takutu - Upper Essequibo ";
s_a[97] = " Artibonite | Centre | Grand 'Anse|Nord|Nord-Est|Nord-Ouest|Ouest|Sud|Sud-Est";
s_a[98] = "Heard Island and McDonald Islands";
s_a[99] = "Holy See (Vatican City)"
s_a[100] = "Atlantida|Choluteca|Colon|Comayagua|Copan|Cortes|El Paraiso|Francisco Morazan|Gracias a Dios|Intibuca|Islas de la Bahia|La Paz|Lempira|Ocotepeque|Olancho|Santa Barbara|Valle|Yoro";
s_a[101] = "Hong Kong";
s_a[102] = "Howland Island";
s_a[103] = "Bacs-Kiskun|Baranya|Bekes|Bekescsaba|Borsod-Abauj-Zemplen|Budapest|Csongrad|Debrecen|Dunaujvaros|Eger|Fejer|Gyor|Gyor-Moson-Sopron|Hajdu-Bihar|Heves|Hodmezovasarhely|Jasz-Nagykun-Szolnok|Kaposvar|Kecskemet|Komarom-Esztergom|Miskolc|Nagykanizsa|Nograd|Nyiregyhaza|Pecs|Pest|Somogy|Sopron|Szabolcs-Szatmar-Bereg|Szeged|Szekesfehervar|Szolnok|Szombathely|Tatabanya|Tolna|Vas|Veszprem|Veszprem|Zala|Zalaegerszeg";
s_a[104] = "Akranes|Akureyri|Arnessysla|Austur-Bardhastrandarsysla|Austur-Hunavatnssysla|Austur-Skaftafellssysla|Borgarfjardharsysla|Dalasysla|Eyjafjardharsysla|Gullbringusysla|Hafnarfjordhur|Husavik|Isafjordhur|Keflavik|Kjosarsysla|Kopavogur|Myrasysla|Neskaupstadhur|Nordhur-Isafjardharsysla|Nordhur-Mulasys-la|Nordhur-Thingeyjarsysla|Olafsfjordhur|Rangarvallasysla|Reykjavik|Saudharkrokur|Seydhisfjordhur|Siglufjordhur|Skagafjardharsysla|Snaefellsnes-og Hnappadalssysla|Strandasysla|Sudhur-Mulasysla|Sudhur-Thingeyjarsysla|Vesttmannaeyjar|Vestur-Bardhastrandarsysla|Vestur-Hunavatnssysla|Vestur-Isafjardharsysla|Vestur-Skaftafellssysla";
s_a[105] = "Andaman and Nicobar Islands|Andhra Pradesh|Arunachal Pradesh|Assam|Bihar|Chandigarh|Chhattisgarh|Dadra and Nagar Haveli|Daman and Diu|Delhi|Goa|Gujarat|Haryana|Himachal Pradesh|Jammu and Kashmir|Jharkhand|Karnataka|Kerala|Lakshadweep|Madhya Pradesh|Maharashtra|Manipur|Meghalaya|Mizoram|Nagaland|Orissa|Pondicherry|Punjab|Rajasthan|Sikkim|Tamil Nadu|Tripura|Uttar Pradesh|Uttaranchal|West Bengal";


var c_a = new Array();
c_a[0] = "";
c_a[1] = "Adoni|Agra|Ahmedabad|Ahmednagar|Ajmer|Akola|Alappuzha/Allepey|Alibaug|Aligarh|Allahabad|Almora|Alwar|Ambikapur|Amravati|Amritsar|Anand|Ankleshwar|Asansol|Auli|Aurangabad|Badami|Badrinath|Bagar|Balrampur";
c_a[2] = "2doni|Agra|Ahmedabad|Ahmednagar|Ajmer|Akola|Alappuzha/Allepey|Alibaug|Aligarh|Allahabad|Almora|Alwar|Ambikapur|Amravati|Amritsar|Anand|Ankleshwar|Asansol|Auli|Aurangabad|Badami|Badrinath|Bagar|Balrampur";
c_a[3] = "3doni|Agra|Ahmedabad|Ahmednagar|Ajmer|Akola|Alappuzha/Allepey|Alibaug|Aligarh|Allahabad|Almora|Alwar|Ambikapur|Amravati|Amritsar|Anand|Ankleshwar|Asansol|Auli|Aurangabad|Badami|Badrinath|Bagar|Balrampur";
c_a[4] = "4doni|Agra|Ahmedabad|Ahmednagar|Ajmer|Akola|Alappuzha/Allepey|Alibaug|Aligarh|Allahabad|Almora|Alwar|Ambikapur|Amravati|Amritsar|Anand|Ankleshwar|Asansol|Auli|urangabad|Badami|Badrinath|Bagar|Balrampur";

function print_country(country_id) {
    // given the id of the <select> tag as function argument, it inserts <option> tags
    var option_str = document.getElementById(country_id);
    option_str.length = 0;
    option_str.options[0] = new Option(' Select Country ', ' ');
    option_str.selectedIndex = 0;
    for (var i = 0; i < country_arr.length; i++) {
        option_str.options[option_str.length] = new Option(country_arr[i], country_arr[i]);
    }
}

function print_state(state_id, state_index) {
    var option_str = document.getElementById(state_id);
    option_str.length = 0; // Fixed by Julian Woods
    option_str.options[0] = new Option(' Select State ', ' ');
    option_str.selectedIndex = 0;
    console.log(state_index);
    var state_arr = s_a[state_index].split("|");

    for (var i = 0; i < state_arr.length; i++) {
        option_str.options[option_str.length] = new Option(state_arr[i], state_arr[i]);
    }
}

function print_cities(city_id, city_index) {
    var option_str = document.getElementById(city_id);
    option_str.length = 0; // Fixed by Julian Woods
    option_str.options[0] = new Option(' Select City ', ' ');
    option_str.selectedIndex = 0;
    console.log(city_index);
    var city_arr = c_a[city_index].split("|");
    for (var i = 0; i < city_arr.length; i++) {
        option_str.options[option_str.length] = new Option(city_arr[i], city_arr[i]);
    }
}
    </script>
    <div><select onchange="print_state(' states ',this.selectedIndex);" name="country" id="country"></select>
       <script type="text/javascript" language="javascript">
           print_country("country");
       </script>
       </div>
       <div>
       <select onchange="print_cities(' cities ',this.selectedIndex);" name="state" id="states"></select>
       <script type="text/javascript" language="javascript">
           print_state("states");
       </script>
       </div>
       <div>
       <select name="city" id="cities"></select>
       <script type="text/javascript" language="javascript">
           print_cities("cities");
       </script>
       </div>
    <?php

}

function state_city()
{
    $list = array(
        ' Andaman and Nicobar ' => array(
            ' North and Middle Andaman ', ' South Andaman ', ' Nicobar '
        ),
        ' Andhra Pradesh ' => array(
            ' Adilabad ', ' Anantapur ', ' Chittoor ', ' East Godavari ', ' Guntur ', ' Hyderabad ', ' Kadapa ', ' Karimnagar ', ' Khammam ', ' Krishna ', ' Kurnool ', ' Mahbubnagar ', ' Medak ', ' Nalgonda ', ' Nellore ', ' Nizamabad ', ' Prakasam ', ' Rangareddi ', ' Srikakulam ', ' Vishakhapatnam ', ' Vizianagaram ', ' Warangal ', ' West Godavari '
        ),
        ' Arunachal Pradesh ' => array(
            ' Anjaw ', ' Changlang ', ' East Kameng ', ' Lohit ', ' Lower Subansiri ', ' Papum Pare ', ' Tirap ', ' Dibang Valley ', ' Upper Subansiri ', ' West Kameng '
        ),
        ' Assam ' => array(
            ' Barpeta ', ' Bongaigaon ', ' Cachar ', ' Darrang ', ' Dhemaji ', ' Dhubri ', ' Dibrugarh ', ' Goalpara ', ' Golaghat ', ' Hailakandi ', ' Jorhat ', ' Karbi Anglong ', ' Karimganj ', ' Kokrajhar ', ' Lakhimpur ', ' Marigaon ', ' Nagaon ', ' Nalbari ', ' North Cachar Hills ', ' Sibsagar ', ' Sonitpur ', ' Tinsukia '
        ),
        ' Bihar ' => array(
            ' Araria ', ' Aurangabad ', ' Banka ', ' Begusarai ', ' Bhagalpur ', ' Bhojpur ', ' Buxar ', ' Darbhanga ', ' Purba Champaran ', ' Gaya ', ' Gopalganj ', ' Jamui ', ' Jehanabad ', ' Khagaria ', ' Kishanganj ', ' Kaimur ', ' Katihar ', ' Lakhisarai ', ' Madhubani ', ' Munger ', ' Madhepura ', ' Muzaffarpur ', ' Nalanda ', ' Nawada ', ' Patna ', ' Purnia ', ' Rohtas ', ' Saharsa ', ' Samastipur ', ' Sheohar ', ' Sheikhpura ', ' Saran ', ' Sitamarhi ', ' Supaul ', ' Siwan ', ' Vaishali ', ' Pashchim Champaran '
        ),
        ' Chandigarh ' => array(),
        ' Chhattisgarh ' => array(
            ' Bastar ', ' Bilaspur ', ' Dantewada ', ' Dhamtari ', ' Durg ', ' Jashpur ', ' Janjgir - Champa ', ' Korba ', ' Koriya ', ' Kanker ', ' Kawardha ', ' Mahasamund ', ' Raigarh ', ' Rajnandgaon ', ' Raipur ', ' Surguja '
        ),
        ' Dadra and Nagar Haveli ' => array(),
        ' Daman and Diu ' => array(
            ' Diu ', ' Daman '
        ),
        ' Delhi ' => array(
            ' Central Delhi ', ' East Delhi ', ' new Delhi ', ' North Delhi ', ' North East Delhi ', ' North West Delhi ', ' South Delhi ', ' South West Delhi ', ' West Delhi '
        ),
        ' Goa ' => array(
            ' North Goa ', ' South Goa '
        ),
        ' Gujarat ' => array(
            ' Ahmedabad ', ' Amreli District ', ' Anand ', ' Banaskantha ', ' Bharuch ', ' Bhavnagar ', ' Dahod ', ' The Dangs ', ' Gandhinagar ', ' Jamnagar ', ' Junagadh ', ' Kutch ', ' Kheda ', ' Mehsana ', ' Narmada ', ' Navsari ', ' Patan ', ' Panchmahal ', ' Porbandar ', ' Rajkot ', ' Sabarkantha ', ' Surendranagar ', ' Surat ', ' Vadodara ', ' Valsad '
        ),
        ' Haryana ' => array(
            ' Ambala ', ' Bhiwani ', ' Faridabad ', ' Fatehabad ', ' Gurgaon ', ' Hissar ', ' Jhajjar ', ' Jind ', ' Karnal ', ' Kaithal ', ' Kurukshetra ', ' Mahendragarh ', ' Mewat ', ' Panchkula ', ' Panipat ', ' Rewari ', ' Rohtak ', ' Sirsa ', ' Sonepat ', ' Yamuna Nagar ', ' Palwal '
        ),
        ' Himachal Pradesh ' => array(
            ' Bilaspur ', ' Chamba ', ' Hamirpur ', ' Kangra ', ' Kinnaur ', ' Kulu ', ' Lahaul and Spiti ', ' Mandi ', ' Shimla ', ' Sirmaur ', ' Solan ', ' Una '
        ),
        ' Jammu and Kashmir ' => array(
            ' Anantnag ', ' Badgam ', ' Bandipore ', ' Baramula ', ' Doda ', ' Jammu ', ' Kargil ', ' Kathua ', ' Kupwara ', ' Leh ', ' Poonch ', ' Pulwama ', ' Rajauri ', ' Srinagar ', ' Samba ', ' Udhampur '
        ),
        ' Jharkhand ' => array(
            ' Bokaro ', ' Chatra ', ' Deoghar ', ' Dhanbad ', ' Dumka ', ' Purba Singhbhum ', ' Garhwa ', ' Giridih ', ' Godda ', ' Gumla ', ' Hazaribagh ', ' Koderma ', ' Lohardaga ', ' Pakur ', ' Palamu ', ' Ranchi ', ' Sahibganj ', ' Seraikela and Kharsawan ', ' Pashchim Singhbhum ', ' Ramgarh '
        ),
        ' Karnataka ' => array(
            ' Bidar ', ' Belgaum ', ' Bijapur ', ' Bagalkot ', ' Bellary ', ' Bangalore Rural District ', ' Bangalore Urban District ', ' Chamarajnagar ', ' Chikmagalur ', ' Chitradurga ', ' Davanagere ', ' Dharwad ', ' Dakshina Kannada ', ' Gadag ', ' Gulbarga ', ' Hassan ', ' Haveri District ', ' Kodagu ', ' Kolar ', ' Koppal ', ' Mandya ', ' Mysore ', ' Raichur ', ' Shimoga ', ' Tumkur ', ' Udupi ', ' Uttara Kannada ', ' Ramanagara ', ' Chikballapur ', ' Yadagiri '
        ),
        ' Kerala ' => array(
            ' Alappuzha ', ' Ernakulam ', ' Idukki ', ' Kollam ', ' Kannur ', ' Kasaragod ', ' Kottayam ', ' Kozhikode ', ' Malappuram ', ' Palakkad ', ' Pathanamthitta ', ' Thrissur ', ' Thiruvananthapuram ', ' Wayanad '
        ),
        ' Lakshadweep ' => array(),
        ' Madhya Pradesh ' => array(
            ' Alirajpur ', ' Anuppur ', ' Ashok Nagar ', ' Balaghat ', ' Barwani ', ' Betul ', ' Bhind ', ' Bhopal ', ' Burhanpur ', ' Chhatarpur ', ' Chhindwara ', ' Damoh ', ' Datia ', ' Dewas ', ' Dhar ', ' Dindori ', ' Guna ', ' Gwalior ', ' Harda ', ' Hoshangabad ', ' Indore ', ' Jabalpur ', ' Jhabua ', ' Katni ', ' Khandwa ', ' Khargone ', ' Mandla ', ' Mandsaur ', ' Morena ', ' Narsinghpur ', ' Neemuch ', ' Panna ', ' Rewa ', ' Rajgarh ', ' Ratlam ', ' Raisen ', ' Sagar ', ' Satna ', ' Sehore ', ' Seoni ', ' Shahdol ', ' Shajapur ', ' Sheopur ', ' Shivpuri ', ' Sidhi ', ' Singrauli ', ' Tikamgarh ', ' Ujjain ', ' Umaria ', ' Vidisha '
        ),
        ' Maharashtra ' => array(
            ' Ahmednagar ', ' Akola ', ' Amrawati ', ' Aurangabad ', ' Bhandara ', ' Beed ', ' Buldhana ', ' Chandrapur ', ' Dhule ', ' Gadchiroli ', ' Gondiya ', ' Hingoli ', ' Jalgaon ', ' Jalna ', ' Kolhapur ', ' Latur ', ' Mumbai City ', ' Mumbai suburban ', ' Nandurbar ', ' Nanded ', ' Nagpur ', ' Nashik ', ' Osmanabad ', ' Parbhani ', ' Pune ', ' Raigad ', ' Ratnagiri ', ' Sindhudurg ', ' Sangli ', ' Solapur ', ' Satara ', ' Thane ', ' Wardha ', ' Washim ', ' Yavatmal '
        ),
        ' Manipur ' => array(
            ' Bishnupur ', ' Churachandpur ', ' Chandel ', ' Imphal East ', ' Senapati ', ' Tamenglong ', ' Thoubal ', ' Ukhrul ', ' Imphal West '
        ),
        ' Meghalaya ' => array(
            ' East Garo Hills ', ' East Khasi Hills ', ' Jaintia Hills ', ' Ri - Bhoi ', ' South Garo Hills ', ' West Garo Hills ', ' West Khasi Hills '
        ),
        ' Mizoram ' => array(
            ' Aizawl ', ' Champhai ', ' Kolasib ', ' Lawngtlai ', ' Lunglei ', ' Mamit ', ' Saiha ', ' Serchhip '
        ),
        ' Nagaland ' => array(
            ' Dimapur ', ' Kohima ', ' Mokokchung ', ' Mon ', ' Phek ', ' Tuensang ', ' Wokha ', ' Zunheboto '
        ),
        ' Orissa ' => array(
            ' Angul ', ' Boudh ', ' Bhadrak ', ' Bolangir ', ' Bargarh ', ' Baleswar ', ' Cuttack ', ' Debagarh ', ' Dhenkanal ', ' Ganjam ', ' Gajapati ', ' Jharsuguda ', ' Jajapur ', ' Jagatsinghpur ', ' Khordha ', ' Kendujhar ', ' Kalahandi ', ' Kandhamal ', ' Koraput ', ' Kendrapara ', ' Malkangiri ', ' Mayurbhanj ', ' Nabarangpur ', ' Nuapada ', ' Nayagarh ', ' Puri ', ' Rayagada ', ' Sambalpur ', ' Subarnapur ', ' Sundargarh '
        ),
        ' Puducherry ' => array(
            ' Karaikal ', ' Mahe ', ' Puducherry ', ' Yanam '
        ),
        ' Punjab ' => array(
            ' Amritsar ', ' Bathinda ', ' Firozpur ', ' Faridkot ', ' Fatehgarh Sahib ', ' Gurdaspur ', ' Hoshiarpur ', ' Jalandhar ', ' Kapurthala ', ' Ludhiana ', ' Mansa ', ' Moga ', ' Mukatsar ', ' Nawan Shehar ', ' Patiala ', ' Rupnagar ', ' Sangrur '
        ),
        ' Rajasthan ' => array(
            ' Ajmer ', ' Alwar ', ' Bikaner ', ' Barmer ', ' Banswara ', ' Bharatpur ', ' Baran ', ' Bundi ', ' Bhilwara ', ' Churu ', ' Chittorgarh ', ' Dausa ', ' Dholpur ', ' Dungapur ', ' Ganganagar ', ' Hanumangarh ', ' Juhnjhunun ', ' Jalore ', ' Jodhpur ', ' Jaipur ', ' Jaisalmer ', ' Jhalawar ', ' Karauli ', ' Kota ', ' Nagaur ', ' Pali ', ' Pratapgarh ', ' Rajsamand ', ' Sikar ', ' Sawai Madhopur ', ' Sirohi ', ' Tonk ', ' Udaipur '
        ),
        ' Sikkim ' => array(
            ' East Sikkim ', ' North Sikkim ', ' South Sikkim ', ' West Sikkim '
        ),
        ' Tamil Nadu ' => array(
            ' Ariyalur ', ' Chennai ', ' Coimbatore ', ' Cuddalore ', ' Dharmapuri ', ' Dindigul ', ' Erode ', ' Kanchipuram ', ' Kanyakumari ', ' Karur ', ' Madurai ', ' Nagapattinam ', ' The Nilgiris ', ' Namakkal ', ' Perambalur ', ' Pudukkottai ', ' Ramanathapuram ', ' Salem ', ' Sivagangai ', ' Tiruppur ', ' Tiruchirappalli ', ' Theni ', ' Tirunelveli ', ' Thanjavur ', ' Thoothukudi ', ' Thiruvallur ', ' Thiruvarur ', ' Tiruvannamalai ', ' Vellore ', ' Villupuram '
        ),
        ' Tripura ' => array(
            ' Dhalai ', ' North Tripura ', ' South Tripura ', ' West Tripura '
        ),
        ' Uttarakhand ' => array(
            ' Almora ', ' Bageshwar ', ' Chamoli ', ' Champawat ', ' Dehradun ', ' Haridwar ', ' Nainital ', ' Pauri Garhwal ', ' Pithoragharh ', ' Rudraprayag ', ' Tehri Garhwal ', ' Udham Singh Nagar ', ' Uttarkashi '
        ),
        ' Uttar Pradesh ' => array(
            ' Agra ', ' Allahabad ', ' Aligarh ', ' Ambedkar Nagar ', ' Auraiya ', ' Azamgarh ', ' Barabanki ', ' Badaun ', ' Bagpat ', ' Bahraich ', ' Bijnor ', ' Ballia ', ' Banda ', ' Balrampur ', ' Bareilly ', ' Basti ', ' Bulandshahr ', ' Chandauli ', ' Chitrakoot ', ' Deoria ', ' Etah ', ' Kanshiram Nagar ', ' Etawah ', ' Firozabad ', ' Farrukhabad ', ' Fatehpur ', ' Faizabad ', ' Gautam Buddha Nagar ', ' Gonda ', ' Ghazipur ', ' Gorkakhpur ', ' Ghaziabad ', ' Hamirpur ', ' Hardoi ', ' Mahamaya Nagar ', ' Jhansi ', ' Jalaun ', ' Jyotiba Phule Nagar ', ' Jaunpur District ', ' Kanpur Dehat ', ' Kannauj ', ' Kanpur Nagar ', ' Kaushambi ', ' Kushinagar ', ' Lalitpur ', ' Lakhimpur Kheri ', ' Lucknow ', ' Mau ', ' Meerut ', ' Maharajganj ', ' Mahoba ', ' Mirzapur ', ' Moradabad ', ' Mainpuri ', ' Mathura ', ' Muzaffarnagar ', ' Pilibhit ', ' Pratapgarh ', ' Rampur ', ' Rae Bareli ', ' Saharanpur ', ' Sitapur ', ' Shahjahanpur ', ' Sant Kabir Nagar ', ' Siddharthnagar ', ' Sonbhadra ', ' Sant Ravidas Nagar ', ' Sultanpur ', ' Shravasti ', ' Unnao ', ' Varanasi '
        ),
        ' West Bengal ' => array(
            ' Birbhum ', ' Bankura ', ' Bardhaman ', ' Darjeeling ', ' Dakshin Dinajpur ', ' Hooghly ', ' Howrah ', ' Jalpaiguri ', ' Cooch Behar ', ' Kolkata ', ' Malda ', ' Midnapore ', ' Murshidabad ', ' Nadia ', ' North 24 Parganas ', ' South 24 Parganas ', ' Purulia ', ' Uttar Dinajpur'
        )
    );
    return $list;
}
/*
function wp78649_extend_search( $query ) {
    $search_term = filter_input( INPUT_GET, 's', FILTER_SANITIZE_NUMBER_INT) ?: 0;
    //var_dump($search_term);
//&& //your extra condition
    if (
        $query->is_search
        && !is_admin()
        && $query->is_main_query()
        && $_GET['post_type']=='contacts_database'
    ) {
        $query->set('meta_query', [
            [
                'key' => 'meta_key',
                'value' => $search_term,
                'compare' => '='
            ]
        ]);

        add_filter( 'get_meta_sql', function( $sql )
        {
            global $wpdb;
            var_dump($sql);

            static $nr = 0;
            if( 0 != $nr++ ) return $sql;
            var_dump($sql);
            $sql['where'] = mb_eregi_replace( '^ AND', ' OR', $sql['where']);

            return $sql;
        });
    }
    return $query;
}
add_action( 'pre_get_posts', 'wp78649_extend_search');
*/
function search_contact_database($query){
    $q1 = get_posts(array(
        'fields' => 'ids',
        'post_type' => 'contacts_database',
        's' => $query,
    ));

    $q2 = get_posts(array(
        'fields' => 'ids',
        'post_type' => 'contacts_database',
        'meta_query' => array(
            array(
                'key' => 'url_info',
                'value' => $query,
                'compare' => 'LIKE',
            ),
            array(
                'key' => 'email_info',
                'value' => $query,
                'compare' => 'LIKE'
            ), array(
                'key' => 'phone_info',
                'value' => $query,
                'compare' => 'LIKE'
            ),
        ),
    ));
var_dump($q1);
var_dump($q2);
    $unique = array_unique(array_merge($q1 , $q2));
    var_dump($unique);

    $posts = get_posts(array(
        'post_type' => 'contacts_database',
        'post__in' => $unique,
        'post_status' => 'publish',
        'posts_per_page' => -1,
    ));
    return $posts;
}


add_action('wp_ajax_nopriv_ajax_success_story_val', 'success_story_val');
add_action('wp_ajax_ajax_success_story_val', 'success_story_val');
function success_story_val(){
    global $wpdb;
    $table_name = $wpdb->prefix . 'success_story';
    $fullname = $_REQUEST['fullname'];
    $email = $_REQUEST['email'];
    $success_story = $_REQUEST['success_story'];
    $email = $_REQUEST['email'];
    $post_id = $_REQUEST['post_id'];
    $solutions_library = $_REQUEST['solutions_library'];
    
    $sql = "insert into ". $table_name." set name='".$fullname."',email='".$email."',story='".$success_story."',post_id='".($post_id==''?0:$post_id)."',solutions_library='".$solutions_library."'";
   // echo $sql;
   if($wpdb->query($sql)){
       echo 1;
   }else{
       echo 0;
   }
    //var_dump($_REQUEST);
    die(0);
}

add_action('evolve_before_content_area','try_to_recover_page_name');
function try_to_recover_page_name(){
  // echo $_SERVER['PHP_SELF'];
}


function get_url_by_slug($slug) {
    $page_url_id = get_page_by_path( $slug );
    $page_url_link = get_permalink($page_url_id);
    return $page_url_link;
}

/*wp color picker*/

add_action( 'admin_enqueue_scripts', 'my_color_picker' );
function my_color_picker() {
wp_enqueue_script( 'iris',get_stylesheet_directory_uri().'/js/iris.min.js' );
wp_enqueue_script( 'iris-init',get_stylesheet_directory_uri().'/js/iris-init.js' );
/**select box*/

wp_enqueue_script( 'select-bundle','https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.bundle.min.js' );
wp_enqueue_script( 'select-init',get_stylesheet_directory_uri().'/admin/js/bootstrap-select.min.js' );

}




add_action( 'admin_head-edit-tags.php', 'wpse_58799_remove_parent_category' );

function wpse_58799_remove_parent_category()
{
    if ( 'category' != $_GET['taxonomy'] )
        return;

    $parent = 'parent()';

    if ( isset( $_GET['action'] ) )
        $parent = 'parent().parent()';

    ?>
        <script type="text/javascript">
            jQuery(document).ready(function($)
            {     
                $('label[for=parent]').<?php echo $parent; ?>.remove();       
            });
        </script>
    <?php
}


//add_action( 'admin_enqueue_scripts', 'mw_enqueue_color_picker' );
function mw_enqueue_color_picker( $hook_suffix ) {
   
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'my-script-handle', get_stylesheet_directory_uri().'/js/color.js', array( 'wp-color-picker' ), false, true );

}




function check_page_settings($page_option='evolve_page_top_banner'){
    $frontpage_id = get_option( 'page_on_front' );
    $sidebar_position = get_post_meta( get_the_id(), $page_option, true );
    return $sidebar_position;
}
function return_array_for_scroller(){
    $arr['General'] = 'General Recommendation';
    $arr['Estimated Cost'] = 'Estimated Cost';
    $arr['Materials Required'] = 'Materials Required';
    $arr['Procedure'] = 'Procedure';
    $arr['Expected Results'] = 'Expected Results';
    return $arr;
}
function left_menu_scroller(){
    ob_start();
    ?>
    <nav class="scroll">
  <ul id="mainNav">
  <?php
  $arr = return_array_for_scroller();
  $i=1;
  foreach($arr as $k=>$vall){
   $k = str_replace(' ','_',$k);
   $k = strtolower($k);
  ?>
    <li class="<?php echo ($i==1?'active':'')?>"><a href="#<?php echo $k;?>"><?php echo $vall;?></a></li>
    <?php
    $i++;
  }
    ?>   
  </ul>
</nav>
    <?php
    $content1 = ob_get_contents();
    return $content1;
}
function count_success_story($pid){
    global $wpdb;
    $sql = "select * from wp_success_story where post_id='".$pid."'";
    $results = $wpdb->get_results($sql);
   // var_dump($results);
}
function tag_cloud($tag){

    $taxonomies = array( $tag );
$args = array(
    'orderby' => 'name',
    'order' => 'ASC',
    'hide_empty' => false
);

$terms = get_terms($taxonomies,$args);

if (count($terms) > 0):
$i = 0;
    foreach ($terms as $term): ?>
    <?php //var_dump($term);?>
        <div class="wissen_tag_list" onClick="search_with_term(this,'<?php echo $tag;?>','<?php echo $term->slug; ?>');">
            <!-- <input type="radio" value="<?php echo $term->term_id; ?>" name="wissen_tags" class="wissen_tag_list_ckb" <?php if ( $i == 0 ) { ?>checked<?php } ?>> -->
            <label class="wissen_tag_list_ckbl">
                <?php echo $term->name; ?>
            </label>
        </div>
<?php
    $i++; endforeach;
endif; 
}

/* function my_custom_styles( $init_array ) {  
 
    $style_formats = array(  
        array(  
            'title' => 'Start Button',  
            'block' => 'span',  
            'classes' => 'big',
            'wrapper' => false,
        ),  
        array(  
            'title' => 'Content link',  
            'block' => 'a',  
            'classes' => 'content-link',
            'wrapper' => true,
        ),
        array(  
            'title' => 'Highlighter',  
            'block' => 'span',  
            'classes' => 'highlighter',
            'wrapper' => true,
        ),
    );  
    // Insert the array, JSON ENCODED, into 'style_formats'
    $init_array['style_formats'] = json_encode( $style_formats );  
    
    return $init_array;  
  
} 
function add_style_select_buttons( $buttons ) {
    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}
// Register our callback to the appropriate filter
add_filter( 'mce_buttons_2', 'add_style_select_buttons' );
// Attach callback to 'tiny_mce_before_init' 
add_filter( 'tiny_mce_before_init', 'my_custom_styles' ); */
function share_button_icon($w=20){
    return '<div class="row">
                        <div class="social_icon_box">
                            <div class="social_icon"><img width="'.$w.'" id="u87_img" class="img" src="'.get_stylesheet_directory_uri() .'/images/u416.png"></div>
                            <div class="social_icon"><img width="'.$w.'" id="u88_img" class="img mouseOver" src="'.get_stylesheet_directory_uri() .'/images/u417.png"></div>
                            <div class="social_icon"><img width="'.$w.'" id="u89_img" class="img " src="'.get_stylesheet_directory_uri() .'/images/u418.png"></div>
                        </div>
                    </div>';
}


function remove_my_page_metaboxes() {
    remove_meta_box( 'solutions_library','page','normal' ); // Custom Fields Metabox
    remove_meta_box( 'story_package','page','normal' );
    
}
add_action('do_meta_boxes','remove_my_page_metaboxes');

function my_remove_popular_term_cloud( $args ) {
    echo '<pre>';
    var_dump($args);
    echo '</pre>';
	//$args['labels']['popular_items'] = null;
	return $args;
}
//add_filter( 'register_taxonomy_args', 'my_remove_popular_term_cloud' );



add_action( 'admin_init', function() {
	if( isset( $_POST['tax_input'] ) && is_array( $_POST['tax_input'] ) ) {
		$new_tax_input = array();
		foreach( $_POST['tax_input'] as $tax => $terms) {
			if( is_array( $terms ) ) {
			  $taxonomy = get_taxonomy( $tax );
			  if( !$taxonomy->hierarchical ) {
				  $terms = array_map( 'intval', array_filter( $terms ) );
			  }
			}
			$new_tax_input[$tax] = $terms;
		}
		$_POST['tax_input'] = $new_tax_input;
	}
});




function my_terms_clauses( $clauses, $taxonomy, $args ) {
  global $wpdb;
  if ( isset($args['post_types']) ) {
    $post_types = $args['post_types'];
    // allow for arrays
    if ( is_array($args['post_types']) ) {
      $post_types = implode("','", $args['post_types']);
    }
    $clauses['join'] .= " INNER JOIN $wpdb->term_relationships AS r ON r.term_taxonomy_id = tt.term_taxonomy_id INNER JOIN $wpdb->posts AS p ON p.ID = r.object_id";
    $clauses['where'] .= " AND p.post_type IN ('". esc_sql( $post_types ). "') GROUP BY t.term_id";
  }
  return $clauses;
}
add_filter('terms_clauses', 'my_terms_clauses', 99999, 3);


function my_post_count($tax, $cat1) {
    $meta_value = 'solarticle';
    $args = array(
        'post_type'=>'post',
        'tax_query' => array(
            'relation' => 'AND',
            array(
                'taxonomy' => $tax,
                'field' => 'term_taxonomy_id',
                'terms' => array( $cat1 ),
                'operator' => 'IN'
            )
        ),
        'meta_query' => array(
            array(
                'key' => 'gallery_data',
                'value' => sprintf(':"%s";', $meta_value),
                'compare' => 'like',
            ),
        ),
    );
    //var_dump($args);
    $query = new WP_Query( $args );
    return $query->post_count;
}








add_action('pre_get_posts','alter_query');
 
 function alter_query($query) {
     //gets the global query var object
     global $wp_query;
  
     //gets the front page id set in options
     $front_page_id = get_option('page_on_front');
  //var_dump($wp_query->query_vars['page_id']);
  //var_dump($query->is_tax('solutions_library'));
     if ($query->is_tax('solutions_library') && $query->is_main_query() ){
        
  
  
     $query-> set('post_type' ,'post');
  
     //we remove the actions hooked on the '__after_loop' (post navigation)
     remove_all_actions ( '__after_loop');
    }
 }

 function get_user_info_box($author_id){
     //echo $author_id;
//$author_id=$post->post_author; 
//
?>
<div class="author_box">
    <div class="author_picture">
        <?php echo get_avatar($author_id, 117);?>
    </div>
    <div class="author_details">

    <div class="author_info_content">
    <span class="written_by_author">Written by </span>
    <span class="written_by_author_name"><?php the_author_meta( 'user_nicename' , $author_id ); ?></span>
        </div>
        <div class="author_article">
            <?php  echo count_user_posts($author_id) ?> Articles
        </div>
        <div class="author_bio_content">
        <?php 
        the_author_meta( 'description' , $author_id );?>
        </div>
    </div>
</div>

<?php 
 }
 function primary_cta($gallery_data){
     
     if(isset($gallery_data['b_post_link_title'])){
         $b_post_link = isset($gallery_data['b_post_link'])?$gallery_data['b_post_link']:'#';
        ?>
        <div class="read_more_option primary_cta_option">
            <div class="primary_cta_class">
                    <a class="btn btn-sm" target="_Blank" href="<?php echo $b_post_link;?>">
                        <span class="setup_text_overflow">
                        <?php _e($gallery_data['b_post_link_title'], 'evolve');?>
                        </span>
                    </a>
            </div>
        </div>
        <?php
     }
 }


 function custom_banner_section($name,$descrip,$tid){
    // echo $tid;
     //$background_image_id = get_term_meta($tid, 'showcase-taxonomy-background', true);
      $background_image_id = get_term_meta($tid, 'showcase-taxonomy-image-id', true);
     
     $colorpicker = get_term_meta($tid,'color-picker', true);
    //echo $colorpicker;
     $img = '';
     if (isset($background_image_id) && $background_image_id != '') {
        $img = wp_get_attachment_image_url( $background_image_id, '' );
    }
    $colorpicker = (isset($colorpicker) && $colorpicker!=''?$colorpicker:'#000000');
    $total_post = my_post_count('solutions_library', $tid); 
    
     ?>
     <style>
     .top_header_background_position:before{
              background-image: linear-gradient(to bottom right, <?php echo $colorpicker;?>,<?php echo $colorpicker;?>); 
     }
     .top_header_background_position {
            background-image: url(<?php echo $img;?>);
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            position: relative;
        }
</style>
     <div class="row top_header_background_position">
<div class="col">
<div class="jumbotron" style="background-color:transparent;">
<div class="col header_title_area"><span class="yellow_border"><?php echo $name?></span></div>
<p class="lead head_top_content">
    <?php echo $descrip?>
</p>
<div class="col header_menu_area"></div>
<div class="row header_comment_area">
    <div class="article_menu_area"><?php 
   echo get_solution_count_by_post_id_tax($tid);
    //echo $total_post;?></div>
</div>
</div>
<div class="row arrow_head manual_banner_builder">
    <div id="" class="down_arrow"><img src="<?php echo get_stylesheet_directory_uri();?>/images/down.png"></div>
</div>
</div>
</div>
     <?php
 }
 function get_solution_count_by_post_id_tax($tax_id){
     $post_id_arr = get_post_id_array( $tax_id);
            //var_dump($post_id_arr);
            $meta_value = 'successstory';
             $meta_value = 'solution_post';
            if(count($post_id_arr)>0){
                foreach ( $post_id_arr as $search_value ) {
                    $search_term[] =  
                        array(
                            'key' => 'gallery_solution_post',
                            'value' => $search_value,
                            'compare' => '='
                        );
                }
                $search_term['relation'] =   'OR';
            
                $arr = array(
                    'post_type' => 'post',
                    // 'post__in'=> $post_id_arr,
                     'meta_query' => array(
                         array('relation' => 'OR',
                            $search_term)
                        ),
                    'post_status' => 'publish',
                    'posts_per_page' => $count
                );
            } 
            $wpb_all_query = new WP_Query($arr);
            return $wpb_all_query->post_count;
            //var_dump($wpb_all_query->post_count);
 }
 function get_solution_count_by_post_id($postid,$total=false){

     global $wpdb;
    //  $query = "SELECT * FROM `wp_success_story` where post_id='".$postid."'";
    //  $result = $wpdb->get_results($query);
    //  $total_result = count($result);
    // if($total==true){
    //     return $total_result;
    // }else{
    //     return $result;
    // }


    //--------------------------------------------------------
    $arr = array(
                    'post_type' => 'post',
                    // 'post__in'=> $post_id_arr,
                     'meta_query' => array(
                         array('relation' => 'OR',
                            array(
                            'key' => 'gallery_solution_post',
                            'value' => $postid,
                            'compare' => '='
                        ))
                        ),
                    'post_status' => 'publish',
                    'posts_per_page' => $count
                );
                $wpb_all_query = new WP_Query($arr);
            return $wpb_all_query->post_count;
 }

 function share(){
     echo '<div class="share_button">'. do_shortcode('[Sassy_Social_Share] ').'</div>';
 }


 //add_action('wp_head', 'show_template');
function show_template() {
    global $template;
    return basename($template);
}

function get_next_post_by_id($post_id=''){
    global $post;
    //var_dump($post->ID);
    if($post_id==''){
       $post_id =  $post->ID;
    }
    $post = get_post($post_id);
    //$previous_post = get_previous_post();
    $next_post = get_next_post();
    //var_dump($next_post);
    $post_id = $next_post->ID;
    $title = $next_post->post_title;

    $dataset = array ( "postid"=>$post_id, "posttitle"=>$title );
    return get_permalink($post_id);
}

function get_cc_post_type(){
    global $post;
    return isset($post->post_type)?$post->post_type:'';
}
function news_type(){
    global $post;
    $post_id = isset($post->ID)?$post->ID:'';
    if($post_id!=''){
        $get_meta_val = get_post_meta($post_id, 'gallery_data', true);
    }else{
        $get_meta_val = '';
    }
    return isset($get_meta_val['card_type'])?$get_meta_val['card_type']:'';
}

function social_icon_with_share($gray=false){
    $crunchifyURL = urlencode(get_permalink());
    $crunchifyTitle = htmlspecialchars(urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8');
    $crunchifyThumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
    
    $reddit = 'https://reddit.com/submit?url='.$crunchifyURL.'&title='.$crunchifyTitle.'';
    $twitterURL = 'https://twitter.com/intent/tweet?text='.$crunchifyTitle.'&amp;url='.$crunchifyURL.'&amp;via=Crunchify';
        $facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.$crunchifyURL;
        if($gray==true){
                $share_content = '<div class="social gray_icon">
                            <div class="social_icon" style="cursor:pointer;" onClick="javascript:window.open(\''.$twitterURL.'\', \'_blank\');"><img id="u87_img" class="img" src="'.get_stylesheet_directory_uri() .'/images/u416.png"></div>
                            <div class="social_icon" style="cursor:pointer;" onClick="javascript:window.open(\''.$facebookURL.'\', \'_blank\');"><img id="u88_img" class="img mouseOver" src="'.get_stylesheet_directory_uri() .'/images/u417.png"></div>
                            <div class="social_icon" style="cursor:pointer;" onClick="javascript:window.open(\''.$reddit.'\', \'_blank\');"><img id="u89_img" class="img " src="'.get_stylesheet_directory_uri() .'/images/u418.png"></div>
                        </div>';
        }else{
                $share_content = '<div class="social">
                            <div class="social_icon" style="cursor:pointer;" onClick="javascript:window.open(\''.$twitterURL.'\', \'_blank\');"><img id="u87_img" class="img" src="'.get_stylesheet_directory_uri() .'/images/u191.png"></div>
                            <div class="social_icon" style="cursor:pointer;" onClick="javascript:window.open(\''.$facebookURL.'\', \'_blank\');"><img id="u88_img" class="img mouseOver" src="'.get_stylesheet_directory_uri() .'/images/u192.png"></div>
                            <div class="social_icon" style="cursor:pointer;" onClick="javascript:window.open(\''.$reddit.'\', \'_blank\');"><img id="u89_img" class="img " src="'.get_stylesheet_directory_uri() .'/images/u193.png"></div>
                        </div>';
        }
    

       return  $share_content;                 
}

//add_filter( 'wp_insert_post_data' , 'filter_post_data' , '99', 2 );

function filter_post_data( $data , $postarr ) {
    // Change post title
    //var_dump($postarr['post_content']);
    $contetn_without_sp = clean_sp($postarr['post_content']);
    $fstring = substr(rtrim(ltrim($contetn_without_sp)), 0, 1);
    //echo '-----------';
    $final_string = str_replace_first($fstring,'<span class="big">'.$fstring.'</span>',$postarr['post_content']);
    //var_dump($final_string);
    $data['post_content'] .= $final_string;
    return $data;
}
function str_replace_first($from, $to, $content)
{
    $from = '/'.preg_quote($from, '/').'/';

    return preg_replace($from, $to, $content, 1);
}
function clean_sp($string) {
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}

function post_content_update_function( $post_id ,$post_object){
	if ( ! wp_is_post_revision( $post_id ) ){
	if ('post' == $post_object->post_type) {
       
		// unhook this function so it doesn't loop infinitely
		//remove_action('save_post', 'post_content_function');
	
        // update the post, which calls save_post again
        $data_content = $_POST['content'];
        //var_dump($_POST);

        $contetn_without_sp = clean_sp($data_content);
        $fstring = substr(rtrim(ltrim($contetn_without_sp)), 0, 1);
        //echo '-----------';
        $final_string = str_replace_first($fstring,'<span class="big">'.$fstring.'</span>',$data_content);
        //var_dump($final_string);
        //$data['post_content'] .= $final_string;
        $my_post = array(
        'ID'           => $post_id,
        'post_content' => $final_string,
        );
        //die();
		wp_update_post( $my_post );
    }
		// re-hook this function
		//add_action('save_post', 'post_content_function');
	}
}
//add_action('save_post', 'post_content_update_function');




// class my_Walker_CategoryDropdown extends Walker_CategoryDropdown {

// 	function start_el(&$output, $category, $depth, $args) {
// 		$pad = str_repeat(' ', $depth * 3);


// 		$cat_name = apply_filters('list_cats', $category->name, $category);
// 		$output .= "\t<option class=\"level-$depth\" value=\"".$category->slug."\"";
// 		if ( $category->term_id == $args['selected'] )
// 			$output .= ' selected="selected"';
// 		$output .= '>';
// 		$output .= $pad.$cat_name;
// 		if ( $args['show_count'] )
// 			$output .= '  ('. $category->count .')';
// 		if ( $args['show_last_update'] ) {
// 			$format = 'Y-m-d';
// 			$output .= '  ' . gmdate($format, $category->last_update_timestamp);
// 		}
// 		$output .= "</option>\n";
// 	}
// }


function my_custom_admin_head() {
	 global $pagenow;
    if ( 'post.php' === $pagenow && isset($_GET['post']) && 'contacts_database' === get_post_type( $_GET['post'] ) ){
        
    }else{
        ?>
        <style>
        #tagsdiv-solutions_library {
           display: none;
        }
        </style>
        <?php
    }
}
add_action( 'admin_head', 'my_custom_admin_head' );



// add_action( 'admin_init', 'do_something_152677' );

// function do_something_152677 () {
//     // Global object containing current admin page
   
// }
//add_filter('show_admin_bar', '__return_false');


flush_rewrite_rules( false );

// add_action( 'after_switch_theme', 'flush_rewrite_rules' );

// // Code for plugins
// register_deactivation_hook( __FILE__, 'flush_rewrite_rules' );
// register_activation_hook( __FILE__, 'myplugin_flush_rewrites' );
// function myplugin_flush_rewrites() {
// 	// call your CPT registration function here (it should also be hooked into 'init')
// 	myplugin_custom_post_types_registration();
// 	flush_rewrite_rules();
// }


function my_custom_taxonomies() {
   
    register_taxonomy(
        'placement',        // internal name = machine-readable taxonomy name
        'post',       // object type = post, page, link, or custom post-type
        array(
            'hierarchical' => true,
            'labels' => array(
                'name' => __( 'Placement' ),
                'singular_name' => __( 'Placement' ),
                'add_new_item' => 'Add New Placement',
                'edit_item' => 'Edit Placement',
                'new_item' => 'New Placement',
                'search_items' => 'Search Placement',
                'not_found' => 'No Placement found',
                'not_found_in_trash' => 'No Placement found in trash',
            ),
            'default_term'       => 'Some Default Term',
            'query_var' => true,    // enable taxonomy-specific querying
             // pretty permalinks for your taxonomy?
        )
    );
  //   $cat_ids = array( 6, 8 );

//$term_taxonomy_ids = wp_set_object_terms( 42, $cat_ids, 'category' );
}
add_action('init', 'my_custom_taxonomies', 0);




// function add_new_post_url($url, $path, $blog_id)
// {

//     if ($path == "post-new.php?post_type=product") {
//         $path = "edit.php?post_status=private&post_type=product";
//     }

//     return $path;
// }
// add_filter('admin_url', 'add_new_post_url', 10, 3);

add_action('admin_head', function () {
    $placement = get_term_by('slug', 'latest', 'placement');
    $latest_id = ($placement->term_id!=''?$placement->term_id:0);
    if((isset($_GET['card_type']) && $_GET['card_type']=='pod_cast') && $_GET['action']!='edit'){
    ?>
    <script type="text/javascript">
    jQuery(function($) {
       $('a[class="page-title-action"]').attr( 'href', 'post-new.php?select_tab=pod_cast' );
       
    });
    </script>
    <?php
    }else if((isset($_GET['card_type']) && $_GET['card_type']=='video') && $_GET['action']!='edit'){
    ?>
    <script type="text/javascript">
    jQuery(function($) {
       $('a[class="page-title-action"]').attr( 'href', 'post-new.php?select_tab=video' );
       
    });
    </script>
    <?php
    }elseif((isset($_GET['card_type']) && $_GET['card_type']=='story') && $_GET['action']!='edit'){
    ?>
    <script type="text/javascript">
    jQuery(function($) {
       $('a[class="page-title-action"]').attr( 'href', 'post-new.php?select_tab=story' );
       
    });
    </script>
    <?php
    }else if(isset($_GET['card_type']) && $_GET['card_type']=='solarticle'){
                ?>
            <script type="text/javascript">
            jQuery(function($) {
                console.log('test');
            $('a[class="page-title-action"]').attr( 'href', 'post-new.php?select_tab=solarticle' );
             
            });
            </script>
            <?php
    }else if((isset($_GET['select_tab']) && $_GET['select_tab']=='pod_cast') && $_GET['action']!='edit'){
                ?>
            <script type="text/javascript">
            jQuery(function($) {
                $("#gallery_card_type").val('pod_cast');               
            });
            </script>
            <?php
    }else if((isset($_GET['select_tab']) && $_GET['select_tab']=='video') && $_GET['action']!='edit'){
                ?>
            <script type="text/javascript">
            jQuery(function($) {
            
                // $("#in-placement-<?php echo $latest_id;?>").attr('checked', true);
                // $("#placement-<?php echo $latest_id;?>").css('display', 'none');

                $("#gallery_card_type").val('video');
               
               
            });
            </script>
            <?php
    }else if((isset($_GET['select_tab']) && $_GET['select_tab']=='story') && $_GET['action']!='edit'){
                ?>
            <script type="text/javascript">
            jQuery(function($) {
            console.log('in-placement-<?php echo $latest_id;?>');
                $("#in-placement-<?php echo $latest_id;?>").attr('checked', true);
                $("#placement-<?php echo $latest_id;?>").css('display', 'none');
                $("#gallery_card_type").val('story');
               
               
            });
            </script>
            <?php
    }else if( $_GET['action']=='edit'){
                ?>
            <script type="text/javascript">
            jQuery(function($) {
            console.log('in-placement-<?php echo $latest_id;?>');
                $("#in-placement-<?php echo $latest_id;?>").attr('checked', true);
                $("#placement-<?php echo $latest_id;?>").css('display', 'none');
            });
            </script>
            <?php
    }else if((isset($_GET['select_tab']) && $_GET['select_tab']=='solarticle') && $_GET['action']!='edit'){
         ?>
    <script type="text/javascript">
    jQuery(function($) {
       console.log('in-placement-<?php echo $latest_id;?>');
        $("#in-placement-<?php echo $latest_id;?>").attr('checked', true);
         $("#placement-<?php echo $latest_id;?>").css('display', 'none');
         $("#postdivrich").css('display', 'none');
         $("#gallery_card_type").val('solarticle');
    });
    </script>
    <?php
    }else if((isset($_GET['post_type']) && $_GET['post_type']=='quickbyte') ){
         ?>
    <script type="text/javascript">
    jQuery(function($) {
       console.log('in-placement-<?php echo $latest_id;?>');
         $("#postdivrich").css('display', 'none');
    });
    </script>
    <?php
    }
    //solarticle
});

function custom_echo($x, $length)
{
  //  echo strlen($x);
  if(strlen($x)<=$length)
  {
    return $x;
  }
  else
  {
    $y = substr($x,0,$length) . '...';
    return $y;
  }
}
function change_first_content($ex){
     if ($ex != '') {
            $data_content = strip_tags($ex);
            $firstCharacter = substr($data_content, 0, 1);
           return str_replace_first_string($firstCharacter,'<span class="big">' . $firstCharacter . '</span>',$ex);
            // $contetn_without_sp = clean_sp($data_content);
            // if (preg_match('/[a-z]/i', $contetn_without_sp, $match)) {

            //     $fstring = $match[0];
            // }
            // $final_string = str_replace_first($fstring, '<span class="big">' . $fstring . '</span>', $data_content);
            // return '<p>' . $final_string . '</p>';
        }
}
function str_replace_first_string($from, $to, $content){
    $from = '/'.preg_quote($from, '/').'/';
    return preg_replace($from, $to, $content, 1);
}

// function change_first_content($ex){
//      if ($ex != '') {
//             //$data_content = strip_tags($ex);
//             $data_content = $ex;
//             $contetn_without_sp = clean_sp($data_content);
//             if (preg_match('/[a-z]/i', $contetn_without_sp, $match)) {

//                 $fstring = $match[0];
//             }
//             $final_string = str_replace_first($fstring, '<span class="big">' . $fstring . '</span>', $data_content);
//             return '<p>' . $final_string . '</p>';
//         }
// }

function quick_bytes_list($qid=''){
    global $post;
    //echo $post->ID;
    if($qid==''){
        $qid=$post->ID;
    }
    $wpb_all_query = new WP_Query(array(
		'post_type'=>'quickbyte', 
        'post_status'=>'publish',
        'post__not_in' =>array($qid),
		'posts_per_page'=>4));

//echo '<div class="row spotlight_heading" ><div class="col-12"><div class="category_title_spotlight">'.$cat_value.'</div></div></div>';
        ob_start();
if ( $wpb_all_query->have_posts() ) :
    while ( $wpb_all_query->have_posts() ) : $wpb_all_query->the_post();
        get_template_part( 'template-parts/post/quickbytes', 'post' );
    endwhile;
endif;
    
$my_full_html = ob_get_clean();
    return $my_full_html;
}

function youtube_link_to_embeded_code_custom($code){
        $return = preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","<iframe width=\"420\" height=\"180\" src=\"//www.youtube.com/embed/$1\" frameborder=\"0\" allowfullscreen></iframe>",$code);
        return $return;
}

function get_post_id_array($tax_id){

     $meta_value = 'solarticle';
                        $args = array(
                                'post_type'=>'post',
                                'tax_query' => array(
                                    'relation' => 'AND',
                                    array(
                                        'taxonomy' => 'solutions_library',
                                        'field' => 'term_taxonomy_id',
                                        'terms' => array( 31 ),
                                        'operator' => 'IN'
                                    )
                                    ),
                        'meta_query' => array(
                            array(
                                'key' => 'gallery_data',
                                'value' => sprintf(':"%s";', $meta_value),
                                'compare' => 'like',
                            ),
                        ),
                            );
                            // echo '<pre>';
                        //  var_dump($args);
                            // echo '</pre>';
                        $wpb_all_query = new WP_Query($args);
                        $array_arr = array();
                        while ( $wpb_all_query->have_posts() ) {
                            $wpb_all_query->the_post();
                            $id = get_the_ID();
                            $array_arr[] = $id;
                        }
                        return $array_arr;
                        //var_dump($array_arr);
}