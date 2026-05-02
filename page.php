<?php
get_header();
?>

<?php
while ( have_posts() ) :
	the_post();
	?>
	<article <?php post_class( 'entry-page' ); ?>>
		<header class="entry-header">
			<p class="section-eyebrow"><?php esc_html_e( 'Page', 'cit351' ); ?></p>
			<h1 class="entry-title"><?php the_title(); ?></h1>
		</header>
		<div class="entry-content">
			<?php the_content(); ?>
		</div>
	</article>
	<?php
endwhile;
?>

<?php
get_footer();
?>