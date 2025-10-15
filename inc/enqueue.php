<?php
/**
 * Understrap enqueue scripts
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'understrap_scripts' ) ) {
	/**
	 * Load theme's JavaScript and CSS sources.
	 */
	function understrap_scripts() {
		// Get the theme data.
		$the_theme         = wp_get_theme();
		$theme_version     = $the_theme->get( 'Version' );
		$bootstrap_version = get_theme_mod( 'understrap_bootstrap_version', 'bootstrap4' );
		$suffix            = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		// Grab asset urls.
		$theme_styles  = "/css/theme{$suffix}.css";
		$theme_scripts = "/js/theme{$suffix}.js";
		if ( 'bootstrap4' === $bootstrap_version ) {
			$theme_styles  = "/css/theme-bootstrap4{$suffix}.css";
			$theme_scripts = "/js/theme-bootstrap4{$suffix}.js";
		}

		$css_version = $theme_version . '.' . filemtime( get_template_directory() . $theme_styles );
		wp_enqueue_style( 'understrap-styles', get_template_directory_uri() . $theme_styles, array(), $css_version );

		wp_enqueue_script( 'jquery' );

		$js_version = $theme_version . '.' . filemtime( get_template_directory() . $theme_scripts );
		wp_enqueue_script( 'understrap-scripts', get_template_directory_uri() . $theme_scripts, array(), $js_version, true );
		wp_localize_script( 'understrap-scripts', 'myAjax', array( 
			'ajaxurl' => admin_url( 'admin-ajax.php' ), 
			'homeurl' => get_bloginfo("url")
		));
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
		wp_enqueue_style( 'owl-styles', get_template_directory_uri() .'/owl/owl.carousel.min.css', array(), $css_version );
		wp_enqueue_style( 'owl-default-styles', get_template_directory_uri() . '/owl/owl.theme.default.min.css', array(), $css_version );
		wp_enqueue_style( 'lightbox-styles', 'https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.10.0/css/lightbox.min.css', array(), $css_version );
		wp_enqueue_script( 'owl-scripts', get_template_directory_uri() . '/owl/owl.carousel.min.js', array(), $js_version, true );
		wp_enqueue_script( 'owl-scripts', get_template_directory_uri() . '/owl/owl.carousel.custom.js', array(), $js_version, true );
		wp_enqueue_script( 'alpine', 'https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js', array(), $js_version, true );

		wp_enqueue_script( 'lightbox-scripts', 'https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.10.0/js/lightbox.min.js', array(), $js_version, true );
	}
} // End of if function_exists( 'understrap_scripts' ).

add_action( 'wp_enqueue_scripts', 'understrap_scripts' );
