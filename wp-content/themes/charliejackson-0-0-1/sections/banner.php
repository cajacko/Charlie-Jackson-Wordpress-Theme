<section id="home-banner" class="carousel slide" data-ride="carousel" data-pause="" data-interval="4000" role="banner">
	
	<ol class="carousel-indicators">
		<?php
		
		$args = array( 'posts_per_page' => -1 , 'post_type' => 'banner', 'orderby' => 'menu_order', 'order' => 'ASC');			
		$myposts = get_posts( $args );	
		$number_of_items = count($myposts);
				
		$banner_count = 0;
		$indicator_count = 0;
		
		while($indicator_count < $number_of_items): ?>
		
			<li data-target="#home-banner" data-slide-to="<?php echo $indicator_count; ?>" <?php if($indicator_count == 0) { echo "class='active'"; } ?>></li>
			<?php $indicator_count++; ?>
			
		<?php endwhile; ?>
	</ol>

	
	<div class="carousel-inner" role="listbox">
	
		<?php foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
					
			<div class="item <?php charlie_jackson_banner_classes($banner_count); ?>">
				
				<?php the_post_thumbnail('width-2500', array( 'class' => 'cover-image' )); ?>
				
				<div class="carousel-caption">
					<div class="carousel-caption-wrapper">
				
						<h1><?php echo $post->post_title; ?></h1>
						<?php echo $post->post_content; ?>
					</div>
					
				</div>
				
			</div>
		
			<?php $banner_count++; ?>
			
		<?php endforeach; ?>
		
		<?php wp_reset_postdata(); ?>
		
	</div>

	
	<a class="left carousel-control" href="#home-banner" role="button" data-slide="prev">
	
		<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
		<span class="sr-only">Previous</span>
		
	</a>
	
	<a class="right carousel-control" href="#home-banner" role="button" data-slide="next">
	
		<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
		<span class="sr-only">Next</span>
		
	</a>
</section>