<?php
/**
 * One post card used by the front page, archives, search and related files.
 *
 * @package NightCityDispatch
 */

$ncd_card_cats = get_the_category();
?>
<article <?php post_class( 'card' ); ?>>
	<a class="card__media" href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail( 'ncd-card', array( 'loading' => 'lazy' ) ); ?>
		<?php else : ?>
			<span class="media-fallback">NCD</span>
		<?php endif; ?>
	</a>

	<div class="card__body">
		<?php if ( $ncd_card_cats ) : ?>
			<a class="card__kicker" href="<?php echo esc_url( get_category_link( $ncd_card_cats[0]->term_id ) ); ?>"><?php echo esc_html( $ncd_card_cats[0]->name ); ?></a>
		<?php endif; ?>

		<h3 class="card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

		<p class="card__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 20 ) ); ?></p>

		<div class="meta">
			<time class="meta__item" datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date( 'd.m.Y' ) ); ?></time>
			<span class="meta__item"><?php echo esc_html( sprintf( '%d min', ncd_reading_time() ) ); ?></span>
		</div>
	</div>
</article>
