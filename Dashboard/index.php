<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sports Club Dashboard</title>
    <link rel="stylesheet" href="style.css"> 
</head>
<body>
<header class="navbar">
    <div class="navbar-logo">
        <h1>Sports Club</h1>
    </div>
    <nav class="navbar-links">
        <a href="index.php">Home</a>
        <a href="?page=announcements">Announcements</a>
        <a href="?page=equipment">Equipment</a>
        <a href="?page=contact">Contact Us</a>
        <img src="profile.jpg" alt="Profile" class="profile-icon"> <!-- optional profile image -->
    </nav>
</header>


    <div class="content">
        <?php
            if (file_exists("$page.php")) {
                include("$page.php");
            } else {
                echo "<h1>Page not found.</h1>";
            }
        ?>
    </div>
</body>
</html>
