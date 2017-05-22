$(function(){
  var loginForm = $("#loginForm");
  var errorFlag = 0;

  loginForm.submit(function(){
    $(".error-message").hide();
    $(".error-message").text(null);
    $.ajax({
      url: 'app/login.php',
      method: 'POST',
      data: {
        username: $("#login-username").val(),
        password: $("#login-password").val()
      },
      success: function(data){
        if(data.auth == true){
          location.reload();
        }else{
          $.each(data.errors, function(key, value){
            $("#login-er-"+value.field).show();
            $("#login-er-"+value.field).text(value.message);
          });
        }
      }
    });
  });
});
