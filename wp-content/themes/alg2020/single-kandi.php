<?php
use Jaybizzle\CrawlerDetect\CrawlerDetect;
$detect = new CrawlerDetect;
if ($detect->isCrawler()) {
    get_header();
    get_footer();
} else {
    $gemeinde = get_the_terms( $post->ID, 'gemeinde' )[0]->slug;
    header("location: /gemeinde/{$gemeinde}/?#kandi={$post->post_name}");
}
?>