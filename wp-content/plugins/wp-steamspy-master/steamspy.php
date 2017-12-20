<?php

/*
Plugin Name: SteamSpy
Description: Displays information from SteamSpy.
Version:     1.0
Author:      Dan Ruscoe
Author URI:  https://ruscoe.org/
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: steamspy
Domain Path: /languages
*/

define( 'STEAMSPY__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

require_once( STEAMSPY__PLUGIN_DIR . 'class.steamspy-widget.php' );

/**
 * Includes CSS stylesheet for the SteamSpy widget.
 */
function steamspy_include_stylesheet() {
  wp_register_style( 'steamspy_css', plugins_url( 'style.css', __FILE__ ) );
  wp_enqueue_style( 'steamspy_css' );
}

add_action( 'init', 'steamspy_include_stylesheet' );
