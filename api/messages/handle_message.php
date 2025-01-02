<?php
// api/messages/handle_message.php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require '../../db/conn.php';

// Check connection
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["success" => false, "message" => "Connessione al database fallita."]);
    exit();
}

// Get the JSON input
$data = json_decode(file_get_contents("php://input"), true);

// Validate required fields
if (
    empty($data['name']) ||
    empty($data['email']) ||
    empty($data['phone'])
) {
    http_response_code(400);
    echo json_encode(["success" => false, "message" => "Dati richiesti mancanti."]);
    exit();
}

$name = $conn->real_escape_string($data['name']);
$email = $conn->real_escape_string($data['email']);
$phone = $conn->real_escape_string($data['phone']);
$message = isset($data['message']) ? $conn->real_escape_string($data['message']) : null;

// Prepare the SQL statement
$stmt = $conn->prepare("INSERT INTO contacts (name, email, phone, message, sent_at) VALUES (?, ?, ?, ?, NOW())");
$stmt->bind_param("ssss", $name, $email, $phone, $message);

// Execute the query
if ($stmt->execute()) {
    http_response_code(200);
    echo json_encode(["success" => true, "message" => "Messaggio inviato con successo."]);
} else {
    http_response_code(500);
    echo json_encode(["success" => false, "message" => "Errore nell'invio del messaggio."]);
}

$stmt->close();
$conn->close();
