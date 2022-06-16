/*!
 * Flickity Shortcode v.1
 * Touch, responsive, flickable galleries
 *
 * Licensed GPLv3 for open source use
 */

// console.log("options loaded");

// Flickity options, defaults
var options = {
    autoPlay: false,
    imagesLoaded: true,
    wrapAround: true,
    pageDots: false,
    prevNextButtons: false,
    freeScroll: false,
    draggable: true,
    setGallerySize: false,
};

// enable prev/next buttons at 768px
if (matchMedia('screen and (max-width: 768px)').matches) {
    options.prevNextButtons = true;
    options.setGallerySize = false;
}
