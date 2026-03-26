<?php

session_start();

if (!isset($_SESSION["id"]) || $_SESSION["role"] !== "admin") {
    echo json_encode(["found" => false]);
    exit();
}

require_once "dbh.inc.php";

$q = $_GET["q"];

$stmt = $pdo->prepare("SELECT id, first_name, last_name, Session 
                        FROM students 
                        WHERE id = ? OR first_name LIKE ? OR last_name LIKE ? 
                        LIMIT 1");

$stmt->execute([$q, "%$q%", "%$q%"]);

$student = $stmt->fetch(PDO::FETCH_ASSOC);

if ($student) {
    echo json_encode([
        "found"             => true,
        "id"                => $student["id"],
        "name"              => $student["first_name"] . " " . $student["last_name"],
        "remaining_session" => $student["Session"]
    ]);
} else {
    echo json_encode(["found" => false]);
}