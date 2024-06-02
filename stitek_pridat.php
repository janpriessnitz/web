<?php
    
    require __DIR__.'/vendor/autoload.php';
    use PhpPkg\EasyTpl\EasyTemplate;

    require_once 'db.php';

    $query_knizka = $db->prepare('SELECT knizky.id, knizky.knizka FROM knizky WHERE :knizka_id = knizky.id');
    $query_knizka->execute([':knizka_id' => htmlspecialchars($_GET['knizka_id'])]);

    $query_stitky = $db->prepare('SELECT * FROM stitky WHERE :session_id = stitky.id_vlastnik');
    $query_stitky->execute([ ':session_id' => '1']);

    $knizka = $query_knizka->fetchAll(PDO::FETCH_ASSOC)[0];

    $stitky = $query_stitky->fetchAll(PDO::FETCH_ASSOC);

    $vysledek = ['knizka' => $knizka, 'stitky' => $stitky];

    var_dump($vysledek);

    $et = EasyTemplate::new();
    echo $et->render('static/formular_pridat_stitek.html', $vysledek);