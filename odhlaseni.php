<?php
    require __DIR__.'/vendor/autoload.php';
    use PhpPkg\EasyTpl\EasyTemplate;

    require_once 'db.php';

    session_start();
    session_destroy();

    header("Location: index.php");
    die();
    // $et = EasyTemplate::new();