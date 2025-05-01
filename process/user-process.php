<?php
include '../config/db.php';

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
                header('Location: admin-dashboard.php');
            } else {
                header('Location: user-dashboard.php');
            }
            exit();
        }
        return false;
    }
}
?>
