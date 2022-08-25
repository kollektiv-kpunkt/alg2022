<?php
get_header();
$category = get_queried_object(  );
?>

    <div class="alg-featured-image-wrapper">
        <div class="alg-featured-image-inner">
            <img src="<?= get_template_directory_uri() ?>/template-parts/img/spacers/<?= rand(1,10) ?>.jpg">
        </div>
    </div>
    <div class="md-container">
        <div class="alg-post-title mt-8 mb-4">
            <h1 class="text-4xl">Kategorie: <?= $category->name ?></h1>
        </div>
        <?php
        get_template_part( "template-parts/aktuelles/index", "", array(
            "category" => $category->term_id
        ) );
        ?>
    </div>
<?php get_footer(); ?>