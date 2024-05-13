<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root"; // Cambia esto al nombre de usuario de tu base de datos
$password = ""; // Cambia esto a la contraseña de tu base de datos
$dbname = "uaq";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtención de los datos del formulario
$EXP = $_POST['EXP'];
$NIP = $_POST['NIP'];


// Consulta a la base de datos
$sql = "SELECT * FROM user WHERE EXP = '$EXP' AND NIP = '$NIP'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    // Autenticación exitosa
    // Redirigir al usuario a la página de inicio (index.html)
    header("Location: index.html");
    exit();
} else {
    // Autenticación fallida
    echo "EXP o NIP incorrectos. Por favor, intente nuevamente.";
}

$conn->close();
?>
