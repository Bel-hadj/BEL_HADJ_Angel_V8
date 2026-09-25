<?php

// Traitement du formulaire de contact (envoyé en POST depuis contact.php / contact_en.php).
// Validation, protection CSRF et anti-spam, puis redirection vers la page de contact.

require_once __DIR__ . '/include/twig.php';
require_once __DIR__ . '/include/contact.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	header('Location: contact.php');
	exit;
}

$lang = normalize_lang($_POST['lang'] ?? 'fr');
$contactUrl = page_url('contact', $lang);

// Piège à robots : ce champ est masqué et doit rester vide. On fait comme si tout allait bien.
if (($_POST['website'] ?? '') !== '') {
	header('Location: ' . $contactUrl);
	exit;
}

[$data, $errors] = validate_contact($_POST);
$formErrors = [];

if (!csrf_is_valid($_POST['csrf'] ?? null)) {
	$formErrors[] = 'csrf';
} elseif (!$errors && !save_contact_message($data, $lang)) {
	$formErrors[] = 'storage';
}

if (!$errors && !$formErrors) {
	// Succès : nouveau jeton, message flash, redirection (évite le renvoi du formulaire au rechargement)
	unset($_SESSION['csrf']);
	$_SESSION['contact_sent'] = true;
	header('Location: ' . $contactUrl);
	exit;
}

http_response_code(422);
render_page('contact', $lang, [
	'csrf' => csrf_token(),
	'sent' => false,
	'errors' => $errors,
	'form_errors' => $formErrors,
	'old' => $data,
]);
