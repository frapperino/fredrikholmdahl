<?php session_start();
  //-----------------------------------------------------------------------
  //Code for including magic quotes fix
  include_once $_SERVER['DOCUMENT_ROOT'] . '/resources/functions/magicquotes.php';

  //-----------------------------------------------------------------------
  //Code for connecting to the database using the db.inc.php file. Shall be the top thing in the controller.
  require_once $_SERVER['DOCUMENT_ROOT'] . '/config/db.inc.php';

  //-----------------------------------------------------------------------
  //including functions
  include_once $_SERVER['DOCUMENT_ROOT'] . '/resources/functions/functions.php';

  if( isset($_POST['action']) && ($_POST['action'] == 'registerNewUser') && ($_POST['userName'] != "") && ($_POST['passwordOne'] != "")){
    //check for password validity
    registerNewUser();
  }else {
    if (adminLoggedIn()){
      header('Location: /admin/indexadmin.php');
      exit();
    }else{
      logout();
    }
  }

?>
