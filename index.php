<?php
require_once 'inc/header.php';
require_once 'app/classes/Apartment.php';

$apartment = new Apartment();
$apartments = $apartment->get_all();

?>

<section>
    <div class="container">
        <?php if(isset($_SESSION['message'])) : ?>
            <div class="alert alert-<?= $_SESSION['message']['type'] ?> alert-dismissible fade show">
                <?php
                    echo $_SESSION['message']['text'];
                    unset($_SESSION['message']);
                ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <h1>Versus Apartments</h1>
        <div class="apartments mt-5 d-flex">
            <?php foreach ($apartments as $apart) : ?>
                <div class="card me-3" style="max-width: 630px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="public/images/<?= $apart['image'] ?>.png"
                                 class="img-fluid rounded-start w-100 h-100" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"><?= $apart['room_number'] ?></h5>
                                <p class="card-text"><?= $apart['description'] ?></p>
                                <a href="apartment.php?id=<?= $apart['apartment_id'] ?>">View apartment</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<?php require_once 'inc/footer.php'?>