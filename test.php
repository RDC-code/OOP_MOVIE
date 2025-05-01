<!-- resources/views/dashboard.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }

        #sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 250px;
            z-index: 100;
            background-color: #343a40;
            transition: all 0.3s ease;
        }

        #sidebar .nav-link {
            color: #fff;
            padding: 1rem 1.5rem;
            font-size: 1.1rem;
        }

        #sidebar .nav-link:hover {
            background-color: #495057;
        }

        main {
            margin-left: 250px;
            padding: 20px;
        }

        .navbar {
            background-color: #343a40;
        }

        .navbar .navbar-brand,
        .navbar .navbar-nav .nav-link {
            color: #fff;
        }

        .navbar .navbar-nav .nav-link:hover {
            color: #ddd;
        }

        .content-section {
            margin-top: 30px;
        }

        @media (max-width: 768px) {
            #sidebar {
                width: 100%;
                height: auto;
            }

            main {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<nav id="sidebar">
    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-film"></i> Movies
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-users"></i> Users
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-cogs"></i> Settings
                </a>
            </li>
        </ul>
    </div>
</nav>

<!-- Main content -->
<main role="main">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <a class="navbar-brand" href="#">Movie Dashboard</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-user-circle"></i> Admin
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Content Section -->
    <div class="container content-section">
        <h1 class="h2">Welcome to the Movie Management Dashboard!</h1>
        <p class="lead">Here you can manage movies, users, and settings.</p>

        <!-- Movies Section -->
        <div class="row">
            <div class="col-md-6">
                <h3>Manage Movies</h3>
                <p>Here you can add, edit, or delete movies.</p>
            </div>
            <div class="col-md-6">
                <h3>Manage Users</h3>
                <p>Manage user roles and permissions here.</p>
            </div>
        </div>
    </div>
</main>

<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
