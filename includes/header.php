<?php
$currentPage = $page ?? 'home';

$siteNav = [
    ['slug' => 'about', 'label' => __('nav_about')],
    ['slug' => 'branches', 'label' => __('home_nav_classes')],
    ['slug' => 'home', 'label' => __('home_nav_schedule'), 'anchor' => 'schedule'],
    ['slug' => 'events', 'label' => __('nav_events')],
    ['slug' => 'gallery', 'label' => __('home_nav_media')],
    ['slug' => 'register', 'label' => __('home_nav_registration')],
];
?>
<header class="site-header site-header--premium" id="siteHeader">
    <div class="container header-inner">
        <a href="<?= url('home') ?>" class="logo logo--text">
            <img
                src="<?= asset('images/logo.png') ?>"
                alt=""
                class="logo-icon"
                width="44"
                height="44"
                decoding="async"
            >
            <span class="logo-wordmark"><?= e(__('logo_wordmark')) ?></span>
        </a>

        <nav class="header-nav" id="mainNav" aria-label="Main navigation">
            <ul class="site-nav-list">
                <?php foreach ($siteNav as $item):
                    $href = url($item['slug']) . (!empty($item['anchor']) ? '#' . $item['anchor'] : '');
                    $isActive = $currentPage === $item['slug'];
                ?>
                <li>
                    <a href="<?= e($href) ?>" class="<?= $isActive ? 'active' : '' ?>">
                        <?= e($item['label']) ?>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>

            <div class="header-nav-mobile">
                <div class="lang-switch">
                    <a href="<?= langSwitchUrl('en') ?>" class="<?= currentLang() === 'en' ? 'active' : '' ?>">EN</a>
                    <span>|</span>
                    <a href="<?= langSwitchUrl('si') ?>" class="<?= currentLang() === 'si' ? 'active' : '' ?>">සිං</a>
                </div>
                <a href="<?= url('contact') ?>" class="btn btn-header-cta btn-header-cta--mobile"><?= e(__('nav_contact')) ?></a>
            </div>
        </nav>

        <div class="header-end">
            <div class="lang-switch lang-switch--desktop">
                <a href="<?= langSwitchUrl('en') ?>" class="<?= currentLang() === 'en' ? 'active' : '' ?>">EN</a>
                <span>|</span>
                <a href="<?= langSwitchUrl('si') ?>" class="<?= currentLang() === 'si' ? 'active' : '' ?>">සිං</a>
            </div>
            <a href="<?= url('contact') ?>" class="btn btn-header-cta"><?= e(__('nav_contact')) ?></a>
        </div>

        <button class="nav-toggle" id="navToggle" aria-label="Toggle navigation" aria-expanded="false" aria-controls="mainNav">
            <span></span><span></span><span></span>
        </button>
    </div>
</header>
