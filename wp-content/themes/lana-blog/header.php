<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>"/>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php do_action( 'lana_blog_body' ); ?>

<?php if ( has_nav_menu( 'lana_main' ) && get_theme_mod( 'lana_blog_display_navbar_position', 'header' ) == 'header' ) : ?>
    <div <?php lana_blog_main_navbar_in_header_class( array( 'lana-main-navigation', 'navbar-in-header' ) ); ?>>
        <nav class="navbar navbar-primary">
            <div <?php lana_blog_main_navbar_in_header_container_class( 'container' ); ?>>
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#lana-navbar" aria-expanded="false" aria-controls="lana-navbar">
                        <span class="sr-only"><?php _e( 'Toggle navigation', 'lana-blog' ); ?></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div id="lana-navbar" class="navbar-collapse collapse">
					<?php lana_blog_main_nav_menu(); ?>
                </div>
            </div>
        </nav>
    </div>
<?php endif; ?>

<?php if ( ! has_nav_menu( 'lana_main' ) ) : ?>
    <div <?php lana_blog_main_navbar_in_header_class( array( 'lana-main-navigation', 'navbar-in-header' ) ); ?>>
        <nav class="navbar navbar-primary">
            <div <?php lana_blog_main_navbar_in_header_container_class( 'container' ); ?>>
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#lana-navbar" aria-expanded="false" aria-controls="lana-navbar">
                        <span class="sr-only"><?php _e( 'Toggle navigation', 'lana-blog' ); ?></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div id="lana-navbar" class="navbar-collapse collapse">
					<?php
					lana_blog_main_nav_menu( array(
						'menu_class'  => 'nav navbar-nav fallback-nav',
						'fallback_cb' => 'Lana_Blog_Walker_Nav_Menu::fallback'
					) );
					?>
                </div>
            </div>
        </nav>
    </div>
<?php endif; ?>

<div <?php lana_blog_main_container_class( 'main-container' ); ?>>

    <div class="header">
        <div <?php lana_blog_header_container_class(); ?>>
            <div class="row">
                <div <?php lana_blog_header_site_title_container_class(); ?>>
					<?php if ( has_custom_logo() ) : ?>
						<?php the_custom_logo(); ?>
					<?php else : ?>
                        <h1 class="site-title animated bounce">
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"
                               title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
								<?php bloginfo( 'name' ); ?>
                            </a>
                        </h1>
                        <p class="site-description">
							<?php bloginfo( 'description' ); ?>
                        </p>
					<?php endif; ?>
                </div>
				<?php if ( get_theme_mod( 'lana_blog_header_site_title_position', 'center' ) == 'left' && get_theme_mod( 'lana_blog_header_search_widget', '0' ) == '1' ): ?>
                    <div class="col-md-3 col-md-offset-3">
						<?php get_search_form(); ?>
                    </div>
				<?php endif; ?>
            </div>
        </div>
    </div>

	<?php if ( has_nav_menu( 'lana_main' ) && get_theme_mod( 'lana_blog_display_navbar_position', 'header' ) == 'content' ) : ?>
        <div <?php lana_blog_main_navbar_in_content_class( array( 'lana-main-navigation', 'navbar-in-content' ) ); ?>>
            <nav class="navbar navbar-primary">
                <div <?php lana_blog_main_navbar_in_content_container_class(); ?>>
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                data-target="#lana-navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only"><?php _e( 'Toggle navigation', 'lana-blog' ); ?></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div id="lana-navbar" class="navbar-collapse collapse">
						<?php lana_blog_main_nav_menu(); ?>
                    </div>
                </div>
            </nav>
        </div>
	<?php endif; ?>

	<?php if ( function_exists( 'lana_breadcrumb' ) ): ?>
        <div <?php lana_blog_breadcrumb_container_class( 'breadcrumb-container' ); ?>>
            <div <?php lana_blog_breadcrumb_container_inner_class(); ?>>
				<?php echo lana_breadcrumb(); ?>
            </div>
        </div>
	<?php endif; ?>

    <div <?php lana_blog_main_content_class( 'main-content' ); ?>>
        <div <?php lana_blog_main_content_container_class(); ?>>