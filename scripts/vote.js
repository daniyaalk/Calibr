function vote(type, id){

  $("#vote-up").removeClass("btn-info");
  $("#vote-down").removeClass("btn-danger");

  if(type == 1){
    $("#vote-up").addClass('btn-info');
  }else if(type == -1){
    $("#vote-down").addClass('btn-danger');
  }

  $.ajax({
    url: 'app/vote.php',
    data: {
      type: type,
      postid: id
    },
    success: function(data){
      if('newcount' in data){
        $("#vote-count").text(data.newcount);
      }
      else if(data.errors.message == "nologin"){
        $("#loginModal").modal('show');
      }
    }
  })
}
