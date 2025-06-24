<?php
// Inclure le fichier de connexion
require_once '../config/database.php';

// Lire les données JSON brutes envoyées dans la requête
$data = json_decode(file_get_contents("php://input"));

// Vérifier que le champ 'title' est présent et non vide
if (!isset($data->title) || empty(trim($data->title))) {
    http_response_code(400); // Requête incorrecte
    echo json_encode(["message" => "Le champ 'title' est requis."]);
    exit;
}

// Nettoyer et récupérer le titre
$title = htmlspecialchars(strip_tags($data->title));

// Requête SQL pour insérer une nouvelle tâche
$query = "INSERT INTO tasks (title, done) VALUES (:title, 0)";
$stmt = $pdo->prepare($query);

// Lier la variable PHP à la requête
$stmt->bindParam(':title', $title, PDO::PARAM_STR);

// Exécuter et vérifier le résultat
if ($stmt->execute()) {
    http_response_code(201); // 201 = Créé
    echo json_encode(["message" => "Tâche créée avec succès."]);
} else {
    http_response_code(500); // Erreur serveur
    echo json_encode(["message" => "Impossible de créer la tâche."]);
}
?>
