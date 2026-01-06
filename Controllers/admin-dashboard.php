<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
</head>
<body>

<h2>Admin Dashboard</h2>
<p>Welcome, <?php echo $_SESSION['email']; ?></p>

<ul>
    <li>Manage Users</li>
    <li>Send Notifications</li>
    <li>System Overview</li>
</ul>

<a href="logout.php">Logout</a>

</body>
</html>
