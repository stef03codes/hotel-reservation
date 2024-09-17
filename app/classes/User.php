<?php

class User {
    protected $conn;
    public function __construct()
    {
        global $conn;
        $this->conn = $conn;
    }
    public function create($name, $email, $password, $phone) : bool
    {
        // if user exist
        if($this->is_registered_in($email)) {
            return false;
        }

        // logic if the user does not exist
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (name, email, password, phone) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssss", $name, $email, $hashed_password, $phone);

        $result = $stmt->execute();

        if($result) {
            $_SESSION['user_id'] = $result->insert_id;
            return true;
        } else {
            return false;
        }
    }

    public function get_user($user_id)
    {
        $sql = "SELECT * FROM users WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function login($email, $password) : bool
    {
        $sql = "SELECT user_id, name, email, password FROM users WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();

        if($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            if(password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['name'] = $user['name'];
                return true;
            }
        }
        return false;
    }

    public function is_registered_in($email) : bool
    {
        $sql = "SELECT email FROM users WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return ($result->num_rows == 1);
    }

    public function is_admin($user_id)
    {
        $sql = "SELECT is_admin FROM users WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function logout()
    {
        unset($_SESSION['user_id']);
    }
}
