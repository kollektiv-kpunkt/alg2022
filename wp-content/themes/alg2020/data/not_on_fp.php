<?php
require(__DIR__ . "/../../../../wp-load.php");

$args = array(
    'post_type' => 'kandi',
    'posts_per_page'	=> -1,
);
$kandis = new WP_Query( $args );
$kandis = $kandis->posts;

foreach($kandis as $kandi) {
    // delete_field('show_on_fp', $kandi->ID);
    update_field('show_on_fp', array("show_fp"), $kandi->ID);
}