<!DOCTYPE html> 
<html lang = "en">
<head>
	<meta charset = "UTF-8">
	<title>Main_menu</title>
	<link rel = "stylesheet" href = "./style.css">
</head>
<body>

	<header class = "main_header">
		<span class = "nav_header">Bienvenido</span>
	</header>
	
	<h1 class = "pag_tittle">Main menu</h1>
	
	<form class = "pag_content" action = "#" method = "POST">
		<input type = "submit" name = "login" value = "Login">
		<br><br>
		<input type = "submit" name = "register" value = "Register">
		<br><br>
		<?php 
		if (isset($_POST["login"])){
			header("Location: LoginTxt.php");
		}
		if (isset($_POST["register"])){
			header("Location: RegisterTxt.php");
		}
		?>
		</form>
		
</body>
</html>