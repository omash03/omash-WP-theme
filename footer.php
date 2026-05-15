		</main>
	</div>

	<footer class="site-footer">
		<div class="site-footer-inner">
			<nav class="footer-links" aria-label="<?php esc_attr_e( 'Additional links', 'cit351' ); ?>">
				<div class="footer-branding">
					<p class="footer-meta">&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?></p>
					<p class="footer-name"><?php esc_html_e( 'Owen M. Sheffer', 'cit351' ); ?></p>
				</div>
				<div class="footer-links-group">
					<p class="footer-links-title"><?php esc_html_e( 'Additional Links', 'cit351' ); ?></p>
					<ul>
						<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'cit351' ); ?></a></li>
						<li><a href="<?php echo esc_url( cit351_get_posts_url() ); ?>"><?php esc_html_e( 'Posts', 'cit351' ); ?></a></li>
					</ul>
				</div>
			</nav>
		</div>
	</footer>
</div>

<?php wp_footer(); ?>
</body>
</html>