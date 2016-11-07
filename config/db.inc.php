<?php
//-----------------------------------------------------------------------
//Code for including magic quotes fix
include_once $_SERVER['DOCUMENT_ROOT'] . '/resources/templates/magicquotes.php';

//-----------------------------------------------------------------------
//Code for connecting to the database.
try{
  //$pdo is the database object created here
  //Use silver right now to test to get values from user table
  $pdo = new PDO('mysql:host=localhost;dbname=fredrikholmdahl', 'fredrikholmdahl', 'comviq91');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $pdo->exec('SET NAMES "utf8"');
  $dbConnectMessage = 'Database connection established.'; //message when connected, remove later
}
catch (PDOException $e)
{
  //If unable to connect to database, show dbConnect.php page with message
  $dbConnectMessage = 'Unable to connect to the database server: ' . $e->getMessage();

  exit();
}
