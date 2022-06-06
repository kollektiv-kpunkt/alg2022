<?php
$menuitems = alg_menu_items("alg-footer-nav");
?>
<div class="alg-footer-menu">
    <div class="alg-footer-inner flex gap-6 justify-end">
        <?php foreach ($menuitems as $item) : ?>
            <a href="<?php echo $item->url; ?>" class="text-white text-sm underline"><?php echo $item->title; ?></a>
        <?php endforeach; ?>
        <a href="https://www.kpunkt.ch" target="_blank" class="text-white text-sm">Built with 💕 by <b>K.</b></a>
    </div>
</div>