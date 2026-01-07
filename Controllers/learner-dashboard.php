<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'learner') {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Learner Dashboard</title>
</head>
<body>

<h2>Learner Dashboard</h2>
<p>Welcome, <?php echo $_SESSION['email']; ?></p>

<ul>
    <li>View Lessons</li>
    <li>Track Progress</li>
    <li>View Feedback</li>
</ul>

<a href="logout.php">Logout</a>

</body>
</html>
