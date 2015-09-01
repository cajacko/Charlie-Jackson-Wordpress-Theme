<?php
/**
 * Charlie Jackson functions and definitions.
 *
 * Every version needs this file.
 *
 * @package Charlie Jackson
 */

/* -----------------------------
ALWAYS HIDE ADMIN BAR
----------------------------- */
	add_filter('show_admin_bar', '__return_false'); //Remove admin bar
	
/* -----------------------------
TERRY PRATCHETT HEADER
----------------------------- */
	function add_header_clacks($headers) {
	    $headers['X-Clacks-Overhead'] = 'GNU Terry Pratchett'; //Add an array value to the headers variable
	    return $headers; //Return the headers
	}
	
	add_filter('wp_headers', 'add_header_clacks'); //Add the filter

/* -----------------------------
ADD THEME SUPPORT
----------------------------- */	
	add_theme_support( 'post-thumbnails' );
	add_image_size ( 'inline-image', 600, 3000, false );
	add_image_size( 'width-500', 500 );
	add_image_size( 'width-1000', 1000 );
	add_image_size( 'width-1500', 1500 );
	add_image_size( 'width-2000', 2000 );
	add_image_size( 'width-2500', 2500 );
	add_image_size( 'width-3000', 3000 );
	add_image_size( 'width-3500', 3500 );
	add_image_size( 'width-4000', 4000 );
	add_post_type_support( "page", "excerpt" );

/* -----------------------------
ENQUE STYLES AND SCRIPTS
----------------------------- */
	function charliejackson_scripts() {
		wp_enqueue_style( 'charliejackson-bootstrap-style',  get_template_directory_uri()  . '/inc/bootstrap/css/bootstrap.min.css'); //Add the main stylesheet
		wp_enqueue_script( 'charliejackson-bootstrap-script', get_template_directory_uri()  . '/inc/bootstrap/js/bootstrap.min.js', array( 'jquery' )); //Add bootstrap script
		wp_enqueue_script( 'charliejackson-template-script', get_template_directory_uri()  . '/js/template.js', array( 'jquery' )); //Add template script
		wp_enqueue_script( 'charliejackson-setup-script', get_template_directory_uri()  . '/js/setup.js', array( 'jquery' )); //Add setup script
		
		if(is_front_page_showing()) {
			wp_enqueue_script( 'charliejackson-banner-script', get_template_directory_uri()  . '/js/banner.js', array( 'jquery' )); //Add setup script
		}
		
		if(!is_single()) {
			wp_enqueue_script( 'charliejackson-not-single-script', get_template_directory_uri()  . '/js/not-single.js', array( 'jquery' )); //Add setup script
		}
		
		if(is_page('portfolio')) {
			wp_enqueue_script( 'charliejackson-portfolio-script', get_template_directory_uri()  . '/js/portfolio.js', array( 'jquery' )); //Add setup script
		}
		
		if(is_page('projects')) {
			wp_enqueue_script( 'charliejackson-projects-script', get_template_directory_uri()  . '/js/projects.js', array( 'jquery' )); //Add setup script
			wp_enqueue_script( 'charliejackson-masonry-script', get_template_directory_uri()  . '/js/masonry.js', array( 'jquery' )); //Add setup script
		} else {
			wp_enqueue_script( 'charliejackson-sidebar-script', get_template_directory_uri()  . '/js/sidebar.js', array( 'jquery' )); //Add setup script
		}
	}
	
	add_action( 'wp_enqueue_scripts', 'charliejackson_scripts' ); //Add action

/* -----------------------------
IS THE FRONT PAGE SHOWING
----------------------------- */
	function is_front_page_showing() {
		if(is_front_page() && !is_paged()) {
			return true;
		} else {
			return false;
		}
	}
	
/* -----------------------------
FILTER OEMBED OUTPUT
----------------------------- */	
	function my_embed_oembed_html($html, $url, $attr, $post_id) {
		$html = preg_replace('/(width=").+?(")/', '', $html);
		$html = preg_replace('/(height=").+?(")/', '', $html);
		$html = str_replace('iframe', 'iframe class="embed-responsive-item"', $html);
	  return '<div class="embed-responsive embed-responsive-16by9">' . $html . '</div>';
	}
	
	add_filter('embed_oembed_html', 'my_embed_oembed_html', 99, 4);
	
/* -----------------------------
REGISTER PAGE CATEGORIES	
----------------------------- */	
	
	add_action( 'init', 'charlie_jackson_page_cat' );

	function charlie_jackson_page_cat() {
		register_taxonomy(
			'project-categories',
			'page',
			array(
				'label' => __( 'Project Categories' ),
				'rewrite' => array( 'slug' => 'topic' ),
				'hierarchical' => true,
			)
		);
	}
	
/* -----------------------------
ADD MEDIA SIZES	
----------------------------- */

	add_filter( 'image_size_names_choose', 'charlie_jackson_new_image_sizes_inline_image' );
	
	function charlie_jackson_new_image_sizes_inline_image( $sizes ) {
	    return array_merge( $sizes, array(
	        'inline-image' => __( 'Inline Image' )
	    ) );
	}
	
	add_filter( 'image_size_names_choose', 'charlie_jackson_new_image_sizes_500' );
	
	function charlie_jackson_new_image_sizes_500( $sizes ) {
	    return array_merge( $sizes, array(
	        'width-500' => __( 'Width 500' )
	    ) );
	}
	
	add_filter( 'image_size_names_choose', 'charlie_jackson_new_image_sizes_1000' );
	
	function charlie_jackson_new_image_sizes_1000( $sizes ) {
	    return array_merge( $sizes, array(
	        'width-1000' => __( 'Width 1000' )
	    ) );
	}
	
	add_filter( 'image_size_names_choose', 'charlie_jackson_new_image_sizes_1500' );
	
	function charlie_jackson_new_image_sizes_1500( $sizes ) {
	    return array_merge( $sizes, array(
	        'width-1500' => __( 'Width 1500' )
	    ) );
	}
	
	add_filter( 'image_size_names_choose', 'charlie_jackson_new_image_sizes_2000' );
	
	function charlie_jackson_new_image_sizes_2000( $sizes ) {
	    return array_merge( $sizes, array(
	        'width-2000' => __( 'Width 2000' )
	    ) );
	}
	
	add_filter( 'image_size_names_choose', 'charlie_jackson_new_image_sizes_2500' );
	
	function charlie_jackson_new_image_sizes_2500( $sizes ) {
	    return array_merge( $sizes, array(
	        'width-2500' => __( 'Width 2500' )
	    ) );
	}
	
	add_filter( 'image_size_names_choose', 'charlie_jackson_new_image_sizes_3000' );
	
	function charlie_jackson_new_image_sizes_3000( $sizes ) {
	    return array_merge( $sizes, array(
	        'width-3000' => __( 'Width 3000' )
	    ) );
	}
	
	add_filter( 'image_size_names_choose', 'charlie_jackson_new_image_sizes_3500' );
	
	function charlie_jackson_new_image_sizes_3500( $sizes ) {
	    return array_merge( $sizes, array(
	        'width-3500' => __( 'Width 3500' )
	    ) );
	}
	
	add_filter( 'image_size_names_choose', 'charlie_jackson_new_image_sizes_4000' );
	
	function charlie_jackson_new_image_sizes_4000( $sizes ) {
	    return array_merge( $sizes, array(
	        'width-4000' => __( 'Width 4000' )
	    ) );
	}

/* -----------------------------
INCREASE MAX UPLOAD SIZE	
----------------------------- */
	@ini_set( ‘upload_max_size’ , ‘10G’);

	@ini_set( ‘post_max_size’, ‘10G’);
	
	@ini_set( ‘max_execution_time’, ‘300’);


/* -----------------------------
DISPLAY PORTFOLIO META BOXES	
----------------------------- */
	/* If the page template is movement page, then show the relevant fields */	
	
	//$post_object = get_post($_GET['post']);
	
	  // check for a template type
	 // if (has_term("portfolio", "project-categories", $post_object)) {
	   	/* Define the custom box */
		add_action( 'add_meta_boxes', 'charlie_jackson_add_custom_box' );
		
		/* Do something with the data entered */
		add_action( 'save_post', 'charlie_jackson_save_postdata' );
	  //}
	
	/* Adds a box to the main column on the Post and Page edit screens */
	function charlie_jackson_add_custom_box() {
	  add_meta_box( 'portfolio-meta-box', 'Portfolio Content', 'wp_editor_meta_box' );
	}
	
	/* Prints the box content */
	function wp_editor_meta_box( $post ) {
	
	  // Use nonce for verification
	  wp_nonce_field( plugin_basename( __FILE__ ), 'charlie_jackson_noncename' );
	
	  $field_value = get_post_meta( $post->ID, 'portfolio_content', false );
	  wp_editor( $field_value[0], 'portfolio_content' );
	}
	
	/* When the post is saved, saves our custom data */
	function charlie_jackson_save_postdata( $post_id ) {
	
	  // verify if this is an auto save routine. 
	  // If it is our form has not been submitted, so we dont want to do anything
	  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
	      return;
	
	  // verify this came from the our screen and with proper authorization,
	  // because save_post can be triggered at other times
	  if ( ( isset ( $_POST['charlie_jackson_noncename'] ) ) && ( ! wp_verify_nonce( $_POST['charlie_jackson_noncename'], plugin_basename( __FILE__ ) ) ) )
	      return;
	
	  // Check permissions
	  if ( ( isset ( $_POST['post_type'] ) ) && ( 'page' == $_POST['post_type'] )  ) {
	    if ( ! current_user_can( 'edit_page', $post_id ) ) {
	      return;
	    }    
	  }
	  else {
	    if ( ! current_user_can( 'edit_post', $post_id ) ) {
	      return;
	    }
	  }
	
	  // OK, we're authenticated: we need to find and save the data
	  if ( isset ( $_POST['portfolio_content'] ) ) {
	    update_post_meta( $post_id, 'portfolio_content', $_POST['portfolio_content'] );
	  }
	
	}

/* -----------------------------
DISPLAY MULTIPLE POST THUMBNAILS
----------------------------- */
	if (class_exists('MultiPostThumbnails')) {
	    new MultiPostThumbnails(
	        array(
	            'label' => 'Portfolio Image',
	            'id' => 'portfolio-image',
	            'post_type' => 'page'
	        )
	    );
	}
	
/* -----------------------------
FILTER MEDIA BY QUERY
----------------------------- */	
	function charlie_jackson_filter_media_by_query( $query ) {
		
		if($_GET['pinterest-media'] == 'pinterest-sketchbook') {
	        $query->set( 'tax_query', 
	        	array(
	        		'relation' => 'AND',
					array(
						'taxonomy' => 'attachment_category',
						'field'    => 'slug',
						'terms'    => 'sketchbook',
					),
					array(
						'taxonomy' => 'attachment_category',
						'field'    => 'slug',
						'terms'    => 'in-pinterest',
						'operator' => 'NOT IN',
					),
				) 
			);
		}
	    
	}
	add_action( 'pre_get_posts', 'charlie_jackson_filter_media_by_query' );
		
/* -----------------------------
ADD ADMIN MENU ITEMS
----------------------------- */		
	add_action( 'admin_bar_menu', 'charlie_jackson_add_sketch_pinterest_menu', 999 );

	function charlie_jackson_add_sketch_pinterest_menu( $wp_admin_bar ) {
		$args = array(
			'id'    => 'sketch_pinterest',
			'title' => 'Sketchbook not in Pinterest',
			'href'  => '/wp-admin/upload.php?page=mla-menu&pinterest-media=pinterest-sketchbook',
			'meta'  => array( 'class' => 'my-toolbar-page' )
		);
		$wp_admin_bar->add_node( $args );
	}

/* -----------------------------
FILTER ATTACHMENT OUTPUT
----------------------------- */	
	add_filter( 'img_caption_shortcode', 'my_caption_html', 10, 3 );
	
	function my_caption_html( $current_html, $attr, $content ) {
	    extract(shortcode_atts(array(
	        'id'    => '',
	        'align' => 'alignnone',
	        'width' => '',
	        'caption' => ''
	    ), $attr));
	    if ( 1 > (int) $width || empty($caption) )
	        return $content;
	
	    if ( $id ) $id = 'id="' . esc_attr($id) . '" ';
	
	    return '<div class="caption">'
	. do_shortcode( $content ) . '<p class="caption-text">' . $caption . '</p></div>';
	}	

/* -----------------------------
BLOG PAGE TITLE
----------------------------- */
	function charliejackson_page_title() {
		$string = '';
		
		if(is_category()) {
			$string .= 'Category: ';
		} elseif(is_tag()) {
			$string .= 'Tag: ';
		}
		
		$string .= single_cat_title( '', false );
		
		if(is_paged()) {
			$string .= ' <small>- Page: '.get_query_var('paged').'</small>';
		}
		
		echo $string;	
	}
		
/* -----------------------------
BOOTSTRAP PAGE NAV
----------------------------- */	
	function wp_bootstrap_pagination( $args = array() ) {
	    
	    $defaults = array(
	        'range'           => 4,
	        'custom_query'    => FALSE,
	        'previous_string' => __( '<i class="fa fa-chevron-left"></i>', 'text-domain' ),
	        'next_string'     => __( '<i class="fa fa-chevron-right"></i>', 'text-domain' ),
	        'before_output'   => '<div id="page-nav" class="text-center"><ul class="pagination">',
	        'after_output'    => '</ul></div>'
	    );
	    
	    $args = wp_parse_args( 
	        $args, 
	        apply_filters( 'wp_bootstrap_pagination_defaults', $defaults )
	    );
	    
	    $args['range'] = (int) $args['range'] - 1;
	    if ( !$args['custom_query'] )
	        $args['custom_query'] = @$GLOBALS['wp_query'];
	    $count = (int) $args['custom_query']->max_num_pages;
	    $page  = intval( get_query_var( 'paged' ) );
	    $ceil  = ceil( $args['range'] / 2 );
	    
	    if ( $count <= 1 )
	        return FALSE;
	    
	    if ( !$page )
	        $page = 1;
	    
	    if ( $count > $args['range'] ) {
	        if ( $page <= $args['range'] ) {
	            $min = 1;
	            $max = $args['range'] + 1;
	        } elseif ( $page >= ($count - $ceil) ) {
	            $min = $count - $args['range'];
	            $max = $count;
	        } elseif ( $page >= $args['range'] && $page < ($count - $ceil) ) {
	            $min = $page - $ceil;
	            $max = $page + $ceil;
	        }
	    } else {
	        $min = 1;
	        $max = $count;
	    }
	    
	    $echo = '';
	    $previous = intval($page) - 1;
	    $previous = esc_attr( get_pagenum_link($previous) );
	    
	    $firstpage = esc_attr( get_pagenum_link(1) );
	    if ( $firstpage && (1 != $page) )
	        $echo .= '<li class="previous"><a href="' . $firstpage . '">' . __( 'First', 'text-domain' ) . '</a></li>';
	
	    if ( $previous && (1 != $page) )
	        $echo .= '<li><a href="' . $previous . '" title="' . __( 'previous', 'text-domain') . '">' . $args['previous_string'] . '</a></li>';
	    
	    if ( !empty($min) && !empty($max) ) {
	        for( $i = $min; $i <= $max; $i++ ) {
	            if ($page == $i) {
	                $echo .= '<li class="active"><span class="active">' . str_pad( (int)$i, 2, '0', STR_PAD_LEFT ) . '</span></li>';
	            } else {
	                $echo .= sprintf( '<li><a href="%s">%002d</a></li>', esc_attr( get_pagenum_link($i) ), $i );
	            }
	        }
	    }
	    
	    $next = intval($page) + 1;
	    $next = esc_attr( get_pagenum_link($next) );
	    if ($next && ($count != $page) )
	        $echo .= '<li><a href="' . $next . '" title="' . __( 'next', 'text-domain') . '">' . $args['next_string'] . '</a></li>';
	    
	    $lastpage = esc_attr( get_pagenum_link($count) );
	    if ( $lastpage ) {
	        $echo .= '<li class="next"><a href="' . $lastpage . '">' . __( 'Last', 'text-domain' ) . '</a></li>';
	    }
	
	    if ( isset($echo) )
	        echo $args['before_output'] . $echo . $args['after_output'];
	}