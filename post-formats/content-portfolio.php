<article class="new-article">
	<div class="article-container">
		<a class="anchor" id="post-<?php the_ID(); ?>"></a>
		
		<header class="clearfix">
			
			<?php 
				/**
				 * Get the portfolio image for the page
				 */
				if (class_exists('MultiPostThumbnails')) {
				    MultiPostThumbnails::the_post_thumbnail(
				        get_post_type(),
				        'portfolio-image',
				        $post->ID,
				        'inline-image',
				        '',
				        true
				    );
				}
			?>
			
			<div class="header-title wrap">
				<h2>
					<?php if(get_the_content() != "") : ?>
					
						<a href="<?php echo get_permalink( ); ?>"><?php the_title(); ?></a>
						
					<?php else: ?>
					
						<?php the_title(); ?>
						
					<?php endif; ?>
				</h2>
			</div>
		</header>
		
		<section class="post-body wrap">
			
			<?php echo apply_filters('the_content', get_post_meta( get_the_ID(), 'portfolio_content', true )); ?>
			
			<?php if(get_the_content() != "") : ?>
			
				<p>
					<a href="<?php echo get_permalink( ); ?>">See more details about this project</a>
				</p>
				
			<?php endif; ?>
		</section>
		
		<?php get_template_part( 'sections/post-footer' ); ?>	
	</div>
</article>