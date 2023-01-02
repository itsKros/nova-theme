<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Nova_Theme
 */

?>

	<footer id="main-footer" class="site-footer bg-light py-4"> 

		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="site-info text-center">
						
						
							<?php
							/* translators: 1: Theme name, 2: Theme author. */
							printf( esc_html( '.All rights reserved. %1$s Copyright &copy;', 'nova-theme' ), 'Nova Theme');
							?>
					</div><!-- .site-info -->
				</div>
			</div>
		</div>
		
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
