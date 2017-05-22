<?php

  session_start();

  //generate title for header
  if(empty($_title)){
    $_title = "Calibr";
  }else{
    //modify patter to choice
    $_title = $_title." | Calibr";
  }
 ?>
 <!DOCTYPE html>
 <html>
   <head>
    <meta charset="utf-8">
    <title><?php echo $_title; ?></title>

    <link rel="stylesheet" href="css/master.css" charset="utf-8">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- bootstrap  links-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!-- End bootstrap links -->

    <!-- Login Script -->
    <script type="text/javascript" src="scripts/login.js"></script>
   </head>
   <body>
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Sign In</h4>
          </div>
          <form id="loginForm" action="javascript: void(0);">
            <div class="modal-body">
              <p>
                <div class="form">
                  <div id="login-er-3" class="error-message alert alert-danger">

                  </div>
                  <input class="form-control" type="text" id="login-username" name="username" value="" placeholder="Username"><br>
                  <div id="login-er-1" class="error-message alert alert-danger">

                  </div>
                  <input class="form-control" type="password" id="login-password" name="password" value="" placeholder="Password"><br>
                  <div id="login-er-2" class="error-message alert alert-danger">

                  </div>
                </div>
              </p>
            </div>
            <div class="modal-footer">
              <input type="submit" id="login-submitButton" class="btn btn-primary" value="Sign In"></input>
              <button type="button" class="btn btn-default" data-dismiss="modal">Register</button>
            </div>
          </form>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">
            Calibr
          </a>
        </div>
        <ul class="nav navbar-nav navbar-right">
          <?php
            if(!isset($_SESSION['username'])):
           ?>
            <li><a href="#" data-toggle="modal" data-target="#loginModal">Sign In</a></li>
          <?php
            else:
          ?>
            <li></li>
          <?php
            endif;
          ?>
        </ul>
      </div>
    </nav>
