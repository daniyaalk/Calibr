<?php

  header("Content-Type: text/json");

  require_once "DB.php";
  $DB = new DB();

  session_start();
  //USING GET VARIABLES FOR DEVELOPMENT, WILL CHANGE TO POST LATER
  $current_password = @$_POST['password'];
  $new_password = @$_POST['new'];
  $repeat_password = @$_POST['repeat'];

  $response = array(
    "changed" => NULL,
    "messages" => array()
  );
  $errors = array();

  if(!isset($_SESSION['username'])) $errors[] = array(
    "field" => "top",
    "message" => "You aren't logged in, please login again."
  );

  if(empty($errors)){

    if(empty($current_password)) $errors[] = array(
      "field" => "current",
      "message" => "This field cannot be empty"
    );

    if(empty($new_password)) $errors[] = array(
      "field" => "new",
      "message" => "This field cannot be empty"
    );

    if(empty($repeat_password)) $errors[] = array(
      "field" => "repeat",
      "message" => "This field cannot be empty"
    );

    if($repeat_password != $new_password) $errors[] = array(
      "field" => "repeat",
      "message" => "Repeat password does not match new password"
    );

    $db_password = $DB->query("SELECT password FROM users WHERE username='{$_SESSION['username']}'")->fetch_row()[0];

    if(!password_verify($current_password, $db_password)) $errors[] = array(
      "field" => "current",
      "message" => "Incorrect password!"
    );

    if(strlen($new_password) <= 5) $errors[] = array(
      "field" => "new",
      "message" => "Password must be longer than 5 characters"
    );

    if(empty($errors)){
      $DB->query("UPDATE users SET password='".password_hash($new_password, PASSWORD_BCRYPT)."' WHERE username='{$_SESSION['username']}'");
      $response['changed'] = TRUE;
    }
  }

  if(!empty($errors)){
    $response['changed'] = FALSE;
  }
  $response['messages'] = $errors;
  echo json_encode($response);

?>
