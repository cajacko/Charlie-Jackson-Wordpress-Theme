<?php
/**
 * Charlie Jackson functions and definitions
 *
 * @package Charlie Jackson
 */
 
/* -----------------------------
SET CONTENT WIDTH
----------------------------- */

	if ( ! isset( $content_width ) ) {
		$content_width = 600; /* pixels */
	}
	
	
	
	
	function the_slug($echo=true){
	
	  $slug = basename(get_permalink());
	
	  do_action('before_slug', $slug);

	  $slug = apply_filters('slug_filter', $slug);
	
	  if( $echo ) echo $slug;
	
	  do_action('after_slug', $slug);
	
	  return $slug;
	
	}
	
	function add_header_clacks($headers) {
	    $headers['X-Clacks-Overhead'] = 'GNU Terry Pratchett';
	    return $headers;
	}
	
	add_filter('wp_headers', 'add_header_clacks');


/* -----------------------------
SETUP DEFAULTS AND REGISTER SUPPORT
----------------------------- */

	if ( ! function_exists( 'charlie_jackson_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	 
		function charlie_jackson_setup() {
		
			// Add default posts and comments RSS feed links to head.
			add_theme_support( 'automatic-feed-links' );
		
			/*
			 * Enable support for Post Thumbnails on posts and pages.
			 *
			 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
			 */
			add_theme_support( 'post-thumbnails' );
		
			// This theme uses wp_nav_menu() in one location.
			register_nav_menus( array(
				'site-nav' => __( 'Site Navigation', 'charlie-jackson' )
			) );
		
			/*
			 * Switch default core markup for search form, comment form, and comments
			 * to output valid HTML5.
			 */
			add_theme_support( 'html5', array(
				'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
			) );
			
			add_theme_support( 'title-tag' );
		
			/*
			 * Enable support for Post Formats.
			 * See http://codex.wordpress.org/Post_Formats
			 */
			add_theme_support( 'post-formats', array(
				'image', 'video', 'gallery', 'link', 'aside', 'quote', 'status', 'audio', 'chat') );
			
			add_image_size( 'width-500', 500 );
			add_image_size( 'width-1000', 1000 );
			add_image_size( 'width-1500', 1500 );
			add_image_size( 'width-2000', 2000 );
			add_image_size( 'width-2500', 2500 );
			add_image_size( 'width-3000', 3000 );
			add_image_size( 'width-3500', 3500 );
			add_image_size( 'width-4000', 4000 );
			
		
		}
	endif; // charlie_jackson_setup
	add_action( 'after_setup_theme', 'charlie_jackson_setup' );

/* -----------------------------
ENQUE STYLES AND SCRIPTS
----------------------------- */

	function charlie_jackson_scripts() {
		
		wp_enqueue_script( 'charlie-jackson-bootstrap-script', get_template_directory_uri() . '/inc/bootstrap/js/bootstrap.min.js', array( 'jquery' )); //Add bootstrap script

		wp_enqueue_style( 'charlie-jackson-bootstrap-style', get_template_directory_uri() . '/inc/bootstrap/css/bootstrap.min.css'); //Add bootstrap style
		
		if(is_front_page() || is_post_type_archive() || is_tax() || is_category() || is_tag()) {
			
			wp_enqueue_script( 'charlie-jackson-masonry', get_template_directory_uri() . '/js/masonry.pkgd.min.js', array( 'jquery' )); //Add bootstrap script
		
			wp_enqueue_script( 'charlie-jackson-imagesloaded', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', array( 'jquery' )); //Add bootstrap script	
		}
		
		if(is_front_page()) {
			wp_enqueue_script( 'charlie-jackson-home-page-script', get_template_directory_uri() . '/js/home-setup.js', array( 'jquery' ));
		}

		if((is_single() || is_page()) && (the_slug(false) != "portfolio")) {
			wp_enqueue_script( 'charlie-jackson-single-page-script', get_template_directory_uri() . '/js/single-setup.js', array( 'jquery' ));
		} 	
		
		if(the_slug(false) == "portfolio") {
			wp_enqueue_script( 'charlie-jackson-portfolio-appear-script', get_template_directory_uri() . '/js/appear.js', array( 'jquery' ));
			wp_enqueue_script( 'charlie-jackson-portfolio-columnizer-script', get_template_directory_uri() . '/js/columnizer.js', array( 'jquery' ));
			wp_enqueue_script( 'charlie-jackson-portfolio-page-script', get_template_directory_uri() . '/js/portfolio-setup.js', array( 'jquery' ));
		} 
		
		wp_enqueue_script( 'charlie-jackson-setup-script', get_template_directory_uri() . '/js/setup.js', array( 'jquery' )); //Add bootstrap script
		
		if(is_front_page() || is_post_type_archive() || is_tax() || is_category() || is_tag()) {
			wp_enqueue_script( 'charlie-jackson-masonry-page-script', get_template_directory_uri() . '/js/masonry-page.js', array( 'jquery' ));
		}
	}
	
	add_action( 'wp_enqueue_scripts', 'charlie_jackson_scripts' );
	

/* -----------------------------
REGISTER CALL TO ACTION POST TYPE
----------------------------- */

	add_action( 'init', 'register_call_to_action' );

	function register_call_to_action() {
		$labels = array(
			'name'               => _x( 'Call to Actions', 'post type general name', 'charlie-jackson' ),
			'singular_name'      => _x( 'Call to Action', 'post type singular name', 'charlie-jackson' ),
			'menu_name'          => _x( 'CTA', 'admin menu', 'charlie-jackson' ),
			'name_admin_bar'     => _x( 'Call to Action', 'add new on admin bar', 'charlie-jackson' ),
			'add_new'            => _x( 'Add New', 'cta', 'charlie-jackson' ),
			'add_new_item'       => __( 'Add New Call to Action', 'charlie-jackson' ),
			'new_item'           => __( 'New Call to Action', 'charlie-jackson' ),
			'edit_item'          => __( 'Edit Call to Action', 'charlie-jackson' ),
			'view_item'          => __( 'View Call to Action', 'charlie-jackson' ),
			'all_items'          => __( 'All Call to Actions', 'charlie-jackson' ),
			'search_items'       => __( 'Search Call to Actions', 'charlie-jackson' ),
			'not_found'          => __( 'No call to actions found.', 'charlie-jackson' ),
			'not_found_in_trash' => __( 'No call to actions found in Trash.', 'charlie-jackson' )
		);
	
		$args = array(
			'labels'             => $labels,
			'description'		 => "Call to Action Post Type",
			'public'             => true,
			'publicly_queryable' => false,
			'exclude_from_search'=> true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'menu_position'		 => 22,
			'show_in_nav_menus'  => false,
			'query_var'          => false,
			'capability_type'    => 'post',
			'has_archive'        => false,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor', 'revisions', 'page-attributes' )
		);
	
		register_post_type( 'cta', $args );
	}
	

/* -----------------------------
REGISTER BANNER POST TYPE
----------------------------- */

	add_action( 'init', 'register_banner' );

	function register_banner() {
		$labels = array(
			'name'               => _x( 'Banners', 'post type general name', 'charlie-jackson' ),
			'singular_name'      => _x( 'Banner', 'post type singular name', 'charlie-jackson' ),
			'menu_name'          => _x( 'Banner', 'admin menu', 'charlie-jackson' ),
			'name_admin_bar'     => _x( 'Banner', 'add new on admin bar', 'charlie-jackson' ),
			'add_new'            => _x( 'Add New', 'banner', 'charlie-jackson' ),
			'add_new_item'       => __( 'Add New Banner', 'charlie-jackson' ),
			'new_item'           => __( 'New Banner', 'charlie-jackson' ),
			'edit_item'          => __( 'Edit Banner', 'charlie-jackson' ),
			'view_item'          => __( 'View Banner', 'charlie-jackson' ),
			'all_items'          => __( 'All Banners', 'charlie-jackson' ),
			'search_items'       => __( 'Search Banners', 'charlie-jackson' ),
			'not_found'          => __( 'No banners found.', 'charlie-jackson' ),
			'not_found_in_trash' => __( 'No banners found in Trash.', 'charlie-jackson' )
		);
	
		$args = array(
			'labels'             => $labels,
			'description'		 => "Banner Post Type",
			'public'             => true,
			'publicly_queryable' => false,
			'exclude_from_search'=> true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'menu_position'		 => 22,
			'show_in_nav_menus'  => false,
			'query_var'          => false,
			'capability_type'    => 'post',
			'has_archive'        => false,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor', 'revisions', 'page-attributes', 'thumbnail' )
		);
	
		register_post_type( 'banner', $args );
	}


/* -----------------------------
REGISTER FEATURED CONTENT POST TYPE
----------------------------- */

	add_action( 'init', 'register_featured_content' );

	function register_featured_content() {
		$labels = array(
			'name'               => _x( 'Featured Content', 'post type general name', 'charlie-jackson' ),
			'singular_name'      => _x( 'Featured Content', 'post type singular name', 'charlie-jackson' ),
			'menu_name'          => _x( 'Featured Content', 'admin menu', 'charlie-jackson' ),
			'name_admin_bar'     => _x( 'Featured Content', 'add new on admin bar', 'charlie-jackson' ),
			'add_new'            => _x( 'Add New', 'featured-content', 'charlie-jackson' ),
			'add_new_item'       => __( 'Add New Featured Content', 'charlie-jackson' ),
			'new_item'           => __( 'New Featured Content', 'charlie-jackson' ),
			'edit_item'          => __( 'Edit Featured Content', 'charlie-jackson' ),
			'view_item'          => __( 'View Featured Content', 'charlie-jackson' ),
			'all_items'          => __( 'All Featured Content', 'charlie-jackson' ),
			'search_items'       => __( 'Search Featured Content', 'charlie-jackson' ),
			'not_found'          => __( 'No featured content found.', 'charlie-jackson' ),
			'not_found_in_trash' => __( 'No featured content found in Trash.', 'charlie-jackson' )
		);
	
		$args = array(
			'labels'             => $labels,
			'description'		 => "Featured Content Post Type",
			'public'             => true,
			'publicly_queryable' => false,
			'exclude_from_search'=> true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'menu_position'		 => 22,
			'show_in_nav_menus'  => false,
			'query_var'          => false,
			'capability_type'    => 'post',
			'has_archive'        => false,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'revisions', 'page-attributes', 'thumbnail' )
		);
	
		register_post_type( 'featured-content', $args );
	}
	
/* -----------------------------
EXCERPT FOR PAGES	
----------------------------- */	
	
	add_post_type_support( "page", "excerpt" );
	
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
GET THE CONTENT WITH FORMATTING	
----------------------------- */
	
	function get_the_content_with_formatting ($more_link_text = '(more...)', $stripteaser = 0, $more_file = '') {
		$content = get_the_content($more_link_text, $stripteaser, $more_file);
		$content = apply_filters('the_content', $content);
		$content = str_replace(']]>', ']]&gt;', $content);
		return $content;
	}
		
/* -----------------------------
POST HEADER MEDIA FORMATS
----------------------------- */	
		
	function charlie_jackson_get_audio() {
		return;
	}
	
	function charlie_jackson_the_gallery() {
		preg_match ( "/(?s)<div id=\'gallery.*?<\/figure>
		<\/div>/" , get_the_content_with_formatting(), $match);
		
		echo $match[0];
	}
	
	function charlie_jackson_the_gallery_content() {
		echo preg_replace ( "/(?s)<div id=\'gallery.*?<\/figure>
		<\/div>/" , "" , get_the_content_with_formatting());
	}
	
	function charlie_jackson_the_video() {
		preg_match ( "/<iframe.*<\/iframe>/" , get_the_content_with_formatting(), $match);
		
		echo '<div class="embed-responsive embed-responsive-16by9">'.$match[0].'</div>';
	}
	
	function charlie_jackson_the_video_content() {
		$content = preg_replace ( "/<p><div class=\"embed-responsive embed-responsive-16by9\"><iframe.*<\/div><\/p>/" , "" , get_the_content_with_formatting());
		$content = preg_replace ( "/<div class=\"embed-responsive embed-responsive-16by9\"><iframe.*<\/div>/" , "" , $content);
		echo $content;
		
	}
	
/* -----------------------------
ADD MEDIA SIZES	
----------------------------- */

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
TAG YOUTUBE EMBED	
----------------------------- */	
	
	add_filter( 'embed_oembed_html', 'custom_youtube_oembed' );
	function custom_youtube_oembed( $code ){
	    if( stripos( $code, 'youtube.com' ) !== FALSE && stripos( $code, 'iframe' ) !== FALSE )
	        $code = str_replace( '<iframe', '<iframe class="embed-responsive-item" ', $code );
	
	    return '<div class="embed-responsive embed-responsive-16by9">'.$code.'</div>';
	}
	
/* -----------------------------
PRINT CAT LINKS FOR THOUGHTS	
----------------------------- */
	
	function charlie_jackson_print_cat_link($cat_slug) {
		 $category_id = get_cat_ID($cat_slug);
		 $category_link = get_category_link( $category_id );
		 echo esc_url( $category_link );
	}
	
	function charlie_jackson_is_cat($cat_slug) {
		if($cat_slug == "all" && is_front_page()) {
			echo "bold";
		} elseif(is_category($cat_slug)) {
			echo "bold";
		}
	}
	
/* -----------------------------
BANNER CATEGORIES	
----------------------------- */	
	
	add_action( 'init', 'charlie_jackson_banner_cat' );

	function charlie_jackson_banner_cat() {
		register_taxonomy(
			'banner-cat',
			'banner',
			array(
				'label' => __( 'Category' ),
				'rewrite' => array( 'slug' => 'banner-cat' ),
				'hierarchical' => true,
			)
		);
	}
	
	function charlie_jackson_banner_classes($banner_count) {
		$cat_string = "";
		
		if(has_term( "light", "banner-cat")) { 
			$cat_string .= " banner-light "; 
		} else { 
			$cat_string .= " banner-dark "; 
		}
		
		if($banner_count == 0) { 
			$cat_string .= " active "; 
		}
		
		echo $cat_string;
	}
	
/* -----------------------------
FEATURED CONTENT CATEGORIES	
----------------------------- */	
	
	add_action( 'init', 'charlie_jackson_featured_content_cat' );

	function charlie_jackson_featured_content_cat() {
		register_taxonomy(
			'featured-content-cat',
			'featured-content',
			array(
				'label' => __( 'Category' ),
				'rewrite' => array( 'slug' => 'featured-content-cat' ),
				'hierarchical' => true,
			)
		);
	}
	
	function charlie_jackson_featured_content_classes() {
		$cat_string = "";
		
		if(has_term( "dark", "featured-content-cat")) { 
			$cat_string .= " featured-content-dark "; 
		} 
		
		echo $cat_string;
	}
	
/* -----------------------------
URL META FOR BANNERS AND FEATURED CONTENT	
----------------------------- */	
		
	/**
	 * Adds a box to the main column on the Post and Page edit screens.
	 */
	function charlie_jackson_featured_content_url_add_meta_box() {
	
		$screens = array( 'featured-content', 'banner' );
	
		foreach ( $screens as $screen ) {
	
			add_meta_box(
				'featured-content-url',
				__( 'URL to link to', 'charlie-jackson' ),
				'charlie_jackson_featured_content_url_callback',
				$screen
			);
		}
	}
	add_action( 'add_meta_boxes', 'charlie_jackson_featured_content_url_add_meta_box' );
	
	/**
	 * Prints the box content.
	 * 
	 * @param WP_Post $post The object for the current post/page.
	 */
	function charlie_jackson_featured_content_url_callback( $post ) {
	
		// Add an nonce field so we can check for it later.
		wp_nonce_field( 'charlie_jackson_featured_content_url_meta_box', 'charlie_jackson_featured_content_url_meta_box_nonce' );
	
		/*
		 * Use get_post_meta() to retrieve an existing value
		 * from the database and use the value for the form.
		 */
		$value = get_post_meta( $post->ID, 'featured_content_url', true );
	
		echo '<label for="charlie_jackson_featured_content_url_field">';
		_e( 'URL', 'charlie-jackson' );
		echo '</label> ';
		echo '<input type="text" id="charlie_jackson_featured_content_url_field" name="charlie_jackson_featured_content_url_field" value="' . esc_attr( $value ) . '" size="25" />';
	}
	
	/**
	 * When the post is saved, saves our custom data.
	 *
	 * @param int $post_id The ID of the post being saved.
	 */
	function charlie_jackson_featured_content_save_meta_box_data( $post_id ) {
	
		/*
		 * We need to verify this came from our screen and with proper authorization,
		 * because the save_post action can be triggered at other times.
		 */
	
		// Check if our nonce is set.
		if ( ! isset( $_POST['charlie_jackson_featured_content_url_meta_box_nonce'] ) ) {
			return;
		}
	
		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $_POST['charlie_jackson_featured_content_url_meta_box_nonce'], 'charlie_jackson_featured_content_url_meta_box' ) ) {
			return;
		}
	
		// If this is an autosave, our form has not been submitted, so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
	
		// Check the user's permissions.
		if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
	
			if ( ! current_user_can( 'edit_page', $post_id ) ) {
				return;
			}
	
		} else {
	
			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return;
			}
		}
	
		/* OK, it's safe for us to save the data now. */
		
		// Make sure that it is set.
		if ( ! isset( $_POST['charlie_jackson_featured_content_url_field'] ) ) {
			return;
		}
	
		// Sanitize user input.
		$my_data = sanitize_text_field( $_POST['charlie_jackson_featured_content_url_field'] );
	
		// Update the meta field in the database.
		update_post_meta( $post_id, 'featured_content_url', $my_data );
	}
	add_action( 'save_post', 'charlie_jackson_featured_content_save_meta_box_data' );
	
/* -----------------------------
FILTER THE IMAGE CAPTIONS	
----------------------------- */		
	
	add_filter( 'img_caption_shortcode', 'my_img_caption_shortcode', 10, 3 );
	
	function my_img_caption_shortcode( $empty, $attr, $content ){
		$attr = shortcode_atts( array(
			'id'      => '',
			'align'   => 'alignnone',
			'width'   => '',
			'caption' => ''
		), $attr );
	
		if ( 1 > (int) $attr['width'] || empty( $attr['caption'] ) ) {
			return '';
		}
	
		if ( $attr['id'] ) {
			$attr['id'] = 'id="' . esc_attr( $attr['id'] ) . '" ';
		}
	
		return '<div ' . $attr['id']
		. 'class="wp-caption ' . esc_attr( $attr['align'] ) . '" '
		. '>'
		. do_shortcode( $content )
		. '<p class="wp-caption-text text-center well"><small><em>' . $attr['caption'] . '</em></small></p>'
		. '</div>';
	
	}
	
	
	
	
	
	
	
	function charlie_jackson_main_classes() {
		if((is_single() || is_page()) && (the_slug(false) != "portfolio")){ 
			echo "container single-page content"; 
		} elseif(is_front_page()) { 
			echo "home-page"; 
		}
	}
	
	

/*******************************
DISPLAY PORTFOLIO META BOXES
*******************************/

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

/*******************************
DISPLAY MULTIPLE POST THUMBNAILS
*******************************/

	if (class_exists('MultiPostThumbnails')) {
	    new MultiPostThumbnails(
	        array(
	            'label' => 'Portfolio Image',
	            'id' => 'portfolio-image',
	            'post_type' => 'page'
	        )
	    );
	}
	
/*******************************
FILTER MEDIA BY QUERY
*******************************/	
	
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
		
/*******************************
ADD ADMIN MENU ITEMS
*******************************/		
	
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