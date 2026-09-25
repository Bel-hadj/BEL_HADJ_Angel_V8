<?php
    include('include/twig.php');
    $twig = init_twig();

    include('include/data_mangas_en.php');

    echo $twig->render('mangas.twig', [
        'titre' => 'Mangas',
        'all_articles' => $categorie1,
        'lang' => $lang,
        'description' => 'Discover our shonen manga selection: Chainsaw Man, Solo Leveling, Mashle, One-Punch Man and more.',
    ]);
?>
