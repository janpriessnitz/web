<?php
    require __DIR__.'/vendor/autoload.php';
    use PhpPkg\EasyTpl\EasyTemplate;

    require_once 'db.php';

    $recenze_id = htmlspecialchars($_GET['id']);

    $query = $db->prepare('SELECT recenze.id, recenze.text, knizky.knizka AS kniha_nazev, knizky.id AS kniha_id FROM recenze JOIN knizky ON recenze.knizka = knizky.id WHERE recenze.id = :recenze_id');
    $query->execute([':recenze_id' => $recenze_id]);

    $recenze = $query->fetchAll(PDO::FETCH_ASSOC)[0];

    $vysledek = ['recenze' => $recenze];

    session_start();
    $vysledek['prihlaseni'] = ['id' => array_key_exists('prihlaseny_uzivatel_id', $_SESSION) ? $_SESSION['prihlaseny_uzivatel_id'] : 0, 'email' => array_key_exists('prihlaseny_uzivatel_email', $_SESSION) ? $_SESSION['prihlaseny_uzivatel_email'] : 0];

    $et = EasyTemplate::new();
    echo $et->render('static/formular_edit_recenze.html', $vysledek);