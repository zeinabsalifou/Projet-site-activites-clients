<?php

    header("Access-Control-Allow-Origin: *");
    
    // Paramètres de connexion à la base de données
    $host = 'localhost';
    $db = 'my_site_db';
    $user = 'root';
    $pass = '';


try {
    // Récupérer l'ID du client
    $client_id = isset($_GET['client_id']) ? (int)$_GET['client_id'] : 0;
    
    if ($client_id === 0) {
        echo json_encode(['error' => 'Client non valide']);
        exit;
    }

    // Connexion à la base de données avec PDO
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête pour récupérer les activités du client(jointure)
    $sql = "SELECT a.name, a.description, a.season 
            FROM Activity a
            JOIN Subscription s ON a.id = s.activity_id 
            WHERE s.client_id = :client_id";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':client_id', $client_id, PDO::PARAM_INT);
    $stmt->execute();

    // Récupérer les résultats
    $activities = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Retourner les données en JSON
    echo json_encode($activities);

} catch (PDOException $erreur) {
    echo json_encode(['error' => 'Erreur de connexion ou de requête : ' . $erreur->getMessage()]);
}

// Fermer la connexion
$pdo = null;
?>