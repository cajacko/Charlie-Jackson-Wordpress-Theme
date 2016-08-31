<?php
/**
 * @package cross_site_sync
 * @version 0.4
 */
/*
Plugin Name: Cross Site Sync
Plugin URI: http://github.com/cajacko/
Description: Allows you to sync certain posts with other WordPress sites you may have
Author: Charlie Jackson
Version: 0.4
Author URI: http://charliejackson.com
*/

define( 'CROSS_SITE_SYNC__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );


/* -----------------------------
ACTIVATE SYNC ON SAVE POST
----------------------------- */
	function cross_site_sync_trigger_script( $post_id ) {
		$website = esc_attr( get_option( 'cross_site_sync_website_1' ) );
		
		if( strlen( $website ) > 4 ) {
			$url = $website . 'cross-site-sync/?action=add_posts&secret=' . esc_attr( get_option( 'cross_site_sync_secret' ) );
			file_get_contents( $url );
		}
		
		$website = esc_attr( get_option( 'cross_site_sync_website_2' ) );
		
		if( strlen( $website ) > 4 ) {
			$url = $website . 'cross-site-sync/?action=add_posts&secret=' . esc_attr( get_option( 'cross_site_sync_secret' ) );
			file_get_contents( $url );
		}
		
		$website = esc_attr( get_option( 'cross_site_sync_website_3' ) );
		
		if( strlen( $website ) > 4 ) {
			$url = $website . 'cross-site-sync/?action=add_posts&secret=' . esc_attr( get_option( 'cross_site_sync_secret' ) );
			file_get_contents( $url );
		}
	}
	
	if( esc_attr( get_option( 'cross_site_sync_push_or_pull' ) ) == 'push' ) {
		add_action( 'save_post', 'cross_site_sync_trigger_script' );
	}

/* -----------------------------
REGISTER TAX
----------------------------- */
	function cross_site_sync_taxonomy() {
		register_taxonomy(
			'cross-site-sync',
			'post',
			array(
				'label' => __( 'Cross Site Sync' ),
			)
		);
	}
	
	add_action( 'init', 'cross_site_sync_taxonomy' );

/* -----------------------------
ADD/UPDATE POST
----------------------------- */	
	function cross_site_sync_add_post_info( $external_post_id, $existing_post_id = false, $number ) {
		$get_post_url = esc_attr( get_option( 'cross_site_sync_website_' . $number ) ) . 'cross-site-sync/?action=get_post&id=' . $external_post_id . '&secret=' . esc_attr( get_option( 'cross_site_sync_secret' ) );
		$post_data = json_decode( file_get_contents( $get_post_url ) );

		$post_info = array(
			'post_title' => $post_data->title,
			'post_content' => $post_data->content,
			'post_date' => $post_data->date,
			'post_status' => $post_data->status,
		);
		
		if( $existing_post_id ) {
			
			$post_id = $existing_post_id;			
			$post_info[ 'ID' ] = $post_id;			
			wp_update_post( $post_info );
			
		} else {
		
			$post_id = wp_insert_post( $post_info );
			
		}
		
		wp_set_object_terms( $post_id, 'cross-site-sync', 'cross-site-sync' );
		
		if( $post_data->categories ) {
			$post_categories = array();
			
			foreach( $post_data->categories as $category ) {
				$existing_term = get_term_by( 'name', $category->name, 'category' );
				
				if( $existing_term ) {
					$post_categories[] = intval( $existing_term->term_id );
				} else {
					$term = wp_insert_term( $category->name, 'category' );
					$post_categories[] = intval( $term[ 'term_id' ] );
				}
			}
			
			wp_set_object_terms( $post_id, $post_categories, 'category' );
		} else {
			wp_delete_object_term_relationships( $post_id, 'category' );
		}
		
		if( $post_data->tags ) {
			$post_tags = array();
			
			foreach( $post_data->tags as $tag ) {
				$existing_term = get_term_by( 'name', $tag->name, 'post_tag' );
				
				if( $existing_term ) {
					$post_tags[] = intval( $existing_term->term_id );
				} else {
					$term = wp_insert_term( $tag->name, 'post_tag' );
					$post_tags[] = intval( $term[ 'term_id' ] );
				}
			}
			
			wp_set_object_terms( $post_id, $post_tags, 'post_tag' );
		} else {
			wp_delete_object_term_relationships( $post_id, 'post_tag' );
		}
		
		update_post_meta( $post_id, 'cross_site_sync_home_url', $post_data->home_url );
		update_post_meta( $post_id, 'cross_site_sync_last_updated', $post_data->last_updated );
		update_post_meta( $post_id, 'cross_site_sync_id', $post_data->ID );
		
		$original_url = $post_data->home_url . '/?p=' . $post_data->ID;
		
		update_post_meta( $post_id, 'cross_site_sync_original_url', $original_url );
		
		if( $post_data->featured_image ) {
			update_post_meta( $post_id, 'cross_site_sync_featured_image', $post_data->featured_image );
			update_post_meta( $post_id, 'cross_site_sync_featured_image_width', $post_data->featured_image_width );
			update_post_meta( $post_id, 'cross_site_sync_featured_image_height', $post_data->featured_image_height );
		} else {
			delete_post_meta( $post_id, 'cross_site_sync_featured_image' );
			delete_post_meta( $post_id, 'cross_site_sync_featured_image_width' );
			delete_post_meta( $post_id, 'cross_site_sync_featured_image_height' );
		}
		
		if( $post_data->format ) {
			set_post_format( $post_id , $post_data->format );	
		} else {
			set_post_format( $post_id , '' );
		}
	}


/* -----------------------------
LOOP THROUGH WEBSITES
----------------------------- */
	function cross_site_sync_loop_through_websites( $number ) {
		$website = esc_attr( get_option( 'cross_site_sync_website_' . $number ) );
		
		if( strlen( $website ) > 4 ) {
			$get_posts_url = $website . 'cross-site-sync/?action=all_posts&secret=' . esc_attr( get_option( 'cross_site_sync_secret' ) );
			$external_posts = json_decode( file_get_contents( $get_posts_url ) );
			
			foreach( $external_posts as $external_post ):
			
				print_r( $external_post );
	
				$args = array(
					'post_status' => 'any',
					'meta_query' => array(
						'relation' => 'AND',
						array(
							'key' => 'cross_site_sync_id',
							'value' => $external_post->ID,
						),
						array(
							'key' => 'cross_site_sync_home_url',
							'value' => $external_post->home_url,
						),
					),
				);
				
				$existing_post = get_posts( $args );
				
				if( $existing_post ) {
					$existing_post_id = $existing_post[ 0 ]->ID;
					
					$external_post_modified = $external_post->last_updated;
					$existing_post_modified = get_post_meta( $existing_post[ 0 ]->ID, 'cross_site_sync_last_updated', true );
					
					if( $existing_post_modified != $external_post_modified ) {
	
						cross_site_sync_add_post_info( $external_post->ID, $existing_post_id, $number);
						
					}
					
				} else {
					
					cross_site_sync_add_post_info( $external_post->ID, false, $number );
				}
				
			endforeach;
		}
	}
		
/* -----------------------------
ADD SYNC PAGE
----------------------------- */
	add_filter( 'page_template', 'cross_site_sync_page_template' );
	
	function cross_site_sync_page_template( $page_template ) {
	    if ( is_page( 'cross-site-sync' ) ) {
	        $page_template = dirname( __FILE__ ) . '/index.php';
	    }
	    
	    return $page_template;
	}
	
	function cross_site_sync_fakepage( $posts ){
	    global $wp;
	    global $wp_query;
	
	    global $cross_site_sync_fakepage_detect; // used to stop double loading
	        $cross_site_sync_url = "cross-site-sync"; // URL of the fake page
	    
	    if ( !$cross_site_sync_fakepage_detect && (strtolower($wp->request) == $cross_site_sync_url || $wp->query_vars['page_id'] == $cross_site_sync_url) ) {
	        // stop interferring with other $posts arrays on this page (only works if the sidebar is rendered *after* the main page)
	        $cross_site_sync_fakepage_detect = true;
	
	        $post = new stdClass;
	        $post->post_author = 1;
	        $post->post_name = $cross_site_sync_url;
	        $post->guid = get_bloginfo('wpurl') . '/' . $cross_site_sync_url;
	        $post->post_title = "Page Title";
	        $post->ID = -999;
	        $post->post_type = 'page';
	        $post->post_status = 'static';
	        $post->comment_status = 'closed';
	        $post->ping_status = 'open';
	        $post->comment_count = 0;
	        $post->post_date = current_time('mysql');
	        $post->post_date_gmt = current_time('mysql', 1);
	        $posts=NULL;
	        $posts[]=$post;
	
	        $wp_query->is_page = true;
	        $wp_query->is_singular = true;
	        $wp_query->is_home = false;
	        $wp_query->is_archive = false;
	        $wp_query->is_category = false;
	        unset($wp_query->query["error"]);
	        $wp_query->query_vars["error"]="";
	        $wp_query->is_404=false;
	    }
	    
	    return $posts;
	}
	
	add_filter( 'the_posts', 'cross_site_sync_fakepage', -10 );
	
/* -----------------------------
ADD ADMIN PAGE
----------------------------- */
	function cross_site_sync_add_page() {
		add_options_page('Cross Site Sync', 'Cross Site Sync', 'activate_plugins', 'cross-site-sync', 'cross_site_sync_display_page');
	}
	
	add_action( 'admin_menu', 'cross_site_sync_add_page' );

/* -----------------------------
RENDER ADMIN PAGE
----------------------------- */	
	function cross_site_sync_display_page() {
		require_once( CROSS_SITE_SYNC__PLUGIN_DIR . 'page.php' );	
	}
	
	function cross_site_sync_register_settings() {
		register_setting( 'cross-site-sync-options', 'cross_site_sync_secret' );
		register_setting( 'cross-site-sync-options', 'cross_site_sync_push_or_pull' );
		register_setting( 'cross-site-sync-options', 'cross_site_sync_website_1' );
		register_setting( 'cross-site-sync-options', 'cross_site_sync_website_2' );
		register_setting( 'cross-site-sync-options', 'cross_site_sync_website_3' );
		register_setting( 'cross-site-sync-options', 'cross_site_sync_category' );
		register_setting( 'cross-site-sync-options', 'cross_site_sync_include_init_category' );
		register_setting( 'cross-site-sync-options', 'cross_site_sync_include_all_categories' );
	}

	add_action( 'admin_init', 'cross_site_sync_register_settings' );