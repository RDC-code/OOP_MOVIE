<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 0) {
    header("Location: ../pages/login-form.php");
    exit();
}

include '../process/movie-process.php';
include '../process/user-process.php';

$movie = new Movie();
$movies = $movie->getMovies();
$totalMovies = count($movies);

$user = new User();
$users = $user->getAllUsers();
$totalUsers = count($users);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
        <a href="admin-dashboard.php" class="nav-link text-white px-3 py-2 active bg-secondary">Dashboard</a>
        <a href="manage-movies.php">Manage Movies</a>
        <a href="manage-users.php">Manage Users</a>
        <a href="../pages/logout.php" class="text-danger">Logout</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Welcome, Admin <?php echo $_SESSION['username']; ?>!</h2>
        </div>
        <div class="row">
    <div class="col-md-6 mb-4">
        <div class="card bg-primary text-white shadow rounded-3">
            <div class="card-body">
                <h5 class="card-title">Total Movies</h5>
                <p class="card-text fs-4"><?= $totalMovies; ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <div class="card bg-success text-white shadow rounded-3">
            <div class="card-body">
                <h5 class="card-title">Total Users</h5>
                <p class="card-text fs-4"><?= $totalUsers; ?></p>
            </div>
        </div>
    </div>
</div>


      
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
