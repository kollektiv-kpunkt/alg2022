<?php
$args = array(
	'post_type'              => array( 'kandi' ),
	'nopaging'               => true,
	'orderby'                => 'rand',
);
$query = new WP_Query( $args );
?>

<div class="kandis-section-wrapper py-10 my-20">
    <div class="kandis-section-inner md-container">
        <h2 class="alg-section-subtitle">Die Kandidierenden</h2>
        <h1 class="alg-section-title alg-section-title-primary"><span id="alg-kandis-number"></span> aus 85 für Zug</h1>
        <div class="kandi-grid-section flex gap-y-6 flex-wrap">
            <?php
            $i = 1;
            while ( $query->have_posts() ) :
                $classes = "kandi-wrapper";
                if ($i > 12) {
                    $classes .= " kandi-wrapper-2xl-hidden";
                }
                if ($i > 10) {
                    $classes .= " kandi-wrapper-xl-hidden";
                }
                if ($i > 9) {
                    $classes .= " kandi-wrapper-lg-hidden";
                }
                if ($i > 8) {
                    $classes .= " kandi-wrapper-md-hidden";
                }
                $query->the_post();
                $gremium = get_the_terms( $post->ID, 'gremium' );
                $wahlkreis = get_the_terms( $post->ID, 'gemeinde' );
                ?>

                <div class="<?= $classes ?>">
                    <div class="kandi-image-container">
                        <?php the_post_thumbnail('medium'); ?>
                        <?php
                        if (get_field("bisher")) : ?>
                            <div class="alg-kandi-bisher leading-none">Bisher</div>
                        <?php
                        endif;
                        ?>
                    </div>
                    <div class="kandi-content-wrapper">
                        <h3 class="kandi-title"><?php the_title(); ?></h3>
                        <p class="text-xs">
                            <?= $gremium[0]->name; ?><br>
                            <?= $wahlkreis[0]->name; ?>
                        </p>
                    </div>
                    <a href="<?= the_permalink() ?>" class="alg-kandi-permalink"></a>
                </div>

            <?php
            $i++;
            endwhile;
            // Restore original Post Data
            wp_reset_postdata();
            ?>
        </div>
        <div class="flex">
            <a href="<?= $_ENV["PGEMEINDEN"] ?>" class="alg-button alg-button-sec alg-more-button ml-auto mr-0 mt-9">Zu den Gemeinden</a>
        </div>
    </div>
</div>