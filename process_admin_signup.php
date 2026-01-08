<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // get & sanitize form data
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $email     = mysqli_real_escape_string($conn, $_POST['email']);
    $contact   = mysqli_real_escape_string($conn, $_POST['contact_number']);
    $gender    = mysqli_real_escape_string($conn, $_POST['gender']);
    $password  = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // if email already exists
    $checkEmail = "SELECT id FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $checkEmail);

    if (mysqli_num_rows($result) > 0) {
    echo " This email is already registered. Please use a different email.";
        exit();
    }

    // insert new admin
    $sql = "INSERT INTO users 
            (full_name, last_name, email, password, role, status, contact_number, gender) 
            VALUES 
            ('$full_name', '$last_name', '$email', '$password', 'admin', 'approved', '$contact', '$gender')";

    if (mysqli_query($conn, $sql)) {
        
        $_SESSION['role'] = 'admin';
        $_SESSION['admin_name'] = $full_name;

        header("Location: manage_users.php");
        exit();
    } else {
        echo " Database Error: " . mysqli_error($conn);
    }
}
?>
