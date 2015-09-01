<?php
/**
 * The Projects Page Template.
 *
 * @package Charlie Jackson
 */

	get_header(); ?>
		
		<section id="projects-loop">
		
			<?php
			
			$args = array(
				'post_type' => 'page',
				'posts_per_page' => -1,
				'orderby' => 'menu_order',
				'order' => 'ASC',
				'post_parent' => get_page_by_title('Projects')->ID,
			);
			
			$posts = get_posts($args);
			foreach ( $posts as $post ) : setup_postdata($post); ?>
				
				<article class="new-article">
					<div class="article-container">
						<a class="anchor" id="post-<?php the_ID(); ?>"></a>
						
						<header class="clearfix">
							<?php 
							$image_info = wp_get_attachment_image_src( get_post_thumbnail_id(), 'inline-image' );
							
							if(has_post_thumbnail() && $image_info[2] && $image_info[1]): ?>
								<?php $percentage = ($image_info[2] / $image_info[1]) * 100; ?>
								<div class="embed-responsive" style="padding-bottom: <?php echo $percentage; ?>%;">
									<div class="embed-responsive-item"><?php the_post_thumbnail('inline-image', array('class' => 'post-featured-image')); ?></div>
								</div>
							<?php endif; ?>
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
							<?php echo apply_filters('the_content', get_the_excerpt()); ?>
						</section>
						
						<footer>
							<div class="wrap">
								<span class="post-date"><?php the_date(); ?></span>
							</div>
						</footer>
					</div>	
				</article> 
		
			<?php endforeach; ?>
			
		</section>			
	
	<?php get_footer(); ?>
