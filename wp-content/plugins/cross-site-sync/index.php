<?php if( 'all_posts' == $_GET[ 'action' ] && $_GET[ 'secret' ] == esc_attr( get_option( 'cross_site_sync_secret' ) ) ): ?>
	
	<?php 
		$args = array(
			'posts_per_page' => -1,
			'category' => esc_attr( get_option( 'cross_site_sync_category' ) ),
			'orderby' => 'modified',
			'post_status' => 'any',
		);
		
		$posts = get_posts( $args );
		
		$posts_array = array();
		
		foreach ( $posts as $post ) : setup_postdata( $post );
		
			$posts_array[] = array(
				'ID' => get_the_ID(),
				'last_updated' => get_the_modified_time( 'Y-m-d H:i:s' ),
				'home_url' => home_url(),
			);
			
		endforeach; 
			
		wp_reset_postdata();
		
		echo json_encode( $posts_array );
	?>
	
<?php elseif( 'get_post' == $_GET[ 'action' ] && isset( $_GET[ 'id' ] ) && $_GET[ 'secret' ] == esc_attr( get_option( 'cross_site_sync_secret' ) ) ): ?>
	
	<?php 		
		$post = get_post( $_GET[ 'id' ] );

		setup_postdata( $post );
		
			if( has_category( esc_attr( get_option( 'cross_site_sync_category' ) ) ) ) {
				
				$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
		
				$posts_array = array(
					'ID' => get_the_ID(),
					'last_updated' => get_the_modified_time( 'Y-m-d H:i:s' ),
					'date' => get_the_date( 'Y-m-d H:i:s' ),
					'title' => get_the_title(),
					'content' => get_the_content(),
					'home_url' => home_url(),
					'status' => get_post_status(),
				);
				
				$post_format = get_post_format();
				
				if( $post_format ) {
					$posts_array[ 'format' ] = $post_format;
				}
				
				if( $featured_image ) {
					$posts_array[ 'featured_image' ] = $featured_image[ 0 ];
					$posts_array[ 'featured_image_width' ] = $featured_image[ 1 ];
					$posts_array[ 'featured_image_height' ] = $featured_image[ 2 ];
				}
				
				$tags = get_the_tags();
				
				if( $tags ) {
					$posts_array[ 'tags' ] = $tags;
				}
				
				$categories = get_the_category();
				
				if( $categories && esc_attr( get_option( 'cross_site_sync_include_all_categories' ) ) ==  'yes') {
					
					$final_categories = array();
					
					foreach( $categories as $category ) {
						
						if( $category->term_id != esc_attr( get_option( 'cross_site_sync_category' ) ) || esc_attr( get_option( 'cross_site_sync_include_init_category' ) ) ==  'yes' ) {
							$final_categories[] = $category;
						}
					}
					
					$posts_array[ 'categories' ] = $final_categories;
				}
				
				$gallerys = get_post_galleries_images( $post );
				
				if( $gallerys ) {
					$posts_array[ 'gallerys' ] = $gallerys;	
				}
			
			}
			
		wp_reset_postdata();
		
		echo json_encode( $posts_array );
	?>

<?php elseif( 'add_posts' == $_GET[ 'action' ] && $_GET[ 'secret' ] == esc_attr( get_option( 'cross_site_sync_secret' ) ) ): ?>

	<?php
		cross_site_sync_loop_through_websites( 1 );
		cross_site_sync_loop_through_websites( 2 );
		cross_site_sync_loop_through_websites( 3 );
	?>

<?php endif; ?>