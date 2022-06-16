/*!
 * Flickity Shortcode v.1
 * Touch, responsive, flickable galleries
 *
 * Licensed GPLv3 for open source use
 */

// console.log("loaded");

// Flickity options, defaults
var options = {
    autoPlay: false,
    imagesLoaded: true,
    wrapAround: true,
    pageDots: false,
    prevNextButtons: false,
    freeScroll: false,
    draggable: true,
};

// enable prev/next buttons at 768px
if (matchMedia('screen and (max-width: 768px)').matches) {
    options.prevNextButtons = true;
    options.pageDots = true;
}


var $carousel = jQuery('.flickity-shortcode').flickity(options);



// bind event listener first
$carousel.on('ready.flickity', function () {
    // console.log('Flickity ready');
    recalculateNextPrevious($carousel)
});

$carousel.on('change.flickity', function (event, index) {
    // console.log('Slide changed to ' + index)
    recalculateNextPrevious($carousel)
});

$carousel.on('staticClick.flickity', function (event, pointer, cellElement, cellIndex) {
    // dismiss if cell was not clicked
    if (!cellElement) {
        return;
    }

    // console.log('Cell ' + (cellIndex) + ' clicked');
    if (jQuery(cellElement).hasClass('is-selected')) {
        if (jQuery(cellElement).data().hasOwnProperty("link")) {

            var link = jQuery(cellElement).data("link");

            // console.log("Selected Click -> " + link);
            window.location = link
        }
        else {

            // console.log("page click no limk ");
        }
    }
    else {
        $carousel.flickity('select', cellIndex);
        recalculateNextPrevious($carousel);
    }
});

// initialize Flickity
$carousel.flickity();
recalculateNextPrevious($carousel);



function recalculateNextPrevious($carousel) {

    // console.log("recalculateNextPrevious");

    var flkty = $carousel.data('flickity')

    jQuery('.carousel-cell').removeClass("is-previous");
    jQuery('.carousel-cell').removeClass("is-next");

    var selectedIndex, prevNum, nextNum, totalLength;

    selectedIndex = flkty.selectedIndex;
    totalLength = flkty.slides.length;

    // console.log('carousel at ' + selectedIndex)

    if (selectedIndex == 0) {
        prevNum = totalLength - 1
    }
    else {
        prevNum = selectedIndex - 1
    }

    if (selectedIndex == (totalLength - 1)) {
        nextNum = 0
    }
    else {
        nextNum = selectedIndex + 1;
    }

    /* 
    previousSlide = slides[prevNum];
    nextSlide = slides[nextNum];
     */
    // console.log(" Total length " + totalLength + "selected " + selectedIndex)
    // console.log("Next  -> " + nextNum + " Prev " + prevNum)
    // console.log(totalLength + " " + selectedIndex + " " + nextNum + " " + prevNum)

    jQuery('#sliderid-' + nextNum).addClass("is-next");
    jQuery('#sliderid-' + prevNum).addClass("is-previous");
}
