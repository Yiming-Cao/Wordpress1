<?php
/**
 * Kleine hulpfuncties die in meerdere templates gebruikt worden.
 *
 * 中文：这里放「好几个模板都会用到」的小函数，避免在每个模板重复写同样的 HTML。
 * functions.php 最后 require 这个文件，所以全站都能调用这些 ncd_ 开头的函数。
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

	// 中文：输出日期（用 <time> 标签，机器也读得懂）+ 作者的名字和链接。
	// De datum in een time-element: dat is goed voor schermlezers en zoekmachines.
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
 * 中文：WordPress 默认会输出「Categorie: Nieuws」，这里只留名字，标题比较干净。
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
 * 中文：返回「这是哪种页面」：分类 / 标签 / 作者 / 搜索，用来显示在上方的小字。
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
	// 中文：the_posts_pagination() 自动生成 1 2 3 … 的页码，不用自己算。
	// Eén paginanummer links en rechts van de huidige pagina is genoeg.
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
	// 中文：用 printf 拼 HTML：%1$s 额外 class、%2$s 网址、%3$s aria-current、%4$s 文字。
	// %1$s is de extra class, %2$s de URL, %3$s aria-current en %4$s de tekst.
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
 * 中文：过滤条不需要 JavaScript —— 每个链接都是真实的归档网址（/category/x/），
 * 點下去就是換一個 WordPress 頁面，所以能過濾、也能分享網址。
 *
 * De links wijzen naar de echte archieven, dus filteren werkt zonder
 * JavaScript en elke filter heeft een eigen URL.
 */
function ncd_archive_filters() {
	// 中文：分别取分类、标签、有发文的作者，再一行一行输出成过滤条。
	// Eerst de categorieen, daarna de tags en de auteurs ophalen.
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
