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
			);
			
			$tax_query = array(
				array(
					'taxonomy' => 'project-categories',
					'field'    => 'slug',
					'terms'    => 'portfolio',
				),
			);
			
			if($_GET['portfolio'] == 'web') {
				$tax_query['relation'] = 'AND';
				$tax_query[] = array(
					'taxonomy' => 'project-categories',
					'field'    => 'slug',
					'terms'    => 'web-design',
				);
			} elseif($_GET['portfolio'] == 'design') {
				$tax_query['relation'] = 'AND';
				$tax_query[] = array(
					'taxonomy' => 'project-categories',
					'field'    => 'slug',
					'terms'    => 'design',
				);
			}
			
			$args['tax_query'] = $tax_query;
			
			$posts = get_posts($args);
			foreach ( $posts as $post ) : setup_postdata($post); ?>
				
				<article class="new-article">
					<a class="anchor" id="post-<?php the_ID(); ?>"></a>
					
					<header class="clearfix">
						<?php if (class_exists('MultiPostThumbnails')) :
						    MultiPostThumbnails::the_post_thumbnail(
						        get_post_type(),
						        'portfolio-image',
						        $post->ID,
						        'inline-image',
						        '',
						        true
						    );
						endif; ?>
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
					
					<footer>
						<div class="wrap">
							<span class="post-date"><?php the_date(); ?></span>
						</div>
					</footer>	
				</article> 
		
			<?php endforeach; ?>
			
		</section>			
	
	<?php get_footer(); ?>
