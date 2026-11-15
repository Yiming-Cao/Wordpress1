<?php
/**
 * 404 pagina: pagina niet gevonden.
 *
 * @package NightCityDispatch
 */

get_header();
?>

<section class="lost">
	<div class="container lost__inner">
		<p class="lost__code">404</p>
		<h1 class="lost__title"><?php esc_html_e( 'Pagina niet gevonden', 'night-city-dispatch' ); ?></h1>
		<p class="lost__text"><?php esc_html_e( 'Deze pagina bestaat niet of is verplaatst. Zoek hieronder verder of ga terug naar de voorpagina.', 'night-city-dispatch' ); ?></p>

		<?php // Hetzelfde zoekformulier als in de header. ?>
		<div class="lost__search"><?php get_search_form(); ?></div>

		<a class="button" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Terug naar de voorpagina', 'night-city-dispatch' ); ?></a>
	</div>
</section>

<?php
get_footer();
