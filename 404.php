<?php
/**
 * 404: signal lost.
 *
 * @package NightCityDispatch
 */

get_header();
?>

<section class="lost">
	<div class="container lost__inner">
		<p class="lost__code" aria-hidden="true">404</p>
		<h1 class="lost__title"><?php esc_html_e( 'Signal lost', 'night-city-dispatch' ); ?></h1>
		<p class="lost__text"><?php esc_html_e( 'The file you are looking for is not in the archive. It may have been scrubbed, moved, or it never existed outside a fixer’s pitch.', 'night-city-dispatch' ); ?></p>

		<div class="lost__search"><?php get_search_form(); ?></div>

		<div class="lost__actions">
			<a class="button" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Back to the front page', 'night-city-dispatch' ); ?></a>
		</div>
	</div>
</section>

<?php
$ncd_recent = new WP_Query(
	array(
		'post_type'           => 'post',
		'posts_per_page'      => 3,
		'ignore_sticky_posts' => true,
		'no_found_rows'       => true,
	)
);

if ( $ncd_recent->have_posts() ) :
	?>
	<section class="section">
		<div class="container">
			<div class="section__head">
				<h2 class="section__title"><?php esc_html_e( 'Recent files', 'night-city-dispatch' ); ?></h2>
			</div>
			<div class="post-grid">
				<?php
				while ( $ncd_recent->have_posts() ) :
					$ncd_recent->the_post();
					get_template_part( 'template-parts/content-card' );
				endwhile;
				wp_reset_postdata();
				?>
			</div>
		</div>
	</section>
<?php endif; ?>

<?php
get_footer();
