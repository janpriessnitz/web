<?php
    require __DIR__.'/vendor/autoload.php';
    use PhpPkg\EasyTpl\EasyTemplate;

    require_once 'db.php';

    $query = $db->prepare('DELETE FROM knizky WHERE knizky.id = :knizka_id');
    $query->execute(['knizka_id'=> $_POST['knizka_id']]);

    $vysledek = array();

    session_start();
    $vysledek['prihlaseny_uzivatel_id'] = array_key_exists('prihlaseny_uzivatel_id', $_SESSION) ? $_SESSION['prihlaseny_uzivatel_id'] : 0;
    $vysledek['prihlaseny_uzivatel_email'] = array_key_exists('prihlaseny_uzivatel_email', $_SESSION) ? $_SESSION['prihlaseny_uzivatel_email'] : 0;

    $et = EasyTemplate::new();
    echo $et->render('static/formular_delete_knizka_overeni.html', $vysledek);