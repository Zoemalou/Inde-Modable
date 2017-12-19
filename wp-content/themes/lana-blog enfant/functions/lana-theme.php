<?php
defined( 'ABSPATH' ) or die();

/**
 * Load custom scripts
 */
function lana_blog_custom_scripts() {

	/** custom wordpress theme */
	wp_register_script( 'lana-blog-custom-theme', get_template_directory_uri() . '/js/custom-theme.js', array( 'jquery' ), LANA_BLOG_VERSION, true );
	wp_enqueue_script( 'lana-blog-custom-theme' );
}

add_action( 'wp_enqueue_scripts', 'lana_blog_custom_scripts' );

/**
 * Post - add class
 *
 * @param $classes
 *
 * @return array
 */
function lana_blog_post_class( $classes ) {

	if ( comments_open() ) {
		$classes[] = 'comment-open';
	}

	if ( ! comments_open() ) {
		$classes[] = 'comment-closed';
	}

	return $classes;
}

add_filter( 'post_class', 'lana_blog_post_class' );

/**
 * Lana wp_list_comments
 * callback function
 *
 * @param $comment
 * @param $args
 * @param $depth
 */
function lana_blog_comment( $comment, $args, $depth ) {
	?>
    <li <?php comment_class( 'media' ); ?> id="comment-<?php comment_ID(); ?>">
        <div class="pull-left">
			<?php echo get_avatar( $comment, $size = '48' ); ?>
        </div>
        <div class="media-body">
            <h4 class="media-heading">
				<?php printf( __( '%s says:', 'lana-blog' ), get_comment_author_link() ); ?>
            </h4>

            <div class="comment-text">
				<?php comment_text(); ?>
            </div>
            <h6>
                <span class="pull-left comment-meta comment-metadata">
                    <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
	                    <?php printf( __( '%1$s at %2$s', 'lana-blog' ), get_comment_date(), get_comment_time() ); ?>
                    </a>
                </span>
                <span class="pull-right reply">
                    <?php
                    comment_reply_link( array_merge( $args, array(
	                    'depth'     => $depth,
	                    'max_depth' => $args['max_depth']
                    ) ) );
                    ?>
                </span>
                <span class="pull-right edit">
                    <?php edit_comment_link( __( 'Edit', 'lana-blog' ) ); ?>
                </span>
                <span class="clearfix"></span>
            </h6>
        </div>
    </li>
    <hr/>
	<?php
}

/**
 * Comment form fields
 *
 * @param $fields
 *
 * @return array
 */
function lana_blog_comment_form_fields( $fields ) {

	$commenter = wp_get_current_commenter();

	$req      = get_option( 'require_name_email' );
	$aria_req = $req ? " aria-required='true'" : '';

	$fields['author'] = '<div class="form-group">
	                        <label class="col-sm-2 control-label" for="author">' . __( 'Name', 'lana-blog' ) . '</label>
	                        <div class="visible-xs-inline-block visible-sm-inline-block help-block col-sm-2">
	                            ' . ( $req ? __( '* required', 'lana-blog' ) : '' ) . '
	                        </div>
	                        <div class="col-sm-8">
	                            <input type="text" class="form-control" id="author" name="author" value="' . esc_attr( $commenter['comment_author'] ) . '" placeholder="' . esc_attr__( 'Your Name', 'lana-blog' ) . '" ' . $aria_req . '>
	                        </div>
	                        <div class="hidden-xs hidden-sm col-md-2 help-block">
	                            ' . ( $req ? __( '* required', 'lana-blog' ) : '' ) . '
	                        </div>
	                    </div>';

	$fields['email'] = '<div class="form-group">
	                        <label class="col-sm-2 control-label" for="email">' . __( 'Email', 'lana-blog' ) . '</label>
	                        <div class="visible-xs-inline-block visible-sm-inline-block help-block col-sm-2">
	                            ' . ( $req ? __( '* required', 'lana-blog' ) : '' ) . '
	                        </div>
	                        <div class="col-sm-8">
	                            <input type="text" class="form-control" id="email" name="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" placeholder="' . esc_attr__( 'email@example.com', 'lana-blog' ) . '" ' . $aria_req . '>
	                        </div>
	                        <div class="hidden-xs hidden-sm col-md-2 help-block">
	                            ' . ( $req ? __( '* required', 'lana-blog' ) : '' ) . '
	                        </div>
	                    </div>';

	$fields['url'] = '<div class="form-group">
	                        <label class="col-sm-2 control-label" for="url">' . __( 'Website', 'lana-blog' ) . '</label>
	                        <div class="col-sm-8">
	                            <input type="text" class="form-control" id="url" name="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" placeholder="' . esc_attr( get_option( 'siteurl' ) ) . '">
	                        </div>
	                    </div>';

	return $fields;
}

add_filter( 'comment_form_default_fields', 'lana_blog_comment_form_fields' );

/**
 * Change comment form fields sort
 * comment to last
 *
 * @param $fields
 *
 * @return mixed
 */
function lana_blog_comment_form_fields_sort( $fields ) {

	$comment = $fields['comment'];
	unset( $fields['comment'] );
	$fields['comment'] = $comment;

	return $fields;
}

add_filter( 'comment_form_fields', 'lana_blog_comment_form_fields_sort' );

/**
 * Comment form
 *
 * @param $args
 *
 * @return mixed
 */
function lana_blog_comment_form( $args ) {

	$args['comment_field'] = '<div class="form-group">
	                            <label class="col-sm-2 control-label" for="comment">' . __( 'Comment', 'lana-blog' ) . '</label>
	                                <div class="col-sm-8">
	                                    <textarea class="form-control" name="comment" id="comment" rows="8" maxlength="65525" aria-required="true" required="required"></textarea>
	                                </div>
	                            </div>';

	if ( '' != $args['comment_notes_before'] ) {
		$args['comment_notes_before'] = '<div class="form-group">
			                                <div class="col-sm-offset-1 col-sm-10 text-center">
												' . $args['comment_notes_before'] . '
											</div>
		                                </div>';
	}

	if ( '' != $args['comment_notes_after'] ) {
		$args['comment_notes_after'] = '<div class="form-group">
			                                <div class="col-sm-offset-1 col-sm-10">
			                                ' . $args['comment_notes_after'] . '
			                                </div>
		                                </div>';
	}

	$args['class_form']   = 'comment-form form-horizontal';
	$args['class_submit'] = 'btn btn-primary';

	$args['title_reply_before'] = '<h4 id="reply-title" class="comment-reply-title text-center">';
	$args['title_reply_after']  = '</h4>';

	$args['submit_field'] = '<div class="form-group">
								<div class="col-sm-offset-1 col-sm-10 text-center">
								%1$s %2$s
									<p class="form-control-static">
										' . cancel_comment_reply_link() . '
									</p>
								</div>
							</div>';

	$args['must_log_in']  = '<div class="text-center">
                                ' . $args['must_log_in'] . '
                            </div>';
	$args['logged_in_as'] = '<div class="form-group">
                                <div class="col-sm-12">
                                    <div class="form-control-static text-center">
                                    ' . $args['logged_in_as'] . '
                                    </div>
                                </div>
                            </div>';

	return $args;
}

add_filter( 'comment_form_defaults', 'lana_blog_comment_form' );

/**
 * Lana Password Protected Form
 * with Bootstrap
 * @return string
 */
function lana_blog_password_form() {
	global $post;

	$label = 'pwbox-' . rand();

	if ( is_a( $post, 'WP_Post' ) ) {
		$label = 'pwbox-' . $post->ID;
	}

	/** @var string $output */
	$output = '';

	$output .= '<div class="row">';
	$output .= '<div class="col-md-6">';
	$output .= '<form class="post-password-form" action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">';
	$output .= '<div class="input-group">';
	$output .= '<label class="sr-only" for="' . $label . '">';
	$output .= __( 'Password:', 'lana-blog' );
	$output .= '</label>';
	$output .= '<input type="password" name="post_password" id="' . $label . '" class="form-control" size="20">';
	$output .= '<span class="input-group-btn"><input type="submit" name="Submit" class="btn btn-primary" value="' . esc_attr__( 'Submit', 'lana-blog' ) . '"/></span>';
	$output .= '</div>';
	$output .= '</form>';
	$output .= '</div>';
	$output .= '<div class="col-md-12">';
	$output .= '<p>' . __( 'This content is password protected. To view it please enter your password.', 'lana-blog' ) . '</p>';
	$output .= '</div>';
	$output .= '</div>';

	return $output;
}

add_filter( 'the_password_form', 'lana_blog_password_form' );

/**
 * Lana Custom
 * Tag Cloud Widget
 *
 * @param $args
 *
 * @return mixed
 */
function lana_blog_widget_tag_cloud_args( $args ) {

	$args['number']   = 20;
	$args['largest']  = 18;
	$args['smallest'] = 13;
	$args['unit']     = 'px';

	return $args;
}

add_filter( 'widget_tag_cloud_args', 'lana_blog_widget_tag_cloud_args' );

/**
 * Modify Read More Link
 * @return string
 */
function lana_blog_more_link() {
	return '<a href="' . esc_url( get_permalink() ) . '">' . __( 'Read More', 'lana-blog' ) . ' &raquo;</a>';
}

add_filter( 'the_content_more_link', 'lana_blog_more_link' );

/**
 * Image Caption
 * with Bootstrap
 *
 * @param $output
 * @param $attr
 * @param $content
 *
 * @return string
 */
function lana_blog_img_caption_shortcode( $output, $attr, $content ) {

	$atts = shortcode_atts( array(
		'id'      => '',
		'align'   => 'alignnone',
		'width'   => '',
		'caption' => ''
	), $attr );

	if ( $atts['width'] < 1 || empty( $atts['caption'] ) ) {
		return $content;
	}

	if ( $atts['align'] == 'alignleft' ) {
		$atts['align'] .= ' pull-left';
	}

	if ( $atts['align'] == 'alignright' ) {
		$atts['align'] .= ' pull-right';
	}

	$img_caption_before              = '<div id="%s" class="%s">';
	$img_caption_after               = '</div>';
	$img_caption_caption_before      = '<div class="%s">';
	$img_caption_caption_after       = '</div>';
	$img_caption_caption_text_before = '<p>';
	$img_caption_caption_text_after  = '</p>';

	/**
	 * Generate
	 * output
	 */
	$output .= sprintf( $img_caption_before, $atts['id'], implode( ' ', array(
		'img-caption',
		'thumbnail',
		$atts['align']
	) ) );
	$output .= do_shortcode( $content );
	$output .= sprintf( $img_caption_caption_before, 'caption' );
	$output .= $img_caption_caption_text_before;
	$output .= $atts['caption'];
	$output .= $img_caption_caption_text_after;
	$output .= $img_caption_caption_after;
	$output .= $img_caption_after;

	return $output;
}

add_filter( 'img_caption_shortcode', 'lana_blog_img_caption_shortcode', 10, 3 );

/**
 * Lana
 * main navbar in header class
 *
 * @param string $class
 */
function lana_blog_main_navbar_in_header_class( $class = '' ) {
	echo 'class="' . join( ' ', lana_blog_get_main_navbar_in_header_class( $class ) ) . '"';
}

/**
 * Lana
 * get main navbar in header class
 *
 * @param string $class
 *
 * @return array
 */
function lana_blog_get_main_navbar_in_header_class( $class = '' ) {

	$classes = array();

	if ( $class ) {
		if ( ! is_array( $class ) ) {
			$class = preg_split( '#\s+#', $class );
		}
		$classes = array_map( 'esc_attr', $class );
	} else {
		// Ensure that we always coerce class to being an array.
		$class = array();
	}

	$classes = array_map( 'esc_attr', $classes );

	$classes = apply_filters( 'lana_blog_main_navbar_in_header_class', $classes, $class );

	return array_unique( $classes );
}

/**
 * Lana
 * main navbar in header container class
 *
 * @param string $class
 */
function lana_blog_main_navbar_in_header_container_class( $class = '' ) {
	echo 'class="' . join( ' ', lana_blog_get_main_navbar_in_header_container_class( $class ) ) . '"';
}

/**
 * Lana
 * get main navbar in header container class
 *
 * @param string $class
 *
 * @return array
 */
function lana_blog_get_main_navbar_in_header_container_class( $class = '' ) {

	$classes = array();

	if ( $class ) {
		if ( ! is_array( $class ) ) {
			$class = preg_split( '#\s+#', $class );
		}
		$classes = array_map( 'esc_attr', $class );
	} else {
		// Ensure that we always coerce class to being an array.
		$class = array();
	}

	$classes = array_map( 'esc_attr', $classes );

	$classes = apply_filters( 'lana_blog_main_navbar_in_header_container_class', $classes, $class );

	return array_unique( $classes );
}

/**
 * Lana
 * main navbar in content class
 *
 * @param string $class
 */
function lana_blog_main_navbar_in_content_class( $class = '' ) {
	echo 'class="' . join( ' ', lana_blog_get_main_navbar_in_content_class( $class ) ) . '"';
}

/**
 * Lana
 * get main navbar in content class
 *
 * @param string $class
 *
 * @return array
 */
function lana_blog_get_main_navbar_in_content_class( $class = '' ) {

	$classes = array();

	if ( $class ) {
		if ( ! is_array( $class ) ) {
			$class = preg_split( '#\s+#', $class );
		}
		$classes = array_map( 'esc_attr', $class );
	} else {
		// Ensure that we always coerce class to being an array.
		$class = array();
	}

	$classes = array_map( 'esc_attr', $classes );

	$classes = apply_filters( 'lana_blog_main_navbar_in_content_class', $classes, $class );

	return array_unique( $classes );
}

/**
 * Lana
 * main navbar in content container class
 *
 * @param string $class
 */
function lana_blog_main_navbar_in_content_container_class( $class = '' ) {
	echo 'class="' . join( ' ', lana_blog_get_main_navbar_in_content_container_class( $class ) ) . '"';
}

/**
 * Lana
 * get main navbar in content container class
 *
 * @param string $class
 *
 * @return array
 */
function lana_blog_get_main_navbar_in_content_container_class( $class = '' ) {

	$classes = array();

	if ( $class ) {
		if ( ! is_array( $class ) ) {
			$class = preg_split( '#\s+#', $class );
		}
		$classes = array_map( 'esc_attr', $class );
	} else {
		// Ensure that we always coerce class to being an array.
		$class = array();
	}

	$classes = array_map( 'esc_attr', $classes );

	$classes = apply_filters( 'lana_blog_main_navbar_in_content_container_class', $classes, $class );

	return array_unique( $classes );
}

/**
 * Lana
 * main container class
 *
 * @param string $class
 */
function lana_blog_main_container_class( $class = '' ) {
	echo 'class="' . join( ' ', lana_blog_get_main_container_class( $class ) ) . '"';
}

/**
 * Lana
 * get main container class
 *
 * @param string $class
 *
 * @return array
 */
function lana_blog_get_main_container_class( $class = '' ) {

	$classes = array();

	if ( $class ) {
		if ( ! is_array( $class ) ) {
			$class = preg_split( '#\s+#', $class );
		}
		$classes = array_map( 'esc_attr', $class );
	} else {
		// Ensure that we always coerce class to being an array.
		$class = array();
	}

	$classes = array_map( 'esc_attr', $classes );

	$classes = apply_filters( 'lana_blog_main_container_class', $classes, $class );

	return array_unique( $classes );
}

/**
 * Lana
 * header container class
 *
 * @param string $class
 */
function lana_blog_header_container_class( $class = '' ) {
	echo 'class="' . join( ' ', lana_blog_get_header_container_class( $class ) ) . '"';
}

/**
 * Lana
 * get header container class
 *
 * @param string $class
 *
 * @return array
 */
function lana_blog_get_header_container_class( $class = '' ) {

	$classes = array();

	if ( $class ) {
		if ( ! is_array( $class ) ) {
			$class = preg_split( '#\s+#', $class );
		}
		$classes = array_map( 'esc_attr', $class );
	} else {
		// Ensure that we always coerce class to being an array.
		$class = array();
	}

	$classes = array_map( 'esc_attr', $classes );

	$classes = apply_filters( 'lana_blog_header_container_class', $classes, $class );

	return array_unique( $classes );
}

/**
 * Lana
 * header site title container class
 *
 * @param string $class
 */
function lana_blog_header_site_title_container_class( $class = '' ) {
	echo 'class="' . join( ' ', lana_blog_get_header_site_title_container_class( $class ) ) . '"';
}

/**
 * Lana
 * get header site title container class
 *
 * @param string $class
 *
 * @return array
 */
function lana_blog_get_header_site_title_container_class( $class = '' ) {

	$classes = array();

	if ( $class ) {
		if ( ! is_array( $class ) ) {
			$class = preg_split( '#\s+#', $class );
		}
		$classes = array_map( 'esc_attr', $class );
	} else {
		// Ensure that we always coerce class to being an array.
		$class = array();
	}

	$classes = array_map( 'esc_attr', $classes );

	$classes = apply_filters( 'lana_blog_header_site_title_container_class', $classes, $class );

	return array_unique( $classes );
}

/**
 * Lana
 * breadcrumb container class
 *
 * @param string $class
 */
function lana_blog_breadcrumb_container_class( $class = '' ) {
	echo 'class="' . join( ' ', lana_blog_get_breadcrumb_container_class( $class ) ) . '"';
}

/**
 * Lana
 * get breadcrumb container class
 *
 * @param string $class
 *
 * @return array
 */
function lana_blog_get_breadcrumb_container_class( $class = '' ) {

	$classes = array();

	if ( $class ) {
		if ( ! is_array( $class ) ) {
			$class = preg_split( '#\s+#', $class );
		}
		$classes = array_map( 'esc_attr', $class );
	} else {
		// Ensure that we always coerce class to being an array.
		$class = array();
	}

	$classes = array_map( 'esc_attr', $classes );

	$classes = apply_filters( 'lana_blog_breadcrumb_container_class', $classes, $class );

	return array_unique( $classes );
}

/**
 * Lana
 * breadcrumb container inner class
 *
 * @param string $class
 */
function lana_blog_breadcrumb_container_inner_class( $class = '' ) {
	echo 'class="' . join( ' ', lana_blog_get_breadcrumb_container_inner_class( $class ) ) . '"';
}

/**
 * Lana
 * get breadcrumb container inner class
 *
 * @param string $class
 *
 * @return array
 */
function lana_blog_get_breadcrumb_container_inner_class( $class = '' ) {

	$classes = array();

	if ( $class ) {
		if ( ! is_array( $class ) ) {
			$class = preg_split( '#\s+#', $class );
		}
		$classes = array_map( 'esc_attr', $class );
	} else {
		// Ensure that we always coerce class to being an array.
		$class = array();
	}

	$classes = array_map( 'esc_attr', $classes );

	$classes = apply_filters( 'lana_blog_breadcrumb_container_inner_class', $classes, $class );

	return array_unique( $classes );
}

/**
 * Lana
 * main content container class
 *
 * @param string $class
 */
function lana_blog_main_content_class( $class = '' ) {
	echo 'class="' . join( ' ', lana_blog_get_main_content_class( $class ) ) . '"';
}

/**
 * Lana
 * get main content container class
 *
 * @param string $class
 *
 * @return array
 */
function lana_blog_get_main_content_class( $class = '' ) {

	$classes = array();

	if ( $class ) {
		if ( ! is_array( $class ) ) {
			$class = preg_split( '#\s+#', $class );
		}
		$classes = array_map( 'esc_attr', $class );
	} else {
		// Ensure that we always coerce class to being an array.
		$class = array();
	}

	$classes = array_map( 'esc_attr', $classes );

	$classes = apply_filters( 'lana_blog_main_content_class', $classes, $class );

	return array_unique( $classes );
}

/**
 * Lana
 * main content container class
 *
 * @param string $class
 */
function lana_blog_main_content_container_class( $class = '' ) {
	echo 'class="' . join( ' ', lana_blog_get_main_content_container_class( $class ) ) . '"';
}

/**
 * Lana
 * get main content container class
 *
 * @param string $class
 *
 * @return array
 */
function lana_blog_get_main_content_container_class( $class = '' ) {

	$classes = array();

	if ( $class ) {
		if ( ! is_array( $class ) ) {
			$class = preg_split( '#\s+#', $class );
		}
		$classes = array_map( 'esc_attr', $class );
	} else {
		// Ensure that we always coerce class to being an array.
		$class = array();
	}

	$classes = array_map( 'esc_attr', $classes );

	$classes = apply_filters( 'lana_blog_main_content_container_class', $classes, $class );

	return array_unique( $classes );
}

/**
 * Lana
 * content class
 *
 * @param string $class
 */
function lana_blog_content_class( $class = '' ) {
	echo 'class="' . join( ' ', lana_blog_get_content_class( $class ) ) . '"';
}

/**
 * Lana
 * get content class
 *
 * @param string $class
 *
 * @return array
 */
function lana_blog_get_content_class( $class = '' ) {

	$classes = array();

	if ( $class ) {
		if ( ! is_array( $class ) ) {
			$class = preg_split( '#\s+#', $class );
		}
		$classes = array_map( 'esc_attr', $class );
	} else {
		// Ensure that we always coerce class to being an array.
		$class = array();
	}

	$classes = array_map( 'esc_attr', $classes );

	$classes = apply_filters( 'lana_blog_content_class', $classes, $class );

	return array_unique( $classes );
}

/**
 * Lana
 * sidebar class
 *
 * @param string $class
 */
function lana_blog_sidebar_class( $class = '' ) {
	echo 'class="' . join( ' ', lana_blog_get_sidebar_class( $class ) ) . '"';
}

/**
 * Lana
 * get sidebar class
 *
 * @param string $class
 *
 * @return array
 */
function lana_blog_get_sidebar_class( $class = '' ) {

	$classes = array();

	if ( $class ) {
		if ( ! is_array( $class ) ) {
			$class = preg_split( '#\s+#', $class );
		}
		$classes = array_map( 'esc_attr', $class );
	} else {
		// Ensure that we always coerce class to being an array.
		$class = array();
	}

	$classes = array_map( 'esc_attr', $classes );

	$classes = apply_filters( 'lana_blog_sidebar_class', $classes, $class );

	return array_unique( $classes );
}

/**
 * Lana
 * pre footer class
 *
 * @param string $class
 */
function lana_blog_pre_footer_class( $class = '' ) {
	echo 'class="' . join( ' ', lana_blog_get_pre_footer_class( $class ) ) . '"';
}

/**
 * Lana
 * get pre footer class
 *
 * @param string $class
 *
 * @return array
 */
function lana_blog_get_pre_footer_class( $class = '' ) {

	$classes = array();

	if ( $class ) {
		if ( ! is_array( $class ) ) {
			$class = preg_split( '#\s+#', $class );
		}
		$classes = array_map( 'esc_attr', $class );
	} else {
		// Ensure that we always coerce class to being an array.
		$class = array();
	}

	$classes = array_map( 'esc_attr', $classes );

	$classes = apply_filters( 'lana_blog_pre_footer_class', $classes, $class );

	return array_unique( $classes );
}

/**
 * Content - col class
 *
 * @param $classes
 *
 * @return array|string
 */
function lana_blog_content_col_class( $classes ) {

	/** with sidebar */
	if ( is_active_sidebar( 'primary' ) ) {
		$classes[] = 'col-md-9';
	}

	/** without sidebar - full width */
	if ( ! is_active_sidebar( 'primary' ) ) {
		$classes[] = 'col-md-12';
	}

	return $classes;
}

add_filter( 'lana_blog_content_class', 'lana_blog_content_col_class' );

/**
 * Sidebar - col class
 *
 * @param $classes
 *
 * @return array
 */
function lana_blog_sidebar_col_class( $classes ) {

	/** with sidebar */
	if ( is_active_sidebar( 'primary' ) ) {
		$classes[] = 'col-md-3';
	}

	return $classes;
}

add_filter( 'lana_blog_sidebar_class', 'lana_blog_sidebar_col_class' );