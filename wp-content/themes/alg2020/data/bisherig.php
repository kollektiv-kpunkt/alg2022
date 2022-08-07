<?php
require(__DIR__ . "/../../../../wp-load.php");

$args = array(
    'post_type' => 'kandi',
    'posts_per_page'	=> -1,
);
$kandis = new WP_Query( $args );
$kandis = $kandis->posts;
$bisherige = ["Ivo Egger", "Andreas Lustenberger", "Esther Haas", "Luzian Franzini", "Stephanie Vuichard", "Tabea Zimmermann-Gibson", "Hanni Schriber-Neiger", "Andreas Hürlimann", "Anastas Odermatt", "Rita Hofer", "Stefan Hodel", "Dagmar Amrein", "Michele Willimann", "Tabea Zimmermann-Gibson", "Patrick Steinle", "Christoph Zumbühl"];

$kandiTest = $kandis[1];
if (in_array($kandiTest->post_title, $bisherige)) {
    update_field("bisher", "bisher", $kandiTest->ID);
    echo($kandiTest->post_title . "\n");
} else {
    update_field('bisher', '', $kandiTest->ID);
    echo("Neu: " . $kandiTest->post_title . "\n");
}
exit;

foreach ($kandis as $kandi) :
    // if (in_array($kandi->post_title, $bisherige)) {
    //     update_field('bisher', 'bisher', $kandi->ID);
    // } else {
    //     update_field('bisher', '', $kandi->ID);
    // }
endforeach;



