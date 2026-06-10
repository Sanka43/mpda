<?php
$pageTitle = __('home_hero_title');
$metaDescription = __('meta_description');

$branches = getBranches();
$featuredEvent = getFeaturedEvent();

$studioBranches = array_slice($branches, 0, 5);

$instructors = __('home_instructors');
$officeTeam = __('home_office_team');
if (!is_array($instructors)) {
    $instructors = [];
}
if (!is_array($officeTeam)) {
    $officeTeam = [];
}

$disciplines = [
    [
        'title' => __('home_style_udarata'),
        'tag'   => __('home_discipline_udarata_tag'),
        'image' => galleryImage('01-featured-website', 0),
        'link'  => url('branches'),
    ],
    [
        'title' => __('home_style_pahatharata'),
        'tag'   => __('home_discipline_pahatharata_tag'),
        'image' => galleryImage('02-cultural-ceremony', 7),
        'link'  => url('branches'),
    ],
    [
        'title' => __('home_style_bollywood'),
        'tag'   => __('home_discipline_bollywood_tag'),
        'image' => galleryImage('03-dance-classes-training', 10),
        'link'  => url('branches'),
    ],
];

$eventDate = $featuredEvent && $featuredEvent['event_date']
    ? strtoupper(date('F j, Y', strtotime($featuredEvent['event_date'])))
    : __('home_concert_date_fallback');
$eventVenue = $featuredEvent['venue'] ?? 'Sugathadasa Stadium';
?>

<!-- Hero -->
<section class="home-hero">
    <div class="home-hero__bg"></div>
    <div class="home-hero__overlay"></div>
    <div class="home-hero__content fade-in">
        <h1><?= e(__('home_hero_title')) ?></h1>
        <p class="home-hero__tagline"><?= e(__('home_hero_subtitle_mockup')) ?></p>
        <div class="home-hero__actions">
            <a href="<?= url('register') ?>" class="btn-gold"><?= e(__('home_cta_join')) ?></a>
            <a href="<?= url('branches') ?>" class="btn-ghost"><?= e(__('home_cta_explore')) ?></a>
        </div>
    </div>
    <a href="#legacy" class="home-hero__scroll" aria-label="Scroll down">↓</a>
</section>

<!-- Our Legacy -->
<section class="home-section" id="legacy">
    <div class="container">
        <div class="home-legacy fade-in">
            <div class="home-legacy__image"></div>
            <div class="home-legacy__text">
                <span class="home-section__label"><?= e(__('home_legacy_label')) ?></span>
                <h2 class="home-section__title"><?= e(__('home_legacy_title')) ?></h2>
                <p><?= e(__('home_legacy_p1')) ?></p>
                <p><?= e(__('home_legacy_p2')) ?></p>
                <div class="home-legacy__stats">
                    <div>
                        <span class="home-stat__number">10+</span>
                        <span class="home-stat__label"><?= e(__('home_stat_branches')) ?></span>
                    </div>
                    <div>
                        <span class="home-stat__number">1000+</span>
                        <span class="home-stat__label"><?= e(__('home_stat_students')) ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Artistic Disciplines -->
<section class="home-section">
    <div class="container">
        <div class="home-disciplines__header fade-in">
            <span class="home-section__sublabel"><?= e(__('home_disciplines_sublabel')) ?></span>
            <h2 class="home-section__title home-section__title--center"><?= e(__('home_disciplines_title')) ?></h2>
        </div>
        <div class="home-disciplines__grid fade-in">
            <?php foreach ($disciplines as $d): ?>
            <a href="<?= e($d['link']) ?>" class="home-discipline-card">
                <img src="<?= e($d['image']) ?>" alt="<?= e($d['title']) ?>" loading="lazy">
                <div class="home-discipline-card__overlay">
                    <h3><?= e($d['title']) ?></h3>
                    <span><?= e($d['tag']) ?></span>
                    <span class="home-discipline-card__link"><?= e(__('home_explore_program')) ?> →</span>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- The Founder -->
<section class="home-section">
    <div class="container">
        <div class="home-founder fade-in">
            <div class="home-founder__visual">
                <img
                    src="<?= asset('images/Founder.jpg') ?>"
                    alt="<?= e(__('home_founder_heading')) ?>"
                    width="800"
                    height="800"
                    loading="lazy"
                    decoding="async"
                >
            </div>
            <div>
                <span class="home-section__label"><?= e(__('home_founder_label')) ?></span>
                <h2 class="home-section__title"><?= e(__('home_founder_heading')) ?></h2>
                <blockquote class="home-founder__quote"><?= e(__('home_founder_quote')) ?></blockquote>
                <p class="home-founder__role"><?= e(__('home_founder_role')) ?></p>
                <a href="<?= url('founder') ?>" class="home-founder__link"><?= e(__('home_read_story')) ?> →</a>
            </div>
        </div>
    </div>
</section>

<!-- Instructors -->
<section class="home-section" id="instructors">
    <div class="container">
        <div class="home-team__header fade-in">
            <span class="home-section__sublabel"><?= e(__('home_instructors_sublabel')) ?></span>
            <h2 class="home-section__title home-section__title--center"><?= e(__('home_instructors_title')) ?></h2>
            <p class="home-team__intro"><?= e(__('home_instructors_intro')) ?></p>
        </div>
        <div class="home-team__grid fade-in">
            <?php foreach ($instructors as $member): ?>
            <article class="home-team-card">
                <div class="home-team-card__photo" role="img" aria-label="<?= e($member['name'] ?? '') ?>">
                    <?php if (!empty($member['image'])): ?>
                    <img src="<?= e($member['image']) ?>" alt="<?= e($member['name'] ?? '') ?>" loading="lazy">
                    <?php endif; ?>
                </div>
                <h3 class="home-team-card__name"><?= e($member['name'] ?? '') ?></h3>
                <p class="home-team-card__role"><?= e($member['role'] ?? '') ?></p>
            </article>
            <?php endforeach; ?>
        </div>
        <p class="home-team__footer fade-in">
            <a href="<?= url('teachers') ?>" class="home-founder__link"><?= e(__('home_team_view_teachers')) ?> →</a>
        </p>
    </div>
</section>

<!-- Our Office Team -->
<section class="home-section home-section--alt" id="office-team">
    <div class="container">
        <div class="home-team__header fade-in">
            <span class="home-section__sublabel"><?= e(__('home_office_sublabel')) ?></span>
            <h2 class="home-section__title home-section__title--center"><?= e(__('home_office_title')) ?></h2>
            <p class="home-team__intro"><?= e(__('home_office_intro')) ?></p>
        </div>
        <div class="home-team__grid home-team__grid--office fade-in">
            <?php foreach ($officeTeam as $member): ?>
            <article class="home-team-card">
                <div class="home-team-card__photo" role="img" aria-label="<?= e($member['name'] ?? '') ?>">
                    <?php if (!empty($member['image'])): ?>
                    <img src="<?= e($member['image']) ?>" alt="<?= e($member['name'] ?? '') ?>" loading="lazy">
                    <?php endif; ?>
                </div>
                <h3 class="home-team-card__name"><?= e($member['name'] ?? '') ?></h3>
                <p class="home-team-card__role"><?= e($member['role'] ?? '') ?></p>
            </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Upcoming Concert -->
<?php if ($featuredEvent): ?>
<section class="home-section">
    <div class="container fade-in">
        <div class="home-concert">
            <div class="home-concert__content">
                <span class="home-concert__badge"><?= e(__('home_concert_badge')) ?></span>
                <h2 class="home-concert__title">MIHIKATHA</h2>
                <p class="home-concert__desc"><?= e(eventDescription($featuredEvent)) ?></p>
                <div class="home-concert__meta">
                    <span>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        <?= e($eventDate) ?>
                    </span>
                    <span>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        <?= e(strtoupper($eventVenue)) ?>
                    </span>
                </div>
                <a href="<?= url('events') ?>" class="home-concert__btn"><?= e(__('home_get_tickets')) ?></a>
            </div>
            <div class="home-concert__image" role="img" aria-label="Concert stage" style="<?= backgroundImage(galleryImage('05-stage-performances', 1)) ?>"></div>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Visit Our Studios -->
<section class="home-section" id="schedule">
    <div class="container">
        <div class="home-studios__header fade-in">
            <span class="home-section__sublabel"><?= e(__('home_studios_sublabel')) ?></span>
            <h2 class="home-section__title home-section__title--center"><?= e(__('home_studios_title')) ?></h2>
        </div>
        <div class="home-studios__grid fade-in">
            <?php foreach ($studioBranches as $branch): ?>
            <a href="<?= url('branches') ?>" class="home-studio-box">
                <h4><?= e($branch['name']) ?></h4>
                <p><?= e($branch['day_of_week']) ?><br><?= e(formatBranchTime($branch['start_time'], $branch['end_time'])) ?></p>
            </a>
            <?php endforeach; ?>
        </div>
        <?php if (count($branches) > 5): ?>
        <p style="text-align:center;margin-top:2rem;">
            <a href="<?= url('branches') ?>" class="home-founder__link"><?= e(__('home_branches_view_all')) ?> →</a>
        </p>
        <?php endif; ?>
    </div>
</section>

<!-- Connect with Us -->
<section class="home-section home-connect fade-in">
    <div class="container">
        <h2 class="home-section__title home-section__title--center"><?= e(__('home_connect_title')) ?></h2>
        <div class="home-connect__links">
            <a href="https://wa.me/94<?= ltrim(CONTACT_WHATSAPP, '0') ?>" class="home-connect__link" target="_blank" rel="noopener">
                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.435 9.884-9.881 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                WhatsApp
            </a>
            <a href="<?= e(SOCIAL_FACEBOOK) ?>" class="home-connect__link" target="_blank" rel="noopener">
                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                Facebook
            </a>
        </div>
    </div>
</section>
