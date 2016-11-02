

<?php  session_start(); ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Hello!</title>
  </head>
  <body>
    <?php
      echo safe($dbConnectError) . '<br>';
      echo safe("hej");
    ?>

  </div>
  </body>
</html>
