# Eazy Flickity Slider
##Description
Eazy Flickity Slider is a WordPress plugin. Eazy Flickity Slider lets create responsive sliders, without being overly complex. Adding slides is as easy as adding a post. Creating a slider works like adding a post to a category. You can then use a shortcode to get the slider to display on your site. There is a shortcode generator that shows up next to the add media button on the edit post & edit page sections of the admin. The plugin uses flickity.js by Metafizzy to animate the slider. 

##License
License: GPLv2 or any later version
License URI: http://www.gnu.org/licenses/gpl-2.0.txt

##Installation
1. Add plugin 
2. Activate plugin
3. Navigate to Eazy Flickity Slider section of admin
4. Add a new slide, just like adding a post. Use the featured image to add the slide image. 
5. You can group your slides into sliders, like categories on posts.
7. Add your slider using the Flickity Slider button above the editor or use [eazy-flickity-slider  eazy_flickity_slider=\"YOUR-SLIDER-NAME\"]

##Frequently Asked Questions 
**How do add a slider?**  
Click on the 'Add New Slide' item under the Eazy Flickity Slider section in your admin. You can add the slider image like you would a post; Give it a title, then navigate to the Eazy Flickity Slider box on the right and either add it to an existing slider or click on add new slider and add one. Add the image using the Add Eazy Flickity Slide Image box below the Eazy Flickity Sliders box. 
  
**How do I set the size of the slider?**  
If you are using the Flickity Slider button, it will ask you for a width and height. It is important to set the unit of measure you are using. (i.e. px, em, %, vw etc.)
If you are adding your own shortcode you should pass height & width arguments. [eazy-flickity-slider height="100px" width="100px"] 
  
**How do I set the movement of the slider?**  
Unfortunately, there are not currently any controls for the slider built into the plugin. You would need to edit eazy-flickity-slider/resources/js/flickity.shortcode.js. You can change these settings using the settings defined by Metafizzy for the flickity.js libray.  

##WordPress Requirements
Requires at least: 4.5  
Tested up to: 5.9.1  

##Changelog
= 1.0 =  
First version


##Screenshots  
Eazy Flickity Slider main screen.
![screenshot-1](https://cloud.githubusercontent.com/assets/6818209/15063482/3e3f2e80-1310-11e6-9409-6ed0ec8ac324.jpg)
  
Add a slide. Include title & add slider using Eazy Flickity Sliders box.
![screenshot-2](https://cloud.githubusercontent.com/assets/6818209/15063484/3e47b7da-1310-11e6-8259-819d781227a3.jpg)
  
Click add featured image to include slide image using media library.  
![screenshot-3](https://cloud.githubusercontent.com/assets/6818209/15063485/3e4c5e52-1310-11e6-8c74-5844ffde36dc.jpg)
  
Shows a slide completed. (includes title, slider category & image)
![screenshot-4](https://cloud.githubusercontent.com/assets/6818209/15063478/3e3a5856-1310-11e6-9fed-8ea80f25f680.jpg)
  
Add a slider using the Flickity Slider button next to the Media Library button.
![screenshot-5](https://cloud.githubusercontent.com/assets/6818209/15063479/3e3e0cf8-1310-11e6-8737-5f54e948aa62.jpg)
  
Select your slider from the drop down menu and add the size.
![screenshot-6](https://cloud.githubusercontent.com/assets/6818209/15063480/3e3ea44c-1310-11e6-9c7c-db2715b36f98.jpg)
  
Shows shortcode added to editor. 
![screenshot-7](https://cloud.githubusercontent.com/assets/6818209/15063481/3e3f07e8-1310-11e6-9135-15f285f65a97.jpg)
  
Slider appears via WordPress magic.
![screenshot-8](https://cloud.githubusercontent.com/assets/6818209/15063483/3e3f89de-1310-11e6-8e2e-f6fb5c42a236.jpg)
