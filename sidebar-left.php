<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport"    content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author"      content="Sergey Pozhilov (GetTemplate.com)">
	
	<title>Left Sidebar | Initio - Free, multipurpose html5 template by GetTemplate</title>

	<link rel="shortcut icon" href="assets/images/gt_favicon.png">
	
	<!-- Bootstrap -->
	<link href="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.no-icons.min.css" rel="stylesheet">
	<!-- Icon font -->
	<link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
	<!-- Fonts -->
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Alice|Open+Sans:400,300,700">
	<!-- Custom styles -->
	<link rel="stylesheet" href="assets/css/styles.css">

	<!--[if lt IE 9]> <script src="assets/js/html5shiv.js"></script> <![endif]-->
</head>
<body>

<header id="header">
	<div id="head" class="parallax" parallax-speed="2">
		<h1 id="logo" class="text-center">
			<img class="img-circle" src="assets/images/LOGOUAQ.jpg" alt="">
			<span class="title">UAQ</span><br>
			<span class="title">Registro de materias</span>
			
			
		</h1>
	</div>

	<nav class="navbar navbar-default">
		<div class="container-fluid">
			
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
			</div>
			
			<div class="navbar-collapse collapse">
				
				<ul class="nav navbar-nav">
					<li><a href="index.html">Home</a></li>
					<li class="active"><a href="about.html">About</a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">More Pages <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="sidebar-left.html">Left Sidebar</a></li>
							<li><a href="sidebar-right.html">Right Sidebar</a></li>
							<li><a href="single.html">Blog Post</a></li>
						</ul>
					</li>
					<li><a href="blog.html">Blog</a></li>
				</ul>
			
			</div>			
		</div>	
	</nav>
</header>

<!-- MATERIAS Y ASI -->

<main id="main">

	<div class="container">
	
		<div class="row section recentworks topspace">
			
			<h2 class="section-title"><span>Materias</span></h2> <br>



	<?php
    // Establecer la conexión a la base de datos
    $conn = mysqli_connect('localhost', 'root', '', 'uaq');

    // Verificar si la conexión fue exitosa
    if (!$conn) {
        die('Error al conectar a la base de datos: ' . mysqli_connect_error());
    }

    // Obtener la lista de materias de la base de datos
    $query = "SELECT * FROM materias";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        echo "<ul>";
        while ($row = mysqli_fetch_assoc($result)) {
            $materiaId = $row['id_M'];
            $nombreMateria = $row['nombre'];
			$semestre = $row['sem'];
			$creditos = $row['creditos'];

            echo "<li>  $materiaId   $nombreMateria   $semestre    $creditos <button onclick=\"borrarMateria($materiaId)\">Eliminar</button></li>";
			echo "<br>";
        }
        echo "</ul>";
    } else {
        echo "No se encontraron materias.";
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conn);
    ?>

			
			
		</div> 

	</div>	
	
</main>

<footer id="footer" class="topspace">
	<div class="container">
		<div class="row">
			<div class="col-md-3 widget">
				<h3 class="widget-title">Contact</h3>
				<div class="widget-body">
					<p>+234 23 9873237<br>
						<a href="mailto:#">some.email@somewhere.com</a><br>
						<br>
						234 Hidden Pond Road, Ashland City, TN 37015
					</p>	
				</div>
			</div>

			<div class="col-md-3 widget">
				<h3 class="widget-title">Follow me</h3>
				<div class="widget-body">
					<p class="follow-me-icons">
						<a href=""><i class="fa fa-twitter fa-2"></i></a>
						<a href=""><i class="fa fa-dribbble fa-2"></i></a>
						<a href=""><i class="fa fa-github fa-2"></i></a>
						<a href=""><i class="fa fa-facebook fa-2"></i></a>
					</p>
				</div>
			</div>

			<div class="col-md-3 widget">
				<h3 class="widget-title">Text widget</h3>
				<div class="widget-body">
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque, nihil natus explicabo ipsum quia iste aliquid repellat eveniet velit ipsa sunt libero sed aperiam id soluta officia asperiores adipisci maxime!</p>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque, nihil natus explicabo ipsum quia iste aliquid repellat eveniet velit ipsa sunt libero sed aperiam id soluta officia asperiores adipisci maxime!</p>
				</div>
			</div>

			<div class="col-md-3 widget">
				<h3 class="widget-title">Form widget</h3>
				<div class="widget-body">
					<p>+234 23 9873237<br>
						<a href="mailto:#">some.email@somewhere.com</a><br>
						<br>
						234 Hidden Pond Road, Ashland City, TN 37015
					</p>	
				</div>
			</div>

		</div> <!-- /row of widgets -->
	</div>
</footer>

<footer id="underfooter">
	<div class="container">
		<div class="row">
			
			<div class="col-md-6 widget">
				<div class="widget-body">
					<p>234 Hidden Pond Road, Ashland City, TN 37015 </p>
				</div>
			</div>

			<div class="col-md-6 widget">
				<div class="widget-body">
					<p class="text-right">
						Copyright &copy; 2014, Your awesome name here<br> 
						Design: <a href="http://www.gettemplate.com" rel="designer">Initio by GetTemplate</a> </p>
				</div>
			</div>

		</div> <!-- /row of widgets -->
	</div>
</footer>



<!-- JavaScript libs are placed at the end of the document so the pages load faster -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="assets/js/template.js"></script>
</body>
</html>
