<?php
require_once 'classes/dbConnection.php';

class Adoption
{
    private $conn;
    private $tbl_name = "adoption_table"; // Ensure this matches your actual table name

    // Properties matching form fields
    public $id;
    public $animal_id;
    public $name;
    public $gender;
    public $contact;
    public $monthly_salary;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnect();
    }

    // Create a new adoption form entry
    public function create() {
        $query = "INSERT INTO " . $this->tbl_name . " (animal_id, name, gender, contact, monthly_salary) 
                  VALUES (:animal_id, :name, :gender, :contact, :monthly_salary)";
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':animal_id', $this->animal_id);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':gender', $this->gender);
        $stmt->bindParam(':contact', $this->contact);
        $stmt->bindParam(':monthly_salary', $this->monthly_salary);

        // Execute the query
        return $stmt->execute();
    }

    // Retrieve an adoption entry by ID
    public function getAdoptionById($id) {
        $query = "SELECT * FROM " . $this->tbl_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Retrieve all adoption entries
    public function getAdoptions() {
        $query = "SELECT * FROM " . $this->tbl_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Update an adoption form entry by ID
    public function update($id) {
        $query = "UPDATE " . $this->tbl_name . " 
                  SET animal_id = :animal_id, name = :name, gender = :gender, contact = :contact, monthly_salary = :monthly_salary 
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':animal_id', $this->animal_id);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':gender', $this->gender);
        $stmt->bindParam(':contact', $this->contact);
        $stmt->bindParam(':monthly_salary', $this->monthly_salary);

        // Execute the query
        return $stmt->execute();
    }

    // Delete an adoption form entry by ID
    public function delete($id) {
        $query = "DELETE FROM " . $this->tbl_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute(['id' => $id]);
    }

    // Delete adoption entries by animal_id
    public function deleteByAnimalId($animal_id) {
        $query = "DELETE FROM " . $this->tbl_name . " WHERE animal_id = :animal_id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute(['animal_id' => $animal_id]);
    }
}
?>
