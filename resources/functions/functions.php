<?php session_start();
//-----------------------------------------------------------------------
//Code for including magic quotes fix
include_once $_SERVER['DOCUMENT_ROOT'] . '/public/functions/magicquotes.php';

//-----------------------------------------------------------------------
//Code for making safe outputs less tedious
function safe($text){
  return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

function adminLoggedIn(){
  if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true)
  return true;
}

//temp function to test session variables
function printS(){
  $var = 'name: ' . $_SESSION['user'] . ' pw:' . $_SESSION['password'] . ' status: ' . $_SESSION['loggedIn'];
  return $var;
}

function registerUser(){
  global $pdo;
  try{
    $sql = 'INSERT INTO users SET name=:nameToRegister, dummyPW=:passwordToRegister';
    $s = $pdo->prepare($sql);
    $s->execute(array(
      ':nameToRegister' => safe($_POST['registerName']),
      ':passwordToRegister' => md5(safe($_POST['passwordOne']) . 'klop')
    ));
    $registerError = 'No errors creating new user: ' .  $_POST['registerName'];

    $_SESSION['loggedIn'] = true;
    $_SESSION['user'] = $_POST['registerName'];
    $_SESSION['password'] = md5(safe($_POST['passwordOne']) . 'klop');
    include $_SERVER['DOCUMENT_ROOT'] . '/index.php';
    exit();
  }
  catch (PDOException $e){
    $registerError = 'Error adding new user to database: ' . $e->getMessage();
    include $_SERVER['DOCUMENT_ROOT'] . '/public/templates/dbOutPutTP.php';
    exit();
  }
}
function loginUser(){
  global $pdo;
  try {

  }
  catch (Exception $e) {
    $loginError = 'Error logging in user: ' . $e->getMessage();
    include $_SERVER['DOCUMENT_ROOT'] . '/public/templates/dbOutPutTP.php';
    exit();
  }

}

?>
