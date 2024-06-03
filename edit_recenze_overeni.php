<!-- TODO vycistit input od uzivatele - mezery pred nazvem -->

<?php
    require __DIR__.'/vendor/autoload.php';
    use PhpPkg\EasyTpl\EasyTemplate;

    require_once 'db.php';

    session_start();
    $prihlaseni = ['id' => (array_key_exists('prihlaseny_uzivatel_id', $_SESSION) ? $_SESSION['prihlaseny_uzivatel_id'] : 0), 'email' => (array_key_exists('prihlaseny_uzivatel_email', $_SESSION) ? $_SESSION['prihlaseny_uzivatel_email'] : "")];


    $recenze_id = htmlspecialchars($_POST['recenze_id']);

    $text = htmlspecialchars($_POST['recenze_text']);
    $kniha_id = htmlspecialchars($_POST['kniha_id']);

    $query = $db->prepare('SELECT * FROM recenze WHERE id = :id');
    $query->execute([':id' => $recenze_id ]);
    $recenze = $query->fetchAll(PDO::FETCH_ASSOC)[0];


    if ($recenze['uzivatel'] != $prihlaseni['id']) {
        $_SESSION['error_msg'] = "Nemůžete upravit cizí recenzi!";
        header("Location: index.php");
        die();
    }

    $query = $db->prepare('UPDATE recenze SET text = :text WHERE id = :id');
    $query->execute([':text' => $text, ':id' => $recenze_id ]);

    header("Location: recenze.php?knizka_id=".$kniha_id);

    die();