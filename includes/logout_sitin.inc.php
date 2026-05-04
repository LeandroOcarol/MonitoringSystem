<?php
require_once("dbh.inc.php");
header('Content-Type: application/json');

if (!isset($_POST['sit_id'])) {
    echo json_encode(["success" => false, "message" => "Missing sit_id"]);
    exit();
}

$sit_id = $_POST['sit_id'];

try {
    // Update sit_in record with time_out and status
    $stmt = $pdo->prepare("
        UPDATE sit_ins 
        SET time_out = NOW(), status = 'COMPLETED'
        WHERE sit_id = ?
    ");
    $stmt->execute([$sit_id]);
    
    // Get student_id to minus session
    $stmt = $pdo->prepare("SELECT student_id FROM sit_ins WHERE sit_id = ?");
    $stmt->execute([$sit_id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$row) {
        echo json_encode(["success" => false, "message" => "Record not found"]);
        exit();
    }
    
    // Minus 1 from student session
    $stmt = $pdo->prepare("UPDATE students SET session = session - 1 WHERE id = ?");
    $stmt->execute([$row['student_id']]);
    
    echo json_encode(["success" => true, "message" => "Logged out successfully"]);
    
} catch (PDOException $e) {
    echo json_encode(["success" => false, "message" => $e->getMessage()]);
}
?>
