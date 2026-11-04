<?php
/**
 * Night City Dispatch theme bootstrap.
 *
 * Everything that registers theme features, assets and queries lives here.
 * Template markup lives in the PHP templates at the theme root.
 *
 * @package NightCityDispatch
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'NCD_VERSION', '1.0.0' );

if ( ! isset( $content_width ) ) {
	$content_width = 760;
}

/**
 * Register theme supports, menus and image sizes.
 */
function ncd_setup() {
	load_theme_textdomain( 'night-city-dispatch', get_template_directory() . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'editor-styles' );
	add_theme_support(
		'html5',
		array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' )
	);
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 64,
			'width'       => 260,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	add_editor_style( 'assets/css/editor.css' );

	register_nav_menus(
		array(
			'primary' => __( 'Primary menu', 'night-city-dispatch' ),
			'footer'  => __( 'Footer menu', 'night-city-dispatch' ),
		)
	);

	add_image_size( 'ncd-card', 720, 480, true );
	add_image_size( 'ncd-hero', 1600, 900, true );
	add_image_size( 'ncd-thumb', 160, 160, true );
}
add_action( 'after_setup_theme', 'ncd_setup' );

/**
 * Build a cache-busting version string from a file's modification time.
 *
 * @param string $relative Path relative to the theme root.
 * @return string
 */
function ncd_asset_version( $relative ) {
	$path = get_template_directory() . $relative;

	return file_exists( $path ) ? (string) filemtime( $path ) : NCD_VERSION;
}

/**
 * Load the stylesheets and scripts for the front end.
 */
function ncd_assets() {
	$uri = get_template_directory_uri();

	wp_enqueue_style(
		'ncd-fonts',
		$uri . '/assets/fonts/fonts.css',
		array(),
		NCD_VERSION
	);

	wp_enqueue_style(
		'ncd-main',
		$uri . '/assets/css/main.css',
		array( 'ncd-fonts' ),
		ncd_asset_version( '/assets/css/main.css' )
	);

	wp_enqueue_script(
		'ncd-main',
		$uri . '/assets/js/main.js',
		array(),
		ncd_asset_version( '/assets/js/main.js' ),
		true
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'ncd_assets' );

/**
 * Fallback menu used before the editor has assigned a primary menu.
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
 * Add a body class so styles can target the theme explicitly.
 *
 * @param array $classes Existing classes.
 * @return array
 */
function ncd_body_classes( $classes ) {
	$classes[] = 'ncd';

	if ( is_singular( 'post' ) ) {
		$classes[] = 'ncd-single';
	}

	return $classes;
}
add_filter( 'body_class', 'ncd_body_classes' );

/**
 * Use six posts per page on archives and search results (two full grid rows).
 *
 * @param WP_Query $query The query being prepared.
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
 * Short excerpts that end on a word boundary.
 *
 * @return int
 */
function ncd_excerpt_length() {
	return 28;
}
add_filter( 'excerpt_length', 'ncd_excerpt_length' );

/**
 * Replace the default [...] excerpt suffix.
 *
 * @return string
 */
function ncd_excerpt_more() {
	return '…';
}
add_filter( 'excerpt_more', 'ncd_excerpt_more' );

/**
 * Browser chrome colour that matches the theme background.
 */
function ncd_head_meta() {
	echo '<meta name="theme-color" content="#0A0A0B">' . "\n";
}
add_action( 'wp_head', 'ncd_head_meta' );

require get_template_directory() . '/inc/template-tags.php';
