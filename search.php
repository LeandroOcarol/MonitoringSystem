<?php

if (!isset($_SESSION["id"])) {
    echo json_encode(["found" => false]);
    exit();
}
require_once "includes/dbh.inc.php";

$studentId = isset($_GET["id"]) ? trim($_GET["id"]) : "";

if ($studentId === "") {
    echo json_encode(["found" => false]);
    exit();
}

// Search student by ID only
$stmt = $pdo->prepare("SELECT id, first_name, last_name
                       FROM students 
                       WHERE id = ? LIMIT 1");
$stmt->execute([$studentId]);
$student = $stmt->fetch(PDO::FETCH_ASSOC);

if ($student) {
    echo json_encode([
        "found" => true,
        "id" => $student["id"],
        "name" => $student["firstname"] . " " . $student["lastname"],
        "remaining_session" => 30
    ]);
} else {
    echo json_encode(["found" => false]);
}
?>

<div class="overlay" id="searchModal" style="display: none;">
    <div class="modal">
        <div class="modal-header">
            <span>Search Student</span>
            <button onclick="closeSearchModal()">&times;</button>
        </div>
        <div class="modal-body">
            <div class="search-row">
                <input type="text" id="search-input" placeholder="Enter ID">
                <button class="btn-search" onclick="searchStudent()">Search</button>
            </div>
            <p id="error-msg" style="display: none;">No student found.</p>
        </div>
    </div>
</div>

<!-- RESULT MODAL -->
<div class="overlay" id="resultModal" style="display: none;">
    <div class="modal">
        <div class="modal-header">
            <span>Student Information</span>
            <button onclick="closeResultModal()">&times;</button>
        </div>
        <div class="modal-body">
            <p><strong>ID:</strong> <span id="result-id"></span></p>
            <p><strong>Name:</strong> <span id="result-name"></span></p>
            <p><strong>Remaining Session:</strong> <span id="result-session"></span></p>
        </div>
    </div>
</div>

