<?php
    require __DIR__.'/vendor/autoload.php';
    use PhpPkg\EasyTpl\EasyTemplate;

    require_once 'db.php';

    if(!empty($_POST['stitek_text'])){
        $novy_stitek = trim(htmlspecialchars($_POST['stitek_text']));
    }
    else{

    }

    $et = EasyTemplate::new();
    echo $et->render('static/formular_nova_knizka_overeni.html', $vysledek);