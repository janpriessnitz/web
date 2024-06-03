<?php
    require __DIR__.'/vendor/autoload.php';
    use PhpPkg\EasyTpl\EasyTemplate;

    require_once 'db.php';
    // jen pro admina

    $query = $db->prepare('SELECT * FROM autori');
    $query->execute();

    $autori = $query->fetchAll(PDO::FETCH_ASSOC);

    $vysledek = ['autori' => $autori];

    // var_dump($vysledek);

    session_start();
    $vysledek['prihlaseni'] = ['id' => (array_key_exists('prihlaseny_uzivatel_id', $_SESSION) ? $_SESSION['prihlaseny_uzivatel_id'] : 0), 'email' => (array_key_exists('prihlaseny_uzivatel_email', $_SESSION) ? $_SESSION['prihlaseny_uzivatel_email'] : "")];

    $et = EasyTemplate::new();
    echo $et->render('static/formular_delete_autor.html', $vysledek);