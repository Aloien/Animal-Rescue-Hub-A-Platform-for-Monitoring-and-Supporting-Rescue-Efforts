<?php
class Database
{
    private $host = "localhost";
    private $db_name = "incident_reports";
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
