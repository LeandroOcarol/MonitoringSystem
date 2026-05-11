<?php
session_start();
require_once("includes/dbh.inc.php");

$stmt = $pdo->query("
    SELECT * FROM sit_ins
    WHERE status = 'COMPLETED'
    ORDER BY sit_id DESC
");

$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Sit-in Records</title>
<link rel="stylesheet" href="css/common.css">
<link rel="stylesheet" href="css/dashboard.css">
</head>
<body>

<nav>
    <span class="nav-brand">Admin Dashboard</span>
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

    <div class="panel-header">SIT-IN RECORDS</div>

    <!-- SEARCH + SHOW ENTRIES (KEPT UNCHANGED) -->
    <div class="table-controls">

        <div class="field-group">
            <input type="text" placeholder="Search...">
        </div>
    </div>

    <!-- TABLE -->
    <table class="data-table">

        <thead>
            <tr>
                <th>Sit ID</th>
                <th>Student ID</th>
                <th>Purpose</th>
                <th>Lab</th>
                <th>Time In</th>
                <th>Time Out</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
        <?php if (count($rows) > 0): ?>
            <?php foreach ($rows as $row): ?>
                <tr>
                    <td><?= $row['sit_id'] ?></td>
                    <td><?= $row['student_id'] ?></td>
                    <td><?= $row['purpose'] ?></td>
                    <td><?= $row['lab'] ?></td>
                    <td><?= isset($row['time_in']) ? $row['time_in'] : '-' ?></td>
                    <td><?= isset($row['time_out']) ? $row['time_out'] : '-' ?></td>
                    <td>
                        <span class="status-pill <?= strtolower($row['status']) ?>">
                            <?= htmlspecialchars($row['status']) ?>
                        </span>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="7" class="no-data">No data available</td>
            </tr>
        <?php endif; ?>
        </tbody>

    </table>

    <!-- PAGINATION (KEPT UNCHANGED) -->
    <div class="pagination">
        <button class="pagination-btn">&lt;</button>
        <button class="pagination-btn">1</button>
        <button class="pagination-btn">&gt;</button>
    </div>

</div>

<!-- MODALS (UNCHANGED) -->
<?php include 'includes/modals.php'; ?>

</body>
</html>
