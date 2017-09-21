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

  if(!isset($_GET['postid'])){
    $errors = array(
      "field" => NULL,
      "message" => "invalidID"
    );
  }else{
    $post_id = $_GET['postid'];
  }

  if(!isset($_GET['type'])){
    $errors = array(
      "field" => NULL,
      "message" => "invalidType"
    );
  }else{
    $type = $_GET['type'];
  }

  if(empty($errors)){

    $username = $_SESSION['username'];

    require_once 'classes/DB.php';
    $DB = new DB();

    require_once 'classes/UserInfo.php';
    $UserInfo = new UserInfo($username, $DB);

    //check if previous upvotes by user exist
    $check_vote_query = $DB->query("SELECT id, type FROM upvotes WHERE userid={$UserInfo->userId} AND postid={$post_id}");

    if($check_vote_query->num_rows != 0){
      //frame query to update choice
      if($check_vote_query->fetch_row()[1] == $type){
        $vote_query = "DELETE FROM upvotes WHERE postid={$post_id} AND userid={$UserInfo->userId}";
      }else{
        $vote_query = "UPDATE upvotes SET type={$type} WHERE postid={$post_id} AND userid={$UserInfo->userId}";
      }
    }else{
      //frame query to add vote
      $vote_query = "INSERT INTO upvotes VALUES(NULL, {$UserInfo->userId}, {$type}, {$post_id})";
    }
    //execute query
    $DB->query($vote_query);
    //add response
    $response['voted'] = TRUE;

    $newcount = $DB->query("SELECT SUM(type) FROM upvotes WHERE postid={$post_id}")->fetch_row()[0];

    $newcount = ($newcount == NULL)?0:$newcount;
    
    $response['newcount'] = $newcount;

  }

  $response['errors'] = $errors;

  die(json_encode($response));
?>
