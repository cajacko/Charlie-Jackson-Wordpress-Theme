<article class="new-article">
	<div class="article-container">
		<a class="anchor" id="post-<?php the_ID(); ?>"></a>
		
		<header class="clearfix">
			<?php if(has_post_thumbnail()): ?>
				<?php the_post_thumbnail('inline-image', array('class' => 'post-featured-image')); ?>
			<?php endif; ?>
			<div class="header-title wrap">
				<h2><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h2>
			</div>
		</header>
		
		<section class="post-body wrap">
			<?php the_content(); ?>
		</section>
		
		<footer>
			<div class="wrap">
				<span class="post-date"><?php echo get_the_date(); ?></span>
			</div>
		</footer>
	</div>
</article>