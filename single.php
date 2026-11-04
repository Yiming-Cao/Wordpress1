<?php
/**
 * Single post: dossier header, paper reading surface, file data and related files.
 *
 * @package NightCityDispatch
 */

get_header();

while ( have_posts() ) :
	the_post();

	$ncd_categories = get_the_category();
	$ncd_author_id  = (int) get_post_field( 'post_author', get_the_ID() );
	?>
	<div class="progress" aria-hidden="true"><span class="progress__bar"></span></div>

	<article <?php post_class( 'entry' ); ?>>
		<header class="entry__header">
			<div class="container entry__header-inner">
				<p class="entry__path">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Dispatch', 'night-city-dispatch' ); ?></a>
					<?php if ( $ncd_categories ) : ?>
						<span aria-hidden="true">/</span>
						<a href="<?php echo esc_url( get_category_link( $ncd_categories[0]->term_id ) ); ?>"><?php echo esc_html( $ncd_categories[0]->name ); ?></a>
					<?php endif; ?>
				</p>

				<h1 class="entry__title"><?php the_title(); ?></h1>

				<?php ncd_post_meta(); ?>
			</div>
		</header>

		<?php if ( has_post_thumbnail() ) : ?>
			<figure class="entry__hero">
				<?php the_post_thumbnail( 'ncd-hero', array( 'loading' => 'eager' ) ); ?>
				<?php if ( get_the_post_thumbnail_caption() ) : ?>
					<figcaption><?php the_post_thumbnail_caption(); ?></figcaption>
				<?php endif; ?>
			</figure>
		<?php endif; ?>

		<div class="container entry__layout">
			<div class="entry__content prose">
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

			<aside class="entry__aside" aria-label="<?php esc_attr_e( 'File data', 'night-city-dispatch' ); ?>">
				<h2 class="aside__title"><?php esc_html_e( 'File data', 'night-city-dispatch' ); ?></h2>

				<dl class="data-list">
					<?php if ( $ncd_categories ) : ?>
						<dt><?php esc_html_e( 'Section', 'night-city-dispatch' ); ?></dt>
						<dd><a href="<?php echo esc_url( get_category_link( $ncd_categories[0]->term_id ) ); ?>"><?php echo esc_html( $ncd_categories[0]->name ); ?></a></dd>
					<?php endif; ?>

					<dt><?php esc_html_e( 'Filed', 'night-city-dispatch' ); ?></dt>
					<dd><time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date( 'd.m.Y' ) ); ?></time></dd>

					<dt><?php esc_html_e( 'Writer', 'night-city-dispatch' ); ?></dt>
					<dd><a href="<?php echo esc_url( get_author_posts_url( $ncd_author_id ) ); ?>"><?php echo esc_html( get_the_author_meta( 'display_name', $ncd_author_id ) ); ?></a></dd>

					<dt><?php esc_html_e( 'Length', 'night-city-dispatch' ); ?></dt>
					<dd><?php echo esc_html( sprintf( '%s words / %d min', number_format_i18n( ncd_word_count() ), ncd_reading_time() ) ); ?></dd>

					<dt><?php esc_html_e( 'Comments', 'night-city-dispatch' ); ?></dt>
					<dd><?php echo esc_html( number_format_i18n( get_comments_number() ) ); ?></dd>
				</dl>

				<?php $ncd_tags = get_the_tags(); ?>
				<?php if ( $ncd_tags ) : ?>
					<h2 class="aside__title"><?php esc_html_e( 'Tags', 'night-city-dispatch' ); ?></h2>
					<div class="tag-list">
						<?php foreach ( $ncd_tags as $ncd_tag ) : ?>
							<a class="chip" href="<?php echo esc_url( get_tag_link( $ncd_tag->term_id ) ); ?>" rel="tag"><?php echo esc_html( $ncd_tag->name ); ?></a>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</aside>
		</div>

		<footer class="entry__footer">
			<div class="container">
				<section class="author-box">
					<div class="author-box__avatar">
						<?php echo get_avatar( $ncd_author_id, 96 ); ?>
					</div>
					<div>
						<h2 class="author-box__name"><?php echo esc_html( get_the_author_meta( 'display_name', $ncd_author_id ) ); ?></h2>
						<?php if ( get_the_author_meta( 'description', $ncd_author_id ) ) : ?>
							<p class="author-box__bio"><?php echo esc_html( get_the_author_meta( 'description', $ncd_author_id ) ); ?></p>
						<?php endif; ?>
						<a class="text-link" href="<?php echo esc_url( get_author_posts_url( $ncd_author_id ) ); ?>">
							<?php esc_html_e( 'All files by this writer', 'night-city-dispatch' ); ?>
						</a>
					</div>
				</section>

				<?php
				$ncd_prev = get_previous_post();
				$ncd_next = get_next_post();
				?>
				<?php if ( $ncd_prev || $ncd_next ) : ?>
					<nav class="post-nav" aria-label="<?php esc_attr_e( 'More files', 'night-city-dispatch' ); ?>">
						<?php if ( $ncd_prev ) : ?>
							<a class="post-nav__link" href="<?php echo esc_url( get_permalink( $ncd_prev ) ); ?>">
								<span class="post-nav__label"><?php esc_html_e( 'Previous file', 'night-city-dispatch' ); ?></span>
								<strong><?php echo esc_html( get_the_title( $ncd_prev ) ); ?></strong>
							</a>
						<?php endif; ?>
						<?php if ( $ncd_next ) : ?>
							<a class="post-nav__link post-nav__link--next" href="<?php echo esc_url( get_permalink( $ncd_next ) ); ?>">
								<span class="post-nav__label"><?php esc_html_e( 'Next file', 'night-city-dispatch' ); ?></span>
								<strong><?php echo esc_html( get_the_title( $ncd_next ) ); ?></strong>
							</a>
						<?php endif; ?>
					</nav>
				<?php endif; ?>
			</div>
		</footer>
	</article>

	<?php
	$ncd_related = ncd_related_posts( get_the_ID(), 3 );

	if ( $ncd_related->have_posts() ) :
		?>
		<section class="section section--related">
			<div class="container">
				<div class="section__head">
					<h2 class="section__title"><?php esc_html_e( 'Related files', 'night-city-dispatch' ); ?></h2>
				</div>
				<div class="post-grid">
					<?php
					while ( $ncd_related->have_posts() ) :
						$ncd_related->the_post();
						get_template_part( 'template-parts/content-card' );
					endwhile;
					wp_reset_postdata();
					?>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<?php comments_template(); ?>

	<?php
endwhile;

get_footer();
