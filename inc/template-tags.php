<?php
/**
 * Kleine hulpfuncties die in meerdere templates gebruikt worden.
 *
 * @package NightCityDispatch
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Datum en auteur van een bericht tonen.
 *
 * @param int $post_id Optioneel. Standaard het huidige bericht.
 */
function ncd_post_meta( $post_id = 0 ) {
	$post_id   = $post_id ? $post_id : get_the_ID();
	$author_id = (int) get_post_field( 'post_author', $post_id );

	echo '<div class="meta">';

	printf(
		'<time class="meta__item" datetime="%1$s">%2$s</time>',
		esc_attr( get_the_date( DATE_W3C, $post_id ) ),
		esc_html( get_the_date( '', $post_id ) )
	);

	printf(
		'<a class="meta__item" href="%1$s">%2$s</a>',
		esc_url( get_author_posts_url( $author_id ) ),
		esc_html( get_the_author_meta( 'display_name', $author_id ) )
	);

	echo '</div>';
}

/**
 * Titel van het huidige archief, zonder prefixen als "Categorie:".
 *
 * @return string
 */
function ncd_archive_title() {
	if ( is_category() ) {
		return single_cat_title( '', false );
	}

	if ( is_tag() ) {
		return single_tag_title( '', false );
	}

	if ( is_author() ) {
		return get_the_author();
	}

	if ( is_year() ) {
		return get_the_date( 'Y' );
	}

	if ( is_month() ) {
		return get_the_date( 'F Y' );
	}

	if ( is_day() ) {
		return get_the_date( 'd.m.Y' );
	}

	return __( 'Archief', 'night-city-dispatch' );
}

/**
 * Soort archief dat getoond wordt.
 *
 * @return string
 */
function ncd_archive_label() {
	if ( is_category() ) {
		return __( 'Categorie', 'night-city-dispatch' );
	}

	if ( is_tag() ) {
		return __( 'Tag', 'night-city-dispatch' );
	}

	if ( is_author() ) {
		return __( 'Auteur', 'night-city-dispatch' );
	}

	if ( is_search() ) {
		return __( 'Zoeken', 'night-city-dispatch' );
	}

	return __( 'Archief', 'night-city-dispatch' );
}

/**
 * Paginanummers onder een overzicht.
 */
function ncd_pagination() {
	the_posts_pagination(
		array(
			'mid_size'  => 1,
			'prev_text' => __( 'Vorige', 'night-city-dispatch' ),
			'next_text' => __( 'Volgende', 'night-city-dispatch' ),
		)
	);
}

/**
 * Een enkele filterlink. De actieve link krijgt een eigen class.
 *
 * @param string $label  Tekst van de link.
 * @param string $url    Link naar het archief.
 * @param bool   $active Staat deze link al open?
 */
function ncd_filter_link( $label, $url, $active = false ) {
	printf(
		'<a class="filter-link%1$s" href="%2$s"%3$s>%4$s</a>',
		$active ? ' is-active' : '',
		esc_url( $url ),
		$active ? ' aria-current="page"' : '',
		esc_html( $label )
	);
}

/**
 * Filterbalk met categorieen, tags en auteurs.
 *
 * De links wijzen naar de echte archieven, dus filteren werkt zonder
 * JavaScript en elke filter heeft een eigen URL.
 */
function ncd_archive_filters() {
	$categories = get_categories(
		array(
			'hide_empty' => true,
		)
	);

	$tags = get_tags(
		array(
			'hide_empty' => true,
			'number'     => 10,
		)
	);

	$authors = get_users(
		array(
			'has_published_posts' => array( 'post' ),
			'number'              => 5,
		)
	);

	if ( ! $categories && ! $tags && ! $authors ) {
		return;
	}
	?>
	<section class="filters">
		<div class="container">
			<div class="filters__box">
				<?php if ( $categories ) : ?>
					<div class="filters__row">
						<span class="filters__label"><?php esc_html_e( 'Categorieen', 'night-city-dispatch' ); ?></span>
						<div class="filters__links">
							<?php
							foreach ( $categories as $category ) {
								ncd_filter_link(
									$category->name,
									get_category_link( $category->term_id ),
									is_category( $category->term_id )
								);
							}
							?>
						</div>
					</div>
				<?php endif; ?>

				<?php if ( $tags ) : ?>
					<div class="filters__row">
						<span class="filters__label"><?php esc_html_e( 'Tags', 'night-city-dispatch' ); ?></span>
						<div class="filters__links">
							<?php
							foreach ( $tags as $tag ) {
								ncd_filter_link(
									$tag->name,
									get_tag_link( $tag->term_id ),
									is_tag( $tag->term_id )
								);
							}
							?>
						</div>
					</div>
				<?php endif; ?>

				<?php if ( $authors ) : ?>
					<div class="filters__row">
						<span class="filters__label"><?php esc_html_e( 'Auteurs', 'night-city-dispatch' ); ?></span>
						<div class="filters__links">
							<?php
							foreach ( $authors as $author ) {
								ncd_filter_link(
									$author->display_name,
									get_author_posts_url( $author->ID ),
									is_author( $author->ID )
								);
							}
							?>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</section>
	<?php
}
