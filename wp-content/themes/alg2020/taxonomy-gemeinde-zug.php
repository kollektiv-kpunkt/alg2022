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
?>

<div class="alg-gemeinde-intro-wrapper" id="alg-gemeinde-zug">
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



<?php
get_footer();
?>