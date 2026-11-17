<?php
/**
 * Enkel bericht: titel, meta, afbeelding, inhoud, tags en de comments.
 *
 * 中文：single.php 只负责「一篇文章」的页面。模板层级：/een-bericht/ 这种网址就用它。
 *
 * @package NightCityDispatch
 */

get_header();

// 中文：de Loop。the_post() 之后，the_title()、the_content() 不用传 ID 就输出当前文章。
// De Loop: the_post() zet het bericht klaar, daarna werken the_title() en the_content().
while ( have_posts() ) :
	the_post();

	$ncd_categories = get_the_category();
	?>
	<article <?php post_class( 'entry' ); ?>>
		<div class="container">
			<header class="entry__header">
				<?php if ( $ncd_categories ) : ?>
					<a class="entry__kicker" href="<?php echo esc_url( get_category_link( $ncd_categories[0]->term_id ) ); ?>"><?php echo esc_html( $ncd_categories[0]->name ); ?></a>
				<?php endif; ?>

				<h1 class="entry__title"><?php the_title(); ?></h1>

				<?php // 中文：自己写的函数（inc/template-tags.php），输出日期 + 作者链接。 ?>
				<?php ncd_post_meta(); ?>
			</header>

			<?php if ( has_post_thumbnail() ) : ?>
				<figure class="entry__image">
					<?php the_post_thumbnail( 'ncd-hero' ); ?>
				</figure>
			<?php endif; ?>

			<div class="entry__content prose">
				<?php // 中文：the_content() 输出编辑器里写的全部内容（段落、图片、短代码都在里面）。 ?>
				<?php the_content(); ?>

				<?php
				wp_link_pages(
					array(
						'before' => '<nav class="page-links">' . esc_html__( 'Pagina:', 'night-city-dispatch' ),
						'after'  => '</nav>',
					)
				);
				?>
			</div>

			<?php // 中文：get_the_tags() 取标签，每个标签链接到 /tag/xxx/ 的归档页。 ?>
			<?php $ncd_tags = get_the_tags(); ?>
			<?php if ( $ncd_tags ) : ?>
				<div class="tag-list">
					<?php foreach ( $ncd_tags as $ncd_tag ) : ?>
						<a class="chip" href="<?php echo esc_url( get_tag_link( $ncd_tag->term_id ) ); ?>" rel="tag"><?php echo esc_html( $ncd_tag->name ); ?></a>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>

			<?php
			// 中文：上一篇 / 下一篇，WordPress 自带的两个函数，不用自己写查询。
			$ncd_previous = get_previous_post();
			$ncd_next     = get_next_post();
			?>
			<?php if ( $ncd_previous || $ncd_next ) : ?>
				<nav class="post-nav" aria-label="<?php esc_attr_e( 'Meer berichten', 'night-city-dispatch' ); ?>">
					<?php if ( $ncd_previous ) : ?>
						<a class="post-nav__link" href="<?php echo esc_url( get_permalink( $ncd_previous ) ); ?>">
							<span class="post-nav__label"><?php esc_html_e( 'Vorig bericht', 'night-city-dispatch' ); ?></span>
							<strong><?php echo esc_html( get_the_title( $ncd_previous ) ); ?></strong>
						</a>
					<?php endif; ?>

					<?php if ( $ncd_next ) : ?>
						<a class="post-nav__link post-nav__link--next" href="<?php echo esc_url( get_permalink( $ncd_next ) ); ?>">
							<span class="post-nav__label"><?php esc_html_e( 'Volgend bericht', 'night-city-dispatch' ); ?></span>
							<strong><?php echo esc_html( get_the_title( $ncd_next ) ); ?></strong>
						</a>
					<?php endif; ?>
				</nav>
			<?php endif; ?>

			<?php // 中文：comments_template() 加载 comments.php，评论区也只写一份代码。 ?>
			<?php // Reacties van bezoekers, met het formulier van WordPress. ?>
			<?php comments_template(); ?>
		</div>
	</article>
	<?php
endwhile;

get_footer();
