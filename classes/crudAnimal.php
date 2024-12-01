<?php
require_once 'classes/dbconnection.php';
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
    public $status;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnect();
    }

    // Create a new animal entry
    public function create() {
        $query = "INSERT INTO " . $this->tbl_name . " (animal, species, age, description, image, status) 
                  VALUES (:animal, :species, :age, :description, :image, :status)";
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':animal', $this->animal);
        $stmt->bindParam(':species', $this->species);
        $stmt->bindParam(':age', $this->age);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':image', $this->image);
        $stmt->bindParam(':status', $this->status);

        // Execute the query
        return $stmt->execute();
    }

    // Retrieve an animal entry by ID
    public function getAnimalById($id) {
        $query = "SELECT * FROM " . $this->tbl_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Retrieve all animal entries
    public function read() {
        $query = "SELECT * FROM " . $this->tbl_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // Update an animal entry
    public function updateAnimal($id, $animal, $species, $age, $description, $image, $status) {
        $query = "UPDATE " . $this->tbl_name . " 
                  SET animal = :animal, species = :species, age = :age, description = :description, image = :image, status = :status 
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':animal', $animal);
        $stmt->bindParam(':species', $species);
        $stmt->bindParam(':age', $age);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id', $id);

        // Execute the query
        return $stmt->execute();
    }

    // Delete an animal entry by ID
    public function delete($id) {
        $query = "DELETE FROM " . $this->tbl_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute(['id' => $id]);
    }

    // Get the total count of animals in the facility
    public function getTotalInFacility() {
        $query = "SELECT COUNT(*) as total FROM " . $this->tbl_name . " WHERE status = 'In Facility'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return $result['total'];
        } else {
            return 0;
        }
    }

    // Get the total count of rescued animals
    public function getTotalAdopted() {
        $query = "SELECT COUNT(*) as total FROM " . $this->tbl_name . " WHERE status = 'Adopted'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return $result['total'];
        } else {
            return 0;
        }
    }

    // Get the total count of released animals
    public function getTotalReleased() {
        $query = "SELECT COUNT(*) as total FROM " . $this->tbl_name . " WHERE status = 'Released'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return $result['total'];
        } else {
            return 0;
        }
    }

    // Get the total count of under medical animals
    public function getTotalUnderMedical() {
        $query = "SELECT COUNT(*) as total FROM " . $this->tbl_name . " WHERE status = 'Under Medical'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return $result['total'];
        } else {
            return 0;
        }
    }
    
}
?>