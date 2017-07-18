function submitPost(){

  $("#post-submit").attr('disabled', true);
  $("body").css("cursor", "progress");

  var title = $("#post-title").text();
  var topic = $("#topic-id").text();
  var text = $("#post-text").html();

  $.ajax({
    url: 'app/submitpost.php',
    method: 'post',
    data: {
      title: title,
      text: text,
      topic: topic
    },
    success: function(data){
      if(data.success){
        window.location = "post.php?p="+data.link;
      }else{
        alert("Something went wrong, try again later.");
      }
    }
  });
}
