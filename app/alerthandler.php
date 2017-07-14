<?php

  session_start();
  header("Content-Type: text/json");

  if(isset($_GET['request'])) $request = $_GET['request'];
  else $request = NULL;

  $response = array();
  if(!isset($_SESSION['alerts'])) $_SESSION['alerts'] = array();

  /*
  ALERT HANDLER REQUEST TYPES:
  1: Display all alerts(default)
  2: Add an alert
  */

  switch($request){
    case 1:
    default:
      $response = $_SESSION['alerts'];
      unset($_SESSION['alerts']);
      break;
    case 2:
      $_SESSION['alerts'][] = array(
        'message' => $_GET['message'],
        'type' => $_GET['type']
      );

      break;
  }

  echo json_encode($response);
?>
