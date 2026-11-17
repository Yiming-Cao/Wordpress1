<?php
/**
 * Comments: lijst met reacties en het formulier.
 *
 * 中文：评论区 = 评论列表 + 发表评论的表单。被 comments_template() 调用，
 * 所以 single.php 和 page.php 共用同一份代码。
 *
 * Wordt geladen binnen de container van single.php of page.php.
 *
 * @package NightCityDispatch
 */

if ( post_password_required() ) {
	return;
}
?>

<section id="comments" class="comments">
	<?php if ( have_comments() ) : ?>
		<h2 class="comments__title">
			<?php
			$ncd_comment_count = get_comments_number();
			printf(
				/* translators: %s: aantal reacties. */
				esc_html( _n( '%s reactie', '%s reacties', $ncd_comment_count, 'night-city-dispatch' ) ),
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
					'avatar_size' => 40,
				)
			);
			?>
		</ol>

		<?php the_comments_navigation(); ?>
	<?php endif; ?>

	<?php if ( ! comments_open() && get_comments_number() ) : ?>
		<p class="comments__closed"><?php esc_html_e( 'De reacties zijn gesloten.', 'night-city-dispatch' ); ?></p>
	<?php endif; ?>

	<?php
	// 中文：comment_form() 是 WordPress 自带的表单，这里只改标题和按钮文字。
	comment_form(
		array(
			'title_reply'    => __( 'Reageer', 'night-city-dispatch' ),
			'label_submit'   => __( 'Plaats reactie', 'night-city-dispatch' ),
			'comment_notes_before' => '',
		)
	);
	?>
</section>
