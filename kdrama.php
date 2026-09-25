<?php

require_once __DIR__ . '/include/twig.php';

$lang = normalize_lang($lang ?? 'fr');
require __DIR__ . '/include/data_kdramas' . ($lang === 'en' ? '_en' : '') . '.php';

render_page('kdrama', $lang, ['articles' => $categorie3]);
