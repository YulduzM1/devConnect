<?php
include 'database.php';
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
$user = $_SESSION['user'];

// Function to accept or decline friend requests
if (isset($_POST['action'], $_POST['request_id'])) {
    $action = $_POST['action'];
    $requestId = $_POST['request_id'];

    if ($action === 'accept' || $action === 'decline') {
        $sqlUpdateStatus = "UPDATE connection_requests SET status = :status WHERE request_id = :request_id";
        $stmtUpdateStatus = $pdo->prepare($sqlUpdateStatus);
        $status = ($action === 'accept') ? 'approved' : 'declined';
        $stmtUpdateStatus->bindParam(':status', $status);
        $stmtUpdateStatus->bindParam(':request_id', $requestId);
        if ($stmtUpdateStatus->execute()) {
            echo "Friend request $action successfully.";
        } else {
            echo "Error updating friend request status.";
        }
        exit(); // Stop further execution
    }
}

// Query to retrieve pending friend requests for the logged-in user
$sqlPendingRequests = "SELECT u.first_name, u.last_name, c.request_id
                       FROM connection_requests c
                       INNER JOIN users u ON c.sender_id = u.id
                       WHERE c.receiver_id = :user_id AND c.status = 'pending'";
$stmtPendingRequests = $pdo->prepare($sqlPendingRequests);
$stmtPendingRequests->bindParam(':user_id', $user['id']);
$stmtPendingRequests->execute();
$pendingRequests = $stmtPendingRequests->fetchAll(PDO::FETCH_ASSOC);

// Query to retrieve approved friends for the logged-in user
$sqlFriends = "SELECT u.first_name, u.last_name
               FROM connection_requests c
               INNER JOIN users u ON c.sender_id = u.id
               WHERE (c.receiver_id = :user_id OR c.sender_id = :user_id) AND c.status = 'approved'";
$stmtFriends = $pdo->prepare($sqlFriends);
$stmtFriends->bindParam(':user_id', $user['id']);
$stmtFriends->execute();
$friends = $stmtFriends->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Friends</title>
</head>
<body>
<header>
    <nav>
        <ul class="nav-links">
            <li><a href="all_users.php">All Users</a></li>
            <li><a href="#about">About Us</a></li>
            <li><a href="#how-it-works">How It Works</a></li>
            <li><a href="#contact">Contact Us</a></li>
            <li><a href="my_friends.php">My Friends</a></li>
        </ul>
    </nav>
</header>

<div class="container">
    <div class="pending-requests">
        <h2>Pending Friend Requests</h2>
        <?php if (empty($pendingRequests)): ?>
            <p>No pending friend requests.</p>
        <?php else: ?>
            <ul>
                <?php foreach ($pendingRequests as $request): ?>
                    <li>
                        <?php echo $request['first_name'] . ' ' . $request['last_name']; ?>
                        <button onclick="handleRequest('accept', <?php echo $request['request_id']; ?>)">Accept</button>
                        <button onclick="handleRequest('decline', <?php echo $request['request_id']; ?>)">Decline</button>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>

    <div class="approved-friends">
        <h2>Approved Friends</h2>
        <?php if (empty($friends)): ?>
            <p>No approved friends.</p>
        <?php else: ?>
            <ul>
                <?php foreach ($friends as $friend): ?>
                    <li><?php echo $friend['first_name'] . ' ' . $friend['last_name']; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</div>

<script>
function handleRequest(action, requestId) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            // Handle response from server
            console.log(this.responseText);
            // Reload the page or update UI as needed
            window.location.reload();
        }
    };
    xhr.open("POST", "my_friends.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("action=" + action + "&request_id=" + requestId);
}
</script>

</body>
</html>
