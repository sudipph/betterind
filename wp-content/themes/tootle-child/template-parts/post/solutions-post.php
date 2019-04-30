<?php

/*
Displays Post Content
======================================= */
//var_dump($GLOBALS);
//echo $GLOBALS['wp_query']->request;

?>
<article id="post-<?php the_ID();?>" <?php post_class();?> itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
<div class="row">
        <div class="col-6">
            <?php
            $gallery_data = get_post_meta($post->ID, 'gallery_data', true);
            echo '<div class="thumbnail-post-single" style="position: relative;">';
            the_post_thumbnail('evolve-post-thumbnail', array('class' => 'd-block w-100', 'itemprop' => 'image'));
            echo '</div>';
            ?>
            <div class="row post-meta align-items-center">
                <div class="col author vcard">
                    <?php
                        if(isset($gallery_data['eprice']['solarticle'])){
                                ?>
                                <span class="published updated" itemprop="datePublished" pubdate="">
                            Rs. <?php echo $gallery_data['eprice']['solarticle'] ; ?>
                            </span>
                                <?php
                        }
                        if(isset($gallery_data['hour']['solarticle'])){
                                ?>
                                <span class="published hour" itemprop="datePublished" pubdate="">
                            Approx <?php echo $gallery_data['hour']['solarticle'] ; ?> Hours
                            </span>
                                <?php
                        }
                    ?> 
                </div>  
            </div>
        </div>
    <div class="col-6">
            <?php
            if (is_single() || is_page()) {

                if (get_post_meta($post->ID, 'evolve_page_title', true) == "yes" || get_post_meta($post->ID, 'evolve_page_title', true) == "") {
                    the_title('<h1 class="post-title" itemprop="name">', '</h1>');
                }
            } else {
                if (evolve_theme_mod('evl_post_layout', 'two') != "one") {
                    $evolve_title = the_title('', '', false);
                    echo '<h2 class="post-title" itemprop="name"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">';
                    evolve_truncate(intval(evolve_theme_mod('evl_posts_excerpt_title_length', '40')), $evolve_title);
                    echo '</a></h2>';
                } else {
                    the_title('<h2 class="post-title" itemprop="name"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
                }
            }
            ?>
            <?php
            evolve_wp_link_pages();
            ?>
    <div>
<div>

</article><!-- .post -->

