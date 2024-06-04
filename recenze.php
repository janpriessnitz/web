<?php

    require __DIR__.'/vendor/autoload.php';
    use PhpPkg\EasyTpl\EasyTemplate;

    require_once 'db.php';

    // TODO: zkontrolovat knizka_id
    session_start();
    $prihlaseni = ['id' => (array_key_exists('prihlaseny_uzivatel_id', $_SESSION) ? $_SESSION['prihlaseny_uzivatel_id'] : 0), 'email' => (array_key_exists('prihlaseny_uzivatel_email', $_SESSION) ? $_SESSION['prihlaseny_uzivatel_email'] : "")];

    $recenze_query = $db->prepare('SELECT recenze.id AS id, recenze.text AS text_recenze, uzivatele.jmeno AS uzivatel, uzivatele.id AS uzivatel_id FROM recenze JOIN uzivatele ON recenze.uzivatel = uzivatele.id WHERE recenze.knizka = :knizka_id');
    $recenze_query->execute([':knizka_id'=>$_GET['knizka_id']]);

    $knizka_query = $db->prepare('SELECT zanry.nazev AS zanr, autori.jmeno AS autor, knizky.knizka, knizky.id FROM knizky JOIN zanry ON knizky.zanr = zanry.id JOIN autori ON knizky.autor = autori.id WHERE :knizka_id = knizky.id');
    $knizka_query->execute([':knizka_id'=>$_GET['knizka_id']]);

    $recenze = $recenze_query->fetchAll(PDO::FETCH_ASSOC);

    $knizka = $knizka_query->fetchAll(PDO::FETCH_ASSOC);


    //var_dump($knizka[0]['id']);

    // $query_stitky = $db->prepare('SELECT * FROM knizky_stitky JOIN stitky ON stitky.id = knizky_stitky.stitek WHERE :knizka_id = knizky_stitky.knizka AND stitky.id_vlastnik = :vlastnik;');
    // $query_stitky->execute([':knizka_id'=>$knizka[0]['id'], ':vlastnik'=> $prihlaseni['id']]);
    // $stitky = $query_stitky->fetchAll(PDO::FETCH_ASSOC);

    $query_stitky = $db->prepare('SELECT * FROM stitky WHERE :session_id = stitky.id_vlastnik');
    $query_stitky->execute([':session_id' => $prihlaseni['id']]);
    $stitky = $query_stitky->fetchAll(PDO::FETCH_ASSOC);

    $query_mn = $db->prepare('SELECT * FROM knizky_stitky JOIN stitky ON knizky_stitky.stitek = stitky.id WHERE stitky.id_vlastnik = :id_vlastnik AND knizky_stitky.knizka = :knizka_id');
    $query_mn->execute([':id_vlastnik' => $prihlaseni['id'], ':knizka_id' => htmlspecialchars($_GET['knizka_id'])]);
    $mn = $query_mn->fetchAll(PDO::FETCH_ASSOC);


    $stitky_prirazene = array();

    foreach ($stitky as $stitek) {
        $stitky_prirazene[$stitek['id']] = false;
    }

    foreach ($mn as $stitek_kniha) {
        $stitky_prirazene[$stitek_kniha['stitek']] = true;
    }

    // $vysledek = ['knizka' => $knizka, 'stitky' => $stitky, 'stitky_prirazene' => $stitky_prirazene];

    $vysledek = ['recenze' => $recenze, 'knizka' => $knizka[0], 'stitky' => $stitky, 'stitky_prirazene' => $stitky_prirazene];


    $vysledek['prihlaseni'] = ['id' => (array_key_exists('prihlaseny_uzivatel_id', $_SESSION) ? $_SESSION['prihlaseny_uzivatel_id'] : 0), 'email' => (array_key_exists('prihlaseny_uzivatel_email', $_SESSION) ? $_SESSION['prihlaseny_uzivatel_email'] : "")];

    $et = EasyTemplate::new();
    echo $et->render('static/tabulka_recenze.html', $vysledek);