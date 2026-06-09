<?php

$local = file_exists(__DIR__ . '/local.php') ? require __DIR__ . '/local.php' : [];

define('APP_NAME', 'Menaka Peiris Dancing Academy');
define('APP_SHORT', 'MPDA');

$defaultBaseUrl = getenv('VERCEL') ? '' : '/mpda';
define('BASE_URL', $local['base_url'] ?? $defaultBaseUrl);
define('DOMAIN', 'mpdancingacademy.com');

define('CONTACT_PHONE', '0112612560');
define('CONTACT_WHATSAPP', '0772454288');
define('CONTACT_EMAIL', 'infoatmpda@gmail.com');
define('CONTACT_ADDRESS', 'Span Tower 27, Veerapuran Appu Mawatha, Moratuwa');
define('YEAR_ESTABLISHED', 2017);
define('FOUNDER_NAME', 'H. Menaka Peiris');

define('SOCIAL_FACEBOOK', 'https://www.facebook.com/share/14nKppDsLTk/?mibextid=wwXIfr');
define('SOCIAL_INSTAGRAM', 'https://www.instagram.com/menaka_peiris_dancing_academy_?igsh=NjBreTQ2b2IyOHRh');
define('SOCIAL_TIKTOK', 'https://www.tiktok.com/@menaka.peiris');
define('SOCIAL_YOUTUBE', 'https://youtube.com/@menakapeirisdancing?si=_4Rh8JmNV-qEb2EG');
define('SOCIAL_WHATSAPP_CHANNEL', 'https://whatsapp.com/channel/0029VbCdx1A3LdQZsTm7dS1x');
