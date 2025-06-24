<?php
// Connexion à la base
require_once '../config/database.php';

// Lire les données JSON envoyées
$data = json_decode(file_get_contents("php://input"));

// Vérifier que l'ID est fourni
if (!isset($data->id)) {
    http_response_code(400);
    echo json_encode(["message" => "L'identifiant de la tâche est requis."]);
    exit;
}

$id = intval($data->id);

// Vérifier si la tâche existe
$check = $pdo->prepare("SELECT id FROM tasks WHERE id = :id");
$check->bindParam(':id', $id, PDO::PARAM_INT);
$check->execute();

if ($check->rowCount() === 0) {
    http_response_code(404); // Not Found
    echo json_encode(["message" => "Tâche non trouvée."]);
    exit;
}

// Supprimer la tâche
$stmt = $pdo->prepare("DELETE FROM tasks WHERE id = :id");
$stmt->bindParam(':id', $id, PDO::PARAM_INT);

if ($stmt->execute()) {
    http_response_code(200); // OK
    echo json_encode(["message" => "Tâche supprimée avec succès."]);
} else {
    http_response_code(500); // Erreur interne serveur
    echo json_encode(["message" => "Erreur lors de la suppression."]);
}
?>
