<div class="alg-rr-wrapper my-28">
    <div class="alg-rr-outer">
        <div class="alg-rr-inner alg-2col md-container">
            <div class="alg-rr-img-wrapper my-auto">
                <div class="alg-rr-img-inner scrollAnimation" data-delay="1000" style="transform: translateY(1rem); opacity: 0;">
                    <?=
                    wp_get_attachment_image( get_field("bild")["id"], "large")
                    ?>
                </div>
            </div>
            <div class="alg-content my-auto text-white py-24">
                <h2 class="alg-section-subtitle alg-section-subtitle-neg">In den Regierungsrat</h2>
                <h1 class="alg-rr-titel"><?= get_field("titel") ?></h1>
                <h3 class="alg-rr-subtitel mb-8"><?= get_field("untertitel") ?></h3>
                <a href="<?= the_field("button_link") ?>" class="alg-button alg-button-neg alg-more-button"><?= the_field("button_text") ?></a>
            </div>
        </div>
    </div>
</div>