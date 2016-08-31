<header class="post-header">

	<?php charlie_jackson_the_gallery(); ?>
	
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
			
	<?php charlie_jackson_the_gallery_content(); ?>

</div>