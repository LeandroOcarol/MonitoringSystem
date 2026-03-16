<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CCS Sit-in Monitoring System - Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <span class="nav-brand">College of Computer Studies Sit-in Monitoring System</span>
        <ul class="nav-links">
            <li><a href="#">Home</a></li>
            <li class="dropdown">
                <a href="#">Community ▾</a>
                <div class="dropdown-menu">
                    <a href="#">Forum</a>
                    <a href="#">Events</a>
                    <a href="#">Members</a>
                </div>
            </li>
            <li><a href="#">About</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="Register.php">Register</a></li>
        </ul>
    </nav>

    <div class="card">
        <div class="logo-side">
            <img class="logo" src="images/ccs_logo.png">
        </div>

        <div class="divider"></div>

        <div class="form-side">
            <h2 class="form-title">Welcome <span>Student</span></h2>

            <form action="includes/loginHandler.inc.php" method="POST">
            <div class="field-group">
                <label for="id">ID Number</label>
                <input type="text" id="id" name="id">
            </div>

            <div class="field-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password">
            </div>

            <div class="options-row">
                <label class="remember-label">
                    <input type="checkbox" name="remember"> Remember me
                </label>
                <a href="#" class="forgot-link">Forgot password?</a>
            </div>

            <button type="submit" class="btn-primary">LOGIN</button>
            </form>
            <p class="bottom-link">
                Don't have an account? <a href="Register.php">Register</a>
            </p>
        </div>

    </div>

</body>
</html>