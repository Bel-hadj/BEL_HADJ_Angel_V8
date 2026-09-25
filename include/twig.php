<?php

use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;
use Twig\TwigFunction;

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/i18n.php';
require_once ROOT_DIR . '/vendor/autoload.php';

// Pages du site : clé => [URL française, URL anglaise].
// C'est la seule table à modifier pour ajouter ou renommer une page.
const SITE_PAGES = [
	'accueil'  => ['accueil.php', 'accueil_en.php'],
	'kdrama'   => ['kdrama.php', 'kdrama_en.php'],
	'kpop'     => ['kpop.php', 'kpop_en.php'],
	'mangas'   => ['mangas.php', 'mangas_en.php'],
	'a_propos' => ['a_propos.php', 'a_propos_en.php'],
	'contact'  => ['contact.php', 'contact_en.php'],
];

// URL d'une page dans la langue demandée.
function page_url(string $page, string $lang): string
{
	return SITE_PAGES[$page][$lang === 'en' ? 1 : 0];
}

// Initialise Twig pour une page et une langue données.
// Les variables communes à toutes les pages (langue, textes, menu, lien de
// changement de langue) sont déclarées ici sous forme de variables globales.
function init_twig(string $lang = 'fr', string $page = ''): Environment
{
	$lang = normalize_lang($lang);
	$local = app_is_local();

	$options = ['debug' => $local, 'strict_variables' => $local, 'cache' => false];
	if (!$local) {
		$cacheDir = ROOT_DIR . '/cache/twig';
		if (is_dir($cacheDir) || @mkdir($cacheDir, 0775, true)) {
			$options['cache'] = $cacheDir;
		}
	}

	$twig = new Environment(new FilesystemLoader(ROOT_DIR . '/templates'), $options);
	if ($local) {
		$twig->addExtension(new DebugExtension());
	}

	$t = translations($lang);

	$nav = [];
	foreach (array_keys(SITE_PAGES) as $key) {
		$nav[] = [
			'key' => $key,
			'label' => $t['nav'][$key],
			'url' => page_url($key, $lang),
			'current' => $key === $page,
		];
	}

	$otherLang = $lang === 'en' ? 'fr' : 'en';
	$twig->addGlobal('lang', $lang);
	$twig->addGlobal('page', $page);
	$twig->addGlobal('t', $t);
	$twig->addGlobal('nav', $nav);
	$twig->addGlobal('switch_lang', $otherLang);
	$twig->addGlobal('switch_url', $page !== '' ? page_url($page, $otherLang) : page_url('accueil', $otherLang));
	$twig->addGlobal('home_url', page_url('accueil', $lang));
	$twig->addGlobal('year', date('Y'));
	$twig->addGlobal('contact_email', CONTACT_EMAIL);
	$twig->addGlobal('page_urls', array_map(fn($p) => page_url($p, $lang), array_combine(array_keys(SITE_PAGES), array_keys(SITE_PAGES))));

	// asset('css/style.css') ajoute la date de modification pour éviter un cache périmé.
	$twig->addFunction(new TwigFunction('asset', function (string $path): string {
		$file = ROOT_DIR . '/' . $path;
		return $path . (is_file($file) ? '?v=' . filemtime($file) : '');
	}));

	// sprintf('Affiche de %s', titre) dans les templates
	$twig->addFunction(new TwigFunction('fmt', fn(string $format, ...$args): string => sprintf($format, ...$args)));

	return $twig;
}

// Affiche une page : le template porte le nom de la page (ex. 'kdrama' => kdrama.twig).
// En production, une erreur n'expose aucun détail : elle est journalisée et une page neutre est renvoyée.
function render_page(string $page, string $lang, array $vars = []): void
{
	try {
		$html = init_twig($lang, $page)->render($page . '.twig', $vars);
	} catch (Throwable $e) {
		if (app_is_local()) {
			throw $e;
		}
		error_log($e->getMessage());
		http_response_code(500);
		header('Content-Type: text/plain; charset=utf-8');
		echo $lang === 'en' ? 'Sorry, something went wrong.' : 'Désolé, une erreur est survenue.';
		return;
	}
	header('Content-Type: text/html; charset=utf-8');
	echo $html;
}
