<?php
session_start();

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

if (!isset($_SESSION["id"])) {
    header("Location: index.php");
    exit();
}

require_once("includes/dbh.inc.php");
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
    <?php include 'includes/adminStudentHandler.inc.php'; ?>
    <nav>
        <span class="nav-brand">Dashboard</span>
        <ul class="nav-links">
            <li><a href="admin.php">Home</a></li>
            <li><a href="#" onclick="openSearch(); return false;">Search</a></li>
            <li><a href="#">Students</a></li>
            <li><a href="#">Sit-in</a></li>
            <li><a href="#">View Sit-in Records</a></li>
            <li><a href="#">Sit-in Reports</a></li>
            <li><a href="#">Feedback Reports</a></li>
            <li><a href="#">Reservation</a></li>
            <li><a href="logout.php">LOG OUT</a></li>
        </ul>
    </nav>
        <button class="btn-back">Reset All Session</button>



<?php include 'includes/modals.php'; ?>

<script src="includes/modals.js"></script>
</body>
</html>