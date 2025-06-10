<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 0) {
    header("Location: login-form.php");
    exit();
}

include '../process/user-process.php';
$userObj = new User();
$users = $userObj->getAllUsers();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Users</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .sidebar {
            height: 100vh;
            background-color: #1c1c1c;
            padding-top: 20px;
            position: fixed;
            width: 250px;
        }
        .sidebar a {
            color: #fff;
            display: block;
            padding: 10px 20px;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #343a40;
        }
        .main-content {
            margin-left: 260px;
            padding: 20px;
        }
    </style>
</head>
<body class="bg-dark text-white">

<div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar">
        <h4 class="text-center text-white">🎬 Admin Panel</h4>
        <hr class="text-secondary">
        <a href="admin-dashboard.php">Dashboard</a>
        <a href="manage-movies.php">Manage Movies</a>
        <a href="manage-users.php" class="nav-link text-white px-3 py-2 active bg-secondary">Manage Users</a>
        <a href="../pages/logout.php" class="text-danger">Logout</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <h2 class="mb-4">Manage Users</h2>

        <!-- Add New User Button -->
        <a href="add-user.php" class="btn btn-primary mb-3">+ Add New User</a>

        <table class="table table-dark table-bordered">
         <thead>
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Role</th>
        <th>Actions</th>
    </tr>
</thead>
<tbody>
    <?php foreach ($users as $u): ?>
        <tr>
            <td><?= $u['id']; ?></td>
            <td><?= $u['username']; ?></td>
            <td><?= $u['role'] == 0 ? 'Admin' : 'User'; ?></td>
            <td>
                <a href="edit-user.php?id=<?= $u['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="../process/user-process.php?delete=<?= $u['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this user?')">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>

        </table>

        <!-- Optional: Modals if needed in the future -->
        <?php foreach ($users as $u): ?>
            <div class="modal fade" id="editModal<?= $u['id']; ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $u['id']; ?>" aria-hidden="true">
                <div class="modal-dialog">
                    <form method="POST" action="../process/user-process.php" class="modal-content bg-dark text-white">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel<?= $u['id']; ?>">Edit User</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id" value="<?= $u['id']; ?>">
                            <div class="mb-3">
                                <label for="username<?= $u['id']; ?>" class="form-label">Username</label>
                                <input type="text" name="username" id="username<?= $u['id']; ?>" value="<?= $u['username']; ?>" class="form-control bg-secondary text-white" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="update_user" class="btn btn-success">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
