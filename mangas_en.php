<?php
    include('include/twig.php');
    $twig = init_twig();

    include('include/data_mangas_en.php');

    echo $twig->render('mangas.twig', [
        'all_articles' => $categorie1,
        'lang' => $lang,

    ]);


?>