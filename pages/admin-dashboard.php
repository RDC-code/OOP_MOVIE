<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 0) {
    header("Location: login-form.php");
    exit();
}

include '../process/movie-process.php';
$movie = new Movie();
$movies = $movie->getMovies();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-dark text-white">

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>🎬 Welcome, Admin <?php echo $_SESSION['username']; ?>!</h2>
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>

    <!-- Upload Movie Form -->
    <div class="card bg-black text-white shadow-lg p-4">
        <h3 class="fw-bold">🎥 Upload a Movie</h3>
        <form action="../process/movie-process.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label fw-semibold">Movie Title:</label>
                <input type="text" name="title" class="form-control bg-dark text-white border-secondary" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label fw-semibold">Movie Image:</label>
                <input type="file" name="image" class="form-control bg-dark text-white border-secondary" accept="image/*" required>
            </div>
            <button type="submit" name="upload" class="btn btn-danger w-100">Upload</button>
        </form>
    </div>

    <!-- Movie List -->
    <h3 class="mt-5 fw-bold">🎞 Movie List</h3>
    <div class="row">
        <?php foreach ($movies as $movie) : ?>
            <div class="col-md-4">
                <div class="card bg-black text-white border-secondary mt-3 shadow-lg">
                    <img src="../uploads/<?php echo $movie['image']; ?>" class="card-img-top" alt="<?php echo $movie['title']; ?>">
                    <div class="card-body text-center">
                        <h5 class="card-title fw-bold"><?php echo $movie['title']; ?></h5>
                        <a href="edit-movie.php?id=<?php echo $movie['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="#" class="btn btn-danger btn-sm" onclick="confirmDelete(<?php echo $movie['id']; ?>)">Delete</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
function confirmDelete(id) {
    if (confirm("Are you sure you want to delete this movie?")) {
        window.location.href = "../process/movie-process.php?delete=" + id;
    }
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
