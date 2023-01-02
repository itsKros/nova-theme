<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Nova_Theme
 */

get_header();
?>

<div class="container py-5">
	<div class="row">

		<div class="col-md-9 main"> 
			
			<main id="primary">

				<?php
				while ( have_posts() ) :
					the_post();

					get_template_part( 'template-parts/content', 'page' );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				endwhile; // End of the loop.
				?>

			</main><!-- #main -->
		</div><!-- .col-md-9 -->

		<div class="col-md-3 sidebar">
			<?php get_sidebar(); ?>
		</div><!-- .col-md-3 .sidebar-->
	</div> <!-- .row -->
</div> <!-- .contianer -->
<?php get_footer(); 
