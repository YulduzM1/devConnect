<?php
// Include the database configuration file
include 'database.php';

// Get the form data
$firstName = $_POST['first_name'];
$lastName = $_POST['last_name'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$password = $_POST['password'];

echo $firstName;
try {
    // Prepare the SQL statement to insert data into the register table
    $sql = "INSERT INTO users (first_name, last_name, gender, email, password) VALUES (:first_name, :last_name, :gender, :email, :password)";

    // Prepare the PDO statement
    $stmt = $pdo->prepare($sql);

    // Bind parameters to the prepared statement
    $stmt->bindParam(':first_name', $firstName);
    $stmt->bindParam(':last_name', $lastName);
    $stmt->bindParam(':gender', $gender);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);

    // Execute the prepared statement
    if ($stmt->execute()) {
        // Insertion successful
        echo "Record inserted successfully!";
    } else {
        // Insertion failed
        echo "Error: Unable to insert record.";
    }
} catch (PDOException $e) {
    // Display error message if an exception occurs
    echo "Error: " . $e->getMessage();
}
?>
