<header class="post-header">

	<?php 
	if(has_post_thumbnail()) {
		the_post_thumbnail('width-1000');
	}	
	?>
	
	<div class="post-title bg-info">
	
		<?php
		
		if ( is_single() ) :
			the_title( '<h1>', '</h1>' );
		else :
			the_title( sprintf( '<h1><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' );
		endif;
		?>
	
	</div>

</header>

<div class="post-content">
			
	<?php the_content('Read more...'); ?>

</div>