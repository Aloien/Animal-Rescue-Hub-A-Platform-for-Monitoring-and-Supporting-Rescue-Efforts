<?php
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
    public $status; // Add status property


    public function __construct($db)
    {
        $this->conn = $db;
    }


    public function create()
    {
        $query = "INSERT INTO " . $this->tbl_name . " (animal, species, age, description, image, status) VALUES (:animal, :species, :age, :description, :image, :status)";
        $stmt = $this->conn->prepare($query);


        $stmt->bindParam(':animal', $this->animal);
        $stmt->bindParam(':species', $this->species);
        $stmt->bindParam(':age', $this->age);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':image', $this->image);
        $stmt->bindParam(':status', $this->status); // Bind status parameter


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
?>