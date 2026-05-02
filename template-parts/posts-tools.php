<?php
$cit351_tools_id       = 'posts-tools-' . wp_unique_id();
$cit351_current_cat_id = is_category() ? (int) get_queried_object_id() : 0;
?>

<section class="content-tools content-tools-accordion" aria-label="<?php esc_attr_e( 'Post discovery tools', 'cit351' ); ?>">
	<div class="tool-card posts-tools-card" data-posts-tools>
		<button class="posts-tools-toggle" type="button" aria-expanded="false" aria-controls="<?php echo esc_attr( $cit351_tools_id ); ?>" data-posts-tools-toggle>
			<span class="posts-tools-toggle-copy">
				<span class="posts-tools-toggle-title"><?php esc_html_e( 'Search For Stuff', 'cit351' ); ?></span>
			</span>
			<span class="posts-tools-toggle-indicator" aria-hidden="true"></span>
		</button>

		<div class="posts-tools-panel" id="<?php echo esc_attr( $cit351_tools_id ); ?>" hidden data-posts-tools-panel>
			<div class="posts-tools-grid">
				<div class="posts-tools-block posts-tools-block-search">
					<h2><?php esc_html_e( 'Search the site', 'cit351' ); ?></h2>
					<p><?php esc_html_e( 'Look up a guide, lab note, or project write-up by keyword.', 'cit351' ); ?></p>
					<?php get_search_form(); ?>
				</div>

				<div class="posts-tools-block posts-tools-block-categories">
					<h2><?php esc_html_e( 'Browse categories', 'cit351' ); ?></h2>
					<p><?php esc_html_e( 'Jump directly into a topic area from the category selector.', 'cit351' ); ?></p>
					<form class="posts-tools-category-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" data-category-jump-form>
						<label class="screen-reader-text" for="<?php echo esc_attr( $cit351_tools_id . '-category' ); ?>"><?php esc_html_e( 'Select category', 'cit351' ); ?></label>
						<?php
						wp_dropdown_categories(
							array(
								'show_option_none' => __( 'Select Category', 'cit351' ),
								'name'             => 'cat',
								'id'               => $cit351_tools_id . '-category',
								'selected'         => $cit351_current_cat_id,
								'class'            => 'posts-tools-category-select',
								'value_field'      => 'term_id',
							)
						);
						?>
						<noscript>
							<button type="submit"><?php esc_html_e( 'View Category', 'cit351' ); ?></button>
						</noscript>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>