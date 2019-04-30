<?php
//top stories
register_widget('evolve_Tabs_Widget');

class evolve_Tabs_Widget extends WP_Widget
{

    public function __construct()
    {
        parent::__construct(
            'evolve_tabs-widget', __('Top Stories', 'evolve'), // Name
            array(
                'classname' => 'evolve_tabs',
                'description' => __('Popular posts, recent posts and comments.', 'evolve'),
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
        $show_recent_posts = isset($instance['show_recent_posts']) ? 'true' : 'false';
        $show_comments = isset($instance['show_comments']) ? 'true' : 'false';
        echo '<div class="top_story_front_home_page sub_page">';
        echo $before_widget;
        //var_dump($before_widget);
        ?>

        <!-- <ul id="nav-tabs" class="nav nav-tabs flex-column flex-sm-row" role="tablist"> -->
        <ul id="nav-tabs" class="nav nav-tabs flex-column flex-sm-row" role="tablist">

			<?php if ($show_popular_posts == 'true'): ?>

                <li class="flex-sm-fill text-center nav-item"><a class="nav-link" id="popular-tab" data-toggle="tab"
                                                                 role="tab"
                                                                 href="#tab-popular"
                                                                 aria-controls="popular"><?php esc_html_e($posts_title, 'evolve');?></a>
                </li>

			<?php endif;
        if ($show_recent_posts == 'true'): ?>

                <li class="flex-sm-fill text-center nav-item"><a class="nav-link" id="recent-tab" data-toggle="tab"
                                                                 role="tab" href="#tab-recent"
                                                                 aria-controls="recent"><?php esc_html_e($posts_title, 'evolve');?></a>
                </li>
				<li class="flex-sm-fill text-center nav-item top_story">
				<a class="border_blank" id=""  href="#"><small>SEE ALL</small></a>
                </li>

			<?php endif;
        if ($show_comments == 'true'): ?>

                <li class="flex-sm-fill text-center nav-item"><a class="nav-link" id="comments-tab" data-toggle="tab"
                                                                 role="tab"
                                                                 href="#tab-comments"
                                                                 aria-controls="comments"><?php esc_html_e($posts_title, 'evolve');?></a>
                </li>

			<?php endif;?>

        </ul>
        <div class="tab-content">

			<?php if ($show_popular_posts == 'true'): ?>

                <div id="tab-popular" class="tab-pane fade" role="tabpanel" aria-labelledby="popular-tab">

					<?php
if ($orderby == 'Highest Comments') {
            $order_string = '&orderby=comment_count';
        } else {
            $order_string = '&meta_key=evolve_post_views_count&orderby=meta_value_num';
        }
        //echo 'showposts=' . $posts . $order_string . '&order=DESC';
        $popular_posts = new WP_Query('showposts=' . $posts . $order_string . '&order=DESC');
        if ($popular_posts->have_posts()): ?>

                        <ul>

							<?php while ($popular_posts->have_posts()): $popular_posts->the_post();?>

			                                <li>

												<?php if (has_post_thumbnail()): ?>

			                                        <div class="image">
			                                            <a href="<?php the_permalink();?>">
															<?php the_post_thumbnail('tabs-img', array('itemprop' => 'image'));?>
			                                            </a>
			                                        </div>

												<?php endif;?>

                                    <div class="post-holder">
                                        <a href="<?php the_permalink();?>"><?php the_title();?></a>

                                        <div class="meta">

											<?php the_time(get_option('date_format'));?>

                                        </div>
                                    </div>
                                </li>

							<?php endwhile;?>

                        </ul>

					<?php endif;?>

                </div>

			<?php endif;
        if ($show_recent_posts == 'true'): ?>
				<?php //echo evolve_front_article_title()?>

                <div id="tab-recent" class="tab-pane fade" role="tabpanel" aria-labelledby="recent-tab">

					<?php
//echo 'hello';
        //echo 'showposts=' . $tags_count ;

        $recent_posts = new WP_Query('showposts=' . $tags_count);
        if ($recent_posts->have_posts()): ?>

                        <ul>

							<?php while ($recent_posts->have_posts()): $recent_posts->the_post();?>

			                                <li>

												<?php

            ob_start();
            if (has_post_thumbnail()) {?>



				                                            <a href="<?php the_permalink();?>">
																<?php the_post_thumbnail('tabs-img', array('itemprop' => 'image'));?>
				                                            <div class="mask"><div class="icon"></div></div>
				                                            </a>

												<?php } else {?>



															<a href="<?php the_permalink();?>">
															<img class="d-block w-100" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/no-thumbnail-post.jpg" alt="" itemprop="image">
															<div class="mask"><div class="icon"></div></div>
															</a>


													<?php }

            $insert_thumbnail_image = ob_get_clean();

            ?>
													<?php

            $gallery_data = get_post_meta($get_post_id, 'gallery_data', true);
            $get_post_id = get_the_ID();
            $sponsors = (isset($gallery_data['image_desc']) ? $gallery_data['image_desc'] : '');
            $sponsors_url = (isset($gallery_data['image_url']) ? $gallery_data['image_url'] : '');
            ob_start();
            if ($sponsors != '') {
                ?>
												<div class="col-12 sponsors_body">
													In Association with <span class="sponsors_title"> <img src="<?php echo $sponsors_url; ?>" ><!--<?php echo $sponsors ?> <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/right_blue.png" width="12">--></span>
												</div>
												<?php
    }
            $insert_sponsors_content = ob_get_clean();
            $time_due = human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago';
            $author_insert = get_author_name();
            ob_start();
            ?>
												<a href="<?php the_permalink();?>"><?php the_title();?></a>
												<?php
    $insert_title = ob_get_clean();

            $categories = get_the_terms($get_post_id, 'category');

            echo $this->card_type_with_meta_value($gallery_data, $insert_thumbnail_image, $insert_sponsors_content, $insert_title, $author_insert, $time_due, $categories);

            ?>


												<div class="row top_story_border" style=""> <img style="" src="<?php echo get_stylesheet_directory_uri() ?>/images/u27.png"></div>
			                                </li>

										<?php endwhile;?>

                        </ul>

					<?php endif;?>

                </div>

			<?php
endif;
        /*if ( $show_recent_posts == 'true' ): ?>

        <div id="tab-recent" class="tab-pane fade" role="tabpanel" aria-labelledby="recent-tab">

        <?php $recent_posts = new WP_Query( 'showposts=' . $tags_count );
        if ( $recent_posts->have_posts() ): ?>

        <ul>

        <?php while ( $recent_posts->have_posts() ): $recent_posts->the_post(); ?>

        <li>

        <?php if ( has_post_thumbnail() ): ?>

        <div class="image">
        <a href="<?php the_permalink(); ?>">
        <?php the_post_thumbnail( 'tabs-img', array( 'itemprop' => 'image' ) ); ?>
        </a>
        </div>

        <?php endif; ?>

        <div class="post-holder">
        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        <div class="meta">

        <?php the_time( get_option( 'date_format' ) ); ?>

        </div>
        </div>
        </li>

        <?php endwhile; ?>

        </ul>

        <?php endif; ?>

        </div>

        <?php
        endif;*/
        if ($show_comments == 'true'):
        ?>

                <div id="tab-comments" class="tab-pane fade" role="tabpanel" aria-labelledby="comments-tab">
                    <ul>

						<?php
global $wpdb;
        $recent_comments = "SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID, comment_author, comment_author_email, comment_date_gmt, comment_approved, comment_type, comment_author_url, SUBSTRING(comment_content,1,110) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID) WHERE comment_approved = '1' AND comment_type = '' AND post_password = '' ORDER BY comment_date_gmt DESC LIMIT $number";
        $the_comments = $wpdb->get_results($recent_comments);
        foreach ($the_comments as $comment) {
            ?>

                            <li>
                                <div class="image">

									<?php echo get_avatar($comment, '50', '', '', array('class' => 'rounded-circle')); ?>

                                </div>
                                <div class="post-holder">
                                    <a class="comment-text-side"
                                       href="<?php echo get_permalink($comment->ID); ?>#comment-<?php echo $comment->comment_ID; ?>"
                                       title="<?php echo strip_tags($comment->comment_author); ?> on <?php echo $comment->post_title; ?>"><?php echo strip_tags($comment->comment_author); ?><?php esc_html_e(' says', 'evolve');?></a>
                                    <div class="meta">

										<?php echo evolve_truncate(70, strip_tags($comment->com_excerpt)); ?>

                                    </div>
                                </div>
                            </li>

						<?php }?>

                    </ul>
                </div>

			<?php endif;?>

        </div>

		<?php
echo $after_widget;
        echo '<div>';
    }
    public function card_type_with_meta_value($card_type, $insert_thumbnail_image, $insert_sponsors_content, $title_show, $author_insert, $time_due, $categories)
    {
        ob_start();
        //var_dump($card_type['card_type']);
        if (!isset($card_type['card_type'])) {
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
			</div></div><?php

            echo $insert_sponsors_content;
            ?>
			<div class="post-holder title_with_author">
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

            ?>
			<div class="row"><?php echo $insert_sponsors_content; ?></div>
			<div class="row">
				<div class="col-5">
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
				<div class="col-7">
					<div class="post-holder title_with_author">
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
            'show_recent_posts' => 'on',
            'show_comments' => 'on',
            'show_tags' => 'on',
            'orderby' => 'Highest Comments',
        );
        $instance = wp_parse_args((array) $instance, $defaults);?>
		<p>
            <label for="<?php echo $this->get_field_id('posts_title'); ?>"><?php esc_html_e('Title', 'evolve');?>
                :</label>
            <input class="widefat" type="text"  id="<?php echo $this->get_field_id('posts_title'); ?>"
                   name="<?php echo $this->get_field_name('posts_title'); ?>" value="<?php echo $instance['posts_title']; ?>"/>
        </p>
        <?php /* <p>
        <label for="<?php echo $this->get_field_id( 'orderby' ); ?>"><?php esc_html_e( 'Popular Posts Order By', 'evolve' ); ?>
        :</label>
        <select id="<?php echo $this->get_field_id( 'orderby' ); ?>"
        name="<?php echo $this->get_field_name( 'orderby' ); ?>" class="widefat" style="width:100%;">
        <option <?php
        if ( 'Highest Comments' == $instance['orderby'] ) {
        echo 'selected="selected"';
        }
        ?>><?php esc_html_e( 'Highest Comments', 'evolve' ); ?></option>
        <option <?php
        if ( 'Highest Views' == $instance['orderby'] ) {
        echo 'selected="selected"';
        }
        ?>><?php esc_html_e( 'Highest Views', 'evolve' ); ?></option>
        </select>
        </p> */?>
        <!-- <p>
            <label for="<?php echo $this->get_field_id('posts'); ?>"><?php esc_html_e('Number of popular posts', 'evolve');?>
                :</label>
            <input class="widefat" type="text" style="width: 30px;" id="<?php echo $this->get_field_id('posts'); ?>"
                   name="<?php echo $this->get_field_name('posts'); ?>" value="<?php echo $instance['posts']; ?>"/>
        </p> -->
        <p>
            <label for="<?php echo $this->get_field_id('tags'); ?>"><?php esc_html_e('Number of recent posts', 'evolve');?>
                :</label>
            <input class="widefat" type="text" style="width: 30px;" id="<?php echo $this->get_field_id('tags'); ?>"
                   name="<?php echo $this->get_field_name('tags'); ?>" value="<?php echo $instance['tags']; ?>"/>
        </p>
        <!-- <p>
            <label for="<?php echo $this->get_field_id('comments'); ?>"><?php esc_html_e('Number of comments', 'evolve');?>
                :</label>
            <input class="widefat" type="text" style="width: 30px;"
                   id="<?php echo $this->get_field_id('comments'); ?>"
                   name="<?php echo $this->get_field_name('comments'); ?>"
                   value="<?php echo $instance['comments']; ?>"/>
        </p> -->
        <p>
            <!-- <input class="checkbox" type="checkbox" <?php checked($instance['show_popular_posts'], 'on');?>
                   id="<?php echo $this->get_field_id('show_popular_posts'); ?>"
                   name="<?php echo $this->get_field_name('show_popular_posts'); ?>"/>
            <label for="<?php echo $this->get_field_id('show_popular_posts'); ?>"><?php esc_html_e('Show popular posts', 'evolve');?></label>
            <br/> -->
            <input class="checkbox" type="checkbox" <?php checked($instance['show_recent_posts'], 'on');?>
                   id="<?php echo $this->get_field_id('show_recent_posts'); ?>"
                   name="<?php echo $this->get_field_name('show_recent_posts'); ?>"/>
            <label for="<?php echo $this->get_field_id('show_recent_posts'); ?>"><?php esc_html_e('Show recent posts', 'evolve');?></label>
            <!-- <br/>
            <input class="checkbox" type="checkbox" <?php checked($instance['show_comments'], 'on');?>
                   id="<?php echo $this->get_field_id('show_comments'); ?>"
                   name="<?php echo $this->get_field_name('show_comments'); ?>"/>
            <label for="<?php echo $this->get_field_id('show_comments'); ?>"><?php esc_html_e('Show comments', 'evolve');?></label> -->
        </p>

		<?php
}
}