<?php
/**
 * Zoekresultaten.
 *
 * @package NightCityDispatch
 */

get_header();

$ncd_found = (int) $GLOBALS['wp_query']->found_posts;
?>

<header class="page-head">
	<div class="container">
		<p class="page-head__meta"><?php echo esc_html( sprintf( '%s / %s resultaten', ncd_archive_label(), number_format_i18n( $ncd_found ) ) ); ?></p>
		<h1 class="page-head__title">
			<?php
			printf(
				/* translators: %s: zoekterm. */
				esc_html__( 'Zoeken naar: %s', 'night-city-dispatch' ),
				esc_html( get_search_query() )
			);
			?>
		</h1>
		<div class="page-head__search"><?php get_search_form(); ?></div>
	</div>
</header>

<section class="section">
	<div class="container">
		<?php if ( have_posts() ) : ?>
			<div class="post-grid">
				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/content-card' );
				endwhile;
				?>
			</div>

			<?php ncd_pagination(); ?>
		<?php else : ?>
			<?php get_template_part( 'template-parts/content-none' ); ?>
		<?php endif; ?>
	</div>
</section>

<?php
get_footer();
