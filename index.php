<?php
get_header();
?>

<section class="content-hero content-hero-compact">
    <p class="section-eyebrow"><?php esc_html_e( 'omsLabs', 'cit351' ); ?></p>
    <h1 class="content-title"><?php esc_html_e( 'Latest writing', 'cit351' ); ?></h1>
    <p class="content-intro">
        <?php esc_html_e( 'Guides, lab notes, and documentation from current infrastructure and security work.', 'cit351' ); ?>
    </p>
</section>

<?php if ( have_posts() ) : ?>
    <section class="post-feed" aria-label="<?php esc_attr_e( 'Posts', 'cit351' ); ?>">
        <?php
        while ( have_posts() ) :
            the_post();
            get_template_part( 'template-parts/content', 'excerpt' );
        endwhile;
        ?>
    </section>

    <?php the_posts_pagination(); ?>
<?php else : ?>
    <?php get_template_part( 'template-parts/content', 'none' ); ?>
<?php endif; ?>

<?php
get_footer();
?>