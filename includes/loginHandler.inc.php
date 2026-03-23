<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $password = $_POST["password"];

    if (empty($id) || empty($password)) {
        $_SESSION["error"] = "Please fill in all fields.";
        header("Location: ../index.php");
        exit();
    }

    try {
        require_once "dbh.inc.php";

        $query = "SELECT * FROM students WHERE id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$id]);

        $student = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($student && password_verify($password, $student["student_password"])) {
            session_regenerate_id(true);
            $_SESSION["id"] = $student["id"];
            header("Location: ../home.php");
            exit();
        } else {
            $_SESSION["error"] = "Invalid ID number or password.";
            header("Location: ../index.php");
            exit();
        }

    } catch (PDOException $e) {
        $_SESSION["error"] = "Something went wrong. Please try again.";
        header("Location: ../index.php");
        exit();
    }
} else {
    header("Location: ../index.php");
    exit();
}