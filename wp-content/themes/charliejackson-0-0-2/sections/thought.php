<?php 

$post_categories = wp_get_post_categories(get_the_ID());
	
foreach($post_categories as $c){
	$cat = get_category( $c );
	$cat_string .= " thoughts-cat-".$cat->slug;
} ?>

<article id="post-<?php the_slug(); ?>" class="<?php echo $cat_string; ?> format-<?php echo get_post_format(); ?>">
	<div class="thought-wrapper">

		<?php 
		
		if(is_page()) {
			get_template_part('post-formats/content', 'page');
		} else {		
			get_template_part( 'post-formats/content', get_post_format() ); 		
		}
		
		?>
		
	</div>

</article>

<?php $cat_string = ""; ?>