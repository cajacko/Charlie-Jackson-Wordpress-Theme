<section id="featured-content" class="container-fluid">
	
	<?php
	
	$args = array( 'posts_per_page' => 4 , 'post_type' => 'featured-content', 'orderby' => 'menu_order', 'order' => 'ASC');			
	$myposts = get_posts( $args );	
	$count = 1;


	foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
				
		<article id="featured-content-<?php echo $count; ?>" class="col-xs-12 col-sm-6 col-md-4 col-lg-3 <?php charlie_jackson_featured_content_classes(); ?>">
			<a href="<?php echo get_post_meta(get_the_ID(), "featured_content_url", true); ?>">
				<div class="embed-responsive embed-responsive-4by3 featured-content-wrapper">
					<h1><?php echo $post->post_title; ?></h1>
					<?php the_post_thumbnail('width-1000', array( 'class' => 'cover-image' )); ?>
				</div>
			</a>
		</article>
		
		<?php $count++; ?>
	<?php endforeach; ?>
	
	<?php wp_reset_postdata(); ?>

</section>