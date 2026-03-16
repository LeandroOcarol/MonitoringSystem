<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $last_name = $_POST["lName"];
    $first_name = $_POST["fName"];
    $middle_name = $_POST["middleName"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $course = $_POST["course"];
    $course_level = $_POST["courseLevel"];
    $address = $_POST["address"];

    try {
        require_once "dbh.inc.php";

        $query = "INSERT INTO students (id, last_name, first_name, middle_name, student_password, course, course_level, email, address) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?);";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$id, $last_name, $first_name, $middle_name, $password, $course, $course_level, $email, $address]);

        header("Location: ../login.php");
        exit();
    } catch (PDOException $e) {
        die("Query Failed: " . $e->getMessage());
    }
}else {
    header("Location: ../login.php");
}