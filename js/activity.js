function validateForm() {
    let isValid = true;

    // Vérification du champ "name"
    const name = $('#name').val();
    if (name === '') {
        isValid = false;
        $('#name-error').text('Le nom est requis.');
    }

    // Vérification du champ "description"
    const description = $('#description').val();
    if (description === '') {
        isValid = false;
        $('#description-error').text('La description est requise.');
    }

    // Vérification du champ "season"
    const season = $('#season').val();
    if (season === '') {
        isValid = false;
        $('#season-error').text('La saison est requise.');
    } else {
        // Tout est valide, on enregistre les données
        saveActivity(name, description, season);
    }

    return isValid;
}

function saveActivity(name, description, season) {

    // Requête AJAX avec jQuery
    $.ajax({
        url: 'http://localhost/TP2/server/saveActivity.php',
        type: 'POST',
        data: {
            name: name,
            description: description,
            season: season
        },
        success: function (response) {
            console.log("Réponse brute du serveur : ", response); // Pour vérifier ce qui est renvoyé
            try {
                const data = JSON.parse(response); // Convertir la réponse en JSON

                if (data.status === 'success') {
                    console.log(data.message); // Débogage
                    $('#result-message').text(data.message);
                } else {
                    console.log("Une erreur s'est produite lors de l'enregistrement.");
                }
            } catch (e) {
                console.error("Erreur lors du traitement de la réponse :", e);
            }
        },
        error: function () {
            // Afficher un message d'erreur à l'utilisateur
            $('#result-message').text("Une erreur est survenue. Veuillez réessayer plus tard.");
        }
    });
}



// Effacement dynamique des messages d'erreur au changement ou saisie
$(document).ready(function () {
    // Efface les erreurs pour le champ "name"
    $('#name').on('input change', function () {
        if ($(this).val() === '') {
            $('#name-error').text('Le nom est requis.');
        } else {
            $('#name-error').text('');
        }
    });

    // Efface les erreurs pour le champ "description"
    $('#description').on('input change', function () {
        if ($(this).val() === '') {
            $('#description-error').text('La description est requise.');
        } else {
            $('#description-error').text('');
        }
    });

    // Efface les erreurs pour le champ "season"
    $('#season').on('change', function () {
        if ($(this).val() === '') {
            $('#season-error').text('La saison est requise.');
        } else {
            $('#season-error').text('');
        }
    });
});
