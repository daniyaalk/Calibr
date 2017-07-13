function updateEmail(email = $("#email-field").val()){

  $("#email-wrapper").removeClass("has-error");
  $("#email-block").text(null);

  $.ajax({
    method: "POST",
    url: "app/updateemail.php",
    data:{
      "email": email
    },
    success: function(data){
      if(data.changed){
        window.location = "settings.php?active=email&email_sent=true";
      }else{
        $.each(data.errors, function(key, value){
          console.log(value);
          $("#"+value.field+"-wrapper").addClass("has-error");
          $("#"+value.field+"-block").text(value.message);
        });
      }
    }
  });
}
