 //Verification generale du formulaire pour minimiser les erreurs
 function validateForm() {
    let isValid = true;

    // Vérification du prénom
    let firstname = $('#firstname').val();
    if (firstname === '') {
        isValid = false;
        $('#firstname-error').text('Le Prénom est requis.');
    }

    // Vérification du nom
    let lastname = $('#lastname').val();
    if (lastname === '') {
        isValid = false;
        $('#lastname-error').text('Le Nom est requis.');
    }

    // Vérification du sexe
    let sex = $('#sex').val();
    if (sex === '') {
        isValid = false;
        $('#sex-error').text('Le sexe est requis.');
    }

    // Vérification de l'âge
    let age = $('#age').val();
    if (age === '') {
        isValid = false;
        $('#age-error').text('L\'âge est requis.');
    }

    // Vérification de l'email
    let email = $('#email').val();
    if (email === '') {
        isValid = false;
        $('#email-error').text('L\'email est requis.');
    } else {
        // Vérification de l'existence de l'email via AJAX
        checkEmailExists(email, firstname, lastname, age, sex);
        isValid = false; // Attente de la vérification AJAX
    }

    return isValid;
}

function checkEmailExists(email, firstname, lastname, age, sex) {
    // Requête AJAX pour vérifier si l'email existe déjà
    $.ajax({
        url: 'http://localhost/TP2/server/verifyEmail.php', // URL du script serveur
        type: 'POST', // Méthode HTTP
        data: { email: email }, // Données envoyées
        success: function (response) {
            console.log(response); // Débogage
            try {
                const data = JSON.parse(response); // Conversion de la réponse JSON

                if (data.exists) {
                    $('#email-exists-error').text('Cet email est déjà inscrit.');
                } else {
                    $('#email-exists-error').text('');
                    saveClient(email, firstname, lastname, age, sex); // Enregistre les données si l'email est valide
                }
            } catch (error) {
                console.error('Erreur lors du traitement de la réponse :', error);
            }
        },
        error: function () {
            alert('Une erreur s\'est produite lors de la vérification de l\'email.');
        }
    });
}

function saveClient(email, firstname, lastname, age, sex) {
    // Requête AJAX pour sauvegarder les données
    $.ajax({
        url: 'http://localhost/TP2/server/saveClient.php', // URL du script PHP pour sauvegarder
        type: 'POST', // Méthode HTTP
        data: { // Données envoyées
            email: email,
            firstname: firstname,
            lastname: lastname,
            age: age,
            sex: sex
        },
        success: function (response) {
            console.log(response); // Débogage
            try {
                const data = JSON.parse(response); // Conversion de la réponse JSON

                if (data.status === 'success') {
                    console.log(data);
                    $('#result-message').text(data.message); // Affiche un message de succès
                } else {
                    console.error('Une erreur s\'est produite lors de l\'enregistrement.');
                }
            } catch (error) {
                console.error('Erreur lors du traitement de la réponse :', error);
            }
        },
        error: function () {
            alert('Une erreur s\'est produite lors de l\'enregistrement.');
        }
    });
}
$(document).ready(function () {
    // Efface les erreurs pour le champ "firstname"
    $('#firstname').on('input change', function () {
        if ($(this).val() === '') {
            $('#firstname-error').text('Le Prénom est requis.');
        } else {
            $('#firstname-error').text('');
        }
    });

    // Efface les erreurs pour le champ "lastname"
    $('#lastname').on('input change', function () {
        if ($(this).val() === '') {
            $('#lastname-error').text('Le Nom est requis.');
        } else {
            $('#lastname-error').text('');
        }
    });

    // Efface les erreurs pour le champ "sex"
    $('#sex').on('change', function () {
        if ($(this).val() === '') {
            $('#sex-error').text('Le Sexe est requis.');
        } else {
            $('#sex-error').text('');
        }
    });

    // Efface les erreurs pour le champ "age"
    $('#age').on('input change', function () {
        if ($(this).val() === '') {
            $('#age-error').text('L\'âge est requis.');
        } else {
            $('#age-error').text('');
        }
    });

    // Efface les erreurs pour le champ "email"
    $('#email').on('input change', function () {
        if ($(this).val() === '') {
            $('#email-error').text('L\'email est requis.');
        } else {
            $('#email-error').text('');
            $('#email-exists-error').text('');
        }
    });
});
