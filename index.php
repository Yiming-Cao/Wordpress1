<?php
/**
 * Fallback template dat WordPress verplicht is.
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
