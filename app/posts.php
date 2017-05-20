<?php

  require_once "DB.php";

  header("Content-Type: text/json");

  $return = array();

  $db = new DB();
  $getPosts = $db->query("SELECT * FROM posts");

  $return = ($getPosts->num_rows == 0) ? null : $getPosts->fetch_all();
  die(json_encode($return));

 ?>
