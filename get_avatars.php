<?php
// Configuración de AWS S3
$bucketName = 'cloudbucketblog';
$region = 'us-east-1';

// Crear la URL para listar objetos
$url = "https://{$bucketName}.s3.amazonaws.com/?list-type=2";

// Inicializar cURL
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Ejecutar la solicitud cURL
$response = curl_exec($ch);

// Verificar si hubo un error
if ($response === false) {
    http_response_code(500);
    echo json_encode(['error' => 'Error al obtener la lista de avatares.']);
    exit();
}

// Cerrar cURL
curl_close($ch);

// Agregar un mensaje de depuración para la respuesta
error_log("S3 response: $response");

// Cargar la respuesta XML
$xml = simplexml_load_string($response);

// Verificar si la carga del XML fue exitosa
if ($xml === false) {
    http_response_code(500);
    echo json_encode(['error' => 'Error al analizar la respuesta XML de S3.']);
    exit();
}

// Agregar un mensaje de depuración para el contenido del XML
error_log("XML contents: " . print_r($xml, true));

// Convertir el XML en un array de URLs de avatares
$avatarUrls = [];
foreach ($xml->Contents as $content) {
    $key = (string) $content->Key;

    $avatarUrls[] = ['url' => "https://{$bucketName}.s3.amazonaws.com/{$key}"];
}

// Agregar un mensaje de depuración para los URLs obtenidos
error_log("Avatar URLs: " . print_r($avatarUrls, true));

// Devolver el array en formato JSON
header('Content-Type: application/json');
echo json_encode($avatarUrls);
?>
