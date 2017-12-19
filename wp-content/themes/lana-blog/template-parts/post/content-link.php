<?php
/**
 * Lana Template
 * The template for displaying posts in the Link post format
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
			<span class="label label-primary pull-right link-icon">
				<span class="glyphicon glyphicon-link" aria-hidden="true"></span>
			</span>
				<?php the_content(); ?>
                <div class="clearfix"></div>
                <hr/>
                <div class="media-meta">
                    <p class="meta-info meta-date">
                        <span class="glyphicon glyphicon-time"></span>
                        <a href="<?php the_permalink(); ?>">
							<?php echo get_the_date(); ?>
                        </a>
                    </p>
					<?php edit_post_link( __( 'Edit', 'lana-blog' ), '<span class="edit-link pull-right"><span class="glyphicon glyphicon-pencil"></span>', '</span>' ); ?>
                    <p class="meta-info meta-user pull-right">
                        <span class="glyphicon glyphicon-user"></span>
						<?php the_author_posts_link(); ?>
                    </p>
                </div>
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