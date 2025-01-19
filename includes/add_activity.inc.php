<?php
// Ce fichier sert pour l'ajout d'une activité dans la base de données.

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     // Récupération des données envoyées via POST
    $name = $_POST['name'];
    $description = $_POST['description'];
    $season = $_POST['season'];

    try {
        require_once "dbh.inc.php";
// Requête SQL pour insérer les données dans la table `activities`
        $query = "INSERT INTO activities (name, description, season) VALUES (?, ?, ?);";

// Préparation de la requête SQL 
        $stmt = $pdo->prepare($query);

// Exécution de la requête avec les données du formulaire
        $stmt->execute([$name, $description, $season]);

// Libération des ressources en fermant la connexion et la requête
        $pdo = null;
        $stmt = null;
 // Redirection vers la page affichant la liste des activités après succès
        header("Location: ../list_all_activities.php");

        die();// Arrêt du script pour éviter toute exécution supplémentaire
    }
    catch (PDOException $e){
        // Gestion des erreurs en cas d'échec de la requête SQL
        die("Échec de la requête: " . $e->getMessage());
    } 
}
else {
    header("Location: ../index.php");
}
?>
