<?php
/**
 * Template Name: Data
 */

if($_GET['type'] == 'thought'):
	
	$args = array(
		'posts_per_page'   => 10,
		'offset'           => $_GET['offset'],
		'post_type'        => 'post',
		'post_status'      => 'publish'
	);
	
	$posts_array = get_posts( $args );
	
	foreach($posts_array as $post): setup_postdata( $post );
	
		get_template_part( 'sections/thought');
		
	endforeach;
	
endif;
?>