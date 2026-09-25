<?php
    include('include/twig.php');
    $twig = init_twig();

    include('include/data_kdramas_en.php');
    
    echo $twig->render('kdrama.twig', [
        'titre' => 'Page kdrama',
        'categorie' => 'kdramas', 
        'all_articles' => $categorie3,
        'lang' => $lang,
    ]);

?>