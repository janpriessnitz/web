<?php
    require __DIR__.'/vendor/autoload.php';
    use PhpPkg\EasyTpl\EasyTemplate;

    require_once 'db.php';
    // jen pro admina

    session_start();
    $prihlaseni = ['id' => (array_key_exists('prihlaseny_uzivatel_id', $_SESSION) ? $_SESSION['prihlaseny_uzivatel_id'] : 0), 'email' => (array_key_exists('prihlaseny_uzivatel_email', $_SESSION) ? $_SESSION['prihlaseny_uzivatel_email'] : "")];

    if ($prihlaseni['email'] != 'admin@admin') {
        $_SESSION['error_msg'] = 'Do této sekce nemáte přístup!';
        header('Location: index.php');
    }

    $query = $db->prepare('SELECT * FROM autori');
    $query->execute();

    $autori = $query->fetchAll(PDO::FETCH_ASSOC);

    $vysledek = ['autori' => $autori];

    // var_dump($vysledek);

    $vysledek['prihlaseni'] = $prihlaseni;

    $et = EasyTemplate::new();
    echo $et->render('static/formular_delete_autor.html', $vysledek);