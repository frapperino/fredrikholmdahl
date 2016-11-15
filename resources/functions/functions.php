<?php session_start();

//-----------------------------------------------------------------------
//Code for making safe outputs less tedious
function safe($text){
  return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

//Used for keeping the user logged in if still in session
function adminLoggedIn(){
  if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true){
    return true;
  }
}

//move this to the login.php file?
function loginUser(){
  global $pdo;
  $uName = safe($_POST['loginName']);
  $uPassword = safe($_POST['loginPassword']);
  try {
    $reverseUserName = strrev($uName);
    //använd $pwCheck sen, och spara på samma sätt i databasen också
    $pwCheck = $uName . md5(safe($uPassword)) . $reverseUserName;
    $sql = 'SELECT id, name, password FROM users';
    $result = $pdo->query($sql);
    foreach($result as $row){
      if(($row['name'] == $uName) && ($row['password'] == $uPassword) ){
        $dbLoginMessage = 'Login successful.';
        $_SESSION['loggedIn'] = true;
        $_SESSION['userId'] = $row['id'];
        $_SESSION['user'] = $row['name'];
        header('Location: /admin/indexadmin.php');
        //include $_SERVER['DOCUMENT_ROOT'] . '/admin/indexadmin.php';
        unset($_POST); //so session id does not update on refresh
        exit();
      }
    }
    header('Location: /public/indexpublic.php');
    exit();
  }
  catch (Exception $e) {
    $dbLoginMessage = 'Login error!.' . $e->getMessage();
    include $_SERVER['DOCUMENT_ROOT'] . '/dbOutputPage.php';
    exit();
  }
}

//move this to the logout.php file?
function logoutUser(){
  session_destroy();
  header('Location: index.php'); //using header shows index.php in the url
  //include $_SERVER['DOCUMENT_ROOT'] . '/index.php';
  exit();
}

function insertLink(){
  global $pdo;
  try{
    $sql = 'INSERT INTO links (userId, name, url) VALUES (:uId, :linkName, :linkUrl)';
    $s = $pdo->prepare($sql);
    $s->execute(array(
      ':uId' => safe($_SESSION['userId']),
      ':linkName' => safe($_POST['linkName']),
      ':linkUrl' => safe($_POST['linkUrl'])
    ));
    $insertMessage = 'No errors inserting new link: ' .  $_POST['linkName'];
    header('Location: /admin/indexadmin.php');
    exit();
  }
  catch (PDOException $e){
    $insertMessage = 'Error adding new link to database: ' . $e->getMessage();
    include $_SERVER['DOCUMENT_ROOT'] . '/dbOutputPage.php';
    exit();
  }
}

function showLinks(){
  global $pdo;
  try{
    $sql = 'SELECT * FROM links';
    $result = $pdo->query($sql);
    foreach ($result as $row) {
      if ($row['userId'] == $_SESSION['userId']){
        ?>
        <div id="<?php $row['name'] ?>">
          <a href="<?php echo $row['url'] ?>"> <?php echo $row['name'] ?></a>
          <form class="linkToDelete" action="/deleteLink.php" method="post">
            <input type="hidden" name="linkToDelete" value="<?php echo safe($row['name']);?>">
            <button type="submit" class="btn btn-default">Delete</button>
          </form>
          <br>
        </div>
        <?php
      }
    }
    $showLinksMessage = 'No errors finding links';
  }
  catch (PDOException $e){
    $insertMessage = 'Error searching for links in database: ' . $e->getMessage();
    include $_SERVER['DOCUMENT_ROOT'] . '/dbOutputPage.php';
    exit();
  }
}

function deleteLink($id){
  global $pdo;
  try{
    $sql = 'DELETE FROM links WHERE name=:linkName';
    $s = $pdo->prepare($sql);
    $s->execute(array(
      ':linkName' => safe($id)
    ));
    $deleteMessage = 'No errors deleting link';
    header('Location: /admin/indexadmin.php');
    exit();
  }
  catch (PDOException $e){
    $deleteMessage = 'Error deleting link from database: ' . $e->getMessage();
    include $_SERVER['DOCUMENT_ROOT'] . '/dbOutputPage.php';
    exit();
  }
}
?>
