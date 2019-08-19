<?php
session_start(); //esta instrucci�n debe la primera antes de cualquier etiqueta
include 'manageFiles.php';
include 'variablesDB.php';
$directoryOfImages='picturesRobots';
$extensionsOfImages=array('gif','jpg','jpeg','tif','tiff','bmp','png');
$listImg=getDirFiles($directoryOfImages,$extensionsOfImages);
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Content</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/content-homepage.css" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">
	  <!-- Navigation por specific user -->
	  
	  
	  </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="Content.php"><?php echo "Welcome: ".utf8_decode($_SESSION['usuario']);?>
              <span class="sr-only">(current)</span>
            </a>
          </li>
          
		  <form class="nav-item" action = "#" method = "POST">
            <button class="btn btn-lg btn-primary" name = "logout">Logout</button>
			<?php
				if(isset($_POST["logout"])){	//En caso de enviar Logout con el metodo POST
					header("Location: Logout.php");	//Se direcciona a Logout.php
				}
			?>
          </form>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <div class="col-lg-3">

        <h1 class="my-4">List of products</h1>
        <div class="list-group">  
          <?php        //se muestran las imagenes existentes en el catalogo
          $myDB=openDB($host,$user,$pw,$bd); 
          $nameImageBD=mysqli_query($myDB,("SELECT * FROM $tabla"));
          $q=0;
          while($queryDB=mysqli_fetch_array($nameImageBD)){
            $sA=$queryDB['imageName'];
            //echo $sA."<br>";?>
            
            <img src=<?php echo $directoryOfImages."/".$sA;?>  alt=<?php echo $sA; ?> heigth="150" width="200">
            <?php
            $q++;
          }
          ?>          
        </div>

      </div>
      <!-- /.col-lg-3 -->

      <div class="col-lg-9">
		<!-- Catalog-->
        <div class="row">
          <!-- Item X -->  
          <?php
          //$myDB=openDB($host,$user,$pw,$bd); 
          $dataDB=mysqli_query($myDB,("SELECT * FROM $tabla"));
          $q=0;
          while ($queryDB=mysqli_fetch_array($dataDB)){ // obtiene las columnas(campos) de la tabla de la base de datos señalada
            //echo $queryDB[$Article]."<BR>"; por nombre de campo (tambien es posible por índice de array)
            $q++;
            $selectedArticle=$queryDB['Article'];
            $selectedImage=$queryDB['imageName'];
            $selectedTitle1=$queryDB['titleHighLights'];
            $selectedContent1=$queryDB['HighLights'];
            $selectedTitle2=$queryDB['titleFeatures'];
            $selectedContent2=$queryDB['Features'];
            //echo "Consulta exitosa:".$selectedArticle."<br>";
            echo "
            <div class=\"col-lg-4 col-md-6 mb-4\">
              <div class=\"card h-100\">
                <a href=\"\"><img class=\"card-img-top\" src=\"$directoryOfImages/$selectedImage\" alt=\"\" width=\"200\" height=\"200\"></a>   
                <div class=\"card-body\">
                  <h4 class=\"card-title\">
                    <a href=\"\">$selectedArticle</a>
                  </h4>
                  <h5>$selectedTitle1</h5>
                  <p class=\"card-text\">$selectedContent1</p>
                  <h5>$selectedTitle2</h5>
                  <p class=\"card-text\">$selectedContent2</p>
                </div>
                <div class=\"card-footer\">
                  <small class=\"text-muted\">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                </div>
              </div>
            </div>";
          }
          mysqli_close($myDB);
          ?>
        </div>
        <!-- /.row -->

      </div>
      <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

  </div>
  
  <!-- /.container -->

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Your Website 2019</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


<!-- Contact Section -->
  <section class="contact-section bg-black">
    <div class="container">

      <div class="row">

        <div class="col-md-4 mb-3 mb-md-0">
          <div class="card py-4 h-100">
            <div class="card-body text-center">
              <i class="fas fa-map-marked-alt text-primary mb-2"></i>
              <h4 class="text-uppercase m-0">Address</h4>
              <hr class="my-4">
              <div class="small text-black-50">Pirineos 51 int 13 parque Santiago, Querétaro , Qro, 76115</div>
            </div>
          </div>
        </div>

        <div class="col-md-4 mb-3 mb-md-0">
          <div class="card py-4 h-100">
            <div class="card-body text-center">
              <i class="fas fa-envelope text-primary mb-2"></i>
              <h4 class="text-uppercase m-0">Email</h4>
              <hr class="my-4">
              <div class="small text-black-50">
                <a href="#">productos@kraussmaffei.com</a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-4 mb-3 mb-md-0">
          <div class="card py-4 h-100">
            <div class="card-body text-center">
              <i class="fas fa-mobile-alt text-primary mb-2"></i>
              <h4 class="text-uppercase m-0">Phone</h4>
              <hr class="my-4">
              <div class="small text-black-50">+1 (555) 442 - 123 45 67</div>
            </div>
          </div>
        </div>
      </div>

      <div class="social d-flex justify-content-center">
        <a href="#" class="mx-2">
          <i class="fab fa-twitter"></i>
        </a>
        <a href="#" class="mx-2">
          <i class="fab fa-facebook-f"></i>
        </a>
        <a href="#" class="mx-2">
          <i class="fab fa-github"></i>
        </a>
      </div>

    </div>
  </section>



</body>

</html>