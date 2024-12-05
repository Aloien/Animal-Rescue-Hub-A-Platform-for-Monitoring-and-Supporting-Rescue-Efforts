<?php
class Incident {
    private $conn;
    private $table_name = "incidents";
    
    public $id;
    public $animal_type;
    public $date;
    public $description;
    public $status;
    public $image;
    public $geolocation;
    
    public function __construct($db) {
        $this->conn = $db;
    }
    
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (animal_type, date, description, status, image, geolocation) VALUES (:animal_type, :date, :description, :status, :image, :geolocation)";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':animal_type', $this->animal_type);
        $stmt->bindParam(':date', $this->date);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':image', $this->image);
        $stmt->bindParam(':geolocation', $this->geolocation);
        
        return $stmt->execute();
    }
    
    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        return $stmt;
    }
    
    public function getIncidentById($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function update($id) {
        $query = "UPDATE " . $this->table_name . "
                    SET animal_type = :animal_type, date = :date, description = :description, status = :status, image = :image, geolocation = :geolocation
                    WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':animal_type', $this->animal_type);
        $stmt->bindParam(':date', $this->date);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':image', $this->image);
        $stmt->bindParam(':geolocation', $this->geolocation);
        $stmt->bindParam(':id', $id);
        
        return $stmt->execute();
    }
    
    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute(['id' => $id]);
    }
    
    public function updateStatus($id, $status) {
        $query = "UPDATE " . $this->table_name . " SET status = :status WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function getTotalInFacility() {
        $query = "SELECT COUNT(*) as total FROM " . $this->table_name . " WHERE status = 'In Facility'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return $result['total'];
        } else {
            return 0;
        }
    }

    public function getTotalAdopted() {
        $query = "SELECT COUNT(*) as total FROM " . $this->table_name . " WHERE status = 'Adopted'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return $result['total'];
        } else {
            return 0;
        }
    }

    public function getTotalReleased() {
        $query = "SELECT COUNT(*) as total FROM " . $this->table_name . " WHERE status = 'Released'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return $result['total'];
        } else {
            return 0;
        }
    }

    public function getTotalUnderMedical() {
        $query = "SELECT COUNT(*) as total FROM " . $this->table_name . " WHERE status = 'under_medical'";
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