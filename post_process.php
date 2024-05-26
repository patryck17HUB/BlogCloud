<?php
// Configuración de la base de datos de RDS
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

// Obtención de los datos del formulario
$title = $bd->real_escape_string($_POST['title']);
$topic = $bd->real_escape_string($_POST['topic']);
$content = $bd->real_escape_string($_POST['content']);
$name = $bd->real_escape_string($_POST['name']);


// Consulta SQL para insertar el nuevo usuario
$query_insert = "INSERT INTO posts (title, topic, content, autor) VALUES ('$title','$topic', '$content', '$name')";
$result_insert = $bd->query($query_insert);

// Verificación de resultados
if ($result_insert) {
    // Si la inserción fue exitosa, mostrar un mensaje de éxito
    echo '<script>alert("El post se ha publicado correctamente."); window.location = "crear_post.php";</script>';
    exit();
} else {
    // Si hubo un error en la inserción, mostrar un mensaje de error y redirigir al formulario de registro
    echo '<script>alert("Error al publicar el post."); window.location = "crear_post.php";</script>';
    exit();
}

// Cerrar la conexión a la base de datos
$bd->close();
?>
