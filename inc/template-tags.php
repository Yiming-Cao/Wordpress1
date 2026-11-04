<?php
/**
 * Small template helpers shared by more than one template file.
 *
 * @package NightCityDispatch
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Estimate reading time in minutes (200 words per minute, rounded up).
 *
 * @param int $post_id Optional post ID. Defaults to the current post.
 * @return int
 */
function ncd_reading_time( $post_id = 0 ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	$content = get_post_field( 'post_content', $post_id );
	$words   = str_word_count( wp_strip_all_tags( strip_shortcodes( (string) $content ) ) );

	return max( 1, (int) ceil( $words / 200 ) );
}

/**
 * Count the words in a post.
 *
 * @param int $post_id Optional post ID. Defaults to the current post.
 * @return int
 */
function ncd_word_count( $post_id = 0 ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	$content = get_post_field( 'post_content', $post_id );

	return (int) str_word_count( wp_strip_all_tags( strip_shortcodes( (string) $content ) ) );
}

/**
 * Print the date, writer, category and reading time for a post.
 *
 * @param int $post_id Optional post ID. Defaults to the current post.
 */
function ncd_post_meta( $post_id = 0 ) {
	$post_id    = $post_id ? $post_id : get_the_ID();
	$categories = get_the_category( $post_id );
	$author_id  = (int) get_post_field( 'post_author', $post_id );

	echo '<div class="meta">';

	if ( $categories ) {
		printf(
			'<a class="meta__item meta__cat" href="%1$s">%2$s</a>',
			esc_url( get_category_link( $categories[0]->term_id ) ),
			esc_html( $categories[0]->name )
		);
	}

	printf(
		'<time class="meta__item" datetime="%1$s">%2$s</time>',
		esc_attr( get_the_date( DATE_W3C, $post_id ) ),
		esc_html( get_the_date( 'd.m.Y', $post_id ) )
	);

	printf(
		'<a class="meta__item" href="%1$s">%2$s</a>',
		esc_url( get_author_posts_url( $author_id ) ),
		esc_html( get_the_author_meta( 'display_name', $author_id ) )
	);

	printf(
		'<span class="meta__item">%s</span>',
		esc_html( sprintf( '%d min read', ncd_reading_time( $post_id ) ) )
	);

	echo '</div>';
}

/**
 * Print the tags of the current post as links.
 */
function ncd_entry_tags() {
	$tags = get_the_tags();

	if ( ! $tags ) {
		return;
	}

	echo '<div class="tag-list">';
	foreach ( $tags as $tag ) {
		printf(
			'<a class="chip" href="%1$s" rel="tag">%2$s</a>',
			esc_url( get_tag_link( $tag->term_id ) ),
			esc_html( $tag->name )
		);
	}
	echo '</div>';
}

/**
 * Print a paginated list for the current query.
 */
function ncd_pagination() {
	the_posts_pagination(
		array(
			'mid_size'           => 1,
			'prev_text'          => __( 'Previous page', 'night-city-dispatch' ),
			'next_text'          => __( 'Next page', 'night-city-dispatch' ),
			'class'              => 'pagination',
			'screen_reader_text' => __( 'Posts navigation', 'night-city-dispatch' ),
		)
	);
}

/**
 * Return posts related by category, for use after a single post.
 *
 * @param int $post_id Optional post ID. Defaults to the current post.
 * @param int $limit   Number of posts to request.
 * @return WP_Query
 */
function ncd_related_posts( $post_id = 0, $limit = 3 ) {
	$post_id    = $post_id ? $post_id : get_the_ID();
	$categories = wp_get_post_categories( $post_id );

	$args = array(
		'post_type'           => 'post',
		'posts_per_page'      => $limit,
		'post__not_in'        => array( $post_id ),
		'ignore_sticky_posts' => true,
		'no_found_rows'       => true,
	);

	if ( $categories ) {
		$args['category__in'] = $categories;
	}

	return new WP_Query( $args );
}

/**
 * A human label for the archive currently being viewed.
 *
 * @return string
 */
function ncd_archive_label() {
	if ( is_category() ) {
		return __( 'Section', 'night-city-dispatch' );
	}
	if ( is_tag() ) {
		return __( 'Tag', 'night-city-dispatch' );
	}
	if ( is_author() ) {
		return __( 'Writer', 'night-city-dispatch' );
	}
	if ( is_search() ) {
		return __( 'Search', 'night-city-dispatch' );
	}
	if ( is_date() ) {
		return __( 'Date', 'night-city-dispatch' );
	}

	return __( 'Archive', 'night-city-dispatch' );
}

/**
 * The archive title without WordPress' "Category:" prefixes.
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
	if ( is_post_type_archive() ) {
		return post_type_archive_title( '', false );
	}

	return __( 'Archive', 'night-city-dispatch' );
}

/**
 * Print one filter chip. Active chips get aria-current so screen readers know
 * which archive is being viewed.
 *
 * @param string $label  Visible label.
 * @param string $url    Link target.
 * @param int    $count  Optional post count.
 * @param bool   $active Whether this chip matches the current archive.
 */
function ncd_filter_chip( $label, $url, $count = 0, $active = false ) {
	printf(
		'<a class="chip%1$s" href="%2$s"%3$s>%4$s%5$s</a>',
		$active ? ' is-active' : '',
		esc_url( $url ),
		$active ? ' aria-current="page"' : '',
		esc_html( $label ),
		$count ? '<span class="chip__count">' . esc_html( number_format_i18n( $count ) ) . '</span>' : ''
	);
}

/**
 * Filter controls shown on archive, search and blog pages.
 *
 * The chips are real links to category, tag and author archives, so filtering
 * works without JavaScript and every view has its own URL.
 */
function ncd_archive_filters() {
	$categories = get_categories(
		array(
			'hide_empty' => true,
			'orderby'    => 'count',
			'order'      => 'DESC',
		)
	);
	$tags       = get_tags(
		array(
			'hide_empty' => true,
			'orderby'    => 'count',
			'order'      => 'DESC',
			'number'     => 10,
		)
	);
	$authors    = get_users(
		array(
			'has_published_posts' => array( 'post' ),
			'orderby'             => 'post_count',
			'order'               => 'DESC',
			'number'              => 6,
		)
	);

	if ( ! $categories && ! $tags && ! $authors ) {
		return;
	}
	?>
	<section class="filters" aria-label="<?php esc_attr_e( 'Filter the archive', 'night-city-dispatch' ); ?>">
		<div class="container">
			<?php if ( $categories ) : ?>
				<div class="filters__row">
					<span class="filters__label"><?php esc_html_e( 'Sections', 'night-city-dispatch' ); ?></span>
					<div class="filters__chips">
						<?php
						foreach ( $categories as $category ) {
							ncd_filter_chip(
								$category->name,
								get_category_link( $category->term_id ),
								(int) $category->count,
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
					<div class="filters__chips">
						<?php
						foreach ( $tags as $tag ) {
							ncd_filter_chip(
								$tag->name,
								get_tag_link( $tag->term_id ),
								(int) $tag->count,
								is_tag( $tag->term_id )
							);
						}
						?>
					</div>
				</div>
			<?php endif; ?>

			<?php if ( $authors ) : ?>
				<div class="filters__row">
					<span class="filters__label"><?php esc_html_e( 'Writers', 'night-city-dispatch' ); ?></span>
					<div class="filters__chips">
						<?php
						foreach ( $authors as $author ) {
							ncd_filter_chip(
								$author->display_name,
								get_author_posts_url( $author->ID ),
								(int) count_user_posts( $author->ID, 'post' ),
								is_author( $author->ID )
							);
						}
						?>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</section>
	<?php
}
