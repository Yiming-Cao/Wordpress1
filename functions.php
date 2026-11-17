<?php
/**
 * Functions voor het Night City Dispatch thema.
 *
 * Hier staan de theme supports, de menu's, de image sizes en het laden van
 * de stylesheet en het script.
 *
 * 中文：这个文件不输出页面，只做「设置」和「挂载」。注册主题支持的功能、
 * 菜单位置、图片尺寸，并用 wp_enqueue 加载 CSS 和脚本。WordPress 会自动加载 functions.php。
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

	// 中文：注册两个菜单位置 —— primary 给顶部菜单，footer 给底部。之后在后台「外观 → 菜单」里把菜单分配过去。
	// Twee plekken waar een menu kan staan: het hoofdmenu en de footer.
	register_nav_menus(
		array(
			'primary' => __( 'Hoofdmenu', 'night-city-dispatch' ),
			'footer'  => __( 'Footer menu', 'night-city-dispatch' ),
		)
	);

	// 中文：定义两个自己的图片尺寸：卡片 720x450，大图 1200x675。最后那个 true 表示「裁切成这个比例」。
	// Twee formaten: een brede voor de hero en een kleinere voor de kaarten.
	add_image_size( 'ncd-card', 720, 450, true );
	add_image_size( 'ncd-hero', 1200, 675, true );
}
add_action( 'after_setup_theme', 'ncd_setup' );

/**
 * De stylesheet en het script laden.
 */
function ncd_assets() {
	// 中文：wp_enqueue_style / wp_enqueue_script 是 WordPress 官方加载 CSS 和 JS 的方式（不能直接写 <link>）。
	// 中文：wp_enqueue_script 最后一个参数 true = 脚本放到页面底部；版本号用来让浏览器换缓存。
	// De versie uit style.css zorgt dat de browser na een update een nieuwe file ophaalt.
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
	// 中文：pre_get_posts 在 WordPress 真正查数据库之前触发，可以改查询条件。
	// 中文：这里只改主查询（后台的查询不动），分类页和搜索页每页 6 篇。
	// Alleen de hoofdquery aanpassen. Queries in het dashboard laten we met rust.
	if ( is_admin() || ! $query->is_main_query() ) {
		return;
	}

	// Op overzichten en zoekresultaten passen er zes berichten per pagina.
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
	// 中文：excerpt_length 过滤器改摘要长度，24 个词大约三行，卡片高度就能对齐。
	// Ongeveer drie regels tekst, zodat de kaarten even hoog blijven.
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
