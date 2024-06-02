<?php

    require __DIR__.'/vendor/autoload.php';
    use PhpPkg\EasyTpl\EasyTemplate;

    require_once 'db.php';

    $query_autori = $db->prepare('SELECT * FROM autori');
    $query_autori->execute();

    $query_zanry = $db->prepare('SELECT * FROM zanry');
    $query_zanry->execute();

    $autori = $query_autori->fetchAll(PDO::FETCH_ASSOC);

    $zanry = $query_zanry->fetchAll(PDO::FETCH_ASSOC);

    $vysledek = ['autori' => $autori, 'zanry' => $zanry];

    session_start();
    $vysledek['prihlaseny_uzivatel_id'] = array_key_exists('prihlaseny_uzivatel_id', $_SESSION) ? $_SESSION['prihlaseny_uzivatel_id'] : 0;
    $vysledek['prihlaseny_uzivatel_email'] = array_key_exists('prihlaseny_uzivatel_email', $_SESSION) ? $_SESSION['prihlaseny_uzivatel_email'] : 0;

    $et = EasyTemplate::new();
    echo $et->render('static/formular_nova_knizka.html', $vysledek);