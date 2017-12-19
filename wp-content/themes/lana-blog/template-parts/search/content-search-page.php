<?php
/**
 * Lana Template
 * The template for displaying search results in the Page post type
 */

$post_type_obj = get_post_type_object( get_post_type() );
?>

<div <?php post_class( 'panel-body' ); ?>>
    <div class="media">
        <div class="media-body">
            <h2 class="media-heading">
                <a href="<?php the_permalink(); ?>">
					<?php the_title(); ?>

                    <span class="label label-primary pull-right">
                        <?php echo strtolower( $post_type_obj->labels->singular_name ); ?>
                    </span>
                </a>
            </h2>
            <div class="clearfix"></div>

            <hr/>

			<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
                <a class="pull-left thumbnail"
                   href="<?php echo esc_attr( wp_get_attachment_url( get_post_thumbnail_id() ) ); ?>"
                   title="<?php the_title_attribute(); ?>">
					<?php the_post_thumbnail( 'thumbnail' ); ?>
                </a>
			<?php endif; ?>
			<?php the_excerpt(); ?>
            <div class="clearfix"></div>

			<?php edit_post_link( __( 'Edit', 'lana-blog' ), '<hr/><span class="edit-link pull-right"><span class="glyphicon glyphicon-pencil"></span>', '</span>' ); ?>
        </div>
    </div>
</div>
