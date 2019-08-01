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
			<span class = "nav_header"><?php echo "Welcome: ".utf8_decode($_SESSION['usuario']);?></span>
			<input type = "submit" name = "logout" value = "logout">
			<?php
			if(isset($_POST["logout"])){
				header("Location: Logout.php");
			}
			?>
		</form>
	</header>
	
	<h1 class = "pag_tittle">Content</h1>
	<section class="leftColumn">
		<form id="industrialRobots" action="industrialRobots.html" method="post">
			<input type="image" src="pictures/industrialRobots.png" alt="industrial robot" height="200" width="200">
			<h3 class="titleParagraph">Industrial Robots</h3>
		</form>
		<form id="compactRobots" action="compactRobots.html" methode="post">
			<input type="image" src="pictures/compactRobots.png" alt="compact robot" height="200" width="240">
			<h3 class="titleParagraph">Compact Robots</h3>
		</form>
	</section>
	<section class="rightColumn">        
		<form id="spruePicker" action="spruePicker.html" methode="post">
			<input type="image" src="pictures/spruePicker.png" alt="sprue Picker" height="200" width="240">
			<h3 class="titleParagraph">Sprue Robots</h3>
		</form>
		<form id="linearRobots" action="linearRobots.html" methode="post">
			<input type="image" src="pictures/linearRobots.png" alt="linear Robots" height="200" width="240">
			<h3 class="titleParagraph">Linear Robots</h3>
		</form>
		</section>
	<footer id="footer"><h1>KraussMaffei</h1></footer>		
</body>

</html>