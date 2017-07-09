<?php

  require_once "header.php";
  require_once "app/DB.php";
  require_once "app/userInfo.php";

  $db = new DB();
  $UserInfo = new UserInfo($_SESSION['username'], $db);

  //check if profile exists
  if($UserInfo->checkProfileExists()){

    $profile = $UserInfo->getProfile("name|grade|score");
    ?>

      <div class="container">
        <div class="page-header">
          <h1><?php echo $profile[0]; ?> <small><?php echo "Grade ".$profile[1]; ?></small></h1>
        </div>
      </div>

    <?php
  }
  else{
    ?>

      <div class="container container-10-margin">
        <div class="alert alert-danger" role="alert">Looks like you haven't setup your profile yet! <a href="#" class="alert-link">Click here to get started.</a></div>
      </div>

    <?php
  }
?>
