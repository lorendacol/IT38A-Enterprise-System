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
    <nav class="navbar">
        <ul>
            <li><a href="?page=home" <?= $page == 'home' ? 'class="active"' : '' ?>>Home</a></li>
            <li><a href="?page=announcements" <?= $page == 'announcements' ? 'class="active"' : '' ?>>Announcements</a></li>
            <li><a href="?page=equipment" <?= $page == 'equipment' ? 'class="active"' : '' ?>>Equipment</a></li>
            <li><a href="?page=contact" <?= $page == 'contact' ? 'class="active"' : '' ?>>Contact Us</a></li>
        </ul>
    </nav>

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
