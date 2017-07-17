function updatePassword() {

  $("#password-update > .help-block").text(null);
  $("#password-update > div").removeClass("has-error");

  var current_password = $("#current-password-field").val();
  var new_password = $("#new-password-field").val();
  var repeat_password = $("#repeat-password-field").val();

  $.ajax({
    method: 'POST',
    url: 'app/updatepassword.php',
    data: {
      'password': current_password,
      'new': new_password,
      'repeat': repeat_password
    },
    success: function(data){
      if(data.changed){
        $.ajax({
          method: 'get',
          url: 'app/alerthandler.php',
          data: {
            request: 2,
            message: 'Your password was changed successfully!',
            type: 'success'
          }
        });
        location.reload();
      }else{
        console.log(data.messages);
        $.each(data.messages,function(key, value){
          $("#"+value.field+"-password-group").addClass("has-error");
          $("#"+value.field+"-password-group > .help-block").append(value.message+"<br />");
        });
      }
    }
  });
}
