<?php
class User {
    private $conn;
    private $tbl_name = "tb_user";

    private $id;
    private $name;
    private $email;
    private $password;
    private $phone;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Getters and Setters
    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }
    
    public function getName() { return $this->name; }
    public function setName($name) { $this->name = htmlspecialchars(strip_tags($name)); }
    
    public function getEmail() { return $this->email; }
    public function setEmail($email) { $this->email = htmlspecialchars(strip_tags($email)); }

    public function setPassword($password) { $this->password = htmlspecialchars(strip_tags($password)); }

    public function setPhone($phone) {
        $this->phone = $phone;
    }

    // Create new user
    public function create() {
        $query = "INSERT INTO " . $this->tbl_name . " (name, email, phone, password) VALUES (:name, :email, :phone, :password)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':phone', $this->phone);
        $stmt->bindParam(':password', $this->password);

        return $stmt->execute();
    }

    // Read user by email (for login)
    public function login($email, $password) {
        $query = "SELECT * FROM " . $this->tbl_name . " WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && $password == $user['password']) {
            return $user;
        }
        return false;
    }

    // Retrieve admin from the database by email
    protected function loginAdmin($email) {
        $query = "SELECT * FROM " . $this->tbl_name . " WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Read user by ID
    public function read() {
        $query = "SELECT * FROM " . $this->tbl_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->name = $row['name'];
            $this->email = $row['email'];
            return true;
        }

        return false;
    }

    // Update user details
    public function update() {
        $query = "UPDATE " . $this->tbl_name . " SET name = :name, email = :email WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':id', $this->id);

        return $stmt->execute();
    }

    // Delete user
    public function delete() {
        $query = "DELETE FROM " . $this->tbl_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);

        return $stmt->execute();
    }
}

// Retrieve admin from the database
class Admin extends User {
    public function login($email, $password) {
        $user = $this->loginAdmin($email);
        if ($user && $user['password'] === $password && $user['role'] === 'admin') {
            return ['email' => $email, 'role' => 'admin'];
        }
        return false; 
    }
}
?>
