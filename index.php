<?php

    require __DIR__.'/vendor/autoload.php';
    use PhpPkg\EasyTpl\EasyTemplate;

    require_once 'db.php';

    $query = $db->prepare('SELECT knizky.id AS id, autori.jmeno AS autor, knizky.knizka AS knizka, zanry.nazev AS zanr FROM `knizky` JOIN `zanry` ON knizky.zanr = zanry.id JOIN `autori` ON knizky.autor = autori.id;');
    $query->execute();

    $knizky = $query->fetchAll(PDO::FETCH_ASSOC);

    $vysledek = ['knizky' => $knizky];

    session_start();
    $vysledek['prihlaseny_uzivatel_id'] = array_key_exists('prihlaseny_uzivatel_id', $_SESSION) ? $_SESSION['prihlaseny_uzivatel_id'] : 0;
    $vysledek['prihlaseny_uzivatel_email'] = array_key_exists('prihlaseny_uzivatel_email', $_SESSION) ? $_SESSION['prihlaseny_uzivatel_email'] : 0;

    $et = EasyTemplate::new();
    echo $et->render('static/tabulka_knizek.html', $vysledek);

