<?php
//top stories
register_widget('evolve_Tabs_Widget_placement');

class evolve_Tabs_Widget_placement extends WP_Widget
{

    public function __construct()
    {
        parent::__construct(
            'evolve_tabs-widget-placement-load',
            __('Placement Loading', 'evolve'), // Name
            array(
                'classname' => 'evolve_tabs',
                'description' => __('Three Placement Item loader.', 'evolve'),
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
         if( $tags_count!='-1'){
        echo do_shortcode('[ajax_load_more taxonomy="placement" taxonomy_terms="'.$tags_count.'" ]');
         }
       // echo do_shortcode('[placement_responsive title="'.$posts_title.'" link="'.$show_recent_posts.'" placement="'.$tags_count.'"]');

    }
    public function card_type_with_meta_value($card_type, $insert_thumbnail_image, $insert_sponsors_content, $title_show, $author_insert, $time_due, $categories, $get_post_id, $i)
    {
        ob_start();

        //var_dump($card_type['vertical_style']['top-stories']);
        //echo $get_post_id;
        //if (isset($card_type['vertical_style']['top-stories']) && $card_type['vertical_style']['top-stories'] == 'h') {
        if ($i == 1) {
            //echo '';
             ?>
			<div class="post-content" itemprop="mainContentOfPage">
                <div class="thumbnail-post">
                <?php
                echo $insert_thumbnail_image;
                if (isset($categories[0]->name)) {
                    ?>
                            <div class="col category_display"><?php echo $categories[0]->name; ?></div>
                    <?php
                }
                ?>
                </div>
            </div>
                            <?php
                                echo $insert_sponsors_content;
                                ?>
			<div class="post-holder title_with_author title_with_author_in_same_line">
				<?php echo $title_show; ?>
				<div class="meta author_and_time">
					<div class="author"><span class="black_author">by </span>
					<?php echo $author_insert; ?>
					</div>
					<div class="time">
					<?php
                        echo $time_due;
                    ?>
					</div>
				</div>
			</div>
			<?php

        } else {
            echo '';
            ?>
			<div class="row top_story_sub_box_border"><?php echo $insert_sponsors_content; ?></div>
			<div class="row top_story_sub_box_view">
				<div class="col-4 nopadding">
				<?php echo $insert_thumbnail_image; ?>
				<div class="meta author_and_time">
							<div class="author"><span class="black_author">by </span>
							<?php echo $author_insert; ?>
							</div>
							<div class="time">
							<?php
                                echo $time_due;
                            ?>
							</div>
						</div>
				</div>
				<div class="col-8 nopadding padding_left_top_story_box">
					<div class="post-holder title_with_author tabs_widget">
					<?php

            if (isset($categories[0]->name)) {
                ?>
						<div class="category_view"><?php echo $categories[0]->name; ?></div>
						<?php

            }
            ?>
						<?php echo $title_show; ?>

					</div>
				</div>
			</div>
			<?php
        }
        $return_content = ob_get_clean();
        return $return_content;
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
            <label for="<?php echo $this->get_field_id('tags'); ?>"><?php esc_html_e('Placement', 'evolve');?>
                :</label>
                <?php
                $categories = get_categories('taxonomy=placement');
 
  $select = "<select name='".$this->get_field_name('tags')."' id='".$this->get_field_id('tags')."' class='postform posts_tags_validation'>n";
  $select.= "<option value='-1'>Select category</option>n";
 $selected = '';
  foreach($categories as $category){
    //if($category->count > 0){
        if($instance['tags']==$category->slug){
            $selected = 'selected';
        }else{
            $selected = '';
        }
        $select.= "<option value='".$category->slug."' ".$selected.">".$category->name."</option>";
    //}
  }
 
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