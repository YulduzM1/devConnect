<?php
include 'database.php';

// Check if sender_id and receiver_id are set
if (isset($_POST['sender_id'], $_POST['receiver_id'])) {
    $sender_id = $_POST['sender_id'];
    $receiver_id = $_POST['receiver_id'];

    // Check if a connection request already exists
    $sql = "SELECT * FROM connection_requests WHERE sender_id = :sender_id AND receiver_id = :receiver_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':sender_id', $sender_id);
    $stmt->bindParam(':receiver_id', $receiver_id);
    $stmt->execute();
    $existingRequest = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existingRequest) {
        // Check the status of the existing request
        $status = $existingRequest['status'];
        if ($status === 'pending') {
            echo "You have already sent a connection request. Your request is pending.";
        } elseif ($status === 'approved') {
            echo "You are already connected with this user.";
        } elseif ($status === 'declined') {
            echo "Your connection request has been declined.";
        }
    } else {
        // Insert connection request into the database
        $sql = "INSERT INTO connection_requests (sender_id, receiver_id, status) VALUES (:sender_id, :receiver_id, 'pending')";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':sender_id', $sender_id);
        $stmt->bindParam(':receiver_id', $receiver_id);
        if ($stmt->execute()) {
            echo "Connection request sent successfully.";
        } else {
            echo "Error sending connection request.";
        }
    }
}
?>
