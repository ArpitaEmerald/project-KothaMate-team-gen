<?php
session_start();

$email = $_POST['email'];
$role  = $_POST['role'];

$_SESSION['email'] = $email;
$_SESSION['role']  = $role;

if ($role === "admin") {
    header("Location: admin-dashboard.php");
} elseif ($role === "instructor") {
    header("Location: instructor-dashboard.php");
} else {
    header("Location: learner-dashboard.php");
}
exit();
?>
