<?php
session_start();

if (!isset($_SESSION["id"])) {
    header("Location: index.php");
    exit();
}

require_once "includes/dbh.inc.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CCS Sit-in Monitoring System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <span class="nav-brand">Dashboard</span>
        <ul class="nav-links">      
            <li class="dropdown">
                <a href="#">Community ▾</a>
            </li>
            <li><a href="home.php">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="editProfile.php">Edit Profile</a></li>
            <li><a href="#">History</a></li>
            <li><a href="#">Reservation</a></li>
            <li><a href="logout.php">LOG OUT</a></li>
        </ul>
    </nav>

    <div class="card">
        <h6>Login Successful</h6>
    </div>
</body>
</html>