<?php
/**
 * Template Name: Lana Editor Page
 * Description: Page Template for Lana Editor
 */
?>

<?php get_header(); ?>

<?php if ( have_posts() ) : while( have_posts() ) : the_post(); ?>

	<?php the_content(); ?>

	<?php if ( comments_open() || get_comments_number() ) : ?>
        <div class="panel panel-primary">
            <div class="panel-footer">
				<?php comments_template(); ?>
            </div>
        </div>
	<?php endif; ?>

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

<?php get_footer(); ?>