<?php
/**
 * Lana Template
 * The default template for displaying content
 */
?>

    <div <?php post_class( 'panel-body' ); ?>>
        <div class="media">
			<?php if ( is_sticky() ): ?>
                <div class="sticky-icon">
                    <span class="glyphicon glyphicon-pushpin" aria-hidden="true"></span>
                </div>
			<?php endif; ?>
            <div class="media-body">
                <h2 class="media-heading">
                    <a href="<?php the_permalink(); ?>">
						<?php the_title(); ?>
                    </a>
                </h2>

                <div class="media-meta">
                    <p class="meta-info meta-date">
                        <span class="glyphicon glyphicon-time"></span>
                        <a href="<?php the_permalink(); ?>">
							<?php echo get_the_date(); ?>
                        </a>
                    </p>
					<?php if ( has_category() ) : ?>
                        <p class="meta-info meta-category">
                            <span class="glyphicon glyphicon-folder-open"></span>
							<?php the_category( ', ' ); ?>
                        </p>
					<?php endif; ?>
					<?php if ( ! post_password_required() ) : ?>
                        <p class="meta-info meta-comment">
                            <span class="glyphicon glyphicon-comment"></span>
							<?php comments_popup_link( __( 'No Comments', 'lana-blog' ), __( '1 Comment', 'lana-blog' ), __( '% Comments', 'lana-blog' ) ); ?>
                        </p>
					<?php endif; ?>
                    <p class="meta-info meta-user pull-right">
                        <span class="glyphicon glyphicon-user"></span>
						<?php the_author_posts_link(); ?>
                    </p>
                </div>

                <hr class="meta-hr"/>

				<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
                    <a class="pull-left thumbnail"
                       href="<?php echo esc_attr( wp_get_attachment_url( get_post_thumbnail_id() ) ); ?>"
                       title="<?php the_title_attribute(); ?>">
						<?php the_post_thumbnail( 'thumbnail' ); ?>
                    </a>
				<?php endif; ?>
				<?php the_content(); ?>
                <div class="clearfix"></div>

				<?php the_tags( '<hr/><span class="tags"><span class="glyphicon glyphicon-tag"></span>', '<span class="glyphicon glyphicon-tag"></span>', '</span>' ); ?>
				<?php if ( ! has_tag() && current_user_can( 'edit_post', get_the_ID() ) ) : ?>
                    <hr/>
				<?php endif; ?>
				<?php edit_post_link( __( 'Edit', 'lana-blog' ), '<span class="edit-link pull-right"><span class="glyphicon glyphicon-pencil"></span>', '</span>' ); ?>
            </div>
        </div>
    </div>

<?php
wp_link_pages( array(
	'before'      => '<div class="panel-footer page-links"><span class="page-links-title">' . __( 'Pages:', 'lana-blog' ) . '</span>',
	'after'       => '</div>',
	'link_before' => '<span class="page-link">',
	'link_after'  => '</span>',
) );
?>