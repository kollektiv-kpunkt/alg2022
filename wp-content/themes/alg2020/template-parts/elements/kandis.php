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
        <h1 class="alg-section-title alg-section-title-primary">Unser Team für Zug</h1>
        <div class="kandi-grid-section flex gap-x-8 gap-y-6 flex-wrap">
            <?php
            while ( $query->have_posts() ) :
                $query->the_post();
                $gremium = get_the_terms( $post->ID, 'gremium' );
                $wahlkreis = get_the_terms( $post->ID, 'wahlkreis' );
                ?>

                <div class="kandi-wrapper">
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
                </div>

            <?php
            endwhile;
            // Restore original Post Data
            wp_reset_postdata();
            ?>
        </div>
        <div class="flex">
            <a href="/kandidierende" class="alg-button alg-button-sec alg-more-button ml-auto mr-0 mt-9">Alle Kandidierenden</a>
        </div>
    </div>
</div>