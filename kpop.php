<?php
    include('include/twig.php');
    $twig = init_twig();

    include('include/data_kpop.php');

    echo $twig->render('celebrite.twig', [
        'titre' => 'K-Pop',
        'all_articles' => $categorie2,
        'categorie' => 'celebrite',
        'lang' => $lang,
        'description' => 'Actualités et présentation des groupes et artistes K-Pop : BTS, Blackpink, Stray Kids, TXT et Twice.',
    ]);
?>