<?php

    require __DIR__.'/vendor/autoload.php';
    use PhpPkg\EasyTpl\EasyTemplate;

    require_once 'db.php';

    session_start();
    $prihlaseni = ['id' => (array_key_exists('prihlaseny_uzivatel_id', $_SESSION) ? $_SESSION['prihlaseny_uzivatel_id'] : 0), 'email' => (array_key_exists('prihlaseny_uzivatel_email', $_SESSION) ? $_SESSION['prihlaseny_uzivatel_email'] : "")];
    
    if($prihlaseni['id'] == 0){
        header("Location: index.php");
    }
    else{
    $query_knizka = $db->prepare('SELECT knizky.id, knizky.knizka FROM knizky WHERE :knizka_id = knizky.id');
    $query_knizka->execute([':knizka_id' => htmlspecialchars($_GET['knizka_id'])]);
    $knizka = $query_knizka->fetchAll(PDO::FETCH_ASSOC)[0];

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

    $vysledek = ['knizka' => $knizka, 'stitky' => $stitky, 'stitky_prirazene' => $stitky_prirazene];

    $vysledek['prihlaseni'] = $prihlaseni;

    $et = EasyTemplate::new();
    echo $et->render('static/formular_pridat_stitek.html', $vysledek);
    }