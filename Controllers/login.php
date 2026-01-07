<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $role  = $_POST['role'];

    // Store login info in session
    $_SESSION['email'] = $email;
    $_SESSION['role']  = $role;

    // Role-based redirection
    if ($role === "admin") {
        header("Location: admin-dashboard.php");
    } elseif ($role === "instructor") {
        header("Location: instructor-dashboard.php");
    } elseif ($role === "learner") {
        header("Location: learner-dashboard.php");
    } else {
        header("Location: login.html");
    }

    exit();
}
?>
