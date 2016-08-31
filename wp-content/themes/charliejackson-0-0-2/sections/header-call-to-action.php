<aside id="call-to-action">

	<?php
	
		$args = array( 'posts_per_page' => -1 , 'post_type' => 'cta');
		
		$myposts = get_posts( $args );
	
		foreach ( $myposts as $post ) : setup_postdata( $post );
							
			//the_content();

			echo $post->post_content;
			
		endforeach; 
		
		wp_reset_postdata();
	
	?>
	
</aside>