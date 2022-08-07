<?php
/*
Template Name: Aktuelles Layout
Template Post Type: page
*/
get_header();
?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <div class="alg-featured-image-wrapper">
        <div class="alg-featured-image-inner">
            <img src="<?= get_template_directory_uri() ?>/template-parts/img/spacers/<?= rand(1,10) ?>.jpg">
        </div>
    </div>
    <div class="md-container">
        <?php the_content(); ?>
        <?php
        get_template_part( "template-parts/aktuelles/index");
        ?>
    </div>

    <?php endwhile; else: ?>

      <h2><?php esc_html_e( '404 Error', 'phpforwp' ); ?></h2>
      <p><?php esc_html_e( 'Sorry, content not found.', 'phpforwp' ); ?></p>

<?php endif; ?>
<?php get_footer(); ?>