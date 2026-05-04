<?php
session_start();
require_once("dbh.inc.php");

// Authorization Check
if (!isset($_SESSION["id"])) {
    header("Location: ../index.php");
    exit();
}

// ─── GET STUDENT (for Edit Modal fetch) ───────────────────────────────────────
if (isset($_GET['get_student'])) {
    $id = $_GET['get_student'];
    $stmt = $pdo->prepare("SELECT id, first_name, last_name, course, course_level, session FROM students WHERE id = ?");
    $stmt->execute([$id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    header('Content-Type: application/json');
    echo $row ? json_encode($row) : json_encode([]);
    exit();
}

// ─── DELETE STUDENT ───────────────────────────────────────────────────────────
if (isset($_GET['delete_id'])) {
    $stmt = $pdo->prepare("DELETE FROM students WHERE id = ?");
    $stmt->execute([$_GET['delete_id']]);
    header("Location: ../adminStudent.php?msg=delete_success");
    exit();
}

// ─── RESET ALL SESSIONS ───────────────────────────────────────────────────────
if (isset($_POST['reset_all_sessions'])) {
    $stmt = $pdo->prepare("UPDATE students SET session = 30");
    $stmt->execute();
    header("Location: ../adminStudent.php?msg=reset_success");
    exit();
}

// ─── ADD STUDENT ──────────────────────────────────────────────────────────────
if (isset($_POST['add_student'])) {
    $id              = trim($_POST['id']);
    $fname           = trim($_POST['first_name']);
    $lname           = trim($_POST['last_name']);
    $password        = $_POST['password'] ?? '';
    $repeat_password = $_POST['repeat_password'] ?? '';
    $course          = trim($_POST['course']);
    $level           = trim($_POST['course_level']);

    if ($password !== $repeat_password) {
        $_SESSION["error"] = "Passwords do not match.";
        header("Location: ../adminStudent.php?msg=add_error");
        exit();
    }

    if (strlen($password) < 8) {
        $_SESSION["error"] = "Password must be at least 8 characters.";
        header("Location: ../adminStudent.php?msg=add_error");
        exit();
    }

    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $stmt = $pdo->prepare("INSERT INTO students (id, first_name, last_name, student_password, course, course_level, session, email, address, profile_image) VALUES (?, ?, ?, ?, ?, ?, 30, '', '', 'IMG_Default.jpg')");
    $stmt->execute([$id, $fname, $lname, $hashedPassword, $course, $level]);
    header("Location: ../adminStudent.php?msg=add_success");
    exit();
}

// ─── EDIT STUDENT ─────────────────────────────────────────────────────────────
if (isset($_POST['edit_student'])) {
    $id     = $_POST['id'];
    $fname  = trim($_POST['first_name']);
    $lname  = trim($_POST['last_name']);
    $course = trim($_POST['course']);
    $level  = trim($_POST['course_level']);

    $stmt = $pdo->prepare("UPDATE students SET first_name = ?, last_name = ?, course = ?, course_level = ? WHERE id = ?");
    $stmt->execute([$fname, $lname, $course, $level, $id]);
    header("Location: ../adminStudent.php?msg=edit_success");
    exit();
}
?>