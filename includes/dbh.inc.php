<?php
//Connexion à la base de données MySQL
$dsn = "mysql:host=localhost;dbname=sport_babi_db";
$dbusername = "root";
$dbpassword = "";

try {
     // Création d'une instance de la classe PDO pour établir la connexion
    $pdo = new PDO($dsn, $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
     // Gestion des erreurs de connexion : affichage d'un message explicite
    echo "Erreur de connexion: " . $e->getMessage();
}

?>