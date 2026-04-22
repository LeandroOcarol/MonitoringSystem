<?php
require_once("dbh.inc.php");
header('Content-Type: application/json');

if (!isset($_POST['student_id'], $_POST['purpose'], $_POST['lab'])) {
    echo json_encode([
        "success" => false,
        "message" => "Missing fields"
    ]);
    exit();
}

$student_id = $_POST['student_id'];
$purpose = $_POST['purpose'];
$lab = $_POST['lab'];

try {

    $stmt = $pdo->prepare("
        INSERT INTO sit_ins (student_id, purpose, lab, status)
        VALUES (?, ?, ?, 'ACTIVE')
    ");

    $stmt->execute([$student_id, $purpose, $lab]);

    echo json_encode([
        "success" => true,
        "message" => "Sit-in saved"
    ]);

} catch (PDOException $e) {
    echo json_encode([
        "success" => false,
        "message" => $e->getMessage()
    ]);
}