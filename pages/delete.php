<?php
require_once '../config/database.php'; // Include database connection
require_once '../classes/Movie.php';

if (isset($_GET['id'])) {
    $movie_id = $_GET['id'];
    $movie = new Movie();

    if ($movie->deleteMovie($movie_id)) {
        echo "<script>
                alert('Movie deleted successfully!');
                window.location.href = '../pages/admin-dashboard.php';
              </script>";
    } else {
        echo "<script>
                alert('Error: Could not delete movie.');
                window.location.href = '../pages/admin-dashboard.php';
              </script>";
    }
} else {
    header("Location: ../pages/admin-dashboard.php");
    exit();
}
?>
