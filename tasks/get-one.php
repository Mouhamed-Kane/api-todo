<?php
require_once '../config/database.php'; // Connexion à la base

// Vérifie si un ID est présent dans l'URL
if (!isset($_GET['id'])) {
    http_response_code(400); // Erreur 400 = requête incorrecte
    echo json_encode(["message" => "ID manquant"]);
    exit;
}

$id = intval($_GET['id']); // Sécurise et convertit l'ID en entier

// Préparer la requête
$query = "SELECT * FROM tasks WHERE id = :id";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':id', $id, PDO::PARAM_INT); // Liaison du paramètre :id avec la variable $id
$stmt->execute();

$task = $stmt->fetch(PDO::FETCH_ASSOC); // Récupère une seule ligne

header('Content-Type: application/json');

if ($task) {
    echo json_encode($task);
} else {
    http_response_code(404); // 404 = Non trouvé
    echo json_encode(["message" => "Tâche non trouvée"]);
}
?>
