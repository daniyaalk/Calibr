<?php

  require_once "DB.php";

  header("Content-Type: text/json");

  $return = array();
  $query_conditions = array();
  $required_fields_array = array();

  $db = new DB();

  $query_suffixes[] = "1";
  if(isset($_GET['user'])) $query_suffixes[] = "userid={$_GET['user']}";

  //Change userid|title to array("userid", "title") to userid, title
  if(isset($_GET['fields'])) $required_fields_array = explode("|", $_GET['fields']);
  if(empty($required_fields_array)) $required_fields = "*";
  else $required_fields = implode(", ", $required_fields_array);

  $query_conditions = implode($query_suffixes, " AND ");

  $query = "SELECT ".$required_fields." FROM posts WHERE ".$query_conditions;

  $getPosts = $db->query($query);

  $return = ($getPosts->num_rows == 0) ? null : $getPosts->fetch_all(MYSQLI_ASSOC);
  die(json_encode($return));

 ?>
