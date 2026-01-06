<?php
// Initialize variables and error array
$name = $email = "";
$errors = [];
$success_data = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 3a. Check all fields are filled
    if (empty($_POST["name"]) || empty($_POST["email"]) || empty($_POST["password"]) || empty($_POST["confirm_password"])) {
        $errors[] = "All fields are required.";
    } else {
        // 4a. Sanitize input data
        $name = htmlspecialchars(stripslashes(trim($_POST["name"])));
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];

        // 3b. Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format.";
        }

        // 3c. Check password match
        if ($password !== $confirm_password) {
            $errors[] = "Passwords do not match.";
        }

        // 4. If validation passes
        if (empty($errors)) {
            $success_data = [
                "Name" => $name,
                "Email" => $email
            ];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KothaMate - Sign Up</title>
    <style>
        /* 5. Basic CSS Styling to match UI */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #971703ff; /* Red Background */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: white;
        }
        .container {
            width: 90%;
            max-width: 400px;
            text-align: center;
        }
        .logo {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .description {
            font-size: 0.9rem;
            line-height: 1.5;
            margin-bottom: 30px;
        }
        .form-box {
            background: transparent;
        }
        input {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            border-radius: 25px;
            border: 1px solid white;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            box-sizing: border-box;
        }
        input::placeholder { color: rgba(255, 255, 255, 0.7); }
        
        .btn-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 30px;
        }
        .login-link {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }
        .signup-btn {
            background-color: white;
            color: #800000;
            border: none;
            padding: 15px 40px;
            border-radius: 40px 0px 40px 40px; /* Matching the curved corner in image */
            font-weight: bold;
            font-size: 1rem;
            cursor: pointer;
        }
        /* 3d. Error Message Styling */
        .error-box {
            background: #fff;
            color: #ff0000;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 15px;
            font-size: 0.85rem;
        }
        .success-box {
            background: #ffffff;
            color: #333;
            padding: 20px;
            border-radius: 15px;
            text-align: left;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="logo">KothaMate</div>
    
    <?php if ($success_data): ?>
        <div class="success-box">
            <h3 style="color: #ff0000;">Account Created!</h3>
            <p><strong>Sanitized Name:</strong> <?php echo $success_data['Name']; ?></p>
            <p><strong>Sanitized Email:</strong> <?php echo $success_data['Email']; ?></p>
            <button onclick="window.location.href='signUp.php'" class="signup-btn" style="width:100%; margin-top:10px;">Back</button>
        </div>
    <?php else: ?>
        <p class="description">
            KothaMate helps you learn, communicate, and connect through spoken, sign, and regional languages. Anytime, anywhere.
        </p>

        <?php if (!empty($errors)): ?>
            <div class="error-box">
                <?php foreach ($errors as $error) echo "• $error<br>"; ?>
            </div>
        <?php endif; ?>

        <form action="signUp.php" method="POST" class="form-box">
            <input type="text" name="name" placeholder="Full Name" value="<?php echo htmlspecialchars($name); ?>">
            <input type="email" name="email" placeholder="Email Address" value="<?php echo htmlspecialchars($email); ?>">
            <input type="password" name="password" placeholder="Password">
            <input type="password" name="confirm_password" placeholder="Confirm Password">
            
            <div class="btn-container">
                <a href="#" class="login-link">Login</a>
                <button type="submit" class="signup-btn">Sign up</button>
            </div>
        </form>
    <?php endif; ?>
</div>

</body>
</html>