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

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Hello!</title>
  </head>
  <body>
    <?php
      echo safe($dbConnectMessage) . '<br>';
      echo safe($dbfetchMessage) . '<br>';
      echo safe("Welcome " . $_SESSION['user'] . "! :D ") . '<br>' . '<br>';
      echo safe("session id: ") . session_id() . '<br>';
      echo safe("session status: ") . session_status() . ' (2 means if sessions are enabled, and one exists)' . '<br>';
      $cookieParam = session_get_cookie_params();
      echo safe("cookie params: ") . $cookieParam['lifetime'] . ' (0 means until browser closes)' . '<br>';
      echo safe("php version: ") . phpversion() . '<br>';
      echo safe("session variables: ") . print_r($_SESSION) . '<br>';
      echo printS();
    ?>
    <form method="post" action="/logout.php">
      <div class="input-group">
        <input type="hidden" name="action" value="logout">
        <button type="submit" class="btn btn-default modalLogin">Logout</button>
      </div>
    <form>
  </div>
  </body>
</html>
