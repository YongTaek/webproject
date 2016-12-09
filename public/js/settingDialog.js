function saveFromDialog(){

	$("#saveDialogStudent").on('click', function () {
		console.log("saveDialogStudent");
	});

	$("#saveDialogAssistant").on('click', function () {
		console.log("saveDialogAssistant");
	});
}

$(document).ready(saveFromDialog);