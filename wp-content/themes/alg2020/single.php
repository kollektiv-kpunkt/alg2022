<?php
get_header();
?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <div class="alg-featured-image-wrapper">
        <div class="alg-featured-image-inner">
            <?php
            if (get_the_post_thumbnail_url()) {
                $header_url = get_the_post_thumbnail_url($post->ID, "full" );
            } else {
                $header_url = get_template_directory_uri() . "/template-parts/img/spacers/" . rand(1,10) . ".jpg";
            }
            ?>
            <img src="<?= $header_url ?>">
        </div>
    </div>
    <div class="md-container">
        <div class="alg-post-title mt-8 mb-4">
            <h1 class="text-4xl"><?= the_title() ?></h1>
        </div>
        <?php the_content(); ?>
    </div>

    <?php endwhile; else: ?>

      <h2><?php esc_html_e( '404 Error', 'phpforwp' ); ?></h2>
      <p><?php esc_html_e( 'Sorry, content not found.', 'phpforwp' ); ?></p>

<?php endif; ?>
<?php get_footer(); ?>