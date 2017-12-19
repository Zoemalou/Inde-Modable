<?php get_header(); ?>

    <div class="row">
        <div class="col-md-12">
            <h2>
				<?php printf( __( 'Search Results for &#8220;%s&#8221;', 'lana-blog' ), get_search_query() ); ?>
            </h2>
            <hr/>
        </div>
    </div>

    <div class="row">

        <div <?php lana_blog_content_class(); ?>>

			<?php if ( have_posts() ) : while( have_posts() ) : the_post(); ?>

                <div class="panel panel-primary">
					<?php get_template_part( 'template-parts/search/content-search', get_post_type() ); ?>
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
                    <p>
						<?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'lana-blog' ); ?>
                    </p>
                </div>

			<?php endif; ?>

        </div>

        <div <?php lana_blog_sidebar_class(); ?>>
			<?php dynamic_sidebar( 'primary' ); ?>
        </div>
    </div>

<?php get_footer(); ?>