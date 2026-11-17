<?php
/**
 * Footer: korte tekst, categorieen en een paar links.
 *
 * 中文：footer.php 和 header 一样是全站共用的，被 get_footer() 调用。深色底、三栏。
 *
 * @package NightCityDispatch
 */
?>
</main>

<footer class="site-footer">
	<div class="container footer__grid">
		<div class="footer__col">
			<h2 class="footer__title"><?php bloginfo( 'name' ); ?></h2>
			<p class="footer__text"><?php bloginfo( 'description' ); ?></p>
		</div>

		<div class="footer__col">
			<h2 class="footer__title"><?php esc_html_e( 'Categorieen', 'night-city-dispatch' ); ?></h2>
			<ul class="footer__list">
				<?php
				// 中文：wp_list_categories() 列出分类，并显示每个分类有多少篇文章。
				// Vijf categorieen met het aantal berichten erachter.
				wp_list_categories(
					array(
						'title_li'   => '',
						'number'     => 5,
						'show_count' => true,
					)
				);
				?>
			</ul>
		</div>

		<div class="footer__col">
			<h2 class="footer__title"><?php esc_html_e( 'Links', 'night-city-dispatch' ); ?></h2>
			<?php
			// 中文：如果后台给 footer 位置设了菜单，就显示它；没有就只显示下面的固定链接。
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
				<li><a href="<?php echo esc_url( get_permalink( (int) get_option( 'page_for_posts' ) ) ); ?>"><?php esc_html_e( 'Alle berichten', 'night-city-dispatch' ); ?></a></li>
				<li><a href="<?php echo esc_url( get_feed_link() ); ?>"><?php esc_html_e( 'RSS feed', 'night-city-dispatch' ); ?></a></li>
			</ul>
		</div>
	</div>

	<div class="container footer__bottom">
		<?php // 中文：版权行：年份（date_i18n）+ 站点名。 ?>
		<p>&copy; <?php echo esc_html( date_i18n( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?></p>
		<p><?php esc_html_e( 'Fanproject, niet verbonden aan CD Projekt Red.', 'night-city-dispatch' ); ?></p>
	</div>
</footer>

<?php
// 中文：wp_footer() 必须放在 </body> 前，插件靠它插入自己的脚本。
// Hieronder laden plugins hun eigen scripts en CSS.
wp_footer();
?>
</body>
</html>
