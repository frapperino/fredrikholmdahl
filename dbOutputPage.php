<?php  session_start(); ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>db error output</title>
  </head>
  <body>
    <div class="col-md-3"></div>
    <div class="col-md-6">
    <!-- This page is for outputing errors that occur from the use of the database -->
      <p> This is the error page for db related stuff.
        <?php
          echo safe($dbConnectMessage) . '<br>';
          echo safe($dbLoginMessage) . '<br>';
          echo safe($insertMessage) . '<br>';
          echo safe($showLinksMessage) . '<br>';
          echo safe($deleteMessage) . '<br>';
        ?>
      </p>
  </div>
  </body>
</html>
