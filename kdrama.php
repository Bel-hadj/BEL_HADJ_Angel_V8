<?php
    include('include/twig.php');
    $twig = init_twig();

    include('include/data_kdramas.php');

    echo $twig->render('kdrama.twig', [
        'titre' => 'K-Dramas',
        'page' => 'kdrama',
        'categorie' => 'kdramas',
        'all_articles' => $categorie3,
        'lang' => $lang,
        'description' => 'Découvrez notre sélection de K-Dramas : résumés, casting et bandes-annonces.',
    ]);

?>