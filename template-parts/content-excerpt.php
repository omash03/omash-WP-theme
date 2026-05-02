<article <?php post_class( 'post-card' ); ?> id="post-<?php the_ID(); ?>">
	<p class="post-card-date"><?php echo esc_html( get_the_date() ); ?></p>
	<h2 class="post-card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	<div class="post-card-excerpt"><?php the_excerpt(); ?></div>
	<a class="post-card-link" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read post', 'cit351' ); ?></a>
</article>