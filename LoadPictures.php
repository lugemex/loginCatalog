<?php
session_start(); //esta instrucción debe la primera antes de cualquier etiqueta
include 'manageFiles.php';
include 'variables.php';
$directoryOfImages='picturesRobots';
$extensionsOfImages=array('gif','jpg','jpeg','tif','tiff','bmp','png');


?>

<!DOCTYPE html>
<html lang = "en">
<head>
	<meta charset = "UTF-8">
	<title> UploadFiles </title>
	<link rel = "stylesheet" href = "css/loadPictures_style.css">
	
</head>
<body>

	<header class = "main_header">
		<form action = "#" method = "POST">
			<span class = "nav_header"><?php echo "Welcome: ".utf8_decode($_SESSION['usuario']);?></span>
			<input type = "submit" name = "logout" value = "Logout">
			<?php
			if(empty($_SESSION)){
				header("Location: index.php");
			}
			if(isset($_POST["logout"])){
				header("Location: Logout.php");
			}
			?>
		</form>
	</header>
	
	<h1 class = "pag_tittle">Upload Files</h1>
	
	<ul id=catalogue>
		
    </ul>
<!-- Formulario para llenar BD:-->
	
	
		
	<form method="POST" action="#" enctype="multipart/form-data">
	<div>
		<input type="file" name="picturePath" ><br><br>
	</div>
	<div>
		<label for="Article">Article</label>
		<input type="text" name="Article" required><br><br>
	</div>
	<div>
		<label for="titleHighLights">title for HighLights</label>
		<input type="text" name="titleHighLights" ><br><br>
	</div>
	<div>
		<textarea name="HighLights" id="HL" cols="50" rows="10">Writing down the content of HighLights</textarea>
	</div>
	<div>
		<label for="titleFeatures">title for Features</label>
		<input type="text" name="titleFeatures"><br><br>
	</div>
	<div>
		<textarea name="Features" id="F" cols="50" rows="10">Writing down the content of the HighLights</textarea>
	</div>
	<!-- Botones de funciones-->
	<div>
		<input type="submit" value="Query" name="btnQ">
		<input type="submit" value="Insert"name="btnI">
		<input type="submit" value="Update"name="btnU">
		<input type="submit" value="Delete"name="btnD">
	</div>
	</form>

	<?php
		//variables
		
		$listImg=getDirFiles($directoryOfImages,$extensionsOfImages);
		//$values=array("'21'","'nombre9'","'appelido9'","'1'");
		//$rows=array("DNI","nombre","apellidos","exp_curso");
		$myDB=openDB($host,$user,$pw,$bd);
		
		//mysqli_query($myDB,"INSERT INTO $tabla (DNI,nombre,apellidos,exp_curso) VALUES ('$DNI','nombre','apellid','2')");
		
		// C O N S U L T A
		if(isset($_POST["btnQ"])){
			// si se oprimio el botón Query consultar artículo de acuerdo con formulario...
			$Article=$_POST['Article'];
			//$imageName=$_POST['imageName'];
			$tHL=$_POST['titleHighLights'];
			$HL=$_POST['HighLights'];
			$tF=$_POST['titleFeatures'];
			$F=$_POST['Features'];

			$dataDB=getDataFromDB($myDB,$tabla,"Article",$Article);
			while ($queryDB=mysqli_fetch_array($dataDB)){ // obtiene las columnas(campos) de la tabla de la base de datos señalada
				//echo $queryDB[$Article]."<BR>"; por nombre de campo (tambien es posible por índice de array)
				$selectedArticle=$queryDB['Article'];
				$selectedImage=$queryDB['imageName'];
				$selectedTitle1=$queryDB['titleHighLights'];
				$selectedContent1=$queryDB['HighLights'];
				$selectedTitle2=$queryDB['titleFeatures'];
				$selectedContent2=$queryDB['Features'];
			echo "Consulta exitosa:";

			}
			// show picture and data selected
			echo $selectedArticle."<br>";
			$dirImg=$directoryOfImages."/".$selectedImage;
			?>
			<li>
				<img src=<?php echo $dirImg;?>  alt="" heigth="150" width="200">
			</li>
			<?php
			echo $selectedTitle1."<br>";
			echo nl2br($selectedContent1."<br>");
			echo $selectedTitle2."<br>";
			echo nl2br($selectedContent2."<br>");
			// fin de show pictures   
		}
		// I N S E R T
		if(isset($_POST["btnI"])){
			//se obtienen las variables del formulario para la BD
			$Article=$_POST['Article'];
			//$imageName=$_POST['imageName'];
			$tHL=$_POST['titleHighLights'];
			$HL=$_POST['HighLights'];
			$tF=$_POST['titleFeatures'];
			$F=$_POST['Features'];
			//echo $Article;
						
			//se sube la imagen al servidor $directoryOfImages/$imageName	
			$imageName=$_FILES['picturePath']['name'];//nombre del directorio cliente
			$tmpNameImage=$_FILES['picturePath']['tmp_name']; //nombre temporal en el servidor /temp
			$extension=substr($imageName,strrpos($imageName,'.'));//cadena regresa con punto .ext
			$extensionImage=substr($extension,1-strlen($extension));//se quita el punto de la cadena
			if(in_array($extensionImage,$extensionsOfImages)){
				if(move_uploaded_file($tmpNameImage,"$directoryOfImages/$imageName")){
					//echo $imageName;
					echo "<script>
					alert('Archivo cargado exitosamente');
					</script>";
				}else{
					echo "No se pudo subir la imagen";
				}
			}else{
				echo "Archivo no permitido!";
			}
			$values=array($Article,$imageName,$tHL,$HL,$tF,$F);
			$rows=array("Article","imageName","titleHighLights","HighLights","titleFeatures","Features");
			//mysqli_query($myDB,"INSERT INTO $tabla (Article) VALUES ('$Article')");
			insertDataIntoDB($myDB,$tabla,$rows,$values);

			unset($_POST['btnI']);// necesario para correcto manejo de archivos
			
			echo "Datos Insertados";
		}
		// U P D A T E
		if(isset($_POST["btnU"])){
			// actualiza los datos del artículo indicado según el formulario
			$Article=$_POST['Article'];
//			$imageName=$_POST['imageName'];
			$tHL=$_POST['titleHighLights'];
			$HL=$_POST['HighLights'];
			$tF=$_POST['titleFeatures'];
			$F=$_POST['Features'];
			//$values=array($Article,$imageName,$tHL,$HL,$tF,$F);
			//$rows=array("Article","imageName","titleHighLights","HighLights","titleFeatures","Features");
			if (empty($Article)){
				echo "<script>alert('Defina el artículo a modificar')</script>";
			}else{
				modifyElementFromDB($myDB,$tabla,"Article",$Article,$Article);
				modifyElementFromDB($myDB,$tabla,"titleHighLights",$tHL,$Article);
				modifyElementFromDB($myDB,$tabla,"HighLights",$HL,$Article);
				modifyElementFromDB($myDB,$tabla,"titleFeatures",$tF,$Article);
				modifyElementFromDB($myDB,$tabla,"Features",$F,$Article);
				echo $Article." Modified!";
			}	
		}
		// B O R R A R 
		if(isset($_POST["btnD"])){
			$Article=$_POST['Article'];
			$available=0;
			$dataDB=getDataFromDB($myDB,$tabla,"Article",$Article);
			while($qry=mysqli_fetch_array($dataDB)){
				//echo $qry[$available];
				$available++;
			}
			if ($available==0){
				echo "<script>alert('El artículo no existe')</script>";
			}else{
				removeElementFromDB($myDB,$tabla,"Article",$Article);
				echo $Article." Deleted!";
			}
			
		}
		mysqli_close($myDB);
	?>
	<footer id="footer"><h1>KraussMaffei</h1></footer>		
</body>

</html>