<?php
/**
 * Static page template.
 *
 * @package NightCityDispatch
 */

get_header();

while ( have_posts() ) :
	the_post();
	?>
	<article <?php post_class( 'page' ); ?>>
		<header class="entry__header">
			<div class="container entry__header-inner">
				<p class="entry__path">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Dispatch', 'night-city-dispatch' ); ?></a>
					<span aria-hidden="true">/</span>
					<span><?php esc_html_e( 'Page', 'night-city-dispatch' ); ?></span>
				</p>
				<h1 class="entry__title"><?php the_title(); ?></h1>
			</div>
		</header>

		<?php if ( has_post_thumbnail() ) : ?>
			<figure class="entry__hero">
				<?php the_post_thumbnail( 'ncd-hero' ); ?>
			</figure>
		<?php endif; ?>

		<div class="container page__layout">
			<div class="page__content prose">
				<?php the_content(); ?>
				<?php
				wp_link_pages(
					array(
						'before' => '<nav class="page-links">' . esc_html__( 'Pages:', 'night-city-dispatch' ),
						'after'  => '</nav>',
					)
				);
				?>
			</div>
		</div>
	</article>

	<?php if ( comments_open() || get_comments_number() ) : ?>
		<?php comments_template(); ?>
	<?php endif; ?>
	<?php
endwhile;

get_footer();
