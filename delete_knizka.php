<?php
    require __DIR__.'/vendor/autoload.php';
    use PhpPkg\EasyTpl\EasyTemplate;

    require_once 'db.php';

    $query = $db->prepare('SELECT knizky.id, knizky.knizka, autori.jmeno, zanry.nazev FROM knizky JOIN autori ON autori.id = knizky.autor JOIN zanry ON zanry.id = knizky.zanr WHERE knizky.id = :knizka_id');
    $query->execute([':knizka_id' => htmlspecialchars($_GET['knizka_id'])]);

    $knizka = $query->fetchAll(PDO::FETCH_ASSOC);

    $vysledek = ['knizka' => $knizka[0]];

    session_start();
    $vysledek['prihlaseny_uzivatel_id'] = array_key_exists('prihlaseny_uzivatel_id', $_SESSION) ? $_SESSION['prihlaseny_uzivatel_id'] : 0;
    $vysledek['prihlaseny_uzivatel_email'] = array_key_exists('prihlaseny_uzivatel_email', $_SESSION) ? $_SESSION['prihlaseny_uzivatel_email'] : 0;

    $et = EasyTemplate::new();
    echo $et->render('static/formular_delete_knizka.html', $vysledek);