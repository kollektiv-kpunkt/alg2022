<details class="alg-toggle-details mt-4 text-start"<?= (get_field("default_setting")) ? " open" : "" ?>>
    <summary class="alg-toggle-summary alg-graph text-xl flex justify-between leading-none">
        <span class="alg-toggle-title"><?= get_field("title") ?></span>
        <div class="alg-toggle-icon text-center">›</div>
    </summary>
    <div class="alg-toggle-content mt-4">
        <?= get_field("content") ?>
    </div>
</details>