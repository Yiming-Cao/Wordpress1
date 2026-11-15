<?php
/**
 * Een kaart met een bericht, gebruikt in de grids.
 *
 * @package NightCityDispatch
 */

$ncd_card_categories = get_the_category();
?>
<article <?php post_class( 'card' ); ?>>
	<a class="card__media" href="<?php the_permalink(); ?>">
		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail( 'ncd-card', array( 'loading' => 'lazy' ) ); ?>
		<?php else : ?>
			<span class="media-fallback"><?php esc_html_e( 'Geen afbeelding', 'night-city-dispatch' ); ?></span>
		<?php endif; ?>
	</a>

	<div class="card__body">
		<?php if ( $ncd_card_categories ) : ?>
			<a class="card__kicker" href="<?php echo esc_url( get_category_link( $ncd_card_categories[0]->term_id ) ); ?>"><?php echo esc_html( $ncd_card_categories[0]->name ); ?></a>
		<?php endif; ?>

		<h3 class="card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

		<p class="card__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 16 ) ); ?></p>

		<div class="meta">
			<time class="meta__item" datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
		</div>
	</div>
</article>
