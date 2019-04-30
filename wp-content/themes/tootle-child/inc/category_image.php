<?php
define('CATEGORY_IMAGE_FIELD', 'story_package');
if( ! class_exists( 'Showcase_Taxonomy_Images' ) ) {
  class Showcase_Taxonomy_Images {
    
    public function __construct() {
     //
    }

    /**
     * Initialize the class and start calling our hooks and filters
     */
     public function init() {
     // Image actions
     add_action( CATEGORY_IMAGE_FIELD.'_add_form_fields', array( $this, 'add_category_image' ), 10, 2 );
     add_action( 'created_'.CATEGORY_IMAGE_FIELD, array( $this, 'save_category_image' ), 10, 2 );
     add_action( CATEGORY_IMAGE_FIELD.'_edit_form_fields', array( $this, 'update_category_image' ), 10, 2 );
     add_action( 'edited_'.CATEGORY_IMAGE_FIELD, array( $this, 'updated_category_image' ), 10, 2 );
     add_action( 'admin_enqueue_scripts', array( $this, 'load_media' ) );
     add_action( 'admin_footer', array( $this, 'add_script' ) );
   }

   public function load_media() {
     if( ! isset( $_GET['taxonomy'] ) || $_GET['taxonomy'] != CATEGORY_IMAGE_FIELD ) {
       return;
     }
     wp_enqueue_media();
   }
  
   /**
    * Add a form field in the new category page
    * @since 1.0.0
    */
  
   public function add_category_image( $taxonomy ) { ?>
     <div class="form-field term-group">
       <label for="showcase-taxonomy-image-id"><?php _e( 'Image', 'showcase' ); ?></label>
       <input type="hidden" id="showcase-taxonomy-image-id" name="showcase-taxonomy-image-id" class="custom_media_url" value="">
       <div id="category-image-wrapper"></div>
       <p>
         <input type="button" class="button button-secondary showcase_tax_media_button" id="showcase_tax_media_button" name="showcase_tax_media_button" value="<?php _e( 'Add Image', 'showcase' ); ?>" />
         <input type="button" class="button button-secondary showcase_tax_media_remove" id="showcase_tax_media_remove" name="showcase_tax_media_remove" value="<?php _e( 'Remove Image', 'showcase' ); ?>" />
       </p>
     </div>





     <div class="form-field term-group">
       <label for="showcase-taxonomy-image-id1"><?php _e( 'Background Image', 'showcase' ); ?></label>
       <input type="hidden" id="showcase-taxonomy-image-id1" name="showcase-taxonomy-image-id1" class="custom_media_url" value="">
       <div id="category-image-wrapper1"></div>
       <p>
         <input type="button" class="button button-secondary showcase_tax_media_button1" id="showcase_tax_media_button1" name="showcase_tax_media_button1" value="<?php _e( 'Add Image', 'showcase' ); ?>" />
         <input type="button" class="button button-secondary showcase_tax_media_remove1" id="showcase_tax_media_remove1" name="showcase_tax_media_remove1" value="<?php _e( 'Remove Image', 'showcase' ); ?>" />
       </p>
     </div>

     <div class="form-field term-group">
       <label for="showcase-taxonomy-image-id"><?php _e( 'Subject', 'showcase' ); ?></label>

      
       <p>
       <?php
       $categories = get_terms([
    'taxonomy' => 'category',
    'hide_empty' => false,
]);
 
  $select = "<select name='cat' id='cat' class='postform'>n";
  $select.= "<option value='-1'>Select category</option>n";
 
  foreach($categories as $category){
    //if($category->count > 0){
        $select.= "<option value='".$category->slug."'>".$category->name."</option>";
    //}
  }
 
  $select.= "</select>";
 
  echo $select;
      // wp_dropdown_categories( 'show_count=1&hierarchical=1' );
       ?>
       </p>
     </div>

   <?php }

   /**
    * Save the form field
    * @since 1.0.0
    */
   public function save_category_image( $term_id, $tt_id ) {
     if( isset( $_POST['cat'] ) && '' !== $_POST['cat'] ){
       add_term_meta( $term_id, 'cat',  $_POST['cat'] , true );
     }
     if( isset( $_POST['showcase-taxonomy-image-id'] ) && '' !== $_POST['showcase-taxonomy-image-id'] ){
       add_term_meta( $term_id, 'showcase-taxonomy-image-id', absint( $_POST['showcase-taxonomy-image-id'] ), true );
     }
    }

    /**
     * Edit the form field
     * @since 1.0.0
     */
    public function update_category_image( $term, $taxonomy ) { ?>
      <tr class="form-field term-group-wrap">
        <th scope="row">
          <label for="showcase-taxonomy-image-id"><?php _e( 'Image', 'showcase' ); ?></label>
        </th>
        <td>
          <?php $image_id = get_term_meta( $term->term_id, 'showcase-taxonomy-image-id', true ); ?>
          <input type="hidden" id="showcase-taxonomy-image-id" name="showcase-taxonomy-image-id" value="<?php echo esc_attr( $image_id ); ?>">
          <div id="category-image-wrapper">
            <?php if( $image_id ) { ?>
              <?php echo wp_get_attachment_image( $image_id, 'thumbnail' ); ?>
            <?php } ?>
          </div>
          <p>
            <input type="button" class="button button-secondary showcase_tax_media_button" id="showcase_tax_media_button" name="showcase_tax_media_button" value="<?php _e( 'Add Image', 'showcase' ); ?>" />
            <input type="button" class="button button-secondary showcase_tax_media_remove" id="showcase_tax_media_remove" name="showcase_tax_media_remove" value="<?php _e( 'Remove Image', 'showcase' ); ?>" />
          </p>
        </td>
      </tr>


       <tr class="form-field term-group-wrap">
        <th scope="row">
          <label for="showcase-taxonomy-image-id1"><?php _e( 'Background Image', 'showcase' ); ?></label>
        </th>
        <td>
          <?php $image_id = get_term_meta( $term->term_id, 'showcase-taxonomy-image-id1', true ); ?>
          <input type="hidden" id="showcase-taxonomy-image-id1" name="showcase-taxonomy-image-id1" value="<?php echo esc_attr( $image_id ); ?>">
          <div id="category-image-wrapper1">
            <?php if( $image_id ) { ?>
              <?php echo wp_get_attachment_image( $image_id, 'thumbnail' ); ?>
            <?php } ?>
          </div>
          <p>
            <input type="button" class="button button-secondary showcase_tax_media_button1" id="showcase_tax_media_button" name="showcase_tax_media_button1" value="<?php _e( 'Add Image', 'showcase' ); ?>" />
            <input type="button" class="button button-secondary showcase_tax_media_remove1" id="showcase_tax_media_remove1" name="showcase_tax_media_remove1" value="<?php _e( 'Remove Image', 'showcase' ); ?>" />
          </p>
        </td>
      </tr>


      <tr class="form-field term-group-wrap">
        <th scope="row">
          <label for="showcase-taxonomy-image-id"><?php _e( 'Category', 'showcase' ); ?></label>
        </th>
        <td>
        <?php
        $categories = get_terms([
            'taxonomy' => 'category',
            'hide_empty' => false,
        ]);
        
         $cat_id = get_term_meta( $term->term_id, 'cat', true );
         
          $select = "<select name='cat' id='cat' class='postform'>n";
          $select.= "<option value='-1'>Select category</option>n";
         
          foreach($categories as $category){
            //if($category->count > 0){
            $selected = ($cat_id==$category->slug?'selected':'');
                $select.= "<option value='".$category->slug."' ".$selected.">".$category->name."</option>";
            //}
          }
         
          $select.= "</select>";
         
          echo $select;
        ?>
          <?php  ?>

          
          
          
        </td>
      </tr>
   <?php }

   /**
    * Update the form field value
    * @since 1.0.0
    */
   public function updated_category_image( $term_id, $tt_id ) {

    if( isset( $_POST['cat'] ) && '' !== $_POST['cat'] ){
      
       update_term_meta( $term_id, 'cat',  $_POST['cat']  );
     }else {
       update_term_meta( $term_id, 'cat', '' );
     }
     if( isset( $_POST['showcase-taxonomy-image-id'] ) && '' !== $_POST['showcase-taxonomy-image-id'] ){
       update_term_meta( $term_id, 'showcase-taxonomy-image-id', absint( $_POST['showcase-taxonomy-image-id'] ) );
     } else {
       update_term_meta( $term_id, 'showcase-taxonomy-image-id', '' );
     }
     if( isset( $_POST['showcase-taxonomy-image-id1'] ) && '' !== $_POST['showcase-taxonomy-image-id1'] ){
       update_term_meta( $term_id, 'showcase-taxonomy-image-id1', absint( $_POST['showcase-taxonomy-image-id1'] ) );
     } else {
       update_term_meta( $term_id, 'showcase-taxonomy-image-id1', '' );
     }
   }
 
   /**
    * Enqueue styles and scripts
    * @since 1.0.0
    */
   public function add_script() {
     if( ! isset( $_GET['taxonomy'] ) || $_GET['taxonomy'] != CATEGORY_IMAGE_FIELD ) {
       return;
     } ?>
     <script> jQuery(document).ready( function($) {
       _wpMediaViewsL10n.insertIntoPost = '<?php _e( "Insert", "showcase" ); ?>';


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

       $('body').on('click','.showcase_tax_media_remove',function(){
         $('#showcase-taxonomy-image-id').val('');
         $('#category-image-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
       });



       function ct_media_upload1(button_class) {
         var _custom_media = true, _orig_send_attachment = wp.media.editor.send.attachment;
         
         $('body').on('click', button_class, function(e) {
           var button_id = '#'+$(this).attr('id');
           var send_attachment_bkp = wp.media.editor.send.attachment;
           var button = $(button_id);
           _custom_media = true;
           wp.media.editor.send.attachment = function(props, attachment){
             if( _custom_media ) {
               $('#showcase-taxonomy-image-id1').val(attachment.id);
               $('#category-image-wrapper1').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
               $( '#category-image-wrapper1 .custom_media_image' ).attr( 'src',attachment.url ).css( 'display','block' );
             } else {
               return _orig_send_attachment.apply( button_id, [props, attachment] );
             }
           }
           wp.media.editor.open(button); return false;
         });
       }
       ct_media_upload1('.showcase_tax_media_button1.button');

       $('body').on('click','.showcase_tax_media_remove1',function(){
         $('#showcase-taxonomy-image-id1').val('');
         $('#category-image-wrapper1').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
       });


       // Thanks: http://stackoverflow.com/questions/15281995/wordpress-create-category-ajax-response
       $(document).ajaxComplete(function(event, xhr, settings) {
         var queryStringArr = settings.data.split('&');
         if( $.inArray('action=add-tag', queryStringArr) !== -1 ){
           var xml = xhr.responseXML;
           $response = $(xml).find('term_id').text();
           if($response!=""){
             // Clear the thumb image
             $('#category-image-wrapper').html('');
           }
          }
        });
      });
    </script>
   <?php }
  }
$Showcase_Taxonomy_Images = new Showcase_Taxonomy_Images();
$Showcase_Taxonomy_Images->init(); }