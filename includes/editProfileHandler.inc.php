<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $last_name = $_POST["lName"];
    $first_name = $_POST["fName"];
    $middle_name = $_POST["middleName"];
    $email = $_POST["email"];
    $course = $_POST["course"];
    $course_level = $_POST["courseLevel"];
    $address = $_POST["address"];
    $password = $_POST["password"];
    $repeat_password = $_POST["repeat_password"];

    try {
        require_once "dbh.inc.php";

        // Check if user wants to update password
        if (!empty($password)) {
            // Validate passwords match
            if ($password !== $repeat_password) {
                header("Location: ../editProfile.php?error=password_mismatch");
                exit();
            }
            // Hash new password
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            $query = "UPDATE students SET last_name = ?, first_name = ?, middle_name = ?, email = ?, course = ?, course_level = ?, address = ?, student_password = ? WHERE id = ?";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$last_name, $first_name, $middle_name, $email, $course, $course_level, $address, $hashedPassword, $id]);
        } else {
            // Update without changing the password
            $query = "UPDATE students SET last_name = ?, first_name = ?, middle_name = ?, email = ?, course = ?, course_level = ?, address = ? WHERE id = ?";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$last_name, $first_name, $middle_name, $email, $course, $course_level, $address, $id]);
        }

        header("Location: ../editProfile.php?success=updated");
        exit();
    } catch (PDOException $e) {
        die("Query Failed: " . $e->getMessage());
    }
} else {
    header("Location: ../editProfile.php");
}