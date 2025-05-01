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
</head>
<body>

<div class="container mt-5">
    <h2>Edit Movie</h2>
    <form action="../process/movie-process.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $movieDetails['id']; ?>">
        <input type="hidden" name="existing_image" value="<?php echo $movieDetails['image']; ?>">

        <div class="mb-3">
            <label for="title" class="form-label">Movie Title:</label>
            <input type="text" name="title" class="form-control" value="<?php echo $movieDetails['title']; ?>" required>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Current Image:</label><br>
            <img src="../uploads/<?php echo $movieDetails['image']; ?>" width="150" class="mb-2">
            <input type="file" name="image" class="form-control" accept="image/*">
            <small>Leave blank if you don't want to change the image.</small>
        </div>

        <button type="submit" name="update" class="btn btn-primary">Update Movie</button>
    </form>
</div>

</body>
</html>
