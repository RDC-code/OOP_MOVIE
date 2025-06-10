<?php
require_once '../config/db.php';

class User {
    private $conn;
    private $table = 'users';

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function register($username, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO " . $this->table . " (username, password, role) VALUES (:username, :password, 1)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashedPassword);
        return $stmt->execute();
    }

    public function login($username, $password) {
        $query = "SELECT * FROM " . $this->table . " WHERE username = :username";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            if ($user['role'] == 0) {
                header('Location: ../admin/admin-dashboard.php');
            } else {
                header('Location: ../user/user-dashboard.php');
            }
            exit();
        }
        return false;
    }

    public function getAllUsers() {
        $query = "SELECT id, username, role FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteUser($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function updateUser($id, $username, $password = null, $role = 1) {
        if (!empty($password)) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $query = "UPDATE " . $this->table . " SET username = :username, password = :password, role = :role WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':password', $hashedPassword);
        } else {
            $query = "UPDATE " . $this->table . " SET username = :username, role = :role WHERE id = :id";
            $stmt = $this->conn->prepare($query);
        }

        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }


 public function addUser($username, $password, $role) {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $query = "INSERT INTO " . $this->table . " (username, password, role) VALUES (:username, :password, :role)";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $hashedPassword);
    $stmt->bindParam(':role', $role, PDO::PARAM_INT);
    return $stmt->execute();
}

}

// Handle delete
if (isset($_GET['delete'])) {
    $user = new User();
    $user->deleteUser($_GET['delete']);
    header('Location: ../admin/manage-users.php');
    exit();
}

// Handle update
if (isset($_POST['update_user'])) {
    $user = new User();
    $password = !empty($_POST['password']) ? $_POST['password'] : null;
    $user->updateUser($_POST['id'], $_POST['username'], $password, $_POST['role']);
    header('Location: ../admin/manage-users.php');
    exit();
}


if (isset($_POST['add_user'])) {
    $user = new User();
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $user->addUser($username, $password, $role);
    header('Location: ../admin/manage-users.php');
    exit();
}





?>
