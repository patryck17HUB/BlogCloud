<?php
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

// Obtener el ID del post a borrar desde la URL
$post_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Desactivar las restricciones de clave foránea
$bd->query("SET FOREIGN_KEY_CHECKS = 0");

// Borrar todos los comentarios asociados con el post
$borrar_comentarios = "DELETE FROM comments WHERE id_post = $post_id";
$bd->query($borrar_comentarios);

// Realizar la consulta para borrar el post
$borrar_query = "DELETE FROM posts WHERE id = $post_id";
if ($bd->query($borrar_query) === TRUE) {
    // Reactivar las restricciones de clave foránea
    $bd->query("SET FOREIGN_KEY_CHECKS = 1");

    // Redireccionar al usuario a la página de inicio o a otra página
    header("Location: index.php");
    exit();
} else {
    echo "Error al borrar el post: " . $bd->error;

    // Reactivar las restricciones de clave foránea incluso si hay un error
    $bd->query("SET FOREIGN_KEY_CHECKS = 1");
}

// Cerrar la conexión a la base de datos
$bd->close();
?>
