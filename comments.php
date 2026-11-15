<?php
/**
 * Comments: lijst met reacties en het formulier.
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
	comment_form(
		array(
			'title_reply'    => __( 'Reageer', 'night-city-dispatch' ),
			'label_submit'   => __( 'Plaats reactie', 'night-city-dispatch' ),
			'comment_notes_before' => '',
		)
	);
	?>
</section>
