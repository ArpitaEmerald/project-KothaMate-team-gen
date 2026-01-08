<?php
session_start();
require "db.php";

$email    = $_POST['email'];
$password = $_POST['password'];

$query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) === 1) {

    $user = mysqli_fetch_assoc($result);

    $_SESSION['email'] = $user['email'];
    $_SESSION['role']  = $user['role'];

    if ($user['role'] === 'admin') {
        header("Location: admin-dashboard.php");
    } elseif ($user['role'] === 'instructor') {
        header("Location: instructor-dashboard.php");
    } else {
        header("Location: learner-dashboard.php");
    }
    exit();

} else {
    echo "<script>alert('Invalid email or password'); window.location='login.html';</script>";
}
?>

