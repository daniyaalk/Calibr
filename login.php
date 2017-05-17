<?php

  session_start();

  require_once "app/DB.php";

  $db = new DB;
  if(isset($_POST['submit'])){
    $entered = array(
      "username" => $_POST['username'],
      "password" => $_POST['password']
    );
    $errors = array();

    //Field checks
    if(empty($entered['username'])) $errors[] = array(1, "Please enter a username");
    if(empty($entered['password'])) $errors[] = array(2, "Please enter a password");

    $loginQuery = $db->query("SELECT * FROM users WHERE username = '".$entered['username']."'");

    if($loginQuery->num_rows == ) $errors[] = array(3, "Username and Password combination is invalid");

    $userInfo = $loginQuery->fetch_assoc();

    if(!password_verify($entered['password'], $userInfo['password'])) $errors[] = array(3, "Username and Password combination is invalid");


    if(empty($errors)) die("Yay!");
    else print_r($errors);
  }

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

  </body>
</html>
