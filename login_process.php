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
$password = $bd->real_escape_string($_POST['password']);

// Consulta SQL para verificar las credenciales
$query = "SELECT * FROM users WHERE name = '$name' AND password = '$password'";
$resultado = $bd->query($query);

// Verificación de resultados
if ($resultado->num_rows > 0) {
    // Usuario autenticado correctamente, crear cookie
    setcookie("usuario", $name, time() + (86400 * 30), "/"); // Cookie válida por 30 días
    // Redireccionar al usuario a su página
    echo '<meta http-equiv="refresh" content="0; URL=index.php">';
    exit();

} else {
    echo '<script>alert("Credenciales incorrectas"); window.location = "login.php";</script>';
}

// Cerrar la conexión a la base de datos
$bd->close();
?>