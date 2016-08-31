<?php
/**
 * The template for displaying the front page.
 *
 * This is the template that displays the home page.
 *
 * @package Charlie Jackson
 */

get_header(); 

get_template_part( 'sections/banner' );

get_template_part( 'sections/featured-content' );

get_template_part( 'sections/projects' );

get_template_part( 'sections/thoughts' );

get_footer(); ?>