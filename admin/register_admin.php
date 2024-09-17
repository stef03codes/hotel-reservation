<?php

require_once '../app/config/config.php';

$hashed_password = password_hash('admin123', PASSWORD_DEFAULT);
$email = 'admin@gmail.com';

global $conn;
$sql = "INSERT INTO users (email, password) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $email, $hashed_password);

$result = $stmt->execute();

if($result) {
    $_SESSION['user_id'] = $result->insert_id;
    return true;
} else {
    return false;
}