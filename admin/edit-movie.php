<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 0) {
    header("Location: login-form.php");
    exit();
}

include '../process/movie-process.php';
$movie = new Movie();
$movieDetails = $movie->getMovieById($_GET['id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Movie</title>
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
        <a href="manage-users.php">Manage Users</a>
        <a href="../pages/logout.php" class="text-danger">Logout</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="fw-bold mb-0"> Edit Movie</h2>
        </div>

        <!-- Back Button -->
        <a href="manage-movies.php" class="btn btn-secondary mb-4">←Back to Manage Movies</a>

        <!-- Edit Form -->
        <div class="card bg-black text-white shadow-lg p-4">
            <form action="../process/movie-process.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $movieDetails['id']; ?>">
                <input type="hidden" name="existing_image" value="<?php echo $movieDetails['image']; ?>">

                <div class="mb-3">
                    <label for="title" class="form-label fw-semibold">Movie Title:</label>
                    <input type="text" name="title" class="form-control bg-dark text-white border-secondary" value="<?php echo $movieDetails['title']; ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Current Image:</label><br>
                    <img src="../uploads/<?php echo $movieDetails['image']; ?>" width="150" class="mb-2 rounded border">
                    <input type="file" name="image" class="form-control bg-dark text-white border-secondary mt-2" accept="image/*">
                    <small class="text-muted">Leave blank if you don't want to change the image.</small>
                </div>

                <button type="submit" name="update" class="btn btn-warning w-100">Update Movie</button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
