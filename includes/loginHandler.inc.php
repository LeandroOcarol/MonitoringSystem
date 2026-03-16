<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $password = $_POST["password"];

    try {
        require_once "dbh.inc.php";

        $query = "SELECT * FROM students WHERE id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$id]);

        $student = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($student && $password == $student["student_password"]) {
            header("Location: ../home.php");
            exit();
        } else {
            header("Location: ../login.php");
            exit();
        }

    } catch (PDOException $e) {
        die("Query Failed: " . $e->getMessage());
    }
} else {
    header("Location: ../login.php");
    exit();
}