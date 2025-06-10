<?php
include '../process/user-process.php';

$user = new User();
$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($user->register($username, $password)) {
        $message = "<div class='alert alert-success text-center'>Registered successfully.</div>";
    } else {
        $message = "<div class='alert alert-danger text-center'>Registration failed.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Register - RDC's Movie Site</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"/>

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

    .card {
      max-width: 400px;
      width: 100%;
    }

    .form-control {
      background-color: #222;
      color: #fff;
      border: 1px solid #555;
    }

    .form-control::placeholder {
      color: #aaa;
    }
  </style>
</head>
<body class="bg-dark">

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark px-4">
    <a class="navbar-brand" href="../index.php">🎬 MovieVerse</a>
  
  </nav>

  <!-- Register Form -->
  <div class="d-flex align-items-center justify-content-center vh-100">
    <div class="card bg-black text-white shadow-lg p-4">
      <div class="card-body text-center">
        <h2 class="fw-bold mb-3">🎬 RDC's Movie Site</h2>
        <h4 class="mb-3">Register</h4>

        <?php if (!empty($message)) echo $message; ?>

        <form method="POST">
          <div class="mb-3 text-start">
            <label class="form-label fw-semibold">Username:</label>
            <input type="text" name="username" class="form-control form-control-lg" placeholder="Enter Username" required>
          </div>
          <div class="mb-3 text-start">
            <label class="form-label fw-semibold">Password:</label>
            <input type="password" name="password" class="form-control form-control-lg" placeholder="Enter Password" required>
          </div>
          <button type="submit" class="btn btn-success btn-lg w-100">Register</button>
        </form>

        <div class="mt-3">
          <p class="text-secondary">Already have an account?</p>
          <a href="login-form.php" class="btn btn-danger btn-lg w-100">Login here</a>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
