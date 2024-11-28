<?php
class Incident {
    private $conn;
    private $tbl_name = "incidents";

    public $id;
    public $animal_type;
    public $location;
    public $date;
    public $description;
    public $image;
    public $status;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->tbl_name . " (animal_type, location, date, description, image, status) VALUES (:animal_type, :location, :date, :description, :image, :status)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':animal_type', $this->animal_type);
        $stmt->bindParam(':location', $this->location);
        $stmt->bindParam(':date', $this->date);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':image', $this->image);
        $stmt->bindParam(':status', $this->status);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function read() {
        $query = "SELECT * FROM " . $this->tbl_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
}
?>