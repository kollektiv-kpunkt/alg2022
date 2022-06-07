<?php
get_header();
$taxonomy = get_queried_object();
// [term_id] => 7
// [name] => Baar
// [slug] => baar
// [term_group] => 0
// [term_taxonomy_id] => 7
// [taxonomy] => gemeinde
// [description] => Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Convallis aenean et tortor at risus viverra. Blandit libero volutpat sed cras ornare arcu dui. Non diam phasellus vestibulum lorem sed risus ultricies tristique nulla. Cras ornare arcu dui vivamus arcu felis. Id neque aliquam vestibulum morbi blandit cursus risus at. Volutpat est velit egestas dui id ornare arcu odio. Volutpat sed cras ornare arcu dui. Congue quisque egestas diam in arcu cursus. Proin sagittis nisl rhoncus mattis rhoncus urna neque. Malesuada bibendum arcu vitae elementum curabitur. Nulla aliquet porttitor lacus luctus accumsan tortor posuere ac. Vulputate odio ut enim blandit volutpat maecenas volutpat blandit aliquam.
// [parent] => 0
// [count] => 1
// [filter] => raw

$args = array(
    'post_type' => 'kandi',
    'posts_per_page'	=> -1,
    'meta_key'			=> 'listenplatz',
	'orderby'			=> 'meta_value',
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
	'orderby'			=> 'meta_value',
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

?>

<div class="alg-gemeinde-intro-wrapper">
    <div class="alg-gemeinde-intro-inner md-container alg-2col py-20">
        <div class="alg-gemeinde-intro-content my-auto">
            <div class="alg-gemeinde-intro p-8 bg-snow">
                <h1 class="text-5xl mb-2 text-sec">Die Alternative für <?= $taxonomy->name; ?></h1>
                <?php
                $p = preg_split('/\r\n|\r|\n/', $taxonomy->description);
                ?>
                <div class="alg-gemeinde-intro-text">
                    <?php
                    foreach ($p as $line) {
                        echo "<p>$line</p>";
                    }
                    ?>
                </div>
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
            <div class="alg-gemeinde-gremium">
                <h3 class="text-3xl">In den Gemeinderat</h3>
                <div class="alg-gemeinde-kandi-grid alg-gemeinde-kandi-grid-gr flex flex-wrap gap-10">
                    <?php
                    get_template_part( "template-parts/kandigrid/index", "", array( "kandis" => $grkandis, "taxonomy" => $taxonomy));
                    ?>
                </div>
            </div>
            <div class="alg-gemeinde-gremium">
                <h3 class="text-3xl">In den Kantonsrat</h3>
                <div class="alg-gemeinde-kandi-grid alg-gemeinde-kandi-grid-kr flex flex-wrap gap-10">
                    <?php
                    get_template_part( "template-parts/kandigrid/index", "", array( "kandis" => $krkandis, "taxonomy" => $taxonomy));
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
?>