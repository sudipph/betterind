<?php
//top stories
register_widget('evolve_Tabs_Widget_campaign');

class evolve_Tabs_Widget_campaign extends WP_Widget
{

    public function __construct()
    {
        parent::__construct(
            'evolve_tabs-widget-campaign-load',
            __('Campaign ', 'evolve'), // Name
            array(
                'classname' => 'evolve_tabs',
                'description' => __('Three Campaign Item .', 'evolve'),
            ) // Args
        );
    }

    public function widget($args, $instance)
    {
        global $data, $post;

        extract($args);
        if (!empty($instance['posts_title'])) {
            $posts_title = $instance['posts_title'];
        }
        if (!empty($instance['posts'])) {
            $posts = $instance['posts'];
        }
        if (!empty($instance['comments'])) {
            $number = $instance['comments'];
        }
        if (!empty($instance['tags'])) {
            $tags_count = $instance['tags'];
        }
        if (!empty($instance['orderby'])) {
            $orderby = $instance['orderby'];
        }

        $show_popular_posts = isset($instance['show_popular_posts']) ? 'true' : 'false';
        $show_recent_posts = isset($instance['show_recent_posts']) ? $instance['show_recent_posts'] : '';
        $show_comments = isset($instance['show_comments']) ? 'true' : 'false';
        // echo $show_recent_posts;
        // echo $tags_count;
        // echo $posts_title;
         if( $tags_count!=''){
           
        echo do_shortcode('[campaign post_id="'.$tags_count.'" ]');
         }
     

    }
    
    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;

        $instance['posts'] = stripslashes(wp_filter_post_kses(addslashes($new_instance['posts'])));
        $instance['posts_title'] = stripslashes(wp_filter_post_kses(addslashes($new_instance['posts_title'])));
        $instance['comments'] = stripslashes(wp_filter_post_kses(addslashes($new_instance['comments'])));
        $instance['tags'] = stripslashes(wp_filter_post_kses(addslashes($new_instance['tags'])));
        $instance['show_popular_posts'] = $new_instance['show_popular_posts'];
        $instance['show_recent_posts'] = $new_instance['show_recent_posts'];
        $instance['show_comments'] = $new_instance['show_comments'];
        $instance['show_tags'] = $new_instance['show_tags'];
        $instance['orderby'] = $new_instance['orderby'];

        return $instance;
    }
    public function form($instance)
    {
        $defaults = array(
            'posts' => '3',
            'posts_title' => '',
            'comments' => '3',
            'tags' => '3',
            'show_popular_posts' => 'on',
            'show_recent_posts' => '',
            'show_comments' => 'on',
            'show_tags' => 'on',
            'orderby' => 'Highest Comments',
        );
        $instance = wp_parse_args((array) $instance, $defaults);?>
         <style>
        .errors {
                color: red;
            }
        </style>
        <script type="text/javascript">
var keydownCounter = 0;
var keypressCounter = 0;
jQuery( document ).ready(function(){
 
   jQuery('.posts_tags_validation').change(function(event){
       console.log(jQuery(this).val());
        if(jQuery(this).val()=='-1'){
            jQuery('.errors_tag').css('display','block');
        }else{
           jQuery('.errors_tag').css('display','none');
        }
      
    });
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

		<!-- <p>
            <label for="<?php echo $this->get_field_id('posts_title'); ?>"><?php esc_html_e('Title', 'evolve');?>
                :</label>
            <input class="widefat" type="text"  id="<?php echo $this->get_field_id('posts_title'); ?>"
                   name="<?php echo $this->get_field_name('posts_title'); ?>" value="<?php echo $instance['posts_title']; ?>"/>
        </p> -->
        <p>
            <label for="<?php echo $this->get_field_id('tags'); ?>"><?php esc_html_e('Campaign', 'evolve');?>
                :</label>
                <?php
               
            $loop = new WP_Query( array( 'post_type' => 'campaign', 'posts_per_page' => -1 ) ); 
             

  $select = "<select name='".$this->get_field_name('tags')."' id='".$this->get_field_id('tags')."' class='postform posts_tags_validation'>n";
  $select.= "<option value=''>Select Campaign</option>n";
 $selected = '';
  while ( $loop->have_posts() ) : $loop->the_post();
 
        if($instance['tags']==get_the_ID()){
            $selected = 'selected';
        }else{
            $selected = '';
        }
        $select.= "<option value='".get_the_ID()."' ".$selected.">".custom_echo(get_the_title(),40)."</option>";
    
endwhile; 
 
  $select.= "</select>";
 
  echo $select;
                ?>
            <?php 
           // echo $instance['tags'];
            if($instance['tags']=='-1'){?> <div class="errors errors_tag" >You need to select the placement.</div> <?php }else{
                ?> <div class="errors errors_tag" style="display:none;">You need to select the placement.</div> <?php
            } ?> 
        </p>
  
        <!-- <p>
            <label for="<?php echo $this->get_field_id('show_recent_posts'); ?>"><?php esc_html_e('Link', 'evolve');?>
                :</label>
            <input class="widefat" type="text" style="" id="<?php echo $this->get_field_id('show_recent_posts'); ?>"
                   name="<?php echo $this->get_field_name('show_recent_posts'); ?>" value="<?php echo $instance['show_recent_posts']; ?>"/>
        </p> -->
		<?php

    }
}