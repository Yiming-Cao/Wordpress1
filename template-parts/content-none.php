<?php
/**
 * Empty state for archives, search and the blog index.
 *
 * @package NightCityDispatch
 */

?>
<div class="empty">
	<p class="empty__title"><?php esc_html_e( 'Nothing filed here yet', 'night-city-dispatch' ); ?></p>
	<p class="empty__text"><?php esc_html_e( 'No files match this view. Try another section, a tag, or search the archive.', 'night-city-dispatch' ); ?></p>
	<?php get_search_form(); ?>
</div>
