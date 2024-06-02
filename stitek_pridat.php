<?php
    
    require __DIR__.'/vendor/autoload.php';
    use PhpPkg\EasyTpl\EasyTemplate;

    require_once 'db.php';

    $query_knizka = $db->prepare('SELECT knizky.id, knizky.knizka FROM knizky WHERE :knizka_id = knizky.id');
    $query_knizka->execute([':knizka_id' => htmlspecialchars($_GET['knizka_id'])]);

    $query_stitky = $db->prepare('SELECT * FROM stitky WHERE :session_id = stitky.id_vlastnik');
    $query_stitky->execute([ ':session_id' => '1']);

    $query_knizka->fetchAll(PDO::FETCH_ASSOC);

    $query_stitky->fetchAll(PDO::FETCH_ASSOC);

    $vysledek = ['knizka' => $query_knizka, 'stitky' => $query_stitky];

    $et = EasyTemplate::new();
    echo $et->render('static/formular_pridat_stitek.html', $vysledek);