<?php
/**
 * Comments template
 * lana list comments and lana comment form
 */

if ( post_password_required() ) : ?>
    <h5 class="text-center">
		<?php _e( 'This post is password protected. Enter the password to view comments.', 'lana-blog' ); ?>
    </h5>
	<?php
	return;
endif;
?>

<div class="comments-container">
	<?php if ( have_comments() ) : ?>
        <h3 class="comments-title">
			<?php comments_number( 'No Responses', 'One Response', '% Responses' ); ?>
        </h3>
        <div class="comment-pagination">
			<?php paginate_comments_links(); ?>
        </div>
        <hr/>
        <ul class="media-list">
			<?php wp_list_comments( 'callback=lana_blog_comment' ); ?>
        </ul>
        <div class="comment-pagination">
			<?php paginate_comments_links(); ?>
        </div>
	<?php endif; ?>

	<?php comment_form(); ?>
</div>
