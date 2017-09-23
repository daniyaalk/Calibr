<?php
/*
  This file returns children of grades/subjects for contribute.php

  i.e, for a given grade, it will return all subjects and similarly, will return all chapters for a given subject and all topics for a chapter
*/
  require_once "classes/DB.php";
  $DB = new DB();

  header("Content-Type: text/json");

  if(isset($_GET['type']) && isset($_GET['of'])){
    $type = $_GET['type'];
    $of = $_GET['of'];

    /*
    Type 0: Get Subjects list for a grade
    Type 1: Get Chapters list for a subject
    */
    if($type == 0){
      $query = "SELECT id, name FROM subjects WHERE grade={$of}";
    }else if($type == 1){
      $query = "SELECT id, name FROM chapters WHERE subject={$of} ORDER BY number ASC";
    }else{
      $query = "SELECT id, name FROM topics WHERE chapter={$of} ORDER BY number ASC";
    }

    die(json_encode($DB->query($query)->fetch_all(MYSQLI_ASSOC)));
  }

?>
