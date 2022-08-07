<div class="alg-navbar-wrapper">
    <div class="alg-navbar-inner">
        <div class="lg-container">
            <div class="alg-navbar flex justify-between py-3">
                <a href="/" class="my-auto">
                    <?=
                    file_get_contents(__DIR__ . "/../img/logo.svg");
                    ?>
                </a>
                <?php
                wp_nav_menu( array(
                        'theme_location' => 'alg-main-nav',
                        'menu_id'        => 'primary-menu',
                        'menu_class'     => 'alg-menu-main flex gap-10 my-auto',
                    ) );
                ?>
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
                <div class="alg-menu-mobile alg-menu-mobile-button-wrapper flex items-center">
                    <button class="alg-menu-mobile-tofuburger"></button>
                </div>
            </div>
        </div>
    </div>
    <div class="alg-menu-mobile alg-mobilemenu-wrapper">
        <div class="alg-mobilemenu-inner">
            <div class="alg-mobilemenu-cta bg-snow">
                <div class="alg-mobilemenu-cta-inner flex gap-4 justify-center lg-container py-3">
                    <?php
                    $calls = alg_menu_items("alg-main-cta");
                    $i = 1;
                    foreach ($calls as $call) {
                        $title = $call->title;
                        $url = $call->url;
                        $classes = "alg-menu-item alg-button w-full";
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
            <div class="alg-mobilemenu-main bg-white flex">
                <div class="alg-mobilemenu-main-inner h-screen lg-container flex flex-col gap-y-6 pt-10 px-4">
                    <?php
                    $menuitems = alg_menu_items("alg-main-nav");
                    foreach ($menuitems as $item) {
                        $title = $item->title;
                        $url = $item->url;
                        $classes = "alg-mobilemenu-item px-1";
                        if ($item->current) {
                            $classes .= " alg-mobilemenu-item-current";
                        }
                        echo "<a href='$url' class='$classes'>$title</a>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
