<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../public/css/changepw.css"/>
	<script src="../public/js/jquery-3.1.1.min.js" type="text/javascript"></script>
	<script src="../public/js/changepw.js" type="text/javascript"></script>
	<title>Software Engineering Lab - Login</title>
</head>
<body>
		<div id="wrap">
		<header>
			<h1>Change Password</h1>
		</header>
		<content>
			<form method="post" action="changepw.php">
				<input id="idform" class="textfield" type="password" name="current_password" placeholder= "Current Password"/>
				<div class="login_icon" id="usericon"></div>
				<input class="textfield" type="password" name="new_password" placeholder = "New Password"/>
				<div class="login_icon" id="passwdicon"></div>
				<input id="submit_button" type="submit" value="change_password"/>
				<input type="hidden" name="source" value="/main.php">
			</form>
		</content>
	</div>
</body>
</html>
