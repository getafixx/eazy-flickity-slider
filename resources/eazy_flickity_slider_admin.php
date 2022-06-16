<?php 
if ('is_admin') {

  //add admin CSS & JS
  if(!function_exists('eazy_flickity_admin_styles_scripts')){
    add_action( 'admin_enqueue_scripts', 'eazy_flickity_admin_styles_scripts' );    
    function eazy_flickity_admin_styles_scripts(){
      //add css
      wp_register_style('eazy-flickity-admin-css', plugins_url( 'css/admin-style.css', __FILE__ ), false, '1.0', false );
      wp_enqueue_style('eazy-flickity-admin-css');
    } 
  }//end !function_exists('eazy_flickity_admin_styles_scripts')


  add_action('current_screen', 'eazy_flickity_load_admin');
  function eazy_flickity_load_admin(){
    $current_screen = get_current_screen();
    if( $current_screen ->post_type == 'eazy_flickity_slide'){

      // change default text in title to say slide title instead of 
      if (!function_exists('custom_eazy_slider_title')){
        add_filter('gettext','custom_eazy_slider_title');
        function custom_eazy_slider_title( $input ) {
          //global $post_type; 'eazy_flickity_slide' == $post_type &&
          if( 'Enter title here' == $input )
            return 'Enter Slide Title';
          return $input;
        }
      }// end if !function_exists('custom_eazy_slider_title')


      // remove featured image metabox & add Eazy Flickity Slide Image to keep aspect ratio for thumbs in admin
      if (!function_exists('eazy_slider_image_box')){
        add_action('do_meta_boxes', 'eazy_slider_image_box');    
        function eazy_slider_image_box() {
          remove_meta_box( 'postimagediv', 'eazy_flickity_slide', 'side' );
          add_meta_box('postimagediv', __('Add Eazy Flickity Slide Image'), 'post_thumbnail_meta_box', 'eazy_flickity_slide', 'side', 'default');
        }
      }// end if !function_exists('eazy_slider_image_box')


    // ***NEED TO MAKE THIS SORT WHEN SELECTED*** //
      //add dropdown with slider names (tax terms)  
      if (!function_exists('eazy_flickity_admin_slider_dropdown')) {
        add_action('restrict_manage_posts', 'eazy_flickity_admin_slider_dropdown');
        function eazy_flickity_admin_slider_dropdown() { 
          $taxonomy  = 'eazy_flickity_slider'; 
          $selected      = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';
          $info_taxonomy = get_taxonomy($taxonomy);
            wp_dropdown_categories(array(
              'show_option_all' => __("Show All Sliders"),
              'taxonomy'        => $taxonomy,
              'name'            => $taxonomy,
              'orderby'         => 'name',
              'selected'        => $selected,
              'show_count'      => true,
              'hide_empty'      => true,
            ));
        }
      }//end if !function_exists('eazy_flickity_admin_slider_dropdown')

      // change size of admin featured image size in edit screen 
      if (!function_exists('eazy_slider_image_size')){
        function eazy_slider_image_size( $downsize, $id, $size ) {
          if ( ! get_current_screen() || 'edit' !== get_current_screen()->parent_base ) {
            return $downsize;
          }
          remove_filter( 'image_downsize', __FUNCTION__, 10, 3 );
          // settings can be thumbnail, medium, large, full 
          $image = image_downsize( $id, 'medium' ); 
          add_filter( 'image_downsize', __FUNCTION__, 10, 3 );
          return $image;
        }
        add_filter( 'image_downsize', 'eazy_slider_image_size', 10, 3 );
      }// end if !function_exists('eazy_slider_image_size')


      //add thumnail to all slides list
      if (!function_exists('eazy_flickity_admin_images')) {  
        add_action( 'admin_head', 'eazy_flickity_admin_images', 99 );
        function eazy_flickity_admin_images() {
          if (function_exists( 'add_theme_support' )){
            add_filter('manage_posts_columns', 'posts_columns', 5);
            add_action('manage_posts_custom_column', 'posts_custom_columns', 5, 2);
            add_filter('manage_pages_columns', 'posts_columns', 5);
            add_action('manage_pages_custom_column', 'posts_custom_columns', 5, 2);
          }
          function posts_columns($defaults){
            $defaults['eazy_flickity_image'] = __('Slider Image');
            return $defaults;
          }
          function posts_custom_columns($column_name, $id){
            if($column_name === 'eazy_flickity_image'){
              echo the_post_thumbnail( 'thumbnail' );
            }
          } 
        }
      }//end if !function_exists('eazy_flickity_admin_images')       

    }// end if current screen post type is eazy_flickity_slide
    
    // if current screen is not eazy flickity silde, is add or edit page with a base of post
    if( $current_screen ->post_type != 'eazy_flickity_slide' 
      && $current_screen ->action == in_array($current_screen ->action, array('add', 'edit')) 
      && $current_screen ->base == 'post'){

      //add buttons for thickbox for inserting shorcode
      add_action('media_buttons', 'add_eazy_flickity_slider_shortcode_button', 11);
      add_action('admin_footer',  'add_eazy_flickity_slider_shortcode_popup');
      //create the button
      function add_eazy_flickity_slider_shortcode_button(){
        echo '<a href="#TB_inline?width=480&height=480&inlineId=select_eazy_slider_shortcode" class="thickbox eazy-flickity-shortcode-button"
                  id="add_eazy_flickity_slider_shortcode" title="' . __("Add Eazy Flickity Slider Shortcode", 'ez-flickity-slider' ) . '"><span class="eazy-flickity-shortcode-info"><p>' . __("Flickity Slider", 'ez-flickity-slider' ) . '</p></span></a>';
      }

      //create thickbox popup
      function add_eazy_flickity_slider_shortcode_popup(){
        add_action( 'admin_enqueue_scripts', 'eazy_flickity_admin_tinymce' );
        function eazy_flickity_admin_tinymce(){
          wp_enqueue_script('flickity-tinymce',  EZ_FLICKITY_ELEMENTS_URL  . 'js/flickity.tinymce.js', array('jquery'), false, true );        
        }
        eazy_flickity_slider_admin_tinymce_html();
      }

    }//end if current screen is not eazy flickity silde....




  }
}// end if admin
