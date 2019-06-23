<!DOCTYPE html> 
<html lang = "en">
<head>
	<meta charset = "UTF-8">
	<title>Login TXT</title>
</head>
<body>
	<filedset>
	<legend><h1>Login</h1></legend>
	<form action = "#" method = "POST">
		<label for = "User"> User </label>
		<input type = "string" name = "usuario" >
		<br><br>
		<label for = "Password">Password </label>
		<input type = "string" name = "password" >
		<br><br>
		<input type = "submit" name = "enviar" value = "leer">
		
	</filedset>
<label>Resultados</label>	
	<?php 
	if (isset($_POST["enviar"])){
		$usuario = $_POST["usuario"];
		$password = $_POST["password"];
		$password_encriptada = sha1($password);
		
		$fp = fopen("db.txt","r");
		while(!feof($fp)){
			$linea = fgets($fp);
			$linea_split = explode(",", $linea);
			if($linea_split[1] == $usuario && $linea_split[2] == $password_encriptada){
				echo "login"."<br>";
				break;
				}
			if($linea_split[1] == $usuario && $linea_split[2] != $password_encriptada){
				echo "
				<script>
				alert('Contraseña incorrecta');
				window.location = 'LoginTxt.php';
				</script>
				";
				break;
			}
			if(feof($fp)){
				echo "<script>
					alert('Usuario No encontrado');
					window.location = 'RegisterTxt.php';
					</script>";
			}
		}
		fclose($fp);
	}
	?>
	<br><br>
		<input type = "submit" name = "MainMenu" value = "MainMenu">
	<?php
	if (isset($_POST["MainMenu"])){
		header("Location: index.php");
	}
	?>
</body>
</html>