<?php
require_once '../config/database.php';

// Lire les données JSON envoyées
$data = json_decode(file_get_contents("php://input"));

// Vérifie si l’ID est fourni
if (!isset($data->id)) {
    http_response_code(400); // Requête incorrecte
    echo json_encode(["message" => "L'ID de la tâche est requis."]);
    exit;
}

// Vérifie si au moins un champ est fourni à mettre à jour
if (!isset($data->title) && !isset($data->done)) {
    http_response_code(400);
    echo json_encode(["message" => "Aucune donnée à modifier n’a été fournie."]);
    exit;
}

$id = intval($data->id);
$title = isset($data->title) ? htmlspecialchars(strip_tags($data->title)) : null;
$done = isset($data->done) ? intval($data->done) : null;

// Construction dynamique de la requête
$fields = [];
if ($title !== null) $fields[] = "title = :title";
if ($done !== null) $fields[] = "done = :done";

$query = "UPDATE tasks SET " . implode(', ', $fields) . " WHERE id = :id";
$stmt = $pdo->prepare($query);

// Liaison des paramètres
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
if ($title !== null) $stmt->bindParam(':title', $title, PDO::PARAM_STR);
if ($done !== null) $stmt->bindParam(':done', $done, PDO::PARAM_INT);

// Exécution
if ($stmt->execute()) {
    http_response_code(200);
    echo json_encode(["message" => "Tâche mise à jour avec succès."]);
} else {
    http_response_code(500);
    echo json_encode(["message" => "Erreur lors de la mise à jour."]);
}
?>
