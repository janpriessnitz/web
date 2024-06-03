<?php
    require __DIR__.'/vendor/autoload.php';
    use PhpPkg\EasyTpl\EasyTemplate;

    require_once 'db.php';

    session_start();

    if(!empty($_POST['autor_text'])){
        try {
        $query_autor = $db->prepare('INSERT INTO autori(jmeno) VALUES (:autor)');
        $query_autor->execute([':autor'=> htmlspecialchars($_POST['autor_text'])]);
        $autor_id = $db->lastInsertId();
        $autor_text = htmlspecialchars($_POST['autor_text']);
        } catch (PDOException $e) {
            $_SESSION['error_msg'] = 'Nepodařilo se vložit nového autora.';
            header('Location: index.php');
            die();
        }
    }
    else{
        $autor_id = $_POST['autor_id'];
        $query_autor_select = $db->prepare('SELECT jmeno FROM autori WHERE :autor_id = autori.id');
        $query_autor_select->execute([':autor_id' => $autor_id]);
        $autor_text = $query_autor_select->fetchAll(PDO::FETCH_ASSOC)[0]['jmeno'];
    }

    if(!empty($_POST['zanr_text'])){
        try {
        $query_zanr = $db->prepare('INSERT INTO zanry(nazev) VALUES (:zanr)');
        $query_zanr->execute([':zanr'=> htmlspecialchars($_POST['zanr_text'])]);
        $zanr_id = $db->lastInsertId();
        $zanr_text = htmlspecialchars($_POST['zanr_text']);
        } catch (PDOException $e) {
            $_SESSION['error_msg'] = 'Nepodařilo se vložit nový žánr.';
            header('Location: index.php');
            die();
        }
    }
    else{
        $zanr_id = $_POST['zanr_id'];
        $query_zanr_select = $db->prepare('SELECT nazev FROM zanry WHERE :zanr_id = zanry.id');
        $query_zanr_select->execute([':zanr_id' => $zanr_id]);
        $zanr_text = $query_zanr_select->fetchAll(PDO::FETCH_ASSOC)[0]['nazev'];
    }

    try {
    $query = $db->prepare('INSERT INTO knizky(knizka, autor, zanr) VALUES (:knizka, :autor, :zanr)');
    $query->execute([':knizka' => htmlspecialchars($_POST['knizka_text']), ':autor' => $autor_id, ':zanr' => $zanr_id]);
    }catch (PDOException $e) {
        $_SESSION['error_msg'] = 'Nepodařilo se vložit novou knihu.';
        header('Location: index.php');
        die();
    }

    $vysledek = ['knizka' => htmlspecialchars($_POST['knizka_text']), 'autor' => $autor_text, 'zanr' => $zanr_text];

    $vysledek['prihlaseni'] = ['id' => (array_key_exists('prihlaseny_uzivatel_id', $_SESSION) ? $_SESSION['prihlaseny_uzivatel_id'] : 0), 'email' => (array_key_exists('prihlaseny_uzivatel_email', $_SESSION) ? $_SESSION['prihlaseny_uzivatel_email'] : "")];

    $et = EasyTemplate::new();
    echo $et->render('static/formular_nova_knizka_overeni.html', $vysledek);