<?php
get_header();
?>

<section class="content-hero content-hero-compact">
	<p class="section-eyebrow"><?php esc_html_e( 'Archive', 'cit351' ); ?></p>
	<h1 class="content-title"><?php the_archive_title(); ?></h1>
	<?php the_archive_description( '<div class="content-intro archive-description">', '</div>' ); ?>
</section>

<?php get_template_part( 'template-parts/posts', 'tools' ); ?>

<?php if ( have_posts() ) : ?>
	<section class="post-feed" aria-label="<?php esc_attr_e( 'Archive posts', 'cit351' ); ?>">
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