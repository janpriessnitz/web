<?php
    require __DIR__.'/vendor/autoload.php';
    use PhpPkg\EasyTpl\EasyTemplate;

    require_once 'db.php';

    // overit id, text
    var_dump($_POST);

    // TODO: overit prihlaseni
    session_start();
    $user_id = $_SESSION['prihlaseny_uzivatel_id'];

    $query = $db->prepare('INSERT INTO recenze(uzivatel, text, knizka) VALUES (:uzivatel, :text, :knizka)');
    $query->execute([':knizka' => htmlspecialchars($_POST['kniha_id']), ':text' => htmlspecialchars($_POST['recenze_text']), ':uzivatel' => $user_id]);

    // $vysledek = ['knizka' => htmlspecialchars($_POST['knizka_text']), 'autor' => $autor_text, 'zanr' => $zanr_text];

    header("Location: recenze.php?knizka_id=".htmlspecialchars($_POST['kniha_id']));
    die();

    // $et = EasyTemplate::new();