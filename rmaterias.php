<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport"    content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author"      content="Sergey Pozhilov (GetTemplate.com)">
	
	<title>Right Sidebar | Initio - Free, multipurpose html5 template by GetTemplate</title>

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
			<span class="title">UAQ</span><br>
			<span class="title">Consulta de Materias</span>
			
			
		</h1>
	</div>

	<nav class="navbar navbar-default">
		<div class="container-fluid">
			
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
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

<main id="main">

	<div class="container">

		<div class="row topspace">
	
		<h2 class="section-title"><span>Materias Registradas</span></h2> <br>
	
	<!-- INICIO PHP -->	
	<?php
    $conn = mysqli_connect('localhost', 'root', '', 'uaq');

    if (!$conn) {
        die('Error al conectar a la base de datos: ' . mysqli_connect_error());
    }

    $query = "SELECT * FROM materiasr";
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
  </style>
	<table id='mates'>
	<tr> 
	<th>ID</th>
	<th>Nombre</th>
	<th>Semestre</th>
	<th>Creditos</th>
	</tr>";
	

    if (mysqli_num_rows($result) > 0) {
        echo "<ul>";
        while ($row = mysqli_fetch_assoc($result)) {
            $materiaId = $row['id_M'];
            $nombreMateria = $row['nombre'];
			$semestre = $row['sem'];
			$creditos = $row['creditos'];
			
			echo "
				<tr> 
				<td>$materiaId </td>
				<td>$nombreMateria</td>
				<td>$semestre</td>
				<td>$creditos</td>
				</tr>
				";
				
        }
        echo "</ul>";
    } else {
        echo "No se encontraron materias.";
    }

	echo "</table>";
	
    mysqli_close($conn);
    ?>
			
		</div>
	</div>	<!-- /container -->
	
</main>

<footer id="footer" class="topspace">
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
