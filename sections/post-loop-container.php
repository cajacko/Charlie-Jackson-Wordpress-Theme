<section id="post-loop">
	
	<?php if(!is_front_page()): ?>
		<div id="post-query-title" class="wrap"><h1>Page</h1></div>
	<?php endif; ?>

	<?php get_template_part('sections/post-loop'); ?>
	
	<?php if(have_posts()): wp_bootstrap_pagination(); endif; ?>
	
</section>