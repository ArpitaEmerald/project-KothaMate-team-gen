<?php
session_start();

include('db_connection.php'); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $f_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $l_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $full_name = $f_name . " " . $l_name; 
    $email   = mysqli_real_escape_string($conn, $_POST['email']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact_number']);
    $gender  = mysqli_real_escape_string($conn, $_POST['gender']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    
    $sql = "INSERT INTO users (full_name, last_name, email, password, role, status, contact_number, gender) 
            VALUES ('$full_name', '$l_name', '$email', '$password', 'admin', 'approved', '$contact', '$gender')";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['role'] = 'admin';
        $_SESSION['admin_name'] = $full_name;
        header("Location: manage_users.php");
        exit();
    } else {
        echo "Database Error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Signup</title>
    <link rel="stylesheet" href="../View_01/admin_signup.css"> 
</head>
<body>
    <div class="main-container">
        <div class="header-section">
            <button class="back-btn" onclick="window.history.back();">← Back</button>
        </div>

        <div class="signup-card">
            <h1>Sign up</h1>
            <p class="subtitle">Let's get you in</p>

            <form action="admin_signup.php" method="POST">
                <div class="input-group">
                    <label>First Name</label>
                    <input type="text" name="first_name" placeholder="First Name" required>
                </div>

                <div class="input-group">
                    <label>Last Name</label>
                    <input type="text" name="last_name" placeholder="Last Name" required>
                </div>

                <div class="input-group">
                    <label>Email Address</label>
                    <input type="email" name="email" placeholder="Email" required>
                </div>

                <div class="input-group">
                    <label>Contact Number</label>
                    <input type="text" name="contact_number" placeholder="Contact Number" required>
                </div>

                <div class="gender-section">
                    <label>Gender</label>
                    <div class="gender-options">
                        <label class="gender-btn">
                            <input type="radio" name="gender" value="Male" required>
                            <span>Male</span>
                        </label>
                        <label class="gender-btn">
                            <input type="radio" name="gender" value="Female">
                            <span>Female</span>
                        </label>
                    </div>
                </div>

                <div class="input-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Password" required>
                </div>

                <div class="terms">
                    <input type="checkbox" required> I agree to the <span>terms and conditions</span>
                </div>

                <button type="submit" class="submit-btn">✓ Register Admin</button>
            </form>

            <div class="footer-links">
                <a href="login.php" class="login-link">Login</a>
            </div>
        </div>
    </div>
</body>
</html>