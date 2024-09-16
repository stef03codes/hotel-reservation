<?php

require_once 'inc/header.php';
require_once 'app/classes/User.php';

if(isset($_SESSION['user_id'])) {
    header('location: index.php');
    exit();
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    $user = new User();
    $created = $user->create($name, $email, $phone,$password);

    if($created) {
        $_SESSION['message']['text'] = "Successfully registered!";
        $_SESSION['message']['type'] = "success";
        header("location: index.php");
        exit();
    } else {
        $_SESSION['message']['text'] = "User with this email already exists!";
        $_SESSION['message']['type'] = "danger";
    }
}

?>

<section>
    <div class="container bg-light p-5 rounded">
        <?php if(isset($_SESSION['message'])) : ?>
            <div class="alert alert-<?= $_SESSION['message']['type'] ?> alert-dismissible fade show">
                <?php
                    echo $_SESSION['message']['text'];
                    unset($_SESSION['message']);
                ?>
                <button type="submit" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <h1>Register to our hotel</h1>
        <form action="" method="post" class="mt-5">
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" name="name" class="form-control" id="name">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="email">
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone number</label>
                <input type="text" name="phone" class="form-control" id="phone">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password">
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
</section>

<?php require_once 'inc/footer.php'; ?>