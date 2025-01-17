// Charger la liste des clients après le chargement de la page
$(document).ready(function() {
    loadList();
});

function loadList() {
    // Effectuer une requête AJAX avec jQuery
    $.ajax({
        url: 'http://localhost/TP2/server/activityList.php', // URL du serveur
        type: 'GET', // Méthode HTTP
        success: function(response) {
            console.log("Réponse brute :", response); // Débogage

            // Parser la réponse JSON
            const activities = JSON.parse(response);

            if (activities.length > 0) {
                const tableBody = $('#activitiesTable tbody');
                tableBody.empty(); // Vider le contenu de la table avant de la remplir

                // Ajouter les activités dans la table
                activities.forEach(function(activity) {
                    const row = `
                        <tr>
                            <td>${activity.id}</td>
                            <td>${activity.name}</td>
                            <td>${activity.description}</td>
                            <td>${activity.season}</td>
                        </tr>`;
                    tableBody.append(row); // Ajouter la ligne dans la table
                });

                // Afficher la table après avoir ajouté les données
                $('#activitiesTable').show();
            } else {
                alert('Aucune activité trouvée.');
            }
        },
        error: function(error) {
            alert('Erreur lors du chargement des activités : '+ error);
        }
    });
}
