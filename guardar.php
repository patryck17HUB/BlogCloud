
<?php
$bd = new mysqli("localhost", "root", "", "uaq");

$materiaId = $_POST['id_M'];
$nombreMateria = $_POST['nombre'];
$semestre = $_POST['sem'];
$creditos = $_POST['creditos'];

$queryInsert = "INSERT INTO materiasr (id_M, nombre, sem, creditos) VALUES ($materiaId, '$nombreMateria', $semestre, $creditos)";
$resultadoInsert = mysqli_query($bd, $queryInsert);

$queryDelete = "DELETE FROM `materias` WHERE id_M = $materiaId";
$resultadoDelete = mysqli_query($bd, $queryDelete);

if ($resultadoInsert && $resultadoDelete) {
    header("Location: materias.php");
    exit;
} else {
    echo "Error al guardar la materia.";
}
?>