<!DOCTYPE html>
<html>
<head>
	
	
	<link rel="stylesheet" href="/public/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="/public/css/question.css" type="text/css">
	<link rel="stylesheet" type="text/css" href="/public/css/wmd.css" />

	<script type="text/javascript" src="/public/js/jquery-3.1.1.min.js"></script>
	<script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>
	<script type="text/javascript" src="/public/js/showdown.js"></script>
	
	<script type="text/javascript" src="/public/js/wmd.js"></script>
	<script src="/public/js/modify-answer.js"></script>
	
</head>
<body>
	<form action="question.php">
		<div id="wmd-editor">
			<div id="wmd-button-bar"></div>
			<textarea id="wmd-input"></textarea>
		</div>
		<hr>
		<div id="wmd-preview" class="wmd-preview"></div>
		<hr>
		<input class="btn btn-primary" type="submit" value="submit" />
	</form>
	<script type="text/javascript" src="/public/js/wmd.js"></script>
</body>
</html>