var options = {
	'legend':{
		names: ['A','B','C','D','E','F','G','H','I']
	},
	'dataset':{
		title:'Playing time per day', 
		values: [5,7,1,4,6,3,5,2,10],
		colorset: ['#0072b2', '#cc79a7'],
		fields:['Company A', 'Company B']
	},
	'chartDiv' : 'chart',
	'chartType' : 'column',
	'leftOffsetValue': 40,
	'bottomOffsetValue': 60,
	'chartSize' : {width:700, height:300},
	'maxValue' : 10,
	'increment' : 1
};

window.onload = function() {
	Nwagon.chart(options);
}

$(document).ready(function(){
    // menu 클래스 바로 하위에 있는 a 태그를 클릭했을때
    $("#vote-result").click(function(){

    	var submenu = $(this).next("#chart");
            // submenu 가 화면상에 보일때는 위로 보드랍게 접고 아니면 아래로 보드랍게 펼치기
        if( submenu.is(":visible") ){
          	submenu.slideUp();
          	$("#vote-result").html("결과 보기");
        }else{
           	submenu.slideDown();
           	$('#vote-result').html("결과 숨기기");
        }
    });
});

