<?php
//ini_set('display_errors',1);
//error_reporting(E_ALL);

add_shortcode('placement_responsive','placement_three_latest_item');
function placement_three_latest_item($atts){
    $default = array(
        'header' => '',
        'placement' => '',
        'title' => '',
        'link' => '#',
    );
    $a = shortcode_atts($default, $atts);

    global $data, $post;
    wp_reset_query();
    $orderby = '';
     if ($orderby == 'Highest Comments') {
        $order_string = '&orderby=comment_count';
    } else {
        $order_string = '&meta_key=evolve_post_views_count&orderby=meta_value_num';
    }
    //$popular_posts = new WP_Query('showposts=' . $posts . $order_string . '&order=DESC');
    ?>
<div class="top_story_front_home_page">
        <!-- <ul id="nav-tabs" class="nav nav-tabs flex-column flex-sm-row" role="tablist">
        <li class="flex-sm-fill text-center nav-item"><a class="nav-link active show" id="recent-tab" data-toggle="tab" role="tab" href="#tab-recent" aria-controls="recent" aria-selected="true">TOP STORIES</a>
        </li>
        <li class="flex-sm-fill text-center nav-item top_story">
        <a class="border_blank" id="" href="#"><small>SEE ALL</small></a>
        </li>
        </ul> -->

    <div class="tab-content">	
             <div id="tab-recent" class="tab-pane fade active show" role="tabpanel" aria-labelledby="recent-tab">
                                                <?php
                                                $meta_value = isset($a['placement'])?$a['placement']:'top-stories';
                                                            $meta_value = 'top-stories';
                                                                $args = array(
                                                                    'post_type' => 'post',
                                                                    'posts_per_page' => 3,
                                                                    'orderby' => 'post_date',
                                                                    'order' => 'desc',
                                                                    'tax_query' => array(
                                                                        array(
                                                                            'taxonomy' => 'placement',
                                                                            'terms' => $meta_value,
                                                                            'field' => 'slug',
                                                                            'include_children' => true,
                                                                            'operator' => 'IN'
                                                                        )
                                                                    ),
                                                                   
                                                                );
                                                                // 'meta_query' => array(
                                                                //     array(
                                                                //         'key' => 'gallery_data',
                                                                //         'value' => sprintf(':"%s";', $meta_value),
                                                                //         'compare' => 'like',
                                                                //     ),
                                                                // ),
                                                               // var_dump($args);
                                                        $recent_posts = new WP_Query($args);
                                                        //var_dump($recent_posts->request);
                                                        if ($recent_posts->have_posts()): ?>
                                                                    <ul>
                                                                            <?php
                                                                                    $i = 1;
                                                                                    while ($recent_posts->have_posts()): $recent_posts->the_post();?>
                                                                                                                <li>
                                                                                                                <?php
                                                                                            ob_start();
                                                                                        if (has_post_thumbnail()) {?>
                                                                                                                <a href="<?php the_permalink();?>">
                                                                                                                <?php the_post_thumbnail('tabs-img', array('itemprop' => 'image'));?>
                                                                                                                <div class="mask"><div class="icon"></div></div>
                                                                                                                </a>
                                                                                                                <?php
                                                                                        } else {?>
                                                                                                                <a href="<?php the_permalink();?>">
                                                                                                                <img class="d-block w-100" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/no-thumbnail-post.jpg" alt="" itemprop="image">
                                                                                                                <div class="mask"><div class="icon"></div></div>
                                                                                                                </a>
                                                                                                                <?php
                                                                                        }
                                                                                        $insert_thumbnail_image = ob_get_clean();
                                                                                        ?>
                                                                                                                <?php
                                                                                        $get_post_id = get_the_ID();
                                                                                        $gallery_data = get_post_meta($get_post_id, 'gallery_data', true);
                                                                                        $sponsors = (isset($gallery_data['image_desc']) ? $gallery_data['image_desc'] : '');
                                                                                        $sponsors_url = (isset($gallery_data['image_url']) ? $gallery_data['image_url'] : '');
                                                                                        ob_start();
                                                                                        if ($sponsors_url != "") {
                                                                                            ?>
                                                                                                                <div class="col-12 sponsors_body">
                                                                                                                <?php //echo $sponsors ?>
                                                                                                                    <div class="sponsors_title_front">In Association with</div> <div class="sponsors_title">
                                                                                                                    <img src="<?php echo $sponsors_url; ?>" >
                                                                                                                    <!-- <?php echo $sponsors ?> <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/right_blue.png" width="12"> -->
                                                                                                                </div>
                                                                                                                </div>
                                                                                                                <?php

                                                                                        } else {
                                                                                            ?>
                                                                                                        <div class="col-12 sponsors_body">&nbsp;
                                                                                                            <div class="sponsors_title_front" style=""></div>
                                                                                                            <div class="sponsors_title" >
                                                                                                            </div>
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
                                                                                        echo card_type_with_meta_value_current($gallery_data, $insert_thumbnail_image, $insert_sponsors_content, $insert_title, $author_insert, $time_due, $categories, $get_post_id, $i);

                                                                                        ?>
                                                                                                                <div class="row top_story_border" style=""> <img style="" src="<?php echo get_stylesheet_directory_uri() ?>/images/u27.png"></div>
                                                                                                                </li>
                                                                                                                <?php
                                                                                        $i++;
                                                                                    endwhile;?>
                                                                    </ul>
                                                            <?php 
                                                        endif;?>
                                            </div>
                 <!--html recent -->  
                                     
        <?php  
        wp_reset_query();
        // <div id="tab-recent" class="tab-pane fade active show" role="tabpanel" aria-labelledby="recent-tab">
        //                 <ul>
        //                         <li>
        //                         <div class="post-content" itemprop="mainContentOfPage">
        //                         <div class="thumbnail-post">
        //                         <a href="http://localhost/the-better-india/enter-sandman/">
        //                         <img width="968" height="681" src="http://localhost/the-better-india/wp-content/uploads/2018/11/metallica1.jpg" class="attachment-tabs-img size-tabs-img wp-post-image" alt="" itemprop="image" srcset="http://localhost/the-better-india/wp-content/uploads/2018/11/metallica1.jpg 968w, http://localhost/the-better-india/wp-content/uploads/2018/11/metallica1-300x211.jpg 300w, http://localhost/the-better-india/wp-content/uploads/2018/11/metallica1-768x540.jpg 768w" sizes="(max-width: 968px) 100vw, 968px">									<div class="mask"><div class="icon"></div></div>
        //                         </a>
        //                         <div class="col category_display">OUR IMPACT</div>
        //                         </div></div>									<div class="col-12 sponsors_body">&nbsp;
        //                         <div class="sponsors_title_front" style=""></div>
        //                         <div class="sponsors_title">
        //                         </div>
        //                         </div>
        //                         <div class="post-holder title_with_author title_with_author_in_same_line">
        //                         <a href="http://localhost/the-better-india/enter-sandman/">Enter Sandman</a>
        //                         <div class="meta author_and_time">
        //                         <div class="author"><span class="black_author">by </span>
        //                         adminroot					</div>
        //                         <div class="time">
        //                         3 days ago					</div>
        //                         </div>
        //                         </div>
        //                         <div class="row top_story_border" style=""> <img style="" src="http://localhost/the-better-india/wp-content/themes/tootle-child/images/u27.png"></div>
        //                         </li>
        //                         <li>
        //                         <div class="row top_story_sub_box_border">									<div class="col-12 sponsors_body">&nbsp;
        //                         <div class="sponsors_title_front" style=""></div>
        //                         <div class="sponsors_title">
        //                         </div>
        //                         </div>
        //                         </div>
        //                         <div class="row top_story_sub_box_view">
        //                         <div class="col-4 nopadding">
        //                         <a href="http://localhost/the-better-india/arctic-tern/">
        //                         <img width="1280" height="960" src="http://localhost/the-better-india/wp-content/uploads/2018/11/tern.jpg" class="attachment-tabs-img size-tabs-img wp-post-image" alt="" itemprop="image" srcset="http://localhost/the-better-india/wp-content/uploads/2018/11/tern.jpg 1280w, http://localhost/the-better-india/wp-content/uploads/2018/11/tern-300x225.jpg 300w, http://localhost/the-better-india/wp-content/uploads/2018/11/tern-768x576.jpg 768w, http://localhost/the-better-india/wp-content/uploads/2018/11/tern-1024x768.jpg 1024w, http://localhost/the-better-india/wp-content/uploads/2018/11/tern-400x300.jpg 400w" sizes="(max-width: 1280px) 100vw, 1280px">									<div class="mask"><div class="icon"></div></div>
        //                         </a>
        //                         <div class="meta author_and_time">
        //                         <div class="author"><span class="black_author">by </span>
        //                         adminroot							</div>
        //                         <div class="time">
        //                         3 days ago							</div>
        //                         </div>
        //                         </div>
        //                         <div class="col-8 nopadding padding_left_top_story_box">
        //                         <div class="post-holder title_with_author">
        //                         <div class="category_view">THE BETTER INDIA BLOG</div>
        //                         <a href="http://localhost/the-better-india/arctic-tern/">Arctic tern</a>

        //                         </div>
        //                         </div>
        //                         </div>

        //                         <div class="row top_story_border" style=""> <img style="" src="http://localhost/the-better-india/wp-content/themes/tootle-child/images/u27.png"></div>
        //                         </li>
        //                         <li>
        //                         <div class="row top_story_sub_box_border">									<div class="col-12 sponsors_body">
        //                         <div class="sponsors_title_front">In Association with</div> <div class="sponsors_title">
        //                         <img src="http://localhost/the-better-india/wp-content/uploads/2018/11/u41.png">
        //                         <!--  <img src="http://localhost/the-better-india/wp-content/themes/tootle-child/images/right_blue.png" width="12"> -->
        //                         </div>
        //                         </div>
        //                         </div>
        //                         <div class="row top_story_sub_box_view">
        //                         <div class="col-4 nopadding">
        //                         <a href="http://localhost/the-better-india/baleen-whale/">
        //                         <img width="329" height="187" src="http://localhost/the-better-india/wp-content/uploads/2018/11/humpack-whale.jpg" class="attachment-tabs-img size-tabs-img wp-post-image" alt="" itemprop="image" srcset="http://localhost/the-better-india/wp-content/uploads/2018/11/humpack-whale.jpg 329w, http://localhost/the-better-india/wp-content/uploads/2018/11/humpack-whale-300x171.jpg 300w" sizes="(max-width: 329px) 100vw, 329px">									<div class="mask"><div class="icon"></div></div>
        //                         </a>
        //                         <div class="meta author_and_time">
        //                         <div class="author"><span class="black_author">by </span>
        //                         adminroot							</div>
        //                         <div class="time">
        //                         3 days ago							</div>
        //                         </div>
        //                         </div>
        //                         <div class="col-8 nopadding padding_left_top_story_box">
        //                         <div class="post-holder title_with_author">
        //                         <div class="category_view">NGO SPOTLIGHT</div>
        //                         <a href="http://localhost/the-better-india/baleen-whale/">Baleen whale</a>

        //                         </div>
        //                         </div>
        //                         </div>

        //                         <div class="row top_story_border" style=""> <img style="" src="http://localhost/the-better-india/wp-content/themes/tootle-child/images/u27.png"></div>
        //                         </li>
        //                         <li>
        //                         <div class="row top_story_sub_box_border">									<div class="col-12 sponsors_body">&nbsp;
        //                         <div class="sponsors_title_front" style=""></div>
        //                         <div class="sponsors_title">


        //                         </div>
        //                         </div>
        //                         </div>
        //                         <div class="row top_story_sub_box_view">
        //                         <div class="col-4 nopadding">
        //                         <a href="http://localhost/the-better-india/gray-whale/">
        //                         <img width="1280" height="853" src="http://localhost/the-better-india/wp-content/uploads/2018/11/gray-whale-pic.jpg" class="attachment-tabs-img size-tabs-img wp-post-image" alt="" itemprop="image" srcset="http://localhost/the-better-india/wp-content/uploads/2018/11/gray-whale-pic.jpg 1280w, http://localhost/the-better-india/wp-content/uploads/2018/11/gray-whale-pic-300x200.jpg 300w, http://localhost/the-better-india/wp-content/uploads/2018/11/gray-whale-pic-768x512.jpg 768w, http://localhost/the-better-india/wp-content/uploads/2018/11/gray-whale-pic-1024x682.jpg 1024w" sizes="(max-width: 1280px) 100vw, 1280px">									<div class="mask"><div class="icon"></div></div>
        //                         </a>
        //                         <div class="meta author_and_time">
        //                         <div class="author"><span class="black_author">by </span>
        //                         adminroot							</div>
        //                         <div class="time">
        //                         3 days ago							</div>
        //                         </div>
        //                         </div>
        //                         <div class="col-8 nopadding padding_left_top_story_box">
        //                         <div class="post-holder title_with_author">
        //                         <div class="category_view">ENVIRONMENT</div>
        //                         <a href="http://localhost/the-better-india/gray-whale/">Gray whale</a>

        //                         </div>
        //                         </div>
        //                         </div>

        //                         <div class="row top_story_border" style=""> <img style="" src="http://localhost/the-better-india/wp-content/themes/tootle-child/images/u27.png"></div>
        //                         </li>
        //                 </ul>
        // </div>
         ?>

    </div>

</div>
        <?php
}



  function card_type_with_meta_value_current($card_type, $insert_thumbnail_image, $insert_sponsors_content, $title_show, $author_insert, $time_due, $categories, $get_post_id, $i)
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