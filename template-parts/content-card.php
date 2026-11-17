<?php
/**
 * Een kaart met een bericht, gebruikt in de grids.
 *
 * 中文：一张卡片 = 图片 + 分类小标签 + 标题 + 摘要 + 日期。
 * 首页、分类页、搜索结果都用这个文件，所以卡片只写一次。
 *
 * @package NightCityDispatch
 */

// 中文：拿这篇文章的第一个分类，当成卡片上方的小标签（kicker）。
// De eerste categorie gebruiken we als klein label boven de titel.
$ncd_card_categories = get_the_category();
?>
<article <?php post_class( 'card' ); ?>>
	<a class="card__media" href="<?php the_permalink(); ?>">
		<?php if ( has_post_thumbnail() ) : ?>
			<?php // 中文：有特色图片就输出（用 ncd-card 尺寸，lazy 延迟加载）；没有就显示灰框。 ?>
			<?php the_post_thumbnail( 'ncd-card', array( 'loading' => 'lazy' ) ); ?>
		<?php else : ?>
			<span class="media-fallback"><?php esc_html_e( 'Geen afbeelding', 'night-city-dispatch' ); ?></span>
		<?php endif; ?>
	</a>

	<div class="card__body">
		<?php if ( $ncd_card_categories ) : ?>
			<a class="card__kicker" href="<?php echo esc_url( get_category_link( $ncd_card_categories[0]->term_id ) ); ?>"><?php echo esc_html( $ncd_card_categories[0]->name ); ?></a>
		<?php endif; ?>

		<h3 class="card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

		<?php // 中文：wp_trim_words() 把摘要截到 16 个词，所有卡片高度差不多。 ?>
		<p class="card__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 16 ) ); ?></p>

		<div class="meta">
			<time class="meta__item" datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
		</div>
	</div>
</article>
