<div class="alg-intro-wrapper mb-20">
    <div class="md-container alg-2col">
        <div style="transform: translateX(-2rem); opacity: 0;" class="alg-intro-box scrollAnimation" data-delay="500">
            <h1 class="text-5xl leading-none mb-2"><?= get_field("title") ?></h1>
            <div class="mb-6"><?= get_field("text") ?></div>
            <?php
            if (get_field("button_text") != "") :
            ?>
            <a href="<?= get_field("button_link") ?>" class="alg-button alg-more-button"><?= get_field("button_text") ?></a>
            <?php
            endif;
            ?>
        </div>
    </div>
</div>