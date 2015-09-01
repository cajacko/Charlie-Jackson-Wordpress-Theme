<?php
	if ( have_posts() ) : 
		while ( have_posts() ) : the_post(); 
			
			get_template_part('sections/post'); 
	
		endwhile; 
		
		?>
		
		<?php if(get_next_posts_link()): ?>
			<div class="next-page-link">
				<?php next_posts_link(); ?>
			</div>
			<img class="loading-img" src="<?php echo get_template_directory_uri(); ?>/inc/media/loading-posts.gif">
		<?php elseif(!is_single() && !is_page()): ?>
			<div id="no-more-posts" class="alert alert-warning" role="alert">That's all folks, there are no more posts.</div>
		<?php endif; ?>
	
	<?php else : 
	
	endif;
?>