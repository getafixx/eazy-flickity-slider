<?php
if (function_exists('eazy_flickity_slides')) {
function eazy_flickity_slider_homepage() {

	$args = array( 'post_type' => 'eazy_flickity_slide', 'eazy_flickity_slider' => 'homepage' );
	// The Query
	$the_query = new WP_Query( $args );

	// The Loop
	if ( $the_query->have_posts() ) {

		echo '<div class="eazy-flickity-homepage-slider">';
		while ( $the_query->have_posts() ) {
			$the_query->the_post();?>
	            <div class="gallery-cell">         
	                <?php the_post_thumbnail('full' ); ?>
	            </div>
	    <?php
		}
		echo '</div>'; ?>

	<?php } else {
		// no posts found
	} //end if query 

/* Restore original Post Data */
wp_reset_postdata();  
}
}