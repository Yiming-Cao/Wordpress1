<?php
/**
 * Fallback template dat WordPress verplicht is.
 *
 * 中文：index.php 是最后的兜底模板，WordPress 规定每个主题必须有它。
 * 别的模板都找不到时才会走到这里。
 *
 * @package NightCityDispatch
 */

get_header();
?>

<header class="page-head">
	<div class="container">
		<h1 class="page-head__title"><?php echo esc_html( ncd_archive_title() ); ?></h1>
	</div>
</header>

<section class="section">
	<div class="container">
		<?php if ( have_posts() ) : ?>
			<div class="post-grid">
				<?php
				while ( have_posts() ) :
					the_post();
					// 中文：de Loop + get_template_part：每篇文章都用同一张卡片模板输出。
					// Elk bericht wordt met dezelfde kaart getekend.
					get_template_part( 'template-parts/content-card' );
				endwhile;
				?>
			</div>

			<?php ncd_pagination(); ?>
		<?php else : ?>
			<?php get_template_part( 'template-parts/content-none' ); ?>
		<?php endif; ?>
	</div>
</section>

<?php
get_footer();
