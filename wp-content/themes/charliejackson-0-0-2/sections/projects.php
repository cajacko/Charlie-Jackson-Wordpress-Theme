<section id="projects">
	<header class="section-header">
		<nav class="display-table container">
			<ul class="display-table-row">
				<li class="nav-item display-table-cell"><a class="bold" id="project-cat-all">#all</a></li>
				<li class="nav-item display-table-cell"><a class="project-cat" id="project-cat-technology">#tech</a></li>
				<li class="title display-table-cell"><h1>Projects</h1></li>
				<li class="nav-item display-table-cell"><a class="project-cat" id="project-cat-design">#design</a></li>
				<li class="nav-item display-table-cell"><a class="project-cat" id="project-cat-entrepreneurship">#entrepreneurship</a></li>
			</ul>
		</nav>
	</header>
	
	<article class="container-fluid">	
		<ul>

			<?php
			
			$parent_page = get_page_by_path('project')->ID;
			
			$args = array( 'posts_per_page' => -1 , 'post_type' => 'page', 'post_parent' => $parent_page);			
			$myposts = get_posts( $args );	
		
		
			foreach ( $myposts as $post ) : setup_postdata( $post ); 
					
				$term_list = wp_get_post_terms($post->ID, 'project-categories');
				
				foreach($term_list as $term) {
				
					$cat_string .= " project-cat-".$term->slug;
				
				} ?>
						
				<li class="<?php echo $cat_string; ?>">
					<div class="">
						<a href="<?php echo get_permalink(); ?>" class="popover-item" 
							<?php if(has_excerpt()) : ?>
								data-placement="bottom" tabindex="0" class="btn btn-lg btn-danger" role="button" data-toggle="popover" data-trigger="hover" title="<?php echo $post->post_title; ?>" data-content="<?php echo $post->post_excerpt; ?>"
							<?php endif; ?>
							>
							<h2 class="h<?php echo rand(2,6)?>"><?php echo $post->post_title; ?><small> - <?php echo get_the_date("Y"); ?></small></h2>
						</a>
					</div>
				
				</li>
				
				<?php $cat_string = ""; ?>
				
			<?php endforeach; ?>
			
			<?php wp_reset_postdata(); ?>
		</ul>
	</article>
</section>