<?php

function cit351_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
			'navigation-widgets',
		)
	);
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 120,
			'width'       => 120,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	add_editor_style( 'style.css' );

	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'cit351' ),
			'footer'  => __( 'Footer Menu', 'cit351' ),
		)
	);
}
add_action( 'after_setup_theme', 'cit351_setup' );

function cit351_enqueue_assets() {
	$style_path = get_stylesheet_directory() . '/style.css';
	$script_path = get_template_directory() . '/assets/js/theme.js';
	$style_version = file_exists( $style_path ) ? filemtime( $style_path ) : wp_get_theme()->get( 'Version' );
	$script_version = file_exists( $script_path ) ? filemtime( $script_path ) : wp_get_theme()->get( 'Version' );

	wp_enqueue_style( 'cit351-style', get_stylesheet_uri(), array(), $style_version );
	wp_enqueue_script( 'cit351-theme', get_template_directory_uri() . '/assets/js/theme.js', array(), $script_version, true );
}
add_action( 'wp_enqueue_scripts', 'cit351_enqueue_assets' );

function cit351_get_theme_icon_markup( $theme ) {
	$icons = array(
		'dark'  => '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M20.2 15.65a8.9 8.9 0 0 1-4.32 1.11c-4.94 0-8.95-4.01-8.95-8.96 0-1.11.2-2.18.59-3.17a.92.92 0 0 0-1.23-1.15A10.7 10.7 0 1 0 21.22 16.9a.92.92 0 0 0-1.03-1.25Z" fill="currentColor"/></svg>',
		'light' => '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M12 5.1a.9.9 0 0 1 .9.9V3.9a.9.9 0 1 1-1.8 0V6a.9.9 0 0 1 .9-.9Zm0 12.9a.9.9 0 0 1 .9.9V21a.9.9 0 1 1-1.8 0v-2.1a.9.9 0 0 1 .9-.9Zm6.9-6.9a.9.9 0 0 1 .9-.9H21a.9.9 0 1 1 0 1.8h-2.1a.9.9 0 0 1-.9-.9Zm-12.9 0a.9.9 0 0 1 .9-.9H9a.9.9 0 1 1 0 1.8H6a.9.9 0 0 1-.9-.9Zm10.87-4.77a.9.9 0 0 1 1.27 0l1.48 1.48a.9.9 0 0 1-1.27 1.27l-1.48-1.48a.9.9 0 0 1 0-1.27Zm-9.54 9.54a.9.9 0 0 1 1.27 0l1.48 1.48a.9.9 0 0 1-1.27 1.27L7.32 17.4a.9.9 0 0 1 0-1.27Zm9.54 1.48a.9.9 0 0 1 0 1.27l-1.48 1.48a.9.9 0 0 1-1.27-1.27l1.48-1.48a.9.9 0 0 1 1.27 0ZM8.59 6.32a.9.9 0 0 1 0 1.27L7.11 9.07A.9.9 0 0 1 5.84 7.8l1.48-1.48a.9.9 0 0 1 1.27 0ZM12 7.2a4.8 4.8 0 1 0 0 9.6 4.8 4.8 0 0 0 0-9.6Z" fill="currentColor"/></svg>',
	);

	if ( isset( $icons[ $theme ] ) ) {
		return $icons[ $theme ];
	}

	return '';
}

function cit351_render_theme_toggle( $class_name = '' ) {
	$class_names = trim( 'theme-toggle ' . $class_name );
	?>
	<button class="<?php echo esc_attr( $class_names ); ?>" type="button" data-theme-toggle aria-pressed="false" aria-label="<?php esc_attr_e( 'Toggle theme', 'cit351' ); ?>">
		<span class="theme-toggle-track" aria-hidden="true">
			<span class="theme-toggle-thumb">
				<span class="theme-toggle-icon theme-toggle-icon-dark" data-theme-toggle-icon="dark" aria-hidden="true"><?php echo cit351_get_theme_icon_markup( 'dark' ); ?></span>
				<span class="theme-toggle-icon theme-toggle-icon-light" data-theme-toggle-icon="light" aria-hidden="true"><?php echo cit351_get_theme_icon_markup( 'light' ); ?></span>
			</span>
		</span>
		<span class="theme-toggle-copy" aria-hidden="true">
			<span class="theme-toggle-label"><?php esc_html_e( 'Theme', 'cit351' ); ?></span>
			<span class="theme-toggle-state" data-theme-toggle-state><?php esc_html_e( 'Dark', 'cit351' ); ?></span>
		</span>
	</button>
	<?php
}

function cit351_get_posts_url() {
	$page_for_posts = (int) get_option( 'page_for_posts' );

	if ( $page_for_posts ) {
		return get_permalink( $page_for_posts );
	}

	return home_url( '/posts/' );
}

function cit351_get_primary_nav_items() {
	$home_url  = trailingslashit( home_url( '/' ) );
	$posts_url = cit351_get_posts_url();

	if ( is_front_page() ) {
		return array(
			array(
				'label' => __( 'Intro', 'cit351' ),
				'url'   => '#intro',
			),
			array(
				'label' => __( 'About', 'cit351' ),
				'url'   => '#about',
			),
			array(
				'label' => __( 'Credentials', 'cit351' ),
				'url'   => '#credentials',
			),
			array(
				'label' => __( 'Posts', 'cit351' ),
				'url'   => $posts_url,
			),
			array(
				'label' => __( 'Contact', 'cit351' ),
				'url'   => '#contact',
			),
		);
	}

	return array(
		array(
			'label' => __( 'Home', 'cit351' ),
			'url'   => $home_url,
		),
		array(
			'label' => __( 'About', 'cit351' ),
			'url'   => $home_url . '#about',
		),
		array(
			'label' => __( 'Credentials', 'cit351' ),
			'url'   => $home_url . '#credentials',
		),
		array(
			'label' => __( 'Posts', 'cit351' ),
			'url'   => $posts_url,
		),
		array(
			'label' => __( 'Contact', 'cit351' ),
			'url'   => $home_url . '#contact',
		),
	);
}

function cit351_get_social_links() {
	return array(
		array(
			'label' => __( 'LinkedIn', 'cit351' ),
			'url'   => 'https://www.linkedin.com/in/owen-sheffer/',
			'slug'  => 'linkedin',
		),
		array(
			'label' => __( 'GitHub', 'cit351' ),
			'url'   => 'https://github.com/omash03',
			'slug'  => 'github',
		),
		array(
			'label' => __( 'Email', 'cit351' ),
			'url'   => 'mailto:owen@omslabs.net',
			'slug'  => 'email',
		),
	);
}

function cit351_get_social_icon_markup( $slug ) {
	$icons = array(
		'linkedin' => '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M6.94 8.5V19H3.5V8.5h3.44Zm.23-3.24c0 1.02-.77 1.84-1.95 1.84H5.2c-1.13 0-1.89-.82-1.89-1.84 0-1.04.78-1.84 1.93-1.84s1.9.8 1.93 1.84ZM20.5 12.57V19h-3.43v-6.03c0-1.52-.54-2.55-1.9-2.55-1.03 0-1.64.69-1.91 1.36-.1.24-.12.57-.12.91V19H9.7s.04-9.69 0-10.5h3.44v1.49c.46-.7 1.27-1.69 3.09-1.69 2.25 0 3.94 1.47 3.94 4.63Z" fill="currentColor"/></svg>',
		'github'   => '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M12 .5C5.65.5.5 5.66.5 12.03c0 5.1 3.3 9.42 7.88 10.95.58.1.79-.25.79-.57 0-.28-.01-1.03-.02-2.03-3.2.7-3.87-1.55-3.87-1.55-.52-1.34-1.28-1.69-1.28-1.69-1.05-.72.08-.71.08-.71 1.16.08 1.78 1.2 1.78 1.2 1.04 1.78 2.72 1.27 3.38.97.1-.76.4-1.27.73-1.56-2.55-.29-5.23-1.28-5.23-5.68 0-1.26.45-2.28 1.18-3.08-.12-.29-.51-1.46.11-3.04 0 0 .96-.31 3.15 1.18a10.9 10.9 0 0 1 5.73 0c2.18-1.49 3.14-1.18 3.14-1.18.63 1.58.24 2.75.12 3.04.74.8 1.18 1.82 1.18 3.08 0 4.41-2.68 5.39-5.24 5.67.41.36.78 1.09.78 2.19 0 1.58-.02 2.85-.02 3.24 0 .32.21.68.8.57 4.57-1.53 7.86-5.85 7.86-10.95C23.5 5.66 18.35.5 12 .5Z" fill="currentColor"/></svg>',
		'email'    => '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M3 5.5h18A1.5 1.5 0 0 1 22.5 7v10A1.5 1.5 0 0 1 21 18.5H3A1.5 1.5 0 0 1 1.5 17V7A1.5 1.5 0 0 1 3 5.5Zm0 1.5v.26l9 5.54 9-5.54V7H3Zm18 10V9.02l-8.61 5.3a.75.75 0 0 1-.78 0L3 9.02V17h18Z" fill="currentColor"/></svg>',
	);

	if ( isset( $icons[ $slug ] ) ) {
		return $icons[ $slug ];
	}

	return '';
}

function cit351_render_fallback_menu() {
	$items = cit351_get_primary_nav_items();

	echo '<ul class="menu fallback-menu">';

	foreach ( $items as $item ) {
		printf(
			'<li class="menu-item"><a href="%1$s">%2$s</a></li>',
			esc_url( $item['url'] ),
			esc_html( $item['label'] )
		);
	}

	echo '</ul>';
}

function cit351_body_classes( $classes ) {
	if ( is_singular( 'post' ) ) {
		$classes[] = 'has-post-toc';
	}

	return $classes;
}
add_filter( 'body_class', 'cit351_body_classes' );

function cit351_disable_comments_support() {
	foreach ( array( 'post', 'page' ) as $post_type ) {
		if ( post_type_supports( $post_type, 'comments' ) ) {
			remove_post_type_support( $post_type, 'comments' );
		}

		if ( post_type_supports( $post_type, 'trackbacks' ) ) {
			remove_post_type_support( $post_type, 'trackbacks' );
		}
	}
}
add_action( 'init', 'cit351_disable_comments_support' );

function cit351_disable_comments_open() {
	return false;
}
add_filter( 'comments_open', 'cit351_disable_comments_open', 20, 2 );
add_filter( 'pings_open', 'cit351_disable_comments_open', 20, 2 );

function cit351_hide_existing_comments() {
	return array();
}
add_filter( 'comments_array', 'cit351_hide_existing_comments', 10, 2 );

function cit351_remove_comments_menu() {
	remove_menu_page( 'edit-comments.php' );
}
add_action( 'admin_menu', 'cit351_remove_comments_menu' );

function cit351_remove_comments_admin_bar( $wp_admin_bar ) {
	$wp_admin_bar->remove_node( 'comments' );
}
add_action( 'admin_bar_menu', 'cit351_remove_comments_admin_bar', 999 );

add_filter( 'xmlrpc_enabled', '__return_false' );