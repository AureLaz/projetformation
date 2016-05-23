<?php

/**
 * Lance la session si il n'y en a pas 
 */

if (!isset($_SESSION)) {
     session_start();
 }
if ($_SESSION['accesUtilisateur'] != "OPEN") {
    header("Location:index.php");
}

/**
 * Structure de l'interface utilisateur
 */

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>M2L Formation</title>
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="keywords" content="">
	<meta name="description" content="">
    <!--
	Workforce Template
	http://www.templatemo.com/free-website-templates/461-workforce
    -->
	<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="css/animate.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/templatemo-style.css">
</head>
<body data-spy="scroll" data-offset="50" data-target=".navbar-collapse">
	<div class="preloader">
		<div class="sk-spinner sk-spinner-rotating-plane"></div>
	</div>
	<nav class="navbar navbar-fixed-top custom-navbar" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="icon icon-bar"></span>
					<span class="icon icon-bar"></span>
					<span class="icon icon-bar"></span>
				</button>
				<a href="#" class=" custom-navbar"><img src="images/slider/LogoM2L.jpg" alt="Logo M2L" width="60px"></a>
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#home" class="smoothScroll">Accueil</a></li>
					<li><a href="#service" class="smoothScroll">Formations</a></li>
<!--					<li><a href="#about" class="smoothScroll">About</a></li>
					<li><a href="#portfolio" class="smoothScroll">Portfolio</a></li>
-->					<li><a href="#contact" class="smoothScroll">Contact</a></li>
<li><a href="index.php" class="smoothScroll">Se deconnecter</a></li>			</ul>
			</div>
		</div>
	</nav>
	<!-- start home -->
	<section id="home">
		<div class="overlay">
			<div class="flexslider">
				<ul class="slides">
					<li>
						<img src="images/slider/formation.jpg" alt="Slide 1">
						<div class="slider-caption">
							<div class="templatemo_homewrapper">
				<!--				<h3 class="wow bounceIn">web design and development</h3>		-->
								<h1 class="wow bounce">Bonjour <?php echo $_SESSION['prenom']; ?><h1>
								<h2>
									<span class="wow bounce" data-wow-delay="0.3s">Vous </span>
									<span class="wow bounce" data-wow-delay="0.6s">disposez de </span>
									<span class="wow bounce" data-wow-delay="0.9s"><?php echo $_SESSION['credit'];?> Points </span>
									<span class="wow bounce" data-wow-delay="0.9s"><br>et de <?php echo $_SESSION['jour'];?> jour(s) de formation</span>
								</h2>
					<!--			<a href="#portfolio" class="smoothScroll templatemo-slider-btn btn btn-default">Learn More</a>  -->
							</div>
						</div>
					</li>
				<!--	<li>
						<img src="images/slider/2.jpg" alt="Slide 2">
						<div class="slider-caption">
							<div class="templatemo_homewrapper">
                            	<h2>CSS Flexbox</h2>
								<h1>Flex Slider</h1>
								<h3>Work on all modern browsers, IE 10+</h3>
								<a href="#about" class="smoothScroll templatemo-slider-btn btn btn-default">Meet Our Team</a>
							</div>
						</div>
					</li>			-->
				</ul>
			</div>
		</div>
	</section>
	<!-- end home -->
	<!-- start service -->
	<section id="service">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center wow bounceIn">
					<h2>Les formations</h2>

					<hr>
					<h4>Choisissez votre/vos formation(s) <?php ?></h4>
				</div>
	
				<div>
				<table>
				<thead>
					<th class="black" style="text-align:center;width:20%;"> Date </th>
					<th class="black" style="text-align:center;width:20%;"> Libelle </th>
					<th class="black" style="text-align:center;width:20%;"> Duree </th>
					<th class="black" style="text-align:center;width:20%;"> Lieu </th>
					<th class="black" style="text-align:center;width:20%;"> Pre requis </th>
					<th class="black" style="text-align:center;width:20%;"> Formateur </th>
				</thead>
				<tbody>
				<?php
                include("DbFonctions.php");
                Tableau(); ?>
				</tbody>
				</table>


			</div>
		</div>
	</section>
	<section id="service">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center wow bounceIn">
					<h2>Confirmation des formations</h2>

					<hr>
					<h4>Formation validées<?php ?></h4>
				</div>

				<div >
				<table>
				<thead>
					<th class="black" style="text-align:center;width:20%;"> Date </th>
					<th class="black" style="text-align:center;width:20%;"> Libelle </th>
					<th class="black" style="text-align:center;width:20%;"> Duree </th>
					<th class="black" style="text-align:center;width:20%;"> Lieu </th>
					<th class="black" style="text-align:center;width:20%;"> Pre requis </th>
					<th class="black" style="text-align:center;width:20%;"> Formateur </th>
				</thead>
				<tbody>
				<?php
                 TableauConfirme()
                 ?>
				</tbody>
				</table>
			</div>
		</div>
	</section>
	<section id="contact">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="wow bounceIn">
						<h2 class="wow bounceIn">Contact</h2>
						<hr>
						<h4>Envoyez-nous un message pour plus d'aides...</h4>
					</div>
					<form action="#" method="post" role="form">
						<div class="col-md-4 col-sm-4 wow fadeIn" data-wow-delay="0.3s">
							<input type="text" placeholder="Nom" class="form-control">
						</div>
						<div class="col-md-4 col-sm-4 wow fadeIn" data-wow-delay="0.3s">
							<input type="email" placeholder="Email" class="form-control">
						</div>
						<div class="col-md-4 col-sm-4 wow fadeIn" data-wow-delay="0.3s">
							<input type="text" placeholder="Sujet" class="form-control">
						</div>
						<div class="col-md-12 col-sm-12 wow fadeIn" data-wow-delay="0.9s">
							<textarea class="form-control" rows="5" placeholder="Message"></textarea>
						</div>
						<div class="col-md-offset-3 col-sm-offset-3 col-sm-6 col-md-6 wow fadeIn" data-wow-delay="0.3s">
							<input type="submit" value="Envoyer Message" class="form-control">
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.flexslider.js"></script>
	<script src="js/isotope.js"></script>
	<script src="js/imagesloaded.min.js"></script>
	<script src="js/smoothscroll.js"></script>
	<script src="js/wow.min.js"></script>
	<script src="js/custom.js"></script>
</body>
</html>
