<?php
/*
Plugin Name: Eazy Flickity Slider
Plugin URI: http://robjscott.com/wordpress/
Description:  Easily create slides to use with responsive sliders. Add them to page or post. Displays them using flickity.js by metafizzy.  
Version: 1.2.1
Author: Rob Scott, LLC
Author URI: http://robjscott.com
Text Domain: ez-flickity-slider
License: GPLv2 or any later version
License URI:  http://www.gnu.org/licenses/gpl-2.0.txt
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
  wp_enqueue_style('eazy-flickity-slider',  EZ_FLICKITY_ELEMENTS_URL  . 'resources/css/style.css');
  wp_enqueue_script('flickity',  EZ_FLICKITY_ELEMENTS_URL  . 'resources/js/flickity.pkgd.min.js', array('jquery'), false, true);
  wp_enqueue_script('flickity-shortcode',  EZ_FLICKITY_ELEMENTS_URL  . 'resources/js/flickity.shortcode.js', array('jquery'), false, true);
  if (is_front_page() && function_exists('eazy_flickity_slider_homepage')) {
    wp_enqueue_script('flickity-homepage',  EZ_FLICKITY_ELEMENTS_URL  . 'resources/js/flickity.homepage.js', array('jquery'), false, true);
  }
}
