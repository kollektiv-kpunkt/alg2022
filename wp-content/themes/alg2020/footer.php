</main>
</div>

<div class="mitmachen-wrapper mt-28"<?= (is_front_page()) ? " id='mitmachen'" : "" ?>>
    <?php
    get_template_part( "template-parts/mitmachen/index");
    ?>
</div>

<footer class="mt-28">
    <?php
    get_template_part( "template-parts/footer/index");
    ?>
    <div class="alg-bottom-bar text-sec flex justify-center items-center" style="font-size: 0.5rem" data-easter-egg="true">You found the easteregg</div>
</footer>

<?php
wp_footer();
?>
</body>
</html>