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
    <title>Admin page</title>
    <link rel="shortcut icon" href="/resources/img/testlogo.jpg"/>

		<!--Quicksand font family link did not work when index file was put in own directory so
		the code was added to stylesheet.css instead.
		<link rel="stylesheet" type="text/css" href="fonts.googleapis.com/css?family=Quicksand" />-->

    <link type="text/css" rel="stylesheet" href="/resources/css/font-awesome.css"/>
    <link type="text/css" rel="stylesheet" href="/resources/css/stylesheet.css"/>
    <link type="text/css" rel="stylesheet" href="/resources/css/bootstrap-theme.min.css"/>
    <link type="text/css" rel="stylesheet" href="/resources/css/bootstrap.min.css"/>

    <link type="text/css" rel="stylesheet" href="/resources/css/paceTheme1.css"/>
    <script src="/resources/js/pace.js"></script>

    <script src="/resources/js/jquery-1.11.2.js"></script> <!-- use jquery.min.js later -->
    <script src="/resources/js/bootstrap.js"></script>
    <script src="/resources/js/custom.js"></script>
  </head>
  <body>


    <div class="col-md-4">
      <?php
        echo safe($dbConnectMessage) . '<br>';
        echo safe($dbfetchMessage) . '<br>';
        echo safe("Welcome " . $_SESSION['user'] . "! :D ") . '<br>' . '<br>';
        echo safe("session id: ") . session_id() . '<br>';
        echo safe("session status: ") . session_status() . ' (2 means if sessions are enabled, and one exists)' . '<br>';
        $cookieParam = session_get_cookie_params();
        echo safe("cookie params: ") . $cookieParam['lifetime'] . ' (0 means until browser closes)' . '<br>';
        echo safe("php version: ") . phpversion() . '<br>';
        echo safe( "The session information: ") . '<br>';
        echo print_r($_SESSION) . '<br>';
      ?><br>
      <a href="/logout.php">Logout</a>
    </div>

    <div class="col-md-4">
      <h1 id="time">!Time script not working if this is showing!</h1>
      <h3 id="todaysDate">!Date script not working if this is showing!</h3>
    </div>

    <div class="col-md-4">
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addLink">
        Add new
      </button>
      <br><br>
      <?php showLinks(); ?>
    </div>
    <!-- MODAL CODE FOR ADDING LINKS-->
    <div id="addLink" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Add a link</h4>
          </div>
          <div class="modal-body">
            <form method="post" action="/insertLink.php">
              <div class="input-group">
                <p>Add a name for the link</p>
                <input id="insertId" type="text" class="form-control" placeholder="Name" name="linkName">
                <p>Add the url</p>
                <input type="text" class="form-control" placeholder="url" name="linkUrl">
                <input type="hidden" name="action" value="insertLink">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add</button>
              </div>
            <form>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
