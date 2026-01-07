<?php
// Only run when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize inputs
    $lessonTitle       = trim($_POST["lessonTitle"] ?? "");
    $lessonDescription = trim($_POST["lessonDescription"] ?? "");
    $moduleName        = trim($_POST["moduleName"] ?? "");
    $contentType       = trim($_POST["contentType"] ?? "");
    $contentLink       = trim($_POST["contentLink"] ?? "");

    // Basic sanitization
    $lessonTitle       = htmlspecialchars($lessonTitle, ENT_QUOTES, 'UTF-8');
    $lessonDescription = htmlspecialchars($lessonDescription, ENT_QUOTES, 'UTF-8');
    $moduleName        = htmlspecialchars($moduleName, ENT_QUOTES, 'UTF-8');
    $contentType       = htmlspecialchars($contentType, ENT_QUOTES, 'UTF-8');
    $contentLink       = filter_var($contentLink, FILTER_SANITIZE_URL);

    // Error array
    $errors = [];

    // Required field checks
    if (empty($lessonTitle))       $errors[] = "Lesson Title is required.";
    if (empty($lessonDescription)) $errors[] = "Lesson Description is required.";
    if (empty($moduleName))        $errors[] = "Module/Topic is required.";
    if (empty($contentType))       $errors[] = "Content Type must be selected.";
    if (empty($contentLink)) {
        $errors[] = "Content Link is required.";
    } elseif (!filter_var($contentLink, FILTER_VALIDATE_URL)) {
        $errors[] = "Content Link must be a valid URL.";
    }

    // Output result
    if (!empty($errors)) {
        echo "<h3 style='color:red'>Error(s) found:</h3><ul>";
        foreach ($errors as $error) {
            echo "<li>" . $error . "</li>";
        }
        echo "</ul>";
    } else {
        echo "<h3 style='color:green'>Lesson added successfully!</h3>";
        echo "<p><strong>Title:</strong> $lessonTitle</p>";
        echo "<p><strong>Description:</strong> $lessonDescription</p>";
        echo "<p><strong>Module:</strong> $moduleName</p>";
        echo "<p><strong>Type:</strong> $contentType</p>";
        echo "<p><strong>Link:</strong> <a href='$contentLink' target='_blank'>$contentLink</a></p>";
    }
}
?>