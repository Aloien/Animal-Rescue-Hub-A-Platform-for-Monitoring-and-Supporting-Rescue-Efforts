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

class Incident { // Encapsulation
    private $conn; // Encapsulation
    private $tbl_name = "incidents"; // Encapsulation

    public $id; // Encapsulation
    public $animal_type; // Encapsulation
    public $location; // Encapsulation
    public $date; // Encapsulation
    public $description; // Encapsulation
    public $image; // Encapsulation

    public function __construct($db) { // Encapsulation
        $this->conn = $db;
    }

    public function create() { // Abstraction
        $query = "INSERT INTO " . $this->tbl_name . " (animal_type, location, date, description, image) VALUES (:animal_type, :location, :date, :description, :image)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':animal_type', $this->animal_type);
        $stmt->bindParam(':location', $this->location);
        $stmt->bindParam(':date', $this->date);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':image', $this->image);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function read() { // Abstraction
        $query = "SELECT * FROM " . $this->tbl_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
}
?>