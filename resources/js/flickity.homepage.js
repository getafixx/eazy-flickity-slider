/*!
 * Flickity Homepage v.1
 * Touch, responsive, flickable galleries
 *
 * Licensed GPLv3 for open source use
 */

function updateFlickityHomepageSliders() {
    var $slider1 = jQuery('#slider-home-page-1').flickity(options);
    var $slider2 = jQuery('#slider-home-page-2').flickity(options);

}

jQuery(window).on('resize', function () {
    // console.log("resize")
    updateFlickityHomepageSliders()
});


jQuery(document).ready(function () {
    // console.log("ready")
    updateFlickityHomepageSliders()

});
