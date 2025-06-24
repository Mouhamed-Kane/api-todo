<?php
// Informations de connexion
$host = 'localhost';        // Adresse du serveur de base de données
$db_name = 'api_todo';      // Nom de la base créée
$username = 'root';         // Nom d’utilisateur (par défaut dans XAMPP)
$password = '';             // Mot de passe (vide par défaut)

// Connexion via PDO
try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$db_name;charset=utf8", // DSN
        $username,
        $password
    );

    // Active les erreurs en mode exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Affiche une erreur si la connexion échoue
    die("Erreur de connexion : " . $e->getMessage());
}
?>
