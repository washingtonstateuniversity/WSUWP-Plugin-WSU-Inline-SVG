<?php
/*
Plugin Name: WSU Inline SVG
Version: 0.0.1
Description: A shortcode for embedding inline SVGs in WordPress.
Author: washingtonstateuniversity, jeremyfelt
Author URI: https://web.wsu.edu/
Plugin URI: https://github.com/washingtonstateuniversity/WSUWP-Plugin-WSU-Inline-SVG
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// The core plugin class.
require dirname( __FILE__ ) . '/includes/class-wsu-inline-svg.php';

add_action( 'after_setup_theme', 'WSU_Inline_SVG' );
/**
 * Start things up.
 *
 * @return \WSU_Inline_SVG
 */
function WSU_Inline_SVG() {
	return WSU_Inline_SVG::get_instance();
}
