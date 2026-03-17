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

    try {
        require_once "dbh.inc.php";

        $query = "UPDATE students SET last_name = ?, first_name = ?, middle_name = ?, email = ?, course = ?, course_level = ?, address = ? WHERE id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$last_name, $first_name, $middle_name, $email, $course, $course_level, $address, $id]);

        header("Location: ../editProfile.php");
        exit();
    } catch (PDOException $e) {
        die("Query Failed: " . $e->getMessage());
    }
} else {
    header("Location: ../editProfile.php");
}