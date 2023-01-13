<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Nova_Theme
 */

?>
<!doctype html>
<html <?php language_attributes(); ?> dir="rtl">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'nova-theme' ); ?></a>

	<header id="main-header">
		<nav id="main-menu" class="navbar navbar-expand-lg navbar-light bg-light">
			<div class="container">

				
				<a class="navbar-brand" href="/">
					<img src="<?php  echo esc_url( get_template_directory_uri() );?>/inc/assets/img/logo.png" alt="Nova Theme" title="Nova Theme">
				</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<?php
				if ( has_nav_menu( 'header-menu' ) ) {
					wp_nav_menu( array(
						'theme_location'    => 'header-menu',
						'depth'             => 2,
						'container'         => 'div',
						'container_class'   => 'collapse navbar-collapse',
						'container_id'      => 'navbarNav',
						'menu_class'        => 'navbar-nav',
						'link_before'    	=> '<span>',
						'link_after'     	=> '</span>',
						'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
						'walker'            => new WP_Bootstrap_Navwalker(),
					) );
				}
				?>
				
			</div> <!-- #main-menu > .container-fluid-->
		</nav> <!-- #main-menu -->
	</header><!-- #main-header -->
