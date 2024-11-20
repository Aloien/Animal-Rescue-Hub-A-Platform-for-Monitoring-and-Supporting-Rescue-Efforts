<?php
class Database
{
    private $host = "localhost";
    private $db_name = "animal_database";
    private $username = "root";
    private $password = "";
    public $conn;

    public function getConnect()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            error_log("Connection error: " . $exception->getMessage());
            echo "Connection error. Please try again later.";
        }

        return $this->conn;
    }
}

class Animals
{
    private $conn;
    private $tbl_name = "animals_table";

    public $id;
    public $animal;
    public $species;
    public $age;
    public $description;
    public $image;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create()
    {
        $query = "INSERT INTO " . $this->tbl_name . " (animal, species, age, description, image) VALUES (:animal, :species, :age, :description, :image)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':animal', $this->animal);
        $stmt->bindParam(':species', $this->species);
        $stmt->bindParam(':age', $this->age);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':image', $this->image);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function read()
    {
        $query = "SELECT * FROM " . $this->tbl_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
}
