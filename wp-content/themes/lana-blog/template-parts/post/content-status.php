<?php
/**
 * Lana Template
 * The template for displaying posts in the Status post format
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
                <a class="pull-left thumbnail avatar"
                   href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
					<?php echo get_avatar( get_the_author_meta( 'ID' ), 48 ); ?>
                </a>

                <div class="media-meta pull-left avatar-meta">
                    <p class="meta-info meta-user">
                        <span class="glyphicon glyphicon-user"></span>
						<?php the_author_posts_link(); ?>
                    </p>
                    <br/>

                    <p class="meta-info meta-date">
                        <span class="glyphicon glyphicon-time"></span>
                        <a href="<?php the_permalink(); ?>">
							<?php echo get_the_date(); ?>
                        </a>
                    </p>

                    <p class="meta-info meta-category">
                        <span class="glyphicon glyphicon-folder-open"></span>
						<?php the_category( ', ' ); ?>
                    </p>
                </div>
                <div class="clearfix"></div>
                <hr/>

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