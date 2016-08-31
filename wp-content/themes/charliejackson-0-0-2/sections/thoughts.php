<section id="thoughts" class="content">
	<header id="thoughts-header" class="section-header">
		<nav class="display-table container">
			<ul class="display-table-row">
				<li class="nav-item display-table-cell"><a class="<?php charlie_jackson_is_cat("all"); ?>" id="thoughts-cat-all" href="/#thoughts">#all</a></li>
				<li class="nav-item display-table-cell"><a class="thought-cat <?php charlie_jackson_is_cat("technology"); ?>" id="thoughts-cat-technology" href="<?php charlie_jackson_print_cat_link("technology"); ?>">#tech</a></li>
				<li class="title display-table-cell"><h1>Thoughts</h1></li>
				<li class="nav-item display-table-cell"><a class="thought-cat <?php charlie_jackson_is_cat("design"); ?>" id="thoughts-cat-design" href="<?php charlie_jackson_print_cat_link("design"); ?>">#design</a></li>
				<li class="nav-item display-table-cell"><a class="thought-cat <?php charlie_jackson_is_cat("entrepreneurship"); ?>" id="thoughts-cat-entrepreneurship" href="<?php charlie_jackson_print_cat_link("entrepreneurship"); ?>">#entrepreneurship</a></li>	
			</ul>
		</nav>
	</header>
	
	<?php if ( have_posts() ) : ?>
		<div>
			<div id="masonry">
		
				<?php 
				
				while ( have_posts() ) : the_post();
				
					get_template_part( 'sections/thought');
		
				endwhile; 
				
				?>
			
			</div>
		</div>

	<?php else : ?>
	
	<?php endif; ?>
	
	<footer>
		<p><a id="load-more" href="#">No more posts</a></p>
	</footer>
</section>


