<?php

class Reservation {
    protected $conn;
    public function __construct()
    {
        global $conn;
        $this->conn = $conn;
    }
    public function get_all()
    {
        $sql = "SELECT * FROM reservations";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function create($apartment_id, $from, $to, $adults, $kids)
    {
        $sql = "INSERT INTO reservations (apartment_id, start_date, end_date, adults, children)
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("issii", $apartment_id, $from, $to, $adults, $kids);
        $stmt->execute();
    }

}