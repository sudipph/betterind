<?php

define('SHOW_METABOX_ON', 'post');
define('SHOW_DYNAMIC_GALLERY', 'quickbyte');

add_action('admin_init', 'add_post_gallery_so_14445904');
add_action('admin_head-post.php', 'print_scripts_so_14445904');
add_action('admin_head-post-new.php', 'print_scripts_so_14445904');

add_action('pre_post_update', 'update_post_gallery_so_14445904', 11, 3);
//add_action('pre_post_update', 'update_success_stories_data', 10, 3);

add_action('save_post_quickbyte', 'update_post_gallery_so', 10, 2);
add_action('save_post_author', 'update_author_data', 10, 2);
add_action('save_post_awards', 'update_awards_data', 10, 2);
add_action('save_post_contacts_database', 'update_contacts_database_data', 10, 2);
//add_action('save_post_success_stories', 'update_success_stories_data', 10, 2);
add_action('save_post_shop', 'update_shop_data', 10, 2);
add_action('save_post_rainwater_harvesting', 'update_rainwater_harvesting_data', 10, 2);
add_action('save_post_solutions_library', 'update_solutions_library_data', 10, 2);

/**
 * Add custom Meta Box to Posts post type
 */
function add_post_gallery_so_14445904()
{

    $show_metabox_on = SHOW_METABOX_ON;

    add_meta_box(
        'post_gallery',
        'Primary CTA',
        'post_gallery_options_so_primary',
        $show_metabox_on,
        'normal',
        'core'
    );
    add_meta_box(
        'post_gallery0',
        'SubTitle Settings',
        'post_gallery_options_so_title',
        $show_metabox_on,
        'normal',
        'core'
    );
    add_meta_box(
        'post_gallery1',
        'Sponsor Settings',
        'post_gallery_options_so_14445904',
        $show_metabox_on,
        'normal',
        'core'
    );

    add_meta_box(
        'post_content',
        'Update Settings',
        'post_content_post_dinamic_content',
        $show_metabox_on,
        'normal',
        'core'
    );
    //add_meta_box('solutions_librarydiv', 'XXXXXXXXXXX', 'post_content_post_dinamic_content', 'post', 'normal', 'high', array('taxonomy' => 'solutions_library'));

    add_meta_box(
        'post_content',
        'Image',
        'post_content_post_dinamic_gallery',
        SHOW_DYNAMIC_GALLERY,
        'normal',
        'core'
    );
    add_meta_box(
        'post_content',
        'Author Details',
        'post_content_post_dinamic_author',
        'author',
        'normal',
        'core'
    );
    add_meta_box(
        'post_content',
        'Author Details',
        'post_content_post_dinamic_awards',
        'awards',
        'normal',
        'core'
    );
    add_meta_box(
        'post_content',
        'Shop Details',
        'post_content_post_dinamic_shop',
        'shop',
        'normal',
        'core'
    );

    add_meta_box(
        'post_content',
        'Additional Info',
        'post_content_post_dinamic_solutions_library',
        'solutions_library',
        'normal',
        'core'
    );

    add_meta_box(
        'post_content',
        'Additional Info',
        'post_content_post_dinamic_rainwater_harvesting',
        'rainwater_harvesting',
        'normal',
        'core'
    );
    add_meta_box(
        'post_content',
        'Additional Info',
        'post_content_post_dinamic_contact_db',
        'contacts_database',
        'normal',
        'core'
    );
    add_meta_box(
        'post_content',
        'Additional Info',
        'post_content_post_dinamic_success_stories',
        'success_stories',
        'normal',
        'core'
    );
}

/**
 * Print the Meta Box content
 */

function post_gallery_options_so_title()
{
    global $post;
    $gallery_data = get_post_meta($post->ID, 'gallery_data', true);
    wp_nonce_field(plugin_basename(__FILE__), 'noncename_so_14445904');
    ?>
<div id="dynamic_form">
    <div id="field_wrap">
    </div>
    <?php
$desc = '';
    if (isset($gallery_data['image_desc']) && $gallery_data['image_desc'] != '') {
        $desc = $gallery_data['image_desc'];
    }
    $img_link = '';
    if (isset($gallery_data['image_url']) && $gallery_data['image_url'] != '') {
        $img_link = $gallery_data['image_url'];
    }

    $b_post_sub_title = '';
    if (isset($gallery_data['b_post_sub_title']) && $gallery_data['b_post_sub_title'] != '') {
        $b_post_sub_title = $gallery_data['b_post_sub_title'];
    }

    ?>
    <div style="display:" id="master-row">
        <div class="field_row">
            <div class="field_left">
                <div class="form_field">
                    <label style="width: 200px;float: left;">Sub Title :</label>
                    <div style="float: left;"><input class="meta_image_desc" value="<?php ($b_post_sub_title != '' ? esc_html_e($b_post_sub_title) : '');?>" type="text" name="gallery[b_post_sub_title]" /></div>
                </div>

            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>
<?php
}
function post_gallery_options_so_primary()
{
    global $post;
    $gallery_data = get_post_meta($post->ID, 'gallery_data', true);
    wp_nonce_field(plugin_basename(__FILE__), 'noncename_so_14445904');
    ?>
<div id="dynamic_form">
    <div id="field_wrap">
    </div>
    <?php
$desc = '';
    if (isset($gallery_data['image_desc']) && $gallery_data['image_desc'] != '') {
        $desc = $gallery_data['image_desc'];
    }
    $img_link = '';
    if (isset($gallery_data['image_url']) && $gallery_data['image_url'] != '') {
        $img_link = $gallery_data['image_url'];
    }

    $b_post_link_title = '';
    if (isset($gallery_data['b_post_link_title']) && $gallery_data['b_post_link_title'] != '') {
        $b_post_link_title = $gallery_data['b_post_link_title'];
    }
    $b_post_link = '';
    if (isset($gallery_data['b_post_link']) && $gallery_data['b_post_link'] != '') {
        $b_post_link = $gallery_data['b_post_link'];
    }
    ?>
    <div style="display:" id="master-row">
        <div class="field_row">
            <div class="field_left">
                <div class="form_field">
                    <label style="width: 200px;float: left;">Post Link Title :</label>
                    <div style="float: left;"><input class="meta_image_desc" value="<?php ($b_post_link_title != '' ? esc_html_e($b_post_link_title) : '');?>" type="text" name="gallery[b_post_link_title]" /></div>
                </div>
                <div class="form_field">
                    <label style="width: 200px;float: left;">Post Link :</label>
                    <div style="float: left;"><input class="meta_image_desc" value="<?php ($b_post_link != '' ? esc_html_e($b_post_link) : '');?>" type="text" name="gallery[b_post_link]" /></div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>
<?php
}
function post_gallery_options_so_14445904($post_rec)
{
   
    global $post;
    
    $gallery_data = get_post_meta($post_rec->ID, 'gallery_data',true);
//var_dump($gallery_data);
    // Use nonce for verification
    wp_nonce_field(plugin_basename(__FILE__), 'noncename_so_14445904');
    ?>

<div id="dynamic_form">

    <div id="field_wrap">

    </div>
    <?php
$desc = '';
    if (isset($gallery_data['image_desc']) && $gallery_data['image_desc'] != '') {
        $desc = $gallery_data['image_desc'];
    }
    $img_link = '';
    if (isset($gallery_data['image_url']) && $gallery_data['image_url'] != '') {
        $img_link = $gallery_data['image_url'];
    }

    $b_post_link_title = '';
    if (isset($gallery_data['b_post_link_title']) && $gallery_data['b_post_link_title'] != '') {
        $b_post_link_title = $gallery_data['b_post_link_title'];
    }
    $b_post_link = '';
    if (isset($gallery_data['b_post_link']) && $gallery_data['b_post_link'] != '') {
        $b_post_link = $gallery_data['b_post_link'];
    }
    ?>
    <div style="display:" id="master-row">
        <div class="field_row">
            <div class="field_left" style="width: 70%;">
                <div class="form_field">
                    <label style="width: 200px;float: left;">Sponsor Name :</label>
                    <div style="float: left;"><input class="meta_image_desc" value="<?php ($desc != '' ? esc_html_e($desc) : '');?>" type="text" name="gallery[image_desc]" /></div>
                </div>

                <div class="form_field">
                    <label style="width: 200px;float: left;">Sponsor logo :</label>
                    <div style="float: left;"><input class="meta_image_url" value="<?php echo (isset($img_link) ? $img_link : ''); ?>" type="text" name="gallery[image_url]" /></div>
                    <div style="width: 100%;  display: inline-block; text-align: center;"><small>(Image Size 420X110)</small></div>
                </div>

            </div>
            <?php
if (isset($gallery_data['image_url']) && $gallery_data['image_url'] != '') {
        ?>
            <div class="field_right image_wrap">
                <img src="<?php esc_html_e($gallery_data['image_url']);?>" height="48" width="48" />
            </div>
            <?php

    } else {
        ?>
            <div class="field_right image_wrap"></div>
            <?php

    }
    ?>

            <div class="field_right">
                <input type="button" class="button" value="Choose File" onclick="add_image(this)" />

                <input class="button" type="button" value="Remove" onclick="remove_field_spon(this)" />
            </div>


            <div class="clear"></div>
        </div>
    </div>
</div>
<?php
}

function post_content_post_dinamic_awards()
{
    global $post;
    $gallery_data = get_post_meta($post->ID, 'gallery_data', true);

    // Use nonce for verification
    wp_nonce_field(plugin_basename(__FILE__), 'noncename_so_14445904');

    ?>

<div id="dynamic_form">

    <div id="field_wrap">


        <div class="field_row">

            <div class="field_left">
                <div class="form_field">
                    <label>Awards Info</label>
                    <input type="text" class="meta_image_url" name="gallery[awards_info]" value="<?php if (isset($gallery_data['awards_info'])) {
        esc_html_e($gallery_data['awards_info']);
    }?>" />
                </div>
                <div class="form_field">
                    <label>Date</label>
                    <input type="text" class="meta_image_url" name="gallery[awards_date]" value="<?php if (isset($gallery_data['awards_date'])) {
        esc_html_e($gallery_data['awards_date']);
    }?>" />
                </div>
                <!-- <div class="form_field">
                          <label>Description</label>
                          <input type="text"
                                 class="meta_image_desc"
                                 name="gallery[author_info]"
                                 value="<?php if (isset($gallery_data['author_info'])) {
        esc_html_e($gallery_data['author_info']);
    }?>"
                          />
                        </div> -->
            </div>
            <div class="clear"></div>
        </div>
        <?php
?>
    </div>




</div>
<script>
    function reset_image(){
        jQuery('.image_wrap').html('');
        jQuery('.meta_image_url').val('');
        }
    </script>
<?php

}
function post_content_post_dinamic_solutions_library()
{
    global $post;
    $gallery_data = get_post_meta($post->ID, 'gallery_data', true);
    //var_dump($gallery_data);
    // Use nonce for verification
    $img_link = isset($gallery_data['background_image_url']) ? $gallery_data['background_image_url'] : '';
    wp_nonce_field(plugin_basename(__FILE__), 'noncename_so_14445904');

    ?>

<div id="dynamic_form">

    <div id="field_wrap">


        <div class="field_row">

            <div class="field_left">
                <div class="form_field">
                    <label style="width: 200px;float: left;">Background Image :</label>
                    <div style="float: left;"><input class="meta_image_url" value="<?php echo (isset($img_link) ? $img_link : ''); ?>" type="text" name="gallery[background_image_url]" readonly="" /></div>
                </div>
            </div>
            <?php
if (isset($gallery_data['background_image_url']) && $gallery_data['background_image_url'] != '') {
        ?>
            <div class="field_right image_wrap">
                <img src="<?php esc_html_e($gallery_data['background_image_url']);?>" height="48" width="48" />
            </div>
            <?php

    } else {
        ?>
            <div class="field_right image_wrap"></div>
            <?php

    }
    ?>

            <div class="field_right">
                <input type="button" class="button" value="Choose File" onclick="add_image(this)" />
                <!-- <br />
                                    <input class="button" type="button" value="Remove" onclick="remove_field(this)" />  -->
            </div>

        </div>
        <div class="clear"></div>
    </div>

</div>




</div>
<script>
    function reset_image(){
                jQuery('.image_wrap').html('');
                jQuery('.meta_image_url').val('');
                }
            </script>
<?php

}
function post_content_post_dinamic_rainwater_harvesting()
{
    global $post;
    $gallery_data = get_post_meta($post->ID, 'gallery_data', true);
    $img_link = isset($gallery_data['background_image_url']) ? $gallery_data['background_image_url'] : '';
    // Use nonce for verification
    wp_nonce_field(plugin_basename(__FILE__), 'noncename_so_14445904');

    ?>

<div id="dynamic_form">
    <div id="field_wrap">
        <!-- <div class="field_row">
                                    <div class="field_left">
                                        <div class="form_field" >
                                            <label style="width: 200px;float: left;">Background Image :</label>
                                            <div style="float: left;">
                                                <input class="meta_image_url" value="<?php echo (isset($img_link) ? $img_link : ''); ?>" type="text" name="gallery[background_image_url]" readonly="" />
                                            </div>
                                        </div>
                                    </div>
                                            <?php
if (isset($gallery_data['background_image_url']) && $gallery_data['background_image_url'] != '') {
        ?>
                                            <div class="field_right image_wrap">
                                            <img src="<?php esc_html_e($gallery_data['background_image_url']);?>" height="48" width="48" />
                                            </div>
                                            <?php

    } else {
        ?>
                                            <div class="field_right image_wrap"></div>
                                            <?php

    }
    ?>
                                        <div class="field_right">
                                            <input type="button" class="button" value="Choose File" onclick="add_image(this)" />
                                        </div>
                        </div> -->
        <div class="field_left">
            <div class="form_field">
                <label>Price : </label>
                <input type="text" class="meta_image_url" name="gallery[price_info]" value="<?php if (isset($gallery_data['price_info'])) {
        esc_html_e($gallery_data['price_info']);
    }?>" />
            </div>
        </div>

        <div class="field_row">
            <div class="field_left">
                <div class="form_field">
                    <label style="width: 200px;float: left;">Solutions Library :</label>
                    <div style="float: left; width: 50%; height: 120px; overflow-y: auto;">
                        <?php
$sol_lib = rain_water_post_type($gallery_data);
    $custom_post_type = '';
    ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="clear"></div>
    </div>

</div>




</div>
<script>
    function reset_image(){
                jQuery('.image_wrap').html('');
                jQuery('.meta_image_url').val('');
                }
            </script>
<?php

}

function post_content_post_dinamic_contact_db()
{
    global $post;
    $gallery_data = get_post_meta($post->ID, 'gallery_data', true);
    $img_link = isset($gallery_data['background_image_url']) ? $gallery_data['background_image_url'] : '';
    // Use nonce for verification
    wp_nonce_field(plugin_basename(__FILE__), 'noncename_so_14445904');

    ?>

<div id="dynamic_form">
    <div id="field_wrap">
        <!-- <div class="field_row">
                                    <div class="field_left">
                                        <div class="form_field" >
                                            <label style="width: 200px;float: left;">Background Image :</label>
                                            <div style="float: left;">
                                                <input class="meta_image_url" value="<?php echo (isset($img_link) ? $img_link : ''); ?>" type="text" name="gallery[background_image_url]" readonly="" />
                                            </div>
                                        </div>
                                    </div>
                                            <?php
if (isset($gallery_data['background_image_url']) && $gallery_data['background_image_url'] != '') {
        ?>
                                            <div class="field_right image_wrap">
                                            <img src="<?php esc_html_e($gallery_data['background_image_url']);?>" height="48" width="48" />
                                            </div>
                                            <?php

    } else {
        ?>
                                            <div class="field_right image_wrap"></div>
                                            <?php

    }
    ?>
                                        <div class="field_right">
                                            <input type="button" class="button" value="Choose File" onclick="add_image(this)" />
                                        </div>
                        </div> -->
        <?php
$url_info = get_post_meta($post->ID, 'url_info', true);
    ?>
        <div class="field_left">
            <div class="form_field">
                <label class="lable_width">URL : </label>
                <input type="text" class="meta_image_url" name="gallery[url_info]" value="<?php if (isset($url_info)) {
        esc_html_e($url_info);
    }?>" />
            </div>
        </div>
        <?php
$email_info = get_post_meta($post->ID, 'email_info', true);
    ?>
        <div class="field_left">
            <div class="form_field">
                <label class="lable_width">Email : </label>
                <input type="text" class="meta_image_url" name="gallery[email_info]" value="<?php if (isset($email_info)) {
        esc_html_e($email_info);
    }?>" />
            </div>
        </div>
        <?php
$phone_info = get_post_meta($post->ID, 'phone_info', true);
    ?>
        <div class="field_left">
            <div class="form_field">
                <label class="lable_width">Phone : </label>
                <input type="text" class="meta_image_url" name="gallery[phone_info]" value="<?php if (isset($phone_info)) {
        esc_html_e($phone_info);
    }?>" />
            </div>
        </div>


        <?php
$location_info = get_post_meta($post->ID, 'location_info', true);
    ?>
        <div class="field_left">
            <div class="form_field">
                <label class="lable_width">City : </label>
                <?php
$selected = '';
    if (isset($location_info)) {
        $selected = $location_info;
    }
    state_cities_drop_down($selected);
    //city_state_drop_down();
    ?>
            </div>
        </div>
        <?php
$solutions = get_post_meta($post->ID, 'story_package', true);
    ?>
        <?php

    ?>
        <!-- <div class="field_left">
                                <div class="form_field">
                                    <label class="lable_width">Type : </label>
                                    <?php
$solutions_library = 0;
    if (isset($solutions)) {
        $solutions_library = $solutions;
    }
    //echo $solutions_library;
    //class="selectpicker" data-show-subtext="true" data-live-search="true"
    $args = array(
        'show_option_all' => 'Select Solutions Library',
        'hide_empty' => 0,
        'selected' => $solutions_library,
        'hierarchical' => 0,
        'name' => 'gallery[solutions_library]',
        'class' => 'selectpicker',
        'taxonomy' => 'solutions_library',
        'hide_if_empty' => false,
        'value_field' => 'term_id',
    );
    wp_dropdown_categories($args);
    $terms = get_terms(array(
        'taxonomy' => 'solutions_library',
        'hide_empty' => false,
    ));

    ?>
                                </div>
                        </div> -->

        <div class="clear"></div>
    </div>

</div>




</div>
<script>
    function reset_image(){
                jQuery('.image_wrap').html('');
                jQuery('.meta_image_url').val('');
                }
            </script>
<?php

}

function post_content_post_dinamic_success_stories()
{
    global $post;
    $gallery_data = get_post_meta($post->ID, 'gallery_data', true);
    //var_dump($gallery_data);

    // Use nonce for verification
    wp_nonce_field(plugin_basename(__FILE__), 'noncename_so_14445904');

    ?>
<div id="dynamic_form">
    <div id="field_wrap">
        <div class="form_field">
            <label class="lable_width">Name </label>
            <input type="text" class="meta_image_url" name="gallery[user_name]" value="<?php if (isset($gallery_data['gallery']['user_name'])) {
        esc_html_e($gallery_data['gallery']['user_name']);
    }?>" />
        </div>

        <div class="field_left">
            <div class="form_field">
                <label class="lable_width">City : </label>
                <?php
$location_info = isset($gallery_data['gallery']['location']) ? $gallery_data['gallery']['location'] : '';
    $selected = '';
    if (isset($location_info)) {
        $selected = $location_info;
    }
    state_cities_drop_down($selected);
    ?>
            </div>
        </div>
        <div class="field_left">
            <div class="form_field">
                <label class="lable_width">Solution : </label>
                <?php
                                                 //       var_dump($gallery_data);
$selected_article = isset($gallery_data['gallery_solution_post']) ? $gallery_data['gallery_solution_post'] : '';

    echo solution_drop_down($selected_article);
    ?>
            </div>
        </div>

        <div class="clear"></div>
    </div>

</div>
<script>
    function reset_image(){
                jQuery('.image_wrap').html('');
                jQuery('.meta_image_url').val('');
                }
            </script>
<?php
}

function post_content_post_dinamic_shop()
{
    global $post;
    $gallery_data = get_post_meta($post->ID, 'gallery_data', true);

    // Use nonce for verification
    wp_nonce_field(plugin_basename(__FILE__), 'noncename_so_14445904');

    ?>

<div id="dynamic_form">

    <div id="field_wrap">


        <div class="field_row">

            <div class="field_left">

                <!-- <div class="form_field">
                                <label style="width: 100px;">Short Description </label>
                                <textarea class="meta_image_url" name="gallery[short_description]" ><?php if (isset($gallery_data['short_description'])) {
        esc_html_e($gallery_data['short_description']);
    }?></textarea>

                                </div> -->

                <div class="form_field">
                    <label style="width: 100px;">Price</label>
                    <input type="text" class="meta_image_url" name="gallery[price_info]" value="<?php if (isset($gallery_data['price_info'])) {
        esc_html_e($gallery_data['price_info']);
    }?>" />
                </div>

            </div>

            <div class="field_left">
                <div class="form_field">
                    <label style="width: 100px;">Product Link</label>
                    <input type="text" class="meta_image_url" name="gallery[product_link]" value="<?php if (isset($gallery_data['product_link'])) {
        esc_html_e($gallery_data['product_link']);
    }?>" />
                </div>

                <!-- <div class="form_field">
                                    <label style="width: 100px;">Instamojo Link</label>
                                    <input type="text"
                                            class="meta_image_url"
                                            name="gallery[product_link]"
                                            value="<?php if (isset($gallery_data['product_link'])) {
        esc_html_e($gallery_data['product_link']);
    }?>"
                                    />
                                </div> -->

            </div>
            <div class="clear" />
        </div>
    </div>
    <?php
?>
</div>
</div>
<script>
    function reset_image(){
                jQuery('.image_wrap').html('');
                jQuery('.meta_image_url').val('');
                }
            </script>
<?php

}
function post_content_post_dinamic_author()
{
    global $post;
    $gallery_data = get_post_meta($post->ID, 'gallery_data', true);

    // Use nonce for verification
    wp_nonce_field(plugin_basename(__FILE__), 'noncename_so_14445904');

    ?>

<div id="dynamic_form">

    <div id="field_wrap">


        <div class="field_row">

            <div class="field_left">
                <div class="form_field">
                    <label>Author Type</label>
                    <input type="text" class="meta_image_url" name="gallery[author_type]" value="<?php if (isset($gallery_data['author_type'])) {
        esc_html_e($gallery_data['author_type']);
    }?>" />
                </div>
            </div>
            <div class="clear" />
        </div>
    </div>
    <?php
?>
</div>




</div>
<script>
    function reset_image(){
        jQuery('.image_wrap').html('');
        jQuery('.meta_image_url').val('');
        }
    </script>
<?php

}
function post_content_post_dinamic_gallery()
{
    global $post;
    $gallery_data = get_post_meta($post->ID, 'gallery_data', true);

    // Use nonce for verification
    wp_nonce_field(plugin_basename(__FILE__), 'noncename_so_14445904');

    ?>
<div id="dynamic_form">
    <div id="">
        <div class="field_row">

            <div class="field_left" style="width: 60%;">
                <div class="form_field">
                    <label>Image URL</label>
                    <input type="text" class="meta_image_url" name="gallery[background_image_url]" value="<?php if (isset($gallery_data['background_image_url'])) {
        esc_html_e($gallery_data['background_image_url']);
    }?>" />
                </div>
                <div class="form_field">
                    <label>Description</label>
                    <input type="text" class="meta_image_desc" name="gallery[background_image_desc]" value="<?php if (isset($gallery_data['background_image_desc'])) {
        esc_html_e($gallery_data['background_image_desc']);
    }?>" />
                </div>
            </div>
            <div class="field_right image_wrap">
                <?php
if (isset($gallery_data['background_image_url'])) {
        ?>
                <img src="<?php esc_html_e($gallery_data['background_image_url']);?>" height="48" width="48" />
                <?php

    }
    ?>
            </div>
            <div class="field_right">
                <input class="button" type="button" value="Choose File" onclick="add_image(this)" /><br />
                <input class="button" type="button" value="Remove" onclick="reset_image(this)" />
            </div>

            <div class="clear" />
        </div>
    </div>






    <div class="field_row">

        <div class="field_left">
            <div class="form_field">
                <label>Color Picker</label>

                <?php //echo $gallery_data['color-picker'];?>
                <input type="text" class="button colorpicker" id="color-picker" name="gallery[color-picker]" width="80" style="width:120px;" value="<?php if (isset($gallery_data['color-picker'])) {
        esc_html_e($gallery_data['color-picker']);
    } else {
        echo '#bada55';
    }?>" />
            </div>

        </div>
        <div class="clear" />
    </div>
</div>

<?php
// } // endif
    // } // endforeach

    ?>
</div>




<div class="field_row">
    <div class="field_left">
        <h4>Quick Bytes Content : </h4>
        <?php
$blank_arr = array();
    $order = isset($gallery_data['content_order']) ? $gallery_data['content_order'] : $blank_arr;
    $total_order_count = count($order);
//var_dump($order);
    ?>
    </div>
</div>
<div id="field_wrap">
    <?php
if (isset($gallery_data['quick_content']) && $total_order_count > 0) {
        $sort = asort($order);
        foreach ($order as $key => $val) {

            ?>
    <div class="field_row" style="padding-bottom: 0px; margin-bottom: 0px;">
        <div class="field_left">
            <div class="form_field" style="padding-bottom: 0px; ">

                <label>Quick Bytes Content : </label>
                <!-- <textarea class="quickbytes_class" name="gallery[quick_content][]" id=""><?php echo isset($gallery_data['quick_content'][$key]) ? $gallery_data['quick_content'][$key] : ''; ?></textarea> -->
                <?php
//$general_info = isset($gallery_data['general_info'][$c_card_type]) ? $gallery_data['general_info'][$c_card_type] : '';
            $general_info = isset($gallery_data['quick_content'][$key]) ? $gallery_data['quick_content'][$key] : '';

            echo wp_editor($general_info, 'general_info_' . $key, array(
                'wpautop' => true,
                'media_buttons' => true,
                'textarea_name' => 'gallery[quick_content][]',
                'textarea_rows' => 10,
                'teeny' => true,
            ));?>
            </div>
            <div class="form_field" style="padding-bottom: 0px; ">
                <label>Content Order : </label>
                <input class="meta_image_desc order_width" value="<?php echo isset($gallery_data['content_order'][$key]) ? $gallery_data['content_order'][$key] : ''; ?>" type="text" name="gallery[content_order][]" />
            </div>
        </div>
        <div class="col-12 remove_button" style="text-align:right;">
            <input class="button" type="button" value="Remove" onclick="remove_field_editor(this)" />
        </div>
        <div class="clear"></div>
    </div>
    <?php

        }
    }

    ?>
</div>

<div style="display:none;" id="master-row">

    <div class="field_row" style="padding-bottom: 0px; margin-bottom: 0px;">
        <div class="field_left">
            <div class="form_field" style="padding-bottom: 0px; ">

                <label>Quick Bytes Content : </label>
                <!-- <textarea class="quickbytes_class" name="gallery[quick_content][]" id=""></textarea> -->
                <?php echo wp_editor('', 'general_info', array(
        'wpautop' => true,
        'media_buttons' => true,
        'textarea_name' => 'gallery[quick_content][]',
        'textarea_rows' => 10,
        'teeny' => true,
    )); ?>
            </div>
            <div class="form_field" style="padding-bottom: 0px; ">
                <label>Content Order : </label>
                <input class="meta_image_desc order_width" value="" type="text" name="gallery[content_order][]" />
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>

<?php
//tab_with_dinamic_card_type($gallery_data);
    ?>
<div id="add_field_row">
    <input class="button" type="button" value="Add Field" onclick="add_field_row_quick();" />
</div>
</div>
<script>
    function reset_image(){
        jQuery('.image_wrap').html('');
        jQuery('.meta_image_url').val('');
        }
    </script>
<?php

}
function wordpress_editor()
{
    $id = $_REQUEST['replace_id'];
    ?>


<div class="field_row" style="padding-bottom: 0px; margin-bottom: 0px;">
    <div class="field_left">
        <div class="form_field" style="padding-bottom: 0px; ">

            <label>Quick Bytes Content : </label>

            <?php echo wp_editor('', $id, array(
        'wpautop' => false,
        'media_buttons' => true,
        'textarea_name' => 'gallery[quick_content][]',
        'textarea_rows' => 10,
        'teeny' => false,
        'tinymce' => true,
        'quicktags' => true,
    )); ?>
        </div>
        <div class="form_field" style="padding-bottom: 0px; ">
            <label>Content Order : </label>
            <input class="meta_image_desc order_width" value="" type="text" name="gallery[content_order][]" />
        </div>
    </div>
    <div class="col-12 remove_button" style="text-align:right;">
        <input class="button" type="button" value="Remove" onclick="remove_field_editor(this)" />
    </div>

    <div class="clear"></div>
</div>

<?php
}
function post_content_post_dinamic_content()
{
    global $post, $wp_meta_boxes;

    $gallery_data = get_post_meta($post->ID, 'gallery_data', true);

    wp_nonce_field(plugin_basename(__FILE__), 'noncename_so_14445904');

    ?>

<div id="dynamic_form">
    <div id="field_wrap">
    </div>
    <?php
            tab_with_dinamic_card_type($gallery_data);
        ?>
</div>

<?php

}
/**
 * Print styles and scripts
 */
function print_scripts_so_14445904()
{
    // Check for correct post_type
    global $post;
    //var_dump($post->post_type);
    if ($post->post_type == 'quickbyte') {
        ?>

<style type="text/css">
.field_left {
    float: left;
}

.field_right {
    float: left;
    margin-left: 10px;
}

.clear {
    clear: both;
}

#dynamic_form {
    width: 100%;
}

#dynamic_form input[type=text] {
    width: 300px;
}

#dynamic_form .field_row {
    /*border:1px solid #999;*/
    margin-bottom: 10px;
    padding: 10px;
}

#dynamic_form label {
    padding: 0 6px;
}
</style>

<script type="text/javascript">
function add_image(obj) {
    var parent = jQuery(obj).parent().parent('div.field_row');
    var inputField = jQuery(parent).find("input.meta_image_url");

    tb_show('', 'media-upload.php?TB_iframe=true');

    window.send_to_editor = function(html) {
        console.log(html);
        var url = jQuery(html).attr('src');
        console.log(url);

        inputField.val(url);
        jQuery(parent)
            .find("div.image_wrap")
            .html('<img src="' + url + '" height="48" width="48" />');

        // inputField.closest('p').prev('.awdMetaImage').html('<img height=120 width=120 src="'+url+'"/><p>URL: '+ url + '</p>');

        tb_remove();
    };

    return false;
}

function remove_field(obj) {
    var parent = jQuery(obj).parent().parent();
    //console.log(parent)
    parent.remove();
}


function remove_field_editor(vart) {
    var class_name = jQuery(vart).parent('div').parent('div');
    class_name.remove();
    console.log(class_name);
}

function add_field_row_quick() {

    var row = jQuery('#master-row').html();
    //console.log(row);
    var replace_id = 'general_info_' + random_number();
    var new_row = replaceAll(row, 'id="general_info"', 'id="' + replace_id + '"');
    //row.replace('id="general_info"', 'id="general_info'+Math.random()+'"');

    // console.log('------------'+new_row);
    //return false;
    My_New_Global_Settings = tinyMCEPreInit.mceInit.content;
    jQuery.ajax({
        url: ajax_url,
        type: "post",
        data: {
            action: "ajax_dynamic_textarea",
            replace_id: replace_id,
            post_type: 'contacts_database'
        },
        success: function(result) {
            //jQuery(".menu_data_from_ajax").html(result);
            //alert(result);
            if (result) {
                jQuery(result).appendTo('#field_wrap');
                //tinymce.remove();
                //tinymce.init();
                tinymce.init(My_New_Global_Settings);
                tinyMCE.execCommand('mceAddEditor', false, replace_id);
                quicktags({
                    id: replace_id
                });
                //quicktags({id : replace_id});
                //init tinymce
                //tinymce.init(tinyMCEPreInit.mceInit[replace_id]);

            }
        }
    });



}

function replaceAll(str, find, replace) {
    return str.replace(new RegExp(find, 'g'), replace);
}

function random_number() {
    return Math.floor(100000 + Math.random() * 900000);
}
</script>

<?php
} else if (SHOW_METABOX_ON != $post->post_type || SHOW_DYNAMIC_GALLERY != $post->post_type) {
        ?>

<style type="text/css">
.field_left {
    float: left;
}

.field_right {
    float: left;
    margin-left: 10px;
}

.clear {
    clear: both;
}

#dynamic_form {
    width: 100%;
}

#dynamic_form input[type=text] {
    width: 300px;
}

#dynamic_form .field_row {
    /*border:1px solid #999;*/
    margin-bottom: 10px;
    padding: 10px;
}

#dynamic_form label {
    padding: 0 6px;
}
</style>

<script type="text/javascript">
function add_image(obj) {
    var parent = jQuery(obj).parent().parent('div.field_row');
    var inputField = jQuery(parent).find("input.meta_image_url");

    tb_show('', 'media-upload.php?TB_iframe=true');

    window.send_to_editor = function(html) {
        console.log(html);
        var url = jQuery(html).attr('src');
        console.log(url);

        inputField.val(url);
        jQuery(parent)
            .find("div.image_wrap")
            .html('<img src="' + url + '" height="48" width="48" />');

        // inputField.closest('p').prev('.awdMetaImage').html('<img height=120 width=120 src="'+url+'"/><p>URL: '+ url + '</p>');

        tb_remove();
    };

    return false;
}

function remove_field(obj) {
    var parent = jQuery(obj).parent().parent();
    //console.log(parent)
    parent.remove();
}

function remove_field_spon(obj) {
    var parent = jQuery(obj).parent().parent().find('.image_wrap img');
    //console.log(parent)
    jQuery(obj).parent().parent().find('.meta_image_url').val('');
    parent.remove();
}

function add_field_row() {

    var row = jQuery('#master-row').html();
    jQuery(row).appendTo('#field_wrap');
}
</script>

<?php
}
}

add_action('wp_ajax_nopriv_ajax_dynamic_textarea', 'wordpress_editor');
add_action('wp_ajax_ajax_dynamic_textarea', 'wordpress_editor');
/**
 * Save post action, process fields
 */
function update_rainwater_harvesting_data($post_id, $post_object)
{
    // Doing revision, exit earlier **can be removed**
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Doing revision, exit earlier
    if ('revision' == $post_object->post_type) {
        return;
    }

    if (isset($_POST['post_type']) && 'rainwater_harvesting' != $_POST['post_type']) {
        return;
    }

    if (isset($_POST['gallery']) && $_POST['gallery']) {
        // Build array for saving post meta
        $gallery_data = array();

        for ($i = 0; $i < count($_POST['gallery']['rainwater']); $i++) {
            if ('' != $_POST['gallery']['rainwater'][$i]) {
                $gallery_data['rainwater'][] = $_POST['gallery']['rainwater'][$i];
            }
        }

        if ('' != $_POST['gallery']['image_desc']) {
            $gallery_data['image_desc'] = $_POST['gallery']['image_desc'];
        }
        if ('' != $_POST['gallery']['price_info']) {
            $gallery_data['price_info'] = $_POST['gallery']['price_info'];
        }
        if ('' != $_POST['gallery']['b_post_link_title']) {
            $gallery_data['b_post_link_title'] = $_POST['gallery']['b_post_link_title'];
        }
        if ('' != $_POST['gallery']['b_post_sub_title']) {
            $gallery_data['b_post_sub_title'] = $_POST['gallery']['b_post_sub_title'];
        }

        if ('' != $_POST['gallery']['b_post_link']) {
            $gallery_data['b_post_link'] = $_POST['gallery']['b_post_link'];
        }

        if ($gallery_data) {
            update_post_meta($post_id, 'gallery_data', $gallery_data);
        } else {
            delete_post_meta($post_id, 'gallery_data');
        }

    }
    // Nothing received, all fields are empty, delete option
    else {
            // delete_post_meta($post_id, 'gallery_data');
        }
    }
    function update_solutions_library_data($post_id, $post_object)
{
        // Doing revision, exit earlier **can be removed**
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        // Doing revision, exit earlier
        if ('revision' == $post_object->post_type) {
            return;
        }

        if (isset($_POST['post_type']) && 'solutions_library' != $_POST['post_type']) {
            return;
        }

        if (isset($_POST['gallery']) && $_POST['gallery']) {
            // Build array for saving post meta
            $gallery_data = array();

            // for ($i = 0; $i < count($_POST['gallery']['rainwater']); $i++) {
            //     if ('' != $_POST['gallery']['rainwater'][$i]) {
            //         $gallery_data['rainwater'][] = $_POST['gallery']['rainwater'][$i];
            //     }
            // }

            if ('' != $_POST['gallery']['background_image_url']) {
                $gallery_data['background_image_url'] = $_POST['gallery']['background_image_url'];
            }

            if ($gallery_data) {
                update_post_meta($post_id, 'gallery_data', $gallery_data);
            } else {
                delete_post_meta($post_id, 'gallery_data');
            }

        }
        // Nothing received, all fields are empty, delete option
    else {
            //  delete_post_meta($post_id, 'gallery_data');
        }
    }
    function update_post_gallery_so_14445904($post_id, $post_object)
{
        remove_action('save_post', __FUNCTION__);
        // Doing revision, exit earlier **can be removed**
        $data_content = $_POST['content'];

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        // Doing revision, exit earlier
        if ('revision' == $post_object->post_type) {
            return;
        }

        // Verify authenticity
        /* if ( !wp_verify_nonce( $_POST['noncename_so_14445904'], plugin_basename( __FILE__ ) ) )
        return;*/

        // Correct post type

        if (isset($_POST['post_type']) && SHOW_METABOX_ON != $_POST['post_type']) {
            return;
        }
        if ('post' == $post_object->post_type && isset($_POST['content'])) {

            // unhook this function so it doesn't loop infinitely
            //remove_action('save_post', 'post_content_function');

            // update the post, which calls save_post again
            $data_content = $_POST['content'];

            $data_content = strip_tags($data_content);
            $contetn_without_sp = clean_sp($data_content);
            //var_dump($contetn_without_sp);

            // var_dump($contetn_without_sp);
            //die();
            $fstring = substr(rtrim(ltrim($contetn_without_sp)), 0, 1);
            //echo $fstring ;
            //echo '-----------';
            $final_string = str_replace_first($fstring, '<span class="big">' . $fstring . '</span>', $data_content);
            //var_dump($final_string);
            // die();
            //$data['post_content'] .= $final_string;
            $my_post = array(
                'post_content' => $final_string,
            );
            //die();

            wp_update_post($my_post);
        }
        // var_dump($_POST['gallery']);
        // die();
        if (isset($_POST['gallery']) && $_POST['gallery']) {
            // Build array for saving post meta
            $gallery_data = array();

            /*for ($i = 0; $i < count( $_POST['gallery']['image_url'] ); $i++ )
            {
            if ( '' != $_POST['gallery']['image_url'][ $i ] )
            {
            $gallery_data['image_url'][]  = $_POST['gallery']['image_url'][ $i ];
            $gallery_data['image_desc'][] = $_POST['gallery']['image_desc'][ $i ];
            }
            }*/

            if ('' != $_POST['gallery']['image_desc']) {

                $gallery_data['image_desc'] = $_POST['gallery']['image_desc'];
            }
            if ('' != $_POST['gallery']['image_url']) {
                $gallery_data['image_url'] = $_POST['gallery']['image_url'];

            }
            if ('' != $_POST['gallery']['background_image_url']) {
                $gallery_data['background_image_url'] = $_POST['gallery']['background_image_url'];
                $gallery_data['background_image_desc'] = $_POST['gallery']['background_image_desc'];
            }
            if ('' != $_POST['gallery']['color-picker']) {
                $gallery_data['color-picker'] = $_POST['gallery']['color-picker'];

            }

            if ('' != $_POST['gallery']['youtube_link']) {
                $gallery_data['youtube_link'] = $_POST['gallery']['youtube_link'];

            }
            if ('' != $_POST['gallery']['spotlights_link']) {
                $gallery_data['spotlights_link'] = $_POST['gallery']['spotlights_link'];

            }

            if ('' != $_POST['gallery']['card_type']) {
                $gallery_data['card_type'] = $_POST['gallery']['card_type'];
                $card_type = $_POST['gallery']['card_type'];
                if (isset($_POST['gallery']['vertical_style'][$card_type])) {
                    $gallery_data['vertical_style'][$card_type] = $_POST['gallery']['vertical_style'][$card_type];
                } else {
                    $gallery_data['vertical_style'][$card_type] = 'v';
                }

                if (isset($_POST['gallery']['category'][$card_type])) {
                    $gallery_data['category'][$card_type] = $_POST['gallery']['category'][$card_type];
                } else {
                    //$gallery_data['category'][$card_type] = CHECK_BOX_DEFAULT_VALUE;
                }
                if (isset($_POST['gallery']['author'][$card_type])) {
                    $gallery_data['author'][$card_type] = $_POST['gallery']['author'][$card_type];
                } else {
                    //$gallery_data['author'][$card_type] = CHECK_BOX_DEFAULT_VALUE;
                }
                if (isset($_POST['gallery']['date_time'][$card_type])) {
                    $gallery_data['date_time'][$card_type] = $_POST['gallery']['date_time'][$card_type];
                } else {
                    //$gallery_data['date_time'][$card_type] = CHECK_BOX_DEFAULT_VALUE;
                }
                if (isset($_POST['gallery']['association'][$card_type])) {
                    $gallery_data['association'][$card_type] = $_POST['gallery']['association'][$card_type];
                } else {
                    // $gallery_data['association'][$card_type] = CHECK_BOX_DEFAULT_VALUE;
                }
                if (isset($_POST['gallery']['podcast_shortcode'][$card_type])) {
                    $gallery_data['podcast_shortcode'][$card_type] = $_POST['gallery']['podcast_shortcode'][$card_type];
                }
                if (isset($_POST['gallery']['expected'][$card_type])) {
                    $gallery_data['expected'][$card_type] = $_POST['gallery']['expected'][$card_type];
                }

                if (isset($_POST['gallery']['general_info'][$card_type])) {
                    $gallery_data['general_info'][$card_type] = $_POST['gallery']['general_info'][$card_type];
                }
                if (isset($_POST['gallery']['procedure'][$card_type])) {
                    $gallery_data['procedure'][$card_type] = $_POST['gallery']['procedure'][$card_type];
                }
                if (isset($_POST['gallery']['material'][$card_type])) {
                    $gallery_data['material'][$card_type] = $_POST['gallery']['material'][$card_type];
                }
                if (isset($_POST['gallery']['ecost'][$card_type])) {
                    $gallery_data['ecost'][$card_type] = $_POST['gallery']['ecost'][$card_type];
                }
                if (isset($_POST['gallery']['eprice'][$card_type])) {
                    $gallery_data['eprice'][$card_type] = $_POST['gallery']['eprice'][$card_type];
                }
                if (isset($_POST['gallery']['hour'][$card_type])) {
                    $gallery_data['hour'][$card_type] = $_POST['gallery']['hour'][$card_type];
                }

                if ('' != $_POST['gallery']['b_post_link_title']) {
                    $gallery_data['b_post_link_title'] = $_POST['gallery']['b_post_link_title'];
                }
                if ('' != $_POST['gallery']['b_post_link']) {
                    $gallery_data['b_post_link'] = $_POST['gallery']['b_post_link'];
                }
                if ('' != $_POST['gallery']['b_post_sub_title']) {
                    $gallery_data['b_post_sub_title'] = $_POST['gallery']['b_post_sub_title'];
                }

                if ('' != $_POST['gallery']['user_name']) {
                    $gallery_data['gallery']['user_name'] = $_POST['gallery']['user_name'];
                }
                if ('' != $_POST['gallery']['solution_post']) {
                    $gallery_data['gallery_solution_post'] = $_POST['gallery']['solution_post'];
                    $gallery_data['gallery']['solution_post'] = $_POST['gallery']['solution_post'];
                }
                if ('' != $_POST['gallery']['location_info']) {
                    $gallery_data['gallery']['location'] = $_POST['gallery']['location_info'];
                }
                //
                //
                //
                //

                // foreach ($_POST['tax_input'] as $tax => $term) {
                //    // var_dump($tax);
                //     //var_dump($term);
                //     if (taxonomy_exists($tax)) { // && term_exists($term, $tax)

                //         wp_set_post_terms($post_id, $term, $tax);
                //     }
                // }
                //die();

            }
            // echo $post_id;
            // var_dump($gallery_data);
            // die();
            if ($gallery_data) {

                $update = update_post_meta($post_id, 'gallery_data', $gallery_data);
                $update = update_post_meta($post_id, 'gallery_solution_post', $gallery_data['gallery_solution_post']);
                
            } else {
                delete_post_meta($post_id, 'gallery_data');
            }

        }
        // Nothing received, all fields are empty, delete option
    else {
            //delete_post_meta($post_id, 'gallery_data');
        }
    }
    function update_post_gallery_so($post_id, $post_object)
{
        // Doing revision, exit earlier **can be removed**
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        // Doing revision, exit earlier
        if ('revision' == $post_object->post_type) {
            return;
        }

        // Correct post type
        if (isset($_POST['post_type']) && 'quickbyte' != $_POST['post_type']) {
            return;
        }

        if (isset($_POST['gallery']) && $_POST['gallery']) {
            // Build array for saving post meta

            // if ($_POST['hidden_save_flag']==true ){
            $gallery_data = array();
            //var_dump($_POST['gallery']['quick_content']);
            //die();
            for ($i = 0; $i < count($_POST['gallery']['quick_content']); $i++) {
                if ('' != $_POST['gallery']['quick_content'][$i]) {
                    $gallery_data['quick_content'][] = $_POST['gallery']['quick_content'][$i];
                    if ('' != $_POST['gallery']['content_order'][$i]) {
                        $gallery_data['content_order'][] = (int) $_POST['gallery']['content_order'][$i];
                    } else {
                        $gallery_data['content_order'][] = ($i + 1);
                    }
                }
            }
            if ('' != $_POST['gallery']['image_url']) {
                $gallery_data['image_url'] = $_POST['gallery']['image_url'];

            }
            if ('' != $_POST['gallery']['image_desc']) {

                $gallery_data['image_desc'] = $_POST['gallery']['image_desc'];
            }
            if ('' != $_POST['gallery']['color-picker']) {
                $gallery_data['color-picker'] = $_POST['gallery']['color-picker'];

            }
            if ('' != $_POST['gallery']['background_image_url']) {
                $gallery_data['background_image_url'] = $_POST['gallery']['background_image_url'];
                $gallery_data['background_image_desc'] = $_POST['gallery']['background_image_desc'];
            }
            if ('' != $_POST['gallery']['youtube_link']) {
                $gallery_data['youtube_link'] = $_POST['gallery']['youtube_link'];

            }

            if ('' != $_POST['gallery']['card_type']) {
                $gallery_data['card_type'] = $_POST['gallery']['card_type'];

            }
            //var_dump( $gallery_data);die();

            if ($gallery_data) {
                update_post_meta($post_id, 'gallery_data', $gallery_data);
            } else {
                delete_post_meta($post_id, 'gallery_data');
            }

        } else {
            // delete_post_meta($post_id, 'gallery_data');
        }
        //}
    }
    function update_author_data($post_id, $post_object)
{
        // Doing revision, exit earlier **can be removed**
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        // Doing revision, exit earlier
        if ('revision' == $post_object->post_type) {
            return;
        }

        // Correct post type
        if (isset($_POST['post_type']) && 'author' != $_POST['post_type']) {
            return;
        }

        if (isset($_POST['gallery']) && $_POST['gallery']) {
            // Build array for saving post meta

            // if ($_POST['hidden_save_flag']==true ){
            $gallery_data = array();

            if ('' != $_POST['gallery']['author_type']) {
                $gallery_data['author_type'] = $_POST['gallery']['author_type'];
            }

            if ($gallery_data) {
                update_post_meta($post_id, 'gallery_data', $gallery_data);
            } else {
                delete_post_meta($post_id, 'gallery_data');
            }

        } else {
            //delete_post_meta($post_id, 'gallery_data');
        }
        //}
    }

    function update_awards_data($post_id, $post_object)
{
        // Doing revision, exit earlier **can be removed**
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        // Doing revision, exit earlier
        if ('revision' == $post_object->post_type) {
            return;
        }

        // Correct post type
        if (isset($_POST['post_type']) && 'awards' != $_POST['post_type']) {
            return;
        }

        if (isset($_POST['gallery']) && $_POST['gallery']) {
            // Build array for saving post meta

            // if ($_POST['hidden_save_flag']==true ){
            $gallery_data = array();

            if ('' != $_POST['gallery']['awards_info']) {
                $gallery_data['awards_info'] = $_POST['gallery']['awards_info'];
            }
            if ('' != $_POST['gallery']['awards_date']) {
                $gallery_data['awards_date'] = $_POST['gallery']['awards_date'];
            }

            if ($gallery_data) {
                update_post_meta($post_id, 'gallery_data', $gallery_data);
            } else {
                delete_post_meta($post_id, 'gallery_data');
            }

        } else {
            //delete_post_meta($post_id, 'gallery_data');
        }
        //}
    }

    function update_shop_data($post_id, $post_object)
{
        // Doing revision, exit earlier **can be removed**

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        // Doing revision, exit earlier
        if ('revision' == $post_object->post_type) {
            return;
        }

        // Correct post type
        if (isset($_POST['post_type']) && 'shop' != $_POST['post_type']) {
            return;
        }
        // var_dump($_POST);
        //echo 'hello';
        // die();
        if (isset($_POST['gallery']) && $_POST['gallery']) {
            // Build array for saving post meta

            // if ($_POST['hidden_save_flag']==true ){
            $gallery_data = array();

            if ('' != $_POST['gallery']['price_info']) {
                $gallery_data['price_info'] = $_POST['gallery']['price_info'];
            }
            if ('' != $_POST['gallery']['product_link']) {
                $gallery_data['product_link'] = $_POST['gallery']['product_link'];
            }

            if ($gallery_data) {
                update_post_meta($post_id, 'gallery_data', $gallery_data);
            } else {
                delete_post_meta($post_id, 'gallery_data');
            }

        } else {
            // delete_post_meta($post_id, 'gallery_data');
        }
        //}
    }

    function update_contacts_database_data($post_id, $post_object)
{
        // Doing revision, exit earlier **can be removed**
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        // Doing revision, exit earlier
        if ('revision' == $post_object->post_type) {
            return;
        }

        // Correct post type
        if (isset($_POST['post_type']) && 'contacts_database' != $_POST['post_type']) {
            return;
        }

        if (isset($_POST['gallery']) && $_POST['gallery']) {
            // Build array for saving post meta

            // if ($_POST['hidden_save_flag']==true ){
            $gallery_data = array();

            if ('' != $_POST['gallery']['price_info']) {
                $gallery_data['price_info'] = $_POST['gallery']['price_info'];
            }
            if ('' != $_POST['gallery']['location_info']) {
                $gallery_data['location_info'] = $_POST['gallery']['location_info'];
            }
            if ('' != $_POST['gallery']['url_info']) {
                $gallery_data['url_info'] = $_POST['gallery']['url_info'];
            }
            if ('' != $_POST['gallery']['email_info']) {
                $gallery_data['email_info'] = $_POST['gallery']['email_info'];
            }
            if ('' != $_POST['gallery']['phone_info']) {
                $gallery_data['phone_info'] = $_POST['gallery']['phone_info'];
            }
            if ('' != $_POST['gallery']['solutions_library']) {
                $gallery_data['solutions_library'] = $_POST['gallery']['solutions_library'];
            }

            if ($gallery_data) {
                update_post_meta($post_id, 'gallery_data', $gallery_data);
                update_post_meta($post_id, 'location_info', $gallery_data['location_info']);
                update_post_meta($post_id, 'url_info', $gallery_data['url_info']);
                update_post_meta($post_id, 'email_info', $gallery_data['email_info']);
                update_post_meta($post_id, 'phone_info', $gallery_data['phone_info']);
                update_post_meta($post_id, 'solutions_library', $gallery_data['solutions_library']);

            } else {
                delete_post_meta($post_id, 'gallery_data');
                delete_post_meta($post_id, 'location_info');
                delete_post_meta($post_id, 'url_info');
                delete_post_meta($post_id, 'email_info');
                delete_post_meta($post_id, 'phone_info');
                delete_post_meta($post_id, 'solutions_library');
            }

        } else {
            // delete_post_meta($post_id, 'gallery_data');
            // delete_post_meta($post_id, 'location_info');
            // delete_post_meta($post_id, 'url_info');
            // delete_post_meta($post_id, 'email_info');
            // delete_post_meta($post_id, 'phone_info');
            // delete_post_meta($post_id, 'solutions_library');
        }
        //}
    }

    function update_success_stories_data($post_id, $post_object)
{
        // Doing revision, exit earlier **can be removed**
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        // Doing revision, exit earlier
        if ('revision' == $post_object->post_type) {
            return;
        }

        // Correct post type
        if (isset($_POST['post_type']) && 'post' != $_POST['post_type']) {
            return;
        }

        if (isset($_POST['gallery']) && $_POST['gallery'] != '') {
            // Build array for saving post meta

            // if ($_POST['hidden_save_flag']==true ){
            $gallery_data = array();

            if ('' != $_POST['gallery']['user_name']) {
                $gallery_data['gallery']['user_name'] = $_POST['gallery']['user_name'];
            }
            if ('' != $_POST['gallery']['solution_post']) {
                $gallery_data['gallery']['solution_post'] = $_POST['gallery']['solution_post'];
            }
            if ('' != $_POST['gallery']['location_info']) {
                $gallery_data['gallery']['location'] = $_POST['gallery']['location_info'];
            }

            if ($gallery_data) {
                update_post_meta($post_id, 'gallery_data', $gallery_data);
            } else {
                delete_post_meta($post_id, 'gallery_data');
            }

        } else {
            // delete_post_meta($post_id, 'gallery_data');

        }
        //}
    }

    function tab_with_dinamic_card_type($gallery_data = '')
{
        global $post;
        ?>
<input type="hidden" id="gallery_card_type" name="gallery[card_type]" class="form-control form-control-sm" value="<?php echo (isset($gallery_data['card_type']) ? $gallery_data['card_type'] : 'top-stories'); ?>">
<input type="hidden" id="" name="hidden_save_flag" class="form-control form-control-sm" value="true">
<div class="animated fadeIn">
    <?php

                                $technology = ((isset($gallery_data['card_type']) && $gallery_data['card_type'] == 'top-stories') || (!isset($gallery_data) || $gallery_data == '') ? 'active' : '');
                                //var_dump($technology);
                                $youtube_link = '';
                                if (isset($gallery_data['youtube_link']) && $gallery_data['youtube_link'] != '') {
                                    $youtube_link = $gallery_data['youtube_link'];
                                }
                                $story_link = '';
                                if (isset($gallery_data['story_link']) && $gallery_data['story_link'] != '') {
                                    $story_link = $gallery_data['story_link'];
                                }

                                $spotlights_link = '';
                                if (isset($gallery_data['spotlights_link']) && $gallery_data['spotlights_link'] != '') {
                                    $spotlights_link = $gallery_data['spotlights_link'];
                                }
                                $tbicorners_link = '';
                                if (isset($gallery_data['tbicorners_link']) && $gallery_data['tbicorners_link'] != '') {
                                    $tbicorners_link = $gallery_data['tbicorners_link'];
                                }
                                $selected_tab = ((isset($_GET['select_tab']) && $_GET['select_tab'] != '') ? $_GET['select_tab'] : '');
                                if($selected_tab!=''){

                                }
                                if ((isset($gallery_data['card_type']) && ($gallery_data['card_type'] == 'solarticle'))||$selected_tab=='solarticle'){
                                    ?>

    <script>
        jQuery(function () {
            jQuery("#categorydiv").css('display','none');
        });
    </script>
    <?php
                                }
                                if((isset($gallery_data['card_type']) && ($gallery_data['card_type'] == 'solarticle'))||$selected_tab=='solarticle'){
                                    ?>
    <script>
        jQuery(function () {
                                        jQuery("#tagsdiv-solutions_library").css('display','block');
                                    });
                                    </script>
    <?php
                                }
                                ?>
    <div class="row">
        <div class="col-md-12 mb-4">
            <ul class="nav nav-tabs" role="tablist">
                <?php
                                            if($selected_tab!=''){
                                                ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo (($selected_tab == 'top-stories')  ? 'active' : ''); ?>" data-toggle="tab" href="#top-stories" role="tab" aria-controls="top-stories">Regular Post</a>
                </li>
                <?php  }else{?>
                <li class="nav-item">
                    <a class="nav-link <?php echo ((isset($gallery_data['card_type']) && $gallery_data['card_type'] == 'top-stories') || (!isset($gallery_data) || $gallery_data == '') ? 'active' : ''); ?>" data-toggle="tab" href="#top-stories" role="tab" aria-controls="top-stories">Regular Post</a>
                </li>
                <?php }?>

                <li class="nav-item">
                    <a class="nav-link <?php echo ((isset($gallery_data['card_type']) && ($gallery_data['card_type'] == 'pod_cast')) || ($selected_tab=='pod_cast') ? 'active' : '') ?>" data-toggle="tab" href="#pod_cast" role="tab" aria-controls="pod_cast">POD Cast</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ((isset($gallery_data['card_type']) && ($gallery_data['card_type'] == 'video')) || ($selected_tab=='video') ? 'active' : '') ?>" data-toggle="tab" href="#video" role="tab" aria-controls="video">Video</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ((isset($gallery_data['card_type']) && ($gallery_data['card_type'] == 'story')) || ($selected_tab=='story') ? 'active' : '') ?>" data-toggle="tab" href="#story" role="tab" aria-controls="story">Story</a>
                </li>
                <li class="nav-item" style="display:none;">
                    <a class="nav-link <?php echo ((isset($gallery_data['card_type']) && ($gallery_data['card_type'] == 'spotlights')) ? 'active' : '') ?>" data-toggle="tab" href="#spotlights" role="tab" aria-controls="spotlights">Spotlights</a>
                </li>
                <li class="nav-item" style="display:none;">
                    <a class="nav-link <?php echo ((isset($gallery_data['card_type']) && ($gallery_data['card_type'] == 'tbicorners')) ? 'active' : '') ?>" data-toggle="tab" href="#tbicorners" role="tab" aria-controls="tbicorners">TBI Corners</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ((isset($gallery_data['card_type']) && ($gallery_data['card_type'] == 'successstory')) ? 'active' : '') ?>" data-toggle="tab" href="#successstory" role="tab" aria-controls="successstory">Success Story</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo (((isset($gallery_data['card_type']) && ($gallery_data['card_type'] == 'solarticle'))||$selected_tab=='solarticle') ? 'active' : '') ?>" data-toggle="tab" href="#solarticle" role="tab" aria-controls="solarticle">Solution Article</a>
                </li>
            </ul>
            <div class="tab-content">
                <?php
                                                $c_card_type = 'top-stories';

                                                if($selected_tab!=''){
                                                    $tab_panel = (($selected_tab == 'top-stories')  ? 'active' : '');
                                                }else{
                                                    $tab_panel = ((isset($gallery_data['card_type']) && $gallery_data['card_type'] == 'top-stories') || (!isset($gallery_data) || $gallery_data == '') ? 'active' : '');
                                                }
                                            ?>
                <div class="tab-pane <?php echo $tab_panel ?>" id="top-stories" role="tabpanel">


                    <div class="card col-md-12">

                        <div class="card-body">

                            <!-- <div class="form-group row">
                                                    <label class="col-sm-5 col-form-label" for="input-small">View : </label>
                                                    <div class="col-sm-6">
                                                    Vertical
                                                    <input type="radio" id="" name="gallery[vertical_style][<?php echo $c_card_type ?>]" class="form-control form-control-sm" value="v" <?php echo (isset($gallery_data['vertical_style'][$c_card_type]) && $gallery_data['vertical_style'][$c_card_type] == 'v') ? 'checked' : '' ?>>
                                                    Horizontal
                                                    <input type="radio" id="" name="gallery[vertical_style][<?php echo $c_card_type ?>]" class="form-control form-control-sm" value="h" <?php echo (isset($gallery_data['vertical_style'][$c_card_type]) && $gallery_data['vertical_style'][$c_card_type] == 'h') ? 'checked' : '' ?>>
                                                    </div>
                                                </div> -->
                            <!-- <div class="form-group row">
                                                    <label class="col-sm-5 col-form-label" for="input-small">Category : </label>
                                                    <div class="col-sm-6">
                                                    <input type="checkbox" id="" name="gallery[category][<?php echo $c_card_type ?>]" class="form-control form-control-sm" value="1" <?php echo (isset($gallery_data['category'][$c_card_type]) && $gallery_data['category'][$c_card_type] == '1') ? 'checked' : '' ?>>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-5 col-form-label" for="input-small">Author : </label>
                                                    <div class="col-sm-6">
                                                    <input type="checkbox" id="" name="gallery[author][<?php echo $c_card_type ?>]" class="form-control form-control-sm" value="1" <?php echo (isset($gallery_data['author'][$c_card_type]) && $gallery_data['author'][$c_card_type] == '1') ? 'checked' : '' ?>>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-5 col-form-label" for="input-small">Date Time : </label>
                                                    <div class="col-sm-6">
                                                    <input type="checkbox" id="" name="gallery[date_time][<?php echo $c_card_type ?>]" class="form-control form-control-sm" value="1" <?php echo (isset($gallery_data['date_time'][$c_card_type]) && $gallery_data['date_time'][$c_card_type] == '1') ? 'checked' : '' ?>>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-5 col-form-label" for="input-small">Association : </label>
                                                    <div class="col-sm-6">
                                                    <input type="checkbox" id="" name="gallery[association][<?php echo $c_card_type ?>]" class="form-control form-control-sm" value="1" <?php echo (isset($gallery_data['association'][$c_card_type]) && $gallery_data['association'][$c_card_type] == '1') ? 'checked' : '' ?>>
                                                    </div>
                                                </div> -->

                        </div>

                    </div>


                </div>
                <div class="tab-pane <?php echo ((isset($gallery_data['card_type']) && ($gallery_data['card_type'] == 'tourism')) ? 'active' : '') ?>" id="tourism" role="tabpanel">
                    <?php $c_card_type = 'tourism';?>
                    <div class="card col-md-12">

                        <div class="card-body">

                            <!-- <div class="form-group row">
                                            <label class="col-sm-5 col-form-label" for="input-small">View : </label>
                                            <div class="col-sm-6">
                                            Vertical
                                            <input type="radio" id="" name="gallery[vertical_style][<?php echo $c_card_type ?>]" class="form-control form-control-sm" value="v" <?php echo (isset($gallery_data['vertical_style'][$c_card_type]) && $gallery_data['vertical_style'][$c_card_type] == 'v') ? 'checked' : '' ?>>
                                            Horizontal
                                            <input type="radio" id="" name="gallery[vertical_style][<?php echo $c_card_type ?>]" class="form-control form-control-sm" value="h" <?php echo (isset($gallery_data['vertical_style'][$c_card_type]) && $gallery_data['vertical_style'][$c_card_type] == 'h') ? 'checked' : '' ?>>
                                            </div>
                                            </div> -->
                            <!-- <div class="form-group row">
                                            <label class="col-sm-5 col-form-label" for="input-small">Category : </label>
                                            <div class="col-sm-6">
                                            <input type="checkbox" id="" name="gallery[category][<?php echo $c_card_type ?>]" class="form-control form-control-sm" value="1" <?php echo (isset($gallery_data['category'][$c_card_type]) && $gallery_data['category'][$c_card_type] == '1') ? 'checked' : '' ?>>
                                            </div>
                                            </div>

                                            <div class="form-group row">
                                            <label class="col-sm-5 col-form-label" for="input-small">Author : </label>
                                            <div class="col-sm-6">
                                            <input type="checkbox" id="" name="gallery[author][<?php echo $c_card_type ?>]" class="form-control form-control-sm" value="1" <?php echo (isset($gallery_data['author'][$c_card_type]) && $gallery_data['author'][$c_card_type] == '1') ? 'checked' : '' ?>>
                                            </div>
                                            </div>

                                            <div class="form-group row">
                                            <label class="col-sm-5 col-form-label" for="input-small">Date Time : </label>
                                            <div class="col-sm-6">
                                            <input type="checkbox" id="" name="gallery[date_time][<?php echo $c_card_type ?>]" class="form-control form-control-sm" value="1" <?php echo (isset($gallery_data['date_time'][$c_card_type]) && $gallery_data['date_time'][$c_card_type] == '1') ? 'checked' : '' ?>>
                                            </div>
                                            </div>
                                            <div class="form-group row">
                                            <label class="col-sm-5 col-form-label" for="input-small">Association : </label>
                                            <div class="col-sm-6">
                                            <input type="checkbox" id="" name="gallery[association][<?php echo $c_card_type ?>]" class="form-control form-control-sm" value="1" <?php echo (isset($gallery_data['association'][$c_card_type]) && $gallery_data['association'][$c_card_type] == '1') ? 'checked' : '' ?>>
                                            </div>
                                            </div> -->

                        </div>

                    </div>
                </div>
                <div class="tab-pane <?php echo ((isset($gallery_data['card_type']) && ($gallery_data['card_type'] == 'pod_cast')) || ($selected_tab=='pod_cast')  ? 'active' : '') ?>" id="pod_cast" role="tabpanel">
                    <?php $c_card_type = 'pod_cast';?>
                    <div class="card col-md-12">

                        <div class="card-body">
                            <!--
                                            <div class="form-group row">
                                                <label class="col-sm-5 col-form-label" for="input-small">View : </label>
                                                <div class="col-sm-6">
                                                Vertical
                                                <input type="radio" id="" name="gallery[vertical_style][<?php echo $c_card_type ?>]" class="form-control form-control-sm" value="v" <?php echo (isset($gallery_data['vertical_style'][$c_card_type]) && $gallery_data['vertical_style'][$c_card_type] == 'v') ? 'checked' : '' ?>>
                                                Horizontal
                                                <input type="radio" id="" name="gallery[vertical_style][<?php echo $c_card_type ?>]" class="form-control form-control-sm" value="h" <?php echo (isset($gallery_data['vertical_style'][$c_card_type]) && $gallery_data['vertical_style'][$c_card_type] == 'h') ? 'checked' : '' ?>>
                                                </div>
                                            </div>
                                                <div class="form-group row">
                                                <label class="col-sm-5 col-form-label" for="input-small">Category : </label>
                                                <div class="col-sm-6">
                                                <input type="checkbox" id="" name="gallery[category][<?php echo $c_card_type ?>]" class="form-control form-control-sm" value="1" <?php echo (isset($gallery_data['category'][$c_card_type]) && $gallery_data['category'][$c_card_type] == '1') ? 'checked' : '' ?>>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-5 col-form-label" for="input-small">Author : </label>
                                                <div class="col-sm-6">
                                                <input type="checkbox" id="" name="gallery[author][<?php echo $c_card_type ?>]" class="form-control form-control-sm" value="1" <?php echo (isset($gallery_data['author'][$c_card_type]) && $gallery_data['author'][$c_card_type] == '1') ? 'checked' : '' ?>>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-5 col-form-label" for="input-small">Date Time : </label>
                                                <div class="col-sm-6">
                                                <input type="checkbox" id="" name="gallery[date_time][<?php echo $c_card_type ?>]" class="form-control form-control-sm" value="1" <?php echo (isset($gallery_data['date_time'][$c_card_type]) && $gallery_data['date_time'][$c_card_type] == '1') ? 'checked' : '' ?>>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-5 col-form-label" for="input-small">Association : </label>
                                                <div class="col-sm-6">
                                                <input type="checkbox" id="" name="gallery[association][<?php echo $c_card_type ?>]" class="form-control form-control-sm" value="1" <?php echo (isset($gallery_data['association'][$c_card_type]) && $gallery_data['association'][$c_card_type] == '1') ? 'checked' : '' ?>>
                                                </div>
                                            </div> -->


                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label" for="input-small">Stitcher Embed Code : </label>
                                <div class="col-sm-6">
                                    <?php
                                                    //var_dump($gallery_data);
                                                    $pod_cast_value = $gallery_data['podcast_shortcode'][$c_card_type];
                            
                                                    if (isset($pod_cast_value)) {

                                                            preg_match('/<iframe.*src=\"(.*)\".*><\/iframe>/isU', $pod_cast_value, $matches);
                                                           // var_dump($matches);
                                                            echo '<iframe src="' . $matches[1] . '" width="266" height="182" frameborder="0" scrolling="no"></iframe>';
                                                        }
                                                        //echo (isset($gallery_data['podcast_shortcode'][$c_card_type])) ? stripslashes($gallery_data['podcast_shortcode'][$c_card_type]) : '' ?>
                                    <input type="text" id="" name="gallery[podcast_shortcode][<?php echo $c_card_type ?>]" class="form-control form-control-sm" value="<?php echo htmlentities($pod_cast_value);?>">
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
                <div class="tab-pane <?php echo ((isset($gallery_data['card_type']) && ($gallery_data['card_type'] == 'video')) || ($selected_tab=='video') ? 'active' : '') ?>" id="video" role="tabpanel">
                    <?php $c_card_type = 'video';?>
                    <div class="card col-md-12">

                        <div class="card-body">

                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label" for="input-small">YouTube Link :</label>
                                <div class="col-sm-6">
                                    <input type="text" id="gallery_youtube_link" value="<?php ($youtube_link != '' ? esc_html_e($youtube_link) : '')?>" name="gallery[youtube_link]" class="form-control form-control-sm" placeholder="YouTube Link">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane <?php echo ((isset($gallery_data['card_type']) && ($gallery_data['card_type'] == 'story'))  || ($selected_tab=='story') ? 'active' : '') ?>" id="story" role="tabpanel">
                    <?php $c_card_type = 'story';?>
                    <div class="card col-md-12">
                        <?php echo ((isset($gallery_data['card_type']) && ($gallery_data['card_type'] == 'story')) ? '<style>#story_packagediv{ display: block !important;}</style>' : '') ?>
                        <div class="card-body">
                            <div class="form-group row hide_category_story_package">
                                <div class="story_packHeading" style="">Select Story Package :</div>
                                <?php

                                                                $categories = get_terms('story_package', array(

                                                                    'hide_empty' => 0,
                                                                ));
                                                                $selected_term = get_the_terms($post->ID, 'story_package');
                                                                //var_dump($selected_term[0]->term_id);
                                                                // var_dump($categories);
                                                                //multiple

                                                                $select = "<select name='tokens' id='tokens' class='selectpicker form-control'  data-live-search='true'>";
                                                                // $select.= "<option data-tokens='-1' value='-1'>Select Story Package</option>";

                                                                foreach ($categories as $category) {
                                                                    $select .= "<option  value='' > Select Story Package</option>";

                                                                    // if($category->count > 0){
                                                                    if (isset($selected_term[0]->term_id) && $selected_term[0]->term_id == $category->term_id) {
                                                                        $selected = 'selected';
                                                                    } else {
                                                                        $selected = '';
                                                                    }
                                                                    $select .= "<option data-tokens='" . $category->term_id . "' value='" . $category->term_id . "' " . $selected . " >  " . substr($category->name, 0, 120) . ".</option>";
                                                                    // }
                                                                }

                                                                $select .= "</select>";

                                                                echo $select;

                                                                //wp_dropdown_categories( $args ); ?>
                                <script type="text/javascript">
                                <!--
                                var dropdown = document.getElementById("tokens");

                                function onCatChange() {

                                    if (dropdown.options[dropdown.selectedIndex].value != '0') {
                                        var element = jQuery("option:selected", this);
                                        var cval = element.attr('data-tokens')
                                        selected_checked(cval);
                                    }
                                }
                                dropdown.onchange = onCatChange;

                                function selected_checked(chk) {


                                    console.log(chk + 'val');
                                    jQuery('ul#story_packagechecklist').find("li").each(function(i, val) {
                                        //this.prop('checked')
                                        console.log(i + '---' + val);
                                        console.log(jQuery(this).find('input[type="checkbox"]').val());
                                        if (jQuery(this).find('input[type="checkbox"]').val() != '' && jQuery(this).find('input[type="checkbox"]').val() == chk) {
                                            jQuery(this).find('input[type="checkbox"]').prop('checked', true);
                                        } else {
                                            jQuery(this).find('input[type="checkbox"]').prop('checked', false);
                                        } // else if(jQuery(this).find('input[type="checkbox"]').val()!='' && chk==false){
                                        //     jQuery(this).find('input[type="checkbox"]').prop('checked', false);
                                        // }


                                    });
                                }

                                function uncheck_all(chk = false) {

                                    //story_packagechecklist
                                    // console.log(chk);
                                    jQuery('ul#story_packagechecklist').find("li").each(function(i, val) {
                                        //this.prop('checked')
                                        //console.log(i+'---'+val);
                                        // console.log(jQuery(this).find('input[type="checkbox"]').val());
                                        if (jQuery(this).find('input[type="checkbox"]').val() != '' && chk == true) {
                                            jQuery(this).find('input[type="checkbox"]').prop('checked', true);
                                        } else if (jQuery(this).find('input[type="checkbox"]').val() != '' && chk == false) {
                                            jQuery(this).find('input[type="checkbox"]').prop('checked', false);
                                        }


                                    });
                                }
                                -->
                                </script>





                                <?php

                                                                        $arr1['args']['taxonomy'] = 'story_package';
                                                                        $arr1['id'] = 'story_package';
                                                                        $arr1['title'] = 'story_package';
                                                                        echo post_categories_meta_box($post, $arr1);

                                                                        ?>

                            </div>
                            <!-- <div class="form-group row">
                                                <label class="col-sm-5 col-form-label" for="input-small">Story Link :</label>
                                                <div class="col-sm-6">
                                                <input type="text" id="gallery_story_link" value="<?php ($story_link != '' ? esc_html_e($story_link) : '')?>"  name="gallery[story_link]" class="form-control form-control-sm" placeholder="Story Link">
                                                </div>
                                                <span><small>Please Select Story Package Package.</small> </span>
                                            </div> -->
                        </div>
                    </div>
                </div>
                <div class="tab-pane <?php echo ((isset($gallery_data['card_type']) && ($gallery_data['card_type'] == 'spotlights')) ? 'active' : '') ?>" id="spotlights" role="tabpanel">
                    <?php $c_card_type = 'spotlights';?>
                    <div class="card col-md-12">

                        <div class="card-body">

                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label" for="input-small">Sub Heading :</label>
                                <div class="col-sm-6">
                                    <?php //var_dump($gallery_data);?>
                                    <input type="text" id="gallery_spotlights_link" value="<?php ($spotlights_link != '' ? esc_html_e($spotlights_link) : '')?>" name="gallery[spotlights_link]" class="form-control form-control-sm" placeholder="Sub Heading">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane <?php echo ((isset($gallery_data['card_type']) && ($gallery_data['card_type'] == 'tbicorners')) ? 'active' : '') ?>" id="tbicorners" role="tabpanel">
                    <?php $c_card_type = 'tbicorners';?>
                    <div class="card col-md-12">

                        <div class="card-body">

                            <!-- <div class="form-group row">
                                                <label class="col-sm-5 col-form-label" for="input-small">TBI Corner Link :</label>
                                                <div class="col-sm-6">
                                                <input type="text" id="gallery_tbicorners_link" value="<?php ($tbicorners_link != '' ? esc_html_e($tbicorners_link) : '')?>"  name="gallery[tbicorners_link]" class="form-control form-control-sm" placeholder="TBI Corner Link">
                                                </div>
                                            </div> -->
                        </div>
                    </div>
                </div>
                <div class="tab-pane <?php echo (((isset($gallery_data['card_type']) && ($gallery_data['card_type'] == 'successstory'))) || ($selected_tab=='successstory') ? 'active' : '') ?>" id="successstory" role="tabpanel">
                    <?php $c_card_type = 'successstory';?>
                    <div class="card col-md-12">
                        <div class="card-body">
                            <?php post_content_post_dinamic_success_stories();?>
                        </div>
                    </div>
                </div>


                <div class="tab-pane <?php echo ((isset($gallery_data['card_type']) && ($gallery_data['card_type'] == 'solarticle')) || ($selected_tab=='solarticle')? 'active' : '') ?>" id="solarticle" role="tabpanel">
                    <?php $c_card_type = 'solarticle';?>
                    <div class="card col-md-12">

                        <div class="card-body">

                            <div class="form-group row" style="display:none;">

                                <?php
                                                    // var_dump($post);
                                                        //                                 wp_get_post_terms();
                                                        $arr['args']['taxonomy'] = 'solutions_library';
                                                        $arr['id'] = 'solutions_library';
                                                        $arr['title'] = 'solutions_library';
                                                        echo post_categories_meta_box($post, $arr);

                                                        ?>

                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label" for="input-small">Price : </label>
                                <div class="col-sm-6">
                                    <input type="text" id="" value="<?php ((isset($gallery_data['eprice'][$c_card_type]) && $gallery_data['eprice'][$c_card_type] != '') ? esc_html_e($gallery_data['eprice'][$c_card_type]) : '')?>" name="gallery[eprice][<?php echo isset($c_card_type) ? $c_card_type : ''; ?>]" class="form-control form-control-sm" placeholder="Price">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label" for="input-small">Approx Hours : </label>
                                <div class="col-sm-6">
                                    <input type="text" id="" value="<?php ((isset($gallery_data['hour'][$c_card_type]) && $gallery_data['hour'][$c_card_type] != '') ? esc_html_e($gallery_data['hour'][$c_card_type]) : '')?>" name="gallery[hour][<?php echo isset($c_card_type) ? $c_card_type : ''; ?>]" class="form-control form-control-sm" placeholder="Approx Hours">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label style="width:100%;">General Recommendation :</label>
                                <div class="col" style="padding:0;">

                                    <?php
                                                        $general_info = isset($gallery_data['general_info'][$c_card_type]) ? $gallery_data['general_info'][$c_card_type] : '';
                                                            echo wp_editor($general_info, 'general_info', array(
                                                                'wpautop' => true,
                                                                'media_buttons' => true,
                                                                'textarea_name' => 'gallery[general_info][' . $c_card_type . ']',
                                                                'textarea_rows' => 10,
                                                                'teeny' => true,
                                                            ));?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label" for="input-small">Estimated Cost : </label>
                                <div class="col-sm-6">
                                    <input type="text" id="" value="<?php ((isset($gallery_data['ecost'][$c_card_type]) && $gallery_data['ecost'][$c_card_type] != '') ? esc_html_e($gallery_data['ecost'][$c_card_type]) : '')?>" name="gallery[ecost][<?php echo isset($c_card_type) ? $c_card_type : ''; ?>]" class="form-control form-control-sm" placeholder="Estimated Cost">
                                </div>
                            </div>
                            <div class="form-group row">

                                <label style="width:100%;">Materials Required :</label>
                                <div class="col" style="padding:0;">
                                    <?php
                                                                $material = isset($gallery_data['material'][$c_card_type]) ? $gallery_data['material'][$c_card_type] : '';
                                                                    //wp_enqueue_media();
                                                                    echo wp_editor($material, 'material', array(
                                                                        'wpautop' => true,
                                                                        'media_buttons' => true,
                                                                        'textarea_name' => 'gallery[material][' . $c_card_type . ']',
                                                                        'textarea_rows' => 10,
                                                                        'teeny' => true,
                                                                    ));?>
                                </div>
                            </div>

                            <div class="form-group row">

                                <label style="width:100%;"> Procedure :</label>
                                <div class="col" style="padding:0;">
                                    <?php
                                                            $procedure = isset($gallery_data['procedure'][$c_card_type]) ? $gallery_data['procedure'][$c_card_type] : '';
                                                                echo wp_editor($procedure, 'procedure', array(
                                                                    'wpautop' => true,
                                                                    'media_buttons' => true,
                                                                    'textarea_name' => 'gallery[procedure][' . $c_card_type . ']',
                                                                    'textarea_rows' => 10,
                                                                    'teeny' => true,
                                                                ));?>
                                </div>
                            </div>

                            <div class="form-group row">

                                <label style="width:100%;"> Expected :</label>
                                <div class="col" style="padding:0;">
                                    <?php
                                                    $expected = isset($gallery_data['expected'][$c_card_type]) ? $gallery_data['expected'][$c_card_type] : '';
                                                    echo wp_editor($expected, 'expected', array(
                                                    'wpautop' => true,
                                                    'media_buttons' => true,
                                                    'textarea_name' => 'gallery[expected][' . $c_card_type . ']',
                                                    'textarea_rows' => 10,
                                                    'teeny' => true,
                                                    ));?>
                                </div>
                            </div>


                            <!-- <div class="form-group row">
                                                    <label class="col-sm-5 col-form-label" for="input-small">Expected :</label>
                                                    <div class="col-sm-6">

                                                            <input type="text" id="gallery_tbicorners_link" value="<?php ($tbicorners_link != '' ? esc_html_e($tbicorners_link) : '')?>"  name="gallery[tbicorners_link]" class="form-control form-control-sm" placeholder="Solution Article Link">
                                                    </div>


                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-5 col-form-label" for="input-small">Solution Article :</label>
                                                    <div class="col-sm-6">
                                                            <input type="text" id="gallery_tbicorners_link" value="<?php ($tbicorners_link != '' ? esc_html_e($tbicorners_link) : '')?>"  name="gallery[tbicorners_link]" class="form-control form-control-sm" placeholder="Solution Article Link">
                                                    </div>
                                                </div> -->






                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
<?php

    }

            /*
            $args = array(
            'post_type' => 'book',
            'order' => 'asc',
            'meta_query' => array(
            array(
            'key' => $_GET['search_filter'],
            'value' => $_GET['s'],
            'compare' => 'IN',
            )
            )
            );
            $loop = new WP_Query( $args );
            */
            /*
            Quick Edit
            class el_extend_quick_edit{

            private static $instance = null;

            public function __construct(){

            add_action('manage_post_posts_columns', array($this, 'add_custom_admin_column'), 10, 1); //add custom column
            add_action('manage_posts_custom_column', array($this, 'manage_custom_admin_columns'), 10, 2); //populate column
            add_action('quick_edit_custom_box', array($this, 'display_quick_edit_custom'), 10, 2); //output form elements for quickedit interface
            add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_scripts_and_styles')); //enqueue admin script (for prepopulting fields with JS)
            add_action('add_meta_boxes', array($this, 'add_metabox_to_posts'), 10, 2); //add metabox to posts to add our meta info
            add_action('save_post', array($this, 'save_post'), 10, 1); //call on save, to update metainfo attached to our metabox

            }

            //adds a new metabox on our single post edit screen
            public function add_metabox_to_posts($post_type, $post){

            add_meta_box(
            'additional-meta-box',
            __('Additional Info', 'post-quick-edit-extension'),
            array($this, 'display_metabox_output'),
            'post',
            'side',
            'default'
            );
            }
            //metabox output function, displays our fields, prepopulating as needed
            public function display_metabox_output($post){

            $html = '';
            wp_nonce_field('post_metadata', 'post_metadata_field');

            $post_featured = get_post_meta($post->ID, 'post_featured', true);
            $post_rating = get_post_meta($post->ID, 'post_rating', true);
            $post_subtitle = get_post_meta($post->ID, 'post_subtitle', true);

            //Featured post (radio)
            $html .= '<p>';
            $html .= '<p><strong>Featured Post?</strong></p>';
            $html .= '<label for="post_featured_no">';
            if($post_featured == 'no' || empty($post_featured)){
            $html .= '<input type="radio" checked name="post_featured" id="post_featured_no" value="no"/>';
            }else{
            $html .= '<input type="radio" name="post_featured" id="post_featured_no" value="no"/>';
            }
            $html .= ' No</label>';
            $html .= '</br>';
            $html .= '<label for="post_featured_yes">';
            if($post_featured == 'yes'){
            $html .= '<input type="radio" checked name="post_featured" id="post_featured_yes" value="yes"/>';
            }else{
            $html .= '<input type="radio" name="post_featured" id="post_featured_yes" value="yes"/>';
            }
            $html .= ' Yes</label>';
            $html .= '</p>';

            //Internal Rating (select)
            $html .= '<p>';
            $html .= '<p>';
            $html .= '<label for="post_rating"><strong>Post Rating</strong></label>';
            $html .= '</p>';
            $html .= '<select name="post_rating" id="post_rating" value="' . $post_rating .'" class="widefat">';
            $html .= '<option value="1" ' . (($post_rating == '1') ? 'selected' : '') . '>1</option>';
            $html .= '<option value="2" ' . (($post_rating == '2') ? 'selected' : '') . '>2</option>';
            $html .= '<option value="3" ' . (($post_rating == '3') ? 'selected' : '') . '>3</option>';
            $html .= '<option value="4" ' . (($post_rating == '4') ? 'selected' : '') . '>4</option>';
            $html .= '<option value="5" ' . (($post_rating == '5') ? 'selected' : '') . '>5</option>';
            $html .= '</select>';

            $html .= '</p>';

            //Subtitle (text)
            $html .= '<p>';
            $html .= '<p>';
            $html .= '<label for="post_subtitle"><strong>Subtitle</strong></label>';
            $html .= '</p>';
            $html .= '<input type="text" name="post_subtitle" id="post_subtitle" value="' . $post_subtitle .'" class="widefat"/>';
            $html .= '</p>';

            echo $html;

            }
            //enqueue admin js to pre-populate the quick-edit fields
            public function enqueue_admin_scripts_and_styles(){
            wp_enqueue_script('quick-edit-script', plugin_dir_url(__FILE__) . '/post-quick-edit-script.js', array('jquery','inline-edit-post' ))
            }
            //Display our custom content on the quick-edit interface, no values can be pre-populated (all done in JS)
            public function display_quick_edit_custom($column){
            $html = '';
            wp_nonce_field('post_metadata', 'post_metadata_field');

            //output post featured checkbox
            if($column == 'post_featured'){
            $html .= '<fieldset class="inline-edit-col-left clear">';
            $html .= '<div class="inline-edit-group wp-clearfix">';
            $html .= '<label class="alignleft" for="post_featured_no">';
            $html .= '<input type="radio" name="post_featured" id="post_featured_no" value="no"/>';
            $html .= '<span class="checkbox-title">Post Not Featured</span></label>';
            $html .= '<label class="alignleft" for="post_featured_yes">';
            $html .= '<input type="radio" name="post_featured" id="post_featured_yes" value="yes"/>';
            $html .= '<span class="checkbox-title">Post Featured</span></label>';

            $html .= '</div>';
            $html .= '</fieldset>';
            }
            //output post rating select field
            else if($column == 'post_rating'){
            $html .= '<fieldset class="inline-edit-col-center ">';
            $html .= '<div class="inline-edit-group wp-clearfix">';
            $html .= '<label class="alignleft" for="post_rating">Post Rating</label>';
            $html .= '<select name="post_rating" id="post_rating" value="">';
            $html .= '<option value="1">1</option>';
            $html .= '<option value="2">2</option>';
            $html .= '<option value="3">3</option>';
            $html .= '<option value="4">4</option>';
            $html .= '<option value="5">5</option>';
            $html .= '</select>';
            $html .= '</div>';
            $html .= '</fieldset>';
            }
            //output post subtitle text field
            else if($column == 'post_subtitle'){
            $html .= '<fieldset class="inline-edit-col-right ">';
            $html .= '<div class="inline-edit-group wp-clearfix">';
            $html .= '<label class="alignleft" for="post_rating">Post Subtitle</label>';
            $html .= '<input type="text" name="post_subtitle" id="post_subtitle" value="" />';
            $html .= '</div>';
            $html .= '</fieldset>';
            }

            echo $html;
            }
            //add a custom column to hold our data
            public function add_custom_admin_column($columns){
            $new_columns = array();

            $new_columns['post_featured'] = 'Featured?';
            $new_columns['post_rating'] = 'Rating';
            $new_columns['post_subtitle'] = 'Subtitle';

            return array_merge($columns, $new_columns);
            }
            //customise the data for our custom column, it's here we pull in meatdata info
            public function manage_custom_admin_columns($column_name, $post_id){
            $html = '';

            if($column_name == 'post_featured'){
            $post_featured = get_post_meta($post_id, 'post_featured', true);

            $html .= '<div id="post_featured_' . $post_id . '">';
            if($post_featured == 'no' || empty($post_featured)){
            $html .= 'no';
            }else if ($post_featured == 'yes'){
            $html .= 'yes';
            }
            $html .= '</div>';
            }
            else if($column_name == 'post_rating'){
            $post_rating = get_post_meta($post_id, 'post_rating', true);

            $html .= '<div id="post_rating_' . $post_id . '">';
            $html .= $post_rating;
            $html .= '</div>';
            }
            else if($column_name == 'post_subtitle'){
            $post_subtitle = get_post_meta($post_id, 'post_subtitle', true);

            $html .= '<div id="post_subtitle_' . $post_id . '">';
            $html .= $post_subtitle;
            $html .= '</div>';
            }

            echo $html;
            }
            //saving meta info (used for both traditional and quick-edit saves)
            public function save_post($post_id){
            $post_type = get_post_type($post_id);

            if($post_type == 'post'){

            //check nonce set
            if(!isset($_POST['post_metadata_field'])){
            return false;
            }

            //verify nonce
            if(!wp_verify_nonce($_POST['post_metadata_field'], 'post_metadata')){
            return false;
            }

            //if not autosaving
            if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return false;
            }

            //all good to save
            $featured_post = isset($_POST['post_featured']) ? sanitize_text_field($_POST['post_featured']) : '';
            $post_rating = isset($_POST['post_rating']) ? sanitize_text_field($_POST['post_rating']) : '';
            $post_subtitle = isset($_POST['post_subtitle']) ? sanitize_text_field($_POST['post_subtitle']) : '';

            update_post_meta($post_id, 'post_featured', $featured_post);
            update_post_meta($post_id, 'post_rating', $post_rating);
            update_post_meta($post_id, 'post_subtitle', $post_subtitle);
            }

            }
            //gets singleton instance
            public static function getInstance(){
            if(is_null(self::$instance)){
            self::$instance = new self();
            }
            return self::$instance;
            }

            }
            $el_extend_quick_edit = el_extend_quick_edit::getInstance();

            */
    function rain_water_post_type($gallery_data)
{
        $rainwater_arr = isset($gallery_data['rainwater']) ? $gallery_data['rainwater'] : array();
        $loop = new WP_Query(array('post_type' => 'solutions_library', 'posts_per_page' => -1));
        if ($loop->have_posts()) {
            while ($loop->have_posts()): $loop->the_post();
                ?>
<div class="item selected_product">
    <div class="thumbnail_image">
        <?php
                        //checked
                                $id = get_the_ID();
                                $checked = in_array($id, $rainwater_arr);
                                //echo $checked;
                                $check_box = isset($checked) && $checked != '' ? 'checked' : '';
                                ?>
        <input type="checkbox" name="gallery[rainwater][]" value="<?php echo $id; ?>" <?php echo $check_box; ?> >
        <?php the_title();?>
    </div>

</div>
<?php
                    endwhile;
        }
    }

    add_filter('manage_rainwater_harvesting_posts_columns', 'set_custom_edit_rainwater_harvesting_columns');
    function set_custom_edit_rainwater_harvesting_columns($columns)
{
        unset($columns['author']);
        $columns['solution'] = __('Solutions Library', 'your_text_domain');
        //$columns['publisher'] = __('Publisher', 'your_text_domain');

        return $columns;
    }

// Add the data to the custom columns for the book post type:
    add_action('manage_rainwater_harvesting_posts_custom_column', 'custom_rainwater_harvesting_column', 10, 2);
    function custom_rainwater_harvesting_column($column, $post_id)
{
        switch ($column) {

            case 'solution':
                //$terms = get_the_term_list($post_id, 'book_author', '', ',', '');
                $terms = get_solution_library_list($post_id);
                echo $terms;

                break;

            case 'publisher':
                echo get_post_meta($post_id, 'publisher', true);
                break;

        }
    }
    function get_solution_library_list($post_id)
{
        $gallery_data = get_post_meta($post_id, 'gallery_data', true);
        //var_dump($gallery_data['rainwater']);
        $rainwater = isset($gallery_data['rainwater']) ? $gallery_data['rainwater'] : array();
        //var_dump($rainwater);
        $total_rainwater = count($rainwater);
        //echo $total_rainwater;
        if ($total_rainwater > 0) {
            foreach ($rainwater as $k => $val_rain) {
                echo get_the_title($val_rain);
                if ($k > 0) {
                    echo ',<br>';
                }
            }
        }
    }
    ?>