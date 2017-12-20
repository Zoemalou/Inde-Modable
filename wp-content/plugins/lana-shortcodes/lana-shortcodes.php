<?php
/**
 * Plugin Name: Lana Shortcodes
 * Plugin URI: http://lana.codes/lana-product/lana-shortcodes/
 * Description: Shortcodes with Bootstrap 3.
 * Version: 1.0.9
 * Author: Lana Codes
 * Author URI: http://lana.codes/
 * Text Domain: lana-shortcodes
 * Domain Path: /languages
 */

defined( 'ABSPATH' ) or die();
define( 'LANA_SHORTCODES_VERSION', '1.0.9' );

/**
 * Language
 * load
 */
load_plugin_textdomain( 'lana-shortcodes', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );

/**
 * Add plugin action links
 *
 * @param $links
 *
 * @return mixed
 */
function lana_shortcodes_add_plugin_action_links( $links ) {
	$settings_link = '<a href="options-general.php?page=lana-shortcodes-settings.php">' . __( 'Settings', 'lana-shortcodes' ) . '</a>';
	array_unshift( $links, $settings_link );

	return $links;
}

add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'lana_shortcodes_add_plugin_action_links' );

/**
 * Styles
 * load in plugin
 */
function lana_shortcodes_admin_styles() {

	wp_register_style( 'lana-shortcodes-icons', plugin_dir_url( __FILE__ ) . '/assets/css/lana-shortcodes-icons.min.css', array(), LANA_SHORTCODES_VERSION );
	wp_enqueue_style( 'lana-shortcodes-icons' );
}

add_action( 'admin_enqueue_scripts', 'lana_shortcodes_admin_styles' );

/**
 * Styles
 * load in plugin
 */
function lana_shortcodes_styles() {

	if ( ! wp_style_is( 'bootstrap' ) && get_option( 'lana_shortcodes_bootstrap_load', '' ) == 'normal' ) {

		wp_register_style( 'bootstrap', plugin_dir_url( __FILE__ ) . '/assets/css/bootstrap.min.css', array(), '3.3.5' );
		wp_enqueue_style( 'bootstrap' );
	}
}

add_action( 'wp_enqueue_scripts', 'lana_shortcodes_styles', 1000 );

/**
 * JavaScript
 * load in plugin
 */
function lana_shortcodes_scripts() {

	if ( ! wp_script_is( 'bootstrap' ) && get_option( 'lana_shortcodes_bootstrap_load', '' ) == 'normal' ) {

		/** bootstrap js */
		wp_register_script( 'bootstrap', plugin_dir_url( __FILE__ ) . '/assets/js/bootstrap.min.js', array( 'jquery' ), '3.3.5' );
		wp_enqueue_script( 'bootstrap' );
	}
}

add_action( 'wp_enqueue_scripts', 'lana_shortcodes_scripts', 1000 );

/**
 * Lana Shortcodes
 * add settings page
 */
function lana_shortcodes_admin_menu() {
	add_options_page( __( 'Lana Shortcodes Settings', 'lana-shortcodes' ), __( 'Lana Shortcodes', 'lana-shortcodes' ), 'manage_options', 'lana-shortcodes-settings.php', 'lana_shortcodes_settings_page' );

	/** call register settings function */
	add_action( 'admin_init', 'lana_shortcodes_register_settings' );
}

add_action( 'admin_menu', 'lana_shortcodes_admin_menu' );

/**
 * Register settings
 */
function lana_shortcodes_register_settings() {
	register_setting( 'lana-shortcodes-settings-group', 'lana_shortcodes_bootstrap_load' );
}

/**
 * Lana Shortcodes Settings page
 */
function lana_shortcodes_settings_page() {
	?>
    <div class="wrap">
        <h2><?php _e( 'Lana Shortcodes Settings', 'lana-shortcodes' ); ?></h2>
        <hr/>
        <a href="<?php echo esc_url( 'http://lana.codes/' ); ?>" target="_blank">
            <img src="<?php echo esc_url( plugin_dir_url( __FILE__ ) . '/assets/img/plugin-header.png' ); ?>"
                 alt="<?php esc_attr_e( 'Lana Codes', 'lana-shortcodes' ); ?>">
        </a>
        <hr/>

        <form method="post" action="options.php">
			<?php settings_fields( 'lana-shortcodes-settings-group' ); ?>

            <h2 class="title"><?php _e( 'Frontend Settings', 'lana-shortcodes' ); ?></h2>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">
                        <label for="lana_shortcodes_bootstrap_load">
							<?php _e( 'Bootstrap Load', 'lana-shortcodes' ); ?>
                        </label>
                    </th>
                    <td>
                        <select name="lana_shortcodes_bootstrap_load" id="lana_shortcodes_bootstrap_load">
                            <option value=""
								<?php selected( get_option( 'lana_shortcodes_bootstrap_load', '' ), '' ); ?>>
								<?php _e( 'None', 'lana-shortcodes' ); ?>
                            </option>
                            <option value="normal"
								<?php selected( get_option( 'lana_shortcodes_bootstrap_load', '' ), 'normal' ); ?>>
								<?php _e( 'Normal Bootstrap', 'lana-shortcodes' ); ?>
                            </option>
                        </select>
                    </td>
                </tr>
            </table>

            <p class="submit">
                <input type="submit" class="button-primary"
                       value="<?php esc_attr_e( 'Save Changes', 'lana-shortcodes' ); ?>"/>
            </p>

        </form>
    </div>
	<?php
}

/**
 * Lana Button Shortcode
 * with Bootstrap
 *
 * @param $atts
 * @param null $content
 *
 * @return string
 */
function lana_button_shortcode( $atts, $content = null ) {

	$a = shortcode_atts( array(
		'size' => 'md',
		'type' => 'default',
		'href' => '#'
	), $atts );

	$btn_classes = array( 'btn', 'btn-' . $a['size'], 'btn-' . $a['type'] );

	/**
	 * Output
	 */
	$output = sprintf( '<a class="%s" href="%s">', implode( ' ', $btn_classes ), esc_url( $a['href'] ) );
	$output .= $content;
	$output .= '</a>';

	return $output;
}

add_shortcode( 'lana_button', 'lana_button_shortcode' );

/**
 * Lana Icon Shortcode
 * with Bootstrap
 *
 * @param $atts
 *
 * @return string
 */
function lana_icon_shortcode( $atts ) {

	$a = shortcode_atts( array(
		'name' => ''
	), $atts );

	/** validate icon */
	if ( empty( $a['name'] ) ) {
		return '';
	}

	$icon_classes = array( 'glyphicon', 'glyphicon-' . $a['name'] );

	/**
	 * Output
	 */
	$output = sprintf( '<span class="%s">', implode( ' ', $icon_classes ) );
	$output .= '</span>';

	return $output;
}

add_shortcode( 'lana_icon', 'lana_icon_shortcode' );

/**
 * Lana Label Shortcode
 * with Bootstrap
 *
 * @param $atts
 * @param null $content
 *
 * @return string
 */
function lana_label_shortcode( $atts, $content = null ) {

	$a = shortcode_atts( array(
		'type' => 'default'
	), $atts );

	$label_classes = array( 'label', 'label-' . $a['type'] );

	/**
	 * Output
	 */
	$output = sprintf( '<span class="%s">', implode( ' ', $label_classes ) );
	$output .= $content;
	$output .= '</span>';

	return $output;
}

add_shortcode( 'lana_label', 'lana_label_shortcode' );

/**
 * Lana Badges Shortcode
 * with Bootstrap
 *
 * @param $atts
 * @param null $content
 *
 * @return string
 */
function lana_badges_shortcode( $atts, $content = null ) {

	/**
	 * Output
	 */
	$output = '<span class="badge">';
	$output .= $content;
	$output .= '</span>';

	return $output;
}

add_shortcode( 'lana_badges', 'lana_badges_shortcode' );

/**
 * Lana Progress Bar Shortcode
 * with Bootstrap
 *
 * @param $atts
 *
 * @return string
 */
function lana_progress_bar_shortcode( $atts ) {

	$a = shortcode_atts( array(
		'value'   => '0',
		'type'    => '',
		'label'   => '',
		'striped' => '',
		'active'  => ''
	), $atts );

	$a['value'] = intval( $a['value'] );

	/**
	 * Progress bar
	 */
	if ( ! empty( $a['type'] ) ) {
		$a['type'] = 'progress-bar-' . $a['type'];
	}

	if ( ! empty( $a['striped'] ) ) {
		$a['striped'] = 'progress-bar-striped';
	}

	if ( ! empty( $a['active'] ) ) {
		$a['active'] = 'active';
	}

	$progress_bar_classes = array( 'progress-bar', $a['type'], $a['striped'], $a['active'] );

	/**
	 * Label
	 */
	if ( 'hidden' == $a['label'] ) {
		$a['label'] = 'sr-only';
	} else {
		$a['label'] = '';
	}

	$label_classes = array( $a['label'] );

	/**
	 * Output
	 */
	$output = '<div class="progress">';
	$output .= sprintf( '<div class="%s" role="progressbar" aria-valuenow="%d" aria-valuemin="0" aria-valuemax="100" style="width: %s;">', implode( ' ', $progress_bar_classes ), $a['value'], $a['value'] . '%' );
	$output .= sprintf( '<span class="%s">', implode( ' ', $label_classes ) );
	$output .= $a['value'] . '%';
	$output .= '</span>';
	$output .= '</div>';
	$output .= '</div>';

	return $output;
}

add_shortcode( 'lana_progress_bar', 'lana_progress_bar_shortcode' );

/**
 * TinyMCE
 * Register Plugins
 *
 * @param $plugins
 *
 * @return mixed
 */
function lana_shortcodes_add_mce_plugin( $plugins ) {

	$plugins['lana_button']       = plugin_dir_url( __FILE__ ) . '/assets/js/button.js';
	$plugins['lana_icon']         = plugin_dir_url( __FILE__ ) . '/assets/js/icon.js';
	$plugins['lana_label']        = plugin_dir_url( __FILE__ ) . '/assets/js/label.js';
	$plugins['lana_badges']       = plugin_dir_url( __FILE__ ) . '/assets/js/badges.js';
	$plugins['lana_progress_bar'] = plugin_dir_url( __FILE__ ) . '/assets/js/progress_bar.js';

	return $plugins;
}

/**
 * TinyMCE
 * Register Buttons
 *
 * @param $buttons
 *
 * @return mixed
 */
function lana_shortcodes_add_mce_button( $buttons ) {

	array_push( $buttons, 'lana_button' );
	array_push( $buttons, 'lana_icon' );
	array_push( $buttons, 'lana_label' );
	array_push( $buttons, 'lana_badges' );
	array_push( $buttons, 'lana_progress_bar' );

	return $buttons;
}

/**
 * TinyMCE
 * Add Custom Buttons
 */
function lana_shortcodes_add_mce_shortcodes_buttons() {
	add_filter( 'mce_external_plugins', 'lana_shortcodes_add_mce_plugin' );
	add_filter( 'mce_buttons_3', 'lana_shortcodes_add_mce_button' );
}

add_action( 'init', 'lana_shortcodes_add_mce_shortcodes_buttons' );
