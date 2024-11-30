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
    public function create()
    {
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


    // Retrieve all animal entries
    public function read()
    {
        $query = "SELECT * FROM " . $this->tbl_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();


        return $stmt;
    }


    // Update an animal entry by ID
    public function updateAnimal($id, $animal, $species, $age, $description, $image, $status) {
        $query = "UPDATE animals_table SET animal = :animal, species = :species, age = :age, description = :description image = :image, status= :status WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute(['id' => $id, 'animal' => $animal, 'species' => $species, 'age' => $age, 'description' => $description, 'image' => $image, 'status' => $status]);
    }


    // Delete an animal entry by ID
    public function delete($id)
    {
        $query = "DELETE FROM " . $this->tbl_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute(['id' => $id]);
    }
}
?>