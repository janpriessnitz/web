<?php

    require __DIR__.'/vendor/autoload.php';
    use PhpPkg\EasyTpl\EasyTemplate;

    require_once 'db.php';

    // TODO: zkontrolovat knizka_id

    $recenze_query = $db->prepare('SELECT recenze.id AS id, recenze.text AS text_recenze, uzivatele.jmeno AS uzivatel FROM recenze JOIN uzivatele ON recenze.uzivatel = uzivatele.id WHERE recenze.knizka = :knizka_id');
    $recenze_query->execute([':knizka_id'=>$_GET['knizka_id']]);

    $knizka_query = $db->prepare('SELECT zanry.nazev AS zanr, autori.jmeno AS autor, knizky.knizka, knizky.id FROM knizky JOIN zanry ON knizky.zanr = zanry.id JOIN autori ON knizky.autor = autori.id WHERE :knizka_id = knizky.id');
    $knizka_query->execute([':knizka_id'=>$_GET['knizka_id']]);

    $recenze = $recenze_query->fetchAll(PDO::FETCH_ASSOC);

    $knizka = $knizka_query->fetchAll(PDO::FETCH_ASSOC);

    $vysledek = ['recenze' => $recenze, 'knizka' => $knizka[0]];

    session_start();
    $vysledek['prihlaseny_uzivatel_id'] = array_key_exists('prihlaseny_uzivatel_id', $_SESSION) ? $_SESSION['prihlaseny_uzivatel_id'] : 0;
    $vysledek['prihlaseny_uzivatel_email'] = array_key_exists('prihlaseny_uzivatel_email', $_SESSION) ? $_SESSION['prihlaseny_uzivatel_email'] : 0;

    $et = EasyTemplate::new();
    echo $et->render('static/tabulka_recenze.html', $vysledek);