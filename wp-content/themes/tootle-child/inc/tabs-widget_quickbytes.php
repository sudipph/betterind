<?php
define('WIDGET_TITLE_QUICK', 'Quick Bytes Widget');
define('WIDGET_TITLE_QUICK_SLUG', 'recent-posts-plus-quick');

class RecentPostsPlus_quick extends WP_Widget {
    
    private $default_config = array(
        'title' => '',
        'count' => 5,
        'technology'=>'false',
        'tourism'=>'false',
        'pod_cast'=>'false',
        'video'=>'false',
        'include_post_thumbnail' => 'false',
        'video_slider_thumbnail' => 'false',
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
            'description' => __('The most recent Video article. Includes advanced options.')
        );
        parent::__construct(WIDGET_TITLE_QUICK_SLUG, __(WIDGET_TITLE_QUICK), $widget_ops);
    }

    /** @see WP_Widget::widget */
    function widget( $args, $instance ) {
        extract( $args );
        $title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);        
        if(trim($title!='')){
                    echo '<div class="quick_bytes_box">';
                    echo $before_widget;
                    
                    
                    $widget_output_template = (empty($instance['widget_output_template'])) ? $this->default_config['widget_output_template'] : $instance['widget_output_template'];
                    
                    echo $before_title . $title . $after_title;
                    
                    $output = $this->parse_output($instance);
                    
                    //if the first tag of the widget_output_template is a <li> tag then wrap it in <ul>
                    if(stripos(ltrim($widget_output_template), '<li') === 0 && $video_slider_thumbnail=='false')
                        echo '<ul>'.$output.'</ul>';
                    else
                        echo $output;
                    
                    echo $after_widget;
                    echo '</div>';
        }
    }
    
    function parse_output($instance) {
        
        $output = '<div class="row story_pack quick_bytes_see_all_option"><div class="story_package_see_all quick_bytes"><a class="border_blank" id="" href="'.get_site_url(). '/quick-bytes/"><small>SEE ALL</small></a></div></div>';
        
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
                    'value'     => sprintf(':"%s";', 'technology'),
                    'compare'   => 'like',
                );
        }
        if($tourism == 'true'){
            
           $tourism_cond = array(
                    'key'       => 'gallery_data',
                    'value'     => sprintf(':"%s";', 'tourism'),
                    'compare'   => 'like',
                );
        }
        if($pod_cast == 'true'){
           $pod_cast_cond = array(
                    'key'       => 'gallery_data',
                    'value'     => sprintf(':"%s";', 'pod_cast'),
                    'compare'   => 'like',
                );
        }
        if($video == 'true'){
           $video_cond = array(
                    'key'       => 'gallery_data',
                    'value'     => sprintf(':"%s";', 'video'),
                    'compare'   => 'like',
                );
        }
        


         $meta_query = array(
                'relation'  => 'OR',$technology_cond ,$tourism_cond,$pod_cast_cond,$video_cond
            );


        $default_query_args = array(
            'post_type' => 'quickbyte', 
            'posts_per_page' => $count, 
            'orderby' => 'date', 
            'order' => 'DESC',
			'ignore_sticky_posts' => 1,
            'meta_query'=>$meta_query
        );
        $query_args = json_decode($wp_query_options, true);
        if($query_args == NULL) $query_args = array();
        $video_slider_thumbnail = true;
        $the_query = new WP_Query( array_merge($default_query_args, $query_args) );
        //var_dump($the_query->request);
        //var_dump($the_query);
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
                //$output .= '<div id="owl-demo2" class="owl-carousel">';
                $output .= '<div class="row quuck_bytes_slider"><div id="touchFlow" class="nav_h_responsive_type"><ul>';
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
               // var_dump($video_slider_thumbnail);
                if($video_slider_thumbnail=='true'){
                    $gallery =  get_post_meta( $ID , 'gallery_data' , true ); 
                    $output .= '<li><div class="thumb item selected_product" rel="'. $ID.' " style="width:170px margin-left:10px;margin-right:10px; ">';
                    
                    
                    
                    if(isset($gallery['youtube_link'])){
                        //$link_embed = youtube_link_to_embeded_code($gallery['youtube_link']);
                        //var_dump($link_embed);
                    $output .= '<div class="col-12 video_slide">'.$link_embed.'</div>';
                    }
                    $link_embed = get_the_post_thumbnail( $ID, 'thumbnail', array( 'class' => 'img-responsive' ) );
                    $background_image = $gallery['background_image_url'];
                    $background_image = '<img width="150" height="150" src="'.$background_image.'" class="img-responsive wp-post-image" alt="" sizes="(max-width: 150px) 100vw, 150px">';
                    $link_embed = $background_image;
                    if(isset($gallery['background_image_url'])){
                        //$link_embed = youtube_link_to_embeded_code($gallery['youtube_link']);
                        //var_dump($link_embed);
                        $output .= '<a href="' . get_the_permalink($ID) . '">';
                    $output .= '<div class="col-12 video_slide block" style="background-image: url('.$gallery['background_image_url'].');"><div class="background" style="background-color:'.(isset($gallery['color-picker'])?$gallery['color-picker']:'').';"></div>';
                    $output .= '<div class="date_circle"><p>'.$link_embed.'</p></div>';
                    $output .= '<span class="video_title">';
                       // $output .= '<a href="' . get_the_permalink($ID) . '">';
                        $output .= $widget_ouput_template_params['{TITLE}'];
                       // $output .= '</a>';
                        $output .= '</span>';
                        $output .= '<span class="video_date">'.$widget_ouput_template_params['{DATE}'].'</span>';
                    $output .= '</div>';
                     $output .= '</a>';
                    }else{
                        $output .= '<div class="col-12 video_slide block" style="background-image: url();">';
                        $output .= '<div class="date_circle"><p>'.$link_embed.'</p></div>';
                        $output .= '<span class="video_title">'.$widget_ouput_template_params['{TITLE}'].'</span><span class="video_date">'.$widget_ouput_template_params['{DATE}'].'</span>';
                        $output .= '</div>';
                    }
                    

                    
                    $output .= '</div></li>';
                    

                }else{
                    $output .= str_replace(array_keys($widget_ouput_template_params), array_values($widget_ouput_template_params), $widget_output_template_eval);
                }
                
            } //end while
            if($video_slider_thumbnail=='true'){
                $output .= '</ul></div></div>';
            }
            //wp_enqueue_script( 'owl-style-owlstart2',  get_stylesheet_directory_uri() . '/js/owl.start2.js' );
        }
        
        wp_reset_postdata();
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
        
        $instance['title'] = strip_tags(trim($new_instance['title']));

        
        $instance['technology'] = strip_tags($new_instance['technology']);
        if( empty($instance['technology']) ) $instance['technology'] = 'false';
        $instance['tourism'] = strip_tags($new_instance['tourism']);
        if( empty($instance['tourism']) ) $instance['tourism'] = 'false';
        $instance['pod_cast'] = strip_tags($new_instance['pod_cast']);
        if( empty($instance['pod_cast']) ) $instance['pod_cast'] = 'false';
        $instance['video'] = strip_tags($new_instance['video']);
        if( empty($instance['video']) ) $instance['video'] = 'false';

        $instance['count'] = strip_tags($new_instance['count']);
        
        
        $instance['video_slider_thumbnail'] = strip_tags( $new_instance[ 'video_slider_thumbnail' ] );
        if( empty($instance['video_slider_thumbnail']) ) $instance['video_slider_thumbnail'] = 'false';
         
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
        <style>
        .errors {
                color: red;
            }
        </style>




        <script type="text/javascript">
var keydownCounter = 0;
var keypressCounter = 0;
jQuery( document ).ready(function(){
 
   jQuery('.posts_title_validation').keydown(function(event){
       console.log(jQuery(this).val());
        if(jQuery(this).val()==''){
            jQuery('.errors_title').css('display','block');
        }else{
           jQuery('.errors_title').css('display','none');
        }
      
    });
      
 
});
</script>
        <script type="text/javascript">
            jQuery(document).ready(function($) {    
                $('.rpp_show-expert-options').trigger('change');
            });
        </script>
        
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
            <input class="widefat posts_title_validation" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
            <?php if($instance['title']==''){?> <div class="errors errors_title" >Title can't be blank.</div> <?php }else{
                ?> <div class="errors errors_title" style="display:none;">Title can't be blank.</div> <?php
            } ?>      
        </p>
        <p><?php
        ?>
            <label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Number of posts to show:'); ?></label> 
            <input id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" size="3" value="<?php echo $count; ?>" />
        </p>
       
        <!-- <p>
            <?php if( current_theme_supports('post-thumbnails') ): ?>
                <input id="<?php echo $this->get_field_id('video_slider_thumbnail'); ?>" name="<?php echo $this->get_field_name('video_slider_thumbnail'); ?>" type="checkbox" value="true"  class="checkbox" <?php echo ($video_slider_thumbnail == 'true') ? 'checked="checked"' : '' ?> />
                <label for="<?php echo $this->get_field_id('video_slider_thumbnail'); ?>"><?php _e(' Slider'); ?></label><br>
            <?php endif; ?>

            <?php if( current_theme_supports('post-thumbnails') ): ?>
                <input id="<?php echo $this->get_field_id('include_post_thumbnail'); ?>" name="<?php echo $this->get_field_name('include_post_thumbnail'); ?>" type="checkbox" value="true"  class="checkbox" <?php echo ($include_post_thumbnail == 'true') ? 'checked="checked"' : '' ?> />
                <label for="<?php echo $this->get_field_id('include_post_thumbnail'); ?>"><?php _e('Include post thumbnail'); ?></label><br>
            <?php endif; ?>

            <input id="<?php echo $this->get_field_id('include_post_excerpt'); ?>" name="<?php echo $this->get_field_name('include_post_excerpt'); ?>" type="checkbox" value="true" class="checkbox" <?php echo ($include_post_excerpt == 'true') ? 'checked="checked"' : '' ?> />
            <label for="<?php echo $this->get_field_id('include_post_excerpt'); ?>"><?php _e('Include post excerpt'); ?></label><br>
            
           <br>
            
            <input class="rpp_show-expert-options checkbox" id="<?php echo $this->get_field_name('show_expert_options'); ?>" name="<?php echo $this->get_field_name('show_expert_options'); ?>" type="checkbox" value="true" <?php echo ($show_expert_options == 'true') ? 'checked="checked"' : '' ?> /> 
            <label for="<?php echo $this->get_field_id('show_expert_options'); ?>"><?php _e('Show expert options'); ?></label> 
        </p> -->
        
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

} // class RecentPostsPlus

add_action( 'admin_enqueue_scripts', array('RecentPostsPlus_quick', 'rpp_form_script') );


// register RecentPostsPlus widget
add_action( 'widgets_init', 'create_widget_function_quick' );

function create_widget_function_quick(){
    
    register_widget("RecentPostsPlus_quick");
}




