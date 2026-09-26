<?php

require_once __DIR__ . '/include/twig.php';

$lang = normalize_lang($lang ?? 'fr');

// Nombre de fiches de chaque rubrique, affiché sur les cartes de l'accueil
$counts = [
	'kdrama' => count(load_data('kdramas', $lang)),
	'kpop' => count(load_data('kpop', $lang)),
	'mangas' => count(load_data('mangas', $lang)),
];

render_page('accueil', $lang, ['counts' => $counts]);
