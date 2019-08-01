<!DOCTYPE html> 
<html lang = "en">
<head>
	<meta charset = "UTF-8">
	<title>Login_txt</title>
	<link rel = "stylesheet" href = "./style.css">
</head>
<body>
	
	<header class = "main_header">
		<?php session_start();?>
		<a class = "nav_link" href = "index.php">Main_Menu</a>
		<span class = "nav_header">Login</span>
	</header>

	<h1 class = "pag_tittle">Login</h1>
	
	<form class = "pag_content" action = "#" method = "POST">
		<label for = "User"><b>User</b></label>
		<input type = "string" name = "usuario" >
		<br><br>
		<label for = "Password"><b>Password</b></label>
		<input type = "string" name = "password" >
		<br><br>
		<input type = "submit" name = "enviar" value = "Login">
		<?php 
		if (isset($_POST["enviar"])){
			$usuario = $_POST["usuario"];
			$password = $_POST["password"];
			$password_encriptada = sha1($password);
			$fp = fopen("db.txt","r");// abre el archivo db.txt sóo de lectura

			while(!feof($fp)){//hasta que el $fp (filePoniter) llegue al final del archivo
				$linea = fgets($fp);
				$linea_split = explode(",", $linea);
				if($linea_split[1] == $usuario && $linea_split[2] == $password_encriptada){
					$_SESSION['usuario'] = $linea_split[1];
					header("Location: Content.php");
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
		
	</form>	
	<footer id="footer"><h1>KraussMaffei</h1></footer>		
</body>
</html>