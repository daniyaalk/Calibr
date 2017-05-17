<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Calibr - Sign In</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

    <script type="text/javascript">
      $(function(){
        var submitButton = $("#submitButton");
        var errorFlag = 0;

        submitButton.click(function(){
          $(".error-message").text(null);
          $.ajax({
            url: 'app/login.php',
            method: 'POST',
            data: {
              username: $("#username").val(),
              password: $("#password").val()
            },
            success: function(data){
              if(data.auth == true){
                alert("Logged In!");
                location.reload();
              }else{
                $.each(data.errors, function(key, value){
                  $("#er-"+value.field).text(value.message);
                });
              }
            }
          });
        });
      });
    </script>
  </head>
  <body>
    <div id="er-3" class="error-message">

    </div>
    <input type="text" id="username" name="username" value="" placeholder="Username"><br>
    <div id="er-1" class="error-message">

    </div>
    <input type="password" id="password" name="password" value="" placeholder="Password"><br>
    <div id="er-2" class="error-message">

    </div>
    <input type="submit" id="submitButton" name="submit" value="Log In">
  </body>
</html>
