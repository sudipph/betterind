<?php
define('CATEGORY_SOLUTION_FIELD', 'solutions_library');
if (!class_exists('Showcase_Taxonomy_Solutions_Library')) {
  class Showcase_Taxonomy_Solutions_Library
  {

    public function __construct()
    {
     //
    }

    /**
     * Initialize the class and start calling our hooks and filters
     */
    public function init()
    {
     // Image actions
      add_action(CATEGORY_SOLUTION_FIELD . '_add_form_fields', array($this, 'add_category_image'), 10, 2);
      add_action('created_' . CATEGORY_SOLUTION_FIELD, array($this, 'save_category_image'), 10, 2);
      add_action(CATEGORY_SOLUTION_FIELD . '_edit_form_fields', array($this, 'update_category_image'), 10, 2);
      add_action('edited_' . CATEGORY_SOLUTION_FIELD, array($this, 'updated_category_image'), 10, 2);
      add_action('admin_enqueue_scripts', array($this, 'load_media'));
      add_action('admin_footer', array($this, 'add_script'));
    }

    public function load_media()
    {
      if (!isset($_GET['taxonomy']) || $_GET['taxonomy'] != CATEGORY_SOLUTION_FIELD) {
        return;
      }
      wp_enqueue_media();
    }

    /**
     * Add a form field in the new category page
     * @since 1.0.0
     */

    public function add_category_image($taxonomy)
    { ?>
     <div class="form-field term-group">
          <label for="showcase-taxonomy-image-id"><?php _e('Image', 'showcase'); ?></label>
          <input type="hidden" id="showcase-taxonomy-image-id" name="showcase-taxonomy-image-id" class="custom_media_url" value="">
          <div id="category-image-wrapper"></div>
          <p>
            <input type="button" class="button button-secondary showcase_tax_media_button" id="showcase_tax_media_button" name="showcase_tax_media_button" value="<?php _e('Add Image', 'showcase'); ?>" />
            <input type="button" class="button button-secondary showcase_tax_media_remove" id="showcase_tax_media_remove" name="showcase_tax_media_remove" value="<?php _e('Remove Image', 'showcase'); ?>" />
          </p>
     </div>
      
      <!-- <div class="form-field term-group">
          <label for="showcase-taxonomy-background"><?php _e('Background Image', 'showcase'); ?></label>
          <input type="hidden" id="showcase-taxonomy-background" name="showcase-taxonomy-background" class="custom_media_url" value="">
          <div id="category-image-wrapper_b"></div>
          <p>
            <input type="button" class="button button-secondary showcase_tax_media_button_b" id="showcase_tax_media_button_b" name="showcase_tax_media_button_b" value="<?php _e('Add Image', 'showcase'); ?>" />
            <input type="button" class="button button-secondary showcase_tax_media_remove_b" id="showcase_tax_media_remove_b" name="showcase_tax_media_remove_b" value="<?php _e('Remove Image', 'showcase'); ?>" />
          </p>
     </div> -->

      <div class="form-field term-group">
          <label for="showcase-taxonomy-background"><?php _e('Color Effect', 'showcase'); ?></label>
          
          <p>
            <input type="text" class="button colorpicker" id="color-picker" name="color-picker" width="80" style="width:120px;" value="#bada55" />
            
          </p>
     </div>
     <!-- <div class="form-field term-group">
       <label for=""><?php _e('Subject', 'showcase'); ?></label>

      
       <p>
       <?php
      $categories = get_terms([
        'taxonomy' => 'category',
        'hide_empty' => false,
      ]);

      $select = "<select name='cat' id='cat' class='postform'>n";
      $select .= "<option value='-1'>Select category</option>n";

      foreach ($categories as $category) {
    //if($category->count > 0){
        $select .= "<option value='" . $category->slug . "'>" . $category->name . "</option>";
    //}
      }

      $select .= "</select>";

      echo $select;
      // wp_dropdown_categories( 'show_count=1&hierarchical=1' );
      ?>
       </p>
     </div> -->

   <?php 
}

/**
 * Save the form field
 * @since 1.0.0
 */
public function save_category_image($term_id, $tt_id)
{

  if (isset($_POST['cat']) && '' !== $_POST['cat']) {
    add_term_meta($term_id, 'cat', $_POST['cat'], true);
  }
  if (isset($_POST['showcase-taxonomy-image-id']) && '' !== $_POST['showcase-taxonomy-image-id']) {
    add_term_meta($term_id, 'showcase-taxonomy-image-id', absint($_POST['showcase-taxonomy-image-id']), true);
  }
  //background
  if (isset($_POST['showcase-taxonomy-background']) && '' !== $_POST['showcase-taxonomy-background']) {
    add_term_meta($term_id, 'showcase-taxonomy-background', absint($_POST['showcase-taxonomy-background']), true);
  }
  if (isset($_POST['color-picker']) && '' !== $_POST['color-picker']) {
    
    add_term_meta($term_id, 'color-picker', $_POST['color-picker'], true);
  }
  
}

/**
 * Edit the form field
 * @since 1.0.0
 */
public function update_category_image($term, $taxonomy)
{ ?>
      <tr class="form-field term-group-wrap">
        <th scope="row">
          <label for="showcase-taxonomy-image-id"><?php _e('Image', 'showcase'); ?></label>
        </th>
        <td>
          <?php $image_id = get_term_meta($term->term_id, 'showcase-taxonomy-image-id', true); ?>
          <input type="hidden" id="showcase-taxonomy-image-id" name="showcase-taxonomy-image-id" value="<?php echo esc_attr($image_id); ?>">
          <div id="category-image-wrapper">
            <?php if ($image_id) { ?>
              <?php echo wp_get_attachment_image($image_id, 'thumbnail'); ?>
            <?php 
          } ?>
          </div>
          <p>
            <input type="button" class="button button-secondary showcase_tax_media_button" id="showcase_tax_media_button" name="showcase_tax_media_button" value="<?php _e('Add Image', 'showcase'); ?>" />
            <input type="button" class="button button-secondary showcase_tax_media_remove" id="showcase_tax_media_remove" name="showcase_tax_media_remove" value="<?php _e('Remove Image', 'showcase'); ?>" />
          </p>
        </td>
      </tr>

      <!-- <tr class="form-field term-group-wrap">
        <th scope="row">
          <label for="showcase-taxonomy-background"><?php _e('Background Image', 'showcase'); ?></label>
        </th>
        <td>
          <?php $image_id = get_term_meta($term->term_id, 'showcase-taxonomy-background', true); ?>
          <input type="hidden" id="showcase-taxonomy-background" name="showcase-taxonomy-background" value="<?php echo esc_attr($image_id); ?>">
          <div id="category-image-wrapper_b">
            <?php if ($image_id) { ?>
              <?php echo wp_get_attachment_image($image_id, 'thumbnail'); ?>
            <?php 
          } ?>
          </div>
          <p>
            <input type="button" class="button button-secondary showcase_tax_media_button_b" id="showcase_tax_media_button_b" name="showcase_tax_media_button_b" value="<?php _e('Add Image', 'showcase'); ?>" />
            <input type="button" class="button button-secondary showcase_tax_media_remove_b" id="showcase_tax_media_remove_b" name="showcase_tax_media_remove_b" value="<?php _e('Remove Image', 'showcase'); ?>" />
          </p>
        </td>
      </tr> -->
      <tr class="form-field term-group-wrap">
        <th scope="row">
          <label for="color-picker"><?php _e('Color Effect', 'showcase'); ?></label>
        </th>
        <td>
          <?php $colorpicker = get_term_meta($term->term_id, 'color-picker', true); ?>
          
          <div id="category-image-wrapper_b">
            <?php if ($colorpicker) { ?>
             <input type="text" class="button " id="color-picker" name="color-picker" value="<?php echo esc_attr($colorpicker); ?>"  style="width:120px; background-color:<?php echo esc_attr($colorpicker); ?>;"/>
            <?php 
          }else{ ?>
<input type="text" class="button " id="color-picker" name="color-picker" value="" style="width:120px"/>
<?php } ?>
          </div>
         
        </td>
      </tr>
      <!-- <tr class="form-field term-group-wrap">
        <th scope="row">
          <label for="showcase-taxonomy-image-id"><?php _e('Category', 'showcase'); ?></label>
        </th>
        <td>
        <?php
        $categories = get_terms([
          'taxonomy' => 'category',
          'hide_empty' => false,
        ]);

        $cat_id = get_term_meta($term->term_id, 'cat', true);

        $select = "<select name='cat' id='cat' class='postform'>n";
        $select .= "<option value='-1'>Select category</option>n";

        foreach ($categories as $category) {
            //if($category->count > 0){
          $selected = ($cat_id == $category->slug ? 'selected' : '');
          $select .= "<option value='" . $category->slug . "' " . $selected . ">" . $category->name . "</option>";
            //}
        }

        $select .= "</select>";

        echo $select;
        ?>
          <?php  ?>

          
          
          
        </td>
      </tr> -->
   <?php 
}

/**
 * Update the form field value
 * @since 1.0.0
 */
public function updated_category_image($term_id, $tt_id)
{
//   var_dump($_POST);
// die();
  if (isset($_POST['cat']) && '' !== $_POST['cat']) {

    update_term_meta($term_id, 'cat', $_POST['cat']);
  } else {
    update_term_meta($term_id, 'cat', '');
  }
  if (isset($_POST['showcase-taxonomy-image-id']) && '' !== $_POST['showcase-taxonomy-image-id']) {
    update_term_meta($term_id, 'showcase-taxonomy-image-id', absint($_POST['showcase-taxonomy-image-id']));
  } else {
    update_term_meta($term_id, 'showcase-taxonomy-image-id', '');
  }
  //background
  if (isset($_POST['showcase-taxonomy-background']) && '' !== $_POST['showcase-taxonomy-background']) {
    update_term_meta($term_id, 'showcase-taxonomy-background', absint($_POST['showcase-taxonomy-background']));
  } else {
    update_term_meta($term_id, 'showcase-taxonomy-background', '');
  }
  
  if (isset($_POST['color-picker']) && '' !== $_POST['color-picker']) {
    update_term_meta($term_id, 'color-picker', $_POST['color-picker']);
  } else {
    update_term_meta($term_id, 'color-picker', '');
  }
}

/**
 * Enqueue styles and scripts
 * @since 1.0.0
 */
public function add_script()
{
  if (!isset($_GET['taxonomy']) || $_GET['taxonomy'] != CATEGORY_SOLUTION_FIELD) {
    return;
  } ?>
     <script> jQuery(document).ready( function($) {
       _wpMediaViewsL10n.insertIntoPost = '<?php _e("Insert", "showcase"); ?>';
       function ct_media_upload(button_class) {
         var _custom_media = true, _orig_send_attachment = wp.media.editor.send.attachment;
         $('body').on('click', button_class, function(e) {
           var button_id = '#'+$(this).attr('id');
           var send_attachment_bkp = wp.media.editor.send.attachment;
           var button = $(button_id);
           _custom_media = true;
           wp.media.editor.send.attachment = function(props, attachment){
             if( _custom_media ) {
               $('#showcase-taxonomy-image-id').val(attachment.id);
               $('#category-image-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
               $( '#category-image-wrapper .custom_media_image' ).attr( 'src',attachment.url ).css( 'display','block' );
             } else {
               return _orig_send_attachment.apply( button_id, [props, attachment] );
             }
           }
           wp.media.editor.open(button); return false;
         });
       }
       ct_media_upload('.showcase_tax_media_button.button');

       function ct_media_upload_b(button_class) {
         var _custom_media = true, _orig_send_attachment = wp.media.editor.send.attachment;
         $('body').on('click', button_class, function(e) {
           var button_id = '#'+$(this).attr('id');
           var send_attachment_bkp = wp.media.editor.send.attachment;
           var button = $(button_id);
           _custom_media = true;
           wp.media.editor.send.attachment = function(props, attachment){
             if( _custom_media ) {
               $('#showcase-taxonomy-background').val(attachment.id);
               $('#category-image-wrapper_b').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
               $( '#category-image-wrapper_b .custom_media_image' ).attr( 'src',attachment.url ).css( 'display','block' );
             } else {
               return _orig_send_attachment.apply( button_id, [props, attachment] );
             }
           }
           wp.media.editor.open(button); return false;
         });
       }
       ct_media_upload_b('.showcase_tax_media_button_b.button');
       $('body').on('click','.showcase_tax_media_remove_b',function(){
         $('#showcase-taxonomy-background').val('');
         $('#category-image-wrapper_b').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
       });

       $('body').on('click','.showcase_tax_media_remove',function(){
         $('#showcase-taxonomy-image-id').val('');
         $('#category-image-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
       });
       // Thanks: http://stackoverflow.com/questions/15281995/wordpress-create-category-ajax-response
       $(document).ajaxComplete(function(event, xhr, settings) {
         var queryStringArr = settings.data.split('&');
         if( $.inArray('action=add-tag', queryStringArr) !== -1 ){
           var xml = xhr.responseXML;
           $response = $(xml).find('term_id').text();
           console.log('responce image thumb');
           if($response!=""){
             // Clear the thumb image
             $('#category-image-wrapper').html('');
           }
          }
        });
      });
    </script>
   <?php 
}
}
$Showcase_Taxonomy_Solutions_Library = new Showcase_Taxonomy_Solutions_Library();
$Showcase_Taxonomy_Solutions_Library->init();
}