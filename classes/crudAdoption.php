<?php
class Adoption
{
    private $conn;
    private $tbl_name = "adoption_table";

    // Properties matching form fields
    public $id;
    public $name;
    public $gender;
    public $contact;
    public $monthly_salary;
    public $pet_type;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Create a new adoption form entry
    public function create()
    {
        $query = "INSERT INTO " . $this->tbl_name . " (name, gender, contact, monthly_salary, pet_type) 
                  VALUES (:name, :gender, :contact, :monthly_salary, :pet_type)";
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':gender', $this->gender);
        $stmt->bindParam(':contact', $this->contact);
        $stmt->bindParam(':monthly_salary', $this->monthly_salary);
        $stmt->bindParam(':pet_type', $this->pet_type);

        // Execute the query
        return $stmt->execute();
    }

    // Retrieve all adoption form entries
    public function read()
    {
        $query = "SELECT * FROM " . $this->tbl_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Update an adoption form entry by ID
    public function update($id)
    {
        $query = "UPDATE " . $this->tbl_name . " 
                  SET name = :name, gender = :gender, contact = :contact, monthly_salary = :monthly_salary, pet_type = :pet_type 
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':gender', $this->gender);
        $stmt->bindParam(':contact', $this->contact);
        $stmt->bindParam(':monthly_salary', $this->monthly_salary);
        $stmt->bindParam(':pet_type', $this->pet_type);

        // Execute the query
        return $stmt->execute();
    }

    // Delete an adoption form entry by ID
    public function delete($id)
    {
        $query = "DELETE FROM " . $this->tbl_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute(['id' => $id]);
    }
}
?>