<?php
defined( 'ABSPATH' ) or die();

/**
 * Class Lana_Blog_Customize
 */
class Lana_Blog_Customize{

	/**
	 * @param WP_Customize_Manager $wp_customize
	 */
	public static function register( $wp_customize ) {

		/**
		 * Site Identity
		 */
		$wp_customize->get_setting( 'custom_logo' )->transport = 'refresh';

		/**
		 * Display
		 * options
		 */
		$wp_customize->add_section( 'lana_blog_display', array(
			'title'      => __( 'Display', 'lana-blog' ),
			'priority'   => 35,
			'capability' => 'edit_theme_options'
		) );

		/** display - layout */
		$wp_customize->add_setting( 'lana_blog_display_layout', array(
			'default'           => 'wide',
			'sanitize_callback' => 'lana_blog_sanitize_display_layout',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options'
		) );

		$wp_customize->add_control( 'lana_blog_display_layout_select', array(
			'label'       => __( 'Display Layout', 'lana-blog' ),
			'section'     => 'lana_blog_display',
			'settings'    => 'lana_blog_display_layout',
			'type'        => 'select',
			'choices'     => array(
				'boxed' => __( 'Boxed', 'lana-blog' ),
				'wide'  => __( 'Wide', 'lana-blog' )
			),
			'description' => __( 'Select the body display layout', 'lana-blog' )
		) );

		/** display - navbar position */
		$wp_customize->add_setting( 'lana_blog_display_navbar_position', array(
			'default'           => 'header',
			'sanitize_callback' => 'lana_blog_sanitize_display_navbar_position',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options'
		) );

		$wp_customize->add_control( 'lana_blog_display_navbar_position_select', array(
			'label'       => __( 'Navbar Position', 'lana-blog' ),
			'section'     => 'lana_blog_display',
			'settings'    => 'lana_blog_display_navbar_position',
			'type'        => 'select',
			'choices'     => array(
				'header'  => __( 'in Header', 'lana-blog' ),
				'content' => __( 'in Content', 'lana-blog' )
			),
			'description' => __( 'Select the navbar position', 'lana-blog' )
		) );

		/**
		 * Header
		 * options
		 */
		$wp_customize->add_section( 'lana_blog_header', array(
			'title'      => __( 'Header', 'lana-blog' ),
			'priority'   => 36,
			'capability' => 'edit_theme_options'
		) );

		/** header - site title position */
		$wp_customize->add_setting( 'lana_blog_header_site_title_position', array(
			'default'           => 'center',
			'sanitize_callback' => 'lana_blog_sanitize_header_site_title_position',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options'
		) );

		$wp_customize->add_control( 'lana_blog_header_site_title_position_select', array(
			'label'       => __( 'Site Title Position', 'lana-blog' ),
			'section'     => 'lana_blog_header',
			'position'    => 9,
			'settings'    => 'lana_blog_header_site_title_position',
			'type'        => 'select',
			'choices'     => array(
				'left'   => __( 'Left', 'lana-blog' ),
				'center' => __( 'Center', 'lana-blog' )
			),
			'description' => __( 'Select the Site Title (or Logo) position', 'lana-blog' )
		) );

		/** header - search widget */
		$wp_customize->add_setting( 'lana_blog_header_search_widget', array(
			'default'           => '0',
			'sanitize_callback' => 'lana_blog_sanitize_header_search_widget',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options'
		) );

		$wp_customize->add_control( 'lana_blog_header_search_widget_select', array(
			'label'       => __( 'Search Widget', 'lana-blog' ),
			'section'     => 'lana_blog_header',
			'settings'    => 'lana_blog_header_search_widget',
			'type'        => 'select',
			'choices'     => array(
				'1' => __( 'Display', 'lana-blog' ),
				'0' => __( 'Hidden', 'lana-blog' )
			),
			'description' => __( 'The search widget always hidden when Site Title Position is center', 'lana-blog' )
		) );

		/**
		 * Footer
		 * options
		 */
		$wp_customize->add_section( 'lana_blog_footer', array(
			'title'      => __( 'Footer', 'lana-blog' ),
			'priority'   => 110,
			'capability' => 'edit_theme_options'
		) );

		/** footer - text */
		$wp_customize->add_setting( 'lana_blog_footer_text', array(
			'sanitize_callback' => 'sanitize_text_field',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options'
		) );

		$wp_customize->add_control( 'lana_blog_footer_text_text', array(
			'label'    => __( 'Footer Text', 'lana-blog' ),
			'section'  => 'lana_blog_footer',
			'settings' => 'lana_blog_footer_text',
			'type'     => 'text'
		) );

		/**
		 * Background Image
		 */
		$wp_customize->get_setting( 'background_image' )->transport = 'refresh';

		/** lana background image */
		$wp_customize->add_setting( 'lana_blog_background_image', array(
			'default'           => 'flowers',
			'sanitize_callback' => 'lana_blog_sanitize_background_image',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options'
		) );

		$wp_customize->add_control( 'lana_blog_background_image_select', array(
			'label'       => __( 'Lana Blog - Background Image', 'lana-blog' ),
			'section'     => 'background_image',
			'settings'    => 'lana_blog_background_image',
			'type'        => 'select',
			'choices'     => array(
				'games'   => __( 'games.png', 'lana-blog' ),
				'flowers' => __( 'flowers.png', 'lana-blog' ),
				'circles' => __( 'circles.png', 'lana-blog' ),
				'swirl'   => __( 'swirl.png', 'lana-blog' ),
				'waves'   => __( 'waves.png', 'lana-blog' )
			),
			'description' => __( 'Select the predefined body background image', 'lana-blog' )
		) );
	}
}

add_action( 'customize_register', array( 'Lana_Blog_Customize', 'register' ) );

/**
 * Sanitize
 * display - layout
 *
 * @param $value
 *
 * @return string
 */
function lana_blog_sanitize_display_layout( $value ) {

	$default_value     = 'wide';
	$acceptable_values = array( 'boxed', 'wide' );

	if ( ! in_array( $value, $acceptable_values ) ) {
		$value = $default_value;
	}

	return $value;
}

/**
 * Sanitize
 * dislay - navbar position
 *
 * @param $value
 *
 * @return string
 */
function lana_blog_sanitize_display_navbar_position( $value ) {

	$default_value     = 'header';
	$acceptable_values = array( 'header', 'content' );

	if ( ! in_array( $value, $acceptable_values ) ) {
		$value = $default_value;
	}

	return $value;
}

/**
 * Sanitize
 * header - site title position
 *
 * @param $value
 *
 * @return string
 */
function lana_blog_sanitize_header_site_title_position( $value ) {

	$default_value     = 'center';
	$acceptable_values = array( 'left', 'center' );

	if ( ! in_array( $value, $acceptable_values ) ) {
		$value = $default_value;
	}

	return $value;
}

/**
 * Sanitize
 * header - search widget
 *
 * @param $value
 *
 * @return string
 */
function lana_blog_sanitize_header_search_widget( $value ) {

	$default_value     = '0';
	$acceptable_values = array( '0', '1' );

	if ( ! in_array( $value, $acceptable_values ) ) {
		$value = $default_value;
	}

	return $value;
}

/**
 * Sanitize
 * background image
 *
 * @param $value
 *
 * @return string
 */
function lana_blog_sanitize_background_image( $value ) {

	$default_value     = 'flowers';
	$acceptable_values = array( 'games', 'flowers', 'circles', 'swirl', 'waves' );

	if ( ! in_array( $value, $acceptable_values ) ) {
		$value = $default_value;
	}

	return $value;
}

/**
 * Add predefined background image to body class
 *
 * @param $classes
 *
 * @return array
 */
function lana_blog_theme_customize_body_class( $classes ) {

	/** check theme mod */
	if ( get_theme_mod( 'background_image', '' ) != '' ) {
		return $classes;
	}

	/** add lana predefined background image */
	return array_merge( $classes, array(
		'lana-background-image',
		get_theme_mod( 'lana_blog_background_image', 'flowers' )
	) );
}

add_filter( 'body_class', 'lana_blog_theme_customize_body_class', 1000 );

/**
 * Add theme customize display layout to main navbar
 *
 * @param $classes
 *
 * @return array
 */
function lana_blog_theme_customize_display_layout_class_to_main_navbar( $classes ) {

	if ( get_theme_mod( 'lana_blog_display_layout', 'wide' ) == 'wide' ) {
		$classes[] = 'wide-navigation';
	}

	if ( get_theme_mod( 'lana_blog_display_layout', 'wide' ) == 'boxed' ) {
		$classes[] = 'boxed-navigation';
	}

	return $classes;
}

add_filter( 'lana_blog_main_navbar_in_header_class', 'lana_blog_theme_customize_display_layout_class_to_main_navbar' );
add_filter( 'lana_blog_main_navbar_in_content_class', 'lana_blog_theme_customize_display_layout_class_to_main_navbar' );

/**
 * Add theme customize display layout to main navbar
 *
 * @param $classes
 *
 * @return array
 */
function lana_blog_theme_customize_display_layout_class_to_main_navbar_in_content_container( $classes ) {

	if ( get_theme_mod( 'lana_blog_display_layout', 'wide' ) == 'wide' ) {
		$classes[] = 'container';
	}

	if ( get_theme_mod( 'lana_blog_display_layout', 'wide' ) == 'boxed' ) {
		$classes[] = 'without-container';
	}

	return $classes;
}

add_filter( 'lana_blog_main_navbar_in_content_container_class', 'lana_blog_theme_customize_display_layout_class_to_main_navbar_in_content_container' );

/**
 * Add theme customize display layout to main container
 *
 * @param $classes
 *
 * @return array
 */
function lana_blog_theme_customize_display_layout_class_to_main_container( $classes ) {

	if ( get_theme_mod( 'lana_blog_display_layout', 'wide' ) == 'wide' ) {
		$classes[] = 'main-wide';
	}

	if ( get_theme_mod( 'lana_blog_display_layout', 'wide' ) == 'boxed' ) {
		$classes[] = 'main-boxed';
		$classes[] = 'container';
	}

	return $classes;
}

add_filter( 'lana_blog_main_container_class', 'lana_blog_theme_customize_display_layout_class_to_main_container' );

/**
 * Add theme customize display layout to header container
 *
 * @param $classes
 *
 * @return array
 */
function lana_blog_theme_customize_display_layout_class_to_header_container( $classes ) {

	if ( get_theme_mod( 'lana_blog_display_layout', 'wide' ) == 'wide' ) {
		$classes[] = 'container';
	}

	if ( get_theme_mod( 'lana_blog_display_layout', 'wide' ) == 'boxed' ) {
		$classes[] = 'boxed';
	}

	return $classes;
}

add_filter( 'lana_blog_header_container_class', 'lana_blog_theme_customize_display_layout_class_to_header_container' );

/**
 * Add theme customize header position to header site title container
 *
 * @param $classes
 *
 * @return array
 */
function lana_blog_theme_customize_header_site_title_position_class_to_header_site_title_container( $classes ) {

	if ( get_theme_mod( 'lana_blog_header_site_title_position', 'center' ) == 'left' ) {
		$classes[] = 'col-md-6';
	}

	if ( get_theme_mod( 'lana_blog_header_site_title_position', 'center' ) == 'center' ) {
		$classes[] = 'col-md-12';
		$classes[] = 'text-center';
	}

	return $classes;
}

add_filter( 'lana_blog_header_site_title_container_class', 'lana_blog_theme_customize_header_site_title_position_class_to_header_site_title_container' );

/**
 * Add theme customize display navbar position to breadcrumb container
 *
 * @param $classes
 *
 * @return array
 */
function lana_blog_theme_customize_display_navbar_position_class_to_breadcrumb_container( $classes ) {

	if ( get_theme_mod( 'display_navbar_position', 'header' ) == 'header' ) {
		$classes[] = 'breadcrumb-border';
	}

	return $classes;
}

add_filter( 'lana_blog_breadcrumb_container_class', 'lana_blog_theme_customize_display_navbar_position_class_to_breadcrumb_container' );

/**
 * Add theme customize display layout to breadcrumb container inner
 *
 * @param $classes
 *
 * @return array
 */
function lana_blog_theme_customize_display_layout_class_to_breadcrumb_container_inner( $classes ) {

	if ( get_theme_mod( 'lana_blog_display_layout', 'wide' ) == 'wide' ) {
		$classes[] = 'container';
	}

	if ( get_theme_mod( 'lana_blog_display_layout', 'wide' ) == 'boxed' ) {
		$classes[] = 'boxed';
	}

	return $classes;
}

add_filter( 'lana_blog_breadcrumb_container_inner_class', 'lana_blog_theme_customize_display_layout_class_to_breadcrumb_container_inner' );

/**
 * Add theme customize display layout to main content container
 *
 * @param $classes
 *
 * @return array
 */
function lana_blog_theme_customize_display_layout_class_to_main_content_container( $classes ) {

	if ( get_theme_mod( 'lana_blog_display_layout', 'wide' ) == 'wide' ) {
		$classes[] = 'wide-content';
		$classes[] = 'container';
	}

	if ( get_theme_mod( 'lana_blog_display_layout', 'wide' ) == 'boxed' ) {
		$classes[] = 'boxed-content';
		$classes[] = 'container-fluid';
	}

	return $classes;
}

add_filter( 'lana_blog_main_content_container_class', 'lana_blog_theme_customize_display_layout_class_to_main_content_container' );

/**
 * Add theme customize display layout to pre footer
 *
 * @param $classes
 *
 * @return array
 */
function lana_blog_theme_customize_display_layout_class_to_pre_footer( $classes ) {

	if ( get_theme_mod( 'lana_blog_display_layout', 'wide' ) == 'boxed' ) {
		$classes[] = 'boxed';
	}

	return $classes;
}

add_filter( 'lana_blog_pre_footer_class', 'lana_blog_theme_customize_display_layout_class_to_pre_footer' );