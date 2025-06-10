<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 0) {
    header("Location: login-form.php");
    exit();
}

include '../process/user-process.php';
$user = new User();
$userData = $user->getUserById($_GET['id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-dark text-white">
<div class="container mt-5">
    <h2 class="mb-4">Edit User</h2>
    <a href="manage-users.php" class="btn btn-secondary mb-4">← Back</a>

    <form action="../process/user-process.php" method="POST">
        <input type="hidden" name="id" value="<?= $userData['id']; ?>">

        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control bg-dark text-white border-secondary" value="<?= $userData['username']; ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Change Password (optional)</label>
            <input type="password" name="password" class="form-control bg-dark text-white border-secondary">
            <small class="text-muted">Leave blank to keep current password.</small>
        </div>

        <div class="mb-3">
            <label class="form-label">Role</label>
            <select name="role" class="form-select bg-dark text-white border-secondary">
                <option value="1" <?= $userData['role'] == 1 ? 'selected' : '' ?>>User</option>
                <option value="0" <?= $userData['role'] == 0 ? 'selected' : '' ?>>Admin</option>
            </select>
        </div>

        <button type="submit" name="update_user" class="btn btn-warning w-100">Update User</button>
    </form>
</div>
</body>
</html>
