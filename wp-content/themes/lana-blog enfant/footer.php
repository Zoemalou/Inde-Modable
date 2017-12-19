</div>
</div>
<div class="clearfix"></div>
</div>

<div <?php lana_blog_pre_footer_class( 'pre-footer' ); ?>>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
				<?php dynamic_sidebar( 'footer-left' ); ?>
            </div>
            <div class="col-md-4">
				<?php dynamic_sidebar( 'footer-middle' ); ?>
            </div>
            <div class="col-md-4">
				<?php dynamic_sidebar( 'footer-right' ); ?>
            </div>
        </div>
    </div>
</div>

<div class="footer">
    <div class="container">
        <p class="footer-text pull-right">
			<?php echo esc_html( get_theme_mod( 'lana_blog_footer_text' ) ); ?>
        </p>

        <p>
			<?php _e( 'Copyright', 'lana-blog' ); ?>
            &copy;
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
			<?php echo date_i18n( __( 'Y', 'lana-blog' ) ); ?>
        </p>
    </div>
</div>

<?php wp_footer(); ?>
</body>
</html>