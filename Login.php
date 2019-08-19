<?php session_start();?>	<!-- Mantiene la session activa -->
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Login</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/Login_style.css" rel="stylesheet">
	
</head>

<body id="page-top">

  <!-- Navigation -->
	<div class="container-fluid">
	  <div class="row no-gutter">
		<div class="d-none d-md-flex col-md-4 col-lg-6">
			<img class="img-fluid mb-3 mb-lg-0" src="img/newLogo.png" alt="" width="500" height="200" >
		</div>
		<div class="col-md-8 col-lg-6">
		  <div class="login d-flex align-items-center py-5">
			<div class="container">
			  <div class="row">
				<div class="col-md-9 col-lg-8 mx-auto">
				  <h3 class="login-heading mb-4">Welcome back!</h3>
				  
				  <!-- Form -->
				  <form action = "#" method = "POST">
					<div class="form-label-group">
						<!-- User -->
					  <input type="String" name="usuario" class="form-control" placeholder="Email address" required autofocus> <!-- for type email-->
					  <label for="usuario">User</label>
					</div>

					<div class="form-label-group">
						<!-- Password -->
					  <input type="password" name="password" class="form-control" placeholder="Password" required>
					  <label for="password">Password</label>
					</div>

					<!-- Enviar -->
					<button class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2" type="submit"  name = "enviar">Sign in</button>
					<div class="text-center">
						<a class="d-block text-center mt-2 small" href="Register.php">Register</a>
						<a class="d-block text-center mt-2 small" href="index.php">Home</a>
				  
						<!-- PHP stratergy --> 
					  <?php 
						if (isset($_POST["enviar"])){	//Si se envio "enviar" con el metodo POST
							$usuario = $_POST["usuario"];	//Se recolecta la informacion
							$password = $_POST["password"];
							$password_encriptada = sha1($password);	//Se encripta la contraseña para hacerla coincidir con la guardada
							
							//Master admin
							if($usuario == "mantenimiento" && $password_encriptada == "2c564879968adbf9875ea151b00dacc051437447"){
								$_SESSION['usuario'] = $usuario;
								header("Location: LoadPictures.php");
							}

							//Se lee el archivo 
							$fp = fopen("db.txt","r");// abre el archivo db.txt sólo de lectura

							while(!feof($fp)){//hasta que el $fp (filePoniter) llegue al final del archivo
								$linea = fgets($fp);	//Lee cada linea
								$linea_split = explode(",", $linea); //Separa cada linea y lo regresa como un array
								
								//Si el usuario existe y la contraseña corresponde
								if($linea_split[1] == $usuario && $linea_split[2] == $password_encriptada){
									$_SESSION['usuario'] = $linea_split[1];
									header("Location: Content.php");
									break;
									}
								//si el usuario existe pero la contraseña es incorrecta
								if($linea_split[1] == $usuario && $linea_split[2] != $password_encriptada){
									echo "
									<script>
									alert('Contraseña incorrecta');
									window.location = 'Login.php';
									</script>
									";
									break;
									}
								//Si se recorrio toda la informacion pero no se encontro al usuario
								if(feof($fp)){
									echo "<script>
										alert('Usuario No encontrado');
										window.location = 'Register.php';
										</script>";
									}
							}
							fclose($fp);	//Se cierra el archivo
						}
						?> 
				  
				  </form>
				</div>
			  </div>
			</div>
		  </div>
		</div>
	  </div>
	</div>

</body>

</html>