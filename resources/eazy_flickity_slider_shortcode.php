<?php
if (function_exists('eazy_flickity_slides')) {

  //add eazy-flickity-slider shortcode 
  add_shortcode('eazy-flickity-slider', 'eazy_flickity_slider_shortcode');
  function eazy_flickity_slider_shortcode($atts)
  {

    //set attributes
    $atts = shortcode_atts(
      array(
        'post_type' => 'eazy_flickity_slide',
        'order' => '',
        'orderby' => '',
        'post_date' => '',
        'posts' => -1,
        'height' => '65%',
        'width' => '100%',
        'eazy_flickity_slider' => NULL,
      ),
      $atts
    );

    //set variables based on attributes
    $order = $atts['order'];
    $orderby = $atts['orderby'];
    $post_dateb = $atts['post_date'];
    $posts = $atts['posts'];
    $height = $atts['height'];
    $width = $atts['width'];
    $eazy_flickity_slider = $atts['eazy_flickity_slider'];
    $flickity_open = NULL;
    $flickity_close = NULL;

    //set query options
    $eazyoptions = array(
      'post_type' => 'eazy_flickity_slide',
      'order' => $order,
      'orderby' => $orderby,
      'posts_per_page' => $posts,
      'height' => $height,
      'width' => $width,
      'eazy_flickity_slider' => $eazy_flickity_slider,
    );

    // The Query
    $eazyquery = new WP_Query($eazyoptions);
    $flickity_slides = array();

    // The Loop
    if ($eazyquery->have_posts()) {
      //<div class="carousel" data-flickity='{ "imagesLoaded": true, "percentPosition": false, "wrapAround": true, "pageDots": false}'>
      //Check if slider name is set, if it is set add slider name to id
      $dataFlickity = '{ &quot;imagesLoaded&quot;: true, &quot;percentPosition&quot;: false, &quot;wrapAround&quot;: true, &quot;pageDots&quot;: false}';
      if (isset($eazy_flickity_slider)) {
        $sliderid = "slider-" . $eazy_flickity_slider . "";
        $flickity_open = '<div class="carousel flickity-shortcode" id="' . $sliderid . '" data-flickity="' . $dataFlickity . '">';
      } else {
        $flickity_open = '<div class="carousel flickity-shortcode" id="all-slides" data-flickity="' . $dataFlickity . '">';
      } //end if 

      while ($eazyquery->have_posts()) {
        $eazyquery->the_post();
        $thumb_id = get_post_thumbnail_id();
        $eazyimage_attributes = wp_get_attachment_image_src($thumb_id, 'full', true);
        $flickity_slides[] = "<div class='carousel-cell'><img class='img-overlay-image' src='" . $eazyimage_attributes[0] . "' alt='" . get_post(get_post_thumbnail_id())->post_title . "'>  <div class='overlay'><div class='text'>Hello World</div></div></div>";
      } //end while

      $flickity_close = '</div>'; //closing div from class "gallery js flickity"
    } else {
      // no slides found
    } //end query

    //restore original Post Data 
    wp_reset_postdata();

    // concatenate open, slides & close, return them as $slider
    $slider = $flickity_open;
    foreach ($flickity_slides as $key => $slide) {
      $slider .= $slide;
    }
    $slider .= $flickity_close;
    return $slider;
  }


  //add_action('wp_enqueue_scripts', 'eazy_flickity_shortcode_scripts_styles');
  function eazy_flickity_shortcode_scripts_styles()
  {
    wp_enqueue_script('eazy-flickity-shortcode-extra', EZ_FLICKITY_ELEMENTS_URL  . 'resources/js/flickity.shortcode.dimensions.js', array(), false, true);

    global $wp_query;
    $posts = $wp_query->posts;
    $pattern = get_shortcode_regex();
    $matches = NULL;


    foreach ($posts as $post) {
      if (
        preg_match_all('/' . $pattern . '/s', $post->post_content, $matches)
        && array_key_exists(2, $matches)
        && in_array('eazy-flickity-slider', $matches[2])
      ) {
        foreach ($matches[0] as $key => $value) {
          $matches[$key] = $value;

          $eznameflag = '~eazy_flickity_slider="(.*?)"~';
          $ezwidthflag = '~width="(.*?)"~';
          $ezheightflag = '~height="(.*?)"~';
          $thiswidth = '';
          $thisheight = '';

          if (preg_match($eznameflag, $value, $m)) {
            $thisname = $m[1];
            //$matches[$key] .= ['sliderid' => $thisname];
          }
          if (preg_match($ezwidthflag, $value, $m)) {
            $thiswidth = $m[1];
            //$matches[$key] .= ['width' => $thiswidth];
          }
          if (preg_match($ezheightflag, $value, $m)) {
            $thisheight = $m[1];
            //$matches[$key] .= ['height' => $thisheight];
          }

          $matches[$key] = ['sliderid' => $thisname, 'width' => $thiswidth, 'height' => $thisheight];
        }
        break;
      } //end if preg match
    } //end foreach
    if ($matches !== NULL) {
      wp_localize_script('eazy-flickity-shortcode-extra', 'eazyoptions', $matches);
    }
  }
}
