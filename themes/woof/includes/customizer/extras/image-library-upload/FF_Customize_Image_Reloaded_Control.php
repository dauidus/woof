<?php
if (class_exists('WP_Customize_Control')) {
   class FF_Customize_Image_Reloaded_Control extends WP_Customize_Image_Control {
	
      public $extensions = array( 'jpg', 'jpeg', 'gif', 'png' );
      public $filename = '';
      
      /**
       * Constructor.
       *
       * @since 3.4.0
       * @uses WP_Customize_Image_Control::__construct()
       *
       * @param WP_Customize_Manager $manager
       */
      public function __construct( $manager, $id, $args = array() ) {
   
         parent::__construct( $manager, $id, $args );
         $this->add_tab( 'library',   __('Library'),   array( $this, 'tab_library' ) );
      }
   
      /**
       * Search for images within the defined context
       * If there's no context, it'll bring all images from the library
       *
       */
      public function tab_uploaded() {
         $my_context_uploads = get_posts( array(
            'post_type'  => 'attachment',
            //'meta_key'   => '_wp_attachment_context',
            //'meta_value' => $this->context,
            'orderby'    => 'post_date',
            'nopaging'   => true,
         ) );
   
         ?>
   
         <div class="uploaded-target"></div>
   
         <?php
         if ( empty( $my_context_uploads ) )
            return;
   
         foreach ( (array) $my_context_uploads as $my_context_upload ) {
            $path_parts = pathinfo(parse_url(esc_url_raw( $my_context_upload->guid ), PHP_URL_PATH));
            if(in_array($path_parts['extension'], $this->extensions)) $this->print_tab_image( esc_url_raw( $my_context_upload->guid ) );
         }
      }
      public function tab_library() {
         wp_deregister_style('thickbox');
         wp_register_style('thickbox', get_stylesheet_directory_uri() . '/css/thickbox.css');
         wp_enqueue_script('ff-image-picker', get_stylesheet_directory_uri() . '/js/ff-image-picker.js');
         wp_enqueue_script('jquery-image-picker', get_stylesheet_directory_uri() . '/js/image-picker.min.js', 'jquery');
         wp_localize_script( 'ff-image-picker', 'MyAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ), 'wpnonce' => wp_create_nonce('ff-wpnonce') ) );
         wp_enqueue_style('jquery-image-picker-style', get_stylesheet_directory_uri() . '/css/image-picker.css');
         add_thickbox();
         $unique_id = $this->generateRandomString(10);
         ?>
         <label>
         <a href="#TB_inline?height=600&width=1100&inlineId=hiddenModalContent-<?php echo $unique_id; ?>" class="thickbox">Choose Image</a>
         </label>
         <div id="hiddenModalContent-<?php echo $unique_id; ?>" style="display:none">
            <?php
            $options = $this->ff_get_categories();
            if($options) {
            ?>
            <div class="ff-images-selection-div">
               <select class="ff-image-select-category" data-id="<?php echo $unique_id; ?>" data-fn="<?php echo $this->filename; ?>">
               <option value="">Select an image category</option>
                  <?php echo $options; ?>   
               </select>
               <div id="<?php echo $unique_id; ?>" class="ff-images-container"></div>
               <p style="text-align:center"><input type="submit" id="select-image" value="&nbsp;&nbsp;Select&nbsp;&nbsp;" onclick="ff_close_tb('<?php echo $this->id; ?>', '<?php echo $unique_id; ?>')"></p>
            </div>
            <?php } else {  ?>
            <div class="ff-images-selection-error">
               <?php if($this->filename) { ?>
               Error reading CSV file.
               <?php } else { ?>
               Filename not specified in control.
               <?php } ?>
               <p style="text-align:center"><input type="submit" id="select-image-error" value="&nbsp;&nbsp;Ok&nbsp;&nbsp;" onclick="tb_remove()"></p>
            </div>
            
            <?php } ?>
         </div>
<?php
      }
      
      
      private function ff_get_categories() {
         $images_file = $this->filename;
         if(file_exists($images_file)) {
            $handle = fopen($images_file, 'r');
            if ($handle) {
               $cats = array();
               while (($buffer = fgets($handle)) !== false) {
                  $line = explode(',', str_replace(array("\r", "\n"), '', $buffer) );
                  foreach($line as $k=>$v) {
                     if($k != 0 && $k != 1 && $v ) {
                        $cats[$v] = true;
                     }
                  }
               }
               if (!feof($handle)) {
                  return false;
               }
               fclose($handle);
               $opts = '';
               foreach($cats as $cat=>$bol) {
                  $opts .= '<option value="' . $cat . '">' . $cat . '</option>';
               }
               return $opts;
            }            
         } else {
            return false;
         }
         
      }
      private function generateRandomString( $length ) {
         $chars = array_merge(range('a', 'z'), range(0, 9));
         shuffle($chars);
         return implode(array_slice($chars, 0, $length));
      }
   }
}

function ff_get_images_options() {
   $category = $_POST['category'];
   $images_file = $_POST['filename'];
   $success = true;
   $opts = '';
   if(file_exists($images_file)) {
      $handle = fopen($images_file, 'r');
      if ($handle) {
         $filenames = array();
         while (($buffer = fgets($handle)) !== false) {
            $line = explode(',', str_replace(array("\r", "\n"), '', $buffer) );
            $cat_match = false;
            foreach($line as $k=>$v) {
               if($v == $category ) {
                  $cat_match = true;
                  break;
               }
            }
            if($cat_match) {
               $opts .= '<option data-img-src="' . $line[1] . '" value="' . $line[0] . '">' . $line[0] . '</option>';
            }
         }
         if (!feof($handle)) {
            $success = false;
         }
         fclose($handle);
      }            
   } else {
      $success = false;
   }
   
   $response = json_encode(array('success' => $success,'opts' => $opts ));
   echo $response;
   exit;
}
add_action('wp_ajax_ff_get_images_options', 'ff_get_images_options');
