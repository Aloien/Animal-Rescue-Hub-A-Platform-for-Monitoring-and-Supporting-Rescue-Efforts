<?php
class User {
    protected $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function login($email, $password) {
        $query = "SELECT * FROM tb_user WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if($user && password_verify($password, $user['password'])){
            return $user;
        }
        return false;
    }
}

class Admin extends User {
    private $admin_email = 'admin@gmail.com';
    private $admin_password = 'admin';

    public function login($email, $password) {
        // Admin login check
        if ($email === $this->admin_email && $password === $this->admin_password) {
            return [
                'email' => $this->admin_email,
                'role' => 'admin'
            ];
        }

        // Check in database
        $user = parent::login($email, $password);
        if ($user && $user['role'] === 'admin') {
            return $user;
        }
        return false;
    }
}
?>
