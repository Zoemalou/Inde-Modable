<?php get_header(); ?>

    <div class="row">

        <div class="col-md-12">

			<?php if ( have_posts() ) : while( have_posts() ) : the_post(); ?>

                <h3 class="text-center">
					<?php _e( 'Image Attachment', 'lana-blog' ); ?>
                </h3>

				<?php if ( wp_attachment_is_image() ) : ?>
                    <div class="attachment text-center">
                        <img src="<?php echo wp_get_attachment_url(); ?>"
                             alt="<?php echo esc_attr( get_post_meta( get_the_ID(), '_wp_attachment_image_alt', true ) ); ?>"
                             class="thumbnail">

                        <h4><?php the_title(); ?></h4>

                        <p><?php the_content(); ?></p>
                    </div>
				<?php endif; ?>

                <div class="panel panel-primary">
					<?php if ( comments_open() || get_comments_number() ) : ?>
                        <div class="panel-footer">
							<?php comments_template(); ?>
                        </div>
					<?php endif; ?>
                </div>

			<?php endwhile;
			else : ?>
                <p><?php _e( 'Sorry, this page does not exist.', 'lana-blog' ); ?></p>
			<?php endif; ?>

        </div>

    </div>

<?php get_footer(); ?>