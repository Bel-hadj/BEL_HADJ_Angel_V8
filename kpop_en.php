<?php
    include('include/twig.php');
    $twig = init_twig();

    include('include/data_kpop_en.php');
    echo $twig->render('celebrite.twig', [
        'titre' => 'K-Pop',
        'page' => 'kpop',
        'all_articles' => $categorie2,
        'categorie' => 'celebrite',
        'lang' => $lang,
        'description' => 'News and profiles of K-Pop groups and artists: BTS, Blackpink, Stray Kids, TXT and Twice.',
    ]);
?>