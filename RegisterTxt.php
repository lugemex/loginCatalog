<!DOCTYPE html>
<html lang = "en">
<head>
	<meta charset = "UTF-8">
	<title>Register_txt</title>
	<link rel = "stylesheet" href = "./style.css">
</head>
<body>

	<header class = "main_header">
		<a class = "nav_link" href = "index.php">Main_Menu</a>
		<span class = "nav_header">Register</span>
	</header>

	<h1 class = "pag_tittle">Register</h1>

	<form class = "pag_content" action = "#" method = "POST">
		<label for "User"><b>User</b></label>
		<input type = "String" name = "usuario" required>
		<br><br>
		<label for "Password"><b>Password</b></label>
		<input type = "String" name = "password" required>
		<br><br>
		<label for "Name"><b>Name</b></label>
		<input type = "String" name = "name" required>
		<br><br>
		<label for "correo"><b>Correo</b></label>
		<input type = "String" name = "correo" required>
		<br><br>
		<input type = "submit" name = "enviar" value = "Register">
		<?php
		if(isset($_POST["enviar"])){
			$usuario 	= $_POST["usuario"];
			$password 	= $_POST["password"];
			$name 		= $_POST["name"];
			$correo		= $_POST["correo"];
			$password_encriptada = sha1($password);
			$fp = fopen("db.txt","r+");
			
			while(!feof($fp)){
				$linea = fgets($fp);
				$linea_split = explode(",",$linea);
				if($linea_split[1] == $usuario || $linea_split[4] == $correo){
					echo "<script>
						alert('Usuario ya registrado');
						window.location = 'RegisterTxt.php';
						</script>";
					break;
				}
				if(feof($fp)){
					$lastUser = $linea_split[0] + 1;
					fputs($fp, "\n".
					$lastUser.",".
					$usuario.",".
					$password_encriptada.",".
					$name.",".
					$correo.","
					);
				}
			}
			fclose($fp);
			header("Location: LoginTxt.php");
		}
		?>
	</form>
	
</body>
</html>