<div class="alg-intro-wrapper mb-20">
    <div class="md-container alg-2col">
        <?php
        $boxes = get_field("intro_boxen");
        $i = 1;
        foreach ($boxes as $box) :
            if ($i == 2) {
                $type = "alg-intro-box-second";
                $style = "transform: translateX(2rem); opacity: 0;";
            } else {
                $type = "alg-intro-box-first";
                $style = "transform: translateX(-2rem); opacity: 0;";
            }
            ?>
            <div style="<?= $style ?>" class="alg-intro-box <?= $type ?> scrollAnimation" data-delay="<?= $i * 500 + 200?>">
                <h1 class="text-5xl leading-none mb-2"><?= $box["title"] ?></h1>
                <div class="mb-6"><?= $box["text"] ?></div>
                <a href="<?= $box["button_link"] ?>" class="alg-button alg-more-button <?= ($i == 2) ? "alg-button-sec" : "" ?>"><?= $box["button_text"] ?></a>
            </div>
            <?php
        $i++;
        endforeach;
        ?>
    </div>
</div>