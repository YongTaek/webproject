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