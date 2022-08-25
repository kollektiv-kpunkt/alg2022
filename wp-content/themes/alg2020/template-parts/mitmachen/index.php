<script src="https://www.google.com/recaptcha/api.js?render=6LdLtVohAAAAAMXB_7_q1C5JZbqSQAdzxPM7Q50-"></script>

<div class="alg-mitmachen-outer">
    <div class="alg-mitmachen-inner alg-2col md-container">
        <div class="alg-mitmachen-content text-white my-auto">
            <h2 class="text-5xl mb-2">Unterstütze unseren Wahlkampf!</h2>
            <p class="font-bold"><?= $_ENV["MOBIMSG"] ?></p>
            <form action="#" class="alg-api-form mt-6" data-interface="mitmachen">
                <div class="alg-form-wrapper alg-form-white">
                    <div class="alg-form-group">
                        <label for="alg-form-name">Name</label>
                        <input type="text" name="name" id="alg-form-name" class="alg-form-input" required>
                    </div>
                    <div class="alg-form-group">
                        <label for="alg-form-plz">Postleitzahl</label>
                        <input type="text" name="plz" id="alg-form-plz" class="alg-form-input" required>
                    </div>
                    <div class="alg-form-group alg-form-group-fullwidth">
                        <label for="alg-form-email">Email</label>
                        <input type="email" name="email" id="alg-form-email" class="alg-form-input" required>
                    </div>
                    <div class="alg-form-group alg-form-group-fullwidth alg-form-group-checkbox">
                        <input type="checkbox" name="optin" id="alg-form-optin" class="alg-form-checkbox" checked>
                        <label for="alg-form-optin">Ich bin einverstanden, dass mich die Alternative Zug auf dem Laufenden hält. <a href="<?= $_ENV["PDATENSCHUTZ"] ?>" class="underline">Mehr zum Datenschutz</a></label>
                    </div>
                    <button type="submit" class="alg-button">Unterstützen</button>
                </div>
            </form>
            <div class="alg-form-alert p-3 bg-sec text-white rounded mt-4 leading-none font-bold" hidden></div>
        </div>
        <div class="alg-mitmachen-image-wrapper my-auto">
            <div class="alg-mitmachen-image-inner">
                <img src="<?= get_template_directory_uri()?>/template-parts/img/spacers/<?= rand(1,10) ?>.jpg" alt="Image of the canton of Zug">
            </div>
        </div>
    </div>
</div>