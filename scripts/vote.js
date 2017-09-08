var voteButtons = $(".vote-buttons");

function vote(type){
  $.ajax({
    url: 'app/vote.php',
    success: function(data){
      if($.isEmptyObject(data.errors)){

      }else if(data.errors.message == "nologin"){
        $("#loginModal").modal('show');
      }
    }
  })
}
