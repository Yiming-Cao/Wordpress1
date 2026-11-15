<?php
/**
 * Header: doctype, head, site titel en het hoofdmenu.
 *
 * @package NightCityDispatch
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Naar de inhoud', 'night-city-dispatch' ); ?></a>

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
			<div class="nav-search"><?php get_search_form(); ?></div>
		</nav>
	</div>
</header>

<main id="main" class="site-main">
