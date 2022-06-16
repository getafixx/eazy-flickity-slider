/*!
 * Eazy Flickity Slider TinyMCE
 * Licensed GPLv3 for open source use
 */

var getEazySliders = function () {
  for (var key in allsliders) {
    if (allsliders.hasOwnProperty(key)) {
      // console.log("{text:'" + key + "', value:'" + allsliders[key] + "'}");
      tinymce.PluginManager.add('slider', allsliders[key]);
    }
  }
};


tinymce.PluginManager.add('eazy_flickity_tinymce_button', function (editor, url) {
  editor.addButton('eazy_flickity_tinymce_button', {
    title: 'Eazy Flickity Slider',
    icon: 'icon eazy-flickity-slider-icon',
    onclick: function () {
      var val;
      win = editor.windowManager.open({
        title: 'Add Slider',
        body: [{
          type: 'textbox',
          name: 'width',
          label: 'Width'
        }, {
          type: 'textbox',
          name: 'height',
          label: 'Height'
        }, {
          type: 'listbox',
          name: 'slider',
          text: '-select-',
          value: '',
          label: 'Slider',
          values: [{
            allsliders
          }]
        }],

      });
    }
  });
});

getEazySliders();
