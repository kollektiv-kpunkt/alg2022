<div class="alg-intro-wrapper mb-20">
    <div class="md-container alg-2col">
        <div style="transform: translateX(-2rem); opacity: 0;" class="alg-intro-box scrollAnimation" data-delay="<?= $i * 500 + 200?>">
            <h1 class="text-5xl leading-none mb-2"><?= get_field("title") ?></h1>
            <div class="mb-6"><?= get_field("text") ?></div>
            <a href="<?= get_field("button_link") ?>" class="alg-button alg-more-button <?= ($i == 2) ? "alg-button-sec" : "" ?>"><?= get_field("button_text") ?></a>
        </div>
    </div>
</div>