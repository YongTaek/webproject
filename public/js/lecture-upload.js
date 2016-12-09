
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

  $("#sub-mit").click(submitData);
});

function submitData() {
  $("#form").ajaxForm({
    dataType: 'text',
    success: function(responseText, statusText){
      console.log(responseText);
      var result = JSON.parse(responseText);
      alert("파일을 업로드했습니다! :)");
      window.location.href = "/php/lecture-manage.php";
    },error: function(e){
      console.log(e.responseText);
      alert("파일 업로드에 실패했습니다! :(");
    }
  });
}
