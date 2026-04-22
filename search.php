<?php
require_once("includes/dbh.inc.php");
header('Content-Type: application/json');

if (!isset($_GET['student_id'])) {
    echo json_encode(["found" => false]);
    exit();
}

$id = $_GET['student_id'];

$stmt = $pdo->prepare("SELECT * FROM students WHERE id = ?");
$stmt->execute([$id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row) {

    $fullName =
        $row['first_name'] . ' ' .
        ($row['middle_name'] ? $row['middle_name'] . ' ' : '') .
        $row['last_name'];

    echo json_encode([
        "found" => true,
        "id" => $row['id'],
        "name" => $fullName,
        "session" => $row['Session']
    ]);

} else {
    echo json_encode(["found" => false]);
}