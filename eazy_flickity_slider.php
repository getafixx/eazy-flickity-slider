<?php
/*
Plugin Name: Rob Cross Eazy Flickity Slider
Plugin URI: https://justin-king.com
Description:  Easily create slides to use with responsive sliders. Add them to page or post. Displays them using flickity.js by metafizzy.  
Version: 2.0.1
Author: Rob Scott, LLC, and Justin King
Author URI: https://justin-king.com
Text Domain: ez-flickity-slider
License: GPLv3 or any later version
License URI:  http://www.gnu.org/licenses/quick-guide-gplv3.html
*/

// If this file is called directly, abort.
if (!defined('WPINC')) {
  die;
}

//define plugin path
define('EZ_FLICKITY_ELEMENTS_PATH', plugin_dir_path(__FILE__));
define('EZ_FLICKITY_ELEMENTS_FILE_PATH', __FILE__);
define('EZ_FLICKITY_ELEMENTS_URL', str_replace('index.php', '', plugins_url('index.php', __FILE__)));

//add functions
require_once(EZ_FLICKITY_ELEMENTS_PATH . 'resources/eazy_flickity_slider_functions.php');
require_once(EZ_FLICKITY_ELEMENTS_PATH . 'resources/eazy_flickity_slider_admin.php');
require_once(EZ_FLICKITY_ELEMENTS_PATH . 'resources/eazy_flickity_slider_admin_tinymce.php');
require_once(EZ_FLICKITY_ELEMENTS_PATH . 'resources/eazy_flickity_slider_homepage.php');
require_once(EZ_FLICKITY_ELEMENTS_PATH . 'resources/eazy_flickity_slider_shortcode.php');

//add css & js
add_action('wp_enqueue_scripts', 'eazy_flickity_scripts_styles');
function eazy_flickity_scripts_styles()
{
  wp_enqueue_style('eazy-flickity-slider-style',  EZ_FLICKITY_ELEMENTS_URL  . 'resources/css/flickity.css');

  #wp_enqueue_script('flickity',  EZ_FLICKITY_ELEMENTS_URL  . 'resources/js/flickity.pkgd.min.js', array('jquery'), false, true);
  wp_enqueue_script('flickity',  EZ_FLICKITY_ELEMENTS_URL  . 'resources/js/flickity.pkgd.js', array('jquery'), false, true);

  wp_enqueue_script('flickity-next-prev',  EZ_FLICKITY_ELEMENTS_URL  . 'resources/js/flickity.add_prev_next.js', array('jquery'), false, true);

  wp_enqueue_script('flickity-options',  EZ_FLICKITY_ELEMENTS_URL  . 'resources/js/flickity.options.js', array('jquery'), false, true);

  if (is_front_page() && function_exists('eazy_flickity_slider_homepage')) {
    wp_enqueue_script('flickity-homepage',  EZ_FLICKITY_ELEMENTS_URL  . 'resources/js/flickity.homepage.js', array('jquery'), false, true);
  } else {
    wp_enqueue_script('flickity-homepage',  EZ_FLICKITY_ELEMENTS_URL  . 'resources/js/flickity.page.js', array('jquery'), false, true);
  }
}


function eazy_flickity_slider_add_local_field_groups()
{

  if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group(array(
      'key' => 'group_62456cbcc7c1e',
      'title' => 'Slider Image Link',
      'fields' => array(
        array(
          'key' => 'field_62456cee3df89',
          'label' => 'slider post url',
          'name' => 'slider_post_url',
          'type' => 'url',
          'instructions' => 'This is the link that on the front page slider image will link to via the overlay text',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array(
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'default_value' => '',
          'placeholder' => '',
        ),
      ),
      'location' => array(
        array(
          array(
            'param' => 'post_type',
            'operator' => '==',
            'value' => 'eazy_flickity_slide',
          ),
        ),
      ),
      'menu_order' => 0,
      'position' => 'normal',
      'style' => 'default',
      'label_placement' => 'top',
      'instruction_placement' => 'label',
      'hide_on_screen' => '',
      'active' => true,
      'description' => '',
      'show_in_rest' => 0,
    ));
  }
}

add_action('acf/init', 'eazy_flickity_slider_add_local_field_groups');
