<?php

// Initialise Twig
include('include/twig.php');
$twig = init_twig();

echo $twig->render('accueil.twig', [
	'titre' => 'Accueil',
	'lang' => 'fr',
	'description' => 'Asians Dreams : découvrez la pop culture asiatique à travers les K-Dramas, la K-Pop et les Mangas.',
]);
