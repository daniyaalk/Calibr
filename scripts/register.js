var errorFlag = 0;
function register(){
  $(".error-message").hide();
  $(".error-message").text(null);
  $.ajax({
    url: 'app/register.php',
    method: 'POST',
    data: {
      username: $("#register-username").val(),
      password: $("#register-password").val(),
      repeatPassword: $("#register-repeatPassword").val()
    },
    success: function(data){
      if(data.registered == true){
        location.reload();
      }else{
        $.each(data.errors, function(key, value){
          $("#register-er-"+value.field).show();
          $("#register-er-"+value.field).text(value.message);
        });
      }
    }
  });
}
