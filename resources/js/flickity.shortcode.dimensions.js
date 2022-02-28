/*!
 * Current Sliders v.1
 * Touch, responsive, flickable galleries
 *
 * Licensed GPLv3 for open source use
 */

if (eazyoptions !== null) {
  var changeSliderSize = document.getElementById('slider-' + eazyoptions[0].sliderid);
  if (typeof eazyoptions[0]['width'] !== 'undefined') {
    changeSliderSize.style.maxWidth = eazyoptions[0].width;
  }
  if (typeof eazyoptions[0]['height'] !== 'undefined') {
    changeSliderSize.style.maxHeight = eazyoptions[0].height;
  }
}
