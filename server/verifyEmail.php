<?php

    header("Access-Control-Allow-Origin: *");
    
    // Connexion à la base de données (exemple avec MySQL)
    $host = 'localhost';
    $db = 'my_site_db';
    $user = 'root';
    $pass = '';
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);


    // Récupérer l'email envoyé par AJAX
    $email = $_POST['email'];



    // Requête pour vérifier si l'email existe déjà
    $reqst = $pdo->prepare("SELECT COUNT(*) FROM client WHERE email = :email");
    $reqst->execute(['email' => $email]);
    $emailExists = $reqst->fetchColumn() > 0;


    // Retourner la réponse en JSON
    echo json_encode(['exists' => $emailExists]);
    ?>