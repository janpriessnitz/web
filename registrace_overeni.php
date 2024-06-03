<?php

    require __DIR__.'/vendor/autoload.php';
    use PhpPkg\EasyTpl\EasyTemplate;

    require_once 'db.php';

    $jmeno = htmlspecialchars($_POST['jmeno']);
    $email = htmlspecialchars($_POST['email']);
    $heslo = $_POST['heslo'];
    $hash = password_hash($heslo, PASSWORD_DEFAULT);

    $query = $db->prepare('INSERT INTO uzivatele(jmeno, email, heslo) VALUES(:jmeno, :email, :heslo)');
    $query->execute([':jmeno' => $jmeno, ':email' => $email, ':heslo' => $hash]);

    $vysledek = array();
    session_start();
    $vysledek['prihlaseni'] = ['id' => (array_key_exists('prihlaseny_uzivatel_id', $_SESSION) ? $_SESSION['prihlaseny_uzivatel_id'] : 0), 'email' => (array_key_exists('prihlaseny_uzivatel_email', $_SESSION) ? $_SESSION['prihlaseny_uzivatel_email'] : "")];

    $et = EasyTemplate::new();
    echo $et->render('static/registrace_overeni.html', $vysledek);

