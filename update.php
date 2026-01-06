<?php
// Initialize variables
$success_msg = "";
$errors = [];
$submitted_data = [];

// Handle Form Submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 1. Sanitize all inputs to prevent XSS
    $name = htmlspecialchars(strip_tags(trim($_POST['name'])));
    $username = htmlspecialchars(strip_tags(trim($_POST['username'])));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $country = htmlspecialchars($_POST['country']);
    $message = htmlspecialchars(trim($_POST['message']));

    // 2. PHP Validation
    // Validate Required Fields
    if (empty($name)) $errors[] = "Name is required.";
    if (empty($username)) $errors[] = "Username is required.";
    if (empty($email)) $errors[] = "Email is required.";
    
    // Check email format using filter_var()
    if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    // Validate Message length (min 10 characters)
    if (strlen($message) < 10) {
        $errors[] = "Message must be at least 10 characters long.";
    }

    // 3. Validate File Attachment (Optional)
    if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] == 0) {
        $allowed_types = ['image/jpeg', 'image/png', 'application/pdf'];
        $max_size = 2 * 1024 * 1024; // 2MB

        if (!in_array($_FILES['attachment']['type'], $allowed_types)) {
            $errors[] = "Invalid file type. Only JPG, PNG, and PDF are allowed.";
        }
        if ($_FILES['attachment']['size'] > $max_size) {
            $errors[] = "File is too large. Maximum size is 2MB.";
        }
    }

    // 4. Final Processing
    if (empty($errors)) {
        // Simulate Email Sending
        $success_msg = "Email sent! Your profile update has been processed.";
        
        // Store data for display
        $submitted_data = [
            "Name" => $name,
            "Username" => $username,
            "Email" => $email,
            "Country" => $country,
            "Message" => $message,
            "Attachment" => isset($_FILES['attachment']['name']) ? $_FILES['attachment']['name'] : "None"
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>KothaMate - Update Profile</title>
    <style>
        /* CSS to match your KothaMate Red/White UI */
        body { font-family: Arial, sans-serif; background-color: #fff; margin: 0; padding: 0; }
        .header { background-color: #ff0000; color: white; padding: 40px 20px; border-bottom-left-radius: 30px; border-bottom-right-radius: 30px; }
        .container { padding: 20px; max-width: 500px; margin: auto; }
        .card { background: white; border-radius: 15px; padding: 20px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); margin-top: -30px; }
        input, select, textarea { width: 100%; padding: 12px; margin: 10px 0; border: 1px solid #ddd; border-radius: 8px; box-sizing: border-box; }
        .btn { background-color: #ff0000; color: white; border: none; width: 100%; padding: 15px; border-radius: 10px; font-weight: bold; cursor: pointer; }
        .error { color: #ff0000; font-size: 0.9rem; }
        .success-box { background: #e7f3e7; padding: 15px; border-radius: 10px; border-left: 5px solid #4CAF50; margin-bottom: 20px; }
    </style>
    <head>
    <title>Update Profile - KothaMate</title>
    <style>
        /* ... your existing CSS ... */
    </style>
    
</head>
</head>
<body>

<div class="header">
    <h1>Update Profile!</h1>
    <p>Please fill in the details below</p>
</div>

<div class="container">
    <div class="card">
        <?php if ($success_msg): ?>
            <div class="success-box">
                <strong><?php echo $success_msg; ?></strong>
            </div>
            <h3>Submitted Information:</h3>
            <?php foreach ($submitted_data as $label => $value): ?>
                <p><strong><?php echo $label; ?>:</strong> <?php echo $value; ?></p>
            <?php endforeach; ?>
            <hr>
            <button class="btn" onclick="window.location.href='update.php'">Update Again</button>

        <?php else: ?>
            <?php if (!empty($errors)): ?>
                <div class="error">
                    <ul><?php foreach ($errors as $err) echo "<li>$err</li>"; ?></ul>
                </div>
            <?php endif; ?>

            <form action="update.php" method="POST" enctype="multipart/form-data">
                <input type="text" name="name" placeholder="Full Name" required>
                <input type="text" name="username" placeholder="Username" required>
                <input type="email" name="email" placeholder="Email Address" required>
                
                <select name="country">
                    <option value="Bangladesh">Bangladesh</option>
                    <option value="India">India</option>
                    <option value="Nepal">Nepal</option>
                    <option value="South Korea">South Korea</option>
                </select>

                <textarea name="message" placeholder="Bio" rows="4"></textarea>
                
                <label style="font-size: 0.8rem; color: #666;">Attachment (Optional):</label>
                <input type="file" name="attachment">

                <button type="submit" class="btn">Update Profile</button>
            </form>
        <?php endif; ?>
    </div>
</div>

</body>
</html>