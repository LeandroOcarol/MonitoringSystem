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
            <li class="dropdown">
                <a href="#">Community ▾</a>
            </li>
            <li><a href="home.php">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="editProfile.php">Edit Profile</a></li>
            <li><a href="#">History</a></li>
            <li><a href="#">Reservation</a></li>
            <li><a href="logout.php">LOG OUT</a></li>
        </ul>
    </nav>

    <div class="card">
        <div class="form-side">
            <h2 class="form-title">Edit <span>Profile</span></h2>
            <form action="includes/editprofileHandler.inc.php" method="POST">

                <div class="field-group">
                    <label for="id">ID Number</label>
                    <input type="text" id="id" value="<?php echo $student['id']; ?>" disabled>
                    <input type="hidden" name="id" value="<?php echo $student['id']; ?>">
                </div>

                <div class="field-group">
                    <label for="lName">Last Name</label>
                    <input type="text" id="lName" name="lName" value="<?php echo $student['last_name']; ?>">
                </div>

                <div class="field-group">
                    <label for="fName">First Name</label>
                    <input type="text" id="fName" name="fName" value="<?php echo $student['first_name']; ?>">
                </div>

                <div class="field-group">
                    <label for="middleName">Middle Name</label>
                    <input type="text" id="middleName" name="middleName" value="<?php echo $student['middle_name']; ?>">
                </div>

                <div class="field-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password">
                </div>

                <div class="field-group">
                    <label for="repeat_password">Repeat your password</label>
                    <input type="password" id="repeat_password" name="repeat_password">
                </div>

                <div class="field-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?php echo $student['email']; ?>">
                </div>

                <div class="field-group">
                    <label for="course">Course</label>
                    <select id="course" name="course">
                        <option value="" disabled>-- Select Course --</option>
                        <option value="BSIT" <?php if($student['course'] == 'BSIT') echo 'selected'; ?>>BSIT - Bachelor of Science in Information Technology</option>
                        <option value="BSCS" <?php if($student['course'] == 'BSCS') echo 'selected'; ?>>BSCS - Bachelor of Science in Computer Science</option>
                        <option value="BSA" <?php if($student['course'] == 'BSA') echo 'selected'; ?>>BSA - Bachelor of Science in Accountancy</option>
                        <option value="BSMA" <?php if($student['course'] == 'BSMA') echo 'selected'; ?>>BSMA - Bachelor of Science in Management Accounting</option>
                        <option value="BSBA" <?php if($student['course'] == 'BSBA') echo 'selected'; ?>>BSBA - Bachelor of Science in Business Administration</option>
                        <option value="BSOA" <?php if($student['course'] == 'BSOA') echo 'selected'; ?>>BSOA - Bachelor of Science in Office Administration</option>
                        <option value="BSCE" <?php if($student['course'] == 'BSCE') echo 'selected'; ?>>BSCE - Bachelor of Science in Civil Engineering</option>
                        <option value="BSECE" <?php if($student['course'] == 'BSECE') echo 'selected'; ?>>BSECE - Bachelor of Science in Electronics Engineering</option>
                        <option value="BSME" <?php if($student['course'] == 'BSME') echo 'selected'; ?>>BSME - Bachelor of Science in Mechanical Engineering</option>
                        <option value="BSEE" <?php if($student['course'] == 'BSEE') echo 'selected'; ?>>BSEE - Bachelor of Science in Electrical Engineering</option>
                        <option value="BSCrim" <?php if($student['course'] == 'BSCrim') echo 'selected'; ?>>BSCrim - Bachelor of Science in Criminology</option>
                        <option value="BEED" <?php if($student['course'] == 'BEED') echo 'selected'; ?>>BEED - Bachelor of Elementary Education</option>
                        <option value="BSED" <?php if($student['course'] == 'BSED') echo 'selected'; ?>>BSED - Bachelor of Secondary Education</option>
                        <option value="BSHM" <?php if($student['course'] == 'BSHM') echo 'selected'; ?>>BSHM - Bachelor of Science in Hospitality Management</option>
                        <option value="BSTM" <?php if($student['course'] == 'BSTM') echo 'selected'; ?>>BSTM - Bachelor of Science in Tourism Management</option>
                        <option value="ABCOMM" <?php if($student['course'] == 'ABCOMM') echo 'selected'; ?>>ABCOMM - AB Communication</option>
                        <option value="ABPolSci" <?php if($student['course'] == 'ABPolSci') echo 'selected'; ?>>ABPolSci - AB Political Science</option>
                        <option value="BSN" <?php if($student['course'] == 'BSN') echo 'selected'; ?>>BSN - Bachelor of Science in Nursing</option>
                    </select>
                </div>

                <div class="field-group">
                    <label for="courseLevel">Course Level</label>
                    <select id="courseLevel" name="courseLevel">
                        <option value="" disabled>-- Select Course Level --</option>
                        <option value="1" <?php if($student['course_level'] == '1') echo 'selected'; ?>>1st Year</option>
                        <option value="2" <?php if($student['course_level'] == '2') echo 'selected'; ?>>2nd Year</option>
                        <option value="3" <?php if($student['course_level'] == '3') echo 'selected'; ?>>3rd Year</option>
                        <option value="4" <?php if($student['course_level'] == '4') echo 'selected'; ?>>4th Year</option>
                    </select>
                </div>

                <div class="field-group">
                    <label for="address">Address</label>
                    <input type="text" id="address" name="address" value="<?php echo $student['address']; ?>">
                </div>

                <button type="submit" class="btn-primary">SAVE CHANGES</button>
            </form>
            <p class="bottom-link">
                <a href="home.php">Back to Home</a>
            </p>
        </div>
    </div>

</body>
</html>