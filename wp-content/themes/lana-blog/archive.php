<?php get_header(); ?>

    <div class="row">
        <div class="col-md-12">
            <h2><?php the_archive_title(); ?></h2>
            <hr/>
        </div>
    </div>

    <div class="row">

        <div <?php lana_blog_content_class(); ?>>

			<?php if ( have_posts() ) : while( have_posts() ) : the_post(); ?>

                <div class="panel panel-primary">
					<?php get_template_part( 'template-parts/post/content', get_post_format() ); ?>
                </div>

			<?php endwhile; ?>

                <div class="col-md-12 text-center">
					<?php the_posts_pagination( array( 'type' => 'list' ) ); ?>
                </div>

			<?php else : ?>
                <h2><b><?php _e( 'No Posts', 'lana-blog' ); ?></b></h2>
                <p><?php _e( 'Sorry, What you were looking for is not here.', 'lana-blog' ); ?></p>
			<?php endif; ?>

        </div>

        <div <?php lana_blog_sidebar_class(); ?>>
			<?php dynamic_sidebar( 'primary' ); ?>
        </div>
    </div>

<?php get_footer(); ?>