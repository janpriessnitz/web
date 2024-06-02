<?php

    require __DIR__.'/vendor/autoload.php';
    use PhpPkg\EasyTpl\EasyTemplate;

    require_once 'db.php';

    $query = $db->prepare('SELECT knizka, autor, zanr, id FROM knizky WHERE knizky.id = :knizka_id');
    $query->execute([':knizka_id' =>  htmlspecialchars($_GET['knizka_id'])]);

    $query_autori = $db->prepare('SELECT * FROM autori');
    $query_autori->execute();

    $query_zanry = $db->prepare('SELECT * FROM zanry');
    $query_zanry->execute();

    $knizka = $query->fetchAll(PDO::FETCH_ASSOC)[0];

    $autori = $query_autori->fetchAll(PDO::FETCH_ASSOC);

    $zanry = $query_zanry->fetchAll(PDO::FETCH_ASSOC);

    $vysledek = ['knizka' => $knizka, 'autori' => $autori, 'zanry' => $zanry];

    session_start();
    $vysledek['prihlaseni'] = ['id' => array_key_exists('prihlaseny_uzivatel_id', $_SESSION) ? $_SESSION['prihlaseny_uzivatel_id'] : 0, 'email' => array_key_exists('prihlaseny_uzivatel_email', $_SESSION) ? $_SESSION['prihlaseny_uzivatel_email'] : 0];

    $et = EasyTemplate::new();
    echo $et->render('static/formular_edit_knizka.html', $vysledek);