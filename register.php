<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="Sergey Pozhilov (GetTemplate.com)">
	
	<title>Initio - Free, multipurpose html5 template by GetTemplate</title>

	<link rel="shortcut icon" href="assets/images/LOGOUAQ.jpg">
	
	<!-- Bootstrap -->
	<link href="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.no-icons.min.css" rel="stylesheet">
	<!-- Icons -->
	<link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
	<!-- Fonts -->
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Alice|Open+Sans:400,300,700">
	<!-- Custom styles -->
	<link rel="stylesheet" href="assets/css/styles.css">

	<!--[if lt IE 9]> <script src="assets/js/html5shiv.js"></script> <![endif]-->
</head>
<body class="home">

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
					<li class="login-item"><a href="login.php">Login</a></li>
				</ul>
			</div><!--/.nav-collapse -->			
		</div>	
	</nav>
</header>

<main id="main">

	<div class="container">
	
		<div class="row section recentworks topspace">
			
			<h2 class="section-title"><span>Registrar</span></h2>
			
			<div class="container">
				<div class="row topspace">
					<div class="col-sm-8 col-sm-offset-2">

                    <div class="login-container">
						
                    <form action="post_process.php" method="POST">
                        <div class="form-group">
                            <label for="name">Nombre de usuario</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Ingresa tu nombre de usuario" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Correo electrónico</label>
                            <input type="email" class="form-control" id="mail" name="mail" placeholder="Ingresa tu correo electrónico" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Ingresa tu contraseña" required>
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirmar contraseña</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirma tu contraseña" required>
                            <p id="passwordError" class="text-danger"></p>
                        </div>
                        <button id="registerButton" type="submit" class="btn btn-primary">Registrarse</button>
                    </form>
					
                    </div>
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
<script>
$(document).ready(function() {
    $('#confirm_password').on('keyup', function () {
        if ($('#password').val() == $('#confirm_password').val()) {
            $('#passwordError').html('');
            $('#registerButton').prop('disabled', false);
        } else {
            $('#passwordError').html('Las contraseñas no coinciden');
            $('#registerButton').prop('disabled', true);
        }
    });
});
</script>
</body>
</html>
