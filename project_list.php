<?php
include 'database.php';

try {
    $sql = "SELECT * FROM projects";


    $stmt = $pdo->prepare($sql);

    $stmt->execute();

    $projects = $stmt->fetchAll();

    if ($projects) {
        foreach ($projects as $project) {
            echo "
            <div class='project'>
                <h2>{$project['project_name']}</h2>
                <p><strong>Description:</strong> {$project['project_description']}</p>
                <p><strong>Due Date:</strong> {$project['due_date']}</p>
                <p><strong>Required Tech:</strong> {$project['required_tech']}</p>
                <img src='{$project['project_img']}' alt='Project Image'>
            </div>";
        }
    } else {
        echo "No projects found.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
