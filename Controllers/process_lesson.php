<?php
$con = mysqli_connect('127.0.0.1', 'root', '', 'webtech');
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$lessonTitle = mysqli_real_escape_string($con, $_POST['lessonTitle']);
$lessonDescription = mysqli_real_escape_string($con, $_POST['lessonDescription']);
$moduleName = mysqli_real_escape_string($con, $_POST['moduleName']);
$contentType = mysqli_real_escape_string($con, $_POST['contentType']);
$contentLink = mysqli_real_escape_string($con, $_POST['contentLink']);

$sql = "INSERT INTO lesson (lesson_title, lesson_description, module_name, content_type, content_link) 
        VALUES ('$lessonTitle', '$lessonDescription', '$moduleName', '$contentType', '$contentLink')";

if (mysqli_query($con, $sql)) {
    echo "<h3 style='color:green'>Lesson saved successfully!</h3>";
} else {
    echo "Error: " . mysqli_error($con);
}

mysqli_close($con);
?>