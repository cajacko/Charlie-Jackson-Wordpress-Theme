<?php
/**
 * Template Name: Data
 */
 
	global $post;
	
	$args = array(
		'posts_per_page' => get_option('posts_per_page'),
	);
	
	$page = $_GET['page_number'];
	
	$args['paged'] = $page;
	
	$myposts = get_posts($args);
	
	if(!empty($myposts)): ?>
	
		<div class="post-page" data-page="<?php echo $page; ?>">
	
			<?php foreach( $myposts as $post ): setup_postdata($post); 
				get_template_part('sections/post');
			endforeach; 
			
			wp_reset_postdata(); ?>
			
		</div>
		
	<?php else: ?>
	
		<span id="no-more-posts">That's all folks, no more posts to load.</span>
		
	<?php endif;
	
?>