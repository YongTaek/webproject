
$(document).ready(function(){
    var tabcontent = $(".tab");
    $(".tab.url").css("display","none");
    var i,tablinks;
    $(".question-tab").click(function(){
        tablinks = document.getElementsByClassName("question-tab");
        for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        $(this).addClass("active");
        if($(this).hasClass('url')){
            $(".url").css("display","block");
        }
        else{
            $(".file").css("display","block");
        }
    });
});