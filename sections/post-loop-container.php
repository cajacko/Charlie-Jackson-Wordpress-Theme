<section id="post-loop">

	<?php get_template_part('sections/post-loop'); ?>
	
	<?php if(have_posts()): wp_bootstrap_pagination(); endif; ?>
	
</section>