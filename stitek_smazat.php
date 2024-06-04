<?php
    require __DIR__.'/vendor/autoload.php';
    use PhpPkg\EasyTpl\EasyTemplate;

    require_once 'db.php';

    session_start();

    $prihlaseni = ['id' => (array_key_exists('prihlaseny_uzivatel_id', $_SESSION) ? $_SESSION['prihlaseny_uzivatel_id'] : 0), 'email' => (array_key_exists('prihlaseny_uzivatel_email', $_SESSION) ? $_SESSION['prihlaseny_uzivatel_email'] : "")];

    $query = $db->prepare('DELETE FROM knizky_stitky WHERE knizky_stitky.stitek = :stitek_id AND knizky_stitky.knizka = :knizka_id');
    $query->execute(['stitek_id'=>htmlspecialchars($_GET['stitek_id']), 'knizka_id'=>htmlspecialchars($_GET['knizka_id'])]);

    $vysledek = array();

    $vysledek['prihlaseni'] = ['id' => (array_key_exists('prihlaseny_uzivatel_id', $_SESSION) ? $_SESSION['prihlaseny_uzivatel_id'] : 0), 'email' => (array_key_exists('prihlaseny_uzivatel_email', $_SESSION) ? $_SESSION['prihlaseny_uzivatel_email'] : "")];

    $et = EasyTemplate::new();
    echo $et->render('static/formular_delete_knizka_overeni.html', $vysledek);