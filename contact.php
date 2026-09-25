<?php

// Initialise Twig
include('include/twig.php');
$twig = init_twig();

echo $twig->render('contact.twig', [
	'titre' => 'Contact',
	'page' => 'contact',
	'lang' => 'fr',
	'description' => 'Contactez Asians Dreams pour toute question sur les K-Dramas, la K-Pop ou les Mangas.',
]);
