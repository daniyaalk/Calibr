<?php

  require_once "header.php";

  require_once "app/classes/DB.php";
  require_once "app/classes/userInfo.php";

  $DB = new DB();
  $UserInfo = new UserInfo($_SESSION['username'], $DB);

  $profile = $UserInfo->getProfile('email|email_verified');

  $active = "password";
  if(isset($_GET['active'])){
    $active = $_GET['active'];
  }
?>
<script type="text/javascript" src="scripts/updateemail.js"></script>
<script type="text/javascript" src="scripts/updatepassword.js"></script>
<div class="settings-menu margin-10-div">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-md-3 col-lg-4" style="">
        <ul class="nav nav-pills nav-stacked">
          <li role="presentation"<?php echo ($active=="password")?'class="active"':"";?>><a href="#password" aria-controls="password" role="tab" data-toggle="tab">Update Password</a></li>
          <li role="presentation"<?php echo ($active=="email")?'class="active"':"";?>><a href="#email" aria-controls="email" role="tab" data-toggle="tab">Email Settings</a></li>
          <!-- Profiles will be a feature in a future release.
          <li role="presentation"<?php echo ($active=="profile")?'class="active"':"";?>><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Profile Settings</a></li>
          -->
        </ul>
      </div>
      <div class="col-xs-12 col-md-9 col-lg-8">
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane fade <?php echo ($active=="password")?"in active":""; ?>" id="password">
            <h3>Update Password</h3>
            <div id="password-update" >
              <p>
                <div id="current-password-group">
                  <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></div>
                    <input type="password" class="form-control" placeholder="Current Password" id="current-password-field">
                  </div>
                  <span id="current-password-block" class="help-block"></span>
                </div>
              </p>
              <p>
                <div id="new-password-group">
                  <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></div>
                    <input type="password" class="form-control" placeholder="New Password" id="new-password-field">
                  </div>
                  <span id="new-password-block" class="help-block"></span>
                </div>
              </p>
              <p>
                <div id="repeat-password-group">
                  <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></div>
                    <input type="password" class="form-control" placeholder="And again..." id="repeat-password-field">
                  </div>
                  <span id="repeat-password-block" class="help-block"></span>
                </div>
              </p>
              <p>
                <button onclick="javascript: updatePassword();" name="button" class="btn btn-primary btn-large btn-block">Change Password</button>
              </p>
            </div>
          </div>

          <div role="tabpanel" class="tab-pane fade <?php echo ($active=="email")?"in active":""; ?>" id="email">
            <h3>Email Settings</h3>
            <?php
              if(isset($_GET['email_sent'])){
                echo '<div class="alert alert-success" id="email-success">An activation email has been sent to your address!</div>';
              }
            ?>
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
                    if($profile[1] == 0 && !empty($profile[0])){
                      echo "<span class='label label-warning'>Pending verification. <a href='javascript: updateEmail(\"{$profile[0]}\");'>Resend email?</a></span>";
                    }else if($profile[1] == 1){
                      echo "<span class='label label-success'>Verified!</span>";
                    }
                  ?>
                </td>
              </tr>
            </table>
            <div class="form-group">
              <p>
                <label for="email">Update/Add Email</label>
                <div id="email-wrapper">
                  <div class="input-group">
                    <div class="input-group-addon">@</div>
                    <input type="email" id="email-field" class="form-control" placeholder="New Email">
                  </div>
                  <span id="email-block" class="help-block"></span>
                </div>
              </p>
              <p>
                <a href="javascript: updateEmail();"><button type="button" class="btn btn-primary btn-block">Update Email</button></a>
              </p>
            </div>
          </div>
          <!-- Profiles will be a feature in a future release.
          <div role="tabpanel" class="tab-pane fade <?php echo ($active=="profile")?"in active":""; ?>" id="profile">Profile</div>
          -->
        </div>
      </div>
    </div>
  </div>
</div>
