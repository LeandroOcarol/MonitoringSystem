<?php
session_start();

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

if (!isset($_SESSION["id"])) {
    header("Location: index.php");
    exit();
}

require_once "includes/dbh.inc.php";

$query = "SELECT * FROM students WHERE id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$_SESSION["id"]]);
$student = $stmt->fetch(PDO::FETCH_ASSOC);
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
        <span class="nav-brand">Dashboard</span>
        <ul class="nav-links">
            <li class="dropdown"><a href="#">Notification ▾</a></li>
            <li><a href="home.php">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="editProfile.php">Edit Profile</a></li>
            <li><a href="#">History</a></li>
            <li><a href="#">Reservation</a></li>
            <li><a href="logout.php">LOG OUT</a></li>
        </ul>
    </nav>

    <div class="dashboard-container">

        <!-- Student Information Panel -->
        <div class="dashboard-panel">
            <div class="panel-header">Student Information</div>
            <div class="panel-body student-info">
                <div class="student-avatar">
                    <img src="images/students/123.jpg" alt="Avatar">
                </div>
                <hr>
                <p><strong>Name:</strong> <?php echo $student['first_name'] . ' ' . $student['middle_name'] . ' ' . $student['last_name']; ?></p>
                <p><strong>Course:</strong> <?php echo $student['course']; ?></p>
                <p><strong>Year:</strong> <?php echo $student['course_level']; ?></p>
                <p><strong>Email:</strong> <?php echo $student['email']; ?></p>
                <p><strong>Address:</strong> <?php echo $student['address']; ?></p>
                <p><strong>Session:</strong> 30</p>
            </div>
        </div>

        <!-- Announcement Panel -->
        <div class="dashboard-panel">
            <div class="panel-header">&#128227; Announcement</div>
            <div class="panel-body announcement-body">
                <div class="announcement-item">
                    <p class="announcement-meta">CCS Admin | 2026-Feb-11</p>
                </div>
                <hr>
                <div class="announcement-item">
                    <p class="announcement-meta">CCS Admin | 2024-May-08</p>
                    <div class="announcement-content">
                        <p>Important Announcement We are excited to announce the launch of our new website! 🎉 Explore our latest products and services now!</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rules and Regulation Panel -->
        <div class="dashboard-panel">
            <div class="panel-header">Rules and Regulation</div>
            <div class="panel-body rules-body">
                <p class="rules-institution">University of Cebu<br>COLLEGE OF INFORMATION & COMPUTER STUDIES<br><br>LABORATORY RULES AND REGULATIONS</p>
                <p class="rules-intro">To avoid embarrassment and maintain camaraderie with your friends and superiors at our laboratories, please observe the following:</p>
                <p>1. Maintain silence, proper decorum, and discipline inside the laboratory. Mobile phones, walkmans and other personal pieces of equipment must be switched off.</p>
                <p>2. Games are not allowed inside the lab. This includes computer-related games, card games and other games that may disturb the operation of the lab.</p>
                <p>3. Surfing the Internet is allowed only with the permission of the instructor. Downloading and installing of software are strictly prohibited.</p>
                <p>4. Getting access to other websites not related to the course (especially pornographic and illicit sites) is strictly prohibited.</p>
                <p>5. Deleting computer files and changing the set-up of the computer is a major offense.</p>
                <p>6. Observe computer time usage carefully. A fifteen-minute allowance is given for each use. Otherwise, the unit will be given to those who wish to "sit-in".</p>
                <p>7. Observe proper decorum while inside the laboratory.</p>
                <ul class="rules-sublist">
                    <li>Do not get inside the lab unless the instructor is present.</li>
                    <li>All bags, knapsacks, and the likes must be deposited at the counter.</li>
                    <li>Follow the seating arrangement of your instructor.</li>
                    <li>At the end of class, all software programs must be closed.</li>
                    <li>Return all chairs to their proper places after using.</li>
                </ul>
                <p>8. Chewing gum, eating, drinking, smoking, and other forms of vandalism are prohibited inside the lab.</p>
                <p>9. Anyone causing a continual disturbance will be asked to leave the lab. Acts or gestures offensive to the members of the community, including public display of physical intimacy, are not tolerated.</p>
                <p>10. Persons exhibiting hostile or threatening behavior such as yelling, swearing, or disregarding requests made by lab personnel will be asked to leave the lab.</p>
                <p>11. For serious offense, the lab personnel may call the Civil Security Office (CSU) for assistance.</p>
                <p>12. Any technical problem or difficulty must be addressed to the laboratory supervisor, student assistant or instructor immediately.</p>
                <p class="rules-section-title">DISCIPLINARY ACTION</p>
                <ul class="rules-sublist">
                    <li><strong>First Offense</strong> - The Head or the Dean or OIC recommends to the Guidance Center for a suspension from classes for each offender.</li>
                    <li><strong>Second and Subsequent Offenses</strong> - A recommendation for a heavier sanction will be endorsed to the Guidance Center.</li>
                </ul>
            </div>
        </div>

    </div>
</body>
</html>