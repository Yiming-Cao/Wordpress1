<?php
/**
 * Comments area.
 *
 * @package NightCityDispatch
 */

if ( post_password_required() ) {
	return;
}
?>

<section id="comments" class="comments">
	<div class="container">
		<?php if ( have_comments() ) : ?>
			<h2 class="comments__title">
				<?php
				$ncd_comment_count = get_comments_number();
				printf(
					/* translators: %s: comment count. */
					esc_html( _n( '%s response', '%s responses', $ncd_comment_count, 'night-city-dispatch' ) ),
					esc_html( number_format_i18n( $ncd_comment_count ) )
				);
				?>
			</h2>

			<ol class="comment-list">
				<?php
				wp_list_comments(
					array(
						'style'       => 'ol',
						'short_ping'  => true,
						'avatar_size' => 48,
					)
				);
				?>
			</ol>

			<?php the_comments_navigation(); ?>
		<?php endif; ?>

		<?php if ( ! comments_open() && get_comments_number() ) : ?>
			<p class="comments__closed"><?php esc_html_e( 'The comments are closed.', 'night-city-dispatch' ); ?></p>
		<?php endif; ?>

		<?php
		comment_form(
			array(
				'class_form'      => 'comment-form',
				'title_reply'     => __( 'Leave a reply', 'night-city-dispatch' ),
				'title_reply_to'  => __( 'Reply to %s', 'night-city-dispatch' ),
				'cancel_reply_link' => __( 'Cancel reply', 'night-city-dispatch' ),
				'label_submit'    => __( 'Post reply', 'night-city-dispatch' ),
			)
		);
		?>
	</div>
</section>
