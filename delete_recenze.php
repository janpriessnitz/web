<?php
    require __DIR__.'/vendor/autoload.php';
    use PhpPkg\EasyTpl\EasyTemplate;

    require_once 'db.php';

    session_start();
    $prihlaseni = ['id' => (array_key_exists('prihlaseny_uzivatel_id', $_SESSION) ? $_SESSION['prihlaseny_uzivatel_id'] : 0), 'email' => (array_key_exists('prihlaseny_uzivatel_email', $_SESSION) ? $_SESSION['prihlaseny_uzivatel_email'] : "")];


    $recenze_id = htmlspecialchars($_GET['id']);

    $query = $db->prepare('SELECT * FROM recenze WHERE id = :id');
    $query->execute([':id' => $recenze_id ]);
    $recenze = $query->fetchAll(PDO::FETCH_ASSOC)[0];

    if ($recenze['uzivatel'] != $prihlaseni['id']) {
        header("Location: index.php");
        die();
    }

    $query = $db->prepare('DELETE FROM recenze WHERE id = :id');
    $query->execute([':id' => $recenze_id ]);

    header("Location: recenze.php?knizka_id=".$recenze['knizka']);

    die();