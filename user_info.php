<?php
include 'database.php';
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $email = $_GET['email']; 
    try {
        $sql = "SELECT * FROM users WHERE email = :email";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch();
        if ($user) {
            // Display user information
            echo "
            <div class='info'>
                <p><strong>First Name:</strong> " . $user['first_name'] . "</p>
                <p><strong>Last Name:</strong> " . $user['last_name'] . "</p>
                <p><strong>School Name:</strong> " . $user['school_name'] . "</p>
                <p><strong>Major:</strong> " . $user['school_major'] . "</p>
                <p><strong>Graduation Year:</strong> " . $user['school_year'] . "</p>
                <p><strong>LinkedIn:</strong> " . $user['linkedin_link'] . "</p>
                <p><strong>Github:</strong> " . $user['github_link'] . "</p>
                <p><strong>Tech Stacks:</strong> " . $user['tech_stacks'] . "</p>
                <p><strong>Email:</strong> " . $user['email'] . "</p>
                <!-- Password should not be displayed here for security reasons -->
            </div>";
        } else {
            echo "User not found.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
