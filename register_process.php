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
$name = $bd->real_escape_string($_POST['name']);
$mail = $bd->real_escape_string($_POST['mail']);
$password = $bd->real_escape_string($_POST['password']);

// Consulta SQL para verificar si el nombre de usuario ya existe
$query_check = "SELECT * FROM users WHERE name = '$name'";
$result_check = $bd->query($query_check);

if ($result_check && $result_check->num_rows > 0) {
    // Si el nombre de usuario ya existe, mostrar un mensaje de error y redirigir al formulario de registro
    echo '<script>alert("El nombre de usuario ya está en uso"); window.location = "register.php";</script>';
    exit();
}

// Consulta SQL para verificar si el CORREO de usuario ya existe
$query_check = "SELECT * FROM users WHERE mail = '$mail'";
$result_check = $bd->query($query_check);

if ($result_check && $result_check->num_rows > 0) {
    // Si el nombre de usuario ya existe, mostrar un mensaje de error y redirigir al formulario de registro
    echo '<script>alert("Ya hay una cuenta asociada a ese correo"); window.location = "register.php";</script>';
    exit();
}

// Consulta SQL para insertar el nuevo usuario
$query_insert = "INSERT INTO users (name, mail, password, admin) VALUES ('$name','$mail', '$password', '0')";
$result_insert = $bd->query($query_insert);

// Verificación de resultados
if ($result_insert) {
    // Si la inserción fue exitosa, crear cookie y redireccionar al usuario a su página
    setcookie("usuario", $name, time() + (86400 * 30), "/"); // Cookie válida por 30 días
    echo '<meta http-equiv="refresh" content="0; URL=index.php">';
    exit();
} else {
    // Si hubo un error en la inserción, mostrar un mensaje de error y redirigir al formulario de registro
    echo '<script>alert("Error al registrar el usuario"); window.location = "register.php";</script>';
    exit();
}

// Cerrar la conexión a la base de datos
$bd->close();
?>
