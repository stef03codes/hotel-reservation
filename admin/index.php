<?php

require_once '../app/config/config.php';
require_once '../app/classes/Reservation.php';
require_once '../app/classes/User.php';

$user = new User();
$is_admin = $user->is_admin($_SESSION['user_id'])['is_admin'];

if(!$is_admin) {
    header('location: ../index.php');
    exit();
}

$user_name = $user->get_user($_SESSION['user_id'])['name'];
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="public/css/style.css">
    <title>Admin</title>
</head>
<body>
    <div class="p-3 bg-dark d-flex align-items-center justify-content-between">
        <h3 class="text-white">Admin Dashboard</h3>
        <div class="d-flex align-items-center">
            <a href="./index.php" class="btn btn-outline-light me-3" title="Admin Account">
                Admin: <?= $user_name; ?>
            </a>
            <a href="../logout.php" class="btn btn-danger">Logout</a>
        </div>
    </div>
    <section>
        <div class="container">
            <h2 class="mt-5">Apartments</h2>
            <h2 class="mt-5">Reservations</h2>
        </div>
    </section>
    <script src="https://kit.fontawesome.com/33ebb0c33d.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

