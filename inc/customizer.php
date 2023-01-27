<?php
/**
 * Nova Theme Theme Customizer
 *
 * @package Nova_Theme
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function nova_theme_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'nova_theme_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'nova_theme_customize_partial_blogdescription',
			)
		);



		
	}


	


}
add_action( 'customize_register', 'nova_theme_customize_register' );


function nt__customize_register( $wp_customize ) {

	// Create our panels
	
	$wp_customize->add_panel( 'additional_code', array(
		'priority'       => 100,
		'title'          => __('Additional Code', 'nova_theme'),
	) );
			
	// Create our sections
	
	$wp_customize->add_section( 'custom_js_section' , array(
		'title'             => __('Custom JavaScript', 'nova_theme'),
		'priority'          => 1,
		'panel'             => 'additional_code',
	) );
			
	// Create our settings
	
	$wp_customize->add_setting( 'custom_js' , array(
		'type'          => 'theme_mod',
		'transport'     => 'refresh',
	) );
	$wp_customize->add_control( 'custom_js_control', array(
		'section'    => 'custom_js_section',
		'settings'   => 'custom_js',
		'type'       => 'code',
	) );
			
	}
	add_action( 'customize_register', 'nt__customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function nova_theme_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function nova_theme_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function nova_theme_customize_preview_js() {
	wp_enqueue_script( 'nova-theme-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), _S_VERSION, true );
}
add_action( 'customize_preview_init', 'nova_theme_customize_preview_js' );
