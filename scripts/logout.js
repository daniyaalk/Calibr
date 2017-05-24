function logout(){
  $.ajax({
    url: 'app/logout.php',
    success: function(){
      location.reload();
    }
  });
}
