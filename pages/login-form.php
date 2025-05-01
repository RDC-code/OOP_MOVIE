<?php
session_start();
if (isset($_SESSION['user_id'])) {
    if ($_SESSION['role'] == 0) {
        header("Location: admin-dashboard.php");
    } else {
        header("Location: user-dashboard.php");
    }
    exit();
}

include '../process/user-process.php';

$user = new User();
$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($user->login($username, $password)) {
        exit();
    } else {
        $message = "<div class='alert alert-danger text-center'>Invalid credentials. Please try again.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RDC's Movie Site</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="d-flex align-items-center justify-content-center vh-100 bg-dark">

<div class="card bg-black text-white shadow-lg p-4" style="max-width: 400px; width: 100%;">
    <div class="card-body text-center">
        <h2 class="fw-bold mb-3">🎬 RDC's Movie Site</h2>
        
        <?php if (!empty($message)) echo $message; ?>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label fw-semibold">Username:</label>
                <input type="text" name="username" class="form-control form-control-lg bg-dark text-white border-secondary" placeholder="Enter Username" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Password:</label>
                <input type="password" name="password" class="form-control form-control-lg bg-dark text-white border-secondary" placeholder="Enter Password" required>
            </div>
            <button type="submit" class="btn btn-danger btn-lg w-100">Login</button>
        </form>

        <!-- Register Button -->
        <div class="mt-3">
            <p class="text-secondary">Don't have an account?</p>
            <a href="register-form.php" class="btn btn-success btn-lg w-100">Register here</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
