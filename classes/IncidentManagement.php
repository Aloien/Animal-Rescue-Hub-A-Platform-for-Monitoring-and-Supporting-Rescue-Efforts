<?php
class Incident {
    private $conn;
    private $table_name = "incidents";

    public $id;
    public $animal_type;
    public $location;
    public $date;
    public $description;
    public $status;
    public $image;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (animal_type, location, date, description, status, image) VALUES (:animal_type, :location, :date, :description, :status, :image)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':animal_type', $this->animal_type);
        $stmt->bindParam(':location', $this->location);
        $stmt->bindParam(':date', $this->date);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':image', $this->image);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
}
?>