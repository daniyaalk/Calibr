<?php

  require_once "app/DB.php";
  $DB = new DB();

  if(isset($_GET['key'])){

    $key = $_GET['key'];

    $query = $DB->query("SELECT id FROM verification WHERE hash='{$key}'");

    if($query->num_rows == 0){
      die("Your link is invalid!");
    }

    $query = $DB->query("UPDATE profiles
      SET email_verified=2
      WHERE userid=(SELECT userid
        FROM verification
        WHERE hash='{$key}'
      )");

      header("Location: settings.php?active=email");

  }

?>