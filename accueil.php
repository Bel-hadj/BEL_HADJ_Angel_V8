<?php

require_once __DIR__ . '/include/twig.php';

$lang = normalize_lang($lang ?? 'fr');
$suffix = $lang === 'en' ? '_en' : '';

// Nombre de fiches de chaque rubrique, affiché sur les cartes de l'accueil
$counts = [];
require __DIR__ . "/include/data_kdramas{$suffix}.php";
$counts['kdrama'] = count($categorie3);
require __DIR__ . "/include/data_kpop{$suffix}.php";
$counts['kpop'] = count($categorie2);
require __DIR__ . "/include/data_mangas{$suffix}.php";
$counts['mangas'] = count($categorie1);

render_page('accueil', $lang, ['counts' => $counts]);
