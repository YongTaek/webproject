<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../public/css/changepw.css"/>
	<script src="../common/scripts/jquery-1.10.2.js" type="text/javascript"></script>
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
				<input id="idform" class="textfield" type="text" name="id" placeholder= "Current Password"/>
				<div class="login_icon" id="usericon"></div>
				<input class="textfield" type="password" name="password" placeholder = "New Password"/>
				<div class="login_icon" id="passwdicon"></div>
				<input id="submit_button" type="submit" value="change_password"/>
				<input type="hidden" name="source" value="/index.php">
			</form>
		</content>
	</div>
</body>
</html>
