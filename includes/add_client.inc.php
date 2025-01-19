<?php
// Ce fichier sert pour l'ajout d'un client dans la base de données.

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données envoyées via POST
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $sex = $_POST['sex'];
    $age = $_POST['age'];
    $email = $_POST['email'];

    try {
        require_once "dbh.inc.php"; // Inclusion du fichier de connexion à la base de données

 // Requête SQL pour insérer les données dans la table `clients`
        $query = "INSERT INTO clients (firstname, lastname, sex, age, email) VALUES (?, ?, ?, ?, ?);";

         // Préparation de la requête SQL 
        $stmt = $pdo->prepare($query);

  // Exécution de la requête avec les données du formulaire
        $stmt->execute([$firstname, $lastname, $sex, $age, $email]);

// Libération des ressources et fermeture de la connexion
        $pdo = null;
        $stmt = null;

        header("Location: ../list_clients.php");

        die();
    }
    catch (PDOException $e){
          // Gestion des erreurs en cas d'échec de la requête SQL
        die("Échec de la requête: " . $e->getMessage());
    } 
}
else {
    header("Location: ../add_client.html");
}
?>
