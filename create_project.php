<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Project Post</title>
    <link rel="stylesheet" type="text/css" href="/create_project.css">
</head>
<body>
<header>
    <nav>
        <ul class="nav-links">
            <li><a href="all_users.php">All_users</a></li>
            <li><a href="#about">About Us</a></li>
            <li><a href="#how-it-works">How It Works</a></li>
            <li><a href="#contact">Contact Us</a></li>
        </ul>
    </nav>
</header>

<div class="container">
    <div class="user-info">
        <h2 style="color: #5e3b6d">User Profile Information</h2> <!-- New heading added -->
        <?php include 'user_info.php'; ?>
    </div>

    <div class="project-form">
    <h2>Create a New Project</h2>
    <form action="process_project.php" method="POST">
        <label for="project_name">Project Name:</label>
        <input type="text" id="project_name" name="project_name" required><br><br>

        <label for="project_description">Project Description:</label>
        <textarea id="project_description" name="project_description" required></textarea><br><br>

        <label for="due_date">Due Date:</label>
        <input type="date" id="due_date" name="due_date" required><br><br>

        <label for="required_tech">Required Tech:</label>
        <input type="text" id="required_tech" name="required_tech" required><br><br>

        <label for="project_img">Project Image URL:</label>
        <input type="text" id="project_img" name="project_img" required><br><br>

        <input type="submit" value="Submit">
    </form>
</div>

</div>
</body>
</html>
