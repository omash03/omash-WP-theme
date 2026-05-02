<?php
get_header();

$paged = max( 1, (int) get_query_var( 'paged' ), (int) get_query_var( 'page' ) );
$posts = new WP_Query(
	array(
		'post_type'           => 'post',
		'post_status'         => 'publish',
		'ignore_sticky_posts' => true,
		'paged'               => $paged,
	)
);
?>

<section class="content-hero">
	<p class="section-eyebrow"><?php esc_html_e( 'omsLabs Posts', 'cit351' ); ?></p>
	<p class="content-intro"><?php esc_html_e( 'Recent projects, how-to articles, and documentation from active projects.', 'cit351' ); ?></p>
</section>

<?php get_template_part( 'template-parts/posts', 'tools' ); ?>

<?php if ( $posts->have_posts() ) : ?>
	<section class="post-feed" aria-label="<?php esc_attr_e( 'Posts feed', 'cit351' ); ?>">
		<?php
		while ( $posts->have_posts() ) :
			$posts->the_post();
			get_template_part( 'template-parts/content', 'excerpt' );
		endwhile;
		?>
	</section>

	<?php
	$cit351_pagination_links = paginate_links(
		array(
			'total'     => (int) $posts->max_num_pages,
			'current'   => $paged,
			'prev_text' => __( 'Previous', 'cit351' ),
			'next_text' => __( 'Next', 'cit351' ),
			'type'      => 'array',
		)
	);

	if ( ! empty( $cit351_pagination_links ) ) :
		?>
		<nav class="pagination" aria-label="<?php esc_attr_e( 'Posts pagination', 'cit351' ); ?>">
			<?php foreach ( $cit351_pagination_links as $cit351_pagination_link ) : ?>
				<?php echo wp_kses_post( $cit351_pagination_link ); ?>
			<?php endforeach; ?>
		</nav>
		<?php
	endif;
	?>
<?php else : ?>
	<?php get_template_part( 'template-parts/content', 'none' ); ?>
<?php endif; ?>

<?php
wp_reset_postdata();
get_footer();
?>
