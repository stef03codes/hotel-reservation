<?php require_once 'inc/header.php'; ?>

    <section>
        <div class="container bg-light rounded p-5">
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
        </div>
    </section>

<?php require_once 'inc/footer.php'; ?>