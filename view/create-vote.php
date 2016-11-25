<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../public/css/create-vote.css"/>
	<script src="/public/js/jquery-3.1.1.min.js" type="text/javascript"></script>
	<link rel="stylesheet" href="../public/css/bootstrap.min.css" type="text/css">
	<script src="/public/js/create-vote-item.js" type="text/javascript" charset="utf-8" async defer></script>
	<title>enroll vote</title>
</head>
<body>
	<form action="create-vote_submit">
		<h2>Vote Subject</h2>
		<div class="subject">
			<input name="subject" type="text">
		</div>
		<h2>Period</h2>
		<div>
			<input type="datetime-local" name="startDate" value="">
			<input type="datetime-local" name="endDate" value="">
		</div>
		<h2>Number of Selection</h2>
		<select name="select_num">
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
		</select>
		<h2>Items   <img class="plusBtn" src="/public/img/plus_icon.png" id="plus"/>
		<img class="minusBtn" src="/public/img/minus_icon.png" id="minus"/></h2>
		
		<ul>
			<li class = "item"><input type="text" name="item" value=""></li>
		</ul>
		<input class="btn btn-primary" type="button" name="create-vote" value="생성">
		<a class="btn btn-primary" href="">취소</a>
	</form>
</body>
</html>