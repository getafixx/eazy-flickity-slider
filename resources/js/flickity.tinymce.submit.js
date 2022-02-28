/*!
 * Eazy Flickity TINYMCE Submit
 * Licensed GPLv3 for open source use
 */
//This is run once a user clicks the submit button  
    function insert_eazy_flickity_slider_shortcode() {
      //set variables for width, height & #eazy_slider_name_select
      var eazy_slider_width = jQuery("#form_width").val();
      var eazy_slider_width_display = !eazy_slider_width ? "" : " rel=\"" + eazy_slider_width + "\"";
      var eazy_slider_height = jQuery("#form_height").val();
      var eazy_slider_height_display = !eazy_slider_height ? "" : " rel=\"" + eazy_slider_height + "\"";
      var form_shortcode = jQuery("#eazy_slider_name_select").val();
      if (form_shortcode === "") {
        alert("Please select a slider to use");
        return;
      }

      if (form_shortcode !== "") {
        //add shortcode to editor
        window.send_to_editor("[eazy-flickity-slider eazy_flickity_slider=\"" + form_shortcode + "\" width=\"" + eazy_slider_width + "\" height=\"" + eazy_slider_height + "\"]");
      }

    }