<?php
/**
 * Functions voor het Night City Dispatch thema.
 *
 * Hier staan de theme supports, de menu's, de image sizes en het laden van
 * de stylesheet en het script.
 *
 * @package NightCityDispatch
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! isset( $content_width ) ) {
	$content_width = 760;
}

/**
 * Theme supports, menu's en image sizes instellen.
 */
function ncd_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support(
		'html5',
		array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' )
	);

	register_nav_menus(
		array(
			'primary' => __( 'Hoofdmenu', 'night-city-dispatch' ),
			'footer'  => __( 'Footer menu', 'night-city-dispatch' ),
		)
	);

	add_image_size( 'ncd-card', 720, 450, true );
	add_image_size( 'ncd-hero', 1200, 675, true );
}
add_action( 'after_setup_theme', 'ncd_setup' );

/**
 * De stylesheet en het script laden.
 */
function ncd_assets() {
	$version = wp_get_theme()->get( 'Version' );
	$uri     = get_template_directory_uri();

	wp_enqueue_style( 'ncd-style', $uri . '/assets/css/main.css', array(), $version );

	wp_enqueue_script( 'ncd-script', $uri . '/assets/js/main.js', array(), $version, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'ncd_assets' );

/**
 * Fallback menu als er nog geen menu in het dashboard is aangemaakt.
 */
function ncd_menu_fallback() {
	echo '<ul class="menu">';
	wp_list_pages(
		array(
			'title_li' => '',
			'depth'    => 1,
		)
	);
	echo '</ul>';
}

/**
 * Zes berichten per pagina op archieven en zoekresultaten.
 *
 * @param WP_Query $query De query die WordPress gaat uitvoeren.
 */
function ncd_archive_query( $query ) {
	if ( is_admin() || ! $query->is_main_query() ) {
		return;
	}

	if ( $query->is_archive() || $query->is_search() ) {
		$query->set( 'posts_per_page', 6 );
	}
}
add_action( 'pre_get_posts', 'ncd_archive_query' );

/**
 * Kortere excerpt.
 *
 * @return int
 */
function ncd_excerpt_length() {
	return 24;
}
add_filter( 'excerpt_length', 'ncd_excerpt_length' );

/**
 * Andere tekst achter de excerpt in plaats van [...].
 *
 * @return string
 */
function ncd_excerpt_more() {
	return '...';
}
add_filter( 'excerpt_more', 'ncd_excerpt_more' );

require get_template_directory() . '/inc/template-tags.php';
