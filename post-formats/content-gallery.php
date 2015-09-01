<article class="new-article">
	<div class="article-container">
		<a class="anchor" id="post-<?php the_ID(); ?>"></a>
		
		<header class="clearfix">
			<?php charliejackson_the_gallery(); ?>
			<div class="header-title wrap">
				<h2><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h2>
			</div>
		</header>
		
		<section class="post-body wrap">
			<?php charliejackson_the_gallery_content(); ?>
		</section>
		
		<footer>
			<div class="wrap">
				<span class="post-date"><?php echo get_the_date(); ?></span>
			</div>
		</footer>
	</div>
</article>