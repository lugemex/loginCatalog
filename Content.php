<!DOCTYPE html>
<html lang = "en">
<head>
	<meta charset = "UTF-8">
	<title> Content </title>
	<link rel = "stylesheet" href = "./style.css">
	<?php session_start();?>
</head>
<body>

	<header class = "main_header">
		<form action = "#" method = "POST">
			<span class = "nav_header"><?php echo "Usuario: ".utf8_decode($_SESSION['usuario']);?></span>
			<input type = "submit" name = "logout" value = "logout">
			<?php
			if(isset($_POST["logout"])){
				header("Location: Logout.php");
			}
			?>
		</form>
	</header>
	
	<h1 class = "pag_tittle">Content</h1>

</body>
</html>