<?php
// Inclure la connexion à la base de données
require_once '../config/database.php';

// Préparer une requête SQL pour récupérer toutes les tâches
$query = "SELECT * FROM tasks";

// Exécuter la requête SQL via PDO
$stmt = $pdo->prepare($query);
$stmt->execute();

// Récupérer les résultats sous forme de tableau associatif
$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Spécifier le format de réponse HTTP en JSON
header('Content-Type: application/json');

// Retourner les données au client sous forme JSON
echo json_encode($tasks);
?>
