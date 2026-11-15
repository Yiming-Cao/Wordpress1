<?php
/**
 * Melding als er geen berichten gevonden zijn.
 *
 * @package NightCityDispatch
 */
?>
<div class="empty">
	<p class="empty__title"><?php esc_html_e( 'Niets gevonden', 'night-city-dispatch' ); ?></p>
	<p class="empty__text"><?php esc_html_e( 'Er zijn geen berichten voor deze pagina. Probeer een andere categorie of zoek op een woord.', 'night-city-dispatch' ); ?></p>
	<?php get_search_form(); ?>
</div>
