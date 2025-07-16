<?php

require_once '../config/database.php';
// Accepter uniquement POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
http_response_code(405);
echo json_encode(["message" => "Méthode non autorisée."]);
exit;
}
$data = json_decode(file_get_contents("php://input"));
if (!isset($data->title) || trim($data->title) === "") {
http_response_code(400);
echo json_encode(["message" => "Le titre est requis."]);
exit;
}
$title = htmlspecialchars(strip_tags($data->title));
if (strlen($title) > 255) {
http_response_code(400);
echo json_encode(["message" => "Titre trop long."]);exit;
}
try {
$stmt = $pdo->prepare("INSERT INTO tasks (title) VALUES (:title)");
$stmt->bindParam(':title', $title, PDO::PARAM_STR);
if ($stmt->execute()) {
http_response_code(201); // Created
echo json_encode(["message" => "Tâche ajoutée avec succès."]);
} else {
throw new Exception("Erreur d'insertion.");
}
} catch (Exception $e) {
http_response_code(500);
echo json_encode(["message" => "Erreur serveur : " . $e->getMessage()]);
}

?>
