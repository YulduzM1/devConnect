<?php
include 'database.php';

// Start session
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        $sql = "SELECT * FROM users WHERE email = :email";

        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':email', $email);

        $stmt->execute();

        $user = $stmt->fetch();

        // Verify password
        if ($user && $password === $user['password']) {
            // Store user information in session
            $_SESSION['user'] = $user;
            // Redirect to home_user.php
            header("Location: home_user.php");
            exit();
        } else {
            echo "Invalid email or password.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
