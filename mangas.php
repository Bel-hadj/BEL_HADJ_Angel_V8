<?php

require_once __DIR__ . '/include/twig.php';

$lang = normalize_lang($lang ?? 'fr');

render_page('mangas', $lang, ['articles' => load_data('mangas', $lang)]);
