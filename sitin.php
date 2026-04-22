<?php
session_start();
require_once("includes/dbh.inc.php");

$stmt = $pdo->query("
    SELECT * FROM sit_ins
    ORDER BY sit_id DESC
");

$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Sit-in</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<nav>
    <span class="nav-brand">Dashboard</span>
    <ul class="nav-links">
        <li><a href="admin.php">Home</a></li>
        <li><a href="#" onclick="openSearch(); return false;">Search</a></li>
        <li><a href="adminStudent.php">Students</a></li>
        <li><a href="sitin.php">Sit-in</a></li>
        <li><a href="#">View Sit-in Records</a></li>
        <li><a href="#">Sit-in Reports</a></li>
        <li><a href="#">Feedback Reports</a></li>
        <li><a href="#">Reservation</a></li>
        <li><a href="logout.php">LOG OUT</a></li>
    </ul>
</nav>

<div class="full-width-content">

    <div class="panel-header">CURRENT SIT-IN</div>

    <!-- SEARCH + SHOW ENTRIES (KEPT UNCHANGED) -->
    <div class="table-controls" style="display:flex; justify-content:space-between; margin-bottom:20px;">
        <div class="field-group">
            <label>Show</label>
            <select>
                <option>10</option>
                <option>25</option>
                <option>50</option>
            </select>
            <label>entries</label>
        </div>

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
                <th>Status</th>
                <th>Action</th>
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
                    <td><?= $row['status'] ?></td>

                    <!-- ACTION -->
                    <td>
                        <?php if ($row['status'] === 'ACTIVE'): ?>
                            <form method="POST" action="logout_sitin.php" style="display:inline;">
                                <input type="hidden" name="sit_id" value="<?= $row['sit_id'] ?>">
                                <button type="submit" class="modal-btn-close">
                                    Log-out
                                </button>
                            </form>
                        <?php else: ?>
                            <span style="color:rgba(255,255,255,0.4); font-size:12px;">
                                Done
                            </span>
                        <?php endif; ?>
                    </td>

                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" class="no-data">No data available</td>
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
<script src="includes/modals.js"></script>

</body>
</html>