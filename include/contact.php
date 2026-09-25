<?php

// Fonctions du formulaire de contact : session, jeton CSRF, validation, enregistrement.
// Aucun e-mail n'est envoyé : les messages sont enregistrés dans storage/messages.jsonl
// (dossier protégé par .htaccess et ignoré par Git).

const CONTACT_STORAGE_FILE = ROOT_DIR . '/storage/messages.jsonl';
const CONTACT_STORAGE_MAX_BYTES = 2097152; // 2 Mo maximum, pour éviter de saturer le disque

function start_contact_session(): void
{
	if (session_status() === PHP_SESSION_NONE) {
		session_set_cookie_params([
			'lifetime' => 0,
			'path' => '/',
			'httponly' => true,
			'samesite' => 'Lax',
			'secure' => !empty($_SERVER['HTTPS']),
		]);
		session_start();
	}
}

function csrf_token(): string
{
	start_contact_session();
	if (empty($_SESSION['csrf'])) {
		$_SESSION['csrf'] = bin2hex(random_bytes(32));
	}
	return $_SESSION['csrf'];
}

function csrf_is_valid($token): bool
{
	start_contact_session();
	return is_string($token) && !empty($_SESSION['csrf']) && hash_equals($_SESSION['csrf'], $token);
}

// Nettoie une saisie : espaces, caractères de contrôle (sauf retours à la ligne pour le message).
function clean_input($value, bool $multiline = false): string
{
	$value = is_string($value) ? trim($value) : '';
	$pattern = $multiline ? '/[^\P{C}\n]/u' : '/\p{C}/u';
	return trim((string) preg_replace($pattern, '', str_replace("\r\n", "\n", $value)));
}

// Valide les données du formulaire. Retourne [données nettoyées, liste de clés d'erreurs].
function validate_contact(array $post): array
{
	$data = [
		'name' => clean_input($post['name'] ?? ''),
		'email' => clean_input($post['email'] ?? ''),
		'message' => clean_input($post['message'] ?? '', true),
	];
	$errors = [];

	$len = mb_strlen($data['name']);
	if ($len === 0) {
		$errors['name'] = 'name_required';
	} elseif ($len < 2 || $len > 100) {
		$errors['name'] = 'name_length';
	}

	if ($data['email'] === '') {
		$errors['email'] = 'email_required';
	} elseif (mb_strlen($data['email']) > 254 || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
		$errors['email'] = 'email_invalid';
	}

	$len = mb_strlen($data['message']);
	if ($len === 0) {
		$errors['message'] = 'message_required';
	} elseif ($len < 10 || $len > 2000) {
		$errors['message'] = 'message_length';
	}

	return [$data, $errors];
}

// Enregistre le message. Retourne false en cas d'échec (dossier non inscriptible, fichier trop gros).
function save_contact_message(array $data, string $lang): bool
{
	$dir = dirname(CONTACT_STORAGE_FILE);
	if (!is_dir($dir) && !@mkdir($dir, 0775, true)) {
		return false;
	}
	if (is_file(CONTACT_STORAGE_FILE) && filesize(CONTACT_STORAGE_FILE) > CONTACT_STORAGE_MAX_BYTES) {
		return false;
	}
	$line = json_encode([
		'date' => date('c'),
		'lang' => $lang,
		'name' => $data['name'],
		'email' => $data['email'],
		'message' => $data['message'],
	], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . "\n";

	return @file_put_contents(CONTACT_STORAGE_FILE, $line, FILE_APPEND | LOCK_EX) !== false;
}
