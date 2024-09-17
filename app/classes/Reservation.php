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
    public function get_all_by_user($user_id)
    {
        $sql = "SELECT * FROM reservations where user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function get_all_by_apartment($apartment_id)
    {
        $sql = "SELECT * FROM reservations where apartment_id = ?";
        $sql = "SELECT r.reservation_id, r.start_date, r.end_date, r.adults, r.children, a.room_number
                FROM ";
//        $stmt = $this->conn->prepare("SELECT p.product_id, p.name, p.price, p.size, p.image, c.quantity
//                                    FROM cart c
//                                    INNER JOIN products p ON c.product_id = p.product_id
//                                    WHERE c.user_id = ?");
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $apartment_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function create($apartment_id, $user_id, $from, $to, $adults, $kids)
    {
        $sql = "INSERT INTO reservations (apartment_id, user_id, start_date, end_date, adults, children)
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iissii", $apartment_id,$user_id, $from, $to, $adults, $kids);
        $stmt->execute();
    }

    public function cancel($reservation_id)
    {
        $sql = "DELETE FROM reservations WHERE reservation_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $reservation_id);
        $stmt->execute();
    }

}