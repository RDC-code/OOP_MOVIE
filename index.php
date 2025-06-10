<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>MovieVerse - Home</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"/>
  <style>
    body {
      background-color: #111;
      color: #eee;
      font-family: 'Segoe UI', sans-serif;
    }

    .navbar {
      background-color: #1c1c1c;
    }

    .nav-buttons a {
      margin-left: 10px;
    }

    .movie-title {
      font-weight: bold;
      font-size: 1.2rem;
    }

    .movie-description {
      font-size: 0.95rem;
      color: #ccc;
    }

    footer {
      background-color: #1c1c1c;
      padding: 1rem;
      text-align: center;
      color: #aaa;
      margin-top: 50px;
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark px-4">
    <a class="navbar-brand" href="#">🎬 MovieVerse</a>
    <div class="ms-auto nav-buttons">
      <a href="../MOVIE_SITE_OOP_FINAL/pages/login-form.php" class="btn btn-outline-light btn-sm">Login</a>
      <a href="../MOVIE_SITE_OOP_FINAL/pages/register-form.php" class="btn btn-outline-light btn-sm">Register</a>
    </div>
  </nav>

  <!-- Header -->
  <header class="text-center my-5">
    <h1 class="display-4">Welcome to MovieVerse</h1>
    <p class="lead">Explore popular titles and hidden gems</p>
  </header>

  <!-- Static Movie List -->
  <main class="container">
    <h2 class="mb-4">Now Showing</h2>
    <div class="mb-4">
      <div class="movie-title">Inception</div>
      <div class="movie-description">A thief steals corporate secrets through dream-sharing technology.</div>
    </div>
    <div class="mb-4">
      <div class="movie-title">The Matrix</div>
      <div class="movie-description">A hacker discovers the truth about reality and joins a rebellion.</div>
    </div>
    <div class="mb-4">
      <div class="movie-title">Interstellar</div>
      <div class="movie-description">A crew travels through a wormhole to find a new home for humanity.</div>
    </div>
  </main>

  <!-- Footer -->
  <footer>
    <p>&copy; 2025 MovieVerse. All rights reserved.</p>
  </footer>

</body>
</html>
