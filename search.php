<?php
get_header();
?>

<section class="content-hero content-hero-compact">
	<p class="section-eyebrow"><?php esc_html_e( 'Search', 'cit351' ); ?></p>
	<h1 class="content-title">
		<?php
		printf(
			esc_html__( 'Results for "%s"', 'cit351' ),
			esc_html( get_search_query() )
		);
		?>
	</h1>
</section>

<?php if ( have_posts() ) : ?>
	<section class="post-feed" aria-label="<?php esc_attr_e( 'Search results', 'cit351' ); ?>">
		<?php
		while ( have_posts() ) :
			the_post();
			get_template_part( 'template-parts/content', 'excerpt' );
		endwhile;
		?>
	</section>

	<?php the_posts_pagination(); ?>
<?php else : ?>
	<?php get_template_part( 'template-parts/content', 'none' ); ?>
<?php endif; ?>

<?php
get_footer();
?>