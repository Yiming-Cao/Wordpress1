<?php
/**
 * Blog index, used when a static front page is configured.
 *
 * @package NightCityDispatch
 */

get_header();
?>

<header class="page-head">
	<div class="container">
		<p class="page-head__meta"><?php echo esc_html( sprintf( '%s / %s', ncd_archive_label(), number_format_i18n( (int) $GLOBALS['wp_query']->found_posts ) ) ); ?></p>
		<h1 class="page-head__title"><?php single_post_title(); ?></h1>
		<p class="page-head__desc"><?php esc_html_e( 'Everything the desk has filed so far, newest first.', 'night-city-dispatch' ); ?></p>
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
