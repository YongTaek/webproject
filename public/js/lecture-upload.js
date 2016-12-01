
$(document).ready(function(){
  var tabcontent = $(".tab");
  $(".tab.url").css("display","none");
  var i,tablinks;
  $(".question-tab").click(function(){
    tablinks = $(".question-tab");
    tabcontent.css("display","none");
    tablinks.removeClass("active");
    $(this).addClass("active");
    if($(this).hasClass('url')){
      $(".url").css("display","block");
      $(".url input").val('');
    }
    else{
      $(".file").css("display","block");
      $(".file input").val('');
    }
  });
  $("#sub-mit").click(function () {
    var options = {
      dataType:"text",
      success: function(responseText){
        alert("업로드 성공!!");
      },error: function(e){
        console.log(e.responseText());
      }
    };
    $("#form").ajaxForm(options).submit();
  });

});
