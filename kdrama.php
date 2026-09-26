<?php

require_once __DIR__ . '/include/twig.php';

$lang = normalize_lang($lang ?? 'fr');

render_page('kdrama', $lang, ['articles' => load_data('kdramas', $lang)]);
