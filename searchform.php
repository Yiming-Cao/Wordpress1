<?php
/**
 * Search form used in the masthead, on 404 and in the empty state.
 *
 * @package NightCityDispatch
 */

$ncd_search_id = wp_unique_id( 'search-field-' );
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="screen-reader-text" for="<?php echo esc_attr( $ncd_search_id ); ?>"><?php esc_html_e( 'Search the archive', 'night-city-dispatch' ); ?></label>
	<input
		type="search"
		id="<?php echo esc_attr( $ncd_search_id ); ?>"
		class="search-form__field"
		name="s"
		value="<?php echo esc_attr( get_search_query() ); ?>"
		placeholder="<?php esc_attr_e( 'Search the archive', 'night-city-dispatch' ); ?>"
	/>
	<button type="submit" class="search-form__submit" aria-label="<?php esc_attr_e( 'Search', 'night-city-dispatch' ); ?>">
		<svg width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true" focusable="false">
			<circle cx="6.5" cy="6.5" r="4.5" stroke="currentColor" stroke-width="1.6"/>
			<path d="M10 10L14.5 14.5" stroke="currentColor" stroke-width="1.6"/>
		</svg>
	</button>
</form>
