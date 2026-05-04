<?php
$site_name = get_bloginfo( 'name' );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script>
		(function() {
			var theme = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';

			try {
				var storedTheme = window.localStorage.getItem('cit351-theme');

				if (storedTheme === 'light' || storedTheme === 'dark') {
					theme = storedTheme;
				}
			} catch (error) {
				/* Ignore storage access issues. */
			}

			document.documentElement.setAttribute('data-theme', theme);
			document.documentElement.style.colorScheme = theme;
		})();
	</script>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="site-frame">
	<header class="site-mobile-header">
		<a class="site-brand site-brand-mobile" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<span class="site-brand-mark"></span>
			<span class="site-brand-text">
				<strong><?php echo esc_html( $site_name ); ?></strong>
				<span><?php esc_html_e( 'Projects & Guides', 'cit351' ); ?></span>
			</span>
		</a>
		<div class="site-mobile-actions">
			<?php cit351_render_theme_toggle( 'theme-toggle-mobile' ); ?>
			<button class="menu-toggle" type="button" aria-expanded="false" aria-controls="site-sidebar-panel">
				<span></span>
				<span></span>
				<span></span>
				<span class="screen-reader-text"><?php esc_html_e( 'Toggle menu', 'cit351' ); ?></span>
			</button>
		</div>
	</header>

	<div class="site-layout">
		<aside class="site-sidebar-panel" id="site-sidebar-panel" aria-label="<?php esc_attr_e( 'Sidebar', 'cit351' ); ?>">
			<?php get_template_part( 'template-parts/site', 'sidebar' ); ?>
		</aside>
		<div class="site-overlay" hidden></div>
		<main id="site-content" class="site-content" tabindex="-1">