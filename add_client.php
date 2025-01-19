<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <title>Ajouter un Client</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
     <!-- En-tête de la page avec un menu de navigation -->
    <header>
        <nav>
           <!-- Liens vers les différentes pages de l'application -->
            <a href="add_client.php">Ajouter un Client</a>
            <a href="add_activity.php">Ajouter une Activité</a>
            <a href="list_clients.php">Liste des Clients</a>
            <a href="list_all_activities.php">Liste des Activités</a>
        </nav>
    </header>

    <h1>Ajouter un Client</h1>
      <!-- Formulaire pour ajouter un client -->
    <form id="clientForm" action="includes/add_client.inc.php" method="post">
      <label>Prénom: <input type="text" name="firstname" required /></label
      ><br />
      <label>Nom: <input type="text" name="lastname" required /></label><br />
      <label
        >Sexe:
        <select name="sex">
          <option value="Male">Homme</option>
          <option value="Female">Femme</option>
        </select> </label
      ><br />
      <label>Âge: <input type="number" name="age" required /></label><br />
      <label
        >Email: <input type="email" name="email" id="email" required /></label
      ><br />
      <button type="submit">Ajouter</button>
    </form>
    <p id="status"></p>

      <!-- Script pour vérifier si l'email existe déja via AJAX -->
    <script>
      $(document).ready(function () {
        $("#email").on("blur", function () {
          const email = $(this).val();
          if (email) {
            $.post(
              "includes/check_email.inc.php",
              { email: email },
              function (response) {
                const data = JSON.parse(response);
                if (data.exists) {
                  $("#status").text("Cet email est déjà utilisé.");
                } else {
                  $("#status").text("");
                }
              }
            );
          }
        });
      });
    </script>
  </body>
</html>
