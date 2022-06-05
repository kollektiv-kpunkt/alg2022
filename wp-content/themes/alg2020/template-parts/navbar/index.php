<div class="alg-navbar-wrapper">
    <div class="lg-container">
        <div class="alg-navbar flex justify-between py-3">
            <a href="/" class="my-auto">
                <?=
                file_get_contents(__DIR__ . "/img/logo.svg");
                ?>
            </a>
            <div class="alg-menu-main flex gap-10 my-auto">
                <?php
                $menuitems = alg_menu_items("alg-main-nav");
                foreach ($menuitems as $item) {
                    $title = $item->title;
                    $url = $item->url;
                    $classes = "alg-menu-item px-2";
                    if ($item->current) {
                        $classes .= " alg-menu-item-current";
                    }
                    echo "<a href='$url' class='$classes'>$title</a>";
                }
                ?>
            </div>
            <div class="alg-menu-cta flex gap-4 my-auto">
                <?php
                $calls = alg_menu_items("alg-main-cta");
                $i = 1;
                foreach ($calls as $call) {
                    $title = $call->title;
                    $url = $call->url;
                    $classes = "alg-menu-item alg-button alg-button-high";
                    if ($call->current) {
                        $classes .= " alg-menu-item-current";
                    }
                    if ($i % 2 == 0) {
                        $classes .= " alg-button-sec";
                    }
                    echo "<a href='$url' class='$classes'>$title</a>";
                    $i++;
                }
                ?>
            </div>
        </div>
    </div>
</div>