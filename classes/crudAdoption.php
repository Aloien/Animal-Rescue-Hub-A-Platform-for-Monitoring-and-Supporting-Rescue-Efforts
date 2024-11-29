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
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Retrieve all adoption form entries
    public function read()
    {
        $query = "SELECT * FROM " . $this->tbl_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
}

?>