<?php
/**
 * Template voor een statische pagina.
 *
 * 中文：page.php 是固定页面（比如 Over ons、Contact）用的模板。
 * 和 single.php 很像，但没有日期、作者、标签和上下篇。
 *
 * @package NightCityDispatch
 */

get_header();

while ( have_posts() ) :
	the_post();
	?>
	<article <?php post_class( 'entry' ); ?>>
		<div class="container">
			<header class="entry__header">
				<h1 class="entry__title"><?php the_title(); ?></h1>
			</header>

			<?php // 中文：has_post_thumbnail() 先判断有没有特色图片，有才输出，避免出现空图。 ?>
			<?php // Niet elke pagina heeft een afbeelding, dus eerst controleren. ?>
			<?php if ( has_post_thumbnail() ) : ?>
				<figure class="entry__image">
					<?php the_post_thumbnail( 'ncd-hero' ); ?>
				</figure>
			<?php endif; ?>

			<div class="entry__content prose">
				<?php the_content(); ?>

				<?php
				// Bestaat de pagina uit meerdere delen? Dan komen hier de paginanummers.
				wp_link_pages(
					array(
						'before' => '<nav class="page-links">' . esc_html__( 'Pagina:', 'night-city-dispatch' ),
						'after'  => '</nav>',
					)
				);
				?>
			</div>

			<?php
			// 中文：页面允许评论、或者已经有评论时，才显示评论区。
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
			?>
		</div>
	</article>
	<?php
endwhile;

get_footer();
