<?php
  session_start();
  require_once("DB.php");

  header("Content-Type: text/json");

  $response = array(
    "registered" => null,
    "errors" => array()
  );

  /*Debugging with inputs as GET variables, will change to POST later */
  $entered = array(
    "username" => trim(@$_POST['username']),
    "password" => trim(@$_POST['password']),
    "repeatPassword" => trim(@$_POST['repeatPassword'])
  );

  $errors = array();

  //Field checks
  if(empty($entered['username'])) $errors[] = array(
    "field" => 1,
    "message" => "Username cannot be empty"
  );
  else if(!ctype_alnum($entered['username'])) $errors[] = array(
    "field" => 1,
    "message" => "Username must be alphanumeric only"
  );

  if(empty($entered['password'])) $errors[] = array(
    "field" => 2,
    "message" => "Password cannot be empty"
  );
  else if(strlen($entered['password']) <= 5) $errors[] = array(
    "field" => 2,
    "message" => "Password must be longer than 5 characters"
  );

  if(empty($entered['repeatPassword'])) $errors[] = array(
    "field" => 4,
    "message" => "Please repeat your password again"
  );else if($entered['repeatPassword']!=$entered['password']) $errors[] = array(
    "field" => 4,
    "message" => "Repeat password does not match password"
  );

  //DB checks
  if(empty($errors)){

    $db = new DB();

    //check if username exists
    $userCheck = $db->query("SELECT id FROM users WHERE username='{$entered['username']}'");
    if($userCheck->num_rows != 0) $errors[] = array(
      "field" => 1,
      "message" => "Username already exists, perhaps you're trying to login?"
    );

  }

  //generate response
  if(empty($errors)){
    $response["registered"] = true;
    //register the user here
    $db->query("INSERT INTO users VALUES(NULL, '{$entered['username']}', '".password_hash($entered['password'], PASSWORD_BCRYPT)."', '', 0, '{$_SERVER['REMOTE_ADDR']}')");
    $_SESSION['username'] = $entered['username'];
  }else{
    $response["registered"] = false;
    $response["errors"] = $errors;
  }

  echo json_encode($response);
?>
