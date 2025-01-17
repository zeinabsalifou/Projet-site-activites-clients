<?php
    

    header("Access-Control-Allow-Origin: *");
    
    // Connexion à la base de données (exemple avec MySQL)
    $host = 'localhost';
    $db = 'my_site_db';
    $user = 'root';
    $pass = '';
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);

     // Check if the form is submitted
     if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        
        // recupération de donéés
        $name = $_POST['name'];
        $description = $_POST['description'];
        $season = $_POST['season'];
        
        
        try {

            // connexion a la base de données
            $connect = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
            
          
            // Configuration pour utiliser les exceptions
            $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // preparation de la requete
            $stmt = $connect->prepare("INSERT INTO activity (name, description, season) VALUES (:name, :description, :season)");

            // Liaison des paramàtre
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':season', $season);

            // Exécuter la requête
            if ($stmt->execute()) {
                echo json_encode(['status' => 'success', 'message' => 'L\'activité a été enregistrée avec succès.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Erreur lors de l\'enregistrement de l\'activité.']);
            }

        }
        catch (PDOException $e) {
            // Retourne le message d'erreur en json
            echo json_encode([
                'status' => 'error',
                'message' => 'Connection failed: ' . $e->getMessage()
            ]);
        }

        // fermeture de la connexion à la bd
        $connect = null;

    }
    else {
        // En cas de non soumission du formulaire, message d'erreur
        echo json_encode([
            'status' => 'error',
            'message' => 'Invalid request method.'
        ]);
    }


?>

