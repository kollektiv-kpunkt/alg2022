<?php
while ($args["kandis"]->have_posts()) :
    $args["kandis"]->the_post();
    $details = [get_field("berufsbezeichnung")];
    if (get_field("bisher")) {
        array_unshift($details, "Bisher");
    }
    if (get_field("listenplatz")) {
        $details[] = "Listenplatz " . get_field("listenplatz");
    }
    if (get_field("byline")) {
        $details[] = get_field("byline");
    }
?>
<div class="kandi-wrapper" data-kandi="kandi-<?= the_ID() ?>" id="<?= $post->post_name ?>">
    <div class="kandi-inner" data-kandi="kandi-<?= the_ID() ?>">
        <div class="kandi-image-container">
            <?php the_post_thumbnail( 'large'); ?>
            <?php
            if (get_field("bisher")) : ?>
                <div class="alg-kandi-bisher leading-none">Bisher</div>
            <?php
            endif;
            ?>
        </div>
        <div class="kandi-content-wrapper">
            <h3 class="kandi-title text-3xl mb-4"><?php the_title(); ?></h3>
            <p>
                <?php
                the_field("berufsbezeichnung");
                ?>
            </p>
        </div>
    </div>
    <div class="kandi-details-wrapper" data-kandi="kandi-<?= the_ID() ?>">
        <div class="kandi-details-arrow">
            <i data-feather="triangle"></i>
        </div>
        <div class="kandi-details-outer">
            <div class="kandi-details-inner" data-kandi="kandi-<?= the_ID() ?>">
                <h4 class="text-6xl mb-1 text-sec kandi-details-title"><?= the_title() ?></h4>
                <p><b><?= implode(", ", $details); ?></b></p>
                <div class="text-2xl italic kandi-details-content leading-normal mt-4"><?= the_content() ?></div>
                <div class="mt-6 kandi-details-somelinks flex gap-2">
                    <?php
                    $links = array_filter(get_field("somelinks"), function($value) {
                        return $value != "";
                    });
                    foreach ($links as $type => $link) {
                        ?>
                        <a href="<?= $link ?>" target="_blank" class="kandi-details-somelink">
                            <i data-feather="<?= $type ?>"></i>
                        </a>
                        <?php
                    }
                    ?>
                </div>
                <?php
                if (get_field("personalwebpage") != "") :
                ?>
                <a href="<?= get_field("personalwebpage") ?>" target="_blank" class="alg-button alg-more-button mt-5">Zur Webseite</a>
                <?php
                endif;
                ?>
            </div>
        </div>
    </div>
    <div class="kandi-details-placeholder"></div>
</div>
<?php
endwhile;
wp_reset_postdata();
?>