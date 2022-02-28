<?php
if (!function_exists('eazy_flickity_slides')) {

//Hook into init to add slides (custom post type)
add_action( 'init', 'eazy_flickity_slides', 0 );
// Hook into init to add sliders (custom taxonomy)
add_action( 'init', 'eazy_flickity_slider', 0 );
//flush rewrite rules
add_action('init', 'flush_rewrite_rules', 10 );


//register custom post type to be used as slider images
function eazy_flickity_slides() {
  $labels = array(
    'name'                => _x( 'Eazy Flickity Slides', 'Post Type General Name', 'ez-flickity-slider' ),
    'singular_name'       => _x( 'Eazy Flickity Slide', 'Post Type Singular Name', 'ez-flickity-slider' ),
    'menu_name'           => __( 'Eazy Flickity Slider', 'ez-flickity-slider' ),
    'name_admin_bar'      => __( 'Eazy Flickity Slide', 'ez-flickity-slider' ),
    'parent_item_colon'   => __( 'Parent Item:', 'ez-flickity-slider' ),
    'all_items'           => __( 'All Slides', 'ez-flickity-slider' ),
    'add_new_item'        => __( 'Add New Slide', 'ez-flickity-slider' ),
    'add_new'             => __( 'Add New Slide', 'ez-flickity-slider' ),
    'new_item'            => __( 'New Slide', 'ez-flickity-slider' ),
    'edit_item'           => __( 'Edit Slide', 'ez-flickity-slider' ),
    'update_item'         => __( 'Update Slide', 'ez-flickity-slider' ),
    'view_item'           => __( 'View Slide', 'ez-flickity-slider' ),
    'search_items'        => __( 'Search Slides', 'ez-flickity-slider' ),
    'not_found'           => __( 'Slide Not found', 'ez-flickity-slider' ),
    'not_found_in_trash'  => __( 'Slide Not found in Trash', 'ez-flickity-slider' ),
  );
  $args = array(
    'label'               => __( 'eazy_flickity_slide', 'ez-flickity-slider' ),
    'description'         => __( 'Eazy Flickity Slide', 'ez-flickity-slider' ),
    'labels'              => $labels,
    'supports'            => array( 'title', 'thumbnail', 'editor' ),
    'hierarchical'        => false,
    'public'              => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'menu_position'       => 100,
    'show_in_admin_bar'   => true,
    'show_in_nav_menus'   => true,
    'can_export'          => true,
    'menu_position'       => 99,
    'menu_icon'           => plugin_dir_url(__FILE__) . 'css/slidericon.png',
    'has_archive'         => true,
    'exclude_from_search' => true,
    'publicly_queryable'  => true,
    'capability_type'     => 'post',
  );
  register_post_type( 'eazy_flickity_slide', $args );
}


// register custom taxonomy to be used as slider names
function eazy_flickity_slider() {
  $labels = array(
    'name'                       => _x( 'Eazy Flickity Sliders', 'Taxonomy General Name', 'ez-flickity-slider' ),
    'singular_name'              => _x( 'Eazy Flickity Slider', 'Taxonomy Singular Name', 'ez-flickity-slider' ),
    'menu_name'                  => __( 'Eazy Flickity Sliders', 'ez-flickity-slider' ),
    'all_items'                  => __( 'All Eazy Flickity Sliders', 'ez-flickity-slider' ),
    'parent_item'                => __( 'Parent Slider', 'ez-flickity-slider' ),
    'parent_item_colon'          => __( 'Parent Slider:', 'ez-flickity-slider' ),
    'new_item_name'              => __( 'New Slider Name', 'ez-flickity-slider' ),
    'add_new_item'               => __( 'Add New Slider', 'ez-flickity-slider' ),
    'edit_item'                  => __( 'Edit Slider', 'ez-flickity-slider' ),
    'update_item'                => __( 'Update Slider', 'ez-flickity-slider' ),
    'view_item'                  => __( 'View Slider', 'ez-flickity-slider' ),
    'separate_items_with_commas' => __( 'Separate items with commas', 'ez-flickity-slider' ),
    'add_or_remove_items'        => __( 'Add or remove sliders', 'ez-flickity-slider' ),
    'choose_from_most_used'      => __( 'Choose from the most used', 'ez-flickity-slider' ),
    'search_items'               => __( 'Search Sliders', 'ez-flickity-slider' ),
    'not_found'                  => __( 'Not Found', 'ez-flickity-slider' ),
  );
  $args = array(
    'labels'                     => $labels,
    'hierarchical'               => true,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => false,
  );
  register_taxonomy( 'eazy_flickity_slider', array( 'eazy_flickity_slide' ), $args );
}

}//end if eazy_flickity_slide exists
?>