<?php
// Include the database configuration file
include 'database.php';

// Get the form data
$firstName = $_POST['first_name'];
$lastName = $_POST['last_name'];
$school_name = $_POST['school_name'];
$school_major = $_POST['school_major'];
$school_year = $_POST['school_year'];
$linkedin_link = $_POST['linkedin_link'];
$github_link = $_POST['github_link'];
$tech_stacks = $_POST['tech_stacks'];
$email = $_POST['email'];
$password = $_POST['password'];

echo $firstName;
try {
    // Prepare the SQL statement to insert data into the register table
    //$sql = "INSERT INTO users (first_name, last_name, school_name, school_major, school_year, linkedin_link, github_link, tech_stacks, email, password) VALUES (:first_name, :last_name, :gender, :email, :password)";
	$sql = "INSERT INTO users (first_name, last_name, school_name, school_major, school_year, linkedin_link, github_link, tech_stacks, email, password) VALUES (:first_name, :last_name, :school_name, :school_major, :school_year, :linkedin_link, :github_link, :tech_stacks, :email, :password)";

    // Prepare the PDO statement
    $stmt = $pdo->prepare($sql);

    // Bind parameters to the prepared statement
    $stmt->bindParam(':first_name', $firstName);
    $stmt->bindParam(':last_name', $lastName);
    $stmt->bindParam(':school_name', $school_name);
	$stmt->bindParam(':school_major', $school_major);
	$stmt->bindParam(':school_year', $school_year);
	$stmt->bindParam(':linkedin_link', $linkedin_link);
	$stmt->bindParam(':github_link', $github_link);
	$stmt->bindParam(':tech_stacks', $tech_stacks);
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
