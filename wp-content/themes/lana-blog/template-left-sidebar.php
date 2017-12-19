<?php
/**
 * Template Name: Left Sidebar Page
 * Description: Page Template with a main sidebar in left side.
 */
?>

<?php get_header(); ?>

    <div class="row">

        <div <?php lana_blog_sidebar_class(); ?>>
			<?php dynamic_sidebar( 'primary' ); ?>
        </div>

        <div <?php lana_blog_content_class(); ?>>

			<?php if ( have_posts() ) : while( have_posts() ) : the_post(); ?>

                <h3 class="page-title">
					<?php the_title(); ?>
                </h3>

                <div class="panel panel-primary">
                    <div class="panel-body">
						<?php the_content(); ?>
                    </div>
					<?php if ( comments_open() || get_comments_number() ) : ?>
                        <div class="panel-footer">
							<?php comments_template(); ?>
                        </div>
					<?php endif; ?>
                </div>

				<?php
				wp_link_pages( array(
					'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'lana-blog' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
				) );
				?>

			<?php endwhile;
			else : ?>
                <p><?php _e( 'Sorry, this page does not exist.', 'lana-blog' ); ?></p>
			<?php endif; ?>

        </div>

    </div>

<?php get_footer(); ?>