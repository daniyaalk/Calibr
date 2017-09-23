function vote(type, id){

  if(parseInt(type) == 1){
    $("#vote-down").removeClass("btn-danger");

    if($("#vote-up").hasClass('btn-info')){
      //if upvote button already has btn-info class, it implies that the user is retracting their vote.
      $("#vote-up").removeClass('btn-info');
    }else{
      $("#vote-up").addClass('btn-info');
    }
  }else if(parseInt(type) == -1){
    $("#vote-up").removeClass("btn-info");

    if($("#vote-down").hasClass('btn-danger')){
      //if downvote button already has btn-info class, it implies that the user is retracting their vote.
      $("#vote-down").removeClass('btn-danger');
    }else{
      $("#vote-down").addClass('btn-danger');
    }
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
