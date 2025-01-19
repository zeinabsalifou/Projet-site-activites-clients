<?php
// Ce fichier vérifie si un email existe déjà dans la base de données `clients`.
require 'dbh.inc.php';

// Vérifie si le champ email est défini dans la requête POST
if (isset($_POST['email'])) {
    $email = $_POST['email'];

     // Préparation d'une requête SQL pour vérifier l'existence de l'email
    $stmt = $pdo->prepare("SELECT * FROM clients WHERE email = ?");
    $stmt->execute([$email]);

      // Retourner une réponse JSON indiquant si l'email existe ou non
    echo json_encode(['exists' => $stmt->rowCount() > 0]);
}
?>