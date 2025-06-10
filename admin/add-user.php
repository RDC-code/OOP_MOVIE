<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 0) {
    header("Location: login-form.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-dark text-white">
<div class="container mt-5">
    <h2 class="mb-4">Add New User</h2>
    <a href="manage-users.php" class="btn btn-secondary mb-4">← Back</a>

    <form action="../process/user-process.php" method="POST">
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control bg-dark text-white border-secondary" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control bg-dark text-white border-secondary" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Role</label>
            <select name="role" class="form-select bg-dark text-white border-secondary" required>
                <option value="1">User</option>
                <option value="0">Admin</option>
            </select>
        </div>
        <button type="submit" name="add_user" class="btn btn-success w-100">Add User</button>
    </form>
</div>
</body>
</html>
