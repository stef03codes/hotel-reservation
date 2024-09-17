<?php

require_once 'inc/header.php';
require_once 'app/classes/Apartment.php';

$apartment = new Apartment();
$apartment_data = $apartment->read($_GET['id']);
$images = $apartment->get_apartment_images($_GET['id']);

?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="public/images/<?= $apartment_data['image']; ?>.png" alt="" class="mb-2" width="95%">
                <div class="d-flex align-items-center">
                    <img src="public/images/<?= $images[0]['image_link']; ?>.png" alt="" class="me-2"
                    width="30%">
                    <img src="public/images/<?= $images[1]['image_link']; ?>.png" alt="" class="me-2" width="30%">
                    <img src="public/images/<?= $images[2]['image_link']; ?>.png" alt="" width="30%">
                </div>
            </div>
            <div class="col-md-6">
                <h2>Room <?= $apartment_data['room_number']; ?></h2>
                <p class="mt-2"><?= $apartment_data['description']; ?></p>
                <form action="reserve_room.php" method="post" class="mt-2">
                    <input type="hidden" name="id" value="<?= $apartment_data['apartment_id']; ?>">
                    <div class="mb-3">
                        <label for="startDate" class="form-label">From</label>
                        <input type="date" name="start_date" class="form-control" id="startDate">
                    </div>
                    <div class="mb-3">
                        <label for="endDate" class="form-label">To</label>
                        <input type="date" name="end_date" class="form-control" id="endDate">
                    </div>
                    <div class="mb-3 d-flex align-items-center">
                        <div class="me-2 w-25">
                            <label for="adults" class="form-label">Adults</label>
                            <input type="number" name="adults" class="form-control" id="adults" value="1">
                        </div>
                        <div class="w-25">
                            <label for="kids" class="form-label">Kids</label>
                            <input type="number" name="kids" class="form-control" id="kids" value="1">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Reserve now</button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php require_once 'inc/footer.php'; ?>
