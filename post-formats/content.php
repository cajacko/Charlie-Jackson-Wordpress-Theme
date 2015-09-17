<article class="new-article">
	<div class="article-container">
		
		<?php $cross_site_sync_url = charliejackson_cross_site_sync_url(); ?>
		
		<a class="anchor" id="post-<?php the_ID(); ?>"></a>
		
		<header class="clearfix">
			
			<?php if(has_post_thumbnail()): ?>
			
				<?php the_post_thumbnail('inline-image', array('class' => 'post-featured-image')); ?>
				
			<?php endif; ?>
			
			<div class="header-title wrap">

				<h2><?php charliejackson_the_title(); ?></h2>
				
				<?php if( $cross_site_sync_url ): ?>
					
					<small><a target="_blank" href="<?php echo $cross_site_sync_url; ?>">Originally published on <?php
						
						$website = esc_attr( get_option( 'cross_site_sync_website' ) );
						
						echo str_replace( 'http://', '', $website );
						 
					?></a></small>
					
				<?php endif; ?>
				
			</div>
		</header>
		
		<section class="post-body wrap">
			
			<?php echo charliejackson_get_the_content_with_formatting(); ?>
			
		</section>
		
		<?php get_template_part( 'sections/post-footer' ); ?>
	</div>
</article>