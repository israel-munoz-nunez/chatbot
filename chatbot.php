<?php
// API de OpenAI
$api_key = "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";

// Leer la documentación
$documentacion = file_get_contents("documentacion.txt");
$documentacion = substr($documentacion, 0, 8000); // límite de tokens

$mensaje_usuario = $_POST["mensaje"] ?? "";

$instruccion = [
    "role" => "system",
    "content" => "Eres un asistente que solo puede responder preguntas basándose en la siguiente documentación:\n\n$documentacion\n\nSi te hacen una pregunta que no esté cubierta, responde: \"Lo siento, no puedo responder esa pregunta, ¿tienes alguna duda respecto a SOTF?\""
];

$mensaje = [
    "role" => "user",
    "content" => $mensaje_usuario
];

$data = [
    "model" => "gpt-3.5-turbo",
    "messages" => [$instruccion, $mensaje],
    "temperature" => 0.5,
    "max_tokens" => 800
];

$ch = curl_init("https://api.openai.com/v1/chat/completions");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "Authorization: Bearer $api_key"
]);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

$result = curl_exec($ch);
curl_close($ch);

$response = json_decode($result, true);
echo $response["choices"][0]["message"]["content"] ?? "Error al obtener respuesta de OpenAI.";
?>
