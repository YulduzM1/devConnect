<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" type="text/css" href="/home_user.css">
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

<!-- Button to create a project post -->
<button onclick="location.href='/create_project.php';">Create Project Post</button>

<div class="container">
    <div class="user-info">
        <?php include 'user_info.php'; ?>
    </div>

    <div class="project-listings">
        <?php include 'project_list.php'; ?>
    </div>
</div>
</body>
</html>
