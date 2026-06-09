<footer class="home-footer">
    <div class="container">
        <div class="home-footer-grid">
            <div class="home-footer-brand">
                <h3><?= e(__('home_footer_brand')) ?></h3>
                <p><?= e(__('footer_tagline')) ?></p>
            </div>
            <div class="home-footer-col">
                <h4><?= e(__('home_footer_explore')) ?></h4>
                <ul>
                    <li><a href="<?= url('gallery') ?>"><?= e(__('nav_gallery')) ?></a></li>
                    <li><a href="<?= url('branches') ?>"><?= e(__('home_nav_schedule')) ?></a></li>
                    <li><a href="<?= url('teachers') ?>"><?= e(__('nav_teachers')) ?></a></li>
                    <li><a href="<?= url('founder') ?>"><?= e(__('nav_founder')) ?></a></li>
                    <li><a href="<?= url('contact') ?>"><?= e(__('nav_contact')) ?></a></li>
                </ul>
            </div>
            <div class="home-footer-col">
                <h4><?= e(__('home_footer_legal')) ?></h4>
                <ul>
                    <li><a href="<?= url('about') ?>"><?= e(__('home_footer_privacy')) ?></a></li>
                    <li><a href="<?= url('about') ?>"><?= e(__('home_footer_terms')) ?></a></li>
                    <li><a href="<?= url('register') ?>"><?= e(__('home_footer_reg_policy')) ?></a></li>
                </ul>
            </div>
        </div>
        <div class="home-footer-bottom">
            <p>&copy; <?= date('Y') ?> <?= e(APP_NAME) ?>. <?= e(__('footer_rights')) ?></p>
        </div>
    </div>
</footer>

<script src="<?= asset('js/main.js') ?>"></script>
<?php if (defined('STATIC_BUILD') && STATIC_BUILD): ?>
<script>window.MPDA_WHATSAPP = '<?= e(CONTACT_WHATSAPP) ?>';</script>
<script src="<?= asset('js/forms.js') ?>"></script>
<?php endif; ?>
</body>
</html>
