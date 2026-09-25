<?php

// Initialise Twig
include('include/twig.php');
$twig = init_twig();

$nom = trim($_POST['nom'] ?? '');
$email = trim($_POST['email'] ?? '');
$message = trim($_POST['message'] ?? '');

$erreurs = [];

if ($nom === '') {
	$erreurs[] = 'Le nom et prénom sont obligatoires.';
}

if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
	$erreurs[] = 'Une adresse mail valide est obligatoire.';
}

if ($message === '') {
	$erreurs[] = 'Le message ne peut pas être vide.';
}

echo $twig->render('reception.twig', [
	'titre' => $erreurs ? 'Formulaire incomplet' : 'Message envoyé',
	'lang' => 'fr',
	'description' => 'Confirmation d\'envoi du formulaire de contact Asians Dreams.',
	'erreurs' => $erreurs,
	'nom' => $nom,
	'email' => $email,
	'message' => $message,
]);
