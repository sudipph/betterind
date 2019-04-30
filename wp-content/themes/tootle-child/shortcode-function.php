<?php
function tbi_header_section($atts, $content = null)
{
    global $post;
    $default = array(
        'header' => 'true',
        'backgroundimage' => '',
        'title' => '',
        'link' => '#',
    );
    $a = shortcode_atts($default, $atts);
    //var_dump($a);
    $content = do_shortcode($content);
    if ($a['header'] == true) {
        ?>
        <style>
                            @media (min-width: 768px) {
                                .to_build_dynamic_header_banner header{
                                    position: unset;
                                }
                            }
                        @media (min-width: 320px) and (max-width: 480px) {
                        .to_build_dynamic_header_banner header{
                            position: absolute;
                        }
                        }
                        .type-page .view_page_title{
                            padding:0;

                        }
                        div#primary .type-page .view_page_title h1.post-title{
                            display:none !important;
                        }
                        /* .dinamic_background_image{
                        background-image:url('<?php echo (isset($a['backgroundimage']) ? $a['backgroundimage'] : '') ?>');
                        background-repeat: no-repeat;
                        background-position: center;
                        background-size: contain;
                        } */
                        .top_header_background_position{
                            background-image:url('<?php echo (isset($a['backgroundimage']) ? $a['backgroundimage'] : '') ?>');
                            background-repeat: no-repeat;
                            background-position: center;
                            background-size: cover;
                            position: relative;

                        }
                        .top_header_background_position:before{
                            content: '';
                                position: absolute;
                                top: 0;
                                right: 0;
                                bottom: 0;
                                left: 0;
                                background-image: linear-gradient(to bottom right,#020202,#000000);
                                opacity: .6;
                        }
        </style>
            <?php
    }
                ob_start();
                ?>
            <div class="row top_header_background_position">
            <div class="col">
            <div class="jumbotron" style="background-color:transparent;">
            <?php if(isset($a['title']) && $a['title']!=""){?>
                <div class="col header_title_area">
                <span class="yellow_border"><?php echo (isset($a['title']) ? $a['title'] : '') ?>
                </span>
                </div>
            <?php } ?>
            <p class="lead head_top_content"><?php echo (isset($content) ? $content : '') ?></p>
            <div class="col header_menu_area"><?php //echo $menu; ?></div>


            </div>


            <div class="row arrow_head <?php echo $post->post_name;?> 1">
                <div id="" class="down_arrow force_click"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/down.png"></div>
            </div>



            </div>



            </div>

            <?php
            $full_content = ob_get_clean();
                return $full_content;
}

function tbi_header_section_for_home_page($atts, $content = null)
{
    global $post;
    $default = array(
        'header' => '',
        'backgroundimage' => '',
        'title' => '',
        'link' => '#',
    );
    $full_settings = get_option('evolve_child_theme_settings');
    $full_settings = json_decode($full_settings);
    $menu = '';
    if (isset($full_settings->title_name)) {
        for ($i = 0; $i < count($full_settings->title_name); $i++) {
            $menu .= '<div class="menu_inner_div"><a href="' . (isset($full_settings->title_link[$i]) ? $full_settings->title_link[$i] : '#') . '">' . $full_settings->title_name[$i] . '</a></div>';
        }
    }
    $a = shortcode_atts($default, $atts);
    //var_dump($a);
    $content = do_shortcode($content);
        ?>
        <style>
            @media (min-width: 768px) {
                .to_build_dynamic_header_banner header{
                    position: unset;
                }
            }
        @media (min-width: 320px) and (max-width: 480px) {
        .to_build_dynamic_header_banner header{
            position: absolute;
        }
        }
        .type-page .view_page_title{
            padding:0;

        }
        div#primary .type-page .view_page_title h1.post-title{
            display:none !important;
        }
        /* .dinamic_background_image{
        background-image:url('<?php echo (isset($a['backgroundimage']) ? $a['backgroundimage'] : '') ?>');
        background-repeat: no-repeat;
        background-position: center;
        background-size: contain;
        } */
        .top_header_background_position{
            background-image:url('<?php echo (isset($full_settings->home_page_background_image) ? $full_settings->home_page_background_image : '') ?>');
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            position: relative;

        }
        .home_head_top_content::before {
            content: "";
            left: 180px;
            background-image: url('<?php echo (isset($full_settings->home_page_content_image) ? $full_settings->home_page_content_image : '') ?>');
            position: absolute;
            z-index: 5000;
            width: 342px;
            height: 216px;
        }
        .top_header_background_position:before{
            content: '';
                position: absolute;
                top: 0;
                right: 0;
                bottom: 0;
                left: 0;
                background-image: linear-gradient(to bottom right,#020202,#000000);
                opacity: .6;
        }
        </style>
            <?php
                ob_start();
                ?>
            <div class="row top_header_background_position">
            <div class="col">
            <div class="jumbotron" style="background-color:transparent;">


             <p class="home_head_top_content"><?php echo (isset($full_settings->home_page_description) ? $full_settings->home_page_description : '') ?></p>
        <div class="col header_menu_area"><?php echo $menu; ?></div>

            <!-- <div class="col header_title_area">
                <span class="yellow_border"><?php echo (isset($a['title']) ? $a['title'] : '') ?>
                </span>
            </div>
            <p class="lead head_top_content"><?php echo (isset($content) ? $content : '') ?></p>
            <div class="col header_menu_area"><?php //echo $menu; ?></div> -->


            </div>


            <div class="row arrow_head home <?php echo $post->post_name;?> 1">
                <div id="" class="down_arrow force_click"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/down.png"></div>
            </div>



            </div>



            </div>

            <?php
            $full_content = ob_get_clean();
                return $full_content;
}

add_shortcode('TBI', 'tbi_header_section');
add_shortcode('home_banner', 'tbi_header_section_for_home_page');

function tbi_category_section($atts, $content = null)
{

    $default = array(
        'header' => '',
        'slug' => '',
         'title' => '',
        'count' => -1,
        'link' => '#',
    );
    $a = shortcode_atts($default, $atts);
    //var_dump($a);

    $content = do_shortcode($content);
    if ($a['count'] != 0) {
        $count = $a['count'];
    }

    ob_start();
    if ($a['slug'] != '') {
        echo '<div class="tbi_corner_start_from" >';
        $category_id = get_category_by_slug($a['slug']);
        $category_link = get_category_link($category_id->term_id);
        // 'meta_query' => array(
        //         array(
        //             'key' => 'gallery_data',
        //             'value' => sprintf(':"%s";', 'tbicorners'),
        //             'compare' => 'like',
        //         ),
        //     ),
        $wpb_all_query = new WP_Query(array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'category_name' => $a['slug'],
            'tax_query' => array(
                array(
                    'taxonomy' => 'placement',
                    'terms' => TOP_STORIES,
                    'field' => 'slug',
                    'include_children' => true,
                    'operator' => 'IN'
                )
            ),
            'posts_per_page' => $count,
        ));
        //tbi-corner
        echo '<div class="row tbi_corner_heading" >
        <div class="col-12">';
if(( isset($category_id->name) &&  $category_id->name!='') || $a['title']!=''){
       echo '<div class="category_title_spotlight">' . (( isset($category_id->name) &&  $category_id->name!='')?$category_id->name:$a['title']) . '</div>';
}
      echo '</div>';
      if( isset($category_link) &&  $category_link!='' &&  $category_link!='#'){
        echo '<div class="see_all"><span>';
        echo '<a href="' . esc_url($category_link) . '"> See All</a>';
        echo '</span>
        </div>';
      }
        echo '</div>';
        if ($wpb_all_query->have_posts()):

            while ($wpb_all_query->have_posts()): $wpb_all_query->the_post();

                get_template_part('template-parts/post/tbicorners_shortcode_wc', 'post');

            endwhile;

        endif;
        echo '</div>';
        wp_reset_query();
    }

    ?>

    <?php
$full_content_cat = ob_get_clean();
    return $full_content_cat;
}
function tbi_success_story($atts, $content = null)
{

    $default = array(
        'header' => '',
        'title' => '',
        'slider' => 'false',
        'tax_id'=>'',
        'taxonomy'=>'solutions_library',
        'seeall' => 'false',
        'postarr'=>'false',
        'story_button' => 'false',
        'count' => -1,
        'link' => '#',
    );
    $a = shortcode_atts($default, $atts);
    //var_dump($a);

    $content = do_shortcode($content);
    if ($a['count'] != 0) {
        $count = $a['count'];
    }else{
        $count = -1;
    }
    ob_start();
    //var_dump($a['slider']);
    $tax_id = $a['tax_id'];
    
    
    if ($a['slider'] == 'false') {
        
        if($a['postarr']=='true'){

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
        }else  if($tax_id!=''){
        //    $arr = array(
        //             'post_type' => 'success_stories',
        //             'post_status' => 'publish',
        //             'posts_per_page' => $count,
        //             'tax_query' => array(
        //                 array(
        //                 'taxonomy' => $a['taxonomy'],
        //                 'field' => 'term_id',
        //                 'terms' => $tax_id
        //                 )
        //             )
        //         );
            $meta_value = 'successstory';
             $arr = array(
                    'post_type' => 'post',
                    'post_status' => 'publish',
                     'meta_query' => array(
                            array(
                                'key' => 'gallery_data',
                                'value' => sprintf(':"%s";', $meta_value),
                                'compare' => 'like',
                            ),
                        ),
                        'tax_query' => array(
                        array(
                                'taxonomy' => $a['taxonomy'],
                                'field' => 'term_id',
                                'terms' => $tax_id
                                )
                            ),
                    'posts_per_page' => $count
                );
        }else{
            //    $arr = array(
            //         'post_type' => 'success_stories',
            //         'post_status' => 'publish',
            //         'posts_per_page' => $count
            //     );
            $meta_value = 'successstory';
             $arr = array(
                    'post_type' => 'post',
                    'post_status' => 'publish',
                     'meta_query' => array(
                            array(
                                'key' => 'gallery_data',
                                'value' => sprintf(':"%s";', $meta_value),
                                'compare' => 'like',
                            ),
                        ),
                    'posts_per_page' => $count
                );
        }
      // var_dump($arr);
        $wpb_all_query = new WP_Query($arr);
       // echo $wpb_all_query->request;
        /*'meta_query' => array(
                array(
                    'key' => 'gallery_data',
                    'value' => sprintf(':"%s";', 'solarticle'),
                    'compare' => 'like',
                ),
            ),*/
        //var_dump($wpb_all_query);
        $category_link = get_post_type_archive_link( 'success_stories' );
        echo '<div class="spotlight_body_start success_story different_item" >';
        echo '<div class="row spotlight_heading" >';

        echo '<div class="col-12">';
        if(isset($a['title']) && $a['title']!=""){
            echo '<div class="category_title_spotlight">' . $a['title'] . '</div>';
        }
        if(isset($content) && $content!=""){
            echo '<div class="content_header">' . $content . '</div>';
        }
        echo '</div>';
        if ((isset($category_link) && $category_link!='' ) && $a['seeall'] == true) {
            echo '<div class="see_all">';
            echo '<span>';
            echo '<a href="' . esc_url($category_link) . '"> See All</a>';
            echo '</span>';
            echo '</div>';
        }
        echo '</div>';
        
        
        if ($wpb_all_query->have_posts()){
            echo '<div class="row content_box_success_story">';
            while ($wpb_all_query->have_posts()): $wpb_all_query->the_post();
                $sid = get_the_ID();
                $gallery_data = get_post_meta($sid, 'gallery_data', true);
                $category = get_the_terms( $sid, 'solutions_library' );
                       // echo '<br>';
                  //var_dump($category);     
                       $colorpicker = '';
                        if(isset($category[0]->name)){
                            $colorpicker = get_term_meta($category[0]->term_id, 'color-picker', true);
                        }
                ?>
                <a href="<?php echo get_the_permalink();?>?placement=success">
                <div class="success_story_list_loop">
                    <div class="col-5 card-deck">
                         
                                <div class="img-circle">
                                    <?php 
                                    if (isset($sid) && $sid != '') {
                                        echo get_the_post_thumbnail($sid, 'thumbnail', '', array("class" => "img-responsive img-circle"));
                                    }
                                    ?>
                                </div>
                                <?php if(isset($gallery_data['gallery']['user_name'])){?>
                                <div class="user_name" style="color:<?php echo $colorpicker;?>;"><span class="by_class" >by</span> <?php echo $gallery_data['gallery']['user_name']?></div>
                                <?php }?>
                                <div class="location show_on_desktop_view"><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago';?></div>
                                <?php if(isset($gallery_data['gallery']['location'])){?>
                                <div class="location show_on_mobile_view"><?php echo $gallery_data['gallery']['location'];?></div>
                                <?php }?>    
                                
                        
                    </div>
                    <div class="col-7">
                    <?php 
                       
                       // echo '<br>';
                       
                       //
                        if(isset($category[0]->name)){
                            
                            
                        ?>
                        <div class="category border_hook" style="color:<?php echo $colorpicker;?>;border-color:<?php echo $colorpicker;?>;">
                        <?php echo $category[0]->name;?>
                        </div>
                        <?php } ?>
                        <div class="solution_title"><?php echo get_the_title(); ?></div>
                    </div>
                </div>
                        </a>
                <?php

            endwhile;
            echo '</div>';
        }
        if($a['story_button']=='true'){
          $term ='<select name="solutions_library" id="solutions_library">';
          $term .='<option value="">Select Solutions Library</option>';     
       $tax_terms = get_terms('solutions_library'); 
       // $tax_terms = get_terms('solutions_library', array('hide_empty' => '0'));      
       foreach ( $tax_terms as $tax_term ):  
        $term .='<option value="'.$tax_term->name.'">'.$tax_term->name.'</option>';   
       endforeach;
    $term .='</select>'; 

            echo '<div class="row success_story_button"><div class="covr"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
            I HAVE A SUCCESS STORY</button></div></div>
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="z-index:9999;">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Success Story</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div> <form data-toggle="validator" role="form" method="post" id="success_story">
                    <input type="hidden" name="post_id" id="post_id" value="">
                            <div class="modal-body">
                                        <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputName">Name</label>
                                            <input type="text" class="form-control" name="fullname" id="fullname" placeholder="Name" required>
                                            </div>  
                                        
                                        <div class="form-group col-md-6">
                                            <label for="inputSolution">Solutions Library</label>
                                            '.$term.'
                                        </div>  
                                        <div class="form-group col-md-12">
                                            <label for="inputEmail4">Email</label>
                                            <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                                        </div>  
                                            <div class="form-group col-md-12">
                                            <label for="inputPassword4">Success Story</label>
                                            <textarea name="success_story_text" class="form-control" id="success_story_text" required></textarea>
                                            </div>
                                        </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary"  >Save changes</button>
                            </div>
                    </form>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="exampleSuccessmsg" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="z-index:9999;">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Success Message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                        <div class="modal-body">
                                <div class="form-row">
                                Your Story Submitted Successfully.   
                                </div>
                        </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>        
                </div>
                </div>
            </div>
            </div>';
        }
        wp_reset_query();
        echo '</div>';
    }
    $full_content_cat = ob_get_clean();
    return $full_content_cat;
}
function tbi_post_list_from_cat_id($atts, $content = null)
{

    $default = array(
        'header' => '',
        'title' => '',
        'slider' => 'false',
        'term_id' => '',
        'tax'=>'solutions_library',
        'count' => -1,
        'heading'=>'false',
        'link' => '#',
    );
    
    $a = shortcode_atts($default, $atts);
    $content = do_shortcode($content);
    if ($a['count'] != 0) {
        $count = $a['count'];
    }
    ob_start();
    //var_dump($a['slider']);
    //if ($a['slider'] == 'false') {
                        $meta_value = 'solarticle';
                        $args = array(
                                'post_type'=>'post',
                                'tax_query' => array(
                                    'relation' => 'AND',
                                    array(
                                        'taxonomy' => $a['tax'],
                                        'field' => 'term_taxonomy_id',
                                        'terms' => array( $a['term_id'] ),
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
                        //var_dump($args);
                            // echo '</pre>';
                        $wpb_all_query = new WP_Query($args);
                            /**array(
                            'post_type' => 'success_stories',
                            'post_status' => 'publish',
                            'posts_per_page' => $count
                        ) */
                        /*'meta_query' => array(
                                array(
                                    'key' => 'gallery_data',
                                    'value' => sprintf(':"%s";', 'solarticle'),
                                    'compare' => 'like',
                                ),
                            ),*/
                        //var_dump($wpb_all_query);
                        $category_link = get_post_type_archive_link( 'success_stories' );
                        echo '<div class="spotlight_body_start success_story" >';
                        
                       // if($a['heading']=='true'){
                        echo '<div class="row spotlight_heading" >';
                        echo '<div class="col-12">';
                        if(isset($a['title']) && $a['title']!=""){
                            echo '<div class="category_title_spotlight">' . $a['title'] . '</div>';
                        }
                         if(isset($content) && $content!=""){
                        echo '<div class="content_header">' . $content . '</div>';
                         }
                        echo '</div>';
                        if ((isset($category_link) && $category_link!='')&&$a['seeall'] == 'true') {
                            echo '<div class="see_all">';
                            echo '<span>';
                            echo '<a href="' . esc_url($category_link) . '"> See All</a>';
                            echo '</span>';
                            echo '</div>';
                        }
                        echo '</div>';
                       // }
                        
                        if ($wpb_all_query->have_posts()){
                            echo '<div class="row content_box_success_story">';
                            while ($wpb_all_query->have_posts()): $wpb_all_query->the_post();
                                $sid = get_the_ID();
                                $gallery_data = get_post_meta($sid, 'gallery_data', true);
                                $category = get_the_terms( $sid, 'solutions_library' );
                                    // echo '<br>';
                                    $card_type = $gallery_data['card_type'];
                                    $eprice = $gallery_data['eprice'][$card_type];
                                    $hour = $gallery_data['hour'][$card_type];
                                    ///success_story_count
                                   // $total_success_story = get_solution_count_by_post_id($sid,true);
                                    $total_success_story = get_solution_count_by_post_id($sid);

                                    //echo $eprice;
                                    //var_dump($gallery_data['card_type']);
                                    $colorpicker = '';
                                        if(isset($category[0]->name)){
                                            $colorpicker = get_term_meta($category[0]->term_id, 'color-picker', true);
                                        }
                                ?>
                                <a href="<?php echo get_the_permalink();?>?placement=sol">
                                <div class="success_story_list_loop submenu_page">
                                    <div class="col-5 card-deck">
                                        
                                                <div class="img_box">
                                                    <?php 
                                                    if (isset($sid) && $sid != '') {
                                                        echo get_the_post_thumbnail($sid, 'thumbnail', '', array("class" => "img-responsive img-circle"));
                                                    }
                                                    ?>
                                                </div>
                                                <?php if(isset($gallery_data['gallery']['user_name'])){?>
                                                <div class="user_name" style="color:<?php echo $colorpicker;?>;"><span class="by_class" >by</span> <?php echo $gallery_data['gallery']['user_name']?></div>
                                                <?php }?>
                                                <!-- <div class="location show_on_desktop_view"><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago';?></div> -->
                                                <?php if(isset($gallery_data['gallery']['location'])){?>
                                                <!-- <div class="location show_on_mobile_view"><?php echo $gallery_data['gallery']['location'];?></div> -->
                                                <?php }?>    
                                                
                                        
                                    </div>
                                    <div class="col-7">
                                    <?php 
                    
                                        ?>
                                        <div class="category price_hook" style="color:<?php echo $colorpicker;?>;border-color:<?php echo $colorpicker;?>;">
                                        <?php if(isset($eprice) && $eprice!=''){
                                            echo 'Rs. '.$eprice.' approx';
                                        } ?>
                                        </div>

                                        <div class="category hour_hook" style="color:<?php echo $colorpicker;?>;border-color:<?php echo $colorpicker;?>;">
                                        <?php if(isset($hour) && $hour!=''){
                                            echo $hour.' Hours';
                                        } ?>
                                        </div>

                                        
                                        <div class="solution_title"><?php echo custom_echo(get_the_title(),60); ?></div>
                                        <div class="success_story_count">
                                                <div class="success_story_icon"></div> <?php echo $total_success_story?> Success Stories
                                        </div>
                                    </div>
                                </div>
                                        </a>
                                <?php

                            endwhile;
                            echo '</div>';
                        }
                        wp_reset_query();
                        echo '</div>';
    //}
    $full_content_cat = ob_get_clean();
    return $full_content_cat;
}
add_shortcode('TBI_success', 'tbi_success_story');
add_shortcode('TBI_solution_article', 'tbi_post_list_from_cat_id');

function tbi_category_solutions($atts, $content = null)
{

    $default = array(
        'header' => '',
        'title' => '',
        'slider' => 'false',
        'seeall' => 'false',
        'count' => -1,
        'link' => '#',
    );
    $a = shortcode_atts($default, $atts);
    //var_dump($a);

    $content = do_shortcode($content);
    if ($a['count'] != 0) {
        $count = $a['count'];
    }

    ob_start();
    //var_dump($a['slider']);
    if ($a['slider'] == 'true') {
        $category_id = get_category_by_slug($a['slug']);

        $category_link = get_category_link($category_id->term_id);
        $terms = get_terms(array(
            'taxonomy' => 'solutions_library'
        ));
        //var_dump($terms);
        echo '<div class="spotlight_body_start category_solutions" >';
        echo '<div class="row spotlight_heading" >';
        echo '<div class="col-12"><div class="category_title_spotlight">' . $a['title'] . '</div>';
        echo '<div class="content_header">' . $content . '</div>';
        echo '</div>';
        if ($a['seeall'] == 'true') {
            echo '<div class="see_all">';
            echo '<span>';
            echo '<a href="' . esc_url($category_link) . '"> See All</a>';
            echo '</span>';
            echo '</div>';
        }
        echo '</div>';
        $terms_count = count($terms);
        if ($terms_count > 0) {
            echo '<div class="row"><div class="owl-demo3_dinamic_class card-deck">';
            foreach ($terms as $k => $solution) {
                $background_image_id = get_term_meta($solution->term_id, 'showcase-taxonomy-background', true);
                $image_id = get_term_meta($solution->term_id, 'showcase-taxonomy-image-id', true);
                ?>


                    <div class="item card">
                    <div><?php echo $solution->name; ?></div>
                    <?php

                if (isset($background_image_id) && $background_image_id != '') {
                    echo wp_get_attachment_image($background_image_id, 'thumbnail', '', array("class" => "card-img-top"));
                }
                ?>
                    <!-- <img class="card-img-top" src="" alt="Card image cap"> -->
                    <div class=""><?php echo $solution->count; ?></div>
                    </div>

                <?php

            }
            echo '</div> </div>';
        }
        echo '</div>';
        wp_reset_query();

    } elseif ($a['slider'] == 'false') {
        $category_id = get_category_by_slug($a['slug']);

        $category_link = get_category_link($category_id->term_id);
        $second_param = array(
                'post_type' => array('post'),
                'fields' => 'all'
        );
        $terms = get_terms(array(
            'taxonomy' => 'solutions_library'
        ));
        //var_dump($terms);
        echo '<div class="spotlight_body_start" >';
        echo '<div class="row spotlight_heading solution_library_for_head" >';
        echo '<div class="col-12"><div class="category_title_spotlight">' . $a['title'] . '</div>';
        echo '<div class="content_header">' . $content . '</div>';
        
        echo '</div>';
        if ($a['seeall'] == 'true') {
            echo '<div class="see_all">';
            echo '<span>';
            echo '<a href="' . esc_url($category_link) . '"> See All</a>';
            echo '</span>';
            echo '</div>';
        }
        echo '</div>';
        // $catt = get_categories('taxonomy=solutions_library&type=post');
        // echo '<pre>'; 
        // var_dump($catt);
        // var_dump($terms);
        // echo '</pre>'; 
        $terms_count = count($terms);
        if ($terms_count > 0) {

            echo '<div class="row solution_main_area">';
            foreach ($terms as $k => $solution) {
                $category_link = get_category_link( $solution->term_id );
                $background_image_id = get_term_meta($solution->term_id, 'showcase-taxonomy-background', true);
                $image_id = get_term_meta($solution->term_id, 'showcase-taxonomy-image-id', true);
                $color = get_term_meta($solution->term_id, 'color-picker', true);
                // if (isset($background_image_id) && $background_image_id != '') {
                //     $background_img = wp_get_attachment_image_src($background_image_id, 'thumbnail', '', array("class" => "card-img-top"));
                //     $background_img_src = $background_img[0];
                // }
                if (isset($image_id) && $image_id != '') {
                    $background_img = wp_get_attachment_image_src($image_id, 'thumbnail', '', array("class" => "card-img-top"));
                    $background_img_src = $background_img[0];
                }
                $solution_count = my_post_count('solutions_library', $solution->term_id);
                if($solution_count>0){
                ?>
                 <a href="<?php echo $category_link;?>">
                 <?php }?>
                <div class="card-deck">
                    <div class="solution_background_area" style="background-color:<?php echo $color;?>"></div>
                   <?php
                   if(isset($background_img_src)){
                       echo '<img src="'.$background_img_src.'">';
                   }
                   ?> 
                   <div class="image_box">
                        <div class="img-circle">
                                <?php 
                                if (isset($image_id) && $image_id != '') {
                                    echo wp_get_attachment_image($image_id, 'thumbnail', '', array("class" => "img-responsive img-circle"));
                                }
                                ?>
                        </div>
                    </div>        
                    <div class="card">
                    <div class="solution_title"><?php echo $solution->name;//echo custom_echo($solution->name,155); ?></div>
                    <!-- <img class="card-img-top" src="" alt="Card image cap"> -->
                    <div class="solution_comments"><?php 
                    //var_dump( get_category($solution->term_id)->count);
                    
                    if($solution_count > 0){
                    ?>
                   
                     <?php  echo $solution_count; ?>
                    <?php
                    }else{
                        ?>
                         <?php  echo $solution_count; ?>
                        <?php
                    }
                    ?>
                  </div>
                    </div>
                </div>
                <?php 
                if($solution_count>0){?>
                </a>
                <?php
                }

            }
            echo '</div>';
        }
        echo '</div>';
        wp_reset_query();

    }

    $full_content_cat = ob_get_clean();
    return $full_content_cat;
}
add_shortcode('TBI_category', 'tbi_category_section');
add_shortcode('TBI_solutions', 'tbi_category_solutions');
function tbi_dynamic_post_section($atts, $content = null)
{
    //[TBI_post post_type="author" count="3" filter="author" slider="true"]
    $default = array(
        'post_type' => 'post',
        'title' => '',
        'count' => -1,
        'slider' => 'false',
        'backgroundimage' => 'false',
        'metakey' => '',
        'rainwater_count' => 'false',
        'parmalink' => 'false',
    );
    $a = shortcode_atts($default, $atts);
    // var_dump($a);

    $content = do_shortcode($content);
    if ($a['count'] != 0) {
        $count = $a['count'];
    }

    ob_start();
    if ($a['post_type'] != '') {
        $custom_link = get_post_type_archive_link($a['post_type']);

        $wpb_all_query = new WP_Query(array(
            'post_type' => $a['post_type'],
            'post_status' => 'publish',
            'posts_per_page' => $count,
        ));

        echo '<div class="spotlight_body_start" >';
        echo '<div class="row spotlight_heading" >';
        echo '<div class="col-12">';
        if (isset($a['title'])) {
            echo '<div class="category_title_spotlight">' . $a['title'] . '</div>';
        }
        echo '</div>';
        echo '<div class="see_all">';
        echo '<span>';
        echo '<a href="' . esc_url($custom_link) . '"> See All</a>';
        echo '</span>';
        echo '</div>';
        echo '</div>';
        ?>
    <div class="container">
    <div class="row">
        <div  id="touchFlow" class="nav_h_responsive_type owl-demo3_dinamic_class <?php echo $a['post_type']; ?>">
       
            <?php
        if ($wpb_all_query->have_posts()):
            echo '<ul>';
            while ($wpb_all_query->have_posts()): $wpb_all_query->the_post();
                $gallery_data = get_post_meta(get_the_ID(), 'gallery_data', true);
                $background_image = '';
                $background_class = '';
                if (isset($a['backgroundimage']) && $a['backgroundimage'] == true) {
                    $background_image = 'style="background-image : url(' . $gallery_data['background_image_url'] . ')"';
                    $background_class = 'additional_background_image';
                }

                ?>
                <li>
                    <div class="item selected_product <?php echo $background_class ?>" <?php echo $background_image; ?>>
                    <div class="thumbnail_image"> <?php echo get_the_post_thumbnail('','',array( 'class' => 'tbi_corner_author' )); ?></div>
                    <?php
                    // var_dump($a['rainwater_count']);
                    if (isset($a['rainwater_count']) && $a['rainwater_count'] == 'true') {
                        $total_rainwater_harvesting = meta_value_search_from_rainwater_harvesting(get_the_ID());

                        if (isset($total_rainwater_harvesting)) {
                        $rainwater_harvesting = get_post_type_archive_link('rainwater_harvesting');
                        ?>
                        <div class="rainwate_harvest"><div class="total_rainwater"></div>
                        <?php if ($total_rainwater_harvesting > 0) {?>
                        <a href="<?php echo esc_url($rainwater_harvesting); ?>?lsit=<?php echo get_the_ID(); ?>"><?php echo $total_rainwater_harvesting; ?></a>
                        <?php
                        } else {?>
                        <?php echo $total_rainwater_harvesting; ?>
                        <?php
                        }?>
                        </div>
                        <?php
                        }
                    }
                    if (isset($a['parmalink']) && $a['parmalink'] == true) {
                    ?>
                    <a href="<?php echo get_the_permalink(); ?>">
                    <?php

                    }
                    ?>
                    <?php the_title('<h2 class="entry-title">', '</h2>');?>
                    <?php
                    if (isset($a['parmalink']) && $a['parmalink'] == true) {
                    ?>
                    </a>
                    <?php

                    }
                    ?>
                    <!-- <div class="entry-content">
                    <?php //the_content();?>
                    </div> -->
                    <?php
                    if (isset($gallery_data['author_type'])) {
                    ?>
                    <div class="founder_info"><?php
                    echo $gallery_data['author_type'];
                    ?></div>
                    <?php
                    }
                    if (isset($gallery_data['awards_info'])) {
                    ?>
                    <div class="awards_info"><?php
                    echo $gallery_data['awards_info'];
                    ?></div>
                    <?php
                    }
                    if (isset($gallery_data['awards_date'])) {
                    ?>
                    <div class="awards_date"><?php
                    echo $gallery_data['awards_date'];
                    ?></div>
                    <?php
                    }
                    ?>
                    </div>
                </li>
            <?php
            endwhile;
             echo '</ul>';
        endif;

            echo '</div>';
            wp_reset_query();
    }
                ?>
    </div>
    </div>
    </div>
    <?php
        if ($a['slider'] == true) {
                ?>
            <script>
            jQuery(document).ready(function(){

            /*jQuery(".<?php echo $a['post_type']; ?>").owlCarousel({
                items : 1,
                lazyLoad : true,
                navigation : false
            });*/

            });
            </script>
            <?php

            }
    $full_content_cat = ob_get_clean();
    return $full_content_cat;
}

add_shortcode('TBI_post', 'tbi_dynamic_post_section');

function tbi_dynamic_post_contact($atts, $content = null)
{

    $default = array(
        'post_type' => 'contacts_database',
        'title' => '',
        'count' => -1,
        'slider' => 'false',
        'backgroundimage' => 'false',
        'metakey' => '',
        'rainwater_count' => 'false',
        'parmalink' => 'false',
    );
    $a = shortcode_atts($default, $atts);
    // var_dump($a);
    $content = do_shortcode($content);
    if ($a['count'] != 0) {
        $count = $a['count'];
    }
    ob_start();
    if ($a['post_type'] != '') {
        $custom_link = get_post_type_archive_link($a['post_type']);

        $wpb_all_query = new WP_Query(array(
            'post_type' => $a['post_type'],
            'post_status' => 'publish',
            'posts_per_page' => $count,
        ));
        echo '<div class="spotlight_body_start contact" >';
        echo '<div class="row spotlight_heading" >';
        echo '<div class="col-12">';
        if (isset($a['title']) && $a['title'] != '') {
            echo '<div class="category_title_spotlight">' . $a['title'] . '</div>';
        }
        ?>
<nav class="navbar navbar-light">
  <form class="form-inline example" >
      <input type="hidden" name="taxonomy_search" id="taxonomy_search" value="">
      <input type="hidden" name="location_block_search" id="location_block_search" value="">
    <input class="" type="text" name="search_content" id="search_content" placeholder="Search Contacts Database" aria-label="Search">
    <button class="btn" type="button" onClick="search_contact_db(this);"><i class="fa fa-search"></i></button>

    <!-- <input type="text" placeholder="Search.." name="search">
  <button type="submit"><i class="fa fa-search"></i></button> -->
 
        

  </form>
</nav>
<div class="show_on_desktop_view">
    <div class="solution_lib_block">
    <?php tag_cloud('contacts_database')?>
    </div>
    <div class="location_block">
    <?php tag_cloud('type')?>
    </div>
</div>
<div class="show_on_mobile_view">

<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">FILTER BY CITIES / TYPES</button>

  <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-sm">
            <div class="modal-content">
               <!-- <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal">&times;</button> 
                    <h4 class="modal-title"></h4>
                </div>-->
                <div class="modal-body ">
                <p style="margin-top: 0 !important;">Cities</p>
                <div class="location_block">
                <?php tag_cloud('type')?>
                </div>
                <p style="margin-top: 0 !important;">Types</p>
                <div class="solution_lib_block">
                <?php tag_cloud('contacts_database')?>
                </div>
                
                </div>
                <div class="" style="display:inline;margin-bottom: 2em;">
                <button type="button" class="btn btn-default done_button" data-dismiss="modal">Done</button>
                </div>
            </div>
            </div>
        </div>
</div>
    <?php
echo '</div>';

        // echo '<div class="see_all">';
        // echo '<span>';
        // echo '<a href="' . esc_url($custom_link) . '"> See All</a>';
        // echo '</span>';
        // echo '</div>';
        echo '</div>';
        ?>
    <div class="container">
    <div class="row">
        <div class="search_result_from_contact_database <?php echo $a['post_type']; ?>" >
            <?php
if ($wpb_all_query->have_posts()):
            while ($wpb_all_query->have_posts()): $wpb_all_query->the_post();
                $gallery_data = get_post_meta(get_the_ID(), 'gallery_data', true);
                $background_image = '';
                $background_class = '';
                if (isset($a['backgroundimage']) && $a['backgroundimage'] == true) {
                    $background_image = 'style="background-image : url(' . $gallery_data['background_image_url'] . ')"';
                    $background_class = 'additional_background_image';
                }
                ?>
				<div class="services-block col <?php echo $background_class ?>" <?php echo $background_image; ?>>
                <?php
        $solutions_library = $gallery_data['solutions_library'];      
        $term_list = wp_get_post_terms( get_the_ID(), 'contacts_database', array( 'fields' => 'all' ) );
        //print_r( $term_list[0]->name );
        //$solutions_library != ''
                if (isset($term_list[0]->name)) {
                    $sol = get_term_by('id', $solutions_library, 'solutions_library');
                    echo '<div class="solution_lib_category cont">' . $term_list[0]->name . '</div>';
                }
                the_title('<h2 class="entry-title">', '</h2>');
                $url_info = get_post_meta(get_the_ID(), 'url_info', true);
                if (isset($url_info)) {
                    echo '<div class="solution_lib_url">' . $url_info . '</div>';
                }
                ?>
																																																																																																																																																																				                    <div class="entry-content">
																																																																																																																																																																				                        <?php the_content();?>
																																																																																																																																																																				                    </div>
																																																																																																																																																																				                    <?php
                $email_info = get_post_meta(get_the_ID(), 'email_info', true);
                if (isset($email_info)) {

                    echo '<div class="solution_lib_email">' . $email_info . '</div>';
                }
                $phone_info = get_post_meta(get_the_ID(), 'phone_info', true);
                if (isset($phone_info)) {
                    ?>
																																																																																																																																																																				                                        <div class="phone_founder_info"><?php
        echo $phone_info;
                    ?></div>
																																																																																																																																																																				                    <?php
        }?>
																																																																																																																																																																				                        </div>
																																																																																																																																																																				                        <?php
    endwhile;
        endif;
        echo '</div>';
        wp_reset_query();
    }
    ?>
                    </div>
                </div>
            </div>
        <?php
$full_content_cat = ob_get_clean();
    return $full_content_cat;
}
add_shortcode('contact_list', 'tbi_dynamic_post_contact');
add_action('wp_ajax_nopriv_ajax_search_val', 'search_contact_db');
add_action('wp_ajax_ajax_search_val', 'search_contact_db');
function search_contact_db()
{
    
    $taxonomy_search = $_REQUEST['taxonomy_search'];
    $cid = '';
    $post_type_ids = '';
    $post_ids = '';
    if(isset($taxonomy_search) && $taxonomy_search != ''){
        $taxonomy_search_arr = json_decode(stripslashes($taxonomy_search),true);
        //var_dump($taxonomy_search_arr);
        $tagv = $_REQUEST['tagv'];
    $args = array(
        'post_type' => 'contacts_database', // it's default, you can skip it
        'posts_per_page' => -1,
        'order_by' => 'date', // it's also default
        'order' => 'DESC', // it's also default
            'tax_query' => array(
                array(
                    'taxonomy' => 'contacts_database',
                    'field' => 'slug',
                    'terms' => $taxonomy_search_arr
                )
            )
        );

        $query = new WP_Query( $args );
        
        $post_ids = wp_list_pluck( $query->posts, 'ID' );
       // var_dump($post_ids);
        wp_reset_query();
        //var_dump($query->request);
        //json_to_arr($taxonomy_search);
        
    }
    $location_block_search = $_REQUEST['location_block_search'];
    if(isset($location_block_search) && $location_block_search != ''){
        $location_block_search_arr = json_decode(stripslashes($location_block_search),true);
       
    $args = array(
        'post_type' => 'contacts_database', // it's default, you can skip it
        'posts_per_page' => -1,
        'order_by' => 'date', // it's also default
        'order' => 'DESC', // it's also default
            'tax_query' => array(
                array(
                    'taxonomy' => 'type',
                    'field' => 'slug',
                    'terms' => $location_block_search_arr
                )
            )
        );

        $query = new WP_Query( $args );
        
        $post_type_ids = wp_list_pluck( $query->posts, 'ID' );
        //var_dump($post_type_ids);
        wp_reset_query();
        //var_dump($query->request);
        //json_to_arr($taxonomy_search);
        
    }
    $search_post_id = array_unique(array_merge($post_ids,$post_type_ids));
    //var_dump($search_post_id);
    //die();

    

    if (isset($_REQUEST['search_val']) && $_REQUEST['search_val'] != '') {
        $program_search = $_REQUEST['search_val'];
        // $result = search_contact_database($program_search);
        // var_dump($result);
        /* $args = array(
        'post_type' => array('contacts_database'),
        's' => $program_search,
        'meta_query' => array(
        'relation' => 'OR',
        array(
        'relation' => 'OR',
        array(
        'key' => 'gallery_data',
        'value' => sprintf(':"%s";', $program_search),
        'key' => 'url_info',
        'value' => $program_search,
        'compare' => 'LIKE',
        ),
        array(
        'key' => 'email_info',
        'value' => $program_search,
        'compare' => 'LIKE',
        ), array(
        'key' => 'phone_info',
        'value' => $program_search,
        'compare' => 'LIKE',
        ),
        ),
        ),
        'orderby' => 'title',
        'order' => 'DESC',
        );*/

       //implode(',',$search_post_id);
        $tagv = $_REQUEST['tagv'];
        //var_dump($program_search);
        //var_dump($search_post_id);
        //echo count($search_post_id);
        if(strlen($program_search) < 3 && count($search_post_id) < 1){
            $sql = "SELECT SQL_CALC_FOUND_ROWS wp_posts.ID FROM wp_posts INNER JOIN wp_postmeta ON ( wp_posts.ID = wp_postmeta.post_id ) WHERE 1=1 and";
        
       
       $sql .= " wp_posts.post_type = 'contacts_database' AND (wp_posts.post_status = 'publish' OR
        wp_posts.post_status = 'future' OR wp_posts.post_status = 'draft' OR
        wp_posts.post_status = 'pending' OR wp_posts.post_status = 'private')
        GROUP BY wp_posts.ID ORDER BY wp_posts.post_title DESC ";

       }else{
        $sql = "SELECT SQL_CALC_FOUND_ROWS wp_posts.ID FROM wp_posts INNER JOIN wp_postmeta ON ( wp_posts.ID = wp_postmeta.post_id ) WHERE 1=1 and";
        if(count($search_post_id) > 0){
            $sql .= "  wp_posts.ID in(".implode(',',$search_post_id).") or";
        }
       
       $sql .= "  ((((wp_posts.post_title LIKE '%" . $program_search . "%') OR
        (wp_posts.post_excerpt LIKE '%" . $program_search . "%')
        OR (wp_posts.post_content LIKE '%" . $program_search . "%'))) OR
        ( ( ( wp_postmeta.meta_key = 'url_info' AND wp_postmeta.meta_value LIKE '%" . $program_search . "%' ) OR
        ( wp_postmeta.meta_key = 'email_info' AND wp_postmeta.meta_value LIKE '%" . $program_search . "%' ) 
        OR ( wp_postmeta.meta_key = 'phone_info' AND wp_postmeta.meta_value LIKE '%" . $program_search . "%' )
         ) ))
        AND wp_posts.post_type = 'contacts_database' AND (wp_posts.post_status = 'publish' OR
        wp_posts.post_status = 'future' OR wp_posts.post_status = 'draft' OR
        wp_posts.post_status = 'pending' OR wp_posts.post_status = 'private')
        GROUP BY wp_posts.ID ORDER BY wp_posts.post_title DESC ";
        }
        //echo $sql;
        global $wpdb;
        $results = $wpdb->get_results($sql);
        //var_dump($results);
        //$t = new WP_Query($args);
        //echo $t->post_count;
        //print_r($t->request);
        $total_search = count($results);
        if ($total_search > 0) {
            foreach ($results as $result) {
                $id = $result->ID;
                $post = get_post($id);
                $solutions_library = get_post_meta($id, 'solutions_library', true);
                //var_dump($post);
            echo '<div class="services-block col additional_background_image" style="background-image : url()">';
             $term_list = wp_get_post_terms( $post->ID, 'contacts_database', array( 'fields' => 'all' ) );

                if (isset($term_list[0]->name)) {    
                //if ($solutions_library != '') {
                    $sol = get_term_by('id', $solutions_library, 'contacts_database');
                    //$sol->name
                    echo '<div class="solution_lib_category searchres">' . $term_list[0]->name . '</div>';
                }
                echo '<h2 class="entry-title">';
                echo $post->post_title;
                //the_title('<h2 class="entry-title">', '</h2>');
                echo '</h2>';
                $url_info = get_post_meta($id, 'url_info', true);
                if (isset($url_info)) {
                    echo '<div class="solution_lib_url">' . $url_info . '</div>';
                }
                echo '<div class="entry-content">';
                echo $post->post_content;
                echo '</div/>';
                    $email_info = get_post_meta($id, 'email_info', true);
                if (isset($email_info)) {
                    echo '<div class="solution_lib_email">' . $email_info . '</div>';
                }
                $phone_info = get_post_meta($id, 'phone_info', true);
                if (isset($phone_info)) {
                    echo '<div class="phone_founder_info">';
                    echo $phone_info;
                    echo '</div>';

                }
                echo '</div>';
            }
        }
    }
    die(0);
}
function json_to_arr($taxonomy_search){
    $taxonomy_search_arr = json_decode(stripslashes($taxonomy_search),true);
        //var_dump($taxonomy_search_arr);
    if(count($taxonomy_search_arr) > 0){
        foreach($taxonomy_search_arr as $val){
            $val['category'];
        }
    }    
}
function meta_value_search_from_rainwater_harvesting($post_id)
{
    $wpb_all_query = new WP_Query(array(
        'post_type' => 'rainwater_harvesting',
        'post_status' => 'publish',
        'meta_query' => array(
            array(
                'key' => 'gallery_data',
                'value' => sprintf(':"%s";', $post_id),
                'compare' => 'like',
            ),
        ),
        'posts_per_page' => -1,
    ));
    return isset($wpb_all_query->post_count) ? $wpb_all_query->post_count : 0;
    //var_dump($wpb_all_query->post_count);

}

add_shortcode('STORY_PACKAGE','taxonomy_template_page');
// function taxonomy_template_page(){
//     $story_package = array(
//         'taxonomy' => 'story_package',
//         'hide_empty' => false,
//     );
//     $main_ingredients = get_terms($story_package);
//     var_dump($main_ingredients);
//     foreach($main_ingredients as $main_ingredient) {
//         $dishes = new WP_Query(array(
//             'post_type' => 'post',
//             'post_per_page'=>-1,
//             'taxonomy'=>'main-ingredient',
            
//         ));
//         //'term' => $main_ingredient->slug,
//         $link = get_term_link(intval($main_ingredient->term_id),'main-ingredient');
//         echo "<h2><a href=\"{$link}\">{$main_ingredient->name}</a></h2>";
//         echo '<ul>';
//         while ( $dishes->have_posts() ) {
//             $dishes->the_post();
//             $link = get_permalink($post->ID);
//             $title = get_the_title();
//             echo "<li><a href=\"{$link}\">{$title}</a></li>";
//         }
//         echo '</ul>';
//     }
// }

function taxonomy_template_page() {
        
    
    $output ='<div class="row story_pack"><div class="story_package_see_all">&nbsp;</div></div>';
   
   $param = 'taxonomy=story_package&type=post&number='.$count.'';
   
    $category_list = get_categories($param); 
   
    if(count($category_list)>0){
        foreach($category_list as $key=>$value){
            $f_parmalink = find_first_post_link($value);
            $output .= story_packages_front_design_lis_page($value,$f_parmalink,$key);
        }
    }
   // 
    //var_dump($output);
    return $output;
}
function find_first_post_link($vk){
    //var_dump($vk);
    $args = array('post_type' => 'post',
    'orderby' => 'date',
	'order'   => 'ASC',
    'tax_query' => array(
        array(
            'taxonomy' => 'story_package',
            'field' => 'slug',
            'terms' => $vk->slug,
        ),
    ),
 );

 $loop = new WP_Query($args);
if($loop->posts[0]->ID!=''){
    return get_post_permalink($loop->posts[0]->ID);
}else{
    return false;
}
 //var_dump($loop->posts[0]->ID);
}

function story_packages_front_design_lis_page($param,$ff_parma,$css_track){
    global $wpdb, $post;
    
    //$post_id = $param['{ID}'];
    $cat_id = $param->term_id;

               
                //var_dump($category);
                
                ob_start();

    $total_stories = $param->count;
    $image_id = get_term_meta( $cat_id, 'showcase-taxonomy-image-id', true );
    $image_id1 = get_term_meta( $cat_id, 'showcase-taxonomy-image-id1', true );
    $cat_name = get_term_meta( $cat_id, 'cat', true );


        ?>
        <div class="desktop_require_class shortcode story_package_listing_page_unique story_package_first_border border_track_<?php echo $css_track;?>">
            <div class="row inner_div_to_remove_padding">
                     <div id="tab-recent" class="tab-pane" role="tabpanel" aria-labelledby="recent-tab">
                        <?php if ( $image_id ){ ?>

                            <div class="post-content" itemprop="mainContentOfPage">

                                <div class="thumbnail-post">
                                    <?php
                                    
                                    ?>
                                    <!-- <a href="<?php the_permalink(); ?>"> -->
                                        <?php 
                                        if( $image_id ) { ?>
                                            <?php echo wp_get_attachment_image( $image_id, 'thumbnail' ); ?>
                                          <?php } 
                                        ?>
                                    <div class="mask"><div class="icon"></div></div>
                                    <!-- </a> -->
                                    <?php
                                    if(isset($cat_name) && $cat_name!=''){                                    
                                    ?>
                                    <div class="col category_display"><?php echo $cat_name?></div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        <?php }else{?>

                            <div class="post-content" itemprop="mainContentOfPage">

                                <div class="thumbnail-post">
                                    <!-- <a href="<?php the_permalink(); ?>"> -->
                                    <img class="d-block w-100" src="<?php echo get_stylesheet_directory_uri()?>/assets/images/no-thumbnail-post.jpg" alt="" itemprop="image">
                                    <div class="mask"><div class="icon"></div></div>
                                    <!-- </a> -->
                                    <?php
                                    if(isset($cat_name)  && $cat_name!=''){                                    
                                    ?>
                                    <div class="col category_display"><?php echo $cat_name?></div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php } ?>
                            
                        
                            <div class="post-holder title_with_author"><?php //the_permalink(); ?>
                            <div class="story_package_tirle">
                            <?php 
                            if($ff_parma){?>
                            <a href="<?php echo $ff_parma;?>">
                            <?php }?>
                            <?php echo $param->name;; ?>
                            <?php 
                            if($ff_parma){?>
                            </a><?php }?>
                            </div>
                            <div class="story_package_description">
                                <?php echo $param->description;; ?>
                            </div>
                            <div class="social_icon_for_story_package"><?php echo share_button_icon();?></div>
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
                            <div class="col-12 text-right p-3 black_arrow" >
                            
                            <?php
                            
                            if($total_stories>0){ 
                                    echo '<a href="javascript:void(0);" class="slide_down" rel="slide_box_selector_'. $cat_id.'">';
                                echo $total_stories;
                                ?>
                                Stories <span class="down_arrow"><img width="20" src="<?php echo get_stylesheet_directory_uri();?>/images/down.png"></span>
                                
                                <?php
                                echo '</a>';
                            }else{
                            echo $total_stories;
                                ?>
                                Stories <span class="down_arrow"><img width="16" src="<?php echo get_stylesheet_directory_uri();?>/images/down.png"></span>
                                
                                <?php 
                            }
                            ?>
                            
                            </div>
    
                        </div>
            </div>
            <div class="row story_border_image"><img style="" src="<?php echo get_stylesheet_directory_uri();?>/images/u27.png"></div>
            <?php
            if($total_stories>0){ ?>
                <div class="row slide_box_selector_details background_image_from_shortcode" id="slide_box_selector_<?php echo $cat_id;?>" >
                 <div class="background_image_from_shortcode_setup story_package_box_image_unique" style="background-image:url('<?php echo wp_get_attachment_image_url( $image_id, 'full' );?>');"></div>
                 <?php
                    $some_args = array(
                        'tax_query' => array(
                            array('taxonomy' => 'story_package',
                            'field' => 'term_id',
                            'terms' => $cat_id,)
                            
                        ),
                        'post_status' => 'publish',
                        'post_type' => 'post',
                        'orderby'   => 'date',
                            'order' => 'ASC',
                    );
                    $some_args = array(
                        'tax_query' => array(
                            array('taxonomy' => 'story_package',
                            'field' => 'term_id',
                            'terms' => $cat_id,)
                            
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
                    
                    $s = get_posts( $some_args );
                    //var_dump($s);
                    $total_post = count($s);
                    if( $total_post>0 ){
                        $i= 1;
                            foreach ( $s as $kk=>$val ) {
                            // var_dump($p);
                                ?>
                                <div class="row col-12">
                                    <div class="background_shade"></div>
                                    <div class="col-3 block story_package_block_unique"><div class="date_circle"><p>
                                    
                                    <?php 
                                    $post_id = $val->ID;
                                    
                                    $thumb = get_the_post_thumbnail( $post_id, 'thumbnail', array( 'class' => 'img-responsive' ) );
                                    echo $thumb;//echo date('M j', strtotime($p->post_date)); ;?></p>
                                    </div>
                                    <span class="year_story"><?php echo ($kk+1);//echo date('Y', strtotime($val->post_date)); ;?></span>
                                    </div>
                                    <div class="col-9 track_around">
                                        <div class="story_title"><a href="<?php echo get_permalink( $post_id )?>">
                                        <?php echo custom_echo($val->post_title,90);?>
                                        </a></div>
                                        <div class="story_author <?php echo $total_post.' ';echo ($i==$total_post)?'no_border_for_story_pack':'';?>""> <span class="author_style"><?php echo date('j F, Y', strtotime($val->post_date));//echo the_author_meta( 'user_login' , $p->post_author );?></span>
                                        </div>
                                    </div>
                                </div>
                                <?php
                              // $s->the_post();
                        if($i==$subcount){break;}
                        $i++;
                            }
                              ?>
                                    <div class="col-12 go_to_story" style="text-align:right;">
                                    <div class="row up_class_story"> <div class="sub_up_story"><a href="javascript:void(0);" class="slide_down" rel="slide_box_selector_<?php echo $cat_id;?>"><img style="" width="15" src="<?php echo get_stylesheet_directory_uri();?>/images/up_gray.png"></a></div></div>    
                                    <span>
                                    <?php 
                            if($ff_parma){?>
                            <a class="black_color" href="<?php echo $ff_parma;?>">Go To Story</a>
                            <?php }else{echo 'Go To Story';}?>    
                                        </span><img src="<?php echo get_stylesheet_directory_uri();?>/images/right.png" width="15"> </div>
                                    <div class="row story_border_image"><img style="" src="<?php echo get_stylesheet_directory_uri();?>/images/u27.png"></div>
                                    <?php

                           /* if($subcount < $total_post){
                                ?>
                                <div class="col-12 go_to_story" style="text-align:right;">
                                <div class="row up_class_story"> <div class="sub_up_story"><a href="javascript:void(0);" class="slide_down" rel="slide_box_selector_<?php echo $cat_id;?>"><img style="" width="15" src="<?php echo get_stylesheet_directory_uri();?>/images/up_gray.png"></a></div></div>    
                                <span>Go To Story</span><img src="<?php echo get_stylesheet_directory_uri();?>/images/right.png" width="15"> </div>
                                <div class="row story_border_image"><img style="" src="<?php echo get_stylesheet_directory_uri();?>/images/u27.png"></div>
                                <?php
                            }*/
                        }
                        ?>
                </div>
        <?php
            }
            echo '</div>';
    $my_full_html = ob_get_clean();
    return $my_full_html;


}