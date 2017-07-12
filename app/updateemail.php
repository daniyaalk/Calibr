<?php

  session_start();
  header("Content-Type: text/json");

  require_once "Mail.php";
  $Mail = new Mail();

  require_once "Validation.php";
  $Validation = new Validation();

  require_once "DB.php";
  $DB = new DB();

  require_once "userInfo.php";
  $UserInfo = new UserInfo($_SESSION['username'], $DB);

  //USING GET VARIABLES FOR DEBUGGING. CHANGE TO POST PRIOR TO PRODUCTION
  $email = $_GET['email'];

  $response = array(
    "changed" => NULL,
    "errors" => array()
  );
  $errors = array();

  if(!$Validation->verifyEmail($email)) $errors[] = array(
    "field" => "email",
    "message" => "Email entered is invalid."
  );

  if(empty($errors)){
    //SEND VERIFICATION EMAIL
    //die(var_dump($Mail->sendMail($email, "Calibr Email Verification <verify@calibracademy.com>", "Email verification", "test"))); DEBUG CODE

    //TODO Everything here
    $num = rand();
    $hash = md5($num);
    $link = "http://localhost/EdProj/Calibr/"."verify.php?key=".$hash;

    $DB->query("INSERT INTO verification VALUES(NULL, '{$UserInfo->userId}', '{$hash}')");
    $DB->query("UPDATE profiles SET email_verified=1, email='{$email}' WHERE userid='{$UserInfo->userId}'");
    $Mail->sendMail(
      $email,
      "Calibr Email Verification <verify@calibracademy.com>",
      "Please Verify your Email Address",
      "
        Thank you for adding your email to Calibr! <a href='{$link}'>Click here</a> to verify your email.

        <p>
          If you haven't added your Email to Calibr or think this email was not addressed to you, please ignore it.
        </p>
      ",
      array('Email Verification')
    );

    $response["changed"] = TRUE;
  }else{
    $response["changed"] = FALSE;
  }

  $response["errors"] = $errors;
  print_r(json_encode($response));




?>
