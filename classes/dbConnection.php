<?php
class Database {
    private $host = "localhost";
    private $db_name = "animal_rescue_hub";
    private $username = "root";
    private $password = "";
    public $conn;

    public function getConnect() {
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
