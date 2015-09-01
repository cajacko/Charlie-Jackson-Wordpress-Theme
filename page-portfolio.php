<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Charlie Jackson
 */

	get_header(); ?>
		
		<section id="post-loop">
			<div id="portfolio-nav" class="display-table">
				<div class="display-table-row">
					<a class="display-table-cell<?php if($_GET['portfolio'] != 'web' &&  $_GET['portfolio'] != 'design'): echo ' active-portfolio'; endif; ?>" href="<?php echo home_url(); ?>/portfolio">All Projects</a>
					<a id="portfolio-nav-middle" class="display-table-cell<?php if($_GET['portfolio'] == 'web'): echo ' active-portfolio'; endif; ?>" href="<?php echo home_url(); ?>/portfolio/?portfolio=web">Web Portfolio</a>
					<a class="display-table-cell<?php if($_GET['portfolio'] == 'design'): echo ' active-portfolio'; endif; ?>" href="<?php echo home_url(); ?>/portfolio/?portfolio=design">Product Design Portfolio</a>
				</div>
			</div>
		
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
					<div class="article-container">
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
					</div>
				</article> 
		
			<?php endforeach; ?>
			
		</section>

		<section id="sidebar" class="absolute-sidebar portfolio-sidebar">
			<div id="sidebar-container">
				<h1>Portfolio</h1>
				<ul>
					<li><a class="portfolio-link" href="#top-of-page">Top of page</a></li>
					<?php 
					$count = 0;
					foreach ( $posts as $post ) : setup_postdata($post); ?>
						<li id="nav-post-<?php the_ID(); ?>"<?php if($count == 0): echo ' class="active-portfolio-item"'; endif; ?>><a class="portfolio-link" href="#post-<?php the_ID(); ?>"><?php the_title(); ?></a></li>
						<?php $count++; ?>
					<?php endforeach; ?>
				</ul>
			</div>
		</section>			
	
	<?php get_footer(); ?>
