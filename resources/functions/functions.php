<?php session_start();

//-----------------------------------------------------------------------
//Code for making safe outputs less tedious
function safe($text){
  return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

//Used for keeping the user logged in if still in session
function adminLoggedIn(){
  if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true && $_SESSION['userRole'] == 1){
    return true;
  }
}

//move this to the login.php file?
function loginUser(){
  global $pdo;
  try {
    $uName = safe($_POST['loginName']);
    //$temp = safe($_POST['loginPassword']);
    $pwCheck = safe(md5($_POST['loginName'] . strrev($_POST['loginPassword']) . $_POST['loginPassword'] . strrev($_POST['loginName'])));
    $sql = 'SELECT id, name, password, role FROM users';
    $result = $pdo->query($sql);
    foreach($result as $row){
      if(($row['name'] == $uName) && ($row['password'] == $pwCheck) ){
        $dbLoginMessage = 'Login successful.';
        $_SESSION['loggedIn'] = true;
        $_SESSION['userRole'] = $row['role'];
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
        <div>
          <a href="<?php echo $row['url'] ?>"><?php echo $row['name']?></a>
          <form method="post" action="/deleteLink.php">
            <input type="hidden" name="linkToDelete" value="<?php echo $row['name'];?>">
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

function deleteLink(){
  global $pdo;
  try{
    $sql = 'DELETE FROM links WHERE name=:linkToDelete';
    $s = $pdo->prepare($sql);
    $s->execute(array(
      ':linkToDelete' => safe($_POST['linkToDelete'])
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

function registerNewUser(){
  global $pdo;
  if(isset($_POST['admin'])){
    $adminStatus = 1;
  }else{
    $adminStatus = 2; //for other users?
  }
  $pw = safe(md5($_POST['userName'] . strrev($_POST['passwordOne']) . $_POST['passwordOne'] . strrev($_POST['userName'])));
  try{
    $sql = 'INSERT INTO users (name, role, password) VALUES (:userName, :role, :password)';
    $s = $pdo->prepare($sql);
    $s->execute(array(
      ':userName' => safe($_POST['userName']),
      ':role' => safe($adminStatus),
      ':password' => safe($pw)
    ));
    $registerNewUserMessage = 'No errors creating new user: ' .  $_POST['userName'];
    header('Location: /admin/indexadmin.php');
    exit();
  }
  catch (PDOException $e){
    $registerNewUserMessage = 'Error adding new user to database: ' . $e->getMessage();
    include $_SERVER['DOCUMENT_ROOT'] . '/dbOutputPage.php';
    exit();
  }
}
?>
