<?php
//Ce fichier récupère et affiche les activités associées à un client spécifique.
require 'includes/dbh.inc.php';  

// Vérification si un ID client a été fourni via la requête GET
if (isset($_GET['client_id'])) {
    $clientId = $_GET['client_id'];

     // Préparation de la requête SQL pour récupérer les activités du client
    $stmt = $pdo->prepare("
        SELECT activities.name, activities.description 
        FROM subscriptions
        JOIN activities ON subscriptions.activity_id = activities.id
        WHERE subscriptions.client_id = ?
    ");
     // Exécution de la requête en passant l'ID du client comme paramètre
    $stmt->execute([$clientId]);
    $activities = $stmt->fetchAll(PDO::FETCH_ASSOC);  // Récupération des résultats sous forme de tableau associatif

  // Vérification si des activités sont trouvées pour le client
    if ($activities) {
        foreach ($activities as $activity) {
            echo htmlspecialchars($activity['name']) . ": " . htmlspecialchars($activity['description']) ;
        }
    } else {
        echo "Aucune activité trouvée pour ce client.";
    }
}
?>