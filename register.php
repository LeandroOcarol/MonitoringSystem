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
            <a href="login.php" class="btn-back">← Back</a>
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
                        <option value="BSIT">BSIT</option>
                        <option value="BSCS">BSCS</option>
                        <option value="BSA">BSA</option>
                        <option value="BSMA">BSMA</option>
                        <option value="BSBA">BSBA</option>
                        <option value="BSOA">BSOA</option>
                        <option value="BSCE">BSCE</option>
                        <option value="BSECE">BSECE</option>
                        <option value="BSME">BSME</option>
                        <option value="BSEE">BSEE</option>
                        <option value="BSCrim">BSCrim</option>
                        <option value="BEED">BEED</option>
                        <option value="BSED">BSED</option>
                        <option value="BSHM">BSHM</option>
                        <option value="BSTM">BSTM</option>
                        <option value="AB">AB</option>
                        <option value="BSN">BSN</option>
                    </select>
                </div>

                <div class="field-group">
                    <label for="courseLevel">Course Level</label>
                    <input type="number" id="courseLevel" name="courseLevel">
                </div>

                <div class="field-group">
                    <label for="address">Address</label>
                    <input type="text" id="address" name="address">
                </div>

                <button type="submit" class="btn-primary">REGISTER</button>
            </form>
            <p class="bottom-link">
                Already have an account? <a href="login.php">Login</a>
            </p>
        </div>
    </div>

</body>
</html>