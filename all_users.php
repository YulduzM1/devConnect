<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Users</title>
    <link rel="stylesheet" type="text/css" href="/all_users.css">
</head>
<body>
<?php
include 'database.php';

session_start();

if(isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
} else {
    header("Location: login.php");
    exit();
}
?>
<header>
    <nav>
        <ul class="nav-links">
            <li><a href="all_users.php">All Users</a></li>
            <li><a href="#about">About Us</a></li>
            <li><a href="#how-it-works">How It Works</a></li>
            <li><a href="#contact">Contact Us</a></li>
        </ul>
    </nav>
</header>

<div class="container">
    <div class="user-info">
        <h2>Welcome, <?php echo $user['first_name']; ?>!</h2> <!-- Ushow me current user pleaser -->
    </div>

    <div class="user-list">
    <?php
    $sql = "SELECT * FROM users";
    
    $stmt = $pdo->query($sql);
    
    if ($stmt->rowCount() > 0) {
        // Loop through each user and display their basic information
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<div class='user-box'>";
            echo "<h3>{$row['first_name']} {$row['last_name']}</h3>";
            echo "<p><strong>School:</strong> {$row['school_name']}</p>";
            echo "<p><strong>Major:</strong> {$row['school_major']}</p>";
            // Add button to reveal more details
            echo "<button onclick=\"toggleDetails(this)\">Show More</button>";
            // Add a hidden div with more details
            echo "<div class='more-details'>";
            echo "<p><strong>Email:</strong> {$row['email']}</p>";
            echo "<p><strong>LinkedIn:</strong> {$row['linkedin_link']}</p>";
            // Add more user details here
            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "No users found.";
    }
    ?>
</div>

</div>
<script>
function toggleDetails(button) {
    var details = button.nextElementSibling;
    if (details.style.display === "block") {
        details.style.display = "none";
        button.innerText = "Show More";
    } else {
        details.style.display = "block";
        button.innerText = "Show Less";
    }
}
</script>

</body>
</html>
