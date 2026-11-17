<?php
/**
 * Melding als er geen berichten gevonden zijn.
 *
 * 中文：归档页/搜索页一篇都没有时显示这个提示，同时给一个搜索框，别让访客走死路。
 *
 * @package NightCityDispatch
 */
?>
<div class="empty">
	<p class="empty__title"><?php esc_html_e( 'Niets gevonden', 'night-city-dispatch' ); ?></p>
	<p class="empty__text"><?php esc_html_e( 'Er zijn geen berichten voor deze pagina. Probeer een andere categorie of zoek op een woord.', 'night-city-dispatch' ); ?></p>
	<?php get_search_form(); ?>
</div>
