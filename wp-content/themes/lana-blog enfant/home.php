<?php get_header(); ?>

<?php if ( is_active_sidebar( 'home-top' ) ) : ?>
    <div class="row">
        <div class="col-md-12">
			<?php dynamic_sidebar( 'home-top' ); ?>
        </div>
    </div>
<?php endif; ?>

    <div class="row">

        <div <?php lana_blog_content_class(); ?>>

			<?php if ( have_posts() ) : while( have_posts() ) : the_post(); ?>

                <div class="panel panel-primary" id="post-<?php the_ID(); ?>">
					<?php get_template_part( 'template-parts/post/content', get_post_format() ); ?>
                </div>

			<?php endwhile; ?>

                <div class="col-md-12 text-center">
					<?php the_posts_pagination( array( 'type' => 'list' ) ); ?>
                </div>

			<?php else : ?>

                <div class="col-md-12 text-center">
                    <h3>
						<?php _e( 'Nothing Found', 'lana-blog' ); ?>
                    </h3>

					<?php if ( current_user_can( 'publish_posts' ) ) : ?>
                        <p>
							<?php _e( 'Ready to publish your first post?', 'lana-blog' ); ?>
                            <a href="<?php echo esc_url( admin_url( 'post-new.php' ) ); ?>">
								<?php _e( 'Get started here', 'lana-blog' ); ?>
                            </a>
                        </p>
					<?php else : ?>
                        <p>
							<?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'lana-blog' ); ?>
                        </p>
					<?php endif; ?>
                </div>

			<?php endif; ?>

        </div>

        <div <?php lana_blog_sidebar_class(); ?>>
			<?php dynamic_sidebar( 'primary' ); ?>
        </div>
    </div>

<?php get_footer(); ?>