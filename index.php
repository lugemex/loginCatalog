<!DOCTYPE html> 
<html lang = "en">
<head>
	<meta charset = "UTF-8">
	<title>Login TXT</title>
</head>
<body> 
	<header></header>
	
	<filedset>
	<legend><h1>Main menu</h1></legend>
	<form action = "#" method = "POST">
		<input type = "submit" name = "login" value = "login">
		<br><br>
		<br><br>
		<input type = "submit" name = "register" value = "register">
		<br><br>
	</filedset>
	<?php 
	if (isset($_POST["login"])){
		header("Location: LoginTxt.php");
	}
	if (isset($_POST["register"])){
		header("Location: RegisterTxt.php");
	}
	?>
</body>
</html>