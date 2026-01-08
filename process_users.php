<?php
header('Content-Type: application/json');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include('db_connection.php');
// admin only
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo json_encode([
        'status' => 'error',
        'message' => 'Admin login required'
    ]);
    exit();
}
// Validate request
if (!isset($_POST['id']) || !isset($_POST['action'])) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid request data'
    ]);
    exit();
}

$userId = (int) $_POST['id'];
$action = $_POST['action'];

if ($userId <= 0) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid user ID'
    ]);
    exit();
}

switch ($action) {
    case 'approve':
        $sql = "UPDATE users SET status='approved' WHERE id=$userId";
        $msg = 'User approved';
        break;

    case 'block':
        $sql = "UPDATE users SET status='blocked' WHERE id=$userId";
        $msg = 'User blocked';
        break;

    case 'remove':
        $sql = "DELETE FROM users WHERE id=$userId";
        $msg = 'User removed';
        break;

    default:
        echo json_encode([
            'status' => 'error',
            'message' => 'Invalid action'
        ]);
        exit();
}

if (mysqli_query($conn, $sql)) {
    echo json_encode([
        'status' => 'success',
        'message' => $msg
    ]);
} else {
    echo json_encode([
        'status' => 'error',
        'message' => mysqli_error($conn)
    ]);
}
