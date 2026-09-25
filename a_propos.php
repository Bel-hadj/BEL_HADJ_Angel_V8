<?php

// Initialise Twig
include('include/twig.php');
$twig = init_twig();

echo $twig->render('a_propos.twig', [
	'titre' => 'À propos',
	'page' => 'a_propos',
	'lang' => 'fr',
	'description' => 'Découvrez le concept d\'Asians Dreams et la passion pour les K-Dramas et les Mangas qui est à l\'origine de ce projet.',
]);
