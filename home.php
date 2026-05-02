<?php
get_header();
?>

<section class="content-hero">
	<p class="section-eyebrow"><?php esc_html_e( 'omsLabs', 'cit351' ); ?></p>
	<p class="content-intro"><?php esc_html_e( 'Recent projects, how-to articles, and documentation.', 'cit351' ); ?></p>
</section>

<?php get_template_part( 'template-parts/posts', 'tools' ); ?>

<?php if ( have_posts() ) : ?>
	<section class="post-feed" aria-label="<?php esc_attr_e( 'Posts feed', 'cit351' ); ?>">
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