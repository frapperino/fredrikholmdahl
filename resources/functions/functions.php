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

//temp function to test session variables
function printS(){
  $var = 'session user: ' . $_SESSION['user'] . ', scrambled pw:' . $_SESSION['password'] . ', status: ' . $_SESSION['loggedIn'];
  return $var;
}

//move this to the login.php file?
function loginUser(){
  global $pdo;
  $uName = safe(strtolower($_POST['loginName'])); //stores search input into variable and makes it lowercase
  $uPassword = safe($_POST['loginPassword']); //stores search input into variable and makes it lowercase
  try {
    $sql = 'SELECT name, password FROM users';
    $result = $pdo->query($sql);
    foreach($result as $row)
    {
      $names[] = $row['name'];
      $passwords[] = $row['password'];
    }
    foreach ($names as $singleName){
      if($uName == strtolower($singleName)){
        foreach($passwords as $singlePassword){
          if($uPassword === $singlePassword){
            $dbLoginMessage = 'Login successful.';
            $_SESSION['loggedIn'] = true;
            $_SESSION['user'] = $_POST['loginName'];
            $_SESSION['password'] = md5(safe($_POST['loginPassword']) . 'klop');
            header('Location: /admin/indexadmin.php');
            //include $_SERVER['DOCUMENT_ROOT'] . '/admin/indexadmin.php';
            unset($_POST); //so session id does not update on refresh
            exit();
          }
          else{
            header('Location: index.php');
            exit();
          }
        }
      }
      else{
        header('Location: index.php');
        exit();
      }
    }
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
  header('Location: /index.php'); //using header shows index.php in the url
  //include $_SERVER['DOCUMENT_ROOT'] . '/index.php';
  exit();
}
?>
