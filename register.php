<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CCS Sit-in Monitoring System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="card">
        <div class="form-side">
            <a href="index.php" class="btn-back">← Back</a>
            <h2 class="form-title">Sign <span>Up</span></h2>
            <form action="includes/registerHandler.inc.php" method="POST">
                <div class="field-group">
                    <label for="id">ID Number</label>
                    <input type="text" id="id" name="id">
                </div>

                <div class="field-group">
                    <label for="lName">Last Name</label>
                    <input type="text" id="lName" name="lName">
                </div>

                <div class="field-group">
                    <label for="fName">First Name</label>
                    <input type="text" id="fName" name="fName">
                </div>

                <div class="field-group">
                    <label for="middleName">Middle Name</label>
                    <input type="text" id="middleName" name="middleName">
                </div>
           
                <div class="field-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password">
                </div>

                <div class="field-group">
                    <label for="">Repeat your password</label>
                    <input type="password" id="" name="">
                </div>

                <div class="field-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email">
                </div>

                <div class="field-group">
                    <label for="course">Course</label>
                    <select id="course" name="course">
                        <option value="" disabled selected>-- Select Course --</option>
                        <option value="BSIT">BSIT - Bachelor of Science in Information Technology</option>
                        <option value="BSCS">BSCS - Bachelor of Science in Computer Science</option>
                        <option value="BSA">BSA - Bachelor of Science in Accountancy</option>
                        <option value="BSMA">BSMA - Bachelor of Science in Management Accounting</option>
                        <option value="BSBA">BSBA - Bachelor of Science in Business Administration</option>
                        <option value="BSOA">BSOA - Bachelor of Science in Office Administration</option>
                        <option value="BSCE">BSCE - Bachelor of Science in Civil Engineering</option>
                        <option value="BSECE">BSECE - Bachelor of Science in Electronics Engineering</option>
                        <option value="BSME">BSME - Bachelor of Science in Mechanical Engineering</option>
                        <option value="BSEE">BSEE - Bachelor of Science in Electrical Engineering</option>
                        <option value="BSCrim">BSCrim - Bachelor of Science in Criminology</option>
                        <option value="BEED">BEED - Bachelor of Elementary Education</option>
                        <option value="BSED">BSED - Bachelor of Secondary Education</option>
                        <option value="BSHM">BSHM - Bachelor of Science in Hospitality Management</option>
                        <option value="BSTM">BSTM - Bachelor of Science in Tourism Management</option>
                        <option value="ABCOMM">ABCOMM - AB Communication</option>
                        <option value="ABPolSci">ABPolSci - AB Political Science</option>
                        <option value="BSN">BSN - Bachelor of Science in Nursing</option>
                    </select>
                </div>

                <div class="field-group">
                    <label for="courseLevel">Course Level</label>
                    <select id="courseLevel" name="courseLevel">
                        <option value="" disabled selected>-- Select Course Level --</option>
                        <option value="1">1st Year</option>
                        <option value="2">2nd Year</option>
                        <option value="3">3rd Year</option>
                        <option value="4">4th Year</option>
                    </select>
                </div>

                <div class="field-group">
                    <label for="address">Address</label>
                    <input type="text" id="address" name="address">
                </div>

                <button type="submit" class="btn-primary">REGISTER</button>
            </form>
            <p class="bottom-link">
                Already have an account? <a href="index.php">Login</a>
            </p>
        </div>
    </div>

</body>
</html>