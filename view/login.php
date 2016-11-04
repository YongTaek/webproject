<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../public/css/login.css"/>
	<script src="../common/scripts/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="../public/js/login.js" type="text/javascript"></script>
	<title>Software Engineering Lab - Login</title>
</head>
<body>
		<div id="wrap">
		<header>
			<h1>LOGIN</h1>
		</header>
		<content>
			<form method="post" action="login.php">

				<input id="idform" class="textfield" type="text" name="id" placeholder= "Username"/>
				<div class="login_icon" id="usericon"></div>

				<input class="textfield" type="password" name="password" placeholder = "Password"/>
				<div class="login_icon" id="passwdicon"></div>

				<input id="submit_button" type="submit" value="login"/>
				<input type="hidden" name="source" value="/index.php">
			</form>
		</content>
	</div>
</body>
</html>
