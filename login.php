<?php
include 'database.php';

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
            // using first_name for redirection
            header("Location: home_user.html?firstname=" . urlencode($user['first_name']));
            exit();
        } else {
            echo "Invalid email or password.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
