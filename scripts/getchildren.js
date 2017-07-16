$(function(){
  $("#grade-selector").removeAttr('disabled');

  $("#grade-selector").bind('change', function(){
    $("#subject-selector").removeAttr('disabled');

    //Get Subjects
    $.ajax({
      method: 'GET',
      url: 'app/getchildren.php',
      data: {
        type: 0,
        of: $("#grade-selector").val()
      },
      success: function(data){
        $.each(data, function(key, value){
          $("#subject-selector").append("<option value='"+value.id+"'>"+value.name+"</option>");
        })
      }
    });
  });

  $("#subject-selector").bind('change', function(){
    $("#chapter-selector").removeAttr('disabled');

    //Get Subjects
    $.ajax({
      method: 'GET',
      url: 'app/getchildren.php',
      data: {
        type: 1,
        of: $("#subject-selector").val()
      },
      success: function(data){
        $.each(data, function(key, value){
          $("#chapter-selector").append("<option value='"+value.id+"'>"+value.name+"</option>");
        })
      }
    });
  });

  $("#chapter-selector").bind('change', function(){
    $("#topic-selector").removeAttr('disabled');

    //Get Subjects
    $.ajax({
      method: 'GET',
      url: 'app/getchildren.php',
      data: {
        type: 2,
        of: $("#chapter-selector").val()
      },
      success: function(data){
        $.each(data, function(key, value){
          $("#topic-selector").append("<option value='"+value.id+"'>"+value.name+"</option>");
        })
      }
    });
  });
});
