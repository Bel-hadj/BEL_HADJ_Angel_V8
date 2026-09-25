<?php
    include('include/twig.php');
    $twig = init_twig();

    include('include/data_kpop_en.php');
    echo $twig->render('celebrite.twig', [
        'all_articles' => $categorie2,
        'categorie' => 'celebrite',
        'lang' => $lang,

    ]);
?>