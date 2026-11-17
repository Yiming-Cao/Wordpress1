<?php
/**
 * Auteurspagina: profiel en de berichten van deze auteur.
 *
 * 中文：author.php 是作者页（/author/名字/）：上半显示头像和文章数，下面是他写的文章。
 *
 * @package NightCityDispatch
 */

get_header();

// 中文：get_queried_object() 拿到当前作者对象；count_user_posts() 数他发表了几篇。
$ncd_author = get_queried_object();
$ncd_count  = (int) count_user_posts( $ncd_author->ID, 'post' );
?>

<header class="page-head">
	<div class="container author-head">
		<div class="author-head__avatar">
			<?php echo get_avatar( $ncd_author->ID, 96, '', $ncd_author->display_name ); ?>
		</div>
		<div>
			<p class="page-head__meta"><?php echo esc_html( sprintf( '%s / %s berichten', ncd_archive_label(), number_format_i18n( $ncd_count ) ) ); ?></p>
			<h1 class="page-head__title"><?php echo esc_html( $ncd_author->display_name ); ?></h1>
			<?php if ( $ncd_author->description ) : ?>
				<p class="page-head__desc"><?php echo esc_html( $ncd_author->description ); ?></p>
			<?php endif; ?>
		</div>
	</div>
</header>

<?php get_template_part( 'template-parts/filters' ); ?>

<section class="section">
	<div class="container">
		<?php if ( have_posts() ) : ?>
			<div class="post-grid">
				<?php
				while ( have_posts() ) :
					the_post();
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
