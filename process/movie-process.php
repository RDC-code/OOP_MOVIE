<?php
include '../config/db.php';

class Movie {
    private $conn;
    private $table = 'movies';

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function addMovie($title, $image) {
        $query = "INSERT INTO " . $this->table . " (title, image) VALUES (:title, :image)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':image', $image);
        return $stmt->execute();
    }

    public function getMovies() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteMovie($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function updateMovie($id, $title, $image = null) {
        if ($image) {
            $query = "UPDATE " . $this->table . " SET title = :title, image = :image WHERE id = :id";
        } else {
            $query = "UPDATE " . $this->table . " SET title = :title WHERE id = :id";
        }
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':title', $title);
        if ($image) {
            $stmt->bindParam(':image', $image);
        }
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
    

    public function getMovieById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

// Handle Create (Upload)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['upload'])) {
    $movie = new Movie();
    $title = $_POST['title'];

    $target_dir = "../uploads/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    
    $image = basename($_FILES["image"]["name"]);
    $target_file = $target_dir . $image;

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        $movie->addMovie($title, $image);
        header("Location: ../pages/admin-dashboard.php?success=1");
        exit();
    } else {
        echo "Failed to upload image.";
    }
}

// Handle Delete
if (isset($_GET['delete'])) {
    $movie = new Movie();
    $movie->deleteMovie($_GET['delete']);
    header("Location: ../pages/admin-dashboard.php");
    exit();
}

// Handle Update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $movie = new Movie();
    $id = $_POST['id'];
    $title = $_POST['title'];

    $target_dir = "../uploads/";
    $image = basename($_FILES["image"]["name"]);
    
    if (!empty($image)) { // If new image is uploaded
        $target_file = $target_dir . $image;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $movie->updateMovie($id, $title, $image);
            header("Location: ../pages/admin-dashboard.php?updated=1");
            exit();
        } else {
            echo "Failed to upload new image.";
        }
    } else { 
        // If no new image, update only the title
        $movie->updateMovie($id, $title, null);
        header("Location: ../pages/admin-dashboard.php?updated=1");
        exit();
    }
}
?>