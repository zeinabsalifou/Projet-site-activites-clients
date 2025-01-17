<?php
     
    header("Access-Control-Allow-Origin: *");
    
    // Connexion à la base de données (exemple avec MySQL)
    $host = 'localhost';
    $db = 'my_site_db';
    $user = 'root';
    $pass = '';
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);

   try {
        // Création de la connexion PDO
        $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
        
        // Configuration pour lancer les exceptions en cas d'erreur
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Requête SQL pour récupérer les clients
        $sql = "SELECT id, firstname, lastname, sex, age, email FROM Client";
        
        // Exécution de la requête
        $stmt = $pdo->query($sql);
        
        // Récupérer tous les résultats sous forme de tableau associatif
        $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Si des clients sont trouvés, les envoyer sous forme de JSON
        if ($clients) {
            echo json_encode($clients);
        } else {
            echo json_encode([]);  // Retourner un tableau vide si aucun client trouvé
        }

    } catch (PDOException $e) {
        // En cas d'erreur de connexion ou de requête
        echo json_encode(['error' => 'Erreur de connexion ou de requête : ' . $e->getMessage()]);
    }

// Fermer la connexion PDO
$pdo = null;


?>