<?php get_header(); ?>

    <div class="row">

        <div <?php lana_blog_content_class(); ?>>

			<?php if ( have_posts() ) : while( have_posts() ) : the_post(); ?>

                <div class="panel panel-primary" id="post-<?php the_ID(); ?>">
					<?php get_template_part( 'template-parts/post/content', get_post_format() ); ?>

					<?php if ( comments_open() || get_comments_number() ) : ?>
                        <div class="panel-footer">
							<?php comments_template(); ?>
                        </div>
					<?php endif; ?>
                </div>

			<?php endwhile; ?>

			<?php else : ?>
                <p><?php _e( 'Sorry, this page does not exist.', 'lana-blog' ); ?></p>
			<?php endif; ?>

        </div>

        <div <?php lana_blog_sidebar_class(); ?>>
			<?php dynamic_sidebar( 'primary' ); ?>
        </div>
    </div>

<?php get_footer(); ?>