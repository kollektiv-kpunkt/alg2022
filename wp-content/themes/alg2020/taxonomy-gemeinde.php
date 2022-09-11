<?php
get_header();
$taxonomy = get_queried_object();

$args = array(
    'post_type' => 'kandi',
    'posts_per_page'	=> -1,
    'meta_key'			=> 'listenplatz',
	'orderby'			=> 'meta_value_num',
	'order'				=> 'ASC',
    'post_status' => 'publish',
    'tax_query' => array(
        'relation' => 'AND',
        array(
            'taxonomy' => 'gremium',
            'field'    => 'slug',
            'terms'    => "gr"
        ),
        array(
            "taxonomy" => "gemeinde",
            "field"    => "slug",
            "terms"    => $taxonomy->slug
        )
    )
);
$grkandis = new WP_Query( $args );

$args = array(
    'post_type' => 'kandi',
    'posts_per_page'	=> -1,
    'meta_key'			=> 'listenplatz',
	'orderby'			=> 'meta_value_num',
	'order'				=> 'ASC',
    'post_status' => 'publish',
    'tax_query' => array(
        'relation' => 'AND',
        array(
            'taxonomy' => 'gremium',
            'field'    => 'slug',
            'terms'    => "kr"
        ),
        array(
            "taxonomy" => "gemeinde",
            "field"    => "slug",
            "terms"    => $taxonomy->slug
        )
    )
);
$krkandis = new WP_Query( $args );

$gemeinde = get_queried_object();
?>

<div class="alg-gemeinde-intro-wrapper" data-gemeinde="<?= $taxonomy->slug ?>">
    <div class="alg-gemeinde-intro-inner md-container alg-2col py-20">
        <div class="alg-gemeinde-intro-content my-auto">
            <div class="alg-gemeinde-intro p-8 bg-snow">
                <h1 class="text-5xl mb-2 text-sec"><?php the_field("titel", $gemeinde) ?></h1>
                <div class="alg-gemeinde-intro-text">
                    <?php the_field("description", $gemeinde) ?>
                </div>
                <?php
                if (get_field("link", $gemeinde) != "") :
                ?>
                <a href="<?= the_field("link", $gemeinde) ?>" class="alg-button alg-more-button mt-4">Zur Webseite</a>
                <?php
                endif;
                ?>
            </div>
        </div>
        <div class="alg-gemeinde-intro-map my-auto">
            <div class="alg-map-container">
                <div class="alg-map-inner">
                    <div class="alg-map">
                        <?php
                        $mapsvg = file_get_contents(__DIR__ . "/template-parts/img/wahlkreise-zug.svg");
                        $mapsvg = str_replace('id="' . $taxonomy->slug . '" class="alg-wahlkreis"', 'id="' . $taxonomy->slug . '" class="alg-wahlkreis alg-wahlkreis-active"', $mapsvg);
                        echo $mapsvg;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="alg-gemeinde-kandis-wrapper">
    <div class="alg-gemeinde-kandis-inner mt-20">
        <div class="alg-gemeinde-kandis-content md-container">
            <h2 class="text-5xl text-prim">Unser Team für <?= $taxonomy->name ?></h2>
            <?php
            if ($taxonomy->slug != "zug") :
                if ($grkandis->have_posts()) : ?>
                <div class="alg-gemeinde-gremium">
                    <h3 class="text-3xl">In den <?= ($taxonomy->slug == "zug") ? "Grossen Gemeinderat" : "Gemeinderat" ?></h3>
                    <div class="alg-gemeinde-kandi-grid alg-gemeinde-kandi-grid-gr flex flex-wrap gap-10">
                        <?php
                        get_template_part( "template-parts/kandigrid/index", "", array( "kandis" => $grkandis, "taxonomy" => $taxonomy));
                        ?>
                    </div>
                </div>
                <?php
                endif;
                if ($krkandis->have_posts()) : ?>
                <div class="alg-gemeinde-gremium">
                    <h3 class="text-3xl">In den Kantonsrat</h3>
                    <div class="alg-gemeinde-kandi-grid alg-gemeinde-kandi-grid-kr flex flex-wrap gap-10">
                        <?php
                        get_template_part( "template-parts/kandigrid/index", "", array( "kandis" => $krkandis, "taxonomy" => $taxonomy));
                        ?>
                    </div>
                </div>
                <?php
                endif;
            else:
                if ($krkandis->have_posts()) : ?>
                <div class="alg-gemeinde-gremium">
                    <h3 class="text-3xl">In den Kantonsrat</h3>
                    <div class="alg-gemeinde-kandi-grid alg-gemeinde-kandi-grid-kr flex flex-wrap gap-10">
                        <?php
                        get_template_part( "template-parts/kandigrid/index", "", array( "kandis" => $krkandis, "taxonomy" => $taxonomy));
                        ?>
                    </div>
                </div>
                <?php
                endif;
                if ($grkandis->have_posts()) : ?>
                <div class="alg-gemeinde-gremium">
                    <h3 class="text-3xl">In den <?= ($taxonomy->slug == "zug") ? "Grossen Gemeinderat" : "Gemeinderat" ?></h3>
                    <div class="alg-gemeinde-kandi-grid alg-gemeinde-kandi-grid-gr flex flex-wrap gap-10">
                        <?php
                        get_template_part( "template-parts/kandigrid/index", "", array( "kandis" => $grkandis, "taxonomy" => $taxonomy));
                        ?>
                    </div>
                </div>
                <?php
                endif;
            endif;
            ?>
        </div>
    </div>
</div>

<?php
$elements = explode(",", get_field("add_elements", $gemeinde));
foreach($elements as $element) :
    get_template_part( "template-parts/elements/" . $element, "", array( "gemeinde" => $gemeinde));
endforeach;
get_footer();
?>