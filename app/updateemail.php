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

  $email = $_POST['email'];

  $response = array(
    "changed" => NULL,
    "errors" => array()
  );
  $errors = array();

  if(!$Validation->verifyEmail($email)) $errors[] = array(
    "field" => "email",
    "message" => "Email entered is invalid."
  );

  $check_conflict = $DB->query("SELECT id, email_verified FROM profiles WHERE email='{$email}' AND userid!={$UserInfo->userId}");
  //if another user exists with the same email, check if the email is Verified
  //if verified, throw error asking the user to either recover the password to their account
  //if not verified, go through with the email update and remove the other user's email
  if($check_conflict->num_rows!=0){
    if($check_conflict->fetch_row()[1] == 1){
      //if email associated with other account is verified:
      $errors[] = array(
        "field" => "email",
        "message" => "Email is already associated with another account. If you've forgotten the password to that account, you may recover it through the forgot password page; or you may user another email address."
      );
    }else{
      //if email is unverified, remove email from the other account and continue with email association
      $DB->query("UPDATE profiles SET email='', email_verified=0 WHERE email='{$email}'");
    }
  }

  if(empty($errors)){
    //SEND VERIFICATION EMAIL
    //die(var_dump($Mail->sendMail($email, "Calibr Email Verification <verify@calibracademy.com>", "Email verification", "test"))); DEBUG CODE

    //TODO Everything here
    $num = rand();
    $hash = md5($num);
    $link = "http://localhost/EdProj/Calibr/"."verify.php?key=".$hash;

    //check if user row exists for current user in `profiles` table
    $check_profile_exists = $DB->query("SELECT id FROM profiles WHERE userid={$UserInfo->userId}");

    if($check_profile_exists->num_rows == 0){
      $query = "INSERT INTO profiles VALUES(NULL, {$UserInfo->userId}, '', '{$email}', 0, 0, 0, 0, 0, 0, 0)";
    }else{
      $query = "UPDATE profiles SET email_verified=0, email='{$email}' WHERE userid='{$UserInfo->userId}'";
    }

    $DB->query("INSERT INTO verification VALUES(NULL, '{$UserInfo->userId}', '{$hash}', 0)");
    $DB->query($query);
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
