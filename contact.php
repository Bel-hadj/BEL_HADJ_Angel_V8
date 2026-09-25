<?php

require_once __DIR__ . '/include/twig.php';
require_once __DIR__ . '/include/contact.php';

$lang = normalize_lang($lang ?? 'fr');

// Message de confirmation affiché une seule fois après l'envoi (voir reception.php)
start_contact_session();
$sent = !empty($_SESSION['contact_sent']);
unset($_SESSION['contact_sent']);

render_page('contact', $lang, [
	'csrf' => csrf_token(),
	'sent' => $sent,
	'errors' => [],
	'form_errors' => [],
	'old' => ['name' => '', 'email' => '', 'message' => ''],
]);
