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

		<div class="col-md-12 main"> 
			
			<main id="primary">

				<?php woocommerce_content(); ?>

			</main><!-- #main -->
		</div><!-- .col-md-9 -->
    </div> <!-- .row -->
</div> <!-- .contianer -->
<?php get_footer(); 
