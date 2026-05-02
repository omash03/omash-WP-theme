<div class="site-sidebar-inner" id="site-menu">
	<div class="site-sidebar-header">
		<a class="site-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<span class="site-brand-mark"></span>
			<span class="site-brand-text">
				<strong><?php bloginfo( 'name' ); ?></strong>
				<span><?php esc_html_e( 'Projects & Guides', 'cit351' ); ?></span>
				<span><?php	esc_html_e( 'By Owen Sheffer', 'cit351' ); ?></span>
			</span>
		</a>
		<button class="sidebar-close" type="button" aria-label="<?php esc_attr_e( 'Close menu', 'cit351' ); ?>">
			<span aria-hidden="true">X</span>
		</button>
	</div>

	<nav class="primary-nav" aria-label="<?php esc_attr_e( 'Primary menu', 'cit351' ); ?>">
		<?php
		if ( has_nav_menu( 'primary' ) ) {
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container'      => false,
					'menu_class'     => 'menu',
					'fallback_cb'    => false,
				)
			);
		} else {
			cit351_render_fallback_menu();
		}
		?>
	</nav>

	<div class="sidebar-controls">
		<?php cit351_render_theme_toggle(); ?>
	</div>

	<ul class="social-links" aria-label="<?php esc_attr_e( 'Social links', 'cit351' ); ?>">
		<?php foreach ( cit351_get_social_links() as $link ) : ?>
			<li class="social-link-item social-link-<?php echo esc_attr( $link['slug'] ); ?>">
				<a href="<?php echo esc_url( $link['url'] ); ?>" <?php echo 0 === strpos( $link['url'], 'mailto:' ) ? '' : 'target="_blank" rel="noreferrer noopener"'; ?>>
					<span class="social-link-icon" aria-hidden="true"><?php echo cit351_get_social_icon_markup( $link['slug'] ); ?></span>
					<span class="social-link-label"><?php echo esc_html( $link['label'] ); ?></span>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
</div>