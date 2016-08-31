<?php
/**
 * The template for displaying the front page.
 *
 * This is the template that displays the home page.
 *
 * @package Charlie Jackson
 */

get_header(); 	
		
while ( have_posts() ) : the_post();

	get_template_part( 'sections/thought');

endwhile; 

get_template_part( 'sections/sidebar'); 

get_footer(); ?>