var voteButtons = $(".vote-buttons");

function vote(type, id){
  $.ajax({
    url: 'app/vote.php',
    data: {
      type: type,
      postid: id
    },
    success: function(data){
      console.log(data);
      if($.isEmptyObject(data.errors)){
        if(type == 1){
          $("#vote-up").addClass('btn-info');
        }else if(type == -1){
          $("#vote-down").addClass('btn-danger');
        }
      }else if(data.errors.message == "nologin"){
        $("#loginModal").modal('show');
      }
    }
  })
}
