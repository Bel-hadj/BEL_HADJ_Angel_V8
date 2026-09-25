<?php

use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;

require_once('vendor/autoload.php');

// Fonction qui permet d'initialiser Twig en fixant le dossier des modèles
function init_twig() {
	// Indique le répertoire ou sont placés les modèles (templates)
	$loader = new FilesystemLoader('templates');

	// Le mode debug de Twig n'est activé qu'en local (XAMPP), jamais en production
	$debug = in_array($_SERVER['SERVER_NAME'] ?? '', ['localhost', '127.0.0.1'], true);

	// Crée un nouveau moteur Twig
	$twig = new Environment($loader, ['debug' => $debug]);
	if ($debug) {
		$twig->addExtension(new DebugExtension());
	}

	// Renvoie le moteur
	return $twig;
}
