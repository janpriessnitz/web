<?php
    require __DIR__.'/vendor/autoload.php';
    use PhpPkg\EasyTpl\EasyTemplate;

    require_once 'db.php';

    $query = $db->prepare('DELETE FROM zanry WHERE :zanr_id = zanry.id');
    $query->execute([':zanr_id' => htmlspecialchars($_POST['ke_smazani'])]);

    header('Location: index.php');

    $vysledek = array();
    session_start();
    $vysledek['prihlaseni'] = ['id' => (array_key_exists('prihlaseny_uzivatel_id', $_SESSION) ? $_SESSION['prihlaseny_uzivatel_id'] : 0), 'email' => (array_key_exists('prihlaseny_uzivatel_email', $_SESSION) ? $_SESSION['prihlaseny_uzivatel_email'] : "")];