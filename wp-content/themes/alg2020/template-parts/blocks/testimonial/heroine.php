<div id="alg-heroine-wrapper">
    <div id="alg-heroine-inner">
        <div id="alg-heroine-bg">
            <img src="<?= get_field("heroine_image")["url"] ?>" alt="" id="alg-heroine-img">
        </div>
        <div id="alg-heroine-titles">
            <div id="alg-titles-rotator">
                <div id="alg-titles-wrapper" class="flex flex-col gap-2">
                    <?php
                    $titles = get_field("heroine_titles");
                    $titlesCount = count($titles);
                    $i = 1;
                    foreach ($titles as $title) :
                        ?>
                        <?php
                        $classes = "alg-title-wrapper w-fit";
                        if ($i == $titlesCount) {
                            $classes .= " alg-title-last";
                        }
                        ?>
                        <div class="<?= $classes ?>">
                            <div class="alg-title-inner">
                                <div class="alg-title-text font-bold leading-none">
                                    <?= $title["heroine_title"] ?>
                                </div>
                            </div>
                        </div>
                    <?php
                    $i++;
                    endforeach;
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>