<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include('db_connection.php');

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$query = "SELECT id, full_name, role, status FROM users WHERE role != 'admin'";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Account Management</title>
    <style>
        body {
            background-color: #7b0707ff; 
            font-family: sans-serif;
        }
        .container {
            background: white;
            border-radius: 20px;
            padding: 20px;
            margin: 50px auto;
            width: 80%;
        }
        .user-grid {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }
        .card {
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 10px;
            width: 250px;
        }
        .btn {
            display: block;
            width: 100%;
            margin: 5px 0;
            padding: 10px;
            border: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;
        }
        .btn-view { background: #007bff; }
        .btn-approve { background: #28a745; }
        .btn-block { background: #ffc107; color: black; }
        .btn-remove { background: #dc3545; }
    </style>
</head>

<body>

<div class="container">
    <h2>Account Management</h2>

    <div class="user-grid">
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="card">
                <h3><?= htmlspecialchars($row['full_name']); ?></h3>
                <small><?= strtoupper($row['role']); ?></small>
                <p>Status: <strong><?= $row['status']; ?></strong></p>

                <button class="btn btn-view">View Profile</button>

                <div style="display:flex; gap:10px;">
                    <button class="btn btn-approve"
                        onclick="updateStatus(<?= $row['id']; ?>, 'approve')">
                        Approve
                    </button>
                    <button class="btn btn-block"
                        onclick="updateStatus(<?= $row['id']; ?>, 'block')">
                        Block
                    </button>
                </div>

                <button class="btn btn-remove"
                    onclick="updateStatus(<?= $row['id']; ?>, 'remove')">
                    Remove
                </button>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<script>
function updateStatus(userId, action) {
    if (!confirm(`Are you sure you want to ${action} this user?`)) return;

    fetch('process_user.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `id=${userId}&action=${action}`
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === 'success') {
            alert(data.message);

           
            const card = event.target.closest('.card');
            const statusText = card.querySelector('p strong');

            if (action === 'approve') statusText.textContent = 'approved';
            if (action === 'block') statusText.textContent = 'blocked';
            if (action === 'remove') card.remove();
        } else {
            alert('Error: ' + data.message);
        }
    });
}
</script>


</body>
</html>
