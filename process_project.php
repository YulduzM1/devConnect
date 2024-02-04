<?php
// Include database connection file
include 'database.php';

// Start session if not already started
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $project_name = $_POST['project_name'];
    $project_description = $_POST['project_description'];
    $due_date = $_POST['due_date'];
    $required_tech = $_POST['required_tech'];
    $project_img = $_POST['project_img'];

    // Check if user session exists
    if(isset($_SESSION['user'])) {
        // Retrieve user information from session
        $user = $_SESSION['user'];
        $user_id = $user['id']; // Assuming 'id' is the user's ID column in the users table

        // Insert project data into the database
        try {
            $sql = "INSERT INTO projects (user_id, project_name, project_description, due_date, required_tech, project_img) 
                    VALUES (:user_id, :project_name, :project_description, :due_date, :required_tech, :project_img)";
            
            $stmt = $pdo->prepare($sql);
            
            // Bind parameters
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':project_name', $project_name);
            $stmt->bindParam(':project_description', $project_description);
            $stmt->bindParam(':due_date', $due_date);
            $stmt->bindParam(':required_tech', $required_tech);
            $stmt->bindParam(':project_img', $project_img);
            
            // Execute the statement
            $stmt->execute();
            
            // Redirect to home_user.php after successful insertion
            header("Location: home_user.php");
            exit();
        } catch (PDOException $e) {
            // Handle database errors
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "User session not found.";
    }
} else {
    // Redirect to home_user.php if the form is not submitted
    header("Location: home_user.php");
    exit();
}
?>
