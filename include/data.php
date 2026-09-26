<?php

// Chargement des contenus des fiches.
// Chaque fichier include/data_<rubrique>[_en].php retourne son tableau de fiches (return [...]).

const DATA_SECTIONS = ['kdramas', 'kpop', 'mangas'];

/**
 * Retourne les fiches d'une rubrique dans la langue demandée.
 *
 * @param 'kdramas'|'kpop'|'mangas' $section
 * @return list<array<string, mixed>>
 */
function load_data(string $section, string $lang): array
{
	if (!in_array($section, DATA_SECTIONS, true)) {
		throw new InvalidArgumentException("Rubrique inconnue : {$section}");
	}

	$file = __DIR__ . '/data_' . $section . (normalize_lang($lang) === 'en' ? '_en' : '') . '.php';
	$data = require $file;

	if (!is_array($data)) {
		throw new UnexpectedValueException("Le fichier {$file} doit retourner un tableau.");
	}
	return $data;
}
