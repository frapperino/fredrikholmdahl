<?php  session_start();
  //-----------------------------------------------------------------------
  //Code for including magic quotes fix
  include_once $_SERVER['DOCUMENT_ROOT'] . '/resources/functions/magicquotes.php';

  //-----------------------------------------------------------------------
  //Code for connecting to the database using the db.inc.php file. Shall be the top thing in the controller.
  require_once $_SERVER['DOCUMENT_ROOT'] . '/config/db.inc.php';

  //-----------------------------------------------------------------------
  //including functions
  include_once $_SERVER['DOCUMENT_ROOT'] . '/resources/functions/functions.php';

  //Checks if admin is logged in. Make this more robust for different kinds of users later?
  if (adminLoggedIn()){
    header('Location: /admin/indexadmin.php');
    //include $_SERVER['DOCUMENT_ROOT'] . '/admin/indexadmin.php';
    exit();
  }else{
    header('Location: /public/indexpublic.php');
    //include $_SERVER['DOCUMENT_ROOT'] . '/admin/indexadmin.php';
    exit();
  }


?>
