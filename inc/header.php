<?php

require_once 'app/config/config.php';

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
        <a class="navbar-brand" href="#">Versus</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="apartments.php">Apartments</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact</a>
                </li>
            </ul>
            <form class="d-flex align-items-center">
                <?php if(isset($_SESSION['user_id'])) : ?>
                    <a href="#" class="btn btn-outline-dark me-3">
                        <i class="fa-solid fa-user me-1"></i>
                        <?= $_SESSION['name']; ?>
                    </a>
                    <a href="logout.php" class="btn btn-danger">Logout</a>
                <?php else : ?>
                    <a class="btn btn-outline-dark" href="login.php">Login</a>
                <?php endif; ?>
            </form>
        </div>
    </div>
</nav>