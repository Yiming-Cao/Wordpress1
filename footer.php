<?php
/**
 * Site footer: sections, tags, index and the legal line.
 *
 * @package NightCityDispatch
 */

?>
</main>

<footer class="site-footer">
	<div class="container footer__grid">
		<div class="footer__brand">
			<a class="footer__name" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
			<p class="footer__blurb"><?php bloginfo( 'description' ); ?></p>
			<p class="footer__note"><?php esc_html_e( 'Independent fan publication. Printed on stolen bandwidth.', 'night-city-dispatch' ); ?></p>
		</div>

		<div class="footer__col">
			<h2 class="footer__title"><?php esc_html_e( 'Sections', 'night-city-dispatch' ); ?></h2>
			<ul class="footer__list">
				<?php
				wp_list_categories(
					array(
						'title_li'   => '',
						'number'     => 5,
						'orderby'    => 'count',
						'order'      => 'DESC',
						'show_count' => true,
					)
				);
				?>
			</ul>
		</div>

		<div class="footer__col">
			<h2 class="footer__title"><?php esc_html_e( 'Tags', 'night-city-dispatch' ); ?></h2>
			<?php
			wp_tag_cloud(
				array(
					'number'     => 12,
					'smallest'   => 12,
					'largest'    => 12,
					'unit'       => 'px',
					'format'     => 'list',
					'separator'  => '',
					'show_count' => false,
				)
			);
			?>
		</div>

		<div class="footer__col">
			<h2 class="footer__title"><?php esc_html_e( 'Index', 'night-city-dispatch' ); ?></h2>
			<?php
			if ( has_nav_menu( 'footer' ) ) {
				wp_nav_menu(
					array(
						'theme_location' => 'footer',
						'container'      => false,
						'menu_class'     => 'footer__list',
						'depth'          => 1,
					)
				);
			}
			?>
			<ul class="footer__list">
				<li><a href="<?php echo esc_url( get_permalink( (int) get_option( 'page_for_posts' ) ) ); ?>"><?php esc_html_e( 'All files', 'night-city-dispatch' ); ?></a></li>
				<li><a href="<?php echo esc_url( get_feed_link() ); ?>"><?php esc_html_e( 'RSS feed', 'night-city-dispatch' ); ?></a></li>
			</ul>
		</div>
	</div>

	<div class="container footer__bottom">
		<p>&copy; <?php echo esc_html( date_i18n( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'All rights reserved.', 'night-city-dispatch' ); ?></p>
		<p><?php esc_html_e( 'Fan project. Not affiliated with CD Projekt Red.', 'night-city-dispatch' ); ?></p>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
