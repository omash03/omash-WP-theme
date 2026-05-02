<?php
get_header();
?>

<?php
while ( have_posts() ) :
	the_post();
	$toc_panel_id = 'post-toc-panel-' . get_the_ID();
	?>
	<div class="single-post-layout">
		<section class="post-toc-shell" data-post-toc aria-label="<?php esc_attr_e( 'Table of contents', 'cit351' ); ?>">
			<div class="tool-card post-toc-card">
				<button class="posts-tools-toggle post-toc-toggle" type="button" aria-expanded="false" aria-controls="<?php echo esc_attr( $toc_panel_id ); ?>">
					<span class="posts-tools-toggle-copy">
						<span class="posts-tools-toggle-title"><?php esc_html_e( 'Table of Contents', 'cit351' ); ?></span>
					</span>
					<span class="posts-tools-toggle-indicator" aria-hidden="true"></span>
				</button>
				<div class="posts-tools-panel post-toc-panel" id="<?php echo esc_attr( $toc_panel_id ); ?>" hidden>
					<nav class="post-toc-nav" aria-label="<?php esc_attr_e( 'Table of contents', 'cit351' ); ?>"></nav>
				</div>
			</div>
		</section>

		<article <?php post_class( 'entry-single' ); ?>>
			<header class="entry-header">
				<p class="entry-date"><?php echo esc_html( get_the_date() ); ?></p>
				<h1 class="entry-title"><?php the_title(); ?></h1>
				<?php if ( has_post_thumbnail() ) : ?>
					<figure class="entry-thumbnail"><?php the_post_thumbnail( 'large' ); ?></figure>
				<?php endif; ?>
			</header>

			<div class="entry-content">
				<?php the_content(); ?>
			</div>

			<footer class="entry-footer">
				<div class="entry-taxonomy">
					<?php if ( has_category() ) : ?>
						<p><?php the_category( ', ' ); ?></p>
					<?php endif; ?>
					<?php the_tags( '<p>', ', ', '</p>' ); ?>
				</div>

				<nav class="post-nav" aria-label="<?php esc_attr_e( 'Post navigation', 'cit351' ); ?>">
					<div><?php previous_post_link( '%link', '&larr; %title' ); ?></div>
					<div><?php next_post_link( '%link', '%title &rarr;' ); ?></div>
				</nav>
			</footer>
		</article>
	</div>
	<?php
endwhile;
?>

<?php
get_footer();
?>