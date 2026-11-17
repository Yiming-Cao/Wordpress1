<?php
/**
 * Header: doctype, head, site titel en het hoofdmenu.
 *
 * 中文：header.php 被所有模板用 get_header() 调用，所以顶部菜单和搜索框只写一次。
 *
 * @package NightCityDispatch
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php
	// 中文：wp_head() 输出 <head> 里的所有内容：标题、CSS、插件脚本。不写它，样式和标题都会消失。
	// wp_head() zet alle tags in de head neer: de titel, de stylesheet en plugins.
	wp_head();
	?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php // 中文：跳转链接（可访问性）：键盘用户按 Tab 可以直接跳到主内容区。 ?>
<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Naar de inhoud', 'night-city-dispatch' ); ?></a>

<?php // 中文：顶部区域：左边站点标题（brand），右边菜单和搜索框。 ?>
<header class="site-header">
	<div class="container header__inner">
		<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
			<span class="brand__title"><?php bloginfo( 'name' ); ?></span>
			<span class="brand__tagline"><?php bloginfo( 'description' ); ?></span>
		</a>

		<button class="nav-toggle" type="button" aria-expanded="false" aria-controls="primary-nav">
			<?php esc_html_e( 'Menu', 'night-city-dispatch' ); ?>
		</button>

		<nav id="primary-nav" class="primary-nav" aria-label="<?php esc_attr_e( 'Hoofdmenu', 'night-city-dispatch' ); ?>">
			<?php
			// 中文：wp_nav_menu() 读后台「外观 → 菜单」里的菜单。如果还没设置，就用 fallback 函数列出所有页面。
			// Het menu uit het dashboard. Zonder menu valt hij terug op de pagina's.
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container'      => false,
					'menu_class'     => 'menu',
					'depth'          => 1,
					'fallback_cb'    => 'ncd_menu_fallback',
				)
			);
			?>
			<?php // 中文：get_search_form() 加载 searchform.php，全站搜索框只有一份代码。 ?>
			<div class="nav-search"><?php get_search_form(); ?></div>
		</nav>
	</div>
</header>

<main id="main" class="site-main">
