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

// Obtener el ID del post desde la URL
$post_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$query = "SELECT p.title, p.content, p.id, u.name as author_name, u.avatar_url as author_avatar FROM posts p 
          JOIN users u ON p.autor = u.name WHERE p.id = $post_id";
$resultado = $bd->query($query);

if ($resultado->num_rows > 0) {
    $row = $resultado->fetch_assoc();
    $title = $row['title'];
    $content = $row['content'];
    $autor = $row['author_name'];
    $autor_avatar = $row['author_avatar'];
} else {
    echo "Post no encontrado";
    exit();
}

// Obtener los comentarios del post actual
$comments_query = "SELECT c.id, c.content, u.name as author, u.avatar_url as author_avatar FROM comments c 
                   JOIN users u ON c.id_user = u.id WHERE c.id_post = $post_id AND c.id_comment IS NULL";
$comments_result = $bd->query($comments_query);

$comments = [];
if ($comments_result->num_rows > 0) {
    while ($comment_row = $comments_result->fetch_assoc()) {
        $comments[] = $comment_row;
    }
}

// Obtener las réplicas de los comentarios
$replies_query = "SELECT c.id, c.content, u.name as author, c.id_comment, u.avatar_url as author_avatar FROM comments c 
                  JOIN users u ON c.id_user = u.id WHERE c.id_post = $post_id AND c.id_comment IS NOT NULL";
$replies_result = $bd->query($replies_query);

$replies = [];
if ($replies_result->num_rows > 0) {
    while ($reply_row = $replies_result->fetch_assoc()) {
        $replies[$reply_row['id_comment']][] = $reply_row;
    }
}



$bd->close();
?>
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

    <main id="main">
        <div class="container">
            <!-- Detalles del post -->
            <div class="row section recentworks topspace">
                <!-- Contenido del post -->
                <div class="col-sm-8 col-sm-offset-2">
                    <article class="post">
                        <!-- Cabecera del post -->
                        <header class="entry-header">
                            <div class="entry-meta">
                                <!-- Avatar y autor -->
                                <img src="<?php echo $autor_avatar; ?>" alt="Avatar" class="avatar">
                                <span class="posted-on"><time class="entry-date published">Publicado por <?php echo $autor; ?></time></span>
                            </div>
                            <!-- Título del post -->
                            <h1 class="entry-title"><?php echo $title; ?></h1>
                        </header>
                        <!-- Contenido del post -->
                        <div class="entry-content">
                            <p><?php echo $content; ?></p>
                        </div>
                    </article>
                </div>
            </div>
                        <!-- Sección de comentarios -->
                        <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                <?php if (isset($_COOKIE['usuario'])): ?>
                    <!-- Formulario para dejar un comentario -->
                    <div id="respond">
                        <h3 id="reply-title">Deja un Comentario</h3>
                        <form action="save_comment.php" method="post" id="commentform" class="">
                            <input type="hidden" name="name" value="<?php echo $_COOKIE['usuario']; ?>">
                            <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                            <input type="hidden" name="parent_comment_id" id="parent_comment_id" value='0'>
                            <div class="form-group">
                                <textarea class="form-control" name="content" id="inputComment" rows="4"></textarea>
                            </div>
                            <button type="submit" class="btn btn-action">Enviar</button>
                        </form>
                    </div>
                <?php else: ?>
                    <p> Inicie sesión para unirte a la conversación </p>
                <?php endif; ?>
                    <!-- Comentarios -->
                    <div id="comments">    
                        <!-- Lista de comentarios -->
                        <ol class="comments-list">
                            <?php foreach ($comments as $comment): ?>
                                <li class="comment" id="comment-<?php echo $comment['id']; ?>">
                                    <div>
                                        <!-- Avatar del autor del comentario -->
                                        <img src="<?php echo $comment['author_avatar']; ?>" alt="Avatar" class="avatar">
                                        <div class="comment-meta">
                                        </div>
                                        <div class="comment-meta">
                                            <span class="author"><?php echo $comment['author']; ?></span>
                                            <?php if (isset($_COOKIE['usuario'])): ?>
                                                <span class="reply"><a href="#" class="reply-link" data-comment-id="<?php echo $comment['id']; ?>">Responder</a></span>
                                            <?php endif; ?>
                                        </div>
                                        <!-- Contenido del comentario -->
                                        <div class="comment-body">
                                            <?php echo $comment['content']; ?>
                                        </div>
                                    </div>
                                    <!-- Respuestas a este comentario -->
                                    <?php if (isset($replies[$comment['id']])): ?>
                                        <ul class="children">
                                            <?php foreach ($replies[$comment['id']] as $reply): ?>
                                                <li class="comment" id="comment-<?php echo $reply['id']; ?>">
                                                    <div>
                                                        <!-- Avatar del autor de la respuesta -->
                                                        <img src="<?php echo $reply['author_avatar']; ?>" alt="Avatar" class="avatar">
                                                        <div class="comment-meta">
                                                            <!-- Nombre del autor -->
                                                            <span class="author"><?php echo $reply['author']; ?></span>
                                                        </div>
                                                        <!-- Contenido de la respuesta -->
                                                        <div class="comment-body">
                                                            <?php echo $reply['content']; ?>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ol>
                        <!-- Fin de la lista de comentarios -->
                    </div>
                    <!-- Formulario de comentarios -->
                    <!-- Fin de la sección de comentarios -->
					
					<div class="clearfix"></div>

					<nav id="comment-nav-below" class="comment-navigation clearfix" role="navigation"><div class="nav-content">


					
				</div>
			</div>
		</div> <!-- /row comments -->

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
                        <p>Universidad Autónoma de Querétaro</p>
                    </div>
                </div>
                <div class="col-md-6 widget">
                    <div class="widget-body">
                        <p class="text-right">
                            Copyright &copy; 2023, Diego Pescador
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src="assets/js/template.js"></script>
    <script>
    // Manejar el evento de clic en el enlace "Responder"
    $(document).on('click', '.reply-link', function(e) {
        e.preventDefault();
        var commentId = $(this).data('comment-id');
        console.log('Se hizo clic en el enlace "Responder". ID del comentario:', commentId);
        
        // Eliminar cualquier formulario de respuesta existente
        $('.reply-form').remove();

        // Crear el formulario de respuesta
        var replyForm = `
            <div class="reply-form">
                <form action="save_comment.php" method="post" class="commentform">
                    <input type="hidden" name="name" value="<?php echo $_COOKIE['usuario']; ?>">
                    <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                    <input type="hidden" name="parent_comment_id" value="` + commentId + `">
                    <div class="form-group">
                        <label for="inputReplyComment">Respuesta</label>
                        <textarea class="form-control" name="content" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-action">Enviar</button>
                </form>
            </div>
        `;

        // Insertar el formulario de respuesta justo debajo del comentario correspondiente
        $('#comment-' + commentId).append(replyForm);
    });
</script>
</body>
</html>
