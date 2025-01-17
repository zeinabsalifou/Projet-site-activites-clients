<?php

    
header("Access-Control-Allow-Origin: *");
    
    // Connexion à la base de données (exemple avec MySQL)
    $host = 'localhost';
    $db = 'my_site_db';
    $user = 'root';
    $pass = '';
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);



    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        

        // Get the form data
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $sex = $_POST['sex'];
        $age = $_POST['age'];
        $email=$_POST['email'];
        
        
        try {
            // Create a new PDO instance (connecting to the database)
            $connect = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
            
            // Set the PDO error mode to exception
            $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Prepare the SQL query to insert the new client into the 'client' table
            $stmt = $connect->prepare("INSERT INTO client (firstname, lastname, sex, age, email) 
                                    VALUES (:firstname, :lastname, :sex, :age, :email)");

            // Bind the form data to the SQL query parameters
            $stmt->bindParam(':firstname', $firstname);
            $stmt->bindParam(':lastname', $lastname);
            $stmt->bindParam(':sex', $sex);
            $stmt->bindParam(':age', $age);
            $stmt->bindParam(':email', $email);

            // Execute the query
            if ($stmt->execute()) {
                // Return the success response as JSON
                echo json_encode([
                    'status' => 'success',
                    'message' => 'New client has been added successfully!',
                    'client' => [
                        'firstname' => $firstname,
                        'lastname' => $lastname,
                        'sex' => $sex,
                        'age' => $age,
                        'email' => $email
                    ]
                ]);
            } else {
                // Return failure response in case of an error
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Failed to add client.'
                ]);
            }
        }
        catch (PDOException $e) {
            // Return the error message as JSON
            echo json_encode([
                'status' => 'error',
                'message' => 'Connection failed: ' . $e->getMessage()
            ]);
        }

        // Close the database connection
        $connect = null;
    }
    else {
        // If the form is not submitted, return an error message
        echo json_encode([
            'status' => 'error',
            'message' => 'Invalid request method.'
        ]);
    }

?>