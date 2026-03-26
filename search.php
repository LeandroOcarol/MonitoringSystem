<?php
require_once("includes/dbh.inc.php");


if (isset($_GET['search_student'])) {
    $id = trim($_GET['student_id']);

    $query = "SELECT id, first_name, last_name, Session FROM students WHERE id = ?";
    $stmt  = $pdo->prepare($query);
    $stmt->execute([$id]);
    $student = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($student) {
        echo json_encode([
            'found'     => true,
            'id_number' => $student['id'],
            'full_name' => $student['first_name'] . ' ' . $student['last_name'],
            'session'   => $student['Session']
        ]);
    } else {
        echo json_encode(['found' => false]);
    }
    exit();
}

if (isset($_POST['sitin_submit'])) {
    $id_number = trim($_POST['id_number']);
    $purpose   = $_POST['purpose'];
    $lab       = trim($_POST['lab']);

    $check = $pdo->prepare("SELECT Session FROM students WHERE id = ?");
    $check->execute([$id_number]);
    $row = $check->fetch(PDO::FETCH_ASSOC);

    if ($row && $row['Session'] > 0) {
        $update = $pdo->prepare("UPDATE students SET Session = Session - 1 WHERE id = ?");
        $update->execute([$id_number]);
    }

    header("Location: admin.php");
    exit();
}
?>

<div id="searchModal" class="modal-overlay">
    <div class="modal-box" style="width:360px;">
        <button class="modal-close" onclick="closeSearch()">&times;</button>
        <h3 class="modal-title">Search Student</h3>

        <label class="modal-label">Student ID</label>
        <input type="text" id="searchInput" class="modal-input" placeholder="Enter Student ID...">

        <p id="searchMsg" class="modal-error"></p>

        <button class="modal-btn-full" onclick="searchStudent()">Search</button>
    </div>
</div>

<div id="sitinModal" class="modal-overlay">
    <div class="modal-box" style="width:420px;">
        <button class="modal-close" onclick="closeSitin()">&times;</button>
        <h3 class="modal-title">Sit In Form</h3>

        <form method="POST" action="search.php" style="display:flex; flex-direction:column; gap:14px;">
            <div class="modal-field">
                <label class="modal-label">ID Number</label>
                <input type="text" id="show_id" name="id_number" class="modal-input-readonly" readonly>
            </div>

            <div class="modal-field">
                <label class="modal-label">Student Name</label>
                <input type="text" id="show_name" class="modal-input-readonly" readonly>
            </div>

            <div class="modal-field">
                <label class="modal-label">Purpose</label>
                <select name="purpose" class="modal-select">
                    <option value="">-- Select Purpose --</option>
                    <option value="C Programming">C Programming</option>
                    <option value="Java Programming">Java Programming</option>
                </select>
            </div>

            <div class="modal-field">
                <label class="modal-label">Lab</label>
                <input type="text" name="lab" class="modal-input">
            </div>

            <div class="modal-field">
                <label class="modal-label">Remaining Session</label>
                <input type="text" id="show_session" name="remaining_session" class="modal-input-readonly" readonly>
            </div>

            <div class="modal-footer">
                <button type="button" class="modal-btn-close" onclick="closeSitin()">Close</button>
                <button type="submit" name="sitin_submit" class="modal-btn-primary">Sit In</button>
            </div>
        </form>
    </div>
</div>

<script>
function openSearch() {
    document.getElementById('searchInput').value    = '';
    document.getElementById('searchMsg').textContent = '';
    document.getElementById('searchModal').style.display = 'flex';
}

function closeSearch() {
    document.getElementById('searchModal').style.display = 'none';
}

function closeSitin() {
    document.getElementById('sitinModal').style.display = 'none';
}

function searchStudent() {
    var id = document.getElementById('searchInput').value.trim();

    if (id === '') {
        document.getElementById('searchMsg').textContent = 'Please enter a student ID.';
        return;
    }

    fetch('search.php?search_student=1&student_id=' + encodeURIComponent(id))
        .then(function(response) { return response.json(); })
        .then(function(data) {
            if (data.found) {
                document.getElementById('show_id').value      = data.id_number;
                document.getElementById('show_name').value    = data.full_name;
                document.getElementById('show_session').value = data.session;
                closeSearch();
                document.getElementById('sitinModal').style.display = 'flex';
            } else {
                document.getElementById('searchMsg').textContent = 'Student not found.';
            }
        });
}

document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('searchInput').addEventListener('keydown', function (e) {
        if (e.key === 'Enter') searchStudent();
    });
});
</script>