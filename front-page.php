<?php
get_header();

$posts_url       = cit351_get_posts_url();
$resume_url      = content_url( 'uploads/2026/05/Owen_Sheffer_Resume_PDF.pdf' );
$certificate_img = content_url( 'uploads/2026/01/CompTIA-Security-ce-certificate_pages-to-jpg-0001-1536x1187.jpg' );
$certificate1_link = 'https://www.credly.com/badges/af0e0bcf-d721-49ed-a5c5-6753f48d37cc/public_url';
?>

<section class="hero-panel" id="intro">
	<p class="section-eyebrow"><?php esc_html_e( 'omsLabs', 'cit351' ); ?></p>
	<h1 class="hero-title"><?php esc_html_e( 'I am Owen. This is my site where you can find useful tech related guides and posts, current projects, and my contact details.', 'cit351' ); ?></h1>
	<p class="hero-copy"><?php esc_html_e( 'I document my hands-on and homelab infrastructure work, security learning, and the thinking behind each project or guide so the site stays useful both as a portfolio and as a knowledge base.', 'cit351' ); ?></p>
	<div class="hero-actions">
		<a class="button-link button-link-primary" href="#about"><?php esc_html_e( 'About omsLabs', 'cit351' ); ?></a>
		<a class="button-link button-link-secondary" href="<?php echo esc_url( $posts_url ); ?>"><?php esc_html_e( 'Posts', 'cit351' ); ?></a>
	</div>
</section>

<section class="copy-grid" id="about">
	<div class="copy-card">
		<h2><?php esc_html_e( 'About omsLabs', 'cit351' ); ?></h2>
		<p><?php esc_html_e( 'IT professional with a wide range of knowledge of network engineering, technical support across many operating systems, systems administration, automation, and software development. I use this site to publish my side projects, study material for certs, and really anything I think may be useful to you or myself in the future.', 'cit351' ); ?></p>
	</div>
	<div class="copy-card">
		<h2><?php esc_html_e( 'Current focus', 'cit351' ); ?></h2>
		<p><?php esc_html_e( 'Recent work has centered on infrastructure as code, automation, network security, and practical documentation. In a field that changes quickly, I treat each lab as a chance to learn, refine, and explain my projects and tasks clearly.', 'cit351' ); ?></p>
	</div>
</section>

<section class="feature-grid">
	<article class="feature-card">
		<p class="section-eyebrow"><?php esc_html_e( 'omsLabs', 'cit351' ); ?></p>
		<h2><?php esc_html_e( 'Follow my projects or "labs", guides, and documentation here.', 'cit351' ); ?></h2>
		<p><?php esc_html_e( 'Each post is meant to be reusable: enough context to understand the problem, enough steps to reproduce the work, and enough reflection to improve the next build.', 'cit351' ); ?></p>
		<a class="button-link button-link-secondary" href="<?php echo esc_url( $posts_url ); ?>"><?php esc_html_e( 'Browse Posts', 'cit351' ); ?></a>
	</article>

	<article class="feature-card" id="contact" data-shortcut-pulse-target>
		<p class="section-eyebrow"><?php esc_html_e( 'Contact Me', 'cit351' ); ?></p>
		<h2><?php esc_html_e( 'If you would like to contact me about IT or career related questions, use the options below.', 'cit351' ); ?></h2>
		<ul class="social-links" aria-label="<?php esc_attr_e( 'Contact links', 'cit351' ); ?>">
			<?php foreach ( cit351_get_social_links() as $link ) : ?>
				<li class="social-link-item social-link-<?php echo esc_attr( $link['slug'] ); ?>">
					<a href="<?php echo esc_url( $link['url'] ); ?>" <?php echo 0 === strpos( $link['url'], 'mailto:' ) ? '' : 'target="_blank" rel="noreferrer noopener"'; ?>>
						<span class="social-link-icon" aria-hidden="true"><?php echo cit351_get_social_icon_markup( $link['slug'] ); ?></span>
						<span class="social-link-label"><?php echo esc_html( $link['label'] ); ?></span>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	</article>
</section>

<section class="credential-grid" id="credentials">
	<article class="credential-card credential-card-resume">
		<p class="section-eyebrow"><?php esc_html_e( 'Resume', 'cit351' ); ?></p>
		<h2><?php esc_html_e( 'Professional background and current direction', 'cit351' ); ?></h2>
		<div class="resume-education" aria-label="<?php esc_attr_e( 'Education summary', 'cit351' ); ?>">
			<div class="resume-education-item">
				<p class="resume-education-degree"><?php echo esc_html( 'Bachelor of Science - Network Administration & Engineering' ); ?></p>
				<p class="resume-education-meta"><?php echo esc_html( 'Pennsylvania College of Technology, Williamsport PA | Spring 2026' ); ?></p>
			</div>
			<div class="resume-education-item">
				<p class="resume-education-degree"><?php echo esc_html( 'Baccalaureate Minor - Software Development' ); ?></p>
				<p class="resume-education-meta"><?php echo esc_html( 'Pennsylvania College of Technology, Williamsport PA | Spring 2026' ); ?></p>
			</div>
			<div class="resume-education-item">
				<p class="resume-education-degree"><?php echo esc_html( 'Associate of Applied Science - Network & User Support' ); ?></p>
				<p class="resume-education-meta"><?php echo esc_html( 'Pennsylvania College of Technology, Williamsport PA | Spring 2025' ); ?></p>
			</div>
		</div>
		<div class="button-row">
			<a class="button-link button-link-primary" href="<?php echo esc_url( $resume_url ); ?>" target="_blank" rel="noreferrer noopener"><?php esc_html_e( 'Open Resume', 'cit351' ); ?></a>
		</div>
	</article>

	<article class="credential-card credential-card-certificate">
		<p class="section-eyebrow"><?php esc_html_e( 'Certification', 'cit351' ); ?></p>
		<h2><?php esc_html_e( 'CompTIA Security+', 'cit351' ); ?></h2>
		<p><?php esc_html_e( 'Security+ is currently my only certification, I am working on acquiring the CCNA cert next.', 'cit351' ); ?></p>
		<a class="certificate-preview" href="<?php echo esc_url( $certificate1_link ); ?>" target="_blank" rel="noreferrer noopener">
			<img src="<?php echo esc_url( $certificate_img ); ?>" alt="<?php esc_attr_e( 'CompTIA Security+ certificate', 'cit351' ); ?>">
		</a>
		<div class="button-row">
			<a class="button-link button-link-secondary" href="<?php echo esc_url( $certificate1_link ); ?>" target="_blank" rel="noreferrer noopener"><?php esc_html_e( 'View on Credly', 'cit351' ); ?></a>
		</div>
	</article>
</section>

<?php
get_footer();
?>