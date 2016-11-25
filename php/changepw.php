<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="/public/css/changepw.css"/>
	<script src="/public/js/jquery-3.1.1.min.js" type="text/javascript"></script>
	<script src="/public/js/changepw.js" type="text/javascript"></script>
	<title>Software Engineering Lab - Login</title>
</head>
<body>
		<div id="wrap">
		<header>
			<h1>Change Password</h1>
		</header>
		<content>
			<form method="post" action="change_password.php">
				<input id="idform" class="textfield" type="text" name="id" placeholder= "Current Password"/>
				<div class="login_icon" id="usericon"></div>
				<input class="textfield" type="password" name="password" placeholder = "New Password"/>
				<div class="login_icon" id="passwdicon"></div>
				<input id="submit_button" type="submit" value="change_password"/>
				<input type="hidden" name="source" value="/php/main.php">
			</form>
		</content>
	</div>
</body>
</html>
