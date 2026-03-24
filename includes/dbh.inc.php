<?php

$db = "mysql:host=localhost;dbname=monitoring_system";
$dbusername = "root";
$dbpassword = "";

try {
    $pdo = new PDO($db, $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}