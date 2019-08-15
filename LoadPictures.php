<?php
session_start(); //esta instrucción debe la primera antes de cualquier etiqueta
include 'manageFiles.php';
?>

<!DOCTYPE html>
<html lang = "en">
<head>
	<meta charset = "UTF-8">
	<title> UploadFiles </title>
	<link rel = "stylesheet" href = "./style.css">
	
</head>
<body>

	<header class = "main_header">
		<form action = "#" method = "POST">
			<span class = "nav_header"><?php echo "Welcome: ".utf8_decode($_SESSION['usuario']);?></span>
			<input type = "submit" name = "logout" value = "Logout">
			<?php
			if(isset($_POST["logout"])){
				header("Location: Logout.php");
			}
			?>
		</form>
	</header>
	
	<h1 class = "pag_tittle">Upload Files</h1>
	
	<ul id=catalogue>
    <?php
	$directoryOfImages='picturesRobots';
	$extensionsOfImages=array('gif','jpg','jpeg','tif','tiff','bmp','png');
    $listImg=getDirFiles($directoryOfImages,$extensionsOfImages);
    //printListFiles($listImg);
    //se muestran las imagenes existentes en el catalogo
    $numElements=count($listImg);
    if ($numElements>0){
        for($i=0;$i<$numElements;$i++){
            
    ?>
    <li>
        <img src=<?php echo $listImg[$i];?>  alt="" heigth="150" width="200">
    </li>
    <?php
        }
    }else{
        die('ERROR: No se encontraron imágenes en el directorio');
    }    
    ?>
    </ul>

		<form action="" method="post" enctype="multipart/form-data">
			<input type="file" name="picturePath" ><br>
			<input type="submit" value="Load Image" name="upImage">
		</form>
		<?php
		if (isset($_POST['upImage'])){
			$nameImage=$_FILES['picturePath']['name'];//nombre del directorio cliente
			$tmpNameImage=$_FILES['picturePath']['tmp_name']; //nombre temporal en el servidor
			$extension=substr($nameImage,strrpos($nameImage,'.'));//cadena regresa con punto .ext
			$extensionImage=substr($extension,1-strlen($extension));//se quita el punto de la cadena
			if(in_array($extensionImage,$extensionsOfImages)){
				if(move_uploaded_file($tmpNameImage,"$directoryOfImages/$nameImage")){
					echo "<script>
                    alert('Archivo cargado exitosamente');
                    </script>";
				}else{
					echo "No se pudo subir la imagen";
				}
			}else{
				echo "Archivo no permitido!";
			}
			unset($_POST['upImage']);
		}
		//uploadFile();
		?>
	

	<footer id="footer"><h1>KraussMaffei</h1></footer>		
</body>

</html>