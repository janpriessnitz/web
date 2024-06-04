<?php
    require __DIR__.'/vendor/autoload.php';
    use PhpPkg\EasyTpl\EasyTemplate;

    require_once 'db.php';

    session_start();
    $prihlaseni = ['id' => (array_key_exists('prihlaseny_uzivatel_id', $_SESSION) ? $_SESSION['prihlaseny_uzivatel_id'] : 0), 'email' => (array_key_exists('prihlaseny_uzivatel_email', $_SESSION) ? $_SESSION['prihlaseny_uzivatel_email'] : "")];

    if(!empty($_POST['stitek_text'])){
        $novy_stitek = trim(htmlspecialchars($_POST['stitek_text']));
        $query = $db->prepare('INSERT INTO stitky(nazev, id_vlastnik) VALUES (:stitek_text, :vlastnik_id)');
        $query->execute([':stitek_text' => $_POST['stitek_text'], ':vlastnik_id' => $prihlaseni['id']]);
        $stitek_id = $db->lastInsertId();
        $stitek_text = $novy_stitek;
    }
    else{
        $query = $db->prepare('SELECT stitky.nazev FROM stitky WHERE :stitek_id = stitky.id');
        $query->execute(['stitek_id'=>$_POST['stitek_id']]);
        $stitek_text = $query->fetchAll(PDO::FETCH_ASSOC)[0]['nazev'];
        $stitek_id = $_POST['stitek_id'];
    }

    $query = $db->prepare('INSERT INTO knizky_stitky(knizka, stitek) VALUES(:knizka_id, :stitek_id)');
    $query->execute([':knizka_id'=>$_POST['knizka_id'], ':stitek_id'=>$stitek_id]);

    $query_knizka = $db->prepare('SELECT knizky.knizka FROM knizky WHERE :knizka_id = knizky.id');
    $query_knizka->execute([':knizka_id' => htmlspecialchars($_POST['knizka_id'])]);

    $knizka = $query_knizka->fetchAll(PDO::FETCH_ASSOC)[0];

    $vysledek = ['knizka' => $knizka, 'stitek' => $stitek_text];
    $vysledek['prihlaseni'] = $prihlaseni;

    $et = EasyTemplate::new();
    echo $et->render('static/formular_pridat_stitek_overeni.html', $vysledek);