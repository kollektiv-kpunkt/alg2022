<?php
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
// WP_Query arguments
$query_args = array(
	'post_type'              => array( 'post' ),
	'post_status'            => array( 'publish' ),
    'posts_per_page' => 10,
    'paged' => $paged
);

if (isset($args["category"])) {
    $query_args["cat"] = $args["category"];
}

// The Query
$query = new WP_Query( $query_args );

// The Loop
if ( $query->have_posts() ) :
	while ( $query->have_posts() ) :
    $query->the_post();
    ?>
		<div class="alg-post-wrapper<?= (get_the_post_thumbnail_url()) ? " alg-post-wrapper-has-thumbnail" : "" ?>">
            <?php
            if (get_the_post_thumbnail_url()) :
                ?>
                <div class="alg-post-thumbnail">
                    <div class="alg-post-thumbnail-inner">
                        <?php
                        the_post_thumbnail( "medium_large" );
                        ?>
                    </div>
                </div>
            <?php
            endif;
            ?>
            <div class="alg-post-inner">
                <div class="alg-post-content">
                    <h3 class="text-lg"><?= the_title() ?></h3>
                    <p class="text-sm text-gray-600 mb-2"><?= the_date( "d.m.Y") ?> | <?= the_category( ", " ) ?></p>
                    <?= the_excerpt() ?>
                    <a href="<?= the_permalink() ?>" class="alg-button alg-more-button text-base mt-4">Weiterlesen</a>
                </div>
            </div>
        </div>
    <?php
    endwhile;
else :
endif;

?>
<div class="alg-pagination-wrapper flex ml-auto mr-0">
    <div class="alg-pagination mt-6">
        <?php
            echo paginate_links( array(
                'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
                'total'        => $query->max_num_pages,
                'current'      => max( 1, get_query_var( 'paged' ) ),
                'format'       => '?paged=%#%',
                'show_all'     => false,
                'type'         => 'plain',
                'end_size'     => 1,
                'mid_size'     => 1,
                'prev_next'    => true,
                'prev_text'    => sprintf( '<i></i> %1$s', __( '‹', 'text-domain' ) ),
                'next_text'    => sprintf( '%1$s <i></i>', __( '›', 'text-domain' ) ),
                'add_args'     => false,
                'add_fragment' => '',
            ) );
        ?>
    </div>
</div>
<?php
// Restore original Post Data
wp_reset_postdata();

?>