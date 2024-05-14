<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="Sergey Pozhilov (GetTemplate.com)">
	
	<title>Registro de materias</title>

	<link rel="shortcut icon" href="assets/images/LOGOUAQ.jpg">
	
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
			<span class="title">EZSport</span><br>
			<span class="title">Bicep</span>
		</h1>
	</div>

	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			
			<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
					
					<li class="active"><a href="index.html">Home</a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Materias<b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="materias.php">Registro</a></li>
							<li><a href="rmaterias.php">Consulta escolar</a></li>
							
						</ul>
					</li>
					<li><a href="about.html">Datos</a></li>
					
				</ul>
			</div>			
		</div>	
	</nav>
</header>

<!-- MATERIAS Y ASI -->

<main id="main">
	<div class="container">
		<div class="row section recentworks topspace">
			<h2 class="section-title"><span>Materias</span></h2><br>
			<!-- INICIO PHP -->
			<?php
			$conn = mysqli_connect('localhost', 'root', '', 'uaq');

			if (!$conn) {
				die('Error al conectar a la base de datos: ' . mysqli_connect_error());
			}

			$query = "SELECT * FROM materias";
			$result = mysqli_query($conn, $query);

			echo "
			<style>
				#mates {
					margin: 0 auto;
				}

				#mates td,
				#mates th {
					padding: 10px;
				}

				button {
					border: none;
					border-radius: 50px;
					padding: 10px 20px;
					background-color: #4CAF50;
					color: #ffffff;
					cursor: pointer;
				}

				button:hover {
					background-color: #45a049;
				}
			</style>

			<div class='uwu'>
				<table id='mates'>
					<tr>
						<th>ID</th>
						<th>Nombre</th>
						<th>Semestre</th>
						<th>Creditos</th>
						<th>---</th>
					</tr>";

			if (mysqli_num_rows($result) > 0) {
				echo "<ul>";
				while ($row = mysqli_fetch_assoc($result)) {
					$materiaId = $row['id_M'];
					$nombreMateria = $row['nombre'];
					$semestre = $row['sem'];
					$creditos = $row['creditos'];

					echo "
					<form action='guardar.php' method='POST'>
						<tr>
							<td>$materiaId </td>
							<td>$nombreMateria</td>
							<td>$semestre</td>
							<td>$creditos</td>
							<td>
								<input type='hidden' name='id_M' value='$materiaId'>
								<input type='hidden' name='nombre' value='$nombreMateria'>
								<input type='hidden' name='sem' value='$semestre'>
								<input type='hidden' name='creditos' value='$creditos'>
								<button type='submit'>Registrar</button>
							</td>
						</tr>
					</form>";
				}
				echo "</ul>";
			} else {
				echo "No se encontraron materias.";
			}

			echo "</table></div>";

			mysqli_close($conn);
			?>
		</div>
	</div>
</main>

<footer id="footer">
	<div class="container">
		
	</div>
</footer>

<footer id="underfooter">
	<div class="container">
		<div class="row">
			
			<div class="col-md-6 widget">
				<div class="widget-body">
					<p>Universidad Autonoma de Queretaro</p>
				</div>
			</div>

			<div class="col-md-6 widget">
				<div class="widget-body">
					<p class="text-right">
						Copyright &copy; 2023, Diego Pescador<br> 
						 </p>
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