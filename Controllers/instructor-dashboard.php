<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'instructor') {
     header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Instructor Dashboard</title>

    <link rel="stylesheet" href="../Assets/dashboard.css">
</head>
<body>

<header class="header">
    <h1>Instructor Dashboard</h1>
    <p>Welcome, <?php echo $_SESSION['email']; ?></p>
</header>

<section class="dashboard-card">
    <h2>Instructor Overview</h2>

    <div class="card-container">
        <div class="info-card">
            <h3>My Courses</h3>
            <p>4</p>
        </div>

        <div class="info-card">
            <h3>Enrolled Learners</h3>
            <p>65</p>
        </div>

        <div class="info-card">
            <h3>Pending Feedback</h3>
            <p>3</p>
        </div>
    </div>

    <br>

    <a href="LessonAndContentCreation.html" class="action-btn">
        Manage Lessons
    </a>

    <a href="progress-feedback.html" class="action-btn">
        View Learner Progress
    </a>

    <a href="accessibility_interface.html" class="action-btn">
        Accessibility Interface
    </a>

    <br><br>

    <a href="logout.php">Logout</a>
</section>

</body>
</html>


