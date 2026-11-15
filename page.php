<?php
/**
 * Template voor een statische pagina.
 *
 * @package NightCityDispatch
 */

get_header();

while ( have_posts() ) :
	the_post();
	?>
	<article <?php post_class( 'entry' ); ?>>
		<div class="container">
			<header class="entry__header">
				<h1 class="entry__title"><?php the_title(); ?></h1>
			</header>

			<?php // Niet elke pagina heeft een afbeelding, dus eerst controleren. ?>
			<?php if ( has_post_thumbnail() ) : ?>
				<figure class="entry__image">
					<?php the_post_thumbnail( 'ncd-hero' ); ?>
				</figure>
			<?php endif; ?>

			<div class="entry__content prose">
				<?php the_content(); ?>

				<?php
				// Bestaat de pagina uit meerdere delen? Dan komen hier de paginanummers.
				wp_link_pages(
					array(
						'before' => '<nav class="page-links">' . esc_html__( 'Pagina:', 'night-city-dispatch' ),
						'after'  => '</nav>',
					)
				);
				?>
			</div>

			<?php
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
			?>
		</div>
	</article>
	<?php
endwhile;

get_footer();
