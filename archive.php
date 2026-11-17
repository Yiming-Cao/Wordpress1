<?php
/**
 * Archief voor categorieen, tags en datums.
 *
 * 中文：archive.php 是分类页、标签页、日期页共用的模板。没有 category.php 时
 * WordPress 会自动用它 —— 这就是「模板层级」，一个文件可以给好几类网址用。
 *
 * @package NightCityDispatch
 */

get_header();

// 中文：从主查询对象里取「一共多少篇」（不是这一页的数量），显示在标题上面。
// Het totaal aantal berichten in dit archief, voor de regel bovenaan.
$ncd_found = (int) $GLOBALS['wp_query']->found_posts;
?>

<header class="page-head">
	<div class="container">
		<p class="page-head__meta"><?php echo esc_html( sprintf( '%s / %s berichten', ncd_archive_label(), number_format_i18n( $ncd_found ) ) ); ?></p>
		<h1 class="page-head__title"><?php echo esc_html( ncd_archive_title() ); ?></h1>
		<?php the_archive_description( '<p class="page-head__desc">', '</p>' ); ?>
	</div>
</header>

<?php // 中文：过滤条单独放在 template-parts/filters.php，几个归档页共用。 ?>
<?php get_template_part( 'template-parts/filters' ); ?>

<section class="section">
	<div class="container">
		<?php if ( have_posts() ) : ?>
			<div class="post-grid">
				<?php
				// 中文：de Loop —— 有文章就一篇篇输出卡片；没有就走 else，显示 content-none 的提示。
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/content-card' );
				endwhile;
				?>
			</div>

			<?php // 中文：页码（每页 6 篇，这个数字在 functions.php 的 pre_get_posts 里设的）。 ?>
			<?php ncd_pagination(); ?>
		<?php else : ?>
			<?php get_template_part( 'template-parts/content-none' ); ?>
		<?php endif; ?>
	</div>
</section>

<?php
get_footer();
