<?php
 
if (!isset($_SESSION["id"])) {
    header("Location: index.php");
    exit();
}
 
require_once("includes/dbh.inc.php");
 
if (isset($_POST['reset_all_sessions'])) {
    $stmt = $pdo->prepare("UPDATE students SET Session = 30");
    $stmt->execute();
    header("Location: students.php?reset=success");
    exit();
}