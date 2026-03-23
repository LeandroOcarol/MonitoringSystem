<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $last_name = $_POST["lName"];
    $first_name = $_POST["fName"];
    $middle_name = $_POST["middleName"];
    $password = $_POST["password"];
    $repeat_password = $_POST["repeat_password"];
    $email = $_POST["email"];
    $course = $_POST["course"];
    $course_level = $_POST["courseLevel"];
    $address = $_POST["address"];

    if ($password !== $repeat_password) {
        $_SESSION["error"] = "Passwords do not match. Please try again.";
        header("Location: ../register.php");
        exit();
    }

    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    try {
        require_once "dbh.inc.php";

        // Check if ID already exists
        $checkStmt = $pdo->prepare("SELECT id FROM students WHERE id = ?");
        $checkStmt->execute([$id]);
        if ($checkStmt->fetch()) {
            $_SESSION["error"] = "That ID number is already registered.";
            header("Location: ../register.php");
            exit();
        }

        // Check if email already exists
        $checkEmail = $pdo->prepare("SELECT id FROM students WHERE email = ?");
        $checkEmail->execute([$email]);
        if ($checkEmail->fetch()) {
            $_SESSION["error"] = "That email address is already in use.";
            header("Location: ../register.php");
            exit();
        }

        $query = "INSERT INTO students (id, last_name, first_name, middle_name, student_password, course, course_level, email, address) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$id, $last_name, $first_name, $middle_name, $hashedPassword, $course, $course_level, $email, $address]);

        $_SESSION["success"] = "Registration successful! You can now log in.";
        header("Location: ../index.php");
        exit();
    } catch (PDOException $e) {
        $_SESSION["error"] = "Something went wrong. Please try again.";
        header("Location: ../register.php");
        exit();
    }
} else {
    header("Location: ../register.php");
}