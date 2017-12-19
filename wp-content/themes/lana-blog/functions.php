<?php
defined( 'ABSPATH' ) or die();
define( 'LANA_BLOG_VERSION', '1.1.2' );

/**
 * include
 * other functions
 */
include_once get_template_directory() . '/functions/lana-menu.php';
include_once get_template_directory() . '/functions/lana-tgm.php';
include_once get_template_directory() . '/functions/lana-theme.php';
include_once get_template_directory() . '/functions/lana-theme-customizer.php';

/**
 * Language
 * load
 */
load_theme_textdomain( 'lana-blog', get_template_directory() . '/languages' );

/**
 * Setup
 * add theme support functions
 */
function lana_blog_after_setup_theme() {

	add_theme_support( 'title-tag' );
	add_theme_support( 'automatic-feed-links' );

	/** post */
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'post-formats', array( 'aside', 'gallery', 'image', 'quote', 'video', 'status', 'link' ) );

	/** customizer */
	add_theme_support( 'custom-background' );
	add_theme_support( 'custom-logo' );
}

add_action( 'after_setup_theme', 'lana_blog_after_setup_theme' );

/**
 * Content width
 */
function lana_blog_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'lana_blog_content_width', 1140 );
}

add_action( 'after_setup_theme', 'lana_blog_content_width', 0 );

/**
 * Styles
 * load in theme
 */
function lana_blog_styles() {

	wp_enqueue_style( 'lana-blog-style', get_stylesheet_uri() );

	wp_register_style( 'pacifico-google-fonts', 'https://fonts.googleapis.com/css?family=Pacifico' );
	wp_enqueue_style( 'pacifico-google-fonts' );

	wp_register_style( 'animate', get_template_directory_uri() . '/css/animate.min.css', array(), '3.5.0' );
	wp_enqueue_style( 'animate' );

	wp_register_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.6.3' );
	wp_enqueue_style( 'font-awesome' );

	wp_register_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.3.7' );
	wp_enqueue_style( 'bootstrap' );

	wp_register_style( 'bootstrap-theme', get_template_directory_uri() . '/css/bootstrap-theme.min.css', array(), '3.3.7' );
	wp_enqueue_style( 'bootstrap-theme' );

	wp_register_style( 'ie10-viewport-bug-workaround', get_template_directory_uri() . '/css/ie10-viewport-bug-workaround.css', array(), '1.0.0' );
	wp_enqueue_style( 'ie10-viewport-bug-workaround' );

	wp_register_style( 'lana-blog-theme', get_template_directory_uri() . '/css/lana-blog-theme.min.css', array(), LANA_BLOG_VERSION );
	wp_enqueue_style( 'lana-blog-theme' );
}

add_action( 'wp_enqueue_scripts', 'lana_blog_styles' );

/**
 * Print styles
 * load in theme
 */
function lana_blog_print_styles() {

	wp_enqueue_style( 'lana-blog-print-style', get_template_directory_uri() . '/css/print-style.min.css', array(), LANA_BLOG_VERSION, 'print' );
}

add_action( 'wp_enqueue_scripts', 'lana_blog_print_styles' );

/**
 * Lana Blog
 * add editor style
 */
function lana_blog_add_editor_style() {
	add_editor_style( get_template_directory_uri() . '/css/bootstrap.min.css' );
	add_editor_style( get_template_directory_uri() . '/css/editor-style.css' );
}

add_action( 'init', 'lana_blog_add_editor_style' );

/**
 * JavaScript
 * load in theme
 */
function lana_blog_scripts() {

	/** bootstrap js */
	wp_register_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), '3.3.7' );
	wp_enqueue_script( 'bootstrap' );

	/** ie10 viewport bug workaround js */
	wp_register_script( 'ie10-viewport-bug-workaround', get_template_directory_uri() . '/js/ie10-viewport-bug-workaround.js', array( 'jquery' ), '1.0.0', true );
	wp_enqueue_script( 'ie10-viewport-bug-workaround' );

	/** respond js */
	wp_register_script( 'respond', get_template_directory_uri() . '/js/respond.min.js', array( 'jquery' ), '1.4.2' );
	wp_enqueue_script( 'respond' );

	/** comment reply */
	if ( is_singular() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'lana_blog_scripts' );

/**
 * WordPress Widgets
 * load in theme
 */
function lana_blog_register_sidebar() {

	register_sidebar( array(
		'id'            => 'primary',
		'name'          => __( 'Main Sidebar', 'lana-blog' ),
		'description'   => __( 'This is the primary in right (or left) sidebar', 'lana-blog' ),
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
		'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
		'after_widget'  => '</div><hr/>'
	) );

	register_sidebar( array(
		'id'            => 'home-top',
		'name'          => __( 'Home Top Sidebar', 'lana-blog' ),
		'description'   => __( 'This is the sidebar in home top', 'lana-blog' ),
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
		'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
		'after_widget'  => '</div><br/>'
	) );

	register_sidebar( array(
		'id'            => 'footer-left',
		'name'          => __( 'Left Footer', 'lana-blog' ),
		'description'   => __( 'footer.php', 'lana-blog' ),
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
		'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
		'after_widget'  => '</div><br/>'
	) );

	register_sidebar( array(
		'id'            => 'footer-middle',
		'name'          => __( 'Middle Footer', 'lana-blog' ),
		'description'   => __( 'footer.php', 'lana-blog' ),
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
		'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
		'after_widget'  => '</div><br/>'
	) );

	register_sidebar( array(
		'id'            => 'footer-right',
		'name'          => __( 'Right Footer', 'lana-blog' ),
		'description'   => __( 'footer.php', 'lana-blog' ),
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
		'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
		'after_widget'  => '</div><br/>'
	) );
}

add_action( 'widgets_init', 'lana_blog_register_sidebar' );
