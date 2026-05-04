<?php
session_start();

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

if (!isset($_SESSION["id"])) {
    header("Location: index.php");
    exit();
}

require_once("includes/dbh.inc.php");

// Handle announcement submission
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["announcement_content"])) {
    $content = trim($_POST["announcement_content"]);
    if (!empty($content)) {
        $stmt = $pdo->prepare("INSERT INTO announcements (posted_by, content) VALUES (?, ?)");
        $stmt->execute(["CCS Admin", $content]);
    }
    header("Location: admin.php");
    exit();
}

// Fetch all announcements newest first
$announcements = $pdo->query("SELECT * FROM announcements ORDER BY created_at DESC")
                      ->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CCS Sit-in Monitoring System</title>
    <link rel="stylesheet" href="style.css">
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

<div class="admin-home-container">

    <!-- Announcement Panel -->
    <div class="admin-panel" id="announcement-panel">
        <div class="panel-header">&#x1F4E3; Announcement</div>
        <div class="panel-body">

            <!-- Post form -->
            <form method="POST" action="admin.php" class="announcement-form">
                <label class="announce-label">New Announcement</label>
                <textarea name="announcement_content"
                          class="announce-textarea"
                          placeholder="Write your announcement here..."
                          required></textarea>
                <button type="submit" class="btn-announce">Submit</button>
            </form>

            <!-- Posted list -->
            <div class="posted-header">Posted Announcement</div>
            <div class="posted-list">
                <?php if (empty($announcements)): ?>
                    <p class="no-announce">No announcements yet.</p>
                <?php else: ?>
                    <?php foreach ($announcements as $a): ?>
                        <div class="posted-item">
                            <p class="posted-meta">
                                <?php echo htmlspecialchars($a['posted_by']); ?> |
                                <?php echo date('Y-M-d', strtotime($a['created_at'])); ?>
                            </p>
                            <p class="posted-content">
                                <?php echo nl2br(htmlspecialchars($a['content'])); ?>
                            </p>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

        </div>
    </div>

</div>

<?php include 'includes/modals.php'; ?>
<script src="includes/modals.js"></script>

</body>
</html>