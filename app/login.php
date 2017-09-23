<?php
  session_start();
  header("Content-Type: text/json");

  require_once "classes/DB.php";

  $response = array(
    "auth" => null,
    "errors" => array()
);

  $db = new DB;

  $entered = array(
    "password" => trim(@$_POST['password']),
    "username" => trim(@$_POST['username'])
  );
  $errors = array();

  //Field checks
  if(empty($entered['username'])) $errors[] = array(
    "field" => 1,
    "message" => "Please enter a username"
  );
  if(empty($entered['password'])) $errors[] = array(
    "field" => 2,
    "message" => "Please enter a password"
  );

  $loginQuery = $db->query("SELECT * FROM users WHERE username LIKE '".$entered['username']."'");
  //using LIKE instead of = to make usernames case insensitive

  $userInfo = $loginQuery->fetch_assoc();

  //verify if username exists, if it does, check password
  if($loginQuery->num_rows == 0) $errors[] = array(
    "field" => 3,
    "message" => "Username and Password combination is invalid"
  );
  else if(!password_verify($entered['password'], $userInfo['password'])) $errors[] = array(
    "field" => 3,
    "message" => "Username and Password combination is invalid"
  );

  if(empty($errors)){
    $response['auth'] = TRUE;
    $_SESSION['username'] = $userInfo['username'];
  }
  else {
    $response['auth'] = FALSE;
    $response['errors'] = $errors;
  }
  die(json_encode($response));

?>
