<?php

    require __DIR__.'/vendor/autoload.php';
    use PhpPkg\EasyTpl\EasyTemplate;

    require_once 'db.php';

    session_start();

    $error_msg = array_key_exists('error_msg', $_SESSION) ? $_SESSION['error_msg'] : "";
    $_SESSION['error_msg'] = "";


    $vyhledat_nazev = (array_key_exists('nazev', $_GET) ? $_GET['nazev'] : "");
    $vyhledat_zanr = (array_key_exists('zanr', $_GET) ? $_GET['zanr'] : "");

    $query_params = [];
    if ($vyhledat_nazev != "") {
        $query_params[':knizka_filter'] = '%'.$vyhledat_nazev.'%';
        if ($vyhledat_zanr != "") {
            $query_params[':zanr_filter'] = $vyhledat_zanr;
            $sql_filter = 'WHERE knizky.knizka LIKE :knizka_filter AND knizky.zanr = :zanr_filter';
        } else {
            $sql_filter = 'WHERE knizky.knizka LIKE :knizka_filter';
        }
    } else {
        if ($vyhledat_zanr != "") {
            $query_params[':zanr_filter'] = $vyhledat_zanr;
            $sql_filter = 'WHERE knizky.zanr = :zanr_filter';

        } else {
            $sql_filter = '';
        }
    }

    $query = $db->prepare('SELECT knizky.id AS id, autori.jmeno AS autor, knizky.knizka AS knizka, zanry.nazev AS zanr FROM `knizky` JOIN `zanry` ON knizky.zanr = zanry.id JOIN `autori` ON knizky.autor = autori.id '.$sql_filter);
    $query->execute($query_params);
    $knizky = $query->fetchAll(PDO::FETCH_ASSOC);

    $query_zanry = $db->prepare('SELECT * FROM zanry');
    $query_zanry->execute();
    $zanry = $query_zanry->fetchAll(PDO::FETCH_ASSOC);

    $vysledek = ['knizky' => $knizky, 'zanry' => $zanry];

    $vysledek['prihlaseni'] = ['id' => (array_key_exists('prihlaseny_uzivatel_id', $_SESSION) ? $_SESSION['prihlaseny_uzivatel_id'] : 0), 'email' => (array_key_exists('prihlaseny_uzivatel_email', $_SESSION) ? $_SESSION['prihlaseny_uzivatel_email'] : "")];
    $vysledek['error_msg'] = $error_msg;

    $et = EasyTemplate::new();
    echo $et->render('static/tabulka_knizek.html', $vysledek);

