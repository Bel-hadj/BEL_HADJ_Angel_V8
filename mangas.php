<?php
include('include/twig.php');
$twig = init_twig();

include('include/data_mangas.php');

echo $twig->render('mangas.twig', [
    'titre' => 'Mangas',
    'page' => 'mangas',
    'all_articles' => $categorie1,
    'lang' => $lang,
    'description' => 'Découvrez notre sélection de mangas shonen : Chainsaw Man, Solo Leveling, Mashle, One-Punch Man et plus.',
]);
?>
