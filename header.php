<?php
/**
 * Site header: utility strip, masthead, navigation and the live ticker.
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

<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'night-city-dispatch' ); ?></a>

<header class="site-header" id="masthead">
	<div class="strip">
		<div class="container strip__inner">
			<span class="strip__id">NC//DISPATCH — 01</span>
			<span class="strip__status">
				<span class="strip__dot" aria-hidden="true"></span>
				<?php echo esc_html( date_i18n( 'd.m.Y · H:i' ) ); ?> — <?php esc_html_e( 'Night City', 'night-city-dispatch' ); ?>
			</span>
		</div>
	</div>

	<div class="masthead container">
		<div class="brand">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<a class="brand__link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<span class="brand__title"><?php bloginfo( 'name' ); ?></span>
					<span class="brand__tagline"><?php bloginfo( 'description' ); ?></span>
				</a>
			<?php endif; ?>
		</div>

		<nav id="primary-nav" class="primary-nav" aria-label="<?php esc_attr_e( 'Primary', 'night-city-dispatch' ); ?>">
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
			<div class="primary-nav__search"><?php get_search_form(); ?></div>
		</nav>

		<button class="nav-toggle" type="button" aria-expanded="false" aria-controls="primary-nav">
			<span class="nav-toggle__bars" aria-hidden="true"></span>
			<span class="nav-toggle__label"><?php esc_html_e( 'Menu', 'night-city-dispatch' ); ?></span>
		</button>
	</div>
</header>

<?php
$ncd_ticker = new WP_Query(
	array(
		'post_type'           => 'post',
		'posts_per_page'      => 4,
		'ignore_sticky_posts' => true,
		'no_found_rows'       => true,
	)
);

if ( $ncd_ticker->have_posts() ) :
	?>
	<div class="ticker" aria-hidden="true">
		<div class="ticker__track">
			<?php
			// The list is printed twice so the marquee can loop without a gap.
			for ( $pass = 0; $pass < 2; $pass++ ) :
				while ( $ncd_ticker->have_posts() ) :
					$ncd_ticker->the_post();
					?>
					<span class="ticker__item">
						<span class="ticker__date"><?php echo esc_html( get_the_date( 'd.m' ) ); ?></span>
						<?php the_title(); ?>
					</span>
					<?php
				endwhile;
				$ncd_ticker->rewind_posts();
			endfor;
			wp_reset_postdata();
			?>
		</div>
	</div>
<?php endif; ?>

<main id="main" class="site-main">
