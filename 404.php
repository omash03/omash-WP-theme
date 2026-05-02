<?php
get_header();
?>

<section class="content-hero content-hero-compact empty-state">
	<p class="section-eyebrow"><?php esc_html_e( '404', 'cit351' ); ?></p>
	<h1 class="content-title"><?php esc_html_e( 'That page is not here.', 'cit351' ); ?></h1>
	<p class="content-intro"><?php esc_html_e( 'Try the post archive or return to the homepage.', 'cit351' ); ?></p>
	<div class="hero-actions">
		<a class="button-link button-link-primary" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'cit351' ); ?></a>
		<a class="button-link button-link-secondary" href="<?php echo esc_url( cit351_get_posts_url() ); ?>"><?php esc_html_e( 'Posts', 'cit351' ); ?></a>
	</div>
</section>

<?php
get_footer();
?>