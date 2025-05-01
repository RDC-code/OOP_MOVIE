<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 1) {
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
    <title>Movie Website - User Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-dark text-white">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-black">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">Movie Website</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <form class="d-flex" method="GET">
                        <input class="form-control me-2" type="search" name="search" placeholder="Search movies..." aria-label="Search">
                        <button class="btn btn-outline-light" type="submit">Search</button>
                    </form>
                </li>
                <li class="nav-item ms-3">
                    <a href="logout.php" class="btn btn-danger">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Movie Section -->
<div class="container mt-5">
    <h3 class="text-center mb-4">Movie List</h3>
    
    <div class="row">
        <?php
        // Search functionality
        if (isset($_GET['search'])) {
            $search = strtolower($_GET['search']);
            $filteredMovies = array_filter($movies, function ($movie) use ($search) {
                return strpos(strtolower($movie['title']), $search) !== false;
            });
        } else {
            $filteredMovies = $movies;
        }

        if (!empty($filteredMovies)) :
            foreach ($filteredMovies as $movie) :
        ?>
                <div class="col-md-4 col-lg-3 mb-4">
                    <div class="card bg-secondary text-white border-0 shadow-lg">
                        <div class="position-relative">
                            <img src="../uploads/<?php echo $movie['image']; ?>" class="card-img-top" alt="<?php echo $movie['title']; ?>">
                            
                            <!-- Play Button PNG Overlay -->
                            <a href="https://www.youtube.com/results?search_query=<?php echo urlencode($movie['title']); ?>" target="_blank" class="position-absolute top-50 start-50 translate-middle">
                                <img src="../assets/play-button.png" class="img-fluid" style="width: 60px;" alt="Play">
                            </a>
                        </div>
                        <div class="card-body text-center">
                            <h5 class="card-title"><?php echo $movie['title']; ?></h5>
                        </div>
                    </div>
                </div>
        <?php
            endforeach;
        else :
        ?>
            <p class="text-center">No movies found.</p>
        <?php endif; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
