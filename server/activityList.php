<?php
     
    header("Access-Control-Allow-Origin: *");
    
    // Connexion à la base de données (exemple avec MySQL)
    $host = 'localhost';
    $db = 'my_site_db';
    $user = 'root';
    $pass = '';
   

   try {
         $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
       $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête pour récupérer les activités
    $sql = "SELECT id, name, description, season FROM Activity"; // Remplacez "Activity" par le nom réel de votre table

    $stmt = $pdo->query($sql);

    // Récupérer les résultats sous forme de tableau associatif
    $activities = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Retourner les données en JSON
    echo json_encode($activities);

    } catch (PDOException $erreur) {
        // En cas d'erreur de connexion ou de requête
        echo json_encode(['error' => 'Erreur de connexion ou de requête : ' . $erreur->getMessage()]);
    }

// Fermer la connexion PDO
$pdo = null;


?>