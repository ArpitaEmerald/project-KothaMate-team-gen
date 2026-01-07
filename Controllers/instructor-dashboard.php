<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'instructor') {
    header("Location: login.html");
    exit();
}
?>

<html>
<head>
    <title>Instructor Dashboard</title>
</head>
<body>

<h2>Instructor Dashboard</h2>
<p>Welcome, <?php echo $_SESSION['email']; ?></p>

<ul>
    <li>Create Lessons</li>
    <li>View Learner Progress</li>
    <li>Provide Feedback</li>
</ul>

<a href="logout.php">Logout</a>

</body>
</html>
