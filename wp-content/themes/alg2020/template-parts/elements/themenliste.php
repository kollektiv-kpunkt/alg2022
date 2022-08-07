<div class="alg-themenliste-wrapper">
<?php
// WP_Query arguments
$args = array(
	'post_type'              => array( 'thema' ),
);

// The Query
$themen = new WP_Query( $args );

// The Loop
if ( $themen->have_posts() ) :
while ( $themen->have_posts() ) :

$themen->the_post();
?>

<div class="alg-themenliste-thema alg-2col mb-36" id="<?= explode("/", get_the_permalink( ))[4] ?>">
    <div class="alg-themenliste-thema-content">
        <h3 class="alg-themenliste-thema-title text-2xl text-prim"><?php the_title(); ?></h3>
        <div class="alg-themenliste-thema-content-wrapper">
            <?php the_content(); ?>
        </div>
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
endwhile;
endif;

// Restore original Post Data
wp_reset_postdata();
?>
</div>