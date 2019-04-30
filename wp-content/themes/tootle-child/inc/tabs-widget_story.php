<?php
define('WIDGET_TITLE_STORY', 'Story Package');
define('WIDGET_TITLE_STORY_SLUG', 'recent-posts-plus-story');

class RecentPostsPlus_story extends WP_Widget {
    
    private $default_config = array(
        'title' => '',
        'count' => 5,
        'subcount' => 3,
        'technology'=>'false',
        'tourism'=>'false',
        'pod_cast'=>'false',
        'video'=>'false',
        'include_post_thumbnail' => 'false',
        'video_slider_thumbnail' => '',
        'include_post_excerpt' => 'false',
        'truncate_post_title' => '',
        'truncate_post_title_type' => 'char',
        'truncate_post_excerpt' => '',
        'truncate_post_excerpt_type' => 'char',
        'truncate_elipsis' => '...',
        'post_thumbnail_width' => '50',
        'post_thumbnail_height' => '50',
        'post_date_format' => 'M j',
        'wp_query_options' => '',
        'widget_output_template' => '<li>{THUMBNAIL}<a title="{TITLE_RAW}" href="{PERMALINK}">{TITLE}</a>{EXCERPT}</li>', //default format
        'show_expert_options' => 'false'
    );
    
    /** constructor */    
    function __construct() {
        $widget_ops = array(
            'classname'   => 'widget_recent_entries_cat', 
            'description' => __('The most recent posts filter by category. Includes advanced options.')
        );
        parent::__construct(WIDGET_TITLE_STORY_SLUG, __(WIDGET_TITLE_STORY), $widget_ops);
    }

    /** @see WP_Widget::widget */
    function widget( $args, $instance ) {
        extract( $args );
        echo $before_widget;
        
        $title = apply_filters( 'widget_title', empty($instance['title']) ? 'Recent Posts' : $instance['title'], $instance, $this->id_base);        
        $widget_output_template = (empty($instance['widget_output_template'])) ? $this->default_config['widget_output_template'] : $instance['widget_output_template'];
        
        echo $before_title . $title . $after_title;
        
        $output = $this->parse_output($instance);
        
        //if the first tag of the widget_output_template is a <li> tag then wrap it in <ul>
        if(stripos(ltrim($widget_output_template), '<li') === 0 && $video_slider_thumbnail=='false')
            echo '<ul>'.$output.'</ul>';
        else
            echo $output;
        
        echo $after_widget;
    }
    
    function parse_output($instance) {
        
        $output = '';
        
        foreach($this->default_config as $key => $val) {
            $$key = (empty($instance[$key])) ? $val : $instance[$key];
        }
        $technology_cond = '';
        $tourism_cond = '';
        $pod_cast_cond = '';
        $video_cond = '';
       
        if($technology == 'true'){
           $technology_cond = array(
                    'key'       => 'gallery_data',
                    'value'     => 'technology',
                    'compare'   => 'like',
                );
        }
        if($tourism == 'true'){
            
           $tourism_cond = array(
                    'key'       => 'gallery_data',
                    'value'     => 'tourism',
                    'compare'   => 'like',
                );
        }
        if($pod_cast == 'true'){
           $pod_cast_cond = array(
                    'key'       => 'gallery_data',
                    'value'     => 'pod_cast',
                    'compare'   => 'like',
                );
        }
        if($video == 'true'){
           $video_cond = array(
                    'key'       => 'gallery_data',
                    'value'     => 'video',
                    'compare'   => 'like',
                );
        }
        


         $meta_query = array(
                'relation'  => 'OR',$technology_cond ,$tourism_cond,$pod_cast_cond,$video_cond
            );

         if($video_slider_thumbnail==''){
            $default_query_args = array(
                'post_type' => 'story_packages', 
                'posts_per_page' => $count, 
                'orderby' => 'date', 
                'order' => 'DESC',
                'ignore_sticky_posts' => 1,
                'meta_query'=>$meta_query
            );
         }else{
            $default_query_args = array(
                'post_type' => $video_slider_thumbnail, 
                'posts_per_page' => $count, 
                'orderby' => 'date', 
                'order' => 'DESC',
                'ignore_sticky_posts' => 1,
                'meta_query'=>$meta_query
            );
         }
        
        $query_args = json_decode($wp_query_options, true);
        if($query_args == NULL) $query_args = array();
        
        /*
        $the_query = new WP_Query( array_merge($default_query_args, $query_args) );
        //var_dump($the_query->request);
        if( $the_query->have_posts() ) {
            
            //Deal with custom date formats, get a list of the custom tags ie {DATE[D \of j]}, {DATE[M j]}, etc...
            $date_matches = array();
            preg_match_all('/\{DATE\[(.*?)\]\}/', $widget_output_template, $date_matches);
            
            //Deal with custom meta tags, e.g. [META[key]]
            $meta_matches = array();
            preg_match_all('/\{META\[(.*?)\]\}/', $widget_output_template, $meta_matches);
            
            //check if custom ellipsis has been defined, use strpos before preg_match since it is a lot faster
            $truncate_elipsis_template = '';
            
            if(preg_match('/\{ELLIPSIS\}(.*?)\{\/ELLIPSIS\}/', $widget_output_template, $ellipsis_match) > 0) {
                $truncate_elipsis_template = $ellipsis_match[1];
            }
            if($video_slider_thumbnail=='true'){
                $output .= '<div id="owl-demo" class="owl-carousel">';
            }
            while ( $the_query->have_posts() ) { $the_query->the_post();
                
                $ID = get_the_ID();
                
                if($include_post_thumbnail == "false") {
                    $POST_THUMBNAIL = '';
                } else {
                    $POST_THUMBNAIL = get_the_post_thumbnail($ID, array($post_thumbnail_width, $post_thumbnail_height));
                }
                
                $POST_TITLE_RAW = strip_tags(get_the_title($ID));
                if(empty($truncate_post_title))
                    $POST_TITLE = $POST_TITLE_RAW;
                else {
                    if($truncate_post_title_type == "word")
                        $POST_TITLE = $this->_truncate_words($POST_TITLE_RAW, $truncate_post_title, $truncate_elipsis);
                    else
                        $POST_TITLE = $this->_truncate_chars($POST_TITLE_RAW, $truncate_post_title, $truncate_elipsis);
                }
                
                $widget_ouput_template_params = array(
                    '{ID}' => $ID,
                    '{THUMBNAIL}' => $POST_THUMBNAIL,
                    '{TITLE_RAW}' => $POST_TITLE_RAW,
                    '{TITLE}' => $POST_TITLE,
                    '{PERMALINK}' => get_permalink($ID),
                    '{DATE}' => get_the_date($post_date_format),
                    '{AUTHOR}' => get_the_author(),
                    '{AUTHOR_LINK}' => get_the_author_link(),
                    '{AUTHOR_AVATAR}' => ((strpos($widget_output_template, '{AUTHOR_AVATAR}') !== FALSE) ? get_avatar(get_the_author_meta('user_email')) : ""),
                    '{COMMENT_COUNT}' => ((strpos($widget_output_template, '{COMMENT_COUNT}') !== FALSE) ? get_comments_number() : "") //Only load comment count if necessary since it might cause more db queries
                );
                
                //Deal with custom date formats, parse the custom tags and add the date value
                foreach($date_matches[0] as $key => $date_match) {
                    if(!empty($date_matches[1][$key]))
                        $widget_ouput_template_params[$date_match] = get_the_date($date_matches[1][$key]);
                    else
                        $widget_ouput_template_params[$date_match] = '';
                }
                
                //Deal with meta fields
                foreach($meta_matches[0] as $key => $meta_match) {
                    if(!empty($meta_matches[1][$key]))
                        $widget_ouput_template_params[$meta_match] = get_post_meta($ID, $meta_matches[1][$key], true);
                    else
                        $widget_ouput_template_params[$meta_match] = '';
                }
                
                //Deal with {ELLIPSIS}{/ELLIPSIS} tags, we parse it with the template tags, so you can use these tags in the excerpt
				$truncate_elipsis_excerpt = $truncate_elipsis;
                if(!empty($truncate_elipsis_template)) {
                    $truncate_elipsis_excerpt = str_replace(array_keys($widget_ouput_template_params), array_values($widget_ouput_template_params), $truncate_elipsis_template);
                    $widget_output_template = preg_replace('/\{ELLIPSIS\}(.*?)\{\/ELLIPSIS\}/', '', $widget_output_template); //remove {ELLIPSIS}{/ELLIPSIS} tags from widget_output_template
                }
                
                //Deal with post excerpt
                if($include_post_excerpt == "false") {
                    $POST_EXCERPT_RAW = $POST_EXCERPT = '';
                } else {
                    $POST_EXCERPT_RAW = $this->_custom_trim_excerpt();
                    if(empty($truncate_post_excerpt))
                        $POST_EXCERPT = $POST_EXCERPT_RAW;
                    else
                        $POST_EXCERPT = $this->_custom_trim_excerpt($truncate_post_excerpt, $truncate_elipsis_excerpt, $truncate_post_excerpt_type);
                }
                
                $widget_ouput_template_params['{EXCERPT_RAW}'] = $POST_EXCERPT_RAW;
                $widget_ouput_template_params['{EXCERPT}'] = $POST_EXCERPT;
                
                //Deal with embedded php code, only eval if php tags exist and current user is admin
                $widget_output_template_eval = $widget_output_template;
                
                if(preg_match("/<\?(.*?)\?>/", $widget_output_template) > 0) {
                    ob_start();
                    $eval_result = eval("?>".$widget_output_template);
                    $widget_output_template_eval = ob_get_clean();
                }
                if($video_slider_thumbnail=='true'){

                    $output .= '<div class="item selected_product" rel="'. $ID.' " >';
                    $output .= '<div class="col-12"><span class="video_title">'.$widget_ouput_template_params['{TITLE}'].'</span><span class="video_date">'.$widget_ouput_template_params['{DATE}'].'</span>';
                    $gallery =  get_post_meta( $ID , 'gallery_data' , true ); 
                    if(isset($gallery['youtube_link'])){
                        $link_embed = youtube_link_to_embeded_code($gallery['youtube_link']);
                        //var_dump($link_embed);
                    $output .= '<div class="col-12 video_slide">'.$link_embed.'</div>';
                    }
                    $output .= '</div>';
                    $output .= '</div>';
                    wp_enqueue_script( 'owl-style-owlstart',  get_stylesheet_directory_uri() . '/js/owl.start.js' );

                }else if($video_slider_thumbnail=='story_packages'){
                    $output .= story_packages_front_design($widget_ouput_template_params,$subcount);
                }else{

                    $output .= str_replace(array_keys($widget_ouput_template_params), array_values($widget_ouput_template_params), $widget_output_template_eval);
                }
                
            } //end while
            if($video_slider_thumbnail=='true'){
                $output .= '</div>';
            }
        }
        
        wp_reset_postdata();
        */
        $output ='<div class="row story_pack"><div class="story_package_see_all"><a class="border_blank" id=""  href="#"><small>SEE ALL</small></a></div></div>';
       
       $param = 'taxonomy=story_package&type=post&number='.$count.'&hide_empty=0';
       
        $category_list = get_categories($param); 

        if(count($category_list)>0){
            foreach($category_list as $key=>$value){
                $output .= $this->story_packages_front_design($value,$subcount);
            }
        }
       // 
        //var_dump($output);
        return $output;
    }
    /* Replacement to WordPress overly simplistic excerpt trimming function see http://aaronrussell.co.uk/legacy/improving-wordpress-the_excerpt/ */
    function _custom_trim_excerpt($excerpt_length = NULL, $excerpt_more = NULL, $truncate_type = "word") {
        
        global $post;
        
        //If post is password protected then return empty string
        if(!empty($post->post_password))
            return '';
        
        $text = $post->post_excerpt;
        if($text == '') {
            $text = $post->post_content;
            
            //Deal with more tag, if it exists then only grab the content before it
            if ( preg_match('/<!--more(.*?)?-->/', $text, $matches) ) {
                $text = explode($matches[0], $text, 2);
                $text = $text[0];
            }
        }
        
        $text = strip_shortcodes($text);
        
        $text = str_replace(']]>', ']]&gt;', $text);
        //$text = str_replace('\]\]\>', ']]&gt;', $text);
        $text = preg_replace('@<script[^>]*?>.*?</script>@si', '', $text); // Strip out javascript including tag contents
        $text = preg_replace('@<style[^>]*?>.*?</style>@siU', '', $text); // Strip style tags including tag contents
        $text = preg_replace('@<![\s\S]*?--[ \t\n\r]*>@', '', $text); // Strip multi-line comments including CDATA since this is included in char count
        $text = strip_tags($text);
        
        $excerpt_length = ($excerpt_length === NULL) ? apply_filters('excerpt_length', 55) : $excerpt_length; 
        $excerpt_more = ($excerpt_more === NULL) ? apply_filters('excerpt_more', ' ' . '[...]') : $excerpt_more; 
        
        if($truncate_type == "word") {
            $text = $this->_truncate_words($text, $excerpt_length, $excerpt_more);
        } else {
            $text = $this->_truncate_chars($text, $excerpt_length, $excerpt_more);
        }
        
        // Lets just apply the default filters but not the_content filter so plugins that have added to it don't modify the content
        $text = wptexturize($text);
        $text = convert_smilies($text);
        $text = convert_chars($text);
        $text = wpautop($text);
        //$text = shortcode_unautop($text); //shortcodes have been stripped so it's not needed
        
        return $text;
    }
    
    function _truncate_chars($text, $limit, $ellipsis = '...') {
        if($limit) {
            if( strlen($text) > $limit )
                $text = trim(substr($text, 0, $limit)).$ellipsis;
        }
        return $text;
    }
    
    function _truncate_words($text, $limit, $ellipsis = '...') {
        if($limit) {
            $words = preg_split("/[\n\r\t ]+/", $text, $limit + 1, PREG_SPLIT_NO_EMPTY|PREG_SPLIT_OFFSET_CAPTURE);
            if (count($words) > $limit) {
                end($words); //ignore last element since it contains the rest of the string after applying limit
                $last_word = prev($words);
                
                $text =  substr($text, 0, $last_word[1] + strlen($last_word[0])) . $ellipsis;
            }
        }
        return $text;
    }
    
    /** @see WP_Widget::update */
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        
        $instance['title'] = strip_tags($new_instance['title']);

        
        $instance['technology'] = strip_tags($new_instance['technology']);
        if( empty($instance['technology']) ) $instance['technology'] = 'false';
        $instance['tourism'] = strip_tags($new_instance['tourism']);
        if( empty($instance['tourism']) ) $instance['tourism'] = 'false';
        $instance['pod_cast'] = strip_tags($new_instance['pod_cast']);
        if( empty($instance['pod_cast']) ) $instance['pod_cast'] = 'false';
        $instance['video'] = strip_tags($new_instance['video']);
        if( empty($instance['video']) ) $instance['video'] = 'false';

        $instance['count'] = strip_tags($new_instance['count']);
         $instance['subcount'] = strip_tags($new_instance['subcount']);
        
        
        $instance['video_slider_thumbnail'] = strip_tags( $new_instance[ 'video_slider_thumbnail' ] );
        //if( empty($instance['video_slider_thumbnail']) ) $instance['video_slider_thumbnail'] = 'false';
         
        $instance['include_post_thumbnail'] = strip_tags( $new_instance[ 'include_post_thumbnail' ] );
        if( empty($instance['include_post_thumbnail']) ) $instance['include_post_thumbnail'] = 'false';
         
        $instance['include_post_excerpt'] = strip_tags( $new_instance[ 'include_post_excerpt' ] );
        if( empty($instance['include_post_excerpt']) ) $instance['include_post_excerpt'] = 'false';
        
        $instance['truncate_post_title'] = strip_tags( $new_instance[ 'truncate_post_title' ] );
        $instance['truncate_post_title_type'] = strip_tags( $new_instance[ 'truncate_post_title_type' ] );
        $instance['truncate_post_excerpt'] = strip_tags( $new_instance[ 'truncate_post_excerpt' ] );
        $instance['truncate_post_excerpt_type'] = strip_tags( $new_instance[ 'truncate_post_excerpt_type' ] );
        $instance['truncate_elipsis'] = strip_tags( $new_instance[ 'truncate_elipsis' ] );
        $instance['post_thumbnail_width'] = strip_tags( $new_instance[ 'post_thumbnail_width' ] );
        $instance['post_thumbnail_height'] = strip_tags( $new_instance[ 'post_thumbnail_height' ] );
        $instance['wp_query_options'] = $new_instance[ 'wp_query_options' ];
        $instance['widget_output_template'] = $new_instance[ 'widget_output_template' ];
        $instance['show_expert_options'] = strip_tags( $new_instance[ 'show_expert_options' ] );
        $instance['post_date_format'] = strip_tags( $new_instance[ 'post_date_format' ] );
        
        return $instance;
    }

    /** @see WP_Widget::form */
    function form( $instance ) {
        global $card_type_array;
        if ( $instance ) {
            foreach($this->default_config as $key => $val) {
                $$key = esc_attr($instance[$key]);
            }            
        } else {
            /* DEFAULT OPTIONS */
            foreach($this->default_config as $key => $val) {
                $$key = $val;
            }
        }
        ?>
        
        <script type="text/javascript">
            jQuery(document).ready(function($) {    
                $('.rpp_show-expert-options').trigger('change');
            });
        </script>
        
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <p><?php
        ?>
            <label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Number of posts to show:'); ?></label> 
            <input id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" size="3" value="<?php echo $count; ?>" />
        </p>
       <?php  /* <p>
            <label for="<?php echo $this->get_field_id('option'); ?>"><?php _e('Filter Option:'); ?></label> 
            <div class="row col-12"><?php

            if(count($card_type_array)){
                foreach ($card_type_array as $key => $value) {
                   
    
                ?>
              <div class=" row col-12 <?php echo $key?>" style="padding: 5px;"> <div class="col-6 "><?php echo $value?> </div><div class="col-6 "><input type="checkbox" name="<?php echo $this->get_field_name($key); ?>" id="<?php echo $this->get_field_name($key); ?>" value="true" class="checkbox" <?php echo (($technology == 'true' && $key=='technology')||($tourism == 'true' && $key=='tourism')||($pod_cast == 'true' && $key=='pod_cast')||($video == 'true' && $key=='video')) ? 'checked="checked"' : '' ?>  ></div></div>
                <?php
                }
            }
            ?>
            </div>
        </p> */?>
        <p>
            <?php if( current_theme_supports('post-thumbnails') ): ?>
                <div>
                
                

                <label for="<?php echo $this->get_field_id('video_slider_thumbnail'); ?>" style=""><?php _e('Post Type'); ?> : </label>
                Story Packages
                    <div style="display: none;">
                   <?php post_type($this->get_field_name('video_slider_thumbnail'),$video_slider_thumbnail);?>
                   </div>
                </div>
            <?php endif; ?>

            <p><?php
        ?>
            <label for="<?php echo $this->get_field_id('subcount'); ?>"><?php _e('Number of Sub-posts to show:'); ?></label> 
            <input id="<?php echo $this->get_field_id('subcount'); ?>" name="<?php echo $this->get_field_name('subcount'); ?>" type="text" size="3" value="<?php echo $subcount; ?>" />
        </p>

            <?php if( current_theme_supports('post-thumbnails') ): ?>
                <input id="<?php echo $this->get_field_id('include_post_thumbnail'); ?>" name="<?php echo $this->get_field_name('include_post_thumbnail'); ?>" type="checkbox" value="true"  class="checkbox" <?php echo ($include_post_thumbnail == 'true') ? 'checked="checked"' : '' ?> />
                <label for="<?php echo $this->get_field_id('include_post_thumbnail'); ?>"><?php _e('Include post thumbnail'); ?></label><br>
            <?php endif; ?>

            <input id="<?php echo $this->get_field_id('include_post_excerpt'); ?>" name="<?php echo $this->get_field_name('include_post_excerpt'); ?>" type="checkbox" value="true" class="checkbox" <?php echo ($include_post_excerpt == 'true') ? 'checked="checked"' : '' ?> />
            <label for="<?php echo $this->get_field_id('include_post_excerpt'); ?>"><?php _e('Include post excerpt'); ?></label><br>
            
            <br>
            
            <input class="rpp_show-expert-options checkbox" id="<?php echo $this->get_field_name('show_expert_options'); ?>" name="<?php echo $this->get_field_name('show_expert_options'); ?>" type="checkbox" value="true" <?php echo ($show_expert_options == 'true') ? 'checked="checked"' : '' ?> /> 
            <label for="<?php echo $this->get_field_id('show_expert_options'); ?>"><?php _e('Show expert options'); ?></label>
        </p>
        
        <div class="rpp_expert-panel" style="display:none; margin-top: 10px">
        
            <p>
                <label for="<?php echo $this->get_field_id('truncate_post_title'); ?>"><?php _e('Limit post title:'); ?></label> 
                <input id="<?php echo $this->get_field_id('truncate_post_title'); ?>" name="<?php echo $this->get_field_name('truncate_post_title'); ?>" type="text" size="2" value="<?php echo $truncate_post_title; ?>" />
                <select id="<?php echo $this->get_field_id('truncate_post_title_type'); ?>" name="<?php echo $this->get_field_name('truncate_post_title_type'); ?>">
                      <option value="char" <?php echo ($truncate_post_title_type == 'char') ? 'selected="selected"' : '' ?>>Chars</option>
                      <option value="word" <?php echo ($truncate_post_title_type == 'word') ? 'selected="selected"' : '' ?>>Words</option>
                </select>
                <br>
                
                <label for="<?php echo $this->get_field_id('truncate_post_excerpt'); ?>"><?php _e('Limit post excerpt:'); ?></label> 
                <input id="<?php echo $this->get_field_id('truncate_post_excerpt'); ?>" name="<?php echo $this->get_field_name('truncate_post_excerpt'); ?>" type="text" size="2" value="<?php echo $truncate_post_excerpt; ?>" />
                <select id="<?php echo $this->get_field_id('truncate_post_excerpt_type'); ?>" name="<?php echo $this->get_field_name('truncate_post_excerpt_type'); ?>">
                      <option value="char" <?php echo ($truncate_post_excerpt_type == 'char') ? 'selected="selected"' : '' ?>>Chars</option>
                      <option value="word" <?php echo ($truncate_post_excerpt_type == 'word') ? 'selected="selected"' : '' ?>>Words</option>
                </select>
                <br>
                
                <label for="<?php echo $this->get_field_id('truncate_elipsis'); ?>"><?php _e('Limit ellipsis:'); ?></label> 
                <input id="<?php echo $this->get_field_id('truncate_elipsis'); ?>" name="<?php echo $this->get_field_name('truncate_elipsis'); ?>" type="text" size="3" value="<?php echo $truncate_elipsis; ?>" /><br>
                
                <br>
                
                <label for="<?php echo $this->get_field_id('post_date_format'); ?>"><?php _e('Post date format:'); ?></label> <a title="View Documentation" target="_blank" href="http://www.pjgalbraith.com/2011/08/recent-posts-plus/">(?)</a>
                <input id="<?php echo $this->get_field_id('post_date_format'); ?>" name="<?php echo $this->get_field_name('post_date_format'); ?>" type="text" size="3" value="<?php echo $post_date_format; ?>" />
            </p>
            
            <?php if( current_theme_supports('post-thumbnails') ): ?>
                <p>
                    <label for="<?php echo $this->get_field_id('post_thumbnail_width'); ?>"><?php _e('Thumbnail size (WxH):'); ?></label> 
                    <input id="<?php echo $this->get_field_id('post_thumbnail_width'); ?>" name="<?php echo $this->get_field_name('post_thumbnail_width'); ?>" type="text" size="3" value="<?php echo $post_thumbnail_width; ?>" style="width: 40px" />
                    <input id="<?php echo $this->get_field_id('post_thumbnail_height'); ?>" name="<?php echo $this->get_field_name('post_thumbnail_height'); ?>" type="text" size="3" value="<?php echo $post_thumbnail_height; ?>" style="width: 40px" />
                </p>
            <?php endif; ?>
        
            <p>
                <label for="<?php echo $this->get_field_id('wp_query_options'); ?>"><?php _e('WP_Query Options'); ?></label> <a title="View Documentation" target="_blank" href="http://www.pjgalbraith.com/2011/08/recent-posts-plus/">(?)</a><br />
                <textarea id="<?php echo $this->get_field_id('wp_query_options'); ?>" name="<?php echo $this->get_field_name('wp_query_options'); ?>" style="width:222px; height: 100px; font-size: 80%"><?php echo $wp_query_options; ?></textarea>
            </p>
            
            <p>
                <label for="<?php echo $this->get_field_id('widget_output_template'); ?>"><?php _e('Widget Output Template'); ?></label> <a title="View Documentation" target="_blank" href="http://www.pjgalbraith.com/2011/08/recent-posts-plus/">(?)</a><br />
                <textarea id="<?php echo $this->get_field_id('widget_output_template'); ?>" name="<?php echo $this->get_field_name('widget_output_template'); ?>" style="width:222px; height: 100px; font-size: 80%"><?php echo $widget_output_template; ?></textarea>
            </p>
        
        </div>
        
        <?php 
    }
    
    /** Appends the form script tag to the admin head to allow toggling the expert options panel */
    static function rpp_form_script($hook_suffix) { 
        
        if($hook_suffix == 'widgets.php') {
            wp_enqueue_script(
                'rpp_widget_script', 
                get_stylesheet_directory_uri() .'/admin/js/admin-script.js',
                array('jquery')
            );
        }
    }
     static function front_rpp_form_script($hook_suffix) { 
        var_dump($instance);
        var_dump( $video_slider_thumbnail);
        if($video_slider_thumbnail == 'true'){
            wp_enqueue_script( 'owl-slick',  get_stylesheet_directory_uri() . '/js/owl.carousel.js', array ( 'jquery' ), 1.1, true);
            wp_enqueue_style( 'owl-style-name',  get_stylesheet_directory_uri() . '/js/owl.carousel.css' );
            wp_enqueue_style( 'owl-style-owl-theme',  get_stylesheet_directory_uri() . '/js/owl.theme.css' );
            wp_enqueue_script( 'owl-style-owlstart',  get_stylesheet_directory_uri() . '/js/owl.start.js' );
        }
        /*if($hook_suffix == 'widgets.php') {
            wp_enqueue_script(
                'rpp_widget_script', 
                get_stylesheet_directory_uri() .'/admin/js/admin-script.js',
                array('jquery')
            );
        }*/
    }
    function story_packages_front_design($param,$subcount=0){
        global $wpdb, $post;
        
        //$post_id = $param['{ID}'];
        $cat_id = $param->term_id;
    
                    /*
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
                    */
                    //var_dump($category);
                    
                    
    
                    
                    ob_start();
    
        $total_stories = $param->count;
        $image_id = get_term_meta( $cat_id, 'showcase-taxonomy-image-id', true );
        $cat_name = get_term_meta( $cat_id, 'cat', true );
    
    
            ?>
                <div class="row">
                         <div id="tab-recent" class="tab-pane" role="tabpanel" aria-labelledby="recent-tab">
                            <?php if ( $image_id ){ ?>
    
                                <div class="post-content" itemprop="mainContentOfPage">
    
                                    <div class="thumbnail-post">
                                        <?php
                                        
                                        ?>
                                        <a href="<?php the_permalink(); ?>">
                                            <?php 
                                            if( $image_id ) { ?>
                                                <?php echo wp_get_attachment_image( $image_id, 'thumbnail' ); ?>
                                              <?php } 
                                            ?>
                                        <div class="mask"><div class="icon"></div></div>
                                        </a>
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
                                        <a href="<?php the_permalink(); ?>">
                                        <img class="d-block w-100" src="<?php echo get_stylesheet_directory_uri()?>/assets/images/no-thumbnail-post.jpg" alt="" itemprop="image">
                                        <div class="mask"><div class="icon"></div></div>
                                        </a>
                                        <?php
                                        if(isset($cat_name)){                                    
                                        ?>
                                        <div class="col category_display"><?php echo $cat_name?></div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                <?php } ?>
                                
                            
                                <div class="post-holder title_with_author">
                                <a href="<?php the_permalink(); ?>"><?php echo $param->name;; ?></a>
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
                                    <!-- <div id="u51" class="ax_default box_1">
                                <div id="u51_div" class=""></div>
                            </div> -->
                                    <?php 
                                }
                                ?>
                                
                                </div>
        
                            </div>
                </div>
                <div class="row story_border_image"><img style="" src="<?php echo get_stylesheet_directory_uri();?>/images/u27.png"></div>
                <?php
                if($total_stories>0){ ?>
                    <div class="row slide_box_selector_details tab_widget_story" id="slide_box_selector_<?php echo $cat_id;?>">
                            <?php
                        $some_args = array(
                            'tax_query' => array(
                                array('taxonomy' => 'story_package',
                                'field' => 'term_id',
                                'terms' => $cat_id,)
                                
                            ),
                            'post_status' => 'publish',
                            'post_type' => 'post',
                        );
                       // $query = new WP_Query( $some_args );
                        //var_dump($query->request);
                        $s = get_posts( $some_args );
                        $total_post = count($s);
                        if( $total_post>0 ){
                            //var_dump($s->have_posts());die();
                            $i= 1;
                                foreach ( $s as $val ) {
                                // var_dump($p);
                                    ?>
                                    <div class="row col-12">
                                        <div class="col-3 block"><div class="date_circle"><p>
                                        
                                        <?php 
                                        $post_id = $val->ID;
                                        
                                        $thumb = get_the_post_thumbnail( $post_id, 'thumbnail', array( 'class' => 'img-responsive' ) );
                                        echo $thumb;//echo date('M j', strtotime($p->post_date)); ;?></p>
                                        </div>
                                        <span class="year_story"><?php //echo date('Y', strtotime($val->post_date)); ;?></span>
                                        </div>
                                        <div class="col-9">
                                            <div class="story_title"><a href="<?php echo get_permalink( $post_id )?>"><?php echo $val->post_title?></a></div>
                                            <div class="story_author"> <span class="author_style"><?php echo date('j F, Y', strtotime($val->post_date));//echo the_author_meta( 'user_login' , $p->post_author );?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                  // $s->the_post();
                            if($i==$subcount){break;}
                            $i++;
                                }
                                if($subcount < $total_post){
                                    ?>
                                    <div class="col-12 go_to_story" style="text-align:right;">
                                    <div class="row up_class_story"> <div class="sub_up_story"><a href="javascript:void(0);" class="slide_down" rel="slide_box_selector_<?php echo $cat_id;?>"><img style="" width="15" src="<?php echo get_stylesheet_directory_uri();?>/images/up.png"></a></div></div>    
                                    <span>Go To Story</span><img src="<?php echo get_stylesheet_directory_uri();?>/images/right.png" width="15"> </div>
                                    <div class="row story_border_image"><img style="" src="<?php echo get_stylesheet_directory_uri();?>/images/u27.png"></div>
                                    <?php
                                }
                            }
                            ?>
                    </div>
            <?php
                }
    
    
     $my_full_html = ob_get_clean();
    
    //var_dump($show_related_post);
     return $my_full_html;
    
    
    }
} // class RecentPostsPlus

add_action( 'admin_enqueue_scripts', array('RecentPostsPlus_story', 'rpp_form_script') );
//add_action( 'wp_enqueue_scripts',  'front_rpp_form_script');

// register RecentPostsPlus widget
add_action( 'widgets_init', 'create_widget_function_story' );

function create_widget_function_story(){
    register_widget("RecentPostsPlus_story");
}

