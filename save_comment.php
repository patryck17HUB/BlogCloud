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

$post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;
$comment = isset($_POST['content']) ? $_POST['content'] : '';
$id_comment = isset($_POST['parent_comment_id']) ? intval($_POST['parent_comment_id']) : NULL;

// Verificar si $id_comment es 0 y cambiarlo a NULL
if ($id_comment === 0) {
    $id_comment = NULL;
}

// Aquí deberías obtener el ID del usuario autenticado
$name = $bd->real_escape_string($_POST['name']);

$queryid = "SELECT id FROM users WHERE name = '$name'";
$result = $bd->query($queryid);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $user_id = $row['id'];
} else {
    die('Usuario no encontrado');
}

// Insertar el comentario en la base de datos
$query = "INSERT INTO comments (id_post, id_user, content, id_comment) VALUES (?, ?, ?, ?)";
$stmt = $bd->prepare($query);

if ($stmt === false) {
    die('Prepare failed: ' . htmlspecialchars($bd->error));
}

$stmt->bind_param("iisi", $post_id, $user_id, $comment, $id_comment);
$stmt->execute();

if ($stmt->error) {
    die('Execute failed: ' . htmlspecialchars($stmt->error));
}

$stmt->close();
$bd->close();

header("Location: post.php?id=$post_id");
exit();
?>