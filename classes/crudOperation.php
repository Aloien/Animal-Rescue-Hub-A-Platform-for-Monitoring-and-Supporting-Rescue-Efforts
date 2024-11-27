<?php
require 'classes/dbconnection.php';

class CrudOperation {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnect();
    }

    public function createUser($name, $email, $phone, $password) {
        $query = "INSERT INTO tb_user (name, email, phone, password) VALUES (:name, :email, :phone, :password)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute(['name' => $name, 'email' => $email, 'phone' => $phone, 'password' => $password]);
    }

    public function getUsers() {
        $query = "SELECT * FROM tb_user";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserById($id) {
        $query = "SELECT * FROM tb_user WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateUser($id, $name, $email, $phone, $password) {
        $query = "UPDATE tb_user SET name = :name, email = :email, phone = :phone, password = :password WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute(['id' => $id, 'name' => $name, 'email' => $email, 'phone' => $phone, 'password' => $password]);
    }

    public function deleteUser($id) {
        $query = "DELETE FROM tb_user WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute(['id' => $id]);
    }
}
?>
