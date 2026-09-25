<?php

// Initialise Twig
include('include/twig.php');
$twig = init_twig();


echo $twig->render('a_propos.twig', [
	'titre' => 'Page a_propos',
	'message' => 'Un message de bienvenu sur ma page d\'accueil. Attention les guillements doivent être échappées (avec un anti-slash)'
]);
