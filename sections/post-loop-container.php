<section id="post-loop">
	
	<?php if(is_category() || is_tag()): ?>
		<div id="post-query-title" class="wrap"><h1><?php charliejackson_page_title(); ?></h1></div>
	<?php endif; ?>

	<?php get_template_part('sections/post-loop'); ?>
	
	<?php if(have_posts()): wp_bootstrap_pagination(); endif; ?>
	
</section>