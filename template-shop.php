<?php
/**
* Template Name:  Shop Page
*/

get_header();
?>

<div class="container py-5">
	<div class="row">

		<div class="col-md-12 main"> 
			
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

		
	

		
	</div> <!-- .row -->
</div> <!-- .contianer -->
<?php get_footer(); 
