<?php

/**
 * Class Lana_Panel_Widget
 * with TinyMCE editor
 * with Bootstrap
 */
class Lana_Panel_Widget extends WP_Widget{

	/**
	 * Lana Panel Widget
	 * constructor
	 */
	public function __construct() {

		$widget_title       = __( 'Lana - Panel', 'lana-widgets' );
		$widget_description = __( 'Put your content in a box.', 'lana-widgets' );
		$widget_options     = array( 'description' => $widget_description );
		$control_options    = array( 'width' => 600, 'height' => 400 );

		parent::__construct( 'lana_panel', $widget_title, $widget_options, $control_options );

		add_action( 'admin_enqueue_scripts', array( $this, 'widget_admin_scripts' ) );
	}

	/**
	 * Load widget script
	 */
	public function widget_admin_scripts() {

		wp_enqueue_media();

		wp_enqueue_script( 'lana-panel-widget', LANA_WIDGETS_DIR_URL . '/assets/js/lana-panel-widget.js', array(
			'jquery',
			'editor',
			'quicktags'
		), LANA_WIDGETS_VERSION );
	}

	/**
	 * Output Widget HTML
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {

		/**
		 * Title
		 * apply filter
		 */
		$instance['title'] = apply_filters( 'widget_title', $instance['title'] );

		/**
		 * Widget
		 * elements
		 */
		$before_panel = '<div class="panel %s">';
		$after_panel  = '</div>';

		$before_panel_heading = '<div class="panel-heading">';
		$after_panel_heading  = '</div>';

		$before_panel_title = '<h3 class="panel-title">';
		$after_panel_title  = '</h3>';

		$before_panel_body = '<div class="panel-body">';
		$after_panel_body  = '</div>';

		$before_panel_footer = '<div class="panel-footer">';
		$after_panel_footer  = '</div>';

		$instance['panel_body']   = wpautop( $instance['panel_body'] );
		$instance['panel_footer'] = wpautop( $instance['panel_footer'] );

		/**
		 * Output
		 * Widget
		 */
		echo $args['before_widget'];

		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . $instance['title'] . $args['after_title'];
		}

		echo sprintf( $before_panel, esc_attr( $instance['type'] ) );

		if ( ! empty( $instance['panel_title'] ) ) {
			echo $before_panel_heading;
			echo $before_panel_title;
			echo $instance['panel_title'];
			echo $after_panel_title;
			echo $after_panel_heading;
		}

		if ( ! empty( $instance['panel_body'] ) ) {
			echo $before_panel_body;
			echo $instance['panel_body'];
			echo $after_panel_body;
		}

		if ( ! empty( $instance['panel_footer'] ) ) {
			echo $before_panel_footer;
			echo $instance['panel_footer'];
			echo $after_panel_footer;
		}

		echo $after_panel;

		echo $args['after_widget'];
	}

	/**
	 * Output Widget Form
	 * with TinyMCE
	 *
	 * @param array $instance
	 *
	 * @return string|void
	 */
	public function form( $instance ) {

		global $lana_editor;

		$instance = wp_parse_args( (array) $instance, array(
			'title'        => '',
			'type'         => 'panel-default',
			'panel_title'  => '',
			'panel_body'   => '',
			'panel_footer' => ''
		) );

		$instance['panel_body']   = wpautop( $instance['panel_body'] );
		$instance['panel_body']   = str_replace( "\n", "", $instance['panel_body'] );
		$instance['panel_footer'] = wpautop( $instance['panel_footer'] );
		$instance['panel_footer'] = str_replace( "\n", "", $instance['panel_footer'] );

		/**
		 * TinyMCE
		 * settings
		 */
		$panel_body_wp_editor_settings = array(
			'textarea_name' => $this->get_field_name( 'panel_body' ),
			'textarea_rows' => 10,
			'dwf'           => true,
			'tinymce'       => array(
				'add_unload_trigger' => false,
				'wp_autoresize_on'   => false
			)
		);

		$panel_footer_wp_editor_settings = array(
			'textarea_name' => $this->get_field_name( 'panel_footer' ),
			'textarea_rows' => 8,
			'dwf'           => true,
			'tinymce'       => array(
				'add_unload_trigger' => false,
				'wp_autoresize_on'   => false
			)
		);
		?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>">
				<?php _e( 'Title:', 'lana-widgets' ); ?>
            </label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>"
                   name="<?php echo $this->get_field_name( 'title' ); ?>"
                   value="<?php echo esc_attr( $instance['title'] ); ?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'type' ); ?>">
				<?php _e( 'Type:', 'lana-widgets' ); ?>
            </label>
            <select class="widefat" id="<?php echo $this->get_field_id( 'type' ); ?>"
                    name="<?php echo $this->get_field_name( 'type' ); ?>">
                <option value="panel-default" <?php selected( $instance['type'], 'panel-default' ); ?>>
					<?php esc_html_e( 'Default', 'lana-widgets' ); ?>
                </option>
                <option value="panel-primary" <?php selected( $instance['type'], 'panel-primary' ); ?>>
					<?php esc_html_e( 'Primary', 'lana-widgets' ); ?>
                </option>
                <option value="panel-success" <?php selected( $instance['type'], 'panel-success' ); ?>>
					<?php esc_html_e( 'Success', 'lana-widgets' ); ?>
                </option>
                <option value="panel-info" <?php selected( $instance['type'], 'panel-info' ); ?>>
					<?php esc_html_e( 'Info', 'lana-widgets' ); ?>
                </option>
                <option value="panel-warning" <?php selected( $instance['type'], 'panel-warning' ); ?>>
					<?php esc_html_e( 'Warning', 'lana-widgets' ); ?>
                </option>
                <option value="panel-danger" <?php selected( $instance['type'], 'panel-danger' ); ?>>
					<?php esc_html_e( 'Danger', 'lana-widgets' ); ?>
                </option>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'panel_title' ); ?>">
				<?php _e( 'Panel Title:', 'lana-widgets' ); ?>
            </label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'panel_title' ); ?>"
                   name="<?php echo $this->get_field_name( 'panel_title' ); ?>"
                   value="<?php echo esc_attr( $instance['panel_title'] ); ?>"/>
        </p>

        <label for="<?php echo $this->get_field_id( 'panel_body' ); ?>">
			<?php _e( 'Panel Body:', 'lana-widgets' ); ?>
        </label>
		<?php if ( defined( 'LANA_EDITOR_VERSION' ) && true == $lana_editor ) : ?>
			<?php wp_editor( $instance['panel_body'], $this->get_field_id( 'panel_body' ), $panel_body_wp_editor_settings ); ?>
		<?php else : ?>
            <textarea class="widefat" rows="5" id="<?php echo $this->get_field_id( 'panel_body' ); ?>"
                      name="<?php echo $this->get_field_name( 'panel_body' ); ?>"><?php echo esc_textarea( $instance['panel_body'] ); ?></textarea>
		<?php endif; ?>

        <br/>

        <label for="<?php echo $this->get_field_id( 'panel_footer' ); ?>">
			<?php _e( 'Panel Footer:', 'lana-widgets' ); ?>
        </label>
		<?php if ( defined( 'LANA_EDITOR_VERSION' ) && true == $lana_editor ) : ?>
			<?php wp_editor( $instance['panel_footer'], $this->get_field_id( 'panel_footer' ), $panel_footer_wp_editor_settings ); ?>
		<?php else : ?>
            <textarea class="widefat" rows="5" id="<?php echo $this->get_field_id( 'panel_footer' ); ?>"
                      name="<?php echo $this->get_field_name( 'panel_footer' ); ?>"><?php echo esc_textarea( $instance['panel_footer'] ); ?></textarea>
		<?php endif; ?>

		<?php if ( defined( 'LANA_EDITOR_VERSION' ) && true == $lana_editor ) : ?>
            <script>
                jQuery(function () {
                    jQuery('.widget-dialog-lana_panel_widget').find('.wp-editor-area').each(function () {
                        lanaWidgetsTinyMCE(this);
                    });
                    jQuery('.widget').find('.wp-editor-area').each(function () {
                        lanaWidgetsTinyMCE(this);
                    });
                });
            </script>
		<?php endif; ?>
		<?php
	}

	/**
	 * Update Widget Data
	 *
	 * @param array $new_instance
	 * @param array $old_instance
	 *
	 * @return array|mixed
	 */
	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['title']       = sanitize_text_field( $new_instance['title'] );
		$instance['type']        = sanitize_text_field( $new_instance['type'] );
		$instance['panel_title'] = sanitize_text_field( $new_instance['panel_title'] );

		if ( current_user_can( 'unfiltered_html' ) ) {
			$instance['panel_body']   = $new_instance['panel_body'];
			$instance['panel_footer'] = $new_instance['panel_footer'];
		} else {
			$instance['panel_body']   = wp_kses_post( $new_instance['panel_body'] );
			$instance['panel_footer'] = wp_kses_post( $new_instance['panel_footer'] );
		}

		return apply_filters( 'lana_panel_widget_update', $instance, $this );
	}
}