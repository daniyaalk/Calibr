<?php

  require_once "Mail.php";

  //USING GET VARIABLES FOR DEBUGGING. CHANGE TO POST PRIOR TO PRODUCTION
  $email = $_GET['email'];

  $response = array(
    "changed" => NULL,
    "errors" => array()
  );

  $errors = array();

  $Mail = new Mail();

  if(!$Mail->verifyEmail($email)) $errors[] = array(
    "field" => 1,
    "message" => "Email entered is invalid."
  );

  if(empty($errors)){
    //SEND VERIFICATION EMAIL
    //die(var_dump($Mail->sendMail($email, "Calibr Email Verification <verify@calibracademy.com>", "Email verification", "test"))); DEBUG CODE

    //TODO Everything here
  }else{
    $response["changed"] = FALSE;
  }

  $response["errors"] = $errors;
  echo "<pre>";
  print_r($response);




?>
