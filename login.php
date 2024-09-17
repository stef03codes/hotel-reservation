<?php

require_once 'inc/header.php';
require_once 'app/classes/User.php';


if(isset($_SESSION['user_id'])) {
    header('location: index.php');
    exit();
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = new User();
    $result = $user->login($email, $password);

    if (!$result) {
        $_SESSION['message']['text'] = "Invalid username or password!";
        $_SESSION['message']['type'] = "danger";
        header("location: login.php");
        exit();
    }

    $is_admin = $user->is_admin($_SESSION['user_id'])['is_admin'];
    if($is_admin) {
        $_SESSION['name'] = $result['name'];
        header('location: admin/index.php');
        exit();
    }

    header("location: index.php");
}
?>
    <section>
        <div class="container bg-light rounded p-5">
            <?php if(isset($_SESSION['message'])) : ?>
                <div class="alert alert-<?= $_SESSION['message']['type'] ?> alert-dismissible fade show">
                    <?php
                    echo $_SESSION['message']['text'];
                    unset($_SESSION['message']);
                    ?>
                    <button type="submit" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            <img src="public/images/main.png" class="w-100" alt="">
            <h1 class="my-5">Login to Versus</h1>
            <form action="" method="post">
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" name="email" class="form-control" id="email">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password">
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                    <label class="form-check-label" for="exampleCheck1">I'm 18 years old or older</label>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
            <p class="mt-5">
                <span>Don't have an account? </span>
                <a href="register.php">Register now</a>
            </p>
        </div>
    </section>

<?php require_once 'inc/footer.php'; ?>