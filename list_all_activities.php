<?php
// Ce fichier affiche toutes les activités enregistrées dans la base de données.
require 'includes/dbh.inc.php';

// Exécution de la requête pour récupérer toutes les activités
$stmt = $pdo->query("SELECT * FROM activities");
$activities = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Activités</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <nav>
            <a href="add_client.php">Ajouter un Client</a>
            <a href="add_activity.php">Ajouter une Activité</a>
            <a href="list_clients.php">Liste des Clients</a>
            <a href="list_all_activities.php">Liste des Activités</a>
        </nav>
    </header>
    <h1>Liste des Activités</h1>
    <ul>
        <?php foreach ($activities as $activity): ?>
            <li>
                <?= htmlspecialchars($activity['name']) ?> - <?= htmlspecialchars($activity['description']) ?>
                (<?= htmlspecialchars($activity['season']) ?>)
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
