<?php
    require __DIR__.'/vendor/autoload.php';
    use PhpPkg\EasyTpl\EasyTemplate;

    require_once 'db.php';

    session_start();
    $prihlaseni = ['id' => (array_key_exists('prihlaseny_uzivatel_id', $_SESSION) ? $_SESSION['prihlaseny_uzivatel_id'] : ""), 'email' => (array_key_exists('prihlaseny_uzivatel_email', $_SESSION) ? $_SESSION['prihlaseny_uzivatel_email'] : "")];

    if ($prihlaseni['id'] == "") {
        header("Location: recenze.php?knizka_id=".htmlspecialchars($_POST['kniha_id']));
    }

    $query = $db->prepare('INSERT INTO recenze(uzivatel, text, knizka) VALUES (:uzivatel, :text, :knizka)');
    $query->execute([':knizka' => htmlspecialchars($_POST['kniha_id']), ':text' => htmlspecialchars($_POST['recenze_text']), ':uzivatel' => $prihlaseni['id']]);

    header("Location: recenze.php?knizka_id=".htmlspecialchars($_POST['kniha_id']));
    die();

    // $et = EasyTemplate::new();