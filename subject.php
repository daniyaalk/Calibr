<?php

  if(!isset($_GET['id'])) header("Location: index.php");

  require_once "app/DB.php";

  $db = new DB();
  $query = $db->query("SELECT s.id, s.name, s.grade, c.name, c.country, c.locale FROM subjects AS s, curriculums AS c WHERE s.id={$_GET['id']} AND c.id=s.curriculum");

  /*
  ~~DEBUGGING CODE``
  echo "<pre>";
  var_dump($query->fetch_row());
  echo "</pre>";
  */

  $subjectInformation = $query->fetch_row();

  $_title =  $subjectInformation[1]." ". $subjectInformation[2] ." | ".$subjectInformation[3].", ".$subjectInformation[4];


  require_once "header.php";
 ?>
