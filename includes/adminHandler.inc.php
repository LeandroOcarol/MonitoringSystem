<?php

session_start();
 
if (!isset($_SESSION["id"]) || $_SESSION["role"] !== "admin") {
    echo json_encode(["found" => false]);
    exit();
}
 
require_once "dbh.inc.php";
 
$q = $_GET["q"];
 
$stmt = $pdo->prepare("SELECT id, firstname, lastname, remaining_session 
                        FROM students 
                        WHERE id = ? OR firstname LIKE ? OR lastname LIKE ? 
                        LIMIT 1");
 
$stmt->execute([$q, "%$q%", "%$q%"]);
 
$student = $stmt->fetch(PDO::FETCH_ASSOC);
 
if ($student) {
    echo json_encode([
        "found"             => true,
        "id"                => $student["id"],
        "name"              => $student["firstname"] . " " . $student["lastname"],
        "remaining_session" => $student["remaining_session"]
    ]);
} else {
    echo json_encode(["found" => false]);
}