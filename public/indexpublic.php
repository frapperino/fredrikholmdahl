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
  }

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Page Login</title>
    <link rel="shortcut icon" href="/resources/img/testlogo.jpg"/>

		<!--Quicksand font family link did not work when index file was put in own directory so
		the code was added to stylesheet.css instead.
		<link rel="stylesheet" type="text/css" href="fonts.googleapis.com/css?family=Quicksand" />-->

    <link type="text/css" rel="stylesheet" href="/resources/css/font-awesome.css"/>
    <link type="text/css" rel="stylesheet" href="/resources/css/stylesheet.css"/>
    <link type="text/css" rel="stylesheet" href="/resources/css/bootstrap-theme.min.css"/>
    <link type="text/css" rel="stylesheet" href="/resources/css/bootstrap.min.css"/>

    <script src="/resources/js/jquery-1.11.2.js"></script> <!-- use jquery.min.js later -->
    <script src="/resources/js/bootstrap.js"></script>
    <script src="/resources/js/custom.js"></script>
  </head>
  <body>
    <form method="post" action="/login.php">
      <div class="input-group">
        <?php
          echo safe($dbConnectMessage) . '<br>';
          echo "The session information: " . '<br>';
          echo print_r($_SESSION) . '<br>';
        ?>
        <input type="text" class="form-control" placeholder="Username" name="loginName" autofocus="true" aria-describedby="basic-addon1">
        <input type="password" class="form-control" placeholder="Password" name="loginPassword" aria-describedby="basic-addon1">
        <input type="hidden" name="action" value="login">
        <button type="submit" class="btn btn-default">Login</button>
      </div>
    <form>
  </body>
</html>
