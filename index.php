<?php

<<<<<<< HEAD


 ?>

=======
  session_start();

 ?>
>>>>>>> login
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Calibr - Sign In</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

    <script src="scripts/login.js" type="text/javascript"></script>
  </head>
  <body>
    <?php

      if(!isset($_SESSION['username'])){
        echo '

        <div id="login-er-3" class="error-message">

        </div>
        <input type="text" id="login-username" name="username" value="" placeholder="Username"><br>
        <div id="login-er-1" class="error-message">

        </div>
        <input type="password" id="login-password" name="password" value="" placeholder="Password"><br>
        <div id="login-er-2" class="error-message">

        </div>
        <input type="submit" id="login-submitButton" name="submit" value="Log In">

        ';
      }
      else{
        echo "<a href='logout.php'>Log Out</a>";
      }
     ?>
    </div>
    <input type="submit" id="login-submitButton" name="submit" value="Log In">

    <hr>
    <div class="list-posts">

    </div>

  </body>
</html>
