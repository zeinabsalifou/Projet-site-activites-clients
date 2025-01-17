// Charger la liste des clients après le chargement de la page
$(document).ready(function () {
    loadList();
});

function loadList() {
    $.ajax({
        url: 'http://localhost/TP2/server/list.php',
        type: 'GET',
        success: function (response) {
            console.log(response);
            var data = JSON.parse(response); // Parse la réponse JSON

            if (data && data.length > 0) {
                var tableBody = $('#clientsTable tbody');
                tableBody.empty(); // Vider la table avant de remplir

                // Remplir la table avec les données des clients
                data.forEach(function (client) {
                    var row = `
                        <tr>
                            <td>${client.id}</td>
                            <td>${client.firstname}</td>
                            <td>${client.lastname}</td>
                            <td>${client.sex}</td>
                            <td>${client.age}</td>
                            <td>${client.email}</td>
                            <td><button onclick="loadClientActivities(${client.id}, '${client.firstname}', '${client.lastname}')">Activités</button></td>
                        </tr>`;
                    tableBody.append(row);
                });

                // Afficher la table après avoir ajouté les données
                $('#clientsTable').show();
            } else {
                alert('Aucun client trouvé.');
            }
        },
        error: function (xhr, status, error) {
            alert('Erreur lors du chargement des clients : ' + xhr.status + ' - ' + error);
        }
    });
}

function loadClientActivities(clientId, firstName, lastName) {
    $('#client_name').text(`${firstName} ${lastName}`);

    $.ajax({
        url: 'http://localhost/TP2/server/clientActivities.php',
        type: 'GET',
        data: { client_id: clientId },
        success: function (response) {
            var data = JSON.parse(response); // Parse la réponse JSON
            var activityTableBody = $('#activityTable tbody');
            activityTableBody.empty(); // Vider la table avant de remplir

            // Remplir la table avec les activités du client
            if (data && data.length > 0) {
                data.forEach(function (activity) {
                    var row = `
                        <tr>
                            <td>${activity.name}</td>
                            <td>${activity.description}</td>
                            <td>${activity.season}</td>
                        </tr>`;
                    activityTableBody.append(row);
                });

                // Afficher la section des activités
                $('#clientActivities').show();
            } else {
                alert('Aucune activité trouvée pour ce client.');
            }
        },
        error: function (error) {
            alert('Erreur lors du chargement des activités : '+ error);
        }
    });
}
