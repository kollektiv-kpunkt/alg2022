<?php
// WP_Query arguments
$args = array(
	'post_type'              => array( 'thema' ),
	'nopaging'               => true,
	'orderby'                => 'id',
);

$query = new WP_Query( $args );
?>

<div class="themen-section-wrapper my-20">
    <div class="themen-section-inner md-container">
    <h1 class="alg-section-title alg-section-title-secondary">Unsere Vision für Zug</h1>
    <div class="alg-themen-slider-outer">
        <?php
        $i = 0;
        while ( $query->have_posts() ) :
            $query->the_post();
            $classes = 'alg-thema-slide-wrapper alg-2col';
            if ($i == 0) {
                $classes .= ' alg-thema-slide-active';
            }
            $permalinkParts = explode("/", get_the_permalink());
            if (end($permalinkParts) === "") {
                $link = $permalinkParts[count($permalinkParts) - 2];
            } else {
                $link = end($permalinkParts);
            }
            ?>
            <div class="<?= $classes ?>" data-slide-id="<?= $i ?>">
                <div class="alg-thema-slide-content my-auto py-8">
                    <h3 class="mb-4"><?php the_title(); ?></h3>
                    <div class="alg-thema-slide-excerpt mb-8">
                        <?php the_excerpt(); ?>
                    </div>
                    <a href="<?= $_ENV["PPOSITIONEN"] . "#" . explode("/", get_the_permalink())[4] ?>" class="alg-button alg-more-button">Mehr lesen</a>
                </div>
                <div class="alg-thema-slide-image-wrapper my-auto">
                    <div class="alg-thema-slide-image-outer">
                        <div class="alg-thema-slide-image-container">
                            <?php the_post_thumbnail('medium_large'); ?>
                        </div>
                        <div class="alg-thema-titles">
                            <div class="alg-titles-rotator">
                                <div class="alg-titles-wrapper flex flex-col gap-2">
                                    <?php
                                    $titles = get_field("slogans");
                                    $titlesCount = count($titles);
                                    $j = 1;
                                    foreach ($titles as $title) :
                                        ?>
                                        <?php
                                        $classes = "alg-title-wrapper w-fit";
                                        if ($j == $titlesCount) {
                                            $classes .= " alg-title-last";
                                        }
                                        ?>
                                        <div class="<?= $classes ?>">
                                            <div class="alg-title-inner">
                                                <div class="alg-title-text font-bold leading-none">
                                                    <?= $title["slogan"] ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    $j++;
                                    endforeach;
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php
        $i++;
        endwhile;

        // Restore original Post Data
        wp_reset_postdata();
        ?>
    </div>
    <div class="alg-thema-pagination flex gap-x-2">
        <?php
        for ($k=0; $k < $i; $k++) :
            $classes="alg-thema-page";
            if ($k == 0) {
                $classes .= " alg-thema-page-active";
            }
            ?>
            <div class="<?= $classes ?>" data-slide-id="<?= $k ?>"></div>
        <?php
        endfor;
        ?>
    </div>
</div>