<?php

  session_start();
  header("Content-Type: text/json");

  $response = array(
    "voted" => NULL,
    "errors" => array()
  );
  $errors = array();

  //check if logged in
  if(!isset($_SESSION['username']))
    $errors = array(
      "field" => NULL,
      "message" => "nologin"
    );


  $response['errors'] = $errors;

  die(json_encode($response));
?>
