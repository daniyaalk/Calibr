<?php

  $_title = "Home";
  require_once "header.php";
 ?>
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

<?php

  require_once "footer.php";

 ?>
