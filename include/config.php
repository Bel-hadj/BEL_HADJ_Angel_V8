<?php

// Configuration générale de l'application.
// Aucun secret n'est stocké ici : les valeurs sensibles (s'il y en a un jour)
// se placent dans des variables d'environnement ou dans include/config.local.php,
// fichier ignoré par Git (voir README).

define('ROOT_DIR', dirname(__DIR__));

// Vrai en local (XAMPP), faux sur l'hébergement.
// Peut être forcé avec la variable d'environnement APP_ENV=dev ou APP_ENV=prod.
function app_is_local(): bool
{
	$env = getenv('APP_ENV');
	if ($env !== false && $env !== '') {
		return $env === 'dev';
	}
	$host = $_SERVER['SERVER_NAME'] ?? 'localhost';
	return in_array($host, ['localhost', '127.0.0.1', '::1'], true);
}

// Réglages PHP : erreurs visibles en local, journalisées seulement en production.
error_reporting(E_ALL);
ini_set('display_errors', app_is_local() ? '1' : '0');
ini_set('log_errors', '1');

// Surcharge locale facultative (identifiants, options...), non versionnée.
if (is_file(__DIR__ . '/config.local.php')) {
	require __DIR__ . '/config.local.php';
}
