<?php
include 'database.php';

session_start();

if(isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
} else {
    header("Location: login.php");
    exit();
}

// Query to retrieve user data
$sql = "SELECT * FROM users";
$stmt = $pdo->query($sql); // Execute the query
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Users</title>
    <link rel="stylesheet" type="text/css" href="/all_user.css">
</head>
<body>
<header>
    <nav>
        <ul class="nav-links">
            <li><a href="home_user.php">Main Dashboard</a></li>
            <li><a href="all_users.php">All Users</a></li>
            <li><a href="my_friends.php">My Friends</a></li>
            <li><a href="blog.php">Blog</a></li>
            <li><a href="login.html">Logout</a></li>
        </ul>
    </nav>
</header>

<div class="container">
    <div class="user-info">
        <h2>Welcome, <?php echo $user['first_name']; ?>!</h2>
    </div>
    <!-- Loading pop-up -->
    <div class="loading-popup" style="display: none;">
        <div class="loading-content">
            <span>Sending connection request...</span>
        </div>
    </div>

    <div class="user-list">
    <?php
    // Loop through each user and display their basic information
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Display user information
        echo "<div class='user-box'>";
        echo "<h3>{$row['first_name']} {$row['last_name']}</h3>";
        echo "<p><strong>School:</strong> {$row['school_name']}</p>";
        echo "<p><strong>Major:</strong> {$row['school_major']}</p>";
        echo "<button onclick=\"toggleDetails(this)\">Show More</button>";
        echo "<button onclick=\"connectUser({$row['id']})\" class='connect-button'>Connect</button>"; // Connect button
        echo "<div class='more-details'>";
        echo "<p><strong>Email:</strong> {$row['email']}</p>";
        echo "<p><strong>LinkedIn:</strong> {$row['linkedin_link']}</p>";
        echo "</div>";
        echo "</div>";
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

// Function to handle connect button click
function connectUser(userId) {
    // Show loading pop-up
    var loadingPopup = document.querySelector('.loading-popup');
    loadingPopup.style.display = 'flex'; // Change 'block' to 'flex'

    // Send AJAX request to handle connect action after a delay
    setTimeout(function() {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // Hide loading pop-up
                loadingPopup.style.display = 'none';

                // Handle response from server
                console.log(this.responseText);
            }
        };
        xhr.open("POST", "handle_connect.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("sender_id=<?php echo $user['id']; ?>&receiver_id=" + userId);
    }, 3000); // Delay in milliseconds (adjust as needed)
}
</script>



</body>
</html>
