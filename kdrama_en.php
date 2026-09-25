<?php
    include('include/twig.php');
    $twig = init_twig();

    include('include/data_kdramas_en.php');

    echo $twig->render('kdrama.twig', [
        'titre' => 'K-Dramas',
        'categorie' => 'kdramas',
        'all_articles' => $categorie3,
        'lang' => $lang,
        'description' => 'Discover our K-Drama selection: summaries, cast and trailers.',
    ]);

?>