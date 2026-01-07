<?php
session_start();

$conn = new mysqli("localhost", "root", "", "your_database_name");

if ($conn->connect_error) {
    die("Database connection failed");
}

$email    = $_POST['email'];
$password = $_POST['password'];
$role     = $_POST['role'];

$sql = "SELECT * FROM users 
        WHERE email='$email' 
        AND password='$password' 
        AND role='$role'";

$result = $conn->query($sql);

if ($result->num_rows === 1) {

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
}

else {
    echo "Invalid email, password, or role.";
}
?>

