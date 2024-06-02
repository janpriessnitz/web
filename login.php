<?php
  //načteme připojení k databázi a inicializujeme session
  require_once 'inc/user.php';

  if (!empty($_SESSION['user_id'])){
    //uživatel už je přihlášený, nemá smysl, aby se přihlašoval znovu
    header('Location: index.php');
    exit();
  }

  $errors=false;
  if (!empty($_POST)){
    #region zpracování formuláře
    $userQuery=$db->prepare('SELECT * FROM users WHERE email=:email LIMIT 1;');
    $userQuery->execute([
      ':email'=>trim($_POST['email'])
    ]);
    if ($user=$userQuery->fetch(PDO::FETCH_ASSOC)){

      if (password_verify($_POST['password'],$user['password'])){
        //heslo je platné => přihlásíme uživatele
        $_SESSION['user_id']=$user['user_id'];
        $_SESSION['user_name']=$user['name'];
        header('Location: index.php');
        exit();
      }else{
        $errors=true;
      }

    }else{
      $errors=true;
    }
    #endregion zpracování formuláře
  }

  //vložíme do stránek patičku
  $pageTitle='Přihlášení uživatele';
  include 'inc/header.php';
