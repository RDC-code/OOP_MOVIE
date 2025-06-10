<?php
require_once '../config/db.php';

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
        $movie = $this->getMovieById($id);
        if ($movie && !empty($movie['image'])) {
            $imagePath = '../uploads/' . $movie['image'];
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

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
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['upload'])) {
    $movie = new Movie();
    $title = $_POST['title'];
    $target_dir = "../uploads/";

    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $imageName = $_FILES['image']['name'];
    $imageTmp = $_FILES['image']['tmp_name'];
    $imageSize = $_FILES['image']['size'];
    $imageExt = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
    $allowed = ['jpg', 'jpeg', 'png', 'gif'];

    if (in_array($imageExt, $allowed)) {
        if ($imageSize < 2 * 1024 * 1024) { // 2MB limit
            $uniqueName = uniqid('movie_', true) . '.' . $imageExt;
            $targetFile = $target_dir . $uniqueName;

            if (move_uploaded_file($imageTmp, $targetFile)) {
                $movie->addMovie($title, $uniqueName);
                header("Location: ../admin/manage-movies.php?success=1");
                exit();
            } else {
                echo "❌ Failed to upload image.";
            }
        } else {
            echo "❌ Image too large. Max 2MB allowed.";
        }
    } else {
        echo "❌ Invalid image format. Allowed: jpg, jpeg, png, gif.";
    }
}

// Handle Delete
if (isset($_GET['delete'])) {
    $movie = new Movie();
    $movie->deleteMovie($_GET['delete']);
    header("Location: ../admin/manage-movies.php?deleted=1");
    exit();
}

// Handle Update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $movie = new Movie();
    $id = $_POST['id'];
    $title = $_POST['title'];

    $target_dir = "../uploads/";
    $imageName = $_FILES['image']['name'];
    $imageTmp = $_FILES['image']['tmp_name'];
    $imageExt = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
    $allowed = ['jpg', 'jpeg', 'png', 'gif'];

    if (!empty($imageName)) {
        if (in_array($imageExt, $allowed)) {
            $uniqueName = uniqid('movie_', true) . '.' . $imageExt;
            $targetFile = $target_dir . $uniqueName;

            if (move_uploaded_file($imageTmp, $targetFile)) {
                // Remove old image
                $oldMovie = $movie->getMovieById($id);
                if ($oldMovie && !empty($oldMovie['image'])) {
                    $oldImagePath = $target_dir . $oldMovie['image'];
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }

                $movie->updateMovie($id, $title, $uniqueName);
                header("Location: ../admin/manage-movies.php?updated=1");
                exit();
            } else {
                echo "❌ Failed to upload new image.";
            }
        } else {
            echo "❌ Invalid image format.";
        }
    } else {
        // Only title update
        $movie->updateMovie($id, $title);
        header("Location: ../admin/manage-movies.php?updated=1");
        exit();
    }
}
?>
