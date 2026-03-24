<?php
session_start();

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

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
            <li class="dropdown"><a href="#">Community ▾</a></li>
            <li><a href="home.php">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="editProfile.php">Edit Profile</a></li>
            <li><a href="#">History</a></li>
            <li><a href="#">Reservation</a></li>
            <li><a href="logout.php">LOG OUT</a></li>
        </ul>
    </nav>

    <div class="card">
        <div class="form-title">
            <h6>Login Successful</h6>
        </div>
    </div>
</body>
</html>