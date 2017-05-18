$(function(){
  var submitButton = $("#login-submitButton");
  var errorFlag = 0;

  submitButton.click(function(){
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
          alert("Logged In!");
          location.reload();
        }else{
          $.each(data.errors, function(key, value){
            $("#login-er-"+value.field).text(value.message);
          });
        }
      }
    });
  });
});
