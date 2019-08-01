<!DOCTYPE html> 
<html lang = "en">
<head>
	<meta charset = "UTF-8">
	<meta name="keywords" content="HTML5, CSS3" /> <!--solo es usado para motores de busqueda, no es visible para el usauario-->
	<title>Main_menu</title>
	<link rel = "stylesheet" href = "./style.css">
</head>
<body>

	<header class = "main_header">
		<span class = "nav_header">Welcome</span>
	</header>
	<img src="pictures/newLogo.png" alt="newLogo KM" height="200" width="240">
	<h1 class = "pag_tittle">Main menu</h1>
	
	<form class = "pag_content" action = "#" method = "POST"> <!--POST no muestra resultado en URL-->
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
	<footer id="footer"><h1>KraussMaffei</h1></footer>	
</body>
</html>