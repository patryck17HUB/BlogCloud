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
			<span class="title">Ejercicios</span>
		</h1>
	</div>

	<nav class="navbar navbar-default navbar-sticky">
		<div class="container-fluid">
			
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> 
					<span class="sr-only">Toggle navigation</span> 
					<span class="icon-bar"></span> 
					<span class="icon-bar"></span> 
					<span class="icon-bar"></span> 
				</button>
			</div>
			
			<div class="navbar-collapse collapse" id="bs-example-navbar-collapse-1">
				
				<ul class="nav navbar-nav">
					<li class="active"><a href="index.php">Inicio</a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Temas<b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="TrenSuperior.php">Tren Superior</a></li>
							<li><a href="TrenInferior.php">Tren Inferior</a></li>
						</ul>
					</li>
					<?php
					// Verificar si el usuario está autenticado
					if (isset($_COOKIE['usuario'])) {
						// Conexión a la base de datos
						$host = "cloudblogdb.c7jstvu3n7sx.us-east-1.rds.amazonaws.com";
						$usuario = "admin";
						$contrasena = "12345678";
						$base_de_datos = "CloudBlog";

						$bd = new mysqli($host, $usuario, $contrasena, $base_de_datos);

						// Verificación de conexión
						if ($bd->connect_error) {
							die("Conexión fallida: " . $bd->connect_error);
						}

						// Obtener el tipo de usuario
						$name = $_COOKIE['usuario'];
						$query = "SELECT admin FROM users WHERE name = '$name'";
						$resultado = $bd->query($query);

						// Verificar si se encontró el usuario
						if ($resultado->num_rows > 0) {
							$fila = $resultado->fetch_assoc();
							$admin = $fila['admin'];

							// Mostrar el botón "Crear Post" solo si el usuario es administrador
							if ($admin == 1) {
								echo '<li><a href="crear_post.php">Crear Post</a></li>';
							}
						}

						// Cerrar la conexión a la base de datos
						$bd->close();
					}
					?>
					<?php
                    // Verificar si el usuario está autenticado
                    if (isset($_COOKIE['usuario'])) {
                        // Si está autenticado, mostrar el botón de Logout
                        echo '<li class="login-item"><a href="logout.php">Logout</a></li>';
                    } else {
                        // Si no está autenticado, mostrar el botón de Login
                        echo '<li class="login-item"><a href="login.php">Login</a></li>';
                    }
                	?>
				</ul>
			</div><!--/.nav-collapse -->			
		</div>	
	</nav>
</header>

<!-- MATERIAS Y ASI -->

<main id="main">
	<div class="container">
		<div class="row section recentworks topspace">
			<h2 class="section-title"><span>Tren Superior</span></h2><br>
				<div class="container">
					<div class="row topspace">
						<div class="col-sm-8 col-sm-offset-2">
							<!-- INICIO PHP -->
							<?php
								$host = "cloudblogdb.c7jstvu3n7sx.us-east-1.rds.amazonaws.com";
								$usuario = "admin";
								$contrasena = "12345678";
								$base_de_datos = "CloudBlog";

								// Conexión a la base de datos
								$bd = new mysqli($host, $usuario, $contrasena, $base_de_datos);

								// Verificación de conexión
								if ($bd->connect_error) {
									die("Conexión fallida: " . $bd->connect_error);
								}

								$query = "SELECT p.title, p.content, p.id, u.name as author_name, u.avatar_url as author_avatar FROM posts p 
									JOIN users u ON p.autor = u.name WHERE p.topic = 'tren_superior'";
								$resultado = $bd->query($query);

								if ($resultado->num_rows > 0) {

									while ($row = $resultado->fetch_assoc()) {
										$postId = $row['id'];
										$title = $row['title'];
										$content = $row['content'];
										$autor = $row['author_name'];
										$autor_avatar = $row['author_avatar'];

										echo "
											<article class='post'>
											<header class='entry-header'>
												<div class='entry-meta'> 
													<img src='$autor_avatar' alt='Avatar' class='avatar'>
													<span class='posted-on'><time class='entry-date published'>Publicado por $autor</span>            
												</div>
												<h1 class='entry-title'><a href='post.php?id=$postId' rel='bookmark'>$title</a></h1>
											</header>
											<div class='entry-content'>
												<p>$content</p>
											</div>
										</article>";
									}
									echo '</div>';
								} else {
									echo "Parece que no hay ningún post aún";
								}

								$bd->close();
							?>
						</div>
					</div>
				</div>
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