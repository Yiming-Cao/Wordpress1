<?php
/**
 * Front page: lead story, latest files, district index and the desk note.
 *
 * @package NightCityDispatch
 */

get_header();

$ncd_lead_query = new WP_Query(
	array(
		'post_type'           => 'post',
		'posts_per_page'      => 4,
		'ignore_sticky_posts' => false,
		'no_found_rows'       => true,
	)
);

$ncd_lead = null;
$ncd_side = array();

if ( $ncd_lead_query->have_posts() ) {
	$ncd_lead = $ncd_lead_query->posts[0];
	$ncd_side = array_slice( $ncd_lead_query->posts, 1, 3 );
}

$ncd_sections = get_categories(
	array(
		'hide_empty' => true,
		'orderby'    => 'count',
		'order'      => 'DESC',
		'number'     => 4,
	)
);
?>

<?php if ( $ncd_lead ) : ?>
	<?php $ncd_lead_cats = get_the_category( $ncd_lead->ID ); ?>
	<section class="hero" aria-labelledby="hero-title">
		<div class="container hero__grid">
			<article class="hero__lead">
				<a class="hero__media" href="<?php echo esc_url( get_permalink( $ncd_lead ) ); ?>" tabindex="-1" aria-hidden="true">
					<?php if ( has_post_thumbnail( $ncd_lead ) ) : ?>
						<?php echo get_the_post_thumbnail( $ncd_lead, 'ncd-hero', array( 'loading' => 'eager' ) ); ?>
					<?php else : ?>
						<span class="media-fallback">NCD</span>
					<?php endif; ?>
				</a>

				<div class="hero__body">
					<?php if ( $ncd_lead_cats ) : ?>
						<a class="hero__kicker" href="<?php echo esc_url( get_category_link( $ncd_lead_cats[0]->term_id ) ); ?>">
							<?php echo esc_html( $ncd_lead_cats[0]->name ); ?>
						</a>
					<?php endif; ?>

					<h1 class="hero__title" id="hero-title">
						<a href="<?php echo esc_url( get_permalink( $ncd_lead ) ); ?>"><?php echo esc_html( get_the_title( $ncd_lead ) ); ?></a>
					</h1>

					<p class="hero__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt( $ncd_lead ), 34 ) ); ?></p>

					<?php ncd_post_meta( $ncd_lead->ID ); ?>
				</div>
			</article>

			<aside class="hero__side">
				<h2 class="side-title"><?php esc_html_e( 'Latest files', 'night-city-dispatch' ); ?></h2>
				<ol class="file-list">
					<?php foreach ( $ncd_side as $ncd_index => $ncd_post ) : ?>
						<li class="file-list__item">
							<span class="file-list__index" aria-hidden="true"><?php echo esc_html( str_pad( (string) ( $ncd_index + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
							<div>
								<a class="file-list__title" href="<?php echo esc_url( get_permalink( $ncd_post ) ); ?>"><?php echo esc_html( get_the_title( $ncd_post ) ); ?></a>
								<span class="file-list__meta"><?php echo esc_html( get_the_date( 'd.m.Y', $ncd_post ) ); ?> / <?php echo esc_html( sprintf( '%d min', ncd_reading_time( $ncd_post->ID ) ) ); ?></span>
							</div>
						</li>
					<?php endforeach; ?>
				</ol>

				<?php if ( $ncd_sections ) : ?>
					<h2 class="side-title side-title--gap"><?php esc_html_e( 'Sections', 'night-city-dispatch' ); ?></h2>
					<ul class="section-list">
						<?php foreach ( $ncd_sections as $ncd_section ) : ?>
							<li class="section-list__item">
								<a href="<?php echo esc_url( get_category_link( $ncd_section->term_id ) ); ?>">
									<span><?php echo esc_html( $ncd_section->name ); ?></span>
									<span class="section-list__count"><?php echo esc_html( number_format_i18n( $ncd_section->count ) ); ?></span>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</aside>
		</div>
	</section>
<?php endif; ?>

<?php
$ncd_latest = new WP_Query(
	array(
		'post_type'           => 'post',
		'posts_per_page'      => 6,
		'offset'              => 4,
		'ignore_sticky_posts' => true,
		'no_found_rows'       => true,
	)
);
?>

<?php if ( $ncd_latest->have_posts() ) : ?>
	<section class="section">
		<div class="container">
			<div class="section__head">
				<h2 class="section__title"><?php esc_html_e( 'Latest transmissions', 'night-city-dispatch' ); ?></h2>
				<a class="section__link" href="<?php echo esc_url( get_permalink( (int) get_option( 'page_for_posts' ) ) ); ?>"><?php esc_html_e( 'All files', 'night-city-dispatch' ); ?></a>
			</div>

			<div class="post-grid">
				<?php
				while ( $ncd_latest->have_posts() ) :
					$ncd_latest->the_post();
					get_template_part( 'template-parts/content-card' );
				endwhile;
				wp_reset_postdata();
				?>
			</div>
		</div>
	</section>
<?php endif; ?>

<?php if ( $ncd_sections ) : ?>
	<section class="section section--districts">
		<div class="container">
			<div class="section__head">
				<h2 class="section__title"><?php esc_html_e( 'Districts', 'night-city-dispatch' ); ?></h2>
				<span class="section__note"><?php esc_html_e( 'Browse the city by section', 'night-city-dispatch' ); ?></span>
			</div>

			<div class="district-grid">
				<?php foreach ( $ncd_sections as $ncd_district ) : ?>
					<a class="district" href="<?php echo esc_url( get_category_link( $ncd_district->term_id ) ); ?>">
						<span class="district__count"><?php echo esc_html( sprintf( _n( '%s file', '%s files', (int) $ncd_district->count, 'night-city-dispatch' ), number_format_i18n( $ncd_district->count ) ) ); ?></span>
						<span class="district__name"><?php echo esc_html( $ncd_district->name ); ?></span>
						<?php if ( $ncd_district->description ) : ?>
							<span class="district__desc"><?php echo esc_html( wp_trim_words( $ncd_district->description, 16 ) ); ?></span>
						<?php endif; ?>
					</a>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
<?php endif; ?>

<?php
$ncd_about     = get_page_by_path( 'about' );
$ncd_about_url = $ncd_about ? get_permalink( $ncd_about ) : home_url( '/?s=about' );
?>
<section class="band">
	<div class="container band__inner">
		<p class="band__text"><?php esc_html_e( 'The Dispatch is written from the street level: districts, gangs, chrome and the people who sell it. No corporate feed, no sponsored copy.', 'night-city-dispatch' ); ?></p>
		<a class="band__link" href="<?php echo esc_url( $ncd_about_url ); ?>"><?php esc_html_e( 'About the desk', 'night-city-dispatch' ); ?></a>
	</div>
</section>

<?php
get_footer();
