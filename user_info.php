<?php
session_start();

if(isset($_SESSION['user'])) {
    $user = $_SESSION['user'];

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
    echo "User session not found.";
}
?>
