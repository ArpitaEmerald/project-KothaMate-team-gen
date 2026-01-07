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
    <li>
        <a href="LessonAndContentCreation.html">
            Lesson & Content Creation
        </a>
    </li>
    <li>
        <a href="progress-feedback.html">
            Learner Progress & Feedback
        </a>
    </li>
    <li>
        <a href="accessibility-ui.html">
            Accessibility Interface
        </a>
    </li>
</ul>

<a href="logout.php">Logout</a>

</body>
</html>
