<?php

  require_once "header.php";

  require_once "app/DB.php";
  require_once "app/userInfo.php";

  $DB = new DB();
  $UserInfo = new UserInfo($_SESSION['username'], $DB);

  $profile = $UserInfo->getProfile('email|email_verified');
?>
<div class="settings-menu margin-10-div">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-md-3 col-lg-4" style="">
        <ul class="nav nav-pills nav-stacked">
          <li role="presentation"><a href="#password" aria-controls="password" role="tab" data-toggle="tab">Update Password</a></li>
          <li role="presentation" class="active"><a href="#email" aria-controls="email" role="tab" data-toggle="tab">Email Settings</a></li>
          <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Profile Settings</a></li>
        </ul>
      </div>
      <div class="col-xs-12 col-md-9 col-lg-8">
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane fade in" id="password">Password</div>
          <div role="tabpanel" class="tab-pane fade in active" id="email">

            <h3>Email Settings</h3>
            <table class="table">
              <tr>
                <td>
                  Email:
                </td>
                <td>
                  <?php
                    if(empty($profile[0])){
                      echo "No email on record, please add an email.";
                    }else{
                      echo $profile[0];
                    }
                  ?>
                </td>
                <td>
                  <?php
                    if($profile[1] == 0){
                      echo "<span class='label label-warning'>Pending verification. <a href='#' disabled>Resend email?</a></span>";
                    }else{
                      echo "Verified!";
                    }
                  ?>
                </td>
              </tr>
            </table>
            <form class="" action="index.html" method="post">
              <div class="form-group">
                <p>
                  <div class="input-group">
                    <div class="input-group-addon">@</div>
                    <input type="email" class="form-control" value="">
                  </div>
                </p>
              </div>
            </form>
          </div>
          <div role="tabpanel" class="tab-pane fade" id="profile">Profile</div>
        </div>
      </div>
    </div>
  </div>
</div>
