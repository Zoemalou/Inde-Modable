<?php
defined( 'ABSPATH' ) or die();

/**
 * Bootstrap menu
 * Scripts
 */
function lana_blog_menu_scripts() {

	/** jquery smartmenus */
	wp_register_script( 'smartmenus', get_template_directory_uri() . '/js/smartmenus.min.js', array( 'jquery' ), '1.0.0', true );
	wp_enqueue_script( 'smartmenus' );

	/** jquery smartmenus bootstrap addons */
	wp_register_script( 'smartmenus-bootstrap', get_template_directory_uri() . '/js/smartmenus-bootstrap.min.js', array( 'jquery' ), '1.0.0', true );
	wp_enqueue_script( 'smartmenus-bootstrap' );
}

add_action( 'wp_enqueue_scripts', 'lana_blog_menu_scripts' );

/**
 * Bootstrap menu
 * Styles
 */
function lana_blog_menu_styles() {

	/** jquery smartmenus bootstrap addons */
	wp_register_style( 'smartmenus-bootstrap', get_template_directory_uri() . '/css/smartmenus-bootstrap.min.css', array(), '1.0.0' );
	wp_enqueue_style( 'smartmenus-bootstrap' );
}

add_action( 'wp_enqueue_scripts', 'lana_blog_menu_styles' );

/**
 * Lana Main Navigation Menu
 * with Bootstrap
 *
 * @param array $args
 */
function lana_blog_main_nav_menu( $args = array() ) {

	$args = array_merge( array(
		'theme_location' => 'lana_main',
		'menu_class'     => 'nav navbar-nav',
		'container'      => false,
		'walker'         => new Lana_Blog_Walker_Nav_Menu()
	), $args );

	wp_nav_menu( $args );
}

register_nav_menu( 'lana_main', __( 'Lana Main Menu', 'lana-blog' ) );

/**
 * Add empty menu hidden class to main navbar
 *
 * @param $classes
 *
 * @return array
 */
function lana_blog_empty_menu_hidden_class_to_main_navbar( $classes ) {

	$theme_locations = get_nav_menu_locations();


	/** check theme locations */
	if ( ! isset( $theme_locations['lana_main'] ) ) {
		return $classes;
	}

	$lana_menu = get_term( $theme_locations['lana_main'], 'nav_menu' );

	/** check theme location */
	if ( is_wp_error( $lana_menu ) ) {
		return $classes;
	}

	$nav_menu_items = wp_get_nav_menu_items( $lana_menu->slug );

	if ( is_a( $lana_menu, 'WP_Term' ) && empty( $nav_menu_items ) ) {
		$classes[] = 'hidden';
	}

	return $classes;
}

add_filter( 'lana_blog_main_navbar_in_header_class', 'lana_blog_empty_menu_hidden_class_to_main_navbar' );
add_filter( 'lana_blog_main_navbar_in_content_class', 'lana_blog_empty_menu_hidden_class_to_main_navbar' );


/**
 * Lana Nav Walker
 * with Bootstrap
 */
class Lana_Blog_Walker_Nav_Menu extends Walker_Nav_Menu{

	/**
	 * Starts the list before the elements are added.
	 *
	 * @param string $output
	 * @param int $depth
	 * @param array $args
	 */
	function start_lvl( &$output, $depth = 0, $args = array() ) {

		$indent = str_repeat( "\t", $depth );

		$classes = array( 'dropdown-menu', 'animated', 'slideInUp', 'depth_' . $depth );

		$class_names = join( ' ', apply_filters( 'nav_children_element_css_class', array_filter( $classes ), $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		$output .= $indent . '<ul' . $class_names . '>';
	}

	/**
	 * Starts the element output.
	 *
	 * @param string $output
	 * @param object $item
	 * @param int $depth
	 * @param object|array $args
	 * @param int $id
	 */
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

		/**
		 * Filter
		 * args
		 */
		$args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );

		/**
		 * Indent
		 */
		$indent = '';

		if ( $depth ) {
			$indent = str_repeat( "\t", $depth );
		}

		/**
		 * <li> tag
		 * attributes
		 */
		$classes = array();

		if ( ! empty( $item->classes ) ) {
			$classes = (array) $item->classes;
		}

		$classes[] = 'menu-item-' . $item->ID;

		if ( $item->current || $item->current_item_ancestor ) {
			$classes[] = 'active';
		}

		/**
		 * <li> tag - classes
		 * filters the CSS class(es)
		 */
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		/**
		 * <li> tag - id
		 * filters the ID
		 */
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $class_names . '>';

		/**
		 * <a> tag
		 * attributes
		 */
		$atts = array();

		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target ) ? $item->target : '';
		$atts['rel']    = ! empty( $item->xfn ) ? $item->xfn : '';
		$atts['href']   = ! empty( $item->url ) ? $item->url : '';

		/**
		 * <a> tag
		 * attributes filter
		 */
		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value      = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		/**
		 * Filter
		 * title
		 */
		$title = apply_filters( 'the_title', $item->title, $item->ID );
		$title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

		$item_output = $args->before;
		$item_output .= '<a' . $attributes . '>';
		$item_output .= $args->link_before . $title . $args->link_after;

		if ( isset( $args->walker->has_children ) && $args->walker->has_children ) {
			$item_output .= ' <span class="caret"></span> ';
		}

		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	/**
	 * Fallback function
	 * to: fallback_cb
	 *
	 * @param $args
	 */
	public static function fallback( $args ) {

		$output = '';

		$list_args = $args;

		/** home */
		$class = '';

		if ( is_front_page() && ! is_paged() ) {
			$class = ' class="active"';
		}

		$output .= '<li' . $class . '><a href="' . esc_url( home_url( '/' ) ) . '">' . $args['link_before'] . __( 'Home', 'lana-blog' ) . $args['link_after'] . '</a></li>';

		/** If the front page is a page, add it to the exclude list */
		if ( get_option( 'show_on_front' ) == 'page' ) {
			if ( ! empty( $list_args['exclude'] ) ) {
				$list_args['exclude'] .= ',';
			} else {
				$list_args['exclude'] = '';
			}
			$list_args['exclude'] .= get_option( 'page_on_front' );
		}

		/** pages */
		$output .= wp_list_pages( array( 'echo' => false, 'depth' => 1, 'title_li' => '' ) );

		/** add a menu in admin */
		if ( current_user_can( 'manage_options' ) ) {
			$output .= '<li class="pull-right"><a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '">' . $args['link_before'] . __( 'Add a menu', 'lana-blog' ) . $args['link_after'] . ' <span class="label label-right label-default">' . __( 'admin', 'lana-blog' ) . '</span></a></li>';
		}

		$container = 'ul';

		$attrs = '';
		if ( ! empty( $args['menu_id'] ) ) {
			$attrs .= ' id="' . esc_attr( $args['menu_id'] ) . '"';
		}

		if ( ! empty( $args['menu_class'] ) ) {
			$attrs .= ' class="' . esc_attr( $args['menu_class'] ) . '"';
		}

		$output = '<' . $container . $attrs . '>' . $output . '</' . $container . '>';

		echo $output;
	}
}