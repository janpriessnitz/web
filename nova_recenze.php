<?php

    require __DIR__.'/vendor/autoload.php';
    use PhpPkg\EasyTpl\EasyTemplate;

    require_once 'db.php';

    $kniha_id = htmlspecialchars($_GET['kniha_id']);
    // TODO: osetrit neexistujici parametr

    $query_kniha = $db->prepare('SELECT id, knizka FROM knizky WHERE id = :kniha_id');
    $query_kniha->execute([':kniha_id' => $kniha_id]);

    // TODO: osetrit neexistujici id
    $kniha = $query_kniha->fetchAll(PDO::FETCH_ASSOC)[0];

    $vysledek = ['kniha' => $kniha];

    session_start();
    $vysledek['prihlaseni'] = ['id' => (array_key_exists('prihlaseny_uzivatel_id', $_SESSION) ? $_SESSION['prihlaseny_uzivatel_id'] : 0), 'email' => (array_key_exists('prihlaseny_uzivatel_email', $_SESSION) ? $_SESSION['prihlaseny_uzivatel_email'] : "")];

    $et = EasyTemplate::new();
    echo $et->render('static/formular_nova_recenze.html', $vysledek);