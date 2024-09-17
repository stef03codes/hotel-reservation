<?php

class Apartment {
    protected $conn;
    public function __construct()
    {
        global $conn;
        $this->conn = $conn;
    }
    public function get_all()
    {
        $sql = "SELECT * FROM apartments";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function read($id)
    {
        $sql = "SELECT * FROM apartments WHERE apartment_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function get_apartment_images($apartment_id)
    {
        $sql = "SELECT * FROM images WHERE apartment_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $apartment_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function isReserved($apartment_id)
    {
        $apartment = $this->read($apartment_id);
        return $apartment['is_reserved'];
    }

    public function update($apartment_id, $operation /* wheater reserve or unreserve*/ )
    {
        $sql = "UPDATE apartments SET is_reserved = ? WHERE apartment_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii",$operation, $apartment_id);
        $stmt->execute();
    }
}