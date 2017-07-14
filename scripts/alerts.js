function loadAlerts(){
  $.ajax({
    method: 'GET',
    url: 'app/alerthandler.php',
    success: function(data){
      $.each(data, function(key, value){
        $("#alerts-wrapper").append('<div class="alert alert-'+value.type+' alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+value.message+'</div>');
      });
    }
  });
}
