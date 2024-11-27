<?php
class Database { // Encapsulation
    private $host = "localhost"; // Encapsulation
    private $db_name = "incident_reports"; // Encapsulation
    private $username = "root"; // Encapsulation
    private $password = ""; // Encapsulation
    public $conn; // Encapsulation

    public function getConnect() { // Abstraction
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            error_log("Connection error: " . $exception->getMessage());
            echo "Connection error. Please try again later.";
        }

        return $this->conn;
    }
}

