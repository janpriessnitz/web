<?php

    require __DIR__.'/vendor/autoload.php';
    use PhpPkg\EasyTpl\EasyTemplate;

    require_once 'db.php';

    session_start();
    $prihlaseni = ['id' => (array_key_exists('prihlaseny_uzivatel_id', $_SESSION) ? $_SESSION['prihlaseny_uzivatel_id'] : 0), 'email' => (array_key_exists('prihlaseny_uzivatel_email', $_SESSION) ? $_SESSION['prihlaseny_uzivatel_email'] : "")];
    
    $query_knizka = $db->prepare('SELECT knizky.id, knizky.knizka FROM knizky WHERE :knizka_id = knizky.id');
    $query_knizka->execute([':knizka_id' => htmlspecialchars($_GET['knizka_id'])]);

    $query_stitky = $db->prepare('SELECT * FROM stitky WHERE :session_id = stitky.id_vlastnik');
    //TODO ZKONTROLOVAT PRIHLASENI
    $query_stitky->execute([ ':session_id' => $prihlaseni['id']]);

    $knizka = $query_knizka->fetchAll(PDO::FETCH_ASSOC)[0];

    $stitky = $query_stitky->fetchAll(PDO::FETCH_ASSOC);

    $vysledek = ['knizka' => $knizka, 'stitky' => $stitky];

    var_dump($vysledek);

    $vysledek['prihlaseni'] = $prihlaseni;

    $et = EasyTemplate::new();
    echo $et->render('static/formular_pridat_stitek.html', $vysledek);