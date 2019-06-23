<!DOCTYPE html>
<html lang = "en">
<head>
	<meta charset = "UTF-8">
	<title>Register TXT</title>
</head>
<body>
	<filedset>
	<legend><h1>Register</h1></legend>
	<form action = "#" method = "POST">
		<label for "User"> User </label>
		<input type = "String" name = "usuario" required>
		<br><br>
		<label for "Password"> Password </label>
		<input type = "String" name = "password" required>
		<br><br>
		<label for "Name"> Name </label>
		<input type = "String" name = "name" required>
		<br><br>
		<label for "correo"> Correo </label>
		<input type = "String" name = "correo" required>
		<br><br>
		<input type = "submit" name = "enviar" value = "Register">
	</filedset>
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
		header("Location: index.php");
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