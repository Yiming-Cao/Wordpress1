<?php
/**
 * Author archive: profile block plus the writer's files.
 *
 * @package NightCityDispatch
 */

get_header();

$ncd_author = get_queried_object();
$ncd_count  = (int) count_user_posts( $ncd_author->ID, 'post' );
?>

<header class="page-head page-head--author">
	<div class="container author-head">
		<div class="author-head__avatar">
			<?php echo get_avatar( $ncd_author->ID, 120, '', $ncd_author->display_name ); ?>
		</div>
		<div>
			<p class="page-head__meta"><?php echo esc_html( sprintf( '%s / %s', ncd_archive_label(), number_format_i18n( $ncd_count ) ) ); ?></p>
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
