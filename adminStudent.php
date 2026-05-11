<?php
session_start();

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
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
    <title>Students Information | CCS Sit-in Monitoring System</title>
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/dashboard.css">
</head>

<body class="admin-students">

<nav>
    <span class="nav-brand">Dashboard</span>
    <ul class="nav-links">
        <li><a href="admin.php">Home</a></li>
        <li><a href="#" onclick="openSearch(); return false;">Search</a></li>
        <li><a href="adminStudent.php">Students</a></li>
        <li><a href="sitin.php">Sit-in</a></li>
        <li><a href="sitinRecord.php">View Sit-in Records</a></li>
        <li><a href="#">Sit-in Reports</a></li>
        <li><a href="#">Feedback Reports</a></li>
        <li><a href="#">Reservation</a></li>
        <li><a href="logout.php">LOG OUT</a></li>
    </ul>
</nav>

    <div class="full-width-content">
        <div class="panel-header">Students Information</div>

        <!-- Top Controls Row -->
        <div class="table-controls-top">
            <div class="controls-left">
                <button class="btn-add" onclick="openAddModal()">Add Students</button>
                <form action="includes/adminStudentHandler.inc.php" method="POST" style="display:inline;">
                    <button type="submit" name="reset_all_sessions" class="btn-reset">Reset All Session</button>
                </form>
            </div>
            <div class="search-control">
                <label>Search: <input type="text" id="tableSearch" oninput="filterTable()" placeholder=""></label>
            </div>
        </div>

        <!-- Entries + Search Row -->
        <div class="table-meta-row">
            
        </div>

        <!-- Table -->
        <table class="data-table" id="studentTable">
            <thead>
                <tr>
                    <th onclick="sortTable(0)" class="sortable">ID Number <span class="sort-icon">↕</span></th>
                    <th onclick="sortTable(1)" class="sortable">Name <span class="sort-icon">↕</span></th>
                    <th onclick="sortTable(2)" class="sortable">Year Level <span class="sort-icon">↕</span></th>
                    <th onclick="sortTable(3)" class="sortable">Course <span class="sort-icon">↕</span></th>
                    <th onclick="sortTable(4)" class="sortable">Remaining Session <span class="sort-icon">↕</span></th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="studentTableBody">
                <?php
                $query = "SELECT * FROM students ORDER BY id ASC";
                $stmt = $pdo->query($query);

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $studentName = htmlspecialchars($row['first_name'] . ' ' . $row['last_name'], ENT_QUOTES);
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['first_name']} {$row['last_name']}</td>
                            <td>{$row['course_level']}</td>
                            <td>{$row['course']}</td>
                            <td>{$row['session']}</td>
                            <td class='action-cell'>
                                <button class='btn-edit' onclick='openEditModal({$row['id']})'>Edit</button>
                                <button class='btn-sitin' type='button' data-id=\"{$row['id']}\" data-name=\"{$studentName}\" data-session=\"{$row['session']}\" onclick='openSitInModal(this)'>Sit-in</button>
                                <button class='btn-delete' onclick='deleteStudent({$row['id']})'>Delete</button>
                            </td>
                          </tr>";
                }
                ?>

            </tbody>
        </table>

        <!-- Pagination Row -->
        <div class="table-footer-row">
            <div id="tableInfo" class="table-info"></div>
            <div id="paginationControls" class="pagination"></div>
        </div>
    </div>

    <?php include 'includes/modals.php'; ?>

<script>
function openSitInModal(button) {
    const studentId = button.dataset.id || '';
    const studentName = button.dataset.name || '';
    const studentSession = button.dataset.session || '';
    document.getElementById('show_id').value = studentId;
    document.getElementById('show_name').value = studentName;
    document.getElementById('show_session').value = studentSession;
    document.getElementById('purpose').value = '';
    document.getElementById('lab').value = '';
    const sitinMsg = document.getElementById('sitinMsg');
    if (sitinMsg) sitinMsg.textContent = '';
    document.getElementById('sitinModal').style.display = 'flex';
}
</script>

</body>
</html>