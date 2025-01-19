<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter une Activité</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- En-tête contenant le menu de navigation -->
    <header>
        <nav>
             <!-- Liens de navigation vers les différentes pages -->
            <a href="add_client.php">Ajouter un Client</a>
            <a href="add_activity.php">Ajouter une Activité</a>
            <a href="list_clients.php">Liste des Clients</a>
            <a href="list_all_activities.php">Liste des Activités</a>
        </nav>
    </header>
    <h1>Ajouter une Activité</h1>
     <!-- Formulaire pour ajouter une activité -->
    <form id="activityForm">
        <label>Nom de l'activité: <input type="text" name="name" required></label><br>
        <label>Description: <textarea name="description" required></textarea></label><br>
        <label>Saison: 
            <select name="season" required>
                <option value="">-- Sélectionnez une saison --</option>
                <option value="summer">Été</option>
                <option value="fall">Automne</option>
                <option value="winter">Hiver</option>
                <option value="spring">Printemps</option>
            </select>
        </label><br>
        <button type="submit">Ajouter</button>
    </form>
    <p id="status"></p>

    <script>
        $(document).ready(function () {
           // Gestionnaire d'événement pour la soumission du formulaire
            $('#activityForm').on('submit', function (e) {
                e.preventDefault();

                // Envoi des données via AJAX
                $.post('includes/add_activity.inc.php', $(this).serialize(), function (response) {
                    alert("Activité ajouté"); // Afficher la réponse
                    $('#activityForm')[0].reset(); // Réinitialiser le formulaire
                }).fail(function () {
                    $('#status').text('Une erreur est survenue lors de l\'ajout de l\'activité.');
                });
            });
        });
    </script>
</body>
</html>
