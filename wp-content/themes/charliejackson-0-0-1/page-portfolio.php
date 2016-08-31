<?php
/**
 * The template for displaying the front page.
 *
 * This is the template that displays the home page.
 *
 * @package Charlie Jackson
 */

get_header(); ?>

<section id="portfolio" class="container">

	<?php 
	
	$args = array( 
			'posts_per_page' => -1 , 
			'post_type' => 'page', 
			'post_parent' => $parent_page,
			'orderby' => 'menu_order',
			'order' => 'ASC',
			'tax_query' => array(
				array(
					'taxonomy' => 'project-categories',
					'field'    => 'slug',
					'terms'    => 'portfolio',
				),
			),
	);			
	$myposts = get_posts( $args );	
	
	?>
			
	<header id="portfolio-header" class="affix-top">
		<nav>
			<ul>
				<li><a href="#site-header">Top of Page</a></li>
				<?php foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
				
					<li id="li-portfolio-<?php the_slug(); ?>"><a href="#portfolio-<?php the_slug(); ?>"><?php the_title(); ?></a></li>
				
				<?php endforeach; ?>
			
				<?php wp_reset_postdata(); ?>
			</ul>
		</nav>
	</header>
	
	<div id="portfolio-content" class="content">	

			<?php foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
			
				<article id="portfolio-<?php the_slug(); ?>" class="portfolio-article">
			
					<h1><?php the_title(); ?></h1>
					
					<div class="article-img">
						<?php if (class_exists('MultiPostThumbnails')) :
						    MultiPostThumbnails::the_post_thumbnail(
						        get_post_type(),
						        'portfolio-image',
						        $post->ID,
						        'width-1000',
						        '',
						        true
						    );
						endif; ?>
					</div>
					
					<?php if(get_post_meta( get_the_ID(), 'portfolio_content', true ) != "") : ?>
					
						<div class="article-content">
							<?php echo apply_filters('the_content', get_post_meta( get_the_ID(), 'portfolio_content', true )); ?>
						</div>
					
					<?php endif; ?>
					
					<?php if(get_the_content() != "") : ?>
						<footer>
							<a href="<?php echo get_permalink( ); ?>">See more details about this project</a>
						</footer>
					<?php endif; ?>
				
				</article>
				
			<?php endforeach; ?>
			
			<?php wp_reset_postdata(); ?>
	</div>
</section>

<?php get_footer(); ?>