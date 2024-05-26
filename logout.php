<?php
// Establece la cookie de sesión para que expire inmediatamente
setcookie('usuario', '', time() - 3600, '/');

// Redirige al usuario a la página de inicio de sesión u otra página según sea necesario
header('Location: index.php');
exit(); // Asegúrate de salir del script después de redirigir
?>