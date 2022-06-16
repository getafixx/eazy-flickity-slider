Flickity.createMethods.push("_createPrevNextCells");

Flickity.prototype._createPrevNextCells = function () {

    this.on("select", this.setPrevNextCells);
};

/**
 * Justin King <getafixx149@gmail.com> fixed this function
 * 23/03/2022
 */
Flickity.prototype.setPrevNextCells = function () {

    update_image_scale();

}


// This function does the scaling of the images if we use long not HD images
function update_image_scale() {

    //if (jQuery(".flickity-overlay").length == 0) {

    const vw = Math.max(
        document.documentElement.clientWidth || 0,
        window.innerWidth || 0
    );
    const vh = Math.max(
        document.documentElement.clientHeight || 0,
        window.innerHeight || 0
    );

    var ratio = vw / vh;
    var diff = vw - vh;
    var x = ratio * diff;
    var scale = 62
    if (x < 1370) {
        scale =
            31.09219 +
            (0.03215774 * x) -
            (0.00001121765 * Math.pow(x, 2)) -
            (5.113017e-8 * Math.pow(x, 3)) +
            (7.276599e-11 * Math.pow(x, 4)) -
            (2.467344e-14 * Math.pow(x, 5));
    }

    //console.log("update_image_scale ratio " + ratio + " diff " + diff + " x " + x + " scale " + scale);

    /* if (scale > 62) {
        scale = 62;
    } */
    /*   else if (scale < 60) {
          scale = 60;
      } */


    var carousel = scale + 1
    var carousel_height = scale - 2
    var flex = scale

    //console.log("update_image_scale innerWidth " + vw + " innerHeight " + vh + " scale " + scale);
    //jQuery(".flex-main").css({ height: "calc(" + flex + "vh)" });
    //jQuery(".carousel").css({ "max-height": "calc(" + carousel + "vh)" });
    jQuery(".carousel").css({ "height": "calc(" + carousel + "vh)" });
    jQuery(".carousel img").css({ "height": "calc(" + flex + "vh)" });
    //jQuery(".carousel-cell").css({ height: "calc(" + carousel + "vh)" });
    //jQuery(".img-overlay-image").css({ "max-height": "calc(" + scale + "vh)" });

    // }
}

function changeSlideClasses(slide, method, className) {
    if (!slide) {
        return;
    }
    slide.getCellElements().forEach(function (cellElem) {
        cellElem.classList[method](className);
    });
}

/**
 * Justin King <getafixx149@gmail.com> added this function
 *
 * This is custom implementation for the above code to ONLY alow
 * 23/03/2022
 */

Flickity.createMethods.push("_createStaticClick");

Flickity.prototype._createStaticClick = function () {
    this.on("staticClick", this.doStaticClick);
};

Flickity.prototype.doStaticClick = function (event, pointer) {
    // get clickedCell, if cell was clicked
    var clickedCell = this.getParentCell(event.target);
    var cellElem = clickedCell && clickedCell.element;
    var cellIndex = clickedCell && this.cells.indexOf(clickedCell);

    // dismiss if cell was not clicked
    if (!cellElem) {
        return;
    }
    // console.log('Cell ' + (cellIndex) + ' clicked');

    if (jQuery(cellElem).hasClass("is-selected")) {
        if (jQuery(cellElem).data().hasOwnProperty("link")) {
            var link = jQuery(cellElem).data("link");

            if (is_touch_device()) {
                // console.log("is_touch_device");

                if (jQuery(cellElem).hasClass("overlay-shown")) {
                    // console.log("Selected Click -> " + link);

                    window.location = link;
                } else {
                    changeSlideClasses(this.slides[cellIndex], "add", "overlay-shown");
                }

                //this.selectCell(cellIndex);
            } else {
                // normal non mobile view

                // console.log("Selected Click -> " + link);

                window.location = link;
            }
        } else {
            console.log("page click no limk ");
        }
    } else {
        if (jQuery(cellElem).hasClass("is-next")) {
            // console.log("next Clicked" + cellIndex);
            this.selectCell(cellIndex);
        } else if (jQuery(cellElem).hasClass("is-previous")) {
            // console.log("previous Clicked " + cellIndex);
            this.selectCell(cellIndex);
        }
    }
};

function is_touch_device() {
    var isTouchDevice =
        "ontouchstart" in window ||
        navigator.maxTouchPoints > 0 ||
        navigator.msMaxTouchPoints > 0;

    return isTouchDevice;
}
