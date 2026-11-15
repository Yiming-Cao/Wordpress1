<?php
/**
 * Voorpagina: een uitgelicht bericht, de nieuwste berichten en de categorieen.
 *
 * @package NightCityDispatch
 */

get_header();

$ncd_query = new WP_Query(
	array(
		'post_type'           => 'post',
		'posts_per_page'      => 7,
		'ignore_sticky_posts' => true,
		'no_found_rows'       => true, // Geen paginering nodig op de voorpagina, dus dit is sneller.
	)
);

if ( $ncd_query->have_posts() ) :

	// Het eerste bericht wordt het grote bericht bovenaan.
	$ncd_query->the_post();
	$ncd_categories = get_the_category();
	?>
	<section class="hero">
		<div class="container">
			<article <?php post_class( 'hero__lead' ); ?>>
				<a class="hero__media" href="<?php the_permalink(); ?>">
					<?php if ( has_post_thumbnail() ) : ?>
						<?php the_post_thumbnail( 'ncd-hero' ); ?>
					<?php else : ?>
						<span class="media-fallback"><?php esc_html_e( 'Geen afbeelding', 'night-city-dispatch' ); ?></span>
					<?php endif; ?>
				</a>

				<div class="hero__body">
					<?php if ( $ncd_categories ) : ?>
						<a class="hero__kicker" href="<?php echo esc_url( get_category_link( $ncd_categories[0]->term_id ) ); ?>"><?php echo esc_html( $ncd_categories[0]->name ); ?></a>
					<?php endif; ?>

					<h1 class="hero__title">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h1>

					<p class="hero__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 30 ) ); ?></p>

					<?php ncd_post_meta(); ?>
				</div>
			</article>
		</div>
	</section>

	<section class="section">
		<div class="container">
			<div class="section__head">
				<h2 class="section__title"><?php esc_html_e( 'Nieuwste berichten', 'night-city-dispatch' ); ?></h2>
				<a class="section__link" href="<?php echo esc_url( get_permalink( (int) get_option( 'page_for_posts' ) ) ); ?>"><?php esc_html_e( 'Alle berichten', 'night-city-dispatch' ); ?></a>
			</div>

			<div class="post-grid">
				<?php
				// De rest van de query wordt hieronder als grid getoond.
				while ( $ncd_query->have_posts() ) :
					$ncd_query->the_post();
					get_template_part( 'template-parts/content-card' );
				endwhile;
				// Zet de standaard post terug, anders werkt de Loop hierna niet meer.
				wp_reset_postdata();
				?>
			</div>
		</div>
	</section>

<?php endif; ?>

<?php
$ncd_categories = get_categories(
	array(
		'hide_empty' => true,
		'number'     => 6,
	)
);

if ( $ncd_categories ) :
	?>
	<section class="section">
		<div class="container">
			<div class="section__head">
				<h2 class="section__title"><?php esc_html_e( 'Categorieen', 'night-city-dispatch' ); ?></h2>
			</div>

			<div class="cat-grid">
				<?php foreach ( $ncd_categories as $ncd_category ) : ?>
					<a class="cat-box" href="<?php echo esc_url( get_category_link( $ncd_category->term_id ) ); ?>">
						<span class="cat-box__name"><?php echo esc_html( $ncd_category->name ); ?></span>
						<span class="cat-box__count"><?php echo esc_html( sprintf( _n( '%s bericht', '%s berichten', (int) $ncd_category->count, 'night-city-dispatch' ), number_format_i18n( $ncd_category->count ) ) ); ?></span>
					</a>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
<?php endif; ?>

<?php
get_footer();
