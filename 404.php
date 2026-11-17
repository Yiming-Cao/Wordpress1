<?php
/**
 * 404 pagina: pagina niet gevonden.
 *
 * 中文：404.php 是网址不存在时的页面。WordPress 找不到内容会自动用它，
 * 并返回真正的 404 状态码（对 SEO 很重要）。
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

		<?php // 中文：同一个搜索框（searchform.php），访客可以直接再搜一次。 ?>
		<?php // Hetzelfde zoekformulier als in de header. ?>
		<div class="lost__search"><?php get_search_form(); ?></div>

		<a class="button" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Terug naar de voorpagina', 'night-city-dispatch' ); ?></a>
	</div>
</section>

<?php
get_footer();
